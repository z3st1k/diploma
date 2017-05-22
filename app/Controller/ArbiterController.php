<?php
/**
 * Created by PhpStorm.
 * User: Yaroslav
 * Date: 22.05.2017
 * Time: 23:20
 */

class ArbiterController extends AppController
{
    var $uses = array('User', 'Deal', 'DealMessages');

    public function beforeFilter()
    {
        parent::beforeFilter();

        if ($this->Auth->user('role') != 2) {
            throw new NotFoundException();
        }
    }

    public function deals()
    {
        $list = $this->Deal->find('all', array(
            'conditions' => array(
                'statement' => 6,
                'OR' => array(
                    'arbiterId' => $this->Auth->user('id'),
                    'arbiterId IS NULL'
                )
            ),
            'order' => 'lastUpdate DESC'
        ));

        $this->set('list', $list);
    }

    public function deal_detail($encodedId)
    {
        if (empty($encodedId)) {
            throw new NotFoundException();
        }

        $id = base64_decode($encodedId);

        $list = $this->Deal->find('first', array(
            'fields' => array(
                'Deal.id',
                'Deal.name',
                'Deal.statement',
                'Deal.customerId',
                'Deal.sellerId',
                'Deal.arbiterId',
                'Deal.dateCreate',
                'Deal.amount',
                'Deal.description',
                'SellerUser.username',
                'CustomerUser.username'
            ),
            'conditions' => array(
                'Deal.id' => $id,
                'OR' => array(
                    'Deal.arbiterId IS NULL',
                    'Deal.arbiterId' => $this->Auth->user('id')
                )
            ),
            'order' => array('dateCreate DESC'),
            'joins' => array(
                array(
                    'table' => 'users',
                    'alias' => 'SellerUser',
                    'type' => 'inner',
                    'conditions' => array(
                        '(SellerUser.id = Deal.sellerId)'
                    )
                ),
                array(
                    'table' => 'users',
                    'alias' => 'CustomerUser',
                    'type' => 'inner',
                    'conditions' => array(
                        '(CustomerUser.id = Deal.customerId)'
                    )
                )
            )
        ));

        if (empty($list)) {
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
        $this->set('deal', $list);
    }

    public function enter_to_deal($encodedId)
    {
        $decodedId = base64_decode($encodedId);

        $result = $this->Deal->save(array(
            'id' => $decodedId,
            'arbiterId' => $this->Auth->user('id')
        ));

        if ($result) {
            $this->Flash->set("You successfully entered to the deal!", array(
                'params' => array(
                    'code' => 201
                )
            ));
        } else {
            $this->Flash->set("Operation failed!", array(
                'params' => array(
                    'code' => 101
                )
            ));
        }

        $this->redirect("/arbiter/deal_detail/{$encodedId}");
    }
}