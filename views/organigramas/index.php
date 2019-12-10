<?php require 'views/header.php';?>
<section >
		
	 <div class="table-wrap">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-9">
						<h2><b>Organigrama</b></h2>
					</div>
					<div class="col-sm-3">
						<div class="input-group">
						  <input type="text" class="form-control border border-primary" id="buscador_organigrama">
						  <div class="input-group-prepend">
						    <span class="input-group-text rounded border border-info" ><i class="fab fa-searchengin"></i></span>
						  </div>
						</div>	
					</div>
                </div>
            </div>

		<div class="row" hidden="true">
		  <div class="col-md-12">
		    <h4>Plazas pendientes por LCPs</h4>
		    <table class="table table-condensed table-bordered table-hover">
		      <thead>
		        <tr class="info">
		          <?php foreach ($this->pilares as $key): ?>
		          	<th><?php echo $key->nombre ?></th>
		          <?php endforeach ?>
		        </tr>
		      </thead>
		      <tbody>
		        <tr>
		         <?php foreach ($this->pilares as $key): ?>
		          	<td><?php echo $key->autorizado ?></td>
		          <?php endforeach ?>
		        </tr>
		       </tbody>
		    </table>
		</div>
	</div>
            
				<table class="table table-striped table-bordered table-sm"id="tabla_organigrama">
				  <thead class="thead-secondary justify-content-center">
				    <tr>
				      <th scope="col">Estructura Orgánica</th>
				      <th scope="col">Cantidad</th>
				    </tr>
				  </thead>
				  <tbody>
				         <?php 
				            foreach ($this->datos as $k )
				                {
									echo '<tr>';
									echo '<td>' .$k->text.' </td>';
									echo '<td>' .$k->cantidad.' </td>';
									echo '</tr>';
								}?>
				      
				  </tbody>
				</table>
			
			</div>
</div>
</section>
<?php require 'views/footer.php';?>