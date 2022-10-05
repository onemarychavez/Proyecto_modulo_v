<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use App\Models\PermisosModel;

class PermisosController extends ResourceController
{
    /**
    * Return an array of resource objects, themselves in array format
    *
    * @return mixed
    */
  public function agregarPermisos()
  {
      $rules = [
          
          "permiso" => "required|is_unique[permisos.permiso]",
          
      ];

      $messages = [
          
          "permiso" => [
              "required" => "Permiso requerido",
              "is_unique" => "El Permiso ya existe"
              
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

          $permisos = new PermisosModel();

          $data['permiso'] = $this->request->getVar("permiso");
          
          

          $permisos->save($data);

          $response = [
              'status' => 200,
              'error' => false,
              'message' => 'Permiso agregado',
              'data' => []
          ];
      }

      return $this->respondCreated($response);
  }

  public function listarPermisos()
  {
      $permisos = new PermisosModel();

      $response = [
          'status' => 200,
          "error" => false,
          'messages' => 'Listado de Permisos',
          'data' => $permisos->findAll()
      ];

      return $this->respondCreated($response);
  }

 
  public function PermisoIndividual($id_permiso)
  {
      $permisos = new PermisosModel();

      $data = $permisos->find($id_permiso);

      if (!empty($data)) {

          $response = [
              'status' => 200,
              "error" => false,
              'messages' => 'Permiso individual',
              'data' => $data
          ];

      } else {

          $response = [
              'status' => 500,
              "error" => true,
              'messages' => 'Permiso no encontrado',
              'data' => []
          ];
      }

      return $this->respondCreated($response);
  }

  public function actualizarPermiso($id_permiso)
  {
      $rules = [
        
        "permiso" => "required|is_unique[permisos.permiso]",
  
          
      ];

      $messages = [

        "permiso" => [
            "required" => "Permiso requerido",
            "is_unique" => "El Permiso ya existe"
            
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

          $permisos = new PermisosModel();

          if ($permisos->find($id_permiso)) {

            $data['permiso'] = $this->request->getVar("permiso");
          
              
              $permisos->update($id_permiso, $data);

              $response = [
                  'status' => 200,
                  'error' => false,
                  'message' => 'El Permiso  se actulizo exitosamente',
                  'data' => []
              ];
          }else {

              $response = [
                  'status' => 500,
                  "error" => true,
                  'messages' => 'Permiso no encontrado',
                  'data' => []
              ];
          }
      }

      return $this->respondCreated($response);
  }

  public function eliminarPermiso($id_permiso)
  {
      $permisos = new PermisosModel();

      $data = $permisos->find($id_permiso);

      if (!empty($data)) {

          $permisos->delete($id_permiso);

          $response = [
              'status' => 200,
              "error" => false,
              'messages' => 'Permiso eliminado',
              'data' => []
          ];

      } else {

          $response = [
              'status' => 500,
              "error" => true,
              'messages' => 'Permiso no encontrado',
              'data' => []
          ];
      }

      return $this->respondCreated($response);
  }
}
