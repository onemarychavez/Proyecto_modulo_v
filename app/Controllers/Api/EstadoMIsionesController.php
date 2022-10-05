<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use App\Models\EstadoMisionesModel;


class EstadoMIsionesController extends ResourceController
{
     /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
   public function agregarEstado()
   {
       $rules = [
           
           "estado_misiones" => "required|is_unique[estado_misiones.estado_misiones]",
           
       ];

       $messages = [
           
           "estado_misiones" => [
               "required" => "Estado requerido",
               "is_unique" => "El Estado ya existe"
               
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

           $estado_misiones = new EstadoMisionesModel();

           $data['estado_misiones'] = $this->request->getVar("estado_misiones");
           
           

           $estado_misiones->save($data);

           $response = [
               'status' => 200,
               'error' => false,
               'message' => 'Estado agregado',
               'data' => []
           ];
       }

       return $this->respondCreated($response);
   }

   public function listarEstado()
   {
       $estado_misiones = new EstadoMisionesModel();

       $response = [
           'status' => 200,
           "error" => false,
           'messages' => 'Estado list',
           'data' => $estado_misiones->findAll()
       ];

       return $this->respondCreated($response);
   }

  
   public function EstadoIndividual($id_estado_misiones)
   {
       $estado_misiones = new EstadoMisionesModel();

       $data = $estado_misiones->find($id_estado_misiones);

       if (!empty($data)) {

           $response = [
               'status' => 200,
               "error" => false,
               'messages' => 'Estado individual',
               'data' => $data
           ];

       } else {

           $response = [
               'status' => 500,
               "error" => true,
               'messages' => 'No estado found',
               'data' => []
           ];
       }

       return $this->respondCreated($response);
   }

   public function actualizarEstado($id_estado_misiones)
   {
       $rules = [
         
        "estado_misiones" => "required|is_unique[estado_misiones.estado_misiones]",
   
           
       ];

       $messages = [

            "estado_misiones" => [
                "required" => "Estado requerido",
                "is_unique" => "Este estado ya existe"
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

           $estado_misiones = new EstadoMisionesModel();

           if ($estado_misiones->find($id_estado_misiones)) {

                $data['estado_misiones'] = $this->request->getVar("estado_misiones");
           
               
               $estado_misiones->update($id_estado_misiones, $data);

               $response = [
                   'status' => 200,
                   'error' => false,
                   'message' => 'Estado actulizado',
                   'data' => []
               ];
           }else {

               $response = [
                   'status' => 500,
                   "error" => true,
                   'messages' => 'No estado found',
                   'data' => []
               ];
           }
       }

       return $this->respondCreated($response);
   }

   public function eliminarEstado($id_estado_misiones)
   {
       $estado_misiones = new EstadoMisionesModel();

       $data = $estado_misiones->find($id_estado_misiones);

       if (!empty($data)) {

           $estado_misiones->delete($id_estado_misiones);

           $response = [
               'status' => 200,
               "error" => false,
               'messages' => 'Estado deleted successfully',
               'data' => []
           ];

       } else {

           $response = [
               'status' => 500,
               "error" => true,
               'messages' => 'No estado found',
               'data' => []
           ];
       }

       return $this->respondCreated($response);
   }
}
