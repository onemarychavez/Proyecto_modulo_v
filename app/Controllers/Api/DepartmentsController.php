<?php 
namespace App\Controllers\Api;

use App\Models\DepartmentsModel;
use CodeIgniter\RESTful\ResourceController;

class DepartmentsController extends ResourceController
{
    public function __construct()
    {
        $this->model = $this->setModel(new DepartmentsModel());
        helper('friendly_respond');
    }

	public function index()
	{
        $department = $this->model->findAll();
        return $this->respond(customRespond($department,'All department',$this->codes['ok']));
    }

    public function create()
	{
        try {
            $department = $this->request->getJSON();
            if($this->model->insert($department)):
                $department->Id = $this->model->insertID();
                return $this->respondCreated(customRespond($department,'department created',$this->codes['created']));
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

            $department = $this->model->find($id);
            if($department == null)
                return $this->failNotFound('No se a encontrado un department con el id: '.$id);
            return $this->respond(customRespond($department,'department: '. $department['departamento'].' was found.',$this->codes['ok']));
        } catch (\Exception $e) {
            return $this->failServerError('ha ocurrido un error en el servidor'. $e);
        }
    }

    public function update($id = null)
	{
        try {
            if($id == null)
                return $this->failValidationErrors('No se ha pasado un id valido');

            $department = $this->model->find($id);
            if($department == null)
                return $this->failNotFound('No se a encontrado un department con el id: '.$id);

            $department = $this->request->getJSON();
            if($this->model->update($id,$department)):
                $department->Id = $id;
                return $this->respondUpdated(customRespond($department,'department updated',$this->codes['updated']));
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

            $department = $this->model->find($id);
            if($department == null)
                return $this->failNotFound('No se a encontrado un department con el id: '.$id);

            if($this->model->delete($id))
                return $this->respondDeleted(customRespond($department,'department deleted',$this->codes['deleted']));
            return $this->failValidationErrors('No se ha podido eliminar el registro');
        } catch (\Exception $e) {
            return $this->failServerError('ha ocurrido un error en el servidor');
        }
    }
}


