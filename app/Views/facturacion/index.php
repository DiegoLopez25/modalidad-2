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
                    <li class="breadcrumb-item active">facturacion</li>
                </ol>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-3 offset-md-9 ">
                <a href="<?= base_url('/facturacion/agregar');?>" class="btn btn-success float-right"><i class="fas fa-plus"></i> Nuevo <?=$title?></a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Lista facturas</h3>
                    </div>

                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>fecha </th>
                                    <th>numero de factura</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if($facturas): ?>
                            <?php foreach($facturas as $factura): ?>
                                <tr>
                                    <td><?php echo $factura['id'];?></td>
                                    <td><?php echo $factura['fecha_factura'];?></td>
                                    <td><?php echo $factura['numero_factura'];?></td>
                                    <td class="project-actions "> 
                                        <a href="<?= base_url('/facturacion/detalle/'.$factura['id'])?>" class="btn btn-info btn-sm"><i class="fa fa-info"></i></a>
                                    </td>
                                </tr>   
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<script>

</script>

<!-- /.content -->
<?= $this->endSection()?>