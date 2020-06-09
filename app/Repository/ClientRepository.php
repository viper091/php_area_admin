<?php

namespace app\Repository;

use app\Model\ClientModel;
use app\Model\AddressModel;

class ClientRepository
{


    public function getAllClient()
    {
        $clients = ClientModel::get();

        return $clients;
    }
    public function saveAddress($client_id, $address)
    {
        $AddressModel = new AddressModel;
        $AddressModel->address = $address;
        $AddressModel->client_id = $client_id;
        $AddressModel->save();
    }
    public function saveClient(
        $id,
        $name,
        $birthday,
        $cpf,
        $rg,
        $phone_number
    ) {
        $client = new ClientModel;
        $client->id = $id;
        $client->name = $name;
        $client->birthday = $birthday;
        $client->cpf = $cpf;
        $client->rg = $rg;
        $client->phone_number = $phone_number;
        $client->save();

        return $client;
    }
    public function getClientById($id)
    {
        $client = new ClientModel;
        $client->findByID($id);

        return $client;
    }
    public function deleteClient($id)
    {
        AddressModel::delete([['client_id','=',$id]]);
        return ClientModel::delete([['id','=',$id]]);
    }
}
