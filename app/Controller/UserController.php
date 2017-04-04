<?php
/**
 * Created by PhpStorm.
 * User: Yaroslav
 * Date: 05.04.2017
 * Time: 0:55
 */

App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

class UserController extends AppController
{
    var $uses = array('User');

    public function profile()
    {
        $uploadPath = Configure::read('uploadPath');

        if ($this->request->is('post')) {
            if ($this->request->data['password'] && !empty($this->request->data['password'])) {
                if ($this->request->data['password'] != $this->request->data['confirmPassword']) {
                    $this->Flash->set("Passwords doesn't match", array(
                        'params' => array(
                            'code' => 101
                        )
                    ));
                } else {
                    $passwordHasher = new BlowfishPasswordHasher();
                    $this->request->data['password'] = $passwordHasher->hash(
                        $this->request->data['password']
                    );

                    unset($this->request->data['confirmPassword']);

                    if ($this->User->save($this->request->data)) {
                        $this->Flash->set("Changes saved successfully", array(
                            'params' => array(
                                'code' => 201
                            )
                        ));
                    } else {
                        $this->Flash->set("Save filed. Please try again..", array(
                            'params' => array(
                                'code' => 101
                            )
                        ));
                    }
                }
            } else {
                unset($this->request->data['confirmPassword']);
                unset($this->request->data['password']);

                if ($this->User->save($this->request->data)) {
                    $this->Flash->set("Changes saved successfully", array(
                        'params' => array(
                            'code' => 201
                        )
                    ));
                } else {
                    $this->Flash->set("Save filed. Please try again..", array(
                        'params' => array(
                            'code' => 101
                        )
                    ));
                }
            }

            if (isset($_FILES['file']['type']) && !empty($_FILES['file']['type'])) {
                $validExtensions = array("jpeg", "jpg", "png");
                $temporary = explode(".", $_FILES["file"]["name"]);
                $extension = end($temporary);
                if (($_FILES["file"]["type"] == "image/png" || $_FILES["file"]["type"] == "image/jpg" || $_FILES["file"]["type"] == "image/jpeg") && in_array($extension, $validExtensions)) {
                    if ($_FILES["file"]["error"] > 0) {
                        $this->Flash->set("Save image filed", array(
                            'params' => array(
                                'code' => 101
                            )
                        ));
                    } else {
                        $sourcePath = $_FILES['file']['tmp_name'];
                        $databasePath = "upload/images/" . uniqid('avatar_') . '.' . $extension;
                        $targetPath = $uploadPath . DS . $databasePath;
                        if (move_uploaded_file($sourcePath, $targetPath)) {
                            $user = $this->User->find('first', array(
                                'conditions' => array(
                                    'id' => $this->request->data['id']
                                )
                            ));

                            if ($user['User']['avatar']) {
                                unlink($uploadPath . DS . $user['User']['avatar']);
                            }
                            $user['User']['avatar'] = $databasePath;
                            $this->User->save($user);
                        } else {
                            $this->Flash->set("Save image filed", array(
                                'params' => array(
                                    'code' => 101
                                )
                            ));
                        }
                    }
                }
            }
        }

        $user = $this->User->find('first', array(
            'conditions' => array(
                'id' => $this->Auth->user('id')
            )
        ));

        $this->set('user', $user);
    }
}