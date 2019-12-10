<!DOCTYPE html>
<html >
<head>
	<meta charset="UTF-8">
	<meta http-equiv='cache-control' content='no-cache'>
	<meta http-equiv='expires' content='0'>
	<meta http-equiv='pragma' content='no-cache'>
  	<title></title>
	<link rel="stylesheet" href="<?php echo constant('URL')?>public/css/style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.css" >
</head>

<body>
    
	<div class="wrapper">
		<div class="hero-area">
			<div id="cenefa">
				<img id="pie" src="<?php echo constant('URL')?>public/img/logo.png">
			</div>
      
			<div class="container">
				<h1>Ingresa Usuario y Contraseña</h1>
			    
				<form action="<?php echo constant('URL');?>login/userExists" method="POST">
					<input placeholder="Usuario" name='user' autocomplete="off">
					<input type="password" placeholder="Contraseña" name='pass'>
					<button type="submit" name="login">Ingresar</button>
				</form>
        	</div>
	
			<ul class="bg-bubbles">
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
			</ul>
		</div>
  		<?php require 'views/footer.php';?>
		<script type="text/javascript">
			<?php echo $this->alerta; ?>
		</script>
		<script type="text/javascript">
			toastr.options = {
				'closeButton': false,
				'debug': false,
				'newestOnTop': false,
				'progressBar': false,
				'positionClass': 'toast-top-full-width',
				'preventDuplicates': false,
				'onclick': null,
				'showDuration': '250',
				'hideDuration': '1000',
				'timeOut': '5000',
				'extendedTimeOut': '1000',
				'showEasing': 'swing',
				'hideEasing': 'linear',
				'showMethod': 'fadeIn',
				'hideMethod': 'fadeOut'
				}
		</script>