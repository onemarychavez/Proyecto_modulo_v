<?php
namespace App\Models;

use CodeIgniter\Model;

class DepartmentsModel extends Model
{
    protected $table      = 'departamentos';
    protected $primaryKey = 'id_departamento';
    protected $returnType = 'array';

    protected $allowedFields = [
        'departamento'
    ];

    protected $validationRules    = [
        'departamento'        => 'required|alpha_space'
    ];
    protected $validationMessages = [
        'departamento' => [
            'required' => 'El Nombre del Departamento es requerido',
            'alpha_space' => 'El nombre del Departamento no puede contener caracteres especiales ni números'
        ]
    ];
    protected $skipValidation     = false;
}