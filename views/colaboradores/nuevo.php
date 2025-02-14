<?php require 'views/header.php'; ?>
<div class="card border-primary mb-3 mx-auto" style="max-width: 80rem;">
	<section class="wrapper">
		<div class="p-2 mb-2 bg-info text-white shadow rounded"><h4 id="" class="text-center">Formulario de Registro</h4></div>
		<form action="<?php echo constant('URL');?>colaboradores/registrarColaborador" method="POST">
			 <div class="form-group">
		          <div class="form-row">
		          	<div class="form-group  col-md-12 ">
		              <label for="cargo">Puesto:</label>
		              <select class="form-control selecciones" id="cargo" name="cargo">
		                 <?php  
				            foreach ($this->puestos as $k)
				                {
				                    echo '<option value="'.$k->id.'">'.$k->puesto.'</option>';
				             }?>
		              </select>
		            </div>
		            
		          </div>
		          <div class="form-row">
		          	<div class="form-group  col-md-12 ">
		              <label for="alcaldias">Alcaldías:</label>
		              <select class="form-control selecciones" id="alcaldias" name="alcaldias">
		                 <?php  
				            foreach ($this->alcaldias as $k)
				                {
				                	if($k->nombre==='Oficina'){
				                    	echo '<option selected value="'.$k->id.'">'.$k->nombre.'</option>';
				                	}else{
				                		echo '<option value="'.$k->id.'">'.$k->nombre.'</option>';
				                	}
				                    

				             }?>
		              </select>
		            </div>
		          </div>
		          <div class="form-row">
		          	<div class="form-group col-xs-12 col-md-6 ">
		              <label for="nombre">Nombre</label>
		              <input type="text" class="form-control " placeholder="Introduzca Nombre(s)" id="nombre" name="nombre" required="required">
		            </div>

		            <div class="form-group col-xs-12 col-md-6 ">
		              <label for="apellido_paterno">Apellido Paterno</label>
		              <input type="text" class="form-control " placeholder="Introduzca Apellido Paterno" id="apellido_paterno" name="apellido_paterno" >
		            </div>
		          </div>
		          <div class="form-row">      	
		            <div class="form-group col-xs-12 col-md-6 ">
		              <label for="apellido_materno">Apellido Materno</label>
		              <input type="text" class="form-control " placeholder="Introduzca Apellido Materno" id="apellido_materno" name="apellido_materno" >
		            </div>
		            <div class="form-group col-xs-12 col-md-3 ">
		              <label for="curp">CURP</label>
		              <input type="text" class="form-control " placeholder="Introduzca CURP" id="curp" name="curp" required="required" onblur="curp2date()">
		            </div>
		            <div class="form-group col-xs-12 col-md-3 ">
		              <label for="nacimiento">Fecha de Nacimiento</label>
		              <input type="date" class="form-control " placeholder="Introduzca Fecha de nacimientp" id="nacimiento" name="nacimiento" required="required">
		            </div>
		            
		          </div>
		          <div class="form-row">
		          	<div class="form-group col-xs-12 col-md-4 ">
		              <label for="">Teléfono</label>
		              <input type="text" class="form-control " placeholder="Introduzca Número de contacto" id="telefono" name="telefono" required="required" value=0000>
		            </div>

		            <div class="form-group col-xs-12 col-md-4 ">
		              <label for="email">Correo Personal</label>
		              <input type="email" class="form-control " placeholder="Introduzca email válido" id="correo" name="correo" required="required">
		            </div>
		            <div class="form-group col-xs-12 col-md-4 ">
		              <label for="">Correo Institucional</label>
		              <input type="correo_institucional" class="form-control " placeholder="Introduzca email válido" id="correo_institucional" name="correo_institucional" value="correo@educacion.cdmx.gob.mx">
		            </div>
		          </div>
		          <div class="form-row">      	
		            <div class="form-group col-xs-12 col-md-6 ">
		              <label for="sexo">Sexo</label>
		              <select class="form-control selecciones" id="sexo" name="sexo" required="required">
		                <option value="H">Hombre</option>
		                <option value="M">Mujer</option>
		              </select>
		            </div>
		            <div class="form-group col-xs-12 col-md-6 ">
		              <label for="alta">Fecha de ingreso</label>
		              <input type="date" class="form-control " id="alta" name="alta" required="required">
		            </div>
		          </div>
		          <div class="form-row">      	
		          	<div class="form-group col-xs-12 col-md-3 ">
		              <label for="nivel">Nivel Educativo</label>
		              <select class="form-control selecciones" id="nivel" name="nivel">
		                 <?php  
				            foreach ($this->niveles as $n)
				                {
				                    echo '<option value="'.$n->id.'">'.$n->nivel.'</option>';
				             }?>
		              </select>
		            </div>
		            <div class="form-group col-xs-12 col-md-3 ">
		              <label for="documento">Documento Probatorio</label>
		              <select class="form-control selecciones" id="documento" name="documento">
		                 <?php  
				            foreach ($this->documentos as $k)
				                {
				                    echo '<option value="'.$k->id.'">'.$k->documento.'</option>';
				             }?>
		              </select>
		            </div>
		            <div class="form-group col-xs-12 col-md-3 ">
		              <label for="especialidad">Área de Conocimiento</label>
		              <input type="text" class="form-control " placeholder="" id="especialidad" name="especialidad" value="No aplica" >
		            </div>
		            <div class="form-group col-xs-12 col-md-3 ">
		            	<label for="porcentaje">Porcentaje de avance</label>
		              <div class="input-group">
						  <input type="number" class="form-control" aria-label="Porcentaje de avance" value=100 name="porcentaje">
						  <div class="input-group-append">
						    <span class="input-group-text">%</span>
						  </div>
		            	</div>
		          </div>
		      </div>
		      <div class="form-group row ">
		        <div class="col-sm-4"></div>
		        <div class="col-sm-6 mx-auto">
		          <button type="button" id="cancelarColaborador" class="btn btn-danger" onclick="cancela()"><i class="far fa-times-circle"></i>Cancelar</button>
		          <button type="submit" class="btn btn-success"><i class="fas fa-user-edit"></i>Registrar</button>
		          <button type="button" id="" class="btn btn-warning" onclick="regresaVentanaCol()"><i class="fas fa-undo"></i>Regresar</button>
		        </div>
		      </div>
		</form>
		
	</section>

</div>
<?php require 'views/footer.php'; ?>
<script type="text/javascript">
	function cancela(){
  		window.location.replace("http://192.168.42.157/sistema/colaboradores/nuevo");
	}
</script>
<script type="text/javascript">
	$(function () {
  $('select').each(function () {
    $(this).select2({
      theme: 'bootstrap4',
      width: '100%',
      placeholder: $(this).attr('placeholder'),
      allowClear: Boolean($(this).data('allow-clear')),
    });
  });
});
</script>
<script type="text/javascript">
	<?php echo $this->alerta; ?>
</script>
<script type="text/javascript">
	

function curp2date() {
	var miCurp =document.getElementById("curp").value;
	var m = miCurp.match( /^\w{4}(\w{2})(\w{2})(\w{2})/ );
	//miFecha = new Date(año,mes,dia) 
	var anyo = parseInt(m[1],10)+1900;
	if( anyo < 1950 ) anyo += 100;
	var mes = parseInt(m[2], 10)-1;
	var dia = parseInt(m[3], 10);
	var fecha_nac= (new Date( anyo, mes, dia ));
	var hoy = new Date();
    var cumpleanos = fecha_nac;
    var edad = hoy.getFullYear() - cumpleanos.getFullYear();
    var m = hoy.getMonth() - cumpleanos.getMonth();
    if (m < 0 || (m === 0 && hoy.getDate() < cumpleanos.getDate())) {
        edad--;
    }


        month = '' + (fecha_nac.getMonth() + 1),
        day = '' + fecha_nac.getDate(),
        year = fecha_nac.getFullYear();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;

    fecha_nac = [year, month, day].join('-');

    $("#nacimiento").val(fecha_nac);
    

}


</script>