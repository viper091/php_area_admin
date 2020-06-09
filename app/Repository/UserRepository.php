<?php

namespace app\Repository;

use app\Model\UserModel;

class UserRepository
{


    public function verifyPassword($username, $password)
    {
        $user = new UserModel;
        $first= $user->where("username", "=", $username)->first();
        if (!$user->id) {
            return false;
        }
        // password hash
        // $ok= (password_verify($password, $user->password));

        $ok = $password === $user->password;
        if ($ok) {
            return $user;
        }
        return false;
    }
}
