<?php require 'views/header.php';?>
<section>
	 <div class="table-wrapper">
	 	<div class="table-title">
	 		<div class="row">
                    <div class="col-sm-2">
						<h2 >Alcaldías</b></h2>
					</div>
					<div class="col-sm-4">
						<div class="input-group mb-3">
							  <div class="input-group-prepend">
							    <label class="input-group-text" for="select_subdireccion">Subdirección Operativa</label>
							  </div>
							  <select class="custom-select" id="select_subdireccion">
							    <option selected>Selecciona...</option>  
							     <?php  
						            foreach ($this->subdirecciones as $k)
						                {
						                    echo '<option value="'.$k->id.'">'.$k->puesto.'</option>';
						             }?>
							  </select>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="input-group mb-3"  id="input_alcaldia" hidden="true">
							  <div class="input-group-prepend">
							    <label class="input-group-text" for="select_alcaldia">Alcaldía</label>
							  </div>
							  <select class="custom-select" id="select_alcaldia"> </select>
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
					<table class="table table-striped table-sm" id=tabla>
					  <thead>
					    <tr>
					      <th scope="col">Sexo</th>
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
 function limpiar(){
 	window.location.replace("http://192.168.42.152/sistema/estadisticas");
 }
  
</script>
<script type="text/javascript">

  $(document).ready(function(){
  	
    $("#select_subdireccion").on("change",function(){
      var id= document.getElementById("select_subdireccion").value;
      $("#select_alcaldia").empty();
      $("#container").empty();
      $("#container").prop('hidden', true);
      $(".borrar").remove();
      $("#grafica_descripcion").prop('hidden', true);
      var id_alcaldia;
      $.ajax({
        url:"http://192.168.42.157/sistema/estadisticas/getAlcaldias",
        type:'GET',
        dataType:"json",
        data:{id: id},
        success:function(json){
         $("#input_alcaldia").prop('hidden', false); 
         $("#select_alcaldia").append('<option selected>Selecciona...</option>  ')
           $.each(json,function(i, resultado) {
            $("#select_alcaldia").append('<option value='+resultado.id+'>'+resultado.alcaldia+'</option>');
          }); 
          $("#select_alcaldia").on("change",function(){
          	 id_alcaldia = document.getElementById("select_alcaldia").value;
          	 //console.log(id,id_alcaldia);
  			 construirGrafica(id,id_alcaldia);
  			
          }); 

        },error : function(xhr, status) {
            console.log(id);
        }
      });
    });
  });

function construirTabla(datos){
	$(".borrar").remove();

	var d;
	var total=0;
		 for (var i = 0; i < datos.length; i++) {
		 d+= '<tr class="borrar">'+
		 '<td>'+datos[i].name+'</td>'+
		 '<td>'+datos[i].y+'</td>'+
		 '</tr>';
		 total+=datos[i].y;
		 }
		 d+='<tr class="borrar alert alert-secondary"><td>Total</td>'+
		 '<td>'+total+'</td>'+
		 '</tr>';
		 d+='<tr class="borrar alert alert-primary"><td>Pilares Autorizados</td>'+
		 '<td>'+datos[0].autorizado+'</td></tr>';
		 $("#tabla").append(d);
		
}
  function construirGrafica(zona,alcaldia){
 	 $("#container").prop('hidden', false);
 	 $("#botonLimpiar").prop('hidden', false);

 	  $(document).ready(function(){

 	// google.charts.setOnLoadCallback(drawChart); 
 	 $.ajax({
        url:"http://192.168.42.157/sistema/estadisticas/getDistribucion",
        type:'GET',
        dataType:"json",
        data:{zona:zona,alcaldia:alcaldia},
        success:function(json){
        	$("#grafica_descripcion").prop('hidden', false);
        	construirTabla(json);
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
		        text: 'Distribución por Género'
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
            console.log(zona,alcaldia);
        }
      });
 	  });
 }
function limpiar(){
 	window.location.replace("http://192.168.42.157/sistema/estadisticas");
 }

</script>

 


