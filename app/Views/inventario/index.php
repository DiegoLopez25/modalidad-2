<?= $this->extend('templates/admin_template')?>
<?= $this->section('content')?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <?php if (session()->getFlashdata('alert-type')): ?>
          <div class="col-12 mt-2">
            <div class="alert <?= session()->getFlashdata('alert-type'); ?> alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                <h5><i class="icon fas fa-info"></i><?= session()->getFlashdata('alert-title'); ?></h5>
                <?= session()->getFlashdata('alert-message'); ?>
            </div>
            <?php endif ?>
          </div>
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Lista <?=$title?></h1>
            </div>
            
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                    <li class="breadcrumb-item active">Inventarios</li>
                </ol>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-3 offset-md-9 ">
                <a href="<?= base_url('/inventario/registrar');?>" class="btn btn-success float-right"><i class="fas fa-plus"></i> Nuevo <?=$title?></a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Lista <?=$title?></h3>
                    </div>

                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>producto</th>
                                    <th>stock</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if($inventarios): ?>
                            <?php foreach($inventarios as $inventario): ?>
                                <tr>
                                    <td><?php echo $inventario['id'];?></td>
                                    <td><?php echo $inventario['descripcion'];?></td>
                                    <td><?php echo $inventario['cantidad'];?></td>
                                    <td class="project-actions "> 
                                        <a data-toggle="modal" data-target="#modal-agregar" onclick="seleccionarInventarioParaAgregar(<?= $inventario['id']?>)" class="btn btn-success btn-sm"><i class="fas fa-plus"></i></a>
                                        <a data-toggle="modal" data-target="#modal-editar" onclick="seleccionarInventarioParaEditar(<?= $inventario['id']?>,<?= $inventario['cantidad']?>)" class="btn btn-warning btn-sm"><i class="fa fa-pencil-alt"></i></a>
                                        <a data-toggle="modal" data-target="#modal-delete" onclick="seleccionarInventarioParaBorrar(<?= $inventario['id']?>)" class="btn btn-danger btn-sm"> <i class=" text-white fa fa-trash"></i></a>
                                    </td>
                                </tr>   
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="modal-editar" style="display: none;" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-warning">
                            <h4 class="modal-title">Editar <?=$title?></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="close">
                                <span aria-hidden="true"></span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="<?= base_url("inventario/editar");?>" id="frmEditar" method="post">
                                <input type="hidden" id="editarId" name="id">
                                <div class="form-group">
                                    <label for="">Cantidad</label>
                                    <input class="form-control" id="cantidadId" type="number" name="cantidad"> 
                                </div>
                                
                            </form>

                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-warning" onclick="editarInventario()">actualizar <i class="fas fa-pencil-alt"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="modal-agregar" style="display: none;" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-success">
                            <h4 class="modal-title">Agregar <?=$title?></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="close">
                                <span aria-hidden="true"></span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="<?= base_url("inventario/agregar");?>" id="frmAgregar" method="post">
                                <input type="hidden" id="agregarId" name="id">
                                <div class="form-group">
                                    <label for="">Cantidad</label>
                                    <input class="form-control" type="number" name="cantidad"> 
                                </div>
                                
                            </form>

                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-success" onclick="agregarInventario()">agregar <i class="fas fa-plus"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="modal-delete" style="display: none;" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-danger">
                            <h4 class="modal-title">Eliminar <?=$title?></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="close">
                                <span aria-hidden="true"></span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="<?= base_url("inventario/eliminar");?>" id="frmDelete" method="post">
                                <input type="hidden" id="deleteId" name="id">
                            </form>

                            <p>¿Desea eliminar este <?=$title?> ?</p>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-danger" onclick="borrarInventario()"> <i class="fas fa-trash"></i>S&iacute, Eliminar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    function seleccionarInventarioParaEditar(id,cantidad){
        document.getElementById('editarId').value = id
        document.getElementById('cantidadId').value = cantidad
    }

    function editarInventario(){
        document.getElementById('frmEditar').submit()
    }

function seleccionarInventarioParaAgregar(val){
        document.getElementById('agregarId').value = val
    }

    function agregarInventario(){
        document.getElementById('frmAgregar').submit()
    }

    function seleccionarInventarioParaBorrar(val){
        document.getElementById('deleteId').value = val
    }

    function borrarInventario(){
        document.getElementById('frmDelete').submit()
    }
</script>

<!-- /.content -->
<?= $this->endSection()?>