<?php


namespace app\Service;

use app\Repository\ClientRepository;

class ClientService
{

    public function __construct()
    {
        $this->clientRepository = new ClientRepository;
    }

    public function getClients()
    {
        return $this->clientRepository->getAllClient();
    }
    public function getClient($id)
    {
        return $this->clientRepository->getClientById($id);
    }
    public function saveClient(
        $id,
        $name,
        $birthday,
        $cpf,
        $rg,
        $phone_number,
        $address
    ) {
        $client = $this->clientRepository->saveClient(
            $id,
            $name,
            $birthday,
            $cpf,
            $rg,
            $phone_number
        );
        $client->deleteaddress();
        $adresses = explode(";", $address);

        foreach ($adresses as $key => $address) {
            # code...
            $this->clientRepository->saveAddress($client->id, $address);
        }
    }

    
 
    public function deleteClient($id)
    {
        return $this->clientRepository->deleteClient($id);
    }
}
