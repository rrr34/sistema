<?php require 'views/header.php'; ?>
<div class="card border-primary mb-3 mx-auto" style="max-width: 80rem;">
	<section class="wrapper">
		<div class="p-2 mb-2 alert-primary text-white shadow rounded"><h4 id=""class="text-center">Editar Registro</h4></div>
		<form action="<?php echo constant('URL');?>colaboradores/editarColaborador" method="POST">
			 <div class="form-group">
		         <div class="form-row">
		          	<div class="form-group  col-md-12 ">
		              <label for="cargo">Puesto:</label>
		              <select class="form-control selecciones" id="cargo" name="cargo">
		                 <?php  
				            foreach ($this->puestos as $k)
				                {
				                	if($k->id==$this->valores->cargo){
				                		echo '<option selected value="'.$k->id.'">'.$k->puesto.'</option>';
				                	}else{
				                		 echo '<option value="'.$k->id.'">'.$k->puesto.'</option>';
				                	}
				                   
				             }?>
		              </select>
		            </div>
		            
		          </div>
		          <div class="form-row">
		          	<div class="form-group  col-md-12 ">
		              <label for="alcaldias">Alcaldía:</label>
		              <select class="form-control selecciones" id="alcaldias" name="alcaldia">
		                 <?php  
				            foreach ($this->alcaldias as $k)
				                {
				                	if($k->id==$this->valores->aid){
				                    	echo '<option selected value="'.$k->id.'">'.$k->nombre.'</option>';
				                	}else if(is_null($this->valores->aid)&& $k->id==17){
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
		              <input type="text" class="form-control " placeholder="Introduzca Nombre(s)" id="nombre" name="nombre" required="required" value="<?php echo $this->valores->nombre ?>">
		            </div>

		            <div class="form-group col-xs-12 col-md-6 ">
		              <label for="apellido_paterno">Apellido Paterno</label>
		              <input type="text" class="form-control " placeholder="Introduzca Apellido Paterno" id="apellido_paterno" name="apellido_paterno" value="<?php echo $this->valores->apellido_paterno ?>">
		            </div>
		          </div>
		          <div class="form-row">      	
		            <div class="form-group col-xs-12 col-md-6 ">
		              <label for="apellido_materno">Apellido Materno</label>
		              <input type="text" class="form-control " placeholder="Introduzca Apellido Materno" id="apellido_materno" name="apellido_materno" value="<?php echo $this->valores->apellido_materno ?>">
		            </div>
		            <div class="form-group col-xs-12 col-md-3 ">
		              <label for="curp">CURP</label>
		              <input type="text" class="form-control " placeholder="Introduzca CURP" id="curp" name="curp" required="required" value="<?php echo $this->valores->curp ?>" onblur="curp2date()">
		            </div>
		            <div class="form-group col-xs-12 col-md-3 ">
		              <label for="nacimiento">Fecha de Nacimiento</label>
		              <input type="date" class="form-control " placeholder="Introduzca Fecha de nacimiento" id="nacimiento" name="nacimiento" required="required" value="<?php echo $this->valores->nacimiento ?>">
		            </div>
		            
		          </div>
		          <div class="form-row">
		          	<div class="form-group col-xs-12 col-md-6 ">
		              <label for="">Teléfono</label>
		              <input type="text" class="form-control " placeholder="Introduzca Número de contacto" id="telefono" name="telefono" required="required" value="<?php echo $this->valores->telefono?>">
		            </div>

		            <div class="form-group col-xs-12 col-md-3 ">
		              <label for="">Correo Electrónico</label>
		              <input type="email" class="form-control " placeholder="Introduzca email válido" id="correo" name="correo" required="required" value="<?php echo $this->valores->correo ?>">
		            </div>
		            <div class="form-group col-xs-12 col-md-3 ">
		              <label for="">Correo Institucional</label>
		              <input type="correo_institucional" class="form-control " placeholder="Introduzca email válido" id="correo_institucional" name="correo_institucional" required="required"
		              value="<?php echo $this->valores->correo_institucional ?>">
		            </div>
		          </div>
		          <div class="form-row">      	
		            <div class="form-group col-xs-12 col-md-6 ">
		              <label for="sexo">Sexo</label>
		              <select class="form-control selecciones" id="sexo" name="sexo" required="required">
		              		<?php if(  $this->valores->sexo =='H'){?>
		              		<option selected="selected" value="H">Hombre</option>
		              		<option  value="M">Mujer</option>
				              <?php	}else{?>
				              	<option selected="selected" value="M">Mujer</option>
				              	<option  value="H">Hombre</option>
				             <?php }?>
		                
		                
		              </select>
		            </div>
		            <div class="form-group col-xs-12 col-md-6 ">
		              <label for="alta">Fecha de ingreso</label>
		              <input type="date" class="form-control " id="alta" name="alta" required="required" value="<?php echo $this->valores->alta ?>">
		            </div>
		          </div>
		          <div class="form-row">      	
		          	<div class="form-group col-xs-12 col-md-3 ">
		              <label for="nivel">Nivel Educativo</label>
		              <select class="form-control selecciones" id="nivel" name="nivel">
		                 <?php  
				            foreach ($this->niveles as $n)
				                {
				                	if($n->id==$this->valores->idn){
				                    	echo '<option selected value="'.$n->id.'">'.$n->nivel.'</option>';
				                	}else if(is_null($this->valores->idn)&& $n->nivel=='Bachillerato'){
				                		echo '<option selected value="'.$n->id.'">'.$n->nivel.'</option>';
				                	}else{
				                		echo '<option value="'.$n->id.'">'.$n->nivel.'</option>';
				                	}
				                    
				             }?>
		              </select>
		            </div>
		            <div class="form-group col-xs-12 col-md-3 ">
		              <label for="documento">Documento Probatorio</label>
		              <select class="form-control selecciones" id="documento" name="documento">
		                 <?php  
				            foreach ($this->documentos as $d)
				                {
				                	if($d->id==$this->valores->idd){
				                    	echo '<option selected value="'.$d->id.'">'.$d->documento.'</option>';
				                	}
				                	else{
				                		echo '<option value="'.$d->id.'">'.$d->documento.'</option>';
				                	}
				                    
				             }?>
		              </select>
		            </div>
		            <div class="form-group col-xs-12 col-md-3 ">
		              <label for="especialidad">Área de Conocimiento</label>
		              <?php if(is_null($this->valores->especialidad)){?>
		              <input type="text" class="form-control " value="No aplica" id="especialidad" name="especialidad" required="required">
		          <?php }else {?>
		          		<input type="text" class="form-control " value="<?php echo $this->valores->especialidad ?>" id="especialidad" name="especialidad" required="required">
		          <?php }?>
		            </div>
		            <div class="form-group col-xs-12 col-md-3 ">
		            	<label for="porcentaje">Porcentaje de avance</label>
		              <div class="input-group">
		              	<input type="text" hidden="true" value="<?php echo $this->id; ?>" name="id">
						  <input type="number" class="form-control" aria-label="Porcentaje de avance" value=100 name="porcentaje" id="porcentaje">
						  <div class="input-group-append">
						    <span class="input-group-text">%</span>
						  </div>
		            	</div>
		          </div>
		      </div>
		      <div class="form-group row ">
		        <div class="col-sm-4">
		        </div>
		        <div class="col-sm-6 mx-auto">
		          <button type="button" id="cancelarColaborador" class="btn btn-danger" onclick="cancelaVentanaCol(<?php echo $this->id?>)"><i class="far fa-times-circle"></i>Cancelar</button>
		          <button type="submit" class="btn btn-success"><i class="fas fa-user-edit"></i>Editar</button>
		          <button type="button" id="" class="btn btn-warning" onclick="regresaVentanaCol()"><i class="fas fa-undo"></i>Regresar</button>
		        </div>
		      </div>
		</form>
		
	</section>

</div>
<?php require 'views/footer.php'; ?>
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
	(function () {
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
    

})();

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
