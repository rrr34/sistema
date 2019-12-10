var table;
var table2;
var table3;
var table4;
var table5;
$(document).ready(function() {
   
   table= $('#table_puestos_id').DataTable({
    
    "language": {
        "sProcessing":    "Procesando...",
        "sLengthMenu":    "Mostrar _MENU_ registros",
        "sZeroRecords":   "No se encontraron resultados",
        "sEmptyTable":    "Ningún dato disponible en esta tabla",
        "sInfo":          "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty":     "Mostrando registros del 0 al 0 de un total de 0 registros",
        "sInfoFiltered":  "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":   "",
        "sSearch":        "Buscar:",
        "sUrl":           "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
            "sFirst":    "Primero",
            "sLast":    "Último",
            "sNext":    "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        },  
    },
    "dom": 'Btip<"bottom"l>',
     //"dom": 'Brtip',
    // "bLengthChange": false,
    /*
  "dom": 'Brtip',
  "bJQueryUI": true,
  "autoFill": true,*/   
});
});


 
// #myInput is a <input type="text"> element
$('#buscadordepuestos').on( 'keyup', function () {
    table.search( this.value ).draw();
} );

$(document).ready(function() {
      var dataSrc = [];
   table3= $('#tabla_organigrama').DataTable({
    
    "language": {
        "sProcessing":    "Procesando...",
        "sLengthMenu":    "Mostrar _MENU_ registros",
        "sZeroRecords":   "No se encontraron resultados",
        "sEmptyTable":    "Ningún dato disponible en esta tabla",
        "sInfo":          "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty":     "Mostrando registros del 0 al 0 de un total de 0 registros",
        "sInfoFiltered":  "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":   "",
        "sSearch":        "Buscar:",
        "sUrl":           "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
            "sFirst":    "Primero",
            "sLast":    "Último",
            "sNext":    "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        },  
    },
     "dom": 'Btip<"bottom"l>',
     
     "buttons": [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        "order": [],
    "responsive": true,
    /*
  "dom": 'Brtip',
  "bJQueryUI": true,
  "autoFill": true,*/   
});
});



// #myInput is a <input type="text"> element
$('#buscador_organigrama').on( 'keyup', function () {
    table3.search( this.value ).draw();
} );

function agregaDato(id){
	var id= id;
	$.ajax({
		url:"http://192.168.42.157/sistema/puestos/ver",
		type:'GET',
		dataType:"json",
		data:{id: id},
		success:function(json){
			$("#modal_puesto").val(json.PUESTO);
			$("#modal_jefe").val(json.JEFE);
			$("#modal_nivel").val(json.NIVEL);
			$("#modal_tipo").val(json.TIPO);
			$("#verModal").modal('show');
		},error : function(xhr, status) {
        toastr.error('Error al cargar datos', 'Error');
    }
	});
	
}
//verModalColaboradores
function datoColaborador(id){
    var id= id;
    $.ajax({
        url:"http://192.168.42.157/sistema/colaboradores/ver",
        type:'GET',
        dataType:"json",
        data:{id: id},
        success:function(json){
            $("#modal_puesto").val(json.puesto);
            $("#modal_jefe").val(json.jefe);
            $("#modal_alcaldia").val(json.alcaldia);
            $("#modal_nombre").val(json.nombre);
            $("#modal_apellido_p").val(json.apellido_paterno);
            $("#modal_apellido_m").val(json.apellido_materno);
            $("#modal_sexo").val(json.sexo);
            $("#modal_alta").val(json.alta);
            $("#modal_correo").val(json.correo);
            $("#modal_telefono").val(json.telefono);
            $("#modal_curp").val(json.curp);
            $("#modal_edad").val(calcularEdad(json.nacimiento));
            $("#modal_especialidad").val(json.especialidad);
            $("#modal_porcentaje").val(json.porcentaje);
            $("#modal_documento").val(json.documento);
            $("#modal_nivel").val(json.nivel);
            $("#modal_nacimiento").val(json.nacimiento);
            $("#modal_correo_institucional").val(json.correo_institucional);
            $("#verModalColaboradores").modal('show');
        },error : function(xhr, status) {
        toastr.error('Error al cargar datos', 'Error');
    }
    });
    
}

function calcularEdad(fecha) {
    var hoy = new Date();
    var cumpleanos = new Date(fecha);
    var edad = hoy.getFullYear() - cumpleanos.getFullYear();
    var m = hoy.getMonth() - cumpleanos.getMonth();

    if (m < 0 || (m === 0 && hoy.getDate() < cumpleanos.getDate())) {
        edad--;
    }

    return edad;
}



$(document).ready(function() {
  
   table2= $('#table_id_colaboradores').DataTable({
    
    "language": {
        "sProcessing":    "Procesando...",
        "sLengthMenu":    "Mostrar _MENU_ registros",
        "sZeroRecords":   "No se encontraron resultados",
        "sEmptyTable":    "Ningún dato disponible en esta tabla",
        "sInfo":          "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty":     "Mostrando registros del 0 al 0 de un total de 0 registros",
        "sInfoFiltered":  "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":   "",
        "sSearch":        "Buscar:",
        "sUrl":           "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
            "sFirst":    "Primero",
            "sLast":    "Último",
            "sNext":    "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        },  
    },
    "dom": 'Btip<"bottom"l>',
     
     "buttons": [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        "responsive": true,
 /*
 var dataSrc = [];
  
 'initComplete': function(){
         var api = this.api();

         // Populate a dataset for autocomplete functionality
         // using data from first, second and third columns
         api.cells('tr', [0, 1, 2,3,4,5]).every(function(){
            var data = this.data();
            if(dataSrc.indexOf(data) === -1){ dataSrc.push(data); }
         });

         // Initialize Typeahead plug-in
         $('.dataTables_filter input[type="search"]', api.table().container())
            .typeahead({
               source: dataSrc,
               afterSelect: function(value){
                  api.search(value).draw();
               }
            }
         );
      },
  
 "dom": '<"pull-left"f>tip<"bottom"B>',
  
  "dom": '<"pull-left"f>tip<"bottom"Bl>',
  "bFilter": false,
    "bLengthChange": false
    buttons: [
            {
                tag:"button",
                className:"btn btn-primary"
                
            }
        ]
    ,
  */ 
 
    
});
});

$('#buscador').on( 'keyup', function () {
    table2.search( jQuery.fn.DataTable.ext.type.search.string( this.value ) ).draw();
} );

function cancelaVentanaCol(id) {
    window.location.replace("http://192.168.42.157/sistema/colaboradores/editar/"+id);
}
function cancelaVentanaPuesto(id) {
    window.location.replace("http://192.168.42.157/sistema/puestos/editar/"+id);
}
function regresaVentanaCol(){
    window.location.replace("http://192.168.42.157/sistema/colaboradores");
}
function regresaVentanaPrincipal(){
    window.location.replace("http://192.168.42.157/sistema/principal");
}
function cancelaVentanaPuestos() {
  window.location.replace("http://192.168.42.157/sistema/puestos/nuevo");
}
function regresarPuestos() {
  window.location.replace("http://192.168.42.157/sistema/puestos");
}
function crearExcel() {
    
  window.location.replace("http://192.168.42.157/sistema/principal/crearExcel/");

}
function limpiarGraficaZona() {
    
  window.location.replace("http://192.168.42.157/sistema/estadisticas/distribucionZona");
}
function cancelaVentanaPilares(id) {
    window.location.replace("http://192.168.42.157/sistema/pilares/editar/"+id);
}
function regresarPilares() {
  window.location.replace("http://192.168.42.157/sistema/pilares");
}
function cancelaVentanaPilar() {
    window.location.replace("http://192.168.42.157/sistema/pilares/nuevo/");
}
function regresarPilar() {
  window.location.replace("http://192.168.42.157/sistema/pilares");
}
$(document).ready(function() {
    $('#table_general').DataTable({
    "language": {
        "sProcessing":    "Procesando...",
        "sLengthMenu":    "Mostrar _MENU_ registros",
        "sZeroRecords":   "No se encontraron resultados",
        "sEmptyTable":    "Ningún dato disponible en esta tabla",
        "sInfo":          "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty":     "Mostrando registros del 0 al 0 de un total de 0 registros",
        "sInfoFiltered":  "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":   "",
        "sSearch":        "Buscar:",
        "sUrl":           "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
            "sFirst":    "Primero",
            "sLast":    "Último",
            "sNext":    "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        },  
    },
    "dom": 'rtip<"bottom"l>',
  //"dom": 'rtip',
  "bJQueryUI": true,
 
});
});
$(document).ready(function() {
    $('#datatable').DataTable({
    "language": {
        "sProcessing":    "Procesando...",
        "sLengthMenu":    "Mostrar _MENU_ registros",
        "sZeroRecords":   "No se encontraron resultados",
        "sEmptyTable":    "Ningún dato disponible en esta tabla",
        "sInfo":          "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty":     "Mostrando registros del 0 al 0 de un total de 0 registros",
        "sInfoFiltered":  "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":   "",
        "sSearch":        "Buscar:",
        "sUrl":           "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
            "sFirst":    "Primero",
            "sLast":    "Último",
            "sNext":    "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        },  
    },
  "dom": 'Btip<"bottom"l>',
  "bJQueryUI": true,
  "responsive": true,
  //"iDisplayLength":17,
 
});
});

(function(){

function removeAccents ( data ) {
    return data
        .replace( /έ/g, 'ε' )
        .replace( /[ύϋΰ]/g, 'υ' )
        .replace( /ώ/g, 'ω' )
        .replace( /ά/g, 'α' )
        .replace( /[ίϊΐ]/g, 'ι' )
        .replace( /ή/g, 'η' )
        .replace( /\n/g, ' ' )
        .replace( /á/g, 'a' )
        .replace( /Á/g, 'a' )
        .replace( /é/g, 'e' )
        .replace( /É/g, 'e' )
        .replace( /í/g, 'i' )
        .replace( /Í/g, 'i' )
        .replace( /ó/g, 'o' )
        .replace( /Ó/g, 'o' )
        .replace( /ú/g, 'u' )
        .replace( /Ú/g, 'u' )
        .replace( /ê/g, 'e' )
        .replace( /î/g, 'i' )
        .replace( /ô/g, 'o' )
        .replace( /è/g, 'e' )
        .replace( /ï/g, 'i' )
        .replace( /ü/g, 'u' )
        .replace( /ã/g, 'a' )
        .replace( /õ/g, 'o' )
        .replace( /ç/g, 'c' )
        .replace( /ì/g, 'i' );
}

var searchType = jQuery.fn.DataTable.ext.type.search;

searchType.string = function ( data ) {
    return ! data ?
        '' :
        typeof data === 'string' ?
            removeAccents( data ) :
            data;
};

searchType.html = function ( data ) {
    return ! data ?
        '' :
        typeof data === 'string' ?
            removeAccents( data.replace( /<.*?>/g, '' ) ) :
            data;
};

}());
     
$(document).ready(function() {
   
   table4= $('#pilares').DataTable({
    
    "language": {
        "sProcessing":    "Procesando...",
        "sLengthMenu":    "Mostrar _MENU_ registros",
        "sZeroRecords":   "No se encontraron resultados",
        "sEmptyTable":    "Ningún dato disponible en esta tabla",
        "sInfo":          "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty":     "Mostrando registros del 0 al 0 de un total de 0 registros",
        "sInfoFiltered":  "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":   "",
        "sSearch":        "Buscar:",
        "sUrl":           "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
            "sFirst":    "Primero",
            "sLast":    "Último",
            "sNext":    "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        },  
    },
    "dom": 'Btip<"bottom"l>',
    "responsive": true,
     //"dom": 'Brtip',
    // "bLengthChange": false,
    /*
  "dom": 'Brtip',
  "bJQueryUI": true,
  "autoFill": true,*/   
});
});


 
// #myInput is a <input type="text"> element
$('#pilaresBuscador').on( 'keyup', function () {
    table4.search( this.value ).draw();
} );


$(document).ready(function() {
   
   table5= $('#tabla_honorarios').DataTable({
    
    "language": {
        "sProcessing":    "Procesando...",
        "sLengthMenu":    "Mostrar _MENU_ registros",
        "sZeroRecords":   "No se encontraron resultados",
        "sEmptyTable":    "Ningún dato disponible en esta tabla",
        "sInfo":          "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty":     "Mostrando registros del 0 al 0 de un total de 0 registros",
        "sInfoFiltered":  "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":   "",
        "sSearch":        "Buscar:",
        "sUrl":           "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
            "sFirst":    "Primero",
            "sLast":    "Último",
            "sNext":    "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        },  
    },
    "dom": 'Btip<"bottom"l>',
    "responsive": true,
    "order": [],
     //"dom": 'Brtip',
    // "bLengthChange": false,
    /*
  "dom": 'Brtip',
  "bJQueryUI": true,
  "autoFill": true,*/   
});
});


 
// #myInput is a <input type="text"> element
$('#buscador_honorarios').on( 'keyup', function () {
    table5.search( this.value ).draw();
} );

$(document).ready(function() {
    $('#datatableNiveles').DataTable({
    "language": {
        "sProcessing":    "Procesando...",
        "sLengthMenu":    "Mostrar _MENU_ registros",
        "sZeroRecords":   "No se encontraron resultados",
        "sEmptyTable":    "Ningún dato disponible en esta tabla",
        "sInfo":          "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty":     "Mostrando registros del 0 al 0 de un total de 0 registros",
        "sInfoFiltered":  "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":   "",
        "sSearch":        "Buscar:",
        "sUrl":           "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
            "sFirst":    "Primero",
            "sLast":    "Último",
            "sNext":    "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        },  
    },
  "dom": 'Btip<"bottom"l>',
  "bJQueryUI": true,
  "responsive": true,
  //"iDisplayLength":17,
 
});
});

$(document).ready(function() {
    $('#tabla_edad').DataTable({
    "language": {
        "sProcessing":    "Procesando...",
        "sLengthMenu":    "Mostrar _MENU_ registros",
        "sZeroRecords":   "No se encontraron resultados",
        "sEmptyTable":    "Ningún dato disponible en esta tabla",
        "sInfo":          "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty":     "Mostrando registros del 0 al 0 de un total de 0 registros",
        "sInfoFiltered":  "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":   "",
        "sSearch":        "Buscar:",
        "sUrl":           "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
            "sFirst":    "Primero",
            "sLast":    "Último",
            "sNext":    "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        },  
    },
  "dom": 'Btip<"bottom"l>',
  "bJQueryUI": true,
  "responsive": true,
  //"iDisplayLength":17,
 
});
});