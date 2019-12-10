<?php require 'views/header.php';?>
<section>
	 <div class="wrap_estadisticas">
	 	<div class="table-title">
	 		<div class="row">
                    <div class="col-sm-2">
						<h2 >Niveles Educativos</h2>
					</div>

                </div>
         </div>
         <div class="row">
         	<div class="col-sm-8">
         		<div class="grafica" id="container"> </div>
         	</div>
         	<div class="col-sm-4"> 
					<table class="table table-striped table-sm" id="datatableNiveles">
					  <thead>
					    <tr>
					      <th>Nivel</th>
					      <th>Certificado</th>
					      <th>Título</th>
                          <th>Constancia</th>
                          <th>Kárdex</th>
                          <th>Cédula</th>
                          <th>Otro</th>
					    </tr>
					  </thead>
					  <tbody>
					  	<?php  
				            foreach ($this->datos as $k )
				                {
				                echo '<tr>';
				                   echo '<th>' .$k->niveles.' </th>';
				                   echo '<td>' .$k->Certificado.' </td>';
				                   echo '<td>' .$k->Título.' </td>';
                                   echo '<td>' .$k->Constancia.' </td>';
                                   echo '<td>' .$k->Kárdex.' </td>';
                                   echo '<td>' .$k->Cédula.' </td>';
                                   echo '<td>' .$k->Otro.' </td>';
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
                url:"http://192.168.42.157/sistema/estadisticas/getNivelesEducativos",
                type:'GET',
                dataType:"json",
                success: function(json) {
                var categories=[];
                var certificado=[];
                var titulo=[];
                var constancia=[];
                var kardex=[];
                var cedula=[];
                var otro=[];
                for (var i = 0; i < json.length; i++) {
                //json[i].data=[json[i].Hombres,json[i].Mujeres];
                if(json[i].Certificado==null)
                    json[i].Certificado=0;
                if(json[i].Título==null)
                    json[i].Título=0;
                if(json[i].Constancia==null)
                    json[i].Constancia=0;
                if(json[i].Kárdex==null)
                    json[i].Kárdex=0;
                if(json[i].Cédula==null)
                    json[i].Cédula=0;
                if(json[i].Otro==null)
                    json[i].Otro=0;
                certificado[i]=json[i].Certificado;
                titulo[i]=json[i].Título;
                constancia[i]=json[i].Constancia;
                kardex[i]=json[i].Kárdex;
                cedula[i]=json[i].Cédula;
                otro[i]=json[i].Otro;
                categories[i]=json[i].niveles;
                }
                    Highcharts.chart('container', {
                    chart: {
                    height: 600,
                    type: 'column'
                    },
                    title: {
                    text: 'Niveles Educativos'
                    },
                    xAxis: {
                    categories: categories
                    },
                    yAxis: {
                    min: 0,
                    title: {
                    text: 'Tipo de documento presentado'
                    },
                    stackLabels: {
                    enabled: true,
                    style: {
                    fontWeight: 'bold',
                    color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                    }
                    }
                    },
                    legend: {
                    align: 'right',
                    x: -30,
                    verticalAlign: 'top',
                    y: 50,
                    floating: true,
                    backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
                    borderColor: '#CCC',
                    borderWidth: 1,
                    shadow: false
                    },
                    tooltip: {
                    headerFormat: '<b>{point.x}</b><br/>',
                    pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
                    },
                    plotOptions: {
                    column: {
                    stacking: 'normal',
                    dataLabels: {
                    enabled: true,
                    color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
                    }
                    }
                    },
                    series: [{
                    name: 'Certificado',
                    data: certificado
                    }, {
                    name: 'Título',
                    data: titulo
                    },{
                    name: 'Constancia',
                    data: constancia
                    },{
                    name: 'Kárdex',
                    data: kardex
                    }, {
                    name: 'Cédula',
                    data: cedula
                    },{
                    name: 'Otro',
                    data: otro
                    }]
                    });


                },
                error: function() {
                console.log("No se ha podido obtener la información");
                }
                });
    });
</script>