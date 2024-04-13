<?php

namespace App\Models;
use CodeIgniter\Model;

class FacturaModel extends Model
{
    protected $table      = "tbl_factura";
    protected $primaryKey = "id";

    protected $useAutoIncrement = true;

    protected $returnType     = "array";

    protected $allowedFields = ["fecha_factura", "numero_factura"];

    protected $useTimestamps = true;

    protected $createdFields    = "created_at";
    protected $updatedFiedls    ="updated_at";

    protected $validationRules   =[
        'numero_factura' => 'required',
        'fecha_factura' => 'required'
    ];
    protected $validationMessages = [
        "fecha_factura" => [
            "required" => "El campo descripcion es obligatorio",
        ],
        "numero_factura" => [
            "required" => "El campo precio es obligatorio"
        ]
    ];
    protected $skipValidation = false;
}