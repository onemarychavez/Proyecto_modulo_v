<?php 
namespace App\Controllers\Api;

use App\Models\ModalityModel;
use CodeIgniter\RESTful\ResourceController;

class ModalityController extends ResourceController
{
    public function __construct()
    {
        $this->model = $this->setModel(new ModalityModel());
        helper('friendly_respond');
    }

	public function index()
	{
        $modality = $this->model->findAll();
        return $this->respond(customRespond($modality,'All modality',$this->codes['ok']));
    }

    public function create()
	{
        try {
            $modality = $this->request->getJSON();
            if($this->model->insert($modality)):
                $modality->Id = $this->model->insertID();
                return $this->respondCreated(customRespond($modality,'modality created',$this->codes['created']));
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

            $modality = $this->model->find($id);
            if($modality == null)
                return $this->failNotFound('No se a encontrado un modality con el id: '.$id);
            return $this->respond(customRespond($modality,'modality: '. $modality['modalidad'].' was found.',$this->codes['ok']));
        } catch (\Exception $e) {
            return $this->failServerError('ha ocurrido un error en el servidor'. $e);
        }
    }

    public function update($id = null)
	{
        try {
            if($id == null)
                return $this->failValidationErrors('No se ha pasado un id valido');

            $modality = $this->model->find($id);
            if($modality == null)
                return $this->failNotFound('No se a encontrado un modality con el id: '.$id);

            $modality = $this->request->getJSON();
            if($this->model->update($id,$modality)):
                $modality->Id = $id;
                return $this->respondUpdated(customRespond($modality,'modality updated',$this->codes['updated']));
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

            $modality = $this->model->find($id);
            if($modality == null)
                return $this->failNotFound('No se a encontrado un modality con el id: '.$id);

            if($this->model->delete($id))
                return $this->respondDeleted(customRespond($modality,'modality deleted',$this->codes['deleted']));
            return $this->failValidationErrors('No se ha podido eliminar el registro');
        } catch (\Exception $e) {
            return $this->failServerError('ha ocurrido un error en el servidor');
        }
    }
}


