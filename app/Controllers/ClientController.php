<?php

namespace app\Controllers;

use app\Service\ClientService;

class ClientController extends Controller
{
    protected $auth_required = true;

    public function __construct()
    {
        $this->title = "Area Administrativa";
        parent::__construct();
    }
    public function get()
    {
        $clientService = new ClientService;
        $this->clients = $clientService->getClients();
        $this->renderTemplate("dashboard");
    }

    protected function renderClients()
    {
        foreach ($this->clients as $client) {
            $this->renderComponent("client", ['client'=>$client]);
        }
    }

    public function getCreateClient()
    {
        $params = explode("/", $this->path);
        $id = $params[ count($params)-1 ];
        
        if (count($params) == 4) {
            $id = intval($id);
        } else {
            $id=0;
        }
        
        $data = [];
        if ($id) {
            $clientService = new ClientService;
            $client = $clientService->getClient($id);
            $adr = $client->withaddress() ;
            $aa=[];
            foreach ($adr as $key => $value) {
                $aa[] = $value->address;
            }
            if ($client->id) {
                $data['id'] = $client->id;
                $data['name'] = $client->name;
                $data['birthday'] = date('Y-m-d', strtotime($client->birthday));
                $data['cpf'] = $client->cpf;
                $data['rg'] = $client->rg;
                $data['phone_number'] = $client->phone_number;
                $data['address'] = implode(";", $aa);
                // print_r($data);
            }
        }
        $this->renderTemplate("create_client", $data);
    }
    public function getDeleteClient()
    {

        $params = explode("/", $this->path);
        $id = $params[ count($params)-1 ];
        
        if (count($params) == 4) {
            $id = intval($id);
            if ($id) {
                $clientService = new ClientService;
                $clientService->deleteClient($id);
            }
        } else {
            $id=0;
        }

        $this->redirect("/clientes");
    }

    public function postCreateClient()
    {
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
        $birthday = filter_input(INPUT_POST, 'birthday', FILTER_SANITIZE_SPECIAL_CHARS);
        $cpf = filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_SPECIAL_CHARS);
        $rg = filter_input(INPUT_POST, 'rg', FILTER_SANITIZE_SPECIAL_CHARS);
        $phone_number = filter_input(INPUT_POST, 'phone_number', FILTER_SANITIZE_SPECIAL_CHARS);
        $address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_SPECIAL_CHARS);

        if (!$name
            || !$birthday
            || !$cpf
            || !$rg
            || !$phone_number
            || !$address
        ) {
            $this->addMessage([
                'error'=>'Todos os campos são obrigatorios '
            ]);
            $data['id'] = $id;
            $data['name'] = $name;
            $data['birthday'] = date('Y-m-d', strtotime($birthday));
            $data['cpf'] = $cpf;
            $data['rg'] = $rg;
            $data['phone_number'] = $phone_number;
            $this->renderTemplate("create_client", $data);
            return;
        }
        $clientService = new ClientService;

        $clientService->saveClient(
            $id,
            $name,
            $birthday,
            $cpf,
            $rg,
            $phone_number,
            $address
        );
        
        $this->redirect("clientes");
    }
}
