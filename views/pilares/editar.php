<?php require 'views/header.php'?>
	<div class="card border-primary mb-3 mx-auto" style="max-width: 80rem;">
  <section class="wrapper">
    <div class="p-2 mb-2 bg-info text-white shadow rounded"><h4 id="" class="text-center">Editar Registro</h4></div>

    <form action="<?php echo constant('URL');?>pilares/editarPilar" method="POST">
      <div class="form-group">
           <div class="form-row">
            <div class="col-sm-6">
               <label for="nombre">Nombre</label>
               <input type="text" class="form-control "id="" name="nombre" required="required" value="<?php echo $this->valores->nombre ?>">
             </div>
             <div class="col-sm-6">
                   <label for="fecha">Fecha de Operación</label>
                   <input type="date" class="form-control "id="" name="fecha" required="required" value="<?php echo $this->valores->fecha ?>">
             </div>
          </div> 
            
            <div class="form-row">
                <div class="form-group col-sm-12">
                    <label for="alcaldia">Alcaldía:</label>
                    <select class="form-control selecciones" id="alcaldia" name="alcaldia">
                      <?php foreach ($this->alcaldias as $key) {
                        if ($this->valores->alcaldia==$key->nombre){
                         echo '<option value="'.$key->id.'" selected=true>'.$key->nombre.'</option>';
                        }else{
                          echo '<option value="'.$key->id.'">'.$key->nombre.'</option>';
                        }
                      }?>
                    </select>
              </div>
            </div>

           <div class="row">
             <div class="col-sm-12">
              <label for="ubicacion">Ubicación</label>
               <textarea class="form-control" name="ubicacion" maxlength="200"> <?php echo $this->valores->ubicacion ?></textarea>
             </div>
           </div>
      </div>

      <div class="form-group row">
        <div class="col-sm-12" name="seccion-directores" id="seccion-directores">
          <label for="responsable">Responsable</label>
          <select class="custom-select"  name="responsable" id="responsable">
             <?php foreach ($this->directores as $key) {
                        if ($this->valores->responsable==$key->id){
                         echo '<option value="'.$key->id.'" selected=true>'.$key->director.'</option>';
                        }else{
                          echo '<option value="'.$key->id.'">'.$key->director.'</option>';
                        }
                      }?>
          </select>
        </div>
      </div>
           


      
      <div class="form-group row ">
            <div class="col-sm-4">
              <input type="" hidden="true" name="id" value="<?php echo $this->id ?>">
            </div>
            <div class="col-sm-6 mx-auto">
              <button type="button" id="" class="btn btn-danger" onclick="cancelaVentanaPilares(<?php echo $this->id?>)"><i class="far fa-times-circle"></i>Cancelar</button>
              <button type="submit" class="btn btn-success"><i class="fas fa-user-edit"></i>Editar</button>
              <button type="button" id="" class="btn btn-warning" onclick="regresarPilares()"><i class="fas fa-undo"></i>Regresar</button>
            </div>
          </div>
    </form>
  </section>
</div>
<?php require 'views/footer.php'?>


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