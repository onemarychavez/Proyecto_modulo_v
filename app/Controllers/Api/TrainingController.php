<?php 
namespace App\Controllers\Api;

use App\Models\TrainingModel;
use CodeIgniter\RESTful\ResourceController;

class TrainingController extends ResourceController
{
    public function __construct()
    {
        $this->model = $this->setModel(new TrainingModel());
        helper('friendly_respond');
    }

	public function index()
	{
        $training = $this->model
        ->join('modalidad','modalidad.id_modalidad = capacitacion.id_modalidad','inner')
        ->join('financiamiento','financiamiento.id_financiamiento = capacitacion.id_financiamiento','inner')
        ->join('estado_capacitacion','estado_capacitacion.id_estado_capacitacion = capacitacion.id_estado_capacitacion','inner')
        ->join('empleados','empleados.id_empleado = capacitacion.id_empleado','inner')
        ->select('capacitacion.nombre,capacitacion.institucion,modalidad.modalidad,financiamiento.financiamiento, estado_capacitacion.estado_capacitacion,CONCAT(empleados.nombres," ",empleados.apellidos) as empleado,capacitacion.fecha_inicio,capacitacion.fecha_final,capacitacion.descripcion,capacitacion.comprobantes,capacitacion.imagenes')
        ->findAll();
        return $this->respond(customRespond($training,'All training',$this->codes['ok']));
    }

    public function create()
	{
        try {
            $training = $this->request->getJSON();
            if($this->model->insert($training)):
                $training->Id = $this->model->insertID();
                return $this->respondCreated(customRespond($training,'training created',$this->codes['created']));
            else:
                return $this->failValidationErrors($this->model->validation->listErrors());
            endif;
        } catch (\Exception $e) {
            return $this->failServerError('ha ocurrido un error en el servidor');
        }
    }

    public function edit($id = null)
	{
        try {
            if($id == null)
                return $this->failValidationErrors('No se ha pasado un id valido');

            $training = $this->model->find($id);
            if($training == null)
                return $this->failNotFound('No se a encontrado un training con el id: '.$id);
            return $this->respond(customRespond($training,'training: '. $training['nombre'].' was found.',$this->codes['ok']));
        } catch (\Exception $e) {
            return $this->failServerError('ha ocurrido un error en el servidor'. $e);
        }
    }

    public function update($id = null)
	{
        try {
            if($id == null)
                return $this->failValidationErrors('No se ha pasado un id valido');

            $training = $this->model->find($id);
            if($training == null)
                return $this->failNotFound('No se a encontrado un training con el id: '.$id);

            $training = $this->request->getJSON();
            if($this->model->update($id,$training)):
                $training->Id = $id;
                return $this->respondUpdated(customRespond($training,'training updated',$this->codes['updated']));
            else:
                return $this->failValidationErrors($this->model->validation->listErrors());
            endif;
        } catch (\Exception $e) {
            return $this->failServerError('ha ocurrido un error en el servidor');
        }
    }

    public function delete($id = null)
	{
        try {
            if($id == null)
                return $this->failValidationErrors('No se ha pasado un id valido');

            $training = $this->model->find($id);
            if($training == null)
                return $this->failNotFound('No se a encontrado un training con el id: '.$id);

            if($this->model->delete($id))
                return $this->respondDeleted(customRespond($training,'training deleted',$this->codes['deleted']));
            return $this->failValidationErrors('No se ha podido eliminar el registro');
        } catch (\Exception $e) {
            return $this->failServerError('ha ocurrido un error en el servidor');
        }
    }
}


