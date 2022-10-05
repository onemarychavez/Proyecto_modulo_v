<?php 
namespace App\Controllers\Api;

use App\Models\FinancingModel;
use CodeIgniter\RESTful\ResourceController;

class FinancingController extends ResourceController
{
    public function __construct()
    {
        $this->model = $this->setModel(new FinancingModel());
        helper('friendly_respond');
    }

	public function index()
	{
        $financing = $this->model->findAll();
        return $this->respond(customRespond($financing,'All financing',$this->codes['ok']));
    }

    public function create()
	{
        try {
            $financing = $this->request->getJSON();
            if($this->model->insert($financing)):
                $financing->Id = $this->model->insertID();
                return $this->respondCreated(customRespond($financing,'financing created',$this->codes['created']));
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

            $financing = $this->model->find($id);
            if($financing == null)
                return $this->failNotFound('No se a encontrado un financing con el id: '.$id);
            return $this->respond(customRespond($financing,'financing: '. $financing['financiamiento'].' was found.',$this->codes['ok']));
        } catch (\Exception $e) {
            return $this->failServerError('ha ocurrido un error en el servidor'. $e);
        }
    }

    public function update($id = null)
	{
        try {
            if($id == null)
                return $this->failValidationErrors('No se ha pasado un id valido');

            $financing = $this->model->find($id);
            if($financing == null)
                return $this->failNotFound('No se a encontrado un financing con el id: '.$id);

            $financing = $this->request->getJSON();
            if($this->model->update($id,$financing)):
                $financing->Id = $id;
                return $this->respondUpdated(customRespond($financing,'financing updated',$this->codes['updated']));
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

            $financing = $this->model->find($id);
            if($financing == null)
                return $this->failNotFound('No se a encontrado un financing con el id: '.$id);

            if($this->model->delete($id))
                return $this->respondDeleted(customRespond($financing,'financing deleted',$this->codes['deleted']));
            return $this->failValidationErrors('No se ha podido eliminar el registro');
        } catch (\Exception $e) {
            return $this->failServerError('ha ocurrido un error en el servidor');
        }
    }
}


