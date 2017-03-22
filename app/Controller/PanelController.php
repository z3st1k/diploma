<?php
/**
 * Created by PhpStorm.
 * User: Yaroslav
 * Date: 20.03.2017
 * Time: 22:59
 */

class PanelController extends AppController
{
    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->set('Auth', $this->Auth);
    }

    public function index()
    {
//        die(var_dump($this->Auth->user()));
    }

    public function profile()
    {

    }
}