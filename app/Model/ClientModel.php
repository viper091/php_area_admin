<?php

namespace app\Model;

use app\Model\AddressModel;

class ClientModel extends Model
{
    public $table_name = "clients";
    public $columns   = [
        "name",
        "birthday",
        "cpf",
        "rg",
        "phone_number",
    ];

    public function withaddress()
    {
        $a = AddressModel::get([ ["client_id", "=", $this->id]]);
        $this->address=$a;
        return $a;
    }
    public function deleteaddress()
    {
        $a = AddressModel::delete([ ["client_id", "=", $this->id]]);
        return $a;
    }
}
