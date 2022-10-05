<?php namespace App\Controllers\Api;

use App\Models\EmployeesModel;
use CodeIgniter\RESTful\ResourceController;

class EmployeesController extends ResourceController
{
    public function __construct()
    {
        $this->model = $this->setModel(new EmployeesModel());
        helper('friendly_respond');
    }

	public function index()
	{
        $employee = $this->model
        ->join('departamentos','departamentos.id_departamento = empleados.id_departamento','inner')
        ->select('empleados.id_empleado,empleados.nombres, empleados.apellidos, empleados.fecha_nacimiento, empleados.direccion, empleados.telefono, departamentos.departamento')
        ->findAll();
        return $this->respond(customRespond($employee,'All employee',$this->codes['ok']));
    }

    public function create()
	{
        try {
            $employee = $this->request->getJSON();
            if($this->model->insert($employee)):
                $employee->Id = $this->model->insertID();
                return $this->respondCreated(customRespond($employee,'employee created',$this->codes['created']));
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

            $employee = $this->model->find($id);
            if($employee == null)
                return $this->failNotFound('No se a encontrado un employee con el id: '.$id);
            return $this->respond(customRespond($employee,'employee: '. $employee['Name'].' was found.',$this->codes['ok']));
        } catch (\Exception $e) {
            return $this->failServerError('ha ocurrido un error en el servidor'. $e);
        }
    }

    public function update($id = null)
	{
        try {
            if($id == null)
                return $this->failValidationErrors('No se ha pasado un id valido');

            $employee = $this->model->find($id);
            if($employee == null)
                return $this->failNotFound('No se a encontrado un employee con el id: '.$id);

            $employee = $this->request->getJSON();
            if($this->model->update($id,$employee)):
                $employee->Id = $id;
                return $this->respondUpdated(customRespond($employee,'employee updated',$this->codes['updated']));
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

            $employee = $this->model->find($id);
            if($employee == null)
                return $this->failNotFound('No se a encontrado un employee con el id: '.$id);

            if($this->model->delete($id))
                return $this->respondDeleted(customRespond($employee,'employee deleted',$this->codes['deleted']));
            return $this->failValidationErrors('No se ha podido eliminar el registro');
        } catch (\Exception $e) {
            return $this->failServerError('ha ocurrido un error en el servidor');
        }
    }
}


