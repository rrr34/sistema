<?php require 'views/header.php';?>
<section>
	 <div class="wrap_estadisticas">
	 	<div class="table-title">
	 		<div class="row">
                    <div class="col-sm-2">
						<h2 >Estadística General</h2>
					</div>

                </div>
         </div>
         <div class="row">
         	<div class="col-sm-6">
         		<div class="grafica" id="container"> </div>
         	</div>
         	<div class="col-sm-6"> 
					<table class="table table-striped table-sm" id="datatable">
					  <thead>
					    <tr>
					      <th>Alcladía</th>
					      <th>Hombres</th>
					      <th>Mujeres</th>
					    </tr>
					  </thead>
					  <tbody>
					  	<?php  
				            foreach ($this->datos as $k )
				                {
				                echo '<tr>';
				                   echo '<th>' .$k->alcaldia.' </th>';
				                   echo '<td>' .$k->Hombres.' </td>';
				                   echo '<td>' .$k->Mujeres.' </td>';
				                   echo '</tr>';
				                  }?>
					  </tbody>
					</table>
         		
         	</div>
         </div>
	 </div>
</section>

<?php require 'views/footer.php';?>
<script type="text/javascript">
    $( document ).ready(function() {
                Highcharts.theme = {
                colors: ['#058DC7', '#50B432', '#ED561B', '#DDDF00', '#24CBE5', '#64E572', 
                '#FF9655', '#FFF263', '#6AF9C4'],
                chart: {
                backgroundColor: {
                linearGradient: [0, 0, 500, 500],
                stops: [
                [0, 'rgb(255, 255, 255)'],
                [1, 'rgb(240, 240, 255)']
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
                url:"http://192.168.42.157/sistema/estadisticas/getDistribucionGlobal",
                type:'GET',
                dataType:"json",
                success: function(json) {
                var categories=[];
                var hombres=[];
                var mujeres=[];
                for (var i = 0; i < json.length; i++) {
                //json[i].data=[json[i].Hombres,json[i].Mujeres];
                if(json[i].Hombres==null)
                    json[i].Hombres=0;
                if(json[i].Mujeres==null)
                    json[i].Mujeres=0;
                hombres[i]=json[i].Hombres;
                mujeres[i]=json[i].Mujeres;
                categories[i]=json[i].alcaldia;
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
                                text: 'Distribución Global'
                                },
                                xAxis: {
                                categories: categories,
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
                                name: 'Hombres',
                                data: hombres
                                
                                }, {
                                name: 'Mujeres',
                                data: mujeres,
                                showInLegend: true
                                }]
                                }); 
                },
                error: function() {
                console.log("No se ha podido obtener la información");
                }
                });
    });
</script>