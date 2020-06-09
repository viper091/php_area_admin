<?php

namespace app\Model;

class AddressModel extends Model
{
    public $table_name = "adresses";
    public $columns   = ['client_id','address'];
}
