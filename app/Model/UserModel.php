<?php

namespace app\Model;

use app\Model\Model;

class UserModel extends Model
{
    public $table_name = "users";
    public $columns   = ['username','password'];
}
