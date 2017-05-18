<?php

class User extends AppModel
{
    public $name = "User";
    public $useTable = "users";
    public $primaryKey = "id";

    public function increaseBalance($userId, $amount)
    {
        return $this->balanceOperation($userId, $amount, 1);
    }

    public function decreaseBalance($userId, $amount)
    {
        return $this->balanceOperation($userId, $amount, 2);
    }

    private function balanceOperation($userId, $amount, $type)
    {
        $result = false;

        $user = $this->find('first', array(
            'conditions' => array(
                'id' => $userId
            )
        ));

        if ($user) {
            if ($type == 1) {
                $balance = $user['User']['balance'] + $amount;
            } else {
                $balance = $user['User']['balance'] - $amount;
            }

            $result = $this->save(array(
                'id' => $userId,
                'balance' => $balance
            ));
        }

        return $result;
    }
}