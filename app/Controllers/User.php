<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;

class User extends BaseController
{
    use ResponseTrait;
     
    public function index()
    {
        $usuarios = new UserModel;
        return $this->respond(['usuarios' => $usuarios->findAll()], 200);
    }
}
