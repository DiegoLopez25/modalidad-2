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
                    <li class="breadcrumb-item active">Productos</li>
                </ol>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-3 offset-md-9 ">
                <a href="<?= base_url('/producto/addEdit/0');?>" class="btn btn-success float-right"><i class="fas fa-plus"></i> Nuevo <?=$title?></a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Lista Productos</h3>
                    </div>

                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>descripcion</th>
                                    <th>precio</th>
                                    <th>img</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if($productos): ?>
                            <?php foreach($productos as $producto): ?>
                                <tr>
                                    <td><?php echo $producto['id'];?></td>
                                    <td><?php echo $producto['descripcion'];?></td>
                                    <td>$<?php echo $producto['precio'];?></td>
                                    <td><img src="<?php echo $producto['img'];?>" alt="img" class="img-fluid" width="50px"></td>
                                    <td class="project-actions "> 
                                        <a href="<?= base_url('/producto/addEdit/'.$producto['id'])?>" class="btn btn-warning btn-sm"><i class="fa fa-pencil-alt"></i></a>
                                        <a href="<?= base_url('/producto/detalle/'.$producto['id'])?>" class="btn btn-info btn-sm"><i class="fa fa-info"></i></a>
                                        <a data-toggle="modal" data-target="#modal-delete" onclick="seleccionarProductoParaBorrar(<?= $producto['id']?>)" class="btn btn-danger btn-sm"> <i class=" text-white fa fa-trash"></i></a>
                                    </td>
                                </tr>   
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="card-footer clearfix">
                        <div class="row">
                            <div class="col-md-10">
                                <?= $pager->links('default','default_bootstrap');?>
                            </div>
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
                            <form action="<?= base_url("producto/delete");?>" id="frmDelete" method="post">
                                <input type="hidden" id="deleteId" name="id">
                            </form>

                            <p>¿Desea eliminar este <?=$title?> ?</p>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-danger" onclick="borrarProducto()"> <i class="fas fa-trash"></i>S&iacute, Eliminar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>

    function seleccionarProductoParaBorrar(val){
        document.getElementById('deleteId').value = val
    }

    function borrarProducto(){
        document.getElementById('frmDelete').submit()
    }
</script>

<!-- /.content -->
<?= $this->endSection()?>