<?php

namespace App\Models;
use CodeIgniter\Model;

class ProductoModel extends Model
{
    protected $table      = "tbl_producto";
    protected $primaryKey = "id";

    protected $useAutoIncrement = true;

    protected $returnType     = "array";

    protected $allowedFields = ["descripcion", "precio", "img"];

    protected $useTimestamps = true;

    protected $createdFields    = "created_at";
    protected $updatedFiedls    ="updated_at";

    protected $validationRules   =[
        'descripcion' => 'required|min_length[3]|max_length[100]',
        'precio' => 'required',
        'img' => 'required|max_length[200]'
    ];
    protected $validationMessages = [
        "descripcion" => [
            "required" => "El campo descripcion es obligatorio",
        ],
        "precio" => [
            "required" => "El campo precio es obligatorio"
        ],
        "img" => [
            "required" => "El campo imagen es obligatorio"
        ]
    ];
    protected $skipValidation = false;
}