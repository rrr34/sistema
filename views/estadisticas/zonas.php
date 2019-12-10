<?php require 'views/header.php';?>
<section>
	 <div class="table-wrapper">
	 	<div class="table-title">
	 		<div class="row">
                    <div class="col-sm-4">
						<h2 >Subdirecciones Operativas</h2>
					</div>
					<div class="col-sm-4">
						<div class="input-group mb-3">
							  <div class="input-group-prepend">
							    <label class="input-group-text" for="select_subdireccion">Subdirección Operativa</label>
							  </div>
							  <select class="custom-select" id="select_subdirecciones">
							    <option selected>Selecciona...</option>  
							     <?php  
						            foreach ($this->subdirecciones as $k)
						                {
						                    echo '<option value="'.$k->id.'">'.$k->puesto.'</option>';
						             }?>
							  </select>
						</div>
					</div>

					<div class="col-sm-2">
						<button type="button" class="btn btn-warning" hidden="true" id="botonGraficar"><i class="fas fa-chart-area"></i>Graficar</button>
						<button type="button" class="btn btn-success" hidden="true" id="botonLimpiar" onclick="limpiarGraficaZona()"><i class="fas fa-sync-alt"></i>Limpiar</button>
					</div>

                </div>
         </div>
   			<div class="row">
         	<div class="col-sm-8">
         		<div class="grafica" id="container" hidden="true"> </div>
         	</div>
         	<div class="col-sm-4">
         		<div class="grafica" id="grafica_descripcion" hidden="true"> 
					<table class="table table-striped table-sm" id="tablaZonas">
					  <thead>
					    <tr>
					      <th scope="col">Alcaldía</th>
					      <th scope="col">Cantidad Hombres</th>
					      <th scope="col">Cantidad Mujeres</th>
					    </tr>
					  </thead>
					  <tbody>
					    
					     </tbody>
					</table>
         		</div>
         	</div>
         </div>

	 </div>
</section>

<?php require 'views/footer.php';?>

<script type="text/javascript">

  $(document).ready(function(){
    $("#select_subdirecciones").on("change",function(){
      var id= document.getElementById("select_subdirecciones").value;
      $("#container").empty();
      $("#container").prop('hidden', true);
      $("#grafica_descripcion").prop('hidden', true);
      //$("#grafica_descripcion").prop('hidden', false);
      console.log(id);
      $.ajax({
        url:"http://192.168.42.157/sistema/estadisticas/getZonas",
        type:'GET',
        dataType:"json",
        data:{id: id},
        success:function(json){
			$("#container").prop('hidden', false);
			$("#botonLimpiar").prop('hidden', false);
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
                
                // Apply the theme
                Highcharts.setOptions(Highcharts.theme);
                            Highcharts.chart('container', {
                            chart: {
                            type: 'column',
                            options3d: {
                            enabled: true,
                            alpha: 10,
                            beta: 25,
                            depth: 70
                            }
                            },
                            title: {
                            text: 'Distribución Por Subdirección Operativa'
                            },
                            subtitle: {
                            text:  document.getElementById("select_subdirecciones").options[document.getElementById("select_subdirecciones").selectedIndex].text
                            },
                            xAxis: {
                            categories: categories,
                            crosshair: true,
                            skew3d: true,
                            },
                            yAxis: {
                            
                            min: 0,
                            title: {
                            text: 'elementos'
                            }
                            },
                            
                            plotOptions: {
                            column: {
                                pointPadding: 0.2,
                                borderWidth: 0,
                                borderRadius: 8,
                                depth: 25,
                                dataLabels: {
                enabled: true
            }
                            }
                            },
                            series: [{
                            name: 'Hombres',
                            data: hombres
                            
                            }, {
                            name: 'Mujeres',
                            data: mujeres

                            }]
                            });	
			construirTabla(json);
			$("#grafica_descripcion").prop('hidden', false);

        },error : function(xhr, status) {
            console.log(id);
        }
      });
    });
  });

function construirTabla(datos){
	$(".borrar").remove();
	var d;
	var totalH=0;
	var totalM=0;
		 for (var i = 0; i < datos.length; i++) {
		 d+= '<tr class="borrar">'+
		 '<td>'+datos[i].alcaldia+'</td>'+
		 '<td>'+datos[i].Hombres+'</td>'+
		 '<td>'+datos[i].Mujeres+'</td>'+
		 '</tr>';
		 totalH+=datos[i].Hombres;
		 totalM+=datos[i].Mujeres;
		 }
		 d+='<tr class="borrar"><td><b>Total</b></td>'+
		 '<td>'+totalH+'</td>'+
		 '<td>'+totalM+'</td>'+
		 '</tr>';
		 $("#tablaZonas").append(d);
		
}

</script>