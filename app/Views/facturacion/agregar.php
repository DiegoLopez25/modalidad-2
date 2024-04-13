<?= $this->extend('templates/admin_template')?>
<?= $this->section('content')?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
    <a href="/facturacion" class="btn btn-primary mb-4"><i class="fa fa-arrow-left"></i> Regresar a la lista</a>
    
        <div class="row mb-2">
            <div class="col-md-6">
                <h1 class="font-weight-bold">Facturacion</h1>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/dashboard">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="/pedidos">Lista de facturas</a></li>
                    <li class="breadcrumb-item active">Agregar Factura</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="/facturacion/guardar" method="post">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Crear factura</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                            <div class="col-md-4">
                                    <div class="form-group">
                                        <?php date_default_timezone_set('America/El_Salvador'); ?>
                                        <?php $date = date_create(date('Y-m-d')); ?>
                                        <?php $newDate = date_format($date, 'Y-m-d'); ?>
                                        <label>Fecha</label>
                                        <input type="text" name="fecha_factura" id="fecha_factura" class="form-control" value="<?=$newDate?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <?php
                                                            if(isset($productos)){
                                                                echo '<label for="producto">Productos:</label>

                                                                <select value="" name="b_producto_id" id="b_producto_id" class="form-control">
                                                                <option value="">Seleccione...</option>
                                                                ';

                                                                foreach($productos as $producto){
                                                                    echo '<option value="'.$producto["id"].'_'.$producto["precio"].'">'.$producto["descripcion"].'</option>';
                                                                }
                                                                echo '</select>';
                                                            }
                                                            ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>Precio</label>
                                                        <input type="text" name="b_precio" id="b_precio" class="form-control" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>Cantidad</label>
                                                        <input type="text" name="b_cantidad" id="b_cantidad" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>.</label>
                                                        <button type="button" class="btn btn-outline-primary form-control" id="btnAdd">
                                                            Agregar
                                                        </button>
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
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th></th>
                                                            <th></th>
                                                            <th>Subtotal</th>
                                                            <th id="total">$0</th>
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
                        <div class="card-footer">
                            <div id="guardar">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                                <a href="/facturacion/agregar" class="ml-1">Cancelar</a>
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
<script src="<?= base_url();?>assets/plugins/inputmask/jquery.inputmask.bundle.js"></script>
<script>
    $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
        theme: 'bootstrap4'
        })
    });
</script>

<script>
    $('#pedidos').addClass('active')

$('#guardar').hide();


$('#b_producto_id').change(function() {

    $producto = $('#b_producto_id').val().split('_')
    
    let precio = $('#b_precio').val($producto[1])
    console.log(precio)
})

let cont = 0;
let total = 0;
let subtotal = [];

$('#btnAdd').click(function(e) {

    
    var idProducto = $('#b_producto_id').val().split('_');
    var producto = $('#b_producto_id option:selected').text();
    var cantidad = parseFloat($('#b_cantidad').val());
    var precioVenta = parseFloat($('#b_precio').val());

    if (idProducto[0] != '' && precioVenta > 0 && cantidad > 0 ) {	
        subtotal[cont] = cantidad * precioVenta;
        total = total + subtotal[cont];
        var fila = '<tr class="selected" id="fila'+cont+'">';
        fila += '<td><input type="hidden" name="idProducto[]" value="'+idProducto[0]+'"/>'+producto+'</td>';
        fila += '<td><input type="hidden" name="precio[]" class="w-50" value="'+precioVenta+'" readonly/>$'+precioVenta+'</td>';
        fila += '<td><input type="hidden" name="cantidad[]" class="w-50" value="'+cantidad+'" readonly/>'+cantidad+'</td>';
        fila += '<td><input type="hidden" name="subTotal[]" class="w-50" value="'+subtotal[cont].toFixed(2)+'" readonly/>$'+subtotal[cont].toFixed(2)+'</td>';
        fila += '<td><button type="button" class="btn btn-outline-danger" onclick="eliminar('+cont+')"><i class="fas fa-trash"></i></button></td>';
        fila += '</tr>';
        cont++;    
        $('#total').html('$' + total.toFixed(2));
        $('#data').append(fila);
        limpiar();
        evaluar();
    }
});

function evaluar() {
    if (total > 0) {
        $('#guardar').show();
    } else {
        $('#guardar').hide();
    }
}

function eliminar(idFila) {
    total = total - subtotal[idFila];
    $('#total').html('$' + total.toFixed(2));
    $('#fila' + idFila).remove();
    evaluar();
    cont--;
}

function limpiar() {
    $('#b_producto_id').val('');
    $('#b_precio').val('');
    $('#b_cantidad').val('');
}
</script>
<?= $this->endSection();?>