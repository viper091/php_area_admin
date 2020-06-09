<?php


namespace app\Controllers;

class Controller
{

    protected $user;
    protected $title= "Area Administrativa";
    protected $auth_required = false;
    public function __construct()
    {
        // session_start();
        $this->user = $_SESSION['login'] ?? null;
        if ($this->user) {
            $this->user = unserialize($_SESSION['login']);
        }
        // print("user $this->user");
        if (!$this->user && $this->auth_required) {
            // print("user $this->user");
            $this->redirect("login");
        }
    }
    public function addMessage($message)
    {
        $_SESSION['message'] = $message;
    }
    
    public function redirect($path)
    {
        // print("redirect $path");
        header("Location: $path");
    }
    public function displayFlashMessage()
    {

        if (isset($_SESSION['message']) == false) {
            return;
        }
        if (is_array($_SESSION['message'])) {
            $arr = $_SESSION['message'];
            foreach ($arr as $key => $value) {
                # code...
                $message = $value;
                $type = $key;
                $this->renderComponent("message", ['message'=>$message, 'type'=>$type]);
            }
            unset($_SESSION['message']);
        }
    }
    public function renderComponent($name, $data = [])
    {
        foreach ($data as $key => $value) {
            # code...
            ${$key} = $value;
        }
        include("./View/$name.component.php");
    }
    public function render($name, $data = [])
    {
        foreach ($data as $key => $value) {
            # code...
            ${'data_'.$key} = $value;
        }
        include_once("./View/$name.view.php");
    }
    public function renderTemplate($name, $data = [])
    {
        // foreach ($data as $key => $value) {
        //     # code...
        //     ${'data_'.$key} = $value;
        // }
        
        include_once("./View/template.view.php");
    }
}
