<?php

namespace App\Controllers;
use App\Models\FacturaModel;
use App\Models\ProductoModel;
use App\Models\inventarioModel;
use App\Models\DetalleFacturaModel;

class FacturacionController extends BaseController
{
    protected FacturaModel $model;
    protected InventarioModel $modelInventario;
    protected ProductoModel $modelProducto;
    protected DetalleFacturaModel $modelDetalleFactura;
    public function __construct()
    {
        $this->model = new FacturaModel();
        $this->modelProducto = new ProductoModel();
        $this->modelInventario = new InventarioModel();
        $this->modelDetalleFactura = new DetalleFacturaModel();
    }
    public function index()
    {
        $facturas = $this->model->findAll();
        $data=[
            'facturas'=>$facturas,
            'title'=>'factura',
        ];
        return view('facturacion/index',$data);
    }

    public function form()
    {
        $productos = $this->modelProducto->findAll();
        $data=[
            "productos" => $productos
        ];
        
      //$ultimaFactura= $this->model->query("select max(numero_factura) from tbl_factura")->getResult();

            return view('facturacion/agregar',$data);
    }

    public function guardar(){
        $request = $this->request->getPost();
        $fecha_factura=$this->request->getPost("fecha_factura");
        //Generar numero de factura
        $ultimaFacturaRegistrada= $this->model->query("select max(numero_factura) as numero from tbl_factura")->getResult();
        $ultimaFactura = json_decode(json_encode($ultimaFacturaRegistrada),true)[0];
        $factura = [
            'fecha_factura'=>$fecha_factura,
            'numero_factura'=>$ultimaFactura['numero']+1
        ];
       

        if($this->model->insert($factura)){
            //ver  id de factura
            $ultimaFacturaRegistrada= $this->model->query("select max(id) as idFactura from tbl_factura")->getResult();
            $id = json_decode(json_encode($ultimaFacturaRegistrada),true)[0];

            $idFactura = $id['idFactura'];
            $idProducto = $this->request->getPost("idProducto");
            $precioVenta = $this->request->getPost("precio");
            $cantidad = $this->request->getPost("cantidad");
            $subTotal = $this->request->getPost("subTotal");

            $i=0;

            while($i<count($idProducto)){
                $detalleFactura = [
                    "id_factura"=>$idFactura,
                    "id_producto"=>$idProducto[$i],
                    "cantidad"=>$cantidad[$i],
                    "subtotal"=>$subTotal[$i]
                ];
                //descontar inventario al hacer facturacion
                $stock = json_decode(json_encode($this->modelInventario->query("select cantidad from tbl_inventario where id_producto=".$idProducto[$i])->getResult()),true)[0]; ;
                $idP=$idProducto[$i];
                $cantidad = $stock['cantidad']-$cantidad[$i];
                $inventario["cantidad"] =$cantidad;
                $idInventario = $this->modelInventario->select()->where('id_producto',$idProducto[$i])->first();
                $this->modelInventario->update($idInventario['id'],$inventario);
                $this->modelDetalleFactura->insert($detalleFactura);
                $i++;
            }
            $alertType = 'alert-success';
                        $alertTitle ='facturacion Registrada';
                        $alertMessage = 'Los datos del producto han sido registrados exitosamente';
    
                            return redirect()->to('facturacion/'.$id)
                            ->with('alert-type',$alertType)
                            ->with('alert-title',$alertTitle)
                            ->with('alert-message',$alertMessage);
        }

        
    }

    public function detalle($id){
        $factura = $this->model->find($id);

        // empleados que recibieron la capacitacion
        $db = db_connect();
        $builder = $db->table('tbl_detalle_factura as df');
        $builder->select('
            df.id,
            p.descripcion,
            p.precio,
            df.cantidad,
            df.subtotal,
        ');
        $builder->join('tbl_producto as p', 'df.id_producto = p.id', 'inner');
        $builder->where('id_factura', $id);
        $query = $builder->get();
        $detallesFactura = $query->getResult();
        $data=[
            "factura"=>$factura,
            "detallesFactura"=>json_decode(json_encode($detallesFactura),true)
        ];
        return view('facturacion/detalle',$data);
    }
}