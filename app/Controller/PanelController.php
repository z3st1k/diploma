<?php
/**
 * Created by PhpStorm.
 * User: Yaroslav
 * Date: 20.03.2017
 * Time: 22:59
 */

class PanelController extends AppController
{
    var $uses = array('Deal', 'DealMessages');

    public function index()
    {
        if ($this->Auth->user('role') == 1) {
            $userDeals = $this->Deal->find('all', array(
                'fields' => array('id'),
                'conditions' => array(
                    'OR' => array(
                        'customerId' => $this->Auth->user('id'),
                        'sellerId' => $this->Auth->user('id')
                    )
                )
            ));

            $dealsInfo = $this->Deal->find('all', array(
                'fields' => array('statement', 'count(statement) as count'),
                'conditions' => array(
                    'OR' => array(
                        'customerId' => $this->Auth->user('id'),
                        'sellerId' => $this->Auth->user('id')
                    )
                ),
                'group' => array('statement')
            ));
        } else {
            $userDeals = $this->Deal->find('all', array(
                'fields' => array('id')
            ));

            $dealsInfo = $this->Deal->find('all', array(
                'fields' => array('statement', 'count(statement) as count'),
                'group' => array('statement')
            ));
        }

        $result = array(
            'completed' => 0,
            'progress' => 0,
            'failed' => 0,
            'arbitration' => 0,
            'total' => 0
        );

        foreach ($dealsInfo as $item) {
            if ($item['Deal']['statement'] == 4) {
                $result['completed'] += $item[0]['count'];
            } else if (in_array($item['Deal']['statement'], array(7, 8))) {
                $result['arbitration'] += $item[0]['count'];
            } else if ($item['Deal']['statement'] == 5) {
                $result['failed'] += $item[0]['count'];
            } else {
                $result['progress'] += $item[0]['count'];
            }

            $result['total'] += $item[0]['count'];
        }

        $arrayDeals = array();

        foreach ($userDeals as $userDeal) {
            array_push($arrayDeals, $userDeal['Deal']['id']);
        }

        $lastMessages = $this->DealMessages->find('all', array(
            'fields' => array('DealMessages.*', 'User.name', 'User.surname', 'User.avatar'),
            'conditions' => array(
                'dealId' => $arrayDeals,
                'NOT' => array(
                    'senderId' => $this->Auth->user('id')
                )
            ),
            'joins' => array(
                array(
                    'table' => 'users',
                    'alias' => 'User',
                    'type' => 'left',
                    'conditions' => array(
                        'User.id = DealMessages.senderId'
                    )
                )
            ),
            'limit' => 10,
            'order' => 'DealMessages.id DESC'
        ));

        $this->set('data', $result);
        $this->set('messages', $lastMessages);
    }
}