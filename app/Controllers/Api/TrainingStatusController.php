<?php 
namespace App\Controllers\Api;

use App\Models\TrainingStatusModel;
use CodeIgniter\RESTful\ResourceController;

class TrainingStatusController extends ResourceController
{
    public function __construct()
    {
        $this->model = $this->setModel(new TrainingStatusModel());
        helper('friendly_respond');
    }

	public function index()
	{
        $trainingStatus = $this->model->findAll();
        return $this->respond(customRespond($trainingStatus,'All trainingStatus',$this->codes['ok']));
    }

    public function create()
	{
        try {
            $trainingStatus = $this->request->getJSON();
            if($this->model->insert($trainingStatus)):
                $trainingStatus->Id = $this->model->insertID();
                return $this->respondCreated(customRespond($trainingStatus,'trainingStatus created',$this->codes['created']));
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

            $trainingStatus = $this->model->find($id);
            if($trainingStatus == null)
                return $this->failNotFound('No se a encontrado un trainingStatus con el id: '.$id);
            return $this->respond(customRespond($trainingStatus,'trainingStatus: '. $trainingStatus['estado_capacitacion'].' was found.',$this->codes['ok']));
        } catch (\Exception $e) {
            return $this->failServerError('ha ocurrido un error en el servidor'. $e);
        }
    }

    public function update($id = null)
	{
        try {
            if($id == null)
                return $this->failValidationErrors('No se ha pasado un id valido');

            $trainingStatus = $this->model->find($id);
            if($trainingStatus == null)
                return $this->failNotFound('No se a encontrado un trainingStatus con el id: '.$id);

            $trainingStatus = $this->request->getJSON();
            if($this->model->update($id,$trainingStatus)):
                $trainingStatus->Id = $id;
                return $this->respondUpdated(customRespond($trainingStatus,'trainingStatus updated',$this->codes['updated']));
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

            $trainingStatus = $this->model->find($id);
            if($trainingStatus == null)
                return $this->failNotFound('No se a encontrado un trainingStatus con el id: '.$id);

            if($this->model->delete($id))
                return $this->respondDeleted(customRespond($trainingStatus,'trainingStatus deleted',$this->codes['deleted']));
            return $this->failValidationErrors('No se ha podido eliminar el registro');
        } catch (\Exception $e) {
            return $this->failServerError('ha ocurrido un error en el servidor');
        }
    }
}


