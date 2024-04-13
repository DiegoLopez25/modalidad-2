<?php

namespace App\Models;
use CodeIgniter\Model;

class DetalleFacturaModel extends Model
{
    protected $table      = "tbl_detalle_factura";
    protected $primaryKey = "id";

    protected $useAutoIncrement = true;

    protected $returnType     = "array";

    protected $allowedFields = ["id_factura", "id_producto","cantidad","subtotal"];

    protected $useTimestamps = true;

    protected $createdFields    = "created_at";
    protected $updatedFiedls    ="updated_at";

    protected $validationRules   =[
        'id_producto' => 'required',
        'cantidad' => 'required',
        'subtotal' => 'required'
    ];
    protected $validationMessages = [
        "id_producto" => [
            "required" => "El campo id_producto es obligatorio"
        ],
        "cantidad" => [
            "required" => "El campo cantidad es obligatorio"
        ],
        "subtotal" => [
            "required" => "El campo subtotal es obligatorio"
        ]
    ];
    protected $skipValidation = false;
}