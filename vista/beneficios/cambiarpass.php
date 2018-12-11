<?php
	include_once("../../AnsTek_libs/integracion.inc.php");
	include_once("../resourcesView.php");
	Session::valida_sesion("","../../logout.php");
	if(Session::get('Perfil') != 1)
	header('Location: ../../logout.php');
	include_once("../../model/usuarios.class.php");
	$user = new usuario($db);
	$result = $user->selectAll();
	$Id= Session::get('Id');
?>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
  <meta name="author" content="GeeksLabs">
  <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
  <title><?php echo $title; ?></title>
 	<!-- Recursos Css -->
 	<?php recursos_css(); ?>
</head>
<body>

  <!-- container section start -->
  <section id="container" class="">
		<!-- pinta header -->
	   	<?php header_admin(); ?>
	    <!--header end-->
	    <!--pinta menu-->
	   	<?php getMenu(); ?>
	    <!--sidebar end-->
	    <!--main content start-->
	    <section id="main-content">
	      <section class="wrapper">
	        <!--overview start-->
	        <div class="row">
	          <div class="col-lg-12">
	            <h3 class="page-header"><i class="fa fa-laptop"></i>Cambiar contraseña</h3>
	            <ol class="breadcrumb">
	              <li><i class="fa fa-home"></i><a href="index.html">Inicio</a></li>
	              <li><i class="fa fa-laptop"></i>cambiar contraseña</li>
	            </ol>
	          </div>
	        </div>

				<div class="col-lg-offset-4 col-lg-4  panel panel-success">
					<div class="panel-heading">Cambiar contraseña</div>
					<div class="panel-body">
						<form id="cambiaPass" enctype="multipart/form-data">
						<div class="form-group">
							<label for="pwd">Nueva Contraseña:</label>
							<input type="text" class="form-control" id="txtPassU" name="txtPassU" placeholder="Ingrese su contraseña"  autofocus>
						</div>
						<div class="form-group">
							<label for="pwd">Confirmar Contraseña:</label>
							<input type="text" class="form-control" id="txtPassU2" name="txtPassU2" placeholder="Confirme su contraseña">
							<input type="hidden" name="txtIdU" id="txtIdU" value=<?php echo $Id;?>>
							<input type="hidden" name="txtTabP" id="txtTabP" value="1">
						</div>
						<button type="submit" class="btn btn-default">Cambiar</button>
						</form>
					</div>
					<div class="panel-footer"><button><i class="fa fa-home"></i></button></div>
				</div>

	      </section>
	      <!-- statics end -->
	    </section>
	    <!--main content end-->
	</section>
  <!-- Recursos javascripts -->
	<?php recursos_js() ?>
	<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
	<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
	<!-- <script type="text/javascript" src="../../js/jquery.validate.min.js"></script> -->
	<script type="text/javascript" src="../../js/process/usuarios.js"></script>
	<script>
	    $(document).ready(function() {


	    });
	</script>
</body>
</html>