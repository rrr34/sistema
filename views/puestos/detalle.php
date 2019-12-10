<?php require 'views/header.php';?>
   <div class="card border-primary mb-3 mx-auto" style="max-width: 80rem;">
  <section class="wrapper">
    <div class="p-2 mb-2 bg-info text-white shadow rounded"><h4 id="" class="text-center">Editar Registro</h4></div>

    <form action="<?php echo constant('URL');?>puestos/editarPuesto" method="POST">
      <div class="form-group">
          <div class="form-row">
            <div class="form-group col">
              <label for="puesto">Cargo</label>
              <input type="text" class="form-control "id="puesto" name="puesto" required="required" value="<?php echo $this->valores->PUESTO ?>">
            </div>
            <div class="form-group col">
              <label for="tipo">Clasificación:</label>
              <select class="form-control selecciones" id="tipo" name="tipo">
                <?php if($this->valores->TIPO == "Estructura"){ ?>
                  <option value="Estructura" selected="true">Estructura</option>
                  <option value="Honorario">Honorario</option>
                  <option value="Base">Base</option>
                <?php }  else if($this->valores->TIPO == "Honorario"){ ?>
                  <option value="Honorario" selected="true">Honorario</option>
                  <option value="Estructura">Estructura</option>
                  <option value="Base">Base</option>
                <?php } else{?>
                  <option value="Honorario">Honorario</option>
                  <option value="Estructura">Estructura</option>
                  <option value="Base" selected="true">Base</option>
                <?php }?>
              </select>
            </div>
           </div>
      </div>
      <div class="form-group">
        <div class="form-row">
          <div class="col-5">
          <label for="superior">Superior Inmediato:</label>
          <select class="form-control selecciones" id="superior" name="superior">
             <?php  
            foreach ($this->datos as $k)
                {
                       if($this->valores->SUPID==$k->ID){
                        echo '<option  value="'.$k->ID.'" selected=true>'.$k->PUESTO.'</option>';
                       }else{
                        echo '<option value="'.$k->ID.'">'.$k->PUESTO.'</option>';
                       }
                       
                 
                }?>
          </select>
          </div>
          <div class="col-4">
          <label for="superior">Área:</label>
          <select class="form-control selecciones" id="area" name="area">
             <?php  
            foreach ($this->areas as $k)
                {
                       if($this->valores->AREA==$k->id){
                        echo '<option  value="'.$k->id.'" selected=true>'.$k->puesto.'</option>';
                       }else{
                        echo '<option value="'.$k->id.'">'.$k->puesto.'</option>';
                       }
                       
                 
                }?>
          </select>
          </div>
          <div class="col-3">
            <label for="nivel">Nivel:</label>
           
          <select class="form-control selecciones" id="nivel" name="nivel">

            <option value=0>0-Honorario</option>
            <option value=20>20-Enlace</option>
            <option value=24>24-LCP</option>
            <option value=25>25-JUD</option>
            <option value=29>29-Subdirector</option>
            <option value=39>39-Director</option>
            <option value=46>46-Coordinador</option>
          </select>
          </div>
          </div>
      </div>
      <div>
        <input type="" name="id" hidden="hidden" value="<?php echo $this->id?>">
      </div>
      <div class="form-group row ">
            <div class="col-sm-4"></div>
            <div class="col-sm-6 mx-auto">
              <button type="button" id="cancelarColaborador" class="btn btn-danger" onclick="cancelaVentanaPuesto(<?php echo $this->id?>)"><i class="far fa-times-circle"></i>Cancelar</button>
              <button type="submit" class="btn btn-success"><i class="fas fa-user-edit"></i>Editar</button>
              <button type="button" id="" class="btn btn-warning" onclick="regresarPuestos()"><i class="fas fa-undo"></i>Regresar</button>
            </div>
          </div>
    </form>
  </section>
</div>
<?php require 'views/footer.php';?>
<?php if(is_null($this->valores->SUPID)){$this->valores->SUPID=1;}  ?>
<script>
  
  $(document).ready(function() {
     var nivel=document.getElementById("nivel");
     var tipo=document.getElementById("tipo");
     var superior=document.getElementById("superior");
     var nivel_comp=<?php echo $this->valores->NIVEL;?>;
     var tipo_comp="<?php echo $this->valores->TIPO;?>";
     var superior_comp=<?php echo $this->valores->SUPID;?>;
     nivel.selectedIndex=asignacion(nivel,nivel_comp);
     tipo.selectedIndex=asignacion(tipo,tipo_comp);
     superior.selectedIndex=asignacion(superior,superior_comp);
  });

 function asignacion(dd,evaluado) {
   var aryOptions=dd.getElementsByTagName('option');
     var cpt=0;
     var indexValue=false;
    for(cpt=0;cpt<aryOptions.length;cpt++){
      if (aryOptions[cpt].value==evaluado) {
        indexValue=cpt;  }
      }
    return indexValue;
 }
 </script> 
 <script> <?php echo $this->alerta; ?></script> 
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
</script>
