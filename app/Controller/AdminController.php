<?php
/**
 * Created by PhpStorm.
 * User: Yaroslav
 * Date: 22.05.2017
 * Time: 21:23
 */
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
App::uses('String', 'Utility');

class AdminController extends AppController
{
    var $uses = array('User');

    public function beforeFilter()
    {
        parent::beforeFilter();

        if ($this->Auth->user('role') != 3) {
            throw new NotFoundException();
        }
    }

    public function arbiters()
    {
        $list = $this->User->find('all', array(
            'conditions' => array(
                'role' => 2
            ),
            'order' => 'name ASC'
        ));

        $this->set('list', $list);
    }

    public function active_arbiter($encodedId, $type) {
        $decodedId = base64_decode($encodedId);

        $result = $this->User->save(array(
            'id' => $decodedId,
            'active' => $type
        ));

        if ($result) {
            $this->Flash->set("Arbiter updated successfully!", array(
                'params' => array(
                    'code' => 201
                )
            ));
        } else {
            $this->Flash->set("Update Failed!", array(
                'params' => array(
                    'code' => 101
                )
            ));
        }

        $this->redirect('/admin/arbiters');
    }

    public function create_arbiter()
    {
        if ($this->request->is('post')) {
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
                "uuid" => $this->request->data["uuid"],
                "active" => true,
                "dateRegister" => time(),
                "role" => 2
            ));

            $result = $this->User->save($save);

            if ($result) {
                $this->Flash->set("Arbiter {$this->request->data['username']} created successfully!", array(
                    'params' => array(
                        'code' => 201
                    )
                ));
            } else {
                $this->Flash->set("Create Failed!", array(
                    'params' => array(
                        'code' => 101
                    )
                ));
            }
            $this->redirect('/admin/arbiters');
        }
    }

    function remove_arbiter($encodedId)
    {
        $decodedId = base64_decode($encodedId);

        $result = $this->User->delete($decodedId);

        if ($result) {
            $this->Flash->set("Arbiter deleted successfully!", array(
                'params' => array(
                    'code' => 201
                )
            ));
        } else {
            $this->Flash->set("Delete Failed!", array(
                'params' => array(
                    'code' => 101
                )
            ));
        }
        $this->redirect('/admin/arbiters');
    }

}