<?php require 'views/header.php';?>
<section>
	 <div class="table-wrapper">
	 	<div class="table-title">
	 		<div class="row">
                    <div class="col-sm-4">
						<h2 >Intervalo General de Edades</h2>
					</div>
					

                </div>
         </div>
   			<div class="row">
         	<div class="col-sm-8">
         		<div class="grafica" id="container" > </div>
         	</div>
         	<div class="col-sm-4">
         		<div class="grafica" id="grafica_descripcion" > 
					<table class="table table-striped table-sm" id="tabla_edad">
					  <thead>
					    <tr>
					      <th scope="col">Intervalo</th>
					      <th scope="col">Cantidad</th>
					    </tr>
					  </thead>
					  <tbody>
                        <?php  
                            foreach ($this->edades as $k )
                                {
                                echo '<tr>';
                                   echo '<th>' .$k->name.' </th>';
                                   echo '<td>' .$k->y.' </td>';
                                   echo '</tr>';
                                  }?>
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
   
    //  console.log(id);
      $.ajax({
        url:"http://192.168.42.157/sistema/estadisticas/getEdadesGeneral",
        type:'GET',
        dataType:"json",
        data:{},
        success:function(json){
            var result = [];
            
            for(var i in json)
                result.push([i, json[i]]);
            console.log(result);
                    Highcharts.chart('container', {
                    chart: {
                    type: 'pie',
                    options3d: {
                    enabled: true,
                    alpha: 45
                    }
                    },
                    title: {
                    text: 'Distribución General de Edades'
                    },
                    subtitle: {
                    text: ''
                    },
                    plotOptions: {
                    pie: {
                    innerSize: 100,
                    depth: 45
                    }
                    },
                    series: [{
                    name: 'Cantidad',
                    data: [
                    result[0][1],
                    result[1][1],
                    result[2][1],
                    result[3][1],
                    result[4][1]
                    ]
                    }]
                    });
            },error : function(xhr, status) {
            console.log('error');
        }
      });

  });

function limpiar(){
    window.location.replace("http://192.168.42.157/sistema/estadisticas/edadesGeneral");
 }
</script>