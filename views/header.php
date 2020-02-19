<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
      <link rel="stylesheet" href="<?php echo constant('URL')?>public/css/select2.min.css">
      <link rel="stylesheet" href="<?php echo constant('URL')?>public/css/select2-bootstrap4.min.css">
      
      <link rel="stylesheet" href="<?php echo constant('URL')?>public/css/dataTables.bootstrap4.min.css">
      <link rel="stylesheet" href="<?php echo constant('URL')?>public/css/buttons.dataTables.min.css">
      
      <link rel="stylesheet" href="<?php echo constant('URL')?>public/css/normalize.css">
      <link rel="stylesheet" href="<?php echo constant('URL')?>public/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.css" > 
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
      <link rel="stylesheet" href="<?php echo constant('URL')?>public/css/externo.css">
    
    

    <title>Coordinación General de Educación</title>
  </head>

  <header>
  	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="<?php echo constant('URL')?>principal">PILARES</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        
        <ul class="navbar-nav  mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="<?php echo constant('URL')?>principal">Inicio<span class="sr-only">(current)</span></a>
          </li>        
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Nuevo
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="<?php echo constant('URL')?>colaboradores/nuevo">Colaborador</a>
              <a class="dropdown-item" href="<?php echo constant('URL')?>puestos/nuevo">Puesto</a>
              <a class="dropdown-item" href="<?php echo constant('URL')?>pilares/nuevo">PILARES</a>
              <a class="dropdown-item" href="<?php echo constant('URL')?>brigadas/nuevo">Brigada 333</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Consultas
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="<?php echo constant('URL')?>colaboradores">Colaboradores</a>
              <a class="dropdown-item" href="<?php echo constant('URL')?>puestos">Puestos</a>
               <a class="dropdown-item" href="<?php echo constant('URL')?>organigramas">Organigrama</a>
                <a class="dropdown-item" href="<?php echo constant('URL')?>honorarios">Honorarios</a>
                <a class="dropdown-item" href="<?php echo constant('URL')?>pilares">Pilares y Responsables</a>
                <a class="dropdown-item" href="<?php echo constant('URL')?>brigadas">Brigadas</a>
                          
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Estadísticas
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              
              <a class="dropdown-item" href="<?php echo constant('URL')?>estadisticas">Distribución de L.C.P por Alcaldías</a>
              <a class="dropdown-item" href="<?php echo constant('URL')?>estadisticas/distribucionGlobal">Distribución General por Género y Ubicación</a>
              <a class="dropdown-item" href="<?php echo constant('URL')?>estadisticas/distribucionZona">Distribución de L.C.P por Subdirección Operativa</a>
              <a class="dropdown-item" href="<?php echo constant('URL')?>estadisticas/edades">Distribución por intervalo de edades</a>
              <a class="dropdown-item" href="<?php echo constant('URL')?>estadisticas/edadesGeneral">Distribución General por intervalo de edades</a>
              <a class="dropdown-item" href="<?php echo constant('URL')?>estadisticas/nivelesEducativos">Distribución Niveles Educativos</a>
            </div>
          </li>
          </ul>
        <ul class="navbar-nav pull-xs-right">
           <li class="nav-item " >
             <a class="nav-link" id="color-rojo" href="<?php echo constant('URL')?>login/cerrarSesion"><i class="fas fa-sign-out-alt"></i>Cerrar Sesión</a>
           </li>
        </ul>

      </div>
    </nav>

  </header>
   <div class="container-fluid">
  <body>

    