<?php
/**
 * Created by PhpStorm.
 * User: Yaroslav
 * Date: 05.04.2017
 * Time: 0:52
 */

class DealsController extends AppController
{

    var $uses = array('User', 'Deal', 'DealMessages');
    var $helpers = array('Deal');
    var $arbiterActions = array('ajaxMessage', 'changeStatus');

    public function beforeFilter()
    {
        parent::beforeFilter();

        if ($this->Auth->user('role') != 1 && !(in_array($this->request->params['action'], $this->arbiterActions) && $this->Auth->user('role') == 2)) {
            throw new NotFoundException();
        }
    }

    public function index()
    {
        $deals = $this->Deal->find('all', array(
            'fields' => array(
                'Deal.id',
                'Deal.name',
                'Deal.statement',
                'Deal.customerId',
                'Deal.sellerId',
                'Deal.dateCreate',
                'User.username'
            ),
            'conditions' => array(
                'OR' => array(
                    'customerId' => $this->Auth->user('id'),
                    'sellerId' => $this->Auth->user('id')
                )
            ),
            'order' => array('dateCreate DESC'),
            'joins' => array(
                array(
                    'table' => 'users',
                    'alias' => 'User',
                    'type' => 'left',
                    'conditions' => array(
                        '(User.id = Deal.sellerId OR User.id = Deal.customerId) AND User.id <> ' . $this->Auth->user('id')
                    )
                )
            )
        ));

        $this->set('deals', $deals);
    }

    public function create()
    {
        $users = $this->User->find('all', array(
            'conditions' => array(
                'NOT' => array(
                    'id' => $this->Auth->user('id')
                ),
                'active' => 1
            )
        ));

        if ($this->request->is('post')) {
            $saveData = array(
                'name' => $this->request->data['name'],
                'sellerId' => $this->Auth->user('id'),
                'customerId' => $this->request->data['partnerId'],
                'description' => $this->request->data['description'],
                'amount' => $this->request->data['amount'],
                'dateCreate' => time(),
                'lastUpdate' => time()
            );

            $result = $this->Deal->save($saveData);

            if (!$result) {
                $this->Flash->set("Create failed. Please try again", array(
                    'params' => array(
                        'code' => 101
                    )
                ));
            } else {
                $this->Flash->set("Deal has been created successfully.", array(
                    'params' => array(
                        'code' => 201
                    )
                ));

                $this->redirect('/deals/index');
            }
        }

        $this->set('users', $users);
    }

    public function view($encodedId = null)
    {
        if (empty($encodedId)) {
            throw new NotFoundException();
        }

        $id = base64_decode($encodedId);

        $deal = $this->Deal->find('first', array(
            'fields' => array(
                'Deal.id',
                'Deal.name',
                'Deal.statement',
                'Deal.customerId',
                'Deal.sellerId',
                'Deal.dateCreate',
                'Deal.amount',
                'Deal.description',
                'User.username'
            ),
            'conditions' => array(
                'Deal.id' => $id,
                'OR' => array(
                    'Deal.customerId' => $this->Auth->user('id'),
                    'Deal.sellerId' => $this->Auth->user('id')
                )
            ),
            'order' => array('dateCreate DESC'),
            'joins' => array(
                array(
                    'table' => 'users',
                    'alias' => 'User',
                    'type' => 'inner',
                    'conditions' => array(
                        '(User.id = Deal.sellerId OR User.id = Deal.customerId) AND User.id <> ' . $this->Auth->user('id')
                    )
                )
            )
        ));

        if (empty($deal)) {
            throw new NotFoundException();
        }

        $messages = $this->DealMessages->find('all', array(
            'fields' => array('DealMessages.message', 'DealMessages.senderId', 'DealMessages.date', 'User.name', 'User.surname', 'User.avatar'),
            'conditions' => array(
                'dealId' => $id
            ),
            'order' => 'DealMessages.id DESC',
            'joins' => array(
                array(
                    'table' => 'users',
                    'alias' => 'User',
                    'type' => 'inner',
                    'conditions' => array(
                        '(User.id = DealMessages.senderId)'
                    )
                )
            )
        ));

        $this->set('messages', $messages);
        $this->set('deal', $deal);
    }

    public function changeStatus()
    {
        Configure::write('debug', 2);
        $this->autoRender = false;
        $this->autoLayout = false;

        if ($this->request->is('post')) {
            $return = array(
                'code' => 101,
                'msg' => 'Operation not permitted'
            );
            $id = $this->request->data['id'];
            $currentUserId = $this->Auth->user('id');
            $status = $this->request->data['status'];
            $conditions = array(
                'id' => $id
            );

            if ($status != '7' && $status != '8') {
                $conditions['OR'] = array(
                    'sellerId' => $currentUserId,
                    'customerId' => $currentUserId
                );
            }

            $deal = $this->Deal->find('first', array(
                'conditions' => $conditions
            ));

            if (!empty($deal)) {
                $customerActions = array('1', '2', '4', '5', '6');
                $sellerActions = array('3', '6');
                $arbiterActions = array('7', '8');

                if (($currentUserId == $deal['Deal']['sellerId'] && in_array($status, $sellerActions)
                        || $currentUserId == $deal['Deal']['customerId'] && in_array($status, $customerActions)
                        || $currentUserId == $deal['Deal']['arbiterId'] && in_array($status, $arbiterActions)) &&
                    $status > $deal['Deal']['statement']
                ) {

                    $saveResult = false;
                    $deal['Deal']['lastUpdate'] = time();

                    switch ($status) {
                        case '1':

                            if ($deal['Deal']['statement'] == 0) {
                                $deal['Deal']['statement'] = 1;
                                $saveResult = $this->Deal->save($deal);
                            }

                            break;
                        case '2':

                            if ($deal['Deal']['statement'] == 1) {

                                $deal['Deal']['statement'] = 2;
                                $user = $this->User->find('first', array(
                                    'conditions' => array(
                                        'id' => $this->Auth->user('id')
                                    )
                                ));
                                $fee = 5;
                                $max = 5000;
                                $amountFee = $deal['Deal']['amount'] * ($fee / 100);
                                $amountFee = $amountFee > $max ? $max : $amountFee;
                                $resultAmount = $deal['Deal']['amount'] + $amountFee;

                                if ($user['User']['balance'] >= $resultAmount) {
                                    $user['User']['balance'] = $user['User']['balance'] - $resultAmount;

                                    $this->Deal->begin();
                                    $save = $this->User->decreaseBalance($user['User']['id'], $resultAmount);

                                    if ($save) {
                                        $deal['Deal']['resultAmount'] = $resultAmount;
                                        $save = $this->Deal->save($deal);

                                        if ($save !== false) {
                                            $this->Deal->commit();
                                            $saveResult = true;
                                        } else {
                                            $this->Deal->rollback();
                                        }
                                    } else {
                                        $this->Deal->rollback();
                                    }
                                }
                            }

                            break;
                        case '3':

                            if ($deal['Deal']['statement'] == 2) {
                                $deal['Deal']['statement'] = 3;
                                $saveResult = $this->Deal->save($deal);
                            }
                            break;

                        case '4':

                            if ($deal['Deal']['statement'] == 3) {
                                $deal['Deal']['statement'] = 4;
                                $this->Deal->begin();

                                $save = $this->User->increaseBalance($deal['Deal']['sellerId'], $deal['Deal']['amount']);

                                if ($save) {
                                    $saveResult = $this->Deal->save($deal);

                                    if ($saveResult) {
                                        $this->Deal->commit();
                                    } else {
                                        $this->Deal->rollback();
                                    }
                                }
                            }
                            break;
                        case '5':

                            if ($deal['Deal']['statement'] == 0 || $deal['Deal']['statement'] == 1) {
                                $deal['Deal']['statement'] = 5;
                                $saveResult = $this->Deal->save($deal);
                            }

                            break;
                        case '6':
                            $statements = array('2', '3');

                            if (in_array($deal['Deal']['statement'], $statements)) {
                                $deal['Deal']['statement'] = 6;
                                $saveResult = $this->Deal->save($deal);
                            }
                            break;
                        case '7':

                            if ($deal['Deal']['statement'] == 6) {
                                $deal['Deal']['statement'] = 7;
                                $this->Deal->begin();

                                $save = $this->User->increaseBalance($deal['Deal']['customerId'], $deal['Deal']['amount']);

                                if ($save) {
                                    $saveResult = $this->Deal->save($deal);

                                    if ($saveResult) {
                                        $this->Deal->commit();
                                    } else {
                                        $this->Deal->rollback();
                                    }
                                }
                            }
                            break;
                        case '8':

                            if ($deal['Deal']['statement'] == 6) {
                                $deal['Deal']['statement'] = 8;
                                $this->Deal->begin();

                                $save = $this->User->increaseBalance($deal['Deal']['sellerId'], $deal['Deal']['amount']);

                                if ($save) {
                                    $saveResult = $this->Deal->save($deal);

                                    if ($saveResult) {
                                        $this->Deal->commit();
                                    } else {
                                        $this->Deal->rollback();
                                    }
                                }
                            }
                            break;
                    }

                    if ($saveResult) {
                        $return = array(
                            'code' => 201,
                            'msg' => 'Successfully'
                        );
                    }
                }
            }

            return json_encode($return);
        }
        exit;
    }

    public function ajaxMessage()
    {
        Configure::write("debug", 0);
        $this->autoRender = false;
        $this->autoLayout = false;

        if ($this->request->is('post')) {
            $save = array(
                'dealId' => $this->request->data['dealId'],
                'senderId' => $this->Auth->user('id'),
                'date' => time(),
                'message' => $this->request->data['message']
            );

            $result = $this->DealMessages->save($save);

            if ($result) {
                $return = array(
                    'code' => 201,
                    'msg' => 'Successfully'
                );
            } else {
                $return = array(
                    'code' => 101,
                    'msg' => 'Failed'
                );
            }

            return json_encode($return);
        }
    }
}