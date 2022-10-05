<?php
namespace App\Models;

use CodeIgniter\Model;

class TrainingModel extends Model
{
    protected $table      = 'capacitacion';
    protected $primaryKey = 'id_capacitacion';
    protected $returnType = 'array';

    protected $allowedFields = [
        'id_modalidad',
        'id_financiamiento',
        'id_estado_capacitacion',
        'id_empleado',
        'nombre',
        'institucion',
        'fecha_inicio',
        'fecha_final',
        'descripcion',
        'comprobantes',
        'imagenes',
    ];

    protected $validationRules   = [
        'id_modalidad'           => 'required|validateCorrectModality',
        'id_financiamiento'      => 'required|validateCorrectFinancing',
        'id_estado_capacitacion' => 'required|validateCorrectTrainingStatus',
        'id_empleado'            => 'required|validateCorrectEmployee',
        'nombre'                 => 'required|alpha_space',
        'institucion'            => 'required|alpha_space',
        'fecha_inicio'           => 'required|valid_date',
        'fecha_final'            => 'required|valid_date',
        'descripcion'            => 'required|string|min_length[3]',
        'comprobantes'           => 'required|string|min_length[3]|max_length[128]',
        'imagenes'               => 'required|min_length[3]|uploaded[imagenes]|max_size[imagenes,1024]' //este es el bueno
    ];
    protected $validationMessages = [
        'id_modalidad' => [
            'required'    =>'La modalidad de la capacitacion es requerido',
            'validateCorrectModality' => 'Estimado usuario, la modalidad que desea asignar en la capacitacion no existe.'
        ],
        'id_financiamiento' => [
            'required'    =>'La modalidad de la capacitacion es requerido',
            'validateCorrectFinancing' => 'Estimado usuario, el financiamiento que desea asignar en la capacitacion no existe.'
        ],
        'id_estado_capacitacion' => [
            'required'    =>'La modalidad de la capacitacion es requerido',
            'validateCorrectTrainingStatus' => 'Estimado usuario, el estado que desea asignar para la capacitacion no existe.'
        ],
        'id_empleado' => [
            'required'    =>'La modalidad de la capacitacion es requerido',
            'validateCorrectEmployee' => 'Estimado usuario, el empleado que desea asignar en la capacitacion no existe.'
        ],
        'nombre' => [
            'required' => 'El Nombre de la  capacitacion es requerido',
            'alpha_space' => 'El nombre de la  capacitacion no puede contener caracteres especiales ni números'
        ],
        'institucion' => [
            'required' => 'El Nombre de la  institucion  es requerido',
            'alpha_space' => 'El nombre de la  institucion  no puede contener caracteres especiales ni números'
        ],
        'fecha_inicio' => [
            'required' => 'La fecha inicio de la capacitacion es requerido',
            'valid_date' => 'La fecha inicio de la capacitacion no contiene un formao valido [d/m/Y]'
        ],
        'fecha_final' => [
            'required' => 'La fecha final de la capacitacion es requerido',
            'valid_date' => 'La fecha final de la capacitacion no contiene un formao valido [d/m/Y]'
        ],
        'descripcion' => [
            'required' => 'El teléfono del empleado es requerido',
            'min_length[2]' => 'Diguite un minimo de 2 digitos para la descripcion'
        ],
        'comprobantes' => [
            'required' => 'El comprobante de la capacitacion es requerido',
            'min_length[2]' => 'Diguite un minimo de 2 digitos para el comprobante de la capacitacion',
            'max_length[10]' => 'El comprobante de la capacitacion debe de contener un máximo de 128 caracteres'
        ],
        'imagenes' => [
            'required' => 'El campo imagenes de la capacition es requerido',
            'min_length[2]' => 'El nombre del campo imagenes es muy corto'
            // 'uploaded[imagenes]' =>'Nombre erroneo al momento de ser cargado',
            // 'max_size[imagenes,2000]' => 'el archivo es muy pesado, el limite es de 2MB'
        ]
    ];
    protected $skipValidation     = false;
}