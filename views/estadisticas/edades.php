<?php require 'views/header.php';?>
<section>
	 <div class="table-wrapper">
	 	<div class="table-title">
	 		<div class="row">
                    <div class="col-sm-4">
						<h2 >Edades de los colaboradores</h2>
					</div>
					<div class="col-sm-4">
						<div class="input-group mb-3">
							  <div class="input-group-prepend">
							    <label class="input-group-text" for="select_edad">Intervalo de Edad</label>
							  </div>
							  <select class="custom-select" id="select_edades">
                                <option >Selecciona...</option>
                                    <option value=20>20-30 años</option>
                                    <option value=31>31-40 años</option>
                                    <option value=41>41-50 años</option>
                                    <option value=51>51-60 años</option>
                                    <option value=61>61+ años</option>
							  </select>
						</div>
					</div>

					<div class="col-sm-2">
						<button type="button" class="btn btn-warning" hidden="true" id="botonGraficar"><i class="fas fa-chart-area"></i>Graficar</button>
						<button type="button" class="btn btn-success" hidden="true" id="botonLimpiar" onclick="limpiar()"><i class="fas fa-sync-alt"></i>Limpiar</button>
					</div>

                </div>
         </div>
   			<div class="row">
         	<div class="col-sm-8">
         		<div class="grafica" id="container" hidden="true"> </div>
         	</div>
         	<div class="col-sm-4">
         		<div class="grafica" id="grafica_descripcion" hidden="true"> 
					<table class="table table-striped table-sm" id="tabla">
					  <thead>
					    <tr>
					      <th scope="col">Intervalo</th>
					      <th scope="col">Clasificación</th>
					      <th scope="col">Cantidad</th>
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
    $("#select_edades").on("change",function(){
         var id= document.getElementById("select_edades").value;
         $("#container").empty();
         $("#container").prop('hidden', true);
         $("#grafica_descripcion").prop('hidden', true);
    //  console.log(id);
      $.ajax({
        url:"http://192.168.42.157/sistema/estadisticas/getEdades",
        type:'GET',
        dataType:"json",
        data:{id: id},
        success:function(json){
            $("#grafica_descripcion").prop('hidden', false);
            construirTabla(json,id);
             $("#container").prop('hidden', false);
             $("#botonLimpiar").prop('hidden', false);
             rango=valorrango(id);
            Highcharts.chart('container', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie',
                options3d: {
                enabled: true,
                alpha: 45,
                beta: 0
                }
            },
                title: {
                text: 'Distribución por Género y Edad'
                },
                subtitle: {
                text: 'Intervalo: '+rango+ ' años'
                },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
                                    
            plotOptions: {
                pie: {
                    colors: [
                         '#50B432', 
                         '#7c127b', 
                         '#DDDF00', 
                         '#24CBE5', 
                         '#64E572', 
                         '#FF9655', 
                         '#FFF263', 
                         '#6AF9C4'
                       ],
                    allowPointSelect: true,
                    cursor: 'pointer',
                    depth: 35,
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                name: 'Porcentaje',
                colorByPoint: true,
                data: json
            }]
        });
  
        },error : function(xhr, status) {
            console.log('error');
        }
      });
    });
  });
function valorrango(id){
    id=parseInt(id, 10);
     var rango;
     switch (id)
    {
        case 20:
            rango = 'De 20 a 30';
        break;
        case 31:
            rango = 'De 31 a 40';
        break;
        case 41:
            rango = 'De 41 a 50';
        break;
        case 51:
            rango = 'De 51 a 60';
        break;
        case 61:
            rango = 'De 61+ ';
        break;
        default:
            rango = id;
    }
    return rango;
}
function construirTabla(datos,id){
    $(".borrar").remove();
    id=parseInt(id, 10);
    var d;
    rango=valorrango(id);
    
    var total=0;
         for (var i = 0; i < datos.length; i++) {
         d+= '<tr class="borrar">'+
         '<td>'+rango+'</td>'+
         '<td>'+datos[i].name+'</td>'+
         '<td>'+datos[i].y+'</td>'+
         '</tr>';
         total+=datos[i].y;
         }
         d+='<tr class="borrar alert alert-secondary"><td>Total</td>'+
        '<td></td>'+
         '<td>'+total+'</td>'+
         '</tr>';
         
         $("#tabla").append(d);
        
}
function limpiar(){
    window.location.replace("http://192.168.42.157/sistema/estadisticas/edades");
 }
</script>