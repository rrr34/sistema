<?php require 'views/header.php'?>
<section>
	 <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-5">
						<h2 ><b>Listado Brigadas 333</b></h2>
					</div>
					<div class="col-sm-4"></div>
					
					<div class="col-sm-3">
						<div class="input-group">
						  <input type="text" class="form-control" id="pilaresBuscador">
						  <div class="input-group-prepend">
						    <span class="input-group-text" ><i class="fab fa-searchengin"></i></span>
						  </div>
						</div>
						</div>				
					</div>
                </div>
           
				
				<table class="table table-striped table-bordered table-sm"id="pilares" cellspacing="0" width="100%">
				  <thead class="thead-secondary">
				    <tr>
				      <th scope="col">Subdirección</th>
				      <th scope="col">Brigada</th>
				      <th scope="col">Alcaldía</th>
				      <th scope="col">Ubicación</th>
				      <th scope="col">Responsable</th>
				      <th scope="col">Fecha de Operación</th>
				      <th scope="col">Acciones</th>
				    </tr>
				  </thead>
				  <tbody>
				         <?php  
				            foreach ($this->valores as $k )
				                {
				                echo '<tr>';
				               	   echo '<td>' .$k->sub.' </td>';
				                   echo '<td>' .$k->nombre.' </td>';
				                   echo '<td>' .$k->alcaldia.' </td>';
				                   echo '<td>' .$k->ubicacion.' </td>';
				                   echo '<td>' .$k->director.' </td>';
				                   echo '<td>' .$k->fecha.' </td>';
				                   $this->id=$k->id;?>
				                   <td> <a class="btn btn-warning  btn-sm" href="<?php constant('URL')?>pilares/editar/<?php echo $this->id?>" role="button"><i class="fas fa-edit"></i></a>
				                   <!--<a class="btn btn-danger  btn-sm" href="<?php constant('URL')?>pilares/eliminar/<?php echo $this->id?>"  role="button"><i class="fas fa-trash-alt"></i></a> -->
				                 
				                   </td>
				                </tr>
				          <?php   }?>
				      
				  </tbody>
				</table>

				
</div>
</section>
<?php require 'views/footer.php'?>
<script type="text/javascript">
	<?php echo $this->alerta; ?>
</script>