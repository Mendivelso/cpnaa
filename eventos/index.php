<?php
	$name="";
	include_once("../AnsTek_libs/integracion.inc.php");
	include_once("../model/eventos.class.php");
	include_once("../model/usuarios.class.php");
	// Session::valida_sesion("","../admin/logout.php");
	if(Session::get('Perfil') != 0  ){
		header('Location: ../admin/logout.php');
	}
	$name = Session::get('Nombre');
	if ($name == "") {
		$IS =" INICIAR SESIÓN";
	}
	// Objeto clase eventos
	$event = new evento($db);
	$where = " Where Status = 1";
	$result = $event->selectAll($where);

	$Id = Session::get('Id');


	if ($Id != "") {
		//OBJETO USUARIOS
		$Vuser = new usuario($db);
		$where = " Where Us.Id = ".$Id;
		$resultUser = $Vuser->selectAll($where);
		if($db->numRows($resultUser) > 0){
			if($rU = $db->datos($resultUser)){
				$rU['firma_pacto'];
				$firmo = $rU['firma_pacto'];
				if ($firmo == 0) {
					$IS =" INICIAR SESIÓN";
					$firma = '<li><a href="../firma_del_pacto/">FIRMA EL PACTO</a></li>';
				}else{
					$firma = '<li><a href="../usuario/">USUARIO</a></li>';
				}

			}else{

			}
		}else{

		}


	}else{
		$IS =" INICIAR SESIÓN";
		$firma = '<li><a href="#">FIRMA EL PACTO</a></li>';
	}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventos Cpnaa</title>
    <link rel="stylesheet" type="text/css" href="../front/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../front/css/style.css">
    <link rel="stylesheet" type="text/css" href="../front/css/alertify.core.css">
    <link rel="stylesheet" type="text/css" href="../front/css/alertify.default.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../front/css/sweetalert.css">
    <link rel="shortcut icon" href="../front/img/favicon.ico"/>
    <!-- Galeria -->
    <!-- Load miSlider -->
    <link href="../front/css/mislider.css" rel="stylesheet">
    <link href="../front/css/mislider-skin-cameo.css" rel="stylesheet">
    <link href="../front/css/styles.css" rel="stylesheet">

</head>
<body data-spy="scroll" data-target=".navbar" data-offset="60">

	<div class="container login">
		<div class="row">
			<?php
				if ($name == "") {
					echo '
						<div class="col-xs-offset-6 col-sm-offset-8 col-md-offset-10 col-xs-6 col-sm-4 col-md-2 login-content">
							<strong class="icon"><a href="#" data-toggle="modal" data-target="#myModal"><img src="../front/images/iniciar-session.png" class="" ></strong><p>'.$IS.'</a></p>
						</div>

					';
				}else{
					echo '
						<div class="dropdown login-content" style="float: right;">
						  <button class="btn dropdown-toggle per" type="button" data-toggle="dropdown"><strong class="icon"><img src="../front/images/iniciar-session.png" class="" > </strong>'.$name.'
						  <span class="caret"></span></button>
						  <ul class="dropdown-menu">
						    <li><a href="../perfil/" title="">Perfil</a></li>
						    <li><a href="../cambiar_contrasena/" title="">Cambiar contraseña</a></li>
						    <li><a href="../logout.php" title="">Cerrar Sessión</a></li>
						  </ul>
						</div>

					';
				}
			 ?>
		</div>
	</div>
	<nav class="navbar container not navbar-inverse">
	  <div class="container not">
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      <a class="navbar-brand" href="#"><img src="../front/images/logo.png" class="logo" width="100%"></a>
	    </div>
	    <div class="collapse navbar-collapse not" id="myNavbar">
	      <ul class="nav navbar-nav">
	        <li><a href="../#">INICIO</a></li>
			<?php echo $firma; ?>
	        <li><a href="../#bene">BENEFICIOS</a></li>
	        <li><a href="../#resultados">VIVE LOS RESULTADOS</a></li>
	        <li><a href="../#experiencias">EXPERIENCIAS</a></li>
	        <li><a href="../preguntas_frecuentes/">PREGUNTAS FRECUENTES</a></li>
	        <li><a href="../aliados/">FIRMANTES Y ALIADOS</a></li>
	      </ul>
	    </div>
	  </div>
	</nav>

	<div class="container franjapf">
		<div class="row">
			<div class="col-xs-6 col-sm-6 col-md-6">
				<h1 class="t">EVENTOS Y ACTIVIDADES</h1>
			</div>
		</div>
	</div>


	<div class="container mainpf">
		<div class="row">
			<div class="col-md-offset-1 col-md-10">
				<?php
				if($db->numRows($result) > 0){
				  while ($r = $db->datos($result)) {

				    echo '
						<div class="row text-justify pe">
							<div class="col-md-5 text-center">
								<img src="../'.$r['Imagen_principal'].'" alt="'.$r['Titulo'].'" class="img_evento">
							</div>
							<div class="col-md-7">
								<h3>'.$r['Titulo'].'</h3>
								<p>'.$r['Descripcion'].'</p>
								<h5>Fecha del evento: <strong>2018-12-07</strong></h5>
								<a href="'.$r['Enlace'].'" class="btn sitio" target="black">Sitio web</a>

							</div>
							<div class="col-md-offset-1 col-md-10 separador"></div>
						</div>
				    ';
				  }
				}
				else{
				  echo "NO HAY REGISTROS PARA MOSTRAR";
				}
				?>
			</div>
		</div>
	</div>




	<footer class="container text-center bg">
		<p>www.cpnaa.gov.co</p>
		<ul class="redes">
			<li><a href=""><img src="../front/images/face.png"></a></li>
			<li><a href=""><img src="../front/images/twi.png"></a></li>
			<li><a href=""><img src="../front/images/goo.png"></a></li>
			<li><a href=""><img src="../front/images/you.png"></a></li>
			<li><a href=""><img src="../front/images/ins.png"></a></li>
			<li><a href=""><img src="../front/images/link.png"></a></li>
		</ul>
		<p>
			Carrera 6 No. 26 B - 85 - Oficina 201 - Bogotá D.C.- Colombia. <br>
			Línea de atención telefónica en Bogotá  (57-1)   3 50 27 00 Extensiones 101 y 124 <br>
			Correo electrónico:  info@cpnaa.gov <br>
			Horario de atención: Lunes a Jueves de 7:00 am a 1:00 pm y 2:00 pm a 5:00 pm y Viernes de 7:00 am a 1:00 pm y 2:00 pm a 4:00 pm. <br>
			Consejo Profesional Nacional de Arquitectura y sus Profesiones Auxiliares. Nit. 830.059.954-7
		</p>
	</footer>



    <!-- Scripts -->
    <script type="text/javascript" src="../front/js/jquery.min.js"></script>
    <script type="text/javascript" src="../front/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../front/js/jquery.validate.min.js"></script>
    <script type="text/javascript" src="../js/process/firma_pacto.js"></script>
    <script type="text/javascript" src="../front/js/alertify.min.js"></script>
    <script type="text/javascript" src="../front/js/valid.js"></script>

    <script type="text/javascript" src="../front/js/sweetalert.min.js"></script>


    <script type="text/javascript">
      $(document).ready(function(){



      });

    $(function(){
      $('#txtTel').validCampoFranz('0123456789');
    });
    </script>
</body>
</html>