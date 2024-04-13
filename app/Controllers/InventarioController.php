<?php

namespace App\Controllers;
use App\Models\InventarioModel;
use App\Models\ProductoModel;
class InventarioController extends BaseController
{
    protected ProductoModel $modelProducto;
    protected InventarioModel $model;
    public function __construct()
    {
        $this->model = new InventarioModel();
        $this->modelProducto = new ProductoModel();
    }
    public function index(){
         
        $db = db_connect();
            $builder = $db->table('tbl_inventario as i');
            $builder->select('
                i.id,
                p.descripcion,
                i.cantidad
            ');
            $builder->join('tbl_producto as p', 'i.id_producto = p.id', 'inner');
            $query = $builder->get();
            $result = $query->getResult();
            $inventario = $result;

        $data=[
            'inventarios'=>json_decode(json_encode($inventario),true),
            'title'=>'Inventario',
        ];
        return view('inventario/index',$data);
    }

    public function agregar(){
            $cantidad = $this->request->getPost('cantidad');
            $id = $this->request->getPost('id');

            $cantidadAnterior=$this->model->find($id);
            $inventario =[
                "cantidad" => $cantidadAnterior['cantidad']+$cantidad,
            ];


            if($this->model->update($id,$inventario) === false):
                $data=[
                    'inventario'=>$inventario,
                    'errors'=>$this->model->errors(),
                    'hasValidationErrors'=>true,
                ];
                return view('inventario/index',$data);
            else:
                $alertType = $id == 0 ? 'alert-success':'alert-warning';
                $alertTitle = $id == 0 ? 'inventario registrado':'inventario actualizado';
                $alertMessage = $id == 0 ? 'Los datos del inventario han sido agregados exitosamente':'Los datos del inventario han sido actualizados exitosamente';

                    return redirect()->to('/inventario')
                    ->with('alert-type',$alertType)
                    ->with('alert-title',$alertTitle)
                    ->with('alert-message',$alertMessage);
            endif;
    }

    public function editar(){
        $cantidad = $this->request->getPost('cantidad');
            $id = $this->request->getPost('id');
            $inventario =[
                "cantidad" => $cantidad,
            ];

            if($this->model->update($id,$inventario) === false):
                $data=[
                    'inventario'=>$inventario,
                    'errors'=>$this->model->errors(),
                    'hasValidationErrors'=>true,
                ];
                return view('inventario/index',$data);
            else:
                $alertType = $id == 0 ? 'alert-success':'alert-warning';
                $alertTitle = $id == 0 ? 'inventario registrado':'inventario actualizado';
                $alertMessage = $id == 0 ? 'Los datos del inventario han sido agregados exitosamente':'Los datos del inventario han sido actualizados exitosamente';

                    return redirect()->to('/inventario')
                    ->with('alert-type',$alertType)
                    ->with('alert-title',$alertTitle)
                    ->with('alert-message',$alertMessage);
            endif;
    }

    public function eliminar(){   
        $request = $this->request->getPost();
        $id = $request['id'];

        $inventario =  $this->model->find($id);

        if(isset($inventario)):
            if($this->model->delete($id)):
                $alertType = 'alert-danger';
                $alertTitle = 'inventario Eliminado';
                $alertMessage = 'Los datos del inventario han sido eliminados exitosamente';
            else:
                $alertType = 'alert-warning';
                $alertTitle = 'inventario no fue Eliminado';
                $alertMessage = 'El inventario fue eliminado, intente nuevamente';
            endif;
        else: 
            $alertType = 'alert-warning';
            $alertTitle = 'inventario no valido';
            $alertMessage = 'El inventario que intenta eliminar no existe';
        endif;

        return redirect()->to('/inventario')
               ->with('alert-type',$alertType)
               ->with('alert-title',$alertTitle)
               ->with('alert-message',$alertMessage);
    }

    public function registrar(){
            $cantidad = $this->request->getPost('cantidad');
            $id_producto = $this->request->getPost('id_producto');
            $existe = $this->model->where("id_producto",$id_producto)->first();
            if($existe){
                $alertType = 'alert-warning';
                $alertTitle = 'inventario ';
                $alertMessage = 'Este producto ya esta registrado en el inventario seleccione otro producto';

                    return redirect()->to('/inventario/registrar')
                    ->with('alert-type',$alertType)
                    ->with('alert-title',$alertTitle)
                    ->with('alert-message',$alertMessage);
            }

            $inventario =[
                "cantidad" => $cantidad,
                "id_producto"=> $id_producto
            ];


            if($this->model->insert($inventario) === false):
                $data=[
                    'inventario'=>$inventario,
                    'errors'=>$this->model->errors(),
                    'hasValidationErrors'=>true,
                ];
                return view('inventario/index',$data);
            else:
                $alertType = 'alert-success';
                $alertTitle = 'inventario registrado';
                $alertMessage = 'Los datos del inventario han sido agregados exitosamente';

                    return redirect()->to('/inventario/registrar')
                    ->with('alert-type',$alertType)
                    ->with('alert-title',$alertTitle)
                    ->with('alert-message',$alertMessage);
            endif;
    }

    public function form(){
        $title = "Nuevo Producto";
        $producto = ["id" => 0];
        $color ="success";
        $accion = "Guardar";
        $icono = "far fa-save";
        $hasValidationErrors= "";
        $productos = $this->modelProducto->findAll();

        $data=[
            'productos'=>$productos,
            'title'=>$title,
            'color'=>$color,
            'accion'=>$accion,
            'icono'=>$icono,
            'hasValidationErrors' => $hasValidationErrors
        ];

        return view('inventario/registrar',$data);
    }

}