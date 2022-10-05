<?php
namespace App\Models;

use CodeIgniter\Model;

class EmployeesModel extends Model
{
    protected $table      = 'empleados';
    protected $primaryKey = 'id_empleado';
    protected $returnType = 'array';

    protected $allowedFields = [
        'nombres',
        'apellidos',
        'fecha_nacimiento',
        'direccion',
        'telefono',
        'id_departamento'
    ];

    protected $validationRules    = [
        'nombres'          => 'required|alpha_space',
        'apellidos'        => 'required|alpha_space',
        'fecha_nacimiento' => 'required|valid_date',
        'direccion'        => 'required|alpha_numeric_space',
        'telefono'         => 'required|string|min_length[3]|max_length[12]',
        'id_departamento'  => 'required|validateCorrectDepartment'
    ];
    protected $validationMessages = [
        'nombres' => [
            'required' => 'El Nombre del empleado es requerido',
            'alpha_space' => 'El nombre del empleados no puede contener caracteres especiales ni números'
        ],
        'apellidos' => [
            'required' => 'El apellido del empleado es requerido',
            'alpha_space' => 'El apellido del empleados no puede contener caracteres especiales ni números'
        ],
        'fecha_nacimiento' => [
            'required' => 'La fecha de nacimieno del empleado es requerido',
            'valid_date' => 'La fecha de nacimieno del empleados no contiene un formao valido [d/m/Y]'
        ],
        'direccion' => [
            'required' => 'El teléfono es requerido',
            'alpha_numeric_space' => 'la ubicación del empleado solo puede contener letras y números'
        ],
        'telefono'        => [
            'required' => 'El teléfono del empleado es requerido',
            'min_length[2]' => 'Diguite un minimo de 2 digitos para el telélfono',
            'max_length[10]' => 'El teléfono debe de contener un máximo de 10 caracteres'
        ],
        'id_departamento' => [
            'required'    =>'El departamento del empleado es requerido',
            'validateCorrectDepartment' => 'Estimado usuario, el departamento que desea asignar al empleado no existe.'
        ],
    ];
    protected $skipValidation     = false;
}