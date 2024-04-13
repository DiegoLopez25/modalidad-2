<?php
namespace App\Controllers;
use App\Models\ProductoModel;


class ProductoController extends BaseController
{
    protected ProductoModel $model;

    public function __construct()
    {
        $this->model = new ProductoModel();
    }
    //Lista productos
    public function index()
    {
        $pageSize = $this->request->getVar('pageSize') ?? 5;
        $page = $this->request->getVar('page') ?? 1;

        $productos = $this->model->paginate($pageSize,'default',$page);
         
        

        $data=[
            'productos'=>$productos,
            'pager'=>$this->model->pager,
            'title'=>'Producto',
            'currentPageSize'=>$pageSize
        ];
        return view('producto/index',$data);
    }

    //Agregar Editar productos
    public function addEdit($id = 0){

            $method = $this->request->getMethod();

        if($id == 0):
        $title = "Nuevo Producto";
        $producto = ["id" => 0];
        $color ="success";
        $accion = "Guardar";
        $icono = "far fa-save";
        $hasValidationErrors= "";
        else:
            $title = "Editar Producto";
            $producto = $this->model->find($id); 
            $color ="warning"; 
            $accion ="Actualizar";  
            $icono = "fa fa-pencil-alt";
            $hasValidationErrors= "";
        endif;
        switch($method):
            case 'GET':
                $data=[
                    'producto'=>$producto,
                    'title'=>$title,
                    'color'=>$color,
                    'accion'=>$accion,
                    'icono'=>$icono,
                    'hasValidationErrors' => $hasValidationErrors
                ];
                return view('producto/addEdit',$data);
                break;
            case 'POST':
                $request = $this->request->getPost();

                if($id == 0):
                    $producto = $request;  
                    $num = rand(1,10000);

                    $imgNombre = $num.$_FILES["img"]["name"];
                    $temp = $_FILES['img']['tmp_name'];
                    $url = base_url()."img/productos/".$imgNombre;
                    move_uploaded_file($temp,"../public/img/productos/".$imgNombre);
                    $producto['img'] = $url ;
                    
                    if($this->model->insert($producto) === false):
                        $data=[
                            'producto'=>$producto,
                            'title'=>$title,
                            'errors'=>$this->model->errors(),
                            'hasValidationErrors'=>true,
                            'title'=>$title,
                            'color'=>$color,
                            'accion'=>$accion,
                            'icono'=>$icono
                        ];
                        return view('producto/addEdit',$data);
                    else:
                        $alertType = $id == 0 ? 'alert-success':'alert-warning';
                        $alertTitle = $id == 0 ? 'producto Registrado':'producto Actualizado';
                        $alertMessage = $id == 0 ? 'Los datos del producto han sido registrados exitosamente':'Los datos del producto han sido actualizados exitosamente';
    
                            return redirect()->to('/producto/addEdit/0')
                            ->with('alert-type',$alertType)
                            ->with('alert-title',$alertTitle)
                            ->with('alert-message',$alertMessage);
                    endif;
                else:
                    //en caso de existir id es actualizar
                    $producto['id'] = $request['id'];
                    $producto['descripcion'] = $request['descripcion'];
                    $producto['precio'] = $request['precio'];

                    $num = rand(1,10000);
                    $imgNombre = $num.$_FILES["img"]["name"];
                    $temp = $_FILES['img']['tmp_name'];
                    $url = base_url()."img/productos/".$num.$imgNombre;
                    move_uploaded_file($temp,"../public/img/productos/".$num.$imgNombre);
                    $producto['img'] = $url ;

                    if($this->model->update($id,$producto) === false):
                        $data=[
                            'producto'=>$producto,
                            'title'=>$title,
                            'errors'=>$this->model->errors(),
                            'hasValidationErrors'=>true,
                            'title'=>$title,
                            'color'=>$color,
                            'accion'=>$accion,
                            'icono'=>$icono
                        ];
                        return view('producto/addEdit',$data);
                    else:
                        $alertType = $id == 0 ? 'alert-success':'alert-warning';
                        $alertTitle = $id == 0 ? 'producto Registrado':'producto Actualizado';
                        $alertMessage = $id == 0 ? 'Los datos del producto han sido registrados exitosamente':'Los datos del producto han sido actualizados exitosamente';
    
                            return redirect()->to('/producto/addEdit/'.$id)
                            ->with('alert-type',$alertType)
                            ->with('alert-title',$alertTitle)
                            ->with('alert-message',$alertMessage);
                    endif;
                endif;

                
            break;
        endswitch;
    }
    
    //Eliminar Productos
    public function delete(){
        $request = $this->request->getPost();
        $id = $request['id'];

        $producto =  $this->model->find($id);

        if(isset($producto)):
            if($this->model->delete($id)):
                $alertType = 'alert-danger';
                $alertTitle = 'producto Eliminado';
                $alertMessage = 'Los datos del producto han sido eliminados exitosamente';
            else:
                $alertType = 'alert-warning';
                $alertTitle = 'producto no fue Eliminado';
                $alertMessage = 'El producto fue eliminado, intente nuevamente';
            endif;
        else: 
            $alertType = 'alert-warning';
            $alertTitle = 'producto no valido';
            $alertMessage = 'El producto que intenta eliminar no existe';
        endif;

        return redirect()->to('/producto')
               ->with('alert-type',$alertType)
               ->with('alert-title',$alertTitle)
               ->with('alert-message',$alertMessage);
   }

   //Detalle productos
   public function detalle($id){
    $title = "Detalle Producto";
    $producto = $this->model->find($id); 
    $color ="primary";  
    $icono = "fa fa-info";
    $data=[
        'producto'=>$producto,
        'title'=>$title,
        'color'=>$color,
    ];
    return view('producto/detalle',$data);
   }
}
