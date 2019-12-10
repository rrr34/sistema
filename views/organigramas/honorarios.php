<?php require 'views/header.php';?>
<section >
		
	 <div class="table-wrap">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-9">
						<h2><b>Honorarios</b></h2>
					</div>
					<div class="col-sm-3">
						<div class="input-group">
						  <input type="text" class="form-control border border-primary" id="buscador_honorarios">
						  <div class="input-group-prepend">
						    <span class="input-group-text rounded border border-info" ><i class="fab fa-searchengin"></i></span>
						  </div>
						</div>	
					</div>
                </div>
            </div>
            <div>	
            	 <table class="table table-striped table-bordered table-sm"id="">
				  <thead class="thead-secondary ">
				    <tr class="table-danger"><th><b>Plazas pendientes por asignar</b></th></tr>
				  </thead>
				  <tbody>
				  	<tr>
				      <th scope="col">Tipo</th>
				      <th scope="col">Cantidad</th>
				      <th scope="col">Tipo</th>
				      <th scope="col">Cantidad</th>
				      <th scope="col">Tipo</th>
				      <th scope="col">Cantidad</th>
				      <th scope="col">Tipo</th>
				      <th scope="col">Cantidad</th>
				      <th scope="col">Tipo</th>
				      <th scope="col">Cantidad</th>
				    </tr>
				         <tr >
				         	<td ><b>Honorario 0</b></td>
								<td><b><?php echo $this->datos0->total ?></b></td>
								<td ><b>Honorario A</b></td>
								<td><b><?php echo $this->datosA->total ?></b></td>
								<td ><b>Honorario B</b></td>
								<td><b><?php echo $this->datosB->total ?></b></td>
								<td ><b>Honorario C</b></td>
								<td><b><?php echo $this->datosC->total ?></b></td>
								<td ><b>Honorario D</b></td>
								<td><b><?php echo $this->datosD->total ?></b></td>
						</tr>
							
				  </tbody>
				</table>
            </div>
           
				<div class="row">
					<div class="col-sm-6">
						<table class="table table-striped table-bordered table-sm"id="tabla_honorarios">
				  <thead class="thead-secondary">
				    <tr>
				      <th scope="col">Honorarios</th>
				      <th scope="col">Cantidad</th>
				    </tr>
				  </thead>
				  <tbody>
				         <?php 
				         $count=0;
				            foreach ($this->datos as $k )
				                {
									echo '<tr>';
									echo '<td>' .$k->puesto.' </td>';
									echo '<td>' .$k->cantidad.' </td>';
									$count+=$k->cantidad;
									echo '</tr>';
								}?>
							<tfoot class="alert alert-primary">
							<tr>
							<td ><b>Plazas Asignadas Utilizadas</b></td>
							<td><b><?php echo $count ?></b></td>
							</tr>
							<tr class="alert alert-secondary">
								<td><b>Plazas Asignadas Contabilizadas</b></td>
								<td><b><?php echo $this->totalDisponible->total ?></b></td>
							</tr>
							
							</tfoot>
							
				  </tbody>
				</table>
					</div>
					<div class="col-sm-6">
         			<div class="grafica" id="container"> </div>
         		</div>
				</div>
				
			
				
			</div>
</div>


				
				

</section>
<?php require 'views/footer.php';?>
<script type="text/javascript">
    $( document ).ready(function() {
                Highcharts.theme = {
                colors: [ '#50B432','#058DC7', '#ED561B', '#DDDF00', '#24CBE5', '#64E572', 
                '#FF9655', '#FFF263', '#6AF9C4'],
                chart: {
                backgroundColor: {
                linearGradient: [0, 0, 500, 500],
                stops: [
                [0, 'rgb(240, 240, 255)'],
                [1, 'rgb(255, 240, 255)']
                ]
                },
                },
                title: {
                style: {
                color: '#000',
                font: 'bold 16px "Trebuchet MS", Verdana, sans-serif'
                }
                },
                subtitle: {
                style: {
                color: '#666666',
                font: 'bold 12px "Trebuchet MS", Verdana, sans-serif'
                }
                },
                
                legend: {
                itemStyle: {
                font: '9pt Trebuchet MS, Verdana, sans-serif',
                color: 'black'
                },
                itemHoverStyle:{
                color: 'gray'
                }   
                }
                };
                Highcharts.setOptions(Highcharts.theme);
                $.ajax({
                url:"http://192.168.42.157/sistema/honorarios/getDistribucion",
                type:'GET',
                dataType:"json",
                success: function(json) {

                var valores=[];

                for (var i = 0; i < json.length; i++) {
                //json[i].data=[json[i].Hombres,json[i].Mujeres];
                	valores[i]=json[i].cantidad;
                }
                Highcharts.chart('container', {
                                chart: {
                                type: 'cylinder',
                                options3d: {
                                enabled: true,
                                alpha: 15,
                                beta: 25,
                                depth: 70,
                                viewDistance: 25
                                }
                                },
                                title: {
                                text: 'Distribución de Plazas Asignadas Utilizadas'
                                },
                                xAxis: {
                                categories: ['A','B','C','D','0','Total'],
                                crosshair: true,
                                },
                                plotOptions: {
                                    
                                column: {
                                pointPadding: 0.2,
                                borderWidth: 0,
                                borderRadius: 5,
                                depth: 25,
                                colorByPoint: true,
                                }
                                },
                                series: [{
                                name: 'Cantidad',
                                data: valores
                                
                                }]
                                }); 
                },
                error: function() {
                console.log("No se ha podido obtener la información");
                }
                });
    });
</script>