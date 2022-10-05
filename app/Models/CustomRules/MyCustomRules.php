<?php namespace App\Models\CustomRules;

use App\Models\DepartmentsModel;
use App\Models\EmployeesModel;
use App\Models\FinancingModel;
use App\Models\ModalityModel;
use App\Models\TrainingStatusModel;

class MyCustomRules
{
    public function validateCorrectDepartment(int $id) : bool
    {
        $model = new DepartmentsModel();
        $row = $model->find($id);
        return $row == null ? false : true;
    }

    public function validateCorrectModality(int $id) : bool
    {
        $model = new ModalityModel();
        $row = $model->find($id);
        return $row == null ? false : true;
    }

    public function validateCorrectFinancing(int $id) : bool
    {
        $model = new FinancingModel();
        $row = $model->find($id);
        return $row == null ? false : true;
    }

    public function validateCorrectTrainingStatus(int $id) : bool
    {
        $model = new TrainingStatusModel();
        $row = $model->find($id);
        return $row == null ? false : true;
    }

    public function validateCorrectEmployee(int $id) : bool
    {
        $model = new EmployeesModel();
        $row = $model->find($id);
        return $row == null ? false : true;
    }


}