<?php require 'views/header.php';?>
<div class="car border-success mb-3 mx-auto" style="max-width: 80rem;">
	<section class="wrapper">
		<div class="bg-info p-2 mb-2 text-white shadow rounded"><h4 class="text-center">Formulario de Registro</h4></div>
		<form action="<?php echo constant('URL');?>pilares/registrar" method="POST"> 
		<div class="form-group">
			<div class="form-row">
				
				<div class="col-sm-6">
					<label for="nombre">Nombre del PILARES</label>
					<input type="text" name="nombre" class="form-control" required="true">
				</div>
				<div class="col-sm-6">
                   <label for="fecha">Fecha de Operación</label>
                   <input type="date" class="form-control "id="" name="fecha"  value="0000/00/00">
             	</div>
				
			</div>
			<div class="row">
				<div class="col-sm-12">
					<label for="alcaldia">Alcaldía</label>
					<select class="form-control selecciones" id="alcaldia" name="alcaldia">
						<?php foreach ($this->alcaldias as $a) {
							 echo '<option value="'.$a->id.'">'.$a->nombre.'</option>';
						} ?>
					</select>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<label for="ubicacion">Ubicación</label>
					<textarea class="form-control" name="ubicacion" maxlength="200" required="true"></textarea>
				</div>
			</div>
			
		</div>

    	<div class="form-group row">
	      	<div class="col-sm-12" name="seccion-directores" id="seccion-directores" >
	      		<label for="responsable">Responsable</label>
	      		<select class="custom-select" name="responsable" id="responsable">
	      			<?php foreach ($this->directores as $key ) {?>
	      				<option value="<?php echo $key->id ?>"><?php echo $key->director ?></option>
	      			<?php } ?>
	      		</select>
	      	</div>
    	</div>
		<div class="form-group row">
           	<div class="col-sm-4"></div>	
           	<div class="col-sm-6 mx-auto">	
           		<button type="button" id="" class="btn btn-danger" onclick="cancelaVentanaPilar()"><i class="far fa-times-circle"></i>Cancelar</button>
              <button type="submit" class="btn btn-success"><i class="fas fa-user-edit"></i>Registrar</button>
              <button type="button" id="" class="btn btn-warning" onclick="regresarPilar()"><i class="fas fa-undo"></i>Regresar</button>
           	</div>	
        </div>
		</form>
	</section>
</div>
<?php require 'views/footer.php'?>
<script type="text/javascript">
	$(function () {
  $('select').each(function () {
    $(this).select2({
      theme: 'bootstrap4',
      width: '100%',
      placeholder: $(this).attr('placeholder'),
      allowClear: Boolean($(this).data('allow-clear')),
    });
  });
});
</script>
<script type="text/javascript">
	<?php echo $this->alerta; ?>
</script>
