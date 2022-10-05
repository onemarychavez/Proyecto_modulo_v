<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use App\Models\RolesModel;

class RolesController extends ResourceController
{
    /**
    * Return an array of resource objects, themselves in array format
    *
    * @return mixed
    */
  public function agregarRoles()
  {
      $rules = [
          
          "rol" => "required|is_unique[roles.rol]",
          
      ];

      $messages = [
          
          "rol" => [
              "required" => "Campo vacio",
              "is_unique" => "El rol ya existe"
              
          ],
          
      ];

      if (!$this->validate($rules, $messages)) {

          $response = [
              'status' => 500,
              'error' => true,
              'message' => $this->validator->getErrors(),
              'data' => []
          ];
      } else {

          $permisos = new RolesModel();

          $data['rol'] = $this->request->getVar("rol");
          
          

          $permisos->save($data);

          $response = [
              'status' => 200,
              'error' => false,
              'message' => 'rol agregado con exito',
              'data' => []
          ];
      }

      return $this->respondCreated($response);
  }

  public function listarRoles()
  {
      $permisos = new RolesModel();

      $response = [
          'status' => 200,
          "error" => false,
          'messages' => 'Listado de roles',
          'data' => $permisos->findAll()
      ];

      return $this->respondCreated($response);
  }

 
  public function RoleIndividual($id_rol)
  {
      $roles = new RolesModel();

      $data = $roles->find($id_rol);

      if (!empty($data)) {

          $response = [
              'status' => 200,
              "error" => false,
              'messages' => 'Rol individual',
              'data' => $data
          ];

      } else {

          $response = [
              'status' => 500,
              "error" => true,
              'messages' => 'Rol no encontrado',
              'data' => []
          ];
      }

      return $this->respondCreated($response);
  }

  public function actualizarRol($id_rol)
  {
      $rules = [
        
        "rol" => "required|is_unique[roles.rol]",
  
          
      ];

      $messages = [

        "rol" => [
            "required" => "Rol requerido",
            "is_unique" => "El Rol ya existe"
            
        ],
          
      ];

      if (!$this->validate($rules, $messages)) {

          $response = [
              'status' => 500,
              'error' => true,
              'message' => $this->validator->getErrors(),
              'data' => []
          ];
      } else {

          $roles = new RolesModel();

          if ($roles->find($id_rol)) {

            $data['rol'] = $this->request->getVar("rol");
          
              
              $roles->update($id_rol, $data);

              $response = [
                  'status' => 200,
                  'error' => false,
                  'message' => 'El Rol  se actualizo exitosamente',
                  'data' => []
              ];
          }else {

              $response = [
                  'status' => 500,
                  "error" => true,
                  'messages' => 'Rol no encontrado',
                  'data' => []
              ];
          }
      }

      return $this->respondCreated($response);
  }

  public function eliminarRol($id_rol)
  {
      $roles = new RolesModel();

      $data = $roles->find($id_rol);

      if (!empty($data)) {

          $roles->delete($id_rol);

          $response = [
              'status' => 200,
              "error" => false,
              'messages' => 'Rol eliminado',
              'data' => []
          ];

      } else {

          $response = [
              'status' => 500,
              "error" => true,
              'messages' => 'Rol no encontrado',
              'data' => []
          ];
      }

      return $this->respondCreated($response);
  }
}
