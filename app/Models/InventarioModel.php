<?php

namespace App\Models;
use CodeIgniter\Model;

class InventarioModel extends Model
{
    protected $table      = "tbl_inventario";
    protected $primaryKey = "id";

    protected $useAutoIncrement = true;

    protected $returnType     = "array";

    protected $allowedFields = ["id_producto", "cantidad","fecha"];

    protected $useTimestamps = true;

    protected $createdFields    = "created_at";
    protected $updatedFiedls    ="updated_at";

    protected $validationRules   =[
        'id_producto' => 'required',
        'cantidad' => 'required',
    ];
    protected $validationMessages = [
        "id_producto" => [
            "required" => "El campo producto es obligatorio",
        ],
        "cantidad" => [
            "required" => "El campo cantidad es obligatorio"
        ]
    ];
    protected $skipValidation = false;
}