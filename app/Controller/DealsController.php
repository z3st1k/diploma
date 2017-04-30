<?php
/**
 * Created by PhpStorm.
 * User: Yaroslav
 * Date: 05.04.2017
 * Time: 0:52
 */

class DealsController extends AppController
{

    var $uses = array('User', 'Deal');
    var $helpers = array('Deal');

    public function index()
    {
        Configure::write('debug', 2);

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
                'dateCreate' => time()
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

            $deal = $this->Deal->find('first', array(
                'conditions' => array(
                    'id' => $id,
                    'OR' => array(
                        'sellerId' => $currentUserId,
                        'customerId' => $currentUserId
                    )
                )
            ));

            if (!empty($deal)) {
                $status = $this->request->data['status'];
                $customerActions = array('1', '2', '4', '5', '6');
                $sellerActions = array('3', '6');

                if (($currentUserId == $deal['Deal']['sellerId'] && in_array($status, $sellerActions) ||
                    $currentUserId == $deal['Deal']['customerId'] && in_array($status, $customerActions)) &&
                    $status > $deal['Deal']['statement']) {

                    $saveResult = false;

                    switch ($status) {
                        case '1':
                            if ($deal['Deal']['statement'] == 0) {
                                $deal['Deal']['statement'] = 1;
                                $saveResult = $this->Deal->save($deal);
                            }
                            break;
                        case '5':
                            if ($deal['Deal']['statement'] == 0 || $deal['Deal']['statement'] == 1) {
                                $deal['Deal']['statement'] = 5;
                                $saveResult = $this->Deal->save($deal);
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
}