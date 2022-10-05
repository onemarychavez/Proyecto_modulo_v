<?php
namespace App\Models;

use CodeIgniter\Model;

class ModalityModel extends Model
{
    protected $table      = 'modalidad';
    protected $primaryKey = 'id_modalidad';
    protected $returnType = 'array';

    protected $allowedFields = [
        'modalidad'
    ];

    protected $validationRules    = [
        'modalidad'        => 'required|alpha_space'
    ];
    protected $validationMessages = [
        'modalidad' => [
            'required' => 'El Nombre de la  modalidad  es requerido',
            'alpha_space' => 'El nombre de la  modalidad  no puede contener caracteres especiales ni números'
        ]
    ];
    protected $skipValidation     = false;
}