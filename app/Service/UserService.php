<?php


namespace app\Service;

use app\Repository\UserRepository;

class UserService
{

    public function __construct()
    {
        $this->userRepository = new UserRepository;
    }
    public function auth($email, $password)
    {
        $user = $this->userRepository->verifyPassword($email, $password);
        if ($user) {
            $_SESSION['login'] = serialize($user);
        }
        return $user;
    }

    public function logout()
    {
        session_unset();
    }
}
