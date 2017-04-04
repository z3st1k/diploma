<?php
/**
 * Created by PhpStorm.
 * User: Yaroslav
 * Date: 11.03.2017
 * Time: 12:30
 */
App::uses('CakeEmail', 'Network/Email');
App::uses('String', 'Utility');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

class HomesController extends AppController
{
    var $uses = array('User');

    function beforeFilter()
    {
        $this->Auth->allow();
        parent::beforeFilter();
        $this->layout = 'public';
    }

    public function index()
    {
        $this->set('authUser', $this->Auth->user());
    }

    public function login()
    {
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                if($this->Auth->user('active') == 0) {
                    $this->Flash->set("User not confirmed. Please check your email", array(
                        'params' => array(
                            'code' => 301
                        )
                    ));
                } else {
                    return $this->redirect($this->Auth->redirectUrl());
                }
            } else {
                $this->Flash->set("Incorrect username or password", array(
                    'params' => array(
                        'code' => 101
                    )
                ));
            }
        }
    }

    function signup()
    {

    }

    function signupAjaxSave()
    {
        $this->layout = false;
        $this->autoRender = false;

        if ($this->request->is("post")) {
            $this->User->create();
            $this->request->data['uuid'] = String::uuid ();
            $passwordHasher = new BlowfishPasswordHasher();
            $this->request->data['password'] = $passwordHasher->hash(
                $this->request->data['password']
            );
            $save = array("User" => array(
                "username" => $this->request->data["username"],
                "password" => $this->request->data["password"],
                "email" => $this->request->data["email"],
                "name" => $this->request->data["name"],
                "surname" => $this->request->data["surname"],
                "uuid" => $this->request->data["uuid"],
                "active" => false,
                "dateRegister" => time(),
                "role" => 1,
                "confirmString" => $this->generateRandomString(32)
            ));

            $result = $this->User->save($save);
            $this->mailConfirm($result['User']['id']);

            return $result !== false ? true : false;
        }
    }

    public function checkUser()
    {
        $this->layout = false;
        $this->autoRender = false;

        if ($this->request->is("post")) {
            $conditions = $this->request->data;

            if ($this->Auth->user() && is_array($conditions)) {
                $conditions["NOT"] = array(
                    'id' => $this->Auth->user('id')
                );
            }

            $result = $this->User->find('count', array(
                'conditions' => $conditions
            ));

            return $result > 0 ? 'false' : 'true';
        }
    }


    public function confirm($confirmString)
    {
        if (empty($confirmString) || strlen($confirmString) !== 32) {
            $this->redirect('/');
        }

        $user = $this->User->find('first', array(
            'conditions' => array(
                'confirmString' => $confirmString
            )
        ));

        if(!empty($user) && $user !== false) {
            $user['User']['active'] = true;
            $this->User->save($user);
        } else {
            $this->redirect('/');
        }
    }

    private function mailConfirm($userId)
    {
        $user = $this->User->find('first', array(
            'conditions' => array(
                'id' => $userId
            )
        ));

        $recipient = $user['User']['email'];

        $Email = new CakeEmail();
        $Email->config('smtp');
        $Email->emailFormat('html');
        $Email->to($recipient);
        $Email->subject("Account confirmation");
        $link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}{$this->webroot}homes/confirm/{$user['User']['confirmString']}";
        $body = "Hello {$user['User']['username']}!\r\n";
        $body .= "You successfully registered on Gooddeal.\r\n";
        $body .= "To accepting your account please check this link: <a href='{$link}'>{$link}</a>";

        return $Email->send($body);
    }

    private function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function logout()
    {
        $this->redirect($this->Auth->logout());
    }
}