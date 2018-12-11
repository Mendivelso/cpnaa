<?php
	include_once("../../AnsTek_libs/integracion.inc.php");
	include_once("../resourcesView.php");
	Session::valida_sesion("","../../logout.php");
	if(Session::get('Perfil') != 1)
	header('Location: ../../logout.php');
	include_once("../../model/usuarios.class.php");
	$user = new usuario($db);
	$result = $user->selectAll();
	 $Id = Session::get('Id');
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
	            <h3 class="page-header"><i class="fa fa-laptop"></i>Datos de usuario</h3>
	            <ol class="breadcrumb">
	              <li><i class="fa fa-home"></i><a href="index.html">Inicio</a></li>
	              <li><i class="fa fa-laptop"></i>perfil</li>
	            </ol>
	          </div>
	        </div>
			<section class="panel panel-success text-center">
				<h2>A continuación podras modificar tus datos personales</h2>
				<div class="col-lg-offset-3 col-lg-6 text-center panel panel-info">
					<form id="usuarios" enctype="multipart/form-data">
					<div class="linkImg"></div>
					<div class="form-group">
					<label class="">Cambiar Foto de perfil</label>
						<input type="file" class="form-control" name="txtImg" id="txtImg">
					</div>
					<div class="form-group">
					<input type="text" class="form-control" id="txtDoc" name="txtDoc" placeholder="Ingrese su cedula"  autofocus>
					</div>
					<div class="form-group">
					<input type="text" class="form-control" id="txtName" name="txtName" placeholder="Ingrese su nombre">
					</div>
					<div class="form-group">
					<input type="text" class="form-control" id="txtDir" name="txtDir" placeholder="Ingrese su dirección">
					</div>
					<div class="form-group">
					<input type="text" class="form-control" id="txtTel" name="txtTel" placeholder="Ingrese su teléfono">
					</div>
					<div class="form-group">
					<input type="text" class="form-control" id="txtEml" name="txtEml" placeholder="Ingrese su E-mail">
					</div>
					<div class="form-group">
					<input type="text" class="form-control" id="txtUser" name="txtUser" placeholder="Ingrese un nombre de Usuario">
					<input type="hidden" name="txtId" id="txtId">
					</div>
					<div id="upd"></div>
					<button type="submit" class="btn btn-default">Enviar</button>
					</form>
				</div>
			</section>
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
	    	var vId = '<?php echo $Id; ?>';
	    	perfil(vId,1);


	    });
	</script>
</body>
</html>