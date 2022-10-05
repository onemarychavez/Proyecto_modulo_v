<?php
namespace App\Models;

use CodeIgniter\Model;

class FinancingModel extends Model
{
    protected $table      = 'financiamiento';
    protected $primaryKey = 'id_financiamiento';
    protected $returnType = 'array';

    protected $allowedFields = [
        'financiamiento'
    ];

    protected $validationRules    = [
        'financiamiento'        => 'required|alpha_space'
    ];
    protected $validationMessages = [
        'financiamiento' => [
            'required' => 'El Nombre del  financiamiento  es requerido',
            'alpha_space' => 'El nombre del  financiamiento  no puede contener caracteres especiales ni números'
        ]
    ];
    protected $skipValidation     = false;
}