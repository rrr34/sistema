<?php require 'views/header.php';?>
<section>
	 <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-9">
						<h2 >Listado de Colaboradores</b></h2>
					</div>
					<div class="col-sm-3">
						<div class="input-group">
						  <input type="text" class="form-control border border-primary" id="buscador">
						  <div class="input-group-prepend">
						    <span class="input-group-text rounded border border-info" ><i class="fab fa-searchengin"></i></span>
						  </div>
						</div>						
					</div>
	
                </div>
            </div>
				
				<table class="table table-striped table-bordered table-sm"id="table_id_colaboradores">
				  <thead class="thead-secondary">
				    <tr>
				      <th scope="col">Área</th>
				      <th scope="col">Superior</th>
				      <th scope="col">Puesto</th>
				      <th scope="col">Alcaldía</th>
				      <th scope="col">Nombre</th>
				      <th scope="col">Apellido Paterno</th>
					  <th scope="col">Apellido Materno</th>
				      <th scope="col">Acciones</th>
				    </tr>
				  </thead>
				  <tbody>
				         <?php  
				            foreach ($this->lista as $k )
				                {
				                echo '<tr>';
				                   echo '<td>' .$k->area.' </td>';
				                   echo '<td>' .$k->jefe.' </td>';
				                   echo '<td>' .$k->puesto.' </td>';
				                   echo '<td>' .$k->alcaldia.' </td>';
				                   echo '<td>' .$k->nombre.' </td>';
				                   echo '<td>' .$k->apellido_paterno.' </td>';
				                   echo '<td>' .$k->apellido_materno.' </td>';
				                   $this->id=$k->id;?>
				                   <td> <a class="btn btn-warning  btn-sm" href="<?php constant('URL')?>colaboradores/editar/<?php echo $this->id?>" role="button"><i class="fas fa-edit"></i></a>
				                  <!-- <a class="btn btn-danger  btn-sm" href="<?php constant('URL')?>colaboradores/eliminar/<?php echo $this->id?>"  role="button"><i class="fas fa-trash-alt"></i></a>-->
				                   <!--data-toggle="modal" data-target="#verModal"-->
				                   <button type="button" class="btn btn-primary btn-sm" onclick="datoColaborador(<?php echo $this->id ?>)"><i class="far fa-eye"></i></button>
				                   </td>
				                </tr>
				          <?php   }?>
				      
				  </tbody>
				</table>

				<!-- Modal -->
				<div class="modal fade" id="verModalColaboradores" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  <div class="modal-dialog modal-lg" role="document">
				    <div class="modal-content">
				      <div class="modal-header">
				      	
				        <h5 class="modal-title" id="exampleModalLabel">Datos Completos del Colaborador</h5>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>
				      <div class="modal-body">
						<form class="border border-default">
							<div class="form-group">
								<label for="modal_jefe" class="col-form-label">Superior Inmediato:</label>
								<input type="text" class="form-control" id="modal_jefe" disabled="disabled">
							</div>
							<div class="form-group">
								<label for="modal_puesto" class="col-form-label">Puesto:</label>
								<input class="form-control" id="modal_puesto" disabled="disabled">
							</div>
							<div class="row">
								<div class="form-group col-md-6">
									<label for="modal_alcaldia" class="col-form-label">Alcaldía:</label>
									<input class="form-control" id="modal_alcaldia" disabled="disabled">
								</div>
								<div class="form-group col-md-6">
									<label for="modal_nombre" class="col-form-label">Nombre:</label>
									<input class="form-control" id="modal_nombre" disabled="disabled">
								</div>
							</div>
							<div class="row">
								<div class="form-group col-md-6">
									<label for="modal_apellido_p" class="col-form-label">Apellido Paterno:</label>
									<input class="form-control" id="modal_apellido_p" disabled="disabled">
								</div>
								<div class="form-group col-md-6">
									<label for="modal_apellido_m" class="col-form-label">Apellido Materno:</label>
									<input class="form-control" id="modal_apellido_m" disabled="disabled">
								</div>
							</div>
								<div class="row">
									<div class="form-group col-md-6">
										<label for="modal_sexo" class="col-form-label">Sexo:</label>
										<input class="form-control" id="modal_sexo" disabled="disabled">
									</div>
									<div class="form-group col-md-6">
										<label for="modal_alta" class="col-form-label">Fecha de Ingreso:</label>
										<input class="form-control" id="modal_alta" disabled="disabled">
									</div>
								</div>
								<div class="row">
									<div class="form-group col-md-3">
										<label for="modal_sexo" class="col-form-label">Teléfono:</label>
										<input class="form-control" id="modal_telefono" disabled="disabled">
									</div>
									<div class="form-group col-md-5">
									<label for="modal_correo_institucional" class="col-form-label">Correo Institucional:</label>
									<input class="form-control" id="modal_correo_institucional" disabled="disabled">
								</div>
									<div class="form-group col-md-4">
										<label for="modal_alta" class="col-form-label">Correo:</label>
										<input class="form-control" id="modal_correo" disabled="disabled">
									</div>
								</div>
							<div class="row">
								
								<div class="form-group col-md-4">
									<label for="modal_curp" class="col-form-label">CURP:</label>
									<input class="form-control" id="modal_curp" disabled="disabled">
								</div>
								<div class="form-group col-md-4">
									<label for="modal_nacimiento" class="col-form-label">Fecha Nacimiento:</label>
									<input class="form-control" id="modal_nacimiento" disabled="disabled">
								</div>
							
								<div class="form-group col-md-4">
									<label for="modal_edad" class="col-form-label">Edad:</label>
									<input class="form-control" id="modal_edad" disabled="disabled">
								</div>

							</div>
								<div class="row">
									<div class="form-group col-md-6">
										<label for="modal_especialidad" class="col-form-label">Área de Conocimiento:</label>
										<input class="form-control" id="modal_especialidad" disabled="disabled">
									</div>
									<div class="form-group col-md-6">
										<label for="modal_porcentaje" class="col-form-label">Porcentaje de avance:</label>
										<input class="form-control" id="modal_porcentaje" disabled="disabled">
									</div>
								</div>
								<div class="row">
									<div class="form-group col-md-6">
										<label for="modal_documento" class="col-form-label">Documento:</label>
										<input class="form-control" id="modal_documento" disabled="disabled">
									</div>
									<div class="form-group col-md-6">
										<label for="modal_nivel" class="col-form-label">Nivel:</label>
										<input class="form-control" id="modal_nivel" disabled="disabled">
									</div>
								</div>
					        </form>				        
				      </div>
				    </div>
				  </div>
				</div>
			</div>
</div>
</section>
<?php require 'views/footer.php';?>
<script> <?php echo $this->alerta; ?></script>	
