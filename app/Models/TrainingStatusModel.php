<?php
namespace App\Models;

use CodeIgniter\Model;

class TrainingStatusModel extends Model
{
    protected $table      = ' estado_capacitacion';
    protected $primaryKey = 'id_estado_capacitacion';
    protected $returnType = 'array';

    protected $allowedFields = [
        'estado_capacitacion'
    ];

    protected $validationRules    = [
        'estado_capacitacion'        => 'required|alpha_space'
    ];
    protected $validationMessages = [
        'estado_capacitacion' => [
            'required' => 'El Nombre del  estado_capacitacion es requerido',
            'alpha_space' => 'El nombre del  estado_capacitacion  no puede contener caracteres especiales ni números'
        ]
    ];
    protected $skipValidation     = false;
}