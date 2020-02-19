<?php require 'views/header.php';?>
<section >
<div class="row wrap">
	<div class="row">
		<div class="col">
			  <button class="btn btn-warning" type="button" data-toggle="collapse" data-target="#multiCollapseExample1" aria-expanded="false" aria-controls="multiCollapseExample1"><i class="fas fa-search-plus"></i>Realizar una Búsqueda General</button>
		</div>
	</div>
	<div class="row">
		<div class="col-12">
		    <div class="collapse card" id="multiCollapseExample1">
		      	<div class="card card-body">
		      		<div class="row">
		      		<form action="<?php echo constant('URL');?>principal/buscar" method="POST">
		       		<div class="row">
						<div class="form-group col-md-6">
					    <input type="text"  id="" placeholder="Área" class="form-control"name="area">
					  	</div>
					  	<div class="form-group col-md-6">
					    <input type="text" class="form-control" id="" placeholder="Puesto" name="puesto">
					  	</div>
					</div>
				 	<div class="row">
					  	<div class="form-group col-md-3">
					    <input type="text" class="form-control" id="" placeholder="Alcaldía" name="alcaldia">
					  	</div>
					  	<div class="form-group col-md-3">
					    <input type="text" class="form-control" id="" placeholder="Nombre" name="nombre">
					  	</div>
					  	<div class="form-group col-md-3">
					    <input type="text" class="form-control" id="" placeholder="Apellido Paterno" name="apellido_paterno">
					  	</div>
					  	<div class="form-group col-md-3">
					    <input type="text" class="form-control" id="" placeholder="Apellido Materno" name="apellido_materno">
					  	</div>
					</div>
				 	<div class="row">
					  <div class="form-group col-md-2">
					    <input type="text" class="form-control" id="" placeholder="Sexo" name="sexo">
					  </div>
					  	<div class="form-group col-md-1">
						  <button type="submit" class="btn btn-primary ml-auto"><i class="fas fa-search-plus"></i></button>
						</div>
					</div>
					</form>
					</div>	
		      	</div>
		    </div>
		</div>
	</div>
</div>	

<div class="table-wrap">
    <div class="table-title">
        <div class="row">
            <div class="col-sm-6">
				<h2><b>Listado General</b></h2>
			</div>
			<div class="col-sm-2">
				<button type="button" class="btn btn-info float-right" onclick="crearExcel()"><i class="fas fa-file-excel "></i> Reporte</button>
			</div>		
			<div class="col-sm-2" id="botonExcel" hidden=true>
				<form action="<?php echo constant('URL');?>principal/generarExcel" method="post">
					<?php foreach ($this->datos as $key) {?>
					<input type="checkbox" checked="true" name="datos[]"  value="<?php echo $key->id ?>" hidden="true">
					<?php	}?>
					<button type="submit" class="btn btn-danger float-right"  id="generar"><i class="far fa-file-excel" ></i> Búsqueda</button>
				</form>
			</div>
			<div class="col-sm-2">
				<button type="button" class="btn btn-success " onclick="regresaVentanaPrincipal()"><i class="fas fa-redo "></i>Limpiar</button>
			</div>		
        </div>
    </div>
			
	<table class="table table-striped table-bordered table-sm"id="table_general">
		<thead class="thead-secondary">
		    <tr>
		      <th scope="col">Área</th>
		      <th scope="col">Superior</th>
		      <th scope="col">Puesto</th>
		      <th scope="col">Alcaldía</th>
		      <th scope="col">Nombre</th>
		      <th scope="col">Apellido Paterno</th>
			  <th scope="col">Apellido Materno</th>
		      <th scope="col">Sexo</th>
		    </tr>
		</thead>
		<tbody>
        <?php  
		    if(!empty($this->datos)){
		        foreach ($this->datos as $k )
	            {
					echo '<tr>';
					echo '<td>' .$k->area.' </td>';
					echo '<td>' .$k->jefe.' </td>';
					echo '<td>' .$k->puesto.' </td>';
					echo '<td>' .$k->alcaldia.' </td>';
					echo '<td>' .$k->nombre.' </td>';
					echo '<td>' .$k->apellido_paterno.' </td>';
					echo '<td>' .$k->apellido_materno.' </td>';
					echo '<td>' .$k->sexo.' </td>';
					echo '</tr>';}}?>
		      
		</tbody>
	</table>
		
</div>
</div>
</section>
<?php require 'views/footer.php';?>
<script type="text/javascript">
	<?php echo $this->alerta; ?>
</script>
<script type="text/javascript">
	$(document).ready(function() {	
	<?php if($this->excel){?>
		 $("#botonExcel").prop('hidden', false);

	<?php } ?>
	 });
</script>
