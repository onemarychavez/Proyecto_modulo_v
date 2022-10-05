<?php 

namespace App\Controllers\Api;

use App\Models\UserModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use \Firebase\JWT\JWT;

class LoginController extends ResourceController
{
    use ResponseTrait;
     
    public function index()
    {
        $userModel = new UserModel();
  
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
          
        $usuarios = $userModel->where('username', $username)->first();
  
        if(is_null($usuarios)) {
            return $this->respond(['error' => 'Invalid username or password.'], 401);
        }
  
        $pwd_verify = password_verify($password, $usuarios['password']);
  
        if(!$pwd_verify) {
            return $this->respond(['error' => 'Invalid username or password.'], 401);
        }
 
        $key = getenv('JWT_SECRET');
        $iat = time(); // current timestamp value
        $exp = $iat + 3600;
 
        $payload = array(
            "iss" => "Issuer of the JWT",
            "aud" => "Audience that the JWT",
            "sub" => "Subject of the JWT",
            "iat" => $iat, //Time the JWT issued at
            "exp" => $exp, // Expiration time of token
            "username" => $usuarios['username'],
        );
         
        $token = JWT::encode($payload, $key, 'HS256');
 
        $response = [
            'message' => 'Login Succesful',
            'token' => $token
        ];
         
        return $this->respond($response, 200);
    }
   
    
}