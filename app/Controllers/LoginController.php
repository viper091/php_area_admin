<?php

namespace app\Controllers;

use app\Service\UserService;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->title = "Area Administrativa - Login";
        parent::__construct();
    }
    public function get()
    {
        if (!$this->user) {
            $this->renderTemplate("login");
        } else {
            $this->redirect("clientes");
        }
    }

    public function logout()
    {
        if ($this->user) {
            $service = new UserService;
            $service->logout();
        }
        $this->redirect("login");
    }
    public function post()
    {
        $service = new UserService;
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
        if (!$username || !$password) {
            $this->addMessage([
                'error'=>'Login e senha obrigatorios '.$email.$password
            ]);
            $this->redirect("login");
            return;
        }
        
        if (!$service->auth($username, $password)) {
            $this->addMessage([
            'error'=>'Login ou senha incorretos'
            ]);

            
            // $this->renderTemplate("login");

            $this->redirect("login");
        } else {
            $this->redirect("clientes");
        }
    }
}
