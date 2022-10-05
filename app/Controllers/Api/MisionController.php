<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use App\Models\MisionesModel;


class MisionController extends ResourceController
{
     /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
   public function agregarMision()
   {
       $rules = [
           
        "nombre_evento" =>"required",
        "fecha_inicio" =>"required",
        "fecha_final"=>"required",
        "institucion" =>"required",
        "motivo_evento" =>"required",
        "id_empleado" =>"required",
        "id_rol_mision" =>"required",
        "id_estado_misiones" =>"required",
        "cantidad_audiencia" =>"required",
        "imagenes" =>"required",
        "comentarios" =>"required",

           
       ];

       $messages = [
           
           
        "nombre_evento" => [
            "required" => "Nombre evento requerido"
            
        ],
        "fecha_inicio" => [
         "required" => "fecha_inicio requerido"
         
        ],
        "fecha_final" => [
         "required" => "fecha_final requerido"
         
         ],
        "institucion" => [
         "required" => "institucion requerido"
         
         ],
         "motivo_evento" => [
             "required" => "motivo_evento requerido",
             
         ],
         "id_empleado" => [
             "required" => "id_empleado requerido"
             
         ],
         "id_rol_mision" => [
             "required" => "id_rol_mision requerido"
             
         ],
         "id_estado_misiones" => [
             "required" => "id_estado_misiones requerido"
             
         ],
         "cantidad_audiencia" => [
             "required" => "cantidad_audiencia requerido"
             
         ],
         "imagenes" => [
             "required" => "imagenes requerido"
             
         ],
         "comentarios" => [
             "required" => "comentariosrequerido"
             
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

           $misiones = new MisionesModel();

            $data['nombre_evento'] = $this->request->getVar("nombre_evento");
            $data['fecha_inicio'] = $this->request->getVar("fecha_inicio");
            $data['fecha_final'] = $this->request->getVar("fecha_final");
            $data['institucion'] = $this->request->getVar("institucion");
            $data['motivo_evento'] = $this->request->getVar("motivo_evento");
            $data['id_empleado'] = $this->request->getVar("id_empleado");
            $data['id_rol_mision'] = $this->request->getVar("id_rol_mision");
            $data['id_estado_misiones'] = $this->request->getVar("id_estado_misiones");
            $data['cantidad_audiencia'] = $this->request->getVar("cantidad_audiencia");
            $data['imagenes'] = $this->request->getVar("imagenes");
            $data['comentarios'] = $this->request->getVar("comentarios");
           
           

           $misiones->save($data);

           $response = [
               'status' => 200,
               'error' => false,
               'message' => 'Misión agregada con exíto',
               'data' => []
           ];
       }

       return $this->respondCreated($response);
   }

   public function listarMisiones()
   {
       $misiones = new MisionesModel();

       $response = [
           'status' => 200,
           "error" => false,
           'messages' => 'Listado de Misiones',
           'data' => $misiones->findAll()
       ];
    

       return $this->respondCreated($response);
   }

   public function MisionIndividual($id_mision)
   {
       $misiones = new MisionesModel();

       $data = $misiones->find($id_mision);

       if (!empty($data)) {

           $response = [
               'status' => 200,
               "error" => false,
               'messages' => 'Misión individual',
               'data' => $data
           ];

       } else {

           $response = [
               'status' => 500,
               "error" => true,
               'messages' => 'Misión no encontrada',
               'data' => []
           ];
       }

       return $this->respondCreated($response);
   }

   public function actualizarMision($id_mision)
   {
       $rules = [
         
        "nombre_evento" =>"required",
        "fecha_inicio" =>"required",
        "fecha_final"=>"required",
        "institucion" =>"required",
        "motivo_evento" =>"required",
        "id_empleado" =>"required",
        "id_rol_mision" =>"required",
        "id_estado_misiones" =>"required",
        "cantidad_audiencia" =>"required",
        "imagenes" =>"required",
        "comentarios" =>"required",
   
           
       ];

       $messages = [

        "nombre_evento" => [
            "required" => "Nombre evento requerido"
            
        ],
        "fecha_inicio" => [
         "required" => "fecha_inicio requerido"
         
        ],
        "fecha_final" => [
         "required" => "fecha_final requerido"
         
         ],
        "institucion" => [
         "required" => "institucion requerido"
         
         ],
         "motivo_evento" => [
             "required" => "motivo_evento requerido",
             
         ],
         "id_empleado" => [
             "required" => "id_empleado requerido"
             
         ],
         "id_rol_mision" => [
             "required" => "id_rol_mision requerido"
             
         ],
         "id_estado_misiones" => [
             "required" => "id_estado_misiones requerido"
             
         ],
         "cantidad_audiencia" => [
             "required" => "cantidad_audiencia requerido"
             
         ],
         "imagenes" => [
             "required" => "imagenes requerido"
             
         ],
         "comentarios" => [
             "required" => "comentariosrequerido"
             
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

           $misiones = new MisionesModel();

           if ($misiones->find($id_mision)) {

                $data['nombre_evento'] = $this->request->getVar("nombre_evento");
                $data['fecha_inicio'] = $this->request->getVar("fecha_inicio");
                $data['fecha_final'] = $this->request->getVar("fecha_final");
                $data['institucion'] = $this->request->getVar("institucion");
                $data['motivo_evento'] = $this->request->getVar("motivo_evento");
                $data['id_empleado'] = $this->request->getVar("id_empleado");
                $data['id_rol_mision'] = $this->request->getVar("id_rol_mision");
                $data['id_estado_misiones'] = $this->request->getVar("id_estado_misiones");
                $data['cantidad_audiencia'] = $this->request->getVar("cantidad_audiencia");
                $data['imagenes'] = $this->request->getVar("imagenes");
                $data['comentarios'] = $this->request->getVar("comentarios");
           
               
               $misiones->update($id_mision, $data);

               $response = [
                   'status' => 200,
                   'error' => false,
                   'message' => 'Misión actualizada',
                   'data' => []
               ];
           }else {

               $response = [
                   'status' => 500,
                   "error" => true,
                   'messages' => 'Misión no encontrada',
                   'data' => []
               ];
           }
       }

       return $this->respondCreated($response);
   }

   public function eliminarMision($id_mision)
   {
       $misiones = new MisionesModel();

       $data = $misiones->find($id_mision);

       if (!empty($data)) {

           $misiones->delete($id_mision);

           $response = [
               'status' => 200,
               "error" => false,
               'messages' => 'Misión eliminada con exíto',
               'data' => []
           ];

       } else {

           $response = [
               'status' => 500,
               "error" => true,
               'messages' => 'Misión no encontrada',
               'data' => []
           ];
       }

       return $this->respondCreated($response);
   }
}
