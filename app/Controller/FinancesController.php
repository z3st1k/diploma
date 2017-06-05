<?php
/**
 * Created by PhpStorm.
 * User: Yaroslav
 * Date: 05.06.2017
 * Time: 2:22
 */

class FinancesController extends AppController
{
    var $uses = array('User');

    public function index()
    {

    }

    public function pay()
    {

    }

    public function callback()
    {

    }

    public function notify()
    {
        $handle = fopen(APP . 'Log' . DS . 'privat24.log', 'w');

        fwrite($handle, json_encode($_REQUEST));

        fclose($handle);
    }
}