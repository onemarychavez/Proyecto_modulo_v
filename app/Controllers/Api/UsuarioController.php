<?php 

namespace App\Controllers\Api;

use App\Models\UsuarioModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class UsuarioController extends ResourceController
{
    use ResponseTrait;
 
    public function index()
    {
        $rules = [
            'username' => ['rules' => 'required|min_length[4]|max_length[128]|is_unique[usuarios.username]'],
            'nombres' => ['rules' => 'required|min_length[8]|max_length[255]'],
            'apellidos' => ['rules' => 'required|min_length[8]|max_length[255]'],
            'password' => ['rules' => 'required|min_length[8]|max_length[255]'],
            'id_rol' => ['rules' => 'required|min_length[8]|max_length[255]'],
            
        ];
            
  
        if($this->validate($rules)){
            $model = new UsuarioModel();
            $data = [
                'username'    => $this->request->getVar('username'),
                'nombres'    => $this->request->getVar('nombres'),
                'apellidos'    => $this->request->getVar('apellidos'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                'id_rol'    => $this->request->getVar('id_rol')
            ];
            $model->save($data);
             
            return $this->respond(['message' => 'Registered Successfully'], 200);
        }else{
            $response = [
                'errors' => $this->validator->getErrors(),
                'message' => 'Invalid Inputs'
            ];
            return $this->fail($response , 409);
             
        }
            
    }
}