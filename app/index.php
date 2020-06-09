<?php
session_start();
require("Model/Database.php");
require("Model/Model.php");
require("Model/AddressModel.php");
require("Model/ClientModel.php");
require("Model/UserModel.php");
require("Repository/UserRepository.php");
require("Repository/ClientRepository.php");

require("Service/UserService.php");
require("Controllers/Controller.php");
require("Controllers/LoginController.php");

require("Service/ClientService.php");
require("Controllers/ClientController.php");

use app\Model\UserModel;
use app\Model\Database;
use app\Repository\UserRepository;
use app\Service\UserService;

use app\Controllers\LoginController;
use app\Controllers\ClientController;

$path = strtolower($_SERVER['REDIRECT_URL']);
$method =strtolower($_SERVER['REQUEST_METHOD']);
$params = explode("/", $path);
switch ($params[1]) {
    case '':
    case 'login':
        $login = new LoginController();
        $login->$method();
        break;
    case 'clientes':
        $login = new ClientController();
        // print_r($params);
        if ($params[2]) {
            switch ($params[2]) {
                case 'remover':
                    $login->path = $path;
                    $login->{"$method"."DeleteClient"}();
                    return;
                case 'criar':
                    $login->path = $path;
                    $login->{"$method"."CreateClient"}();
                    return;
                default:
                    break;
            }
        }

        $login->$method();
        break;

    case 'logout':
        $login = new LoginController();
        $login->logout();
        break;
         
    default:
        print "<h1>Pagina não existe</h1>";
        break;
}
Database::getInstance()->close();
