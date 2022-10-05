<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use App\Models\RolMisionModel;

class RolMisionController extends ResourceController
{
    /**
    * Return an array of resource objects, themselves in array format
    *
    * @return mixed
    */
  public function agregarRol()
  {
      $rules = [
          
          "rol_mision" => "required|is_unique[rol_mision.rol_mision]",
          
      ];

      $messages = [
          
          "rol_mision" => [
              "required" => "Campo vacio",
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

          $rol_mision = new RolMisionModel();

          $data['rol_mision'] = $this->request->getVar("rol_mision");
          
          

          $rol_mision->save($data);

          $response = [
              'status' => 200,
              'error' => false,
              'message' => 'Rol agregado',
              'data' => []
          ];
      }

      return $this->respondCreated($response);
  }

  public function listarRol()
  {
      $rol_mision = new RolMisionModel();

      $response = [
          'status' => 200,
          "error" => false,
          'messages' => 'Estado list',
          'data' => $rol_mision->findAll()
      ];

      return $this->respondCreated($response);
  }

  public function RolIndividual($id_rol_mision)
  {
      $rol_mision = new RolMisionModel();

      $data = $rol_mision->find($id_rol_mision);

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

  public function actualizarRol($id_rol_mision)
  {
      $rules = [
        
       "rol_mision" => "required|is_unique[rol_mision.rol_mision]",
  
          
      ];

      $messages = [

           "rol_mision" => [
               "required" => "Rol requerido",
               "is_unique" => "Este Rol ya existe"
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

          $rol_mision = new RolMisionModel();

          if ($rol_mision->find($id_rol_mision)) {

               $data['rol_mision'] = $this->request->getVar("rol_mision");
          
              
              $rol_mision->update($id_rol_mision, $data);

              $response = [
                  'status' => 200,
                  'error' => false,
                  'message' => 'Rol actualizado',
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

  public function eliminarRol($id_rol_mision)
  {
      $rol_mision = new RolMisionModel();

      $data = $rol_mision->find($id_rol_mision);

      if (!empty($data)) {

          $rol_mision->delete($id_rol_mision);

          $response = [
              'status' => 200,
              "error" => false,
              'messages' => 'Rol eliminado con exito',
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
