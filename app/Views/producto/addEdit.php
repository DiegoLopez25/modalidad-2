<?= $this->extend('templates/admin_template')?>
<?= $this->section('content')?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
		<a href="/producto" class="btn btn-primary mb-4"><i class="fa fa-arrow-left"></i> Regresar a la lista</a>
			<?php if ($hasValidationErrors): ?>
			<div class="alert alert-warning alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
				<h5><i class="icon fas fa-info"></i>Tiene algunos errores de validacion</h5>
				<ul>
					<?php foreach($errors as $error) :?>
					<li><?= esc($error)?></li>
					<?php endforeach ?>
				</ul>
			</div>
			<?php endif ?>
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
                <h1><?= $title?></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url('')?>">Inicio</a></li>
					<li class="breadcrumb-item"><a href="<?= base_url('/producto')?>">Lista Productos</a></li>
                    <li class="breadcrumb-item active"><?= $title?></li>
                </ol>
            </div>
            <div class="col-md-12 mt-3">
				<form action="<?=base_url('producto/addEdit/'.$producto['id']); ?>" autocomplete="true" method="post" id="frmproducto" enctype="multipart/form-data">
					<div class="card card-outline card-<?= $color?>">
						<div class="card-header">
							<h3 class="card-title"><?= $title?></h3>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="">descripcion:</label>
										<input value="<?= isset($producto['descripcion']) ? $producto['descripcion']:null; ?>" type="text" name="descripcion" id="descripcion" class="form-control">
									</div>
									<div class="form-group">
										<input type="hidden" name="id" id="id" value="<?= $producto['id']?>" class="form-control">
									</div>
									<div class="form-group">
										<label for="exampleInputFile">Imagen</label>
										<div class="input-group">
											<div class="custom-file">
												<input name="img" type="file" class="custom-file-input" id="exampleInputFile">
												<label class="custom-file-label" for="exampleInputFile">Choose file</label>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									
									<div class="form-group">
										<label for="precio">Precio:</label>
										<input value="<?= isset($producto['precio']) ? $producto['precio']:null; ?>" type="number" step="0.01" max="500" name="precio" id="precio" class="form-control">
									</div>	
								</div>
							</div>
						</div>
						<div class="card-footer">
							<button type="submit" id="btnGuardar" onclick="sendForm()" class=" btn btn-<?= $color?>">
							<i class="<?= $icono?>"></i> <?= $accion?> 
							</button>
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
  bsCustomFileInput.init();
});
</script>
<?= $this->endSection();?>