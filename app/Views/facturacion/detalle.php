<?= $this->extend('templates/admin_template')?>
<?= $this->section('content')?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
    <a href="/facturacion" class="btn btn-primary mb-4"><i class="fa fa-arrow-left"></i> Regresar a la lista</a>
    
        <div class="row mb-2">
            <div class="col-md-6">
                <h1 class="font-weight-bold">Detalle Facturacion</h1>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="/facturacion">Lista de facturas</a></li>
                    <li class="breadcrumb-item active">Detalle factura</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="#" method="post">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Crear factura</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Numero de factura</label>
                                                        <input type="text" value="<?= isset($factura['numero_factura']) ? $factura['numero_factura']:null; ?>" name="b_precio" id="b_precio" class="form-control" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Fecha</label>
                                                        <input type="text" name="fecha_factura" id="fecha_factura" class="form-control" value="<?= isset($factura['fecha_factura']) ? $factura['fecha_factura']:null; ?>" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">
                                                Lista de productos 
                                            </h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table text-center">
                                                    <thead>
                                                        <tr>
                                                            <th>Producto</th>
                                                            <th>Precio</th>
                                                            <th>Cantidad</th>
                                                            <th>Subtotal</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="data">
                                                    <?php  $total=0;?>
                                                    <?php if($detallesFactura): ?>
                                                        <?php foreach($detallesFactura as $detalle): ?>
                                                            <tr>
                                                                <td><?php echo $detalle['descripcion'];?></td>
                                                                <td><?php echo $detalle['precio'];?></td>
                                                                <td><?php echo $detalle['cantidad'];?></td>
                                                                <td><?php echo $detalle['subtotal'];?></td>
                                                                <?php $total=+$detalle['subtotal']?>
                                                            </tr>   
                                                            <?php endforeach; ?>
                                                            <?php endif; ?>
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th></th>
                                                            <th></th>
                                                            <th>Total</th>
                                                            <th id="total">$<?php echo $total;?></th>
                                                            <th></th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<?=$this->endSection()?>
<?=$this->section('customJs')?>
<?= $this->endSection();?>