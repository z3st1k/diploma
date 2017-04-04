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

    public function index()
    {
        $deals = $this->Deal->find('all');

        $this->set('deals', $deals);
    }

    public function create()
    {
        $users = $this->User->find('all', array(
            'conditions' => array(
                'NOT' => array(
                    'id' => $this->Auth->user('id')
                )
            )
        ));

        $this->set('users', $users);
    }
}