<?php
	$name="";
	include_once("../AnsTek_libs/integracion.inc.php");
	// Session::valida_sesion("","../admin/logout.php");
	if(Session::get('Perfil') != 0  ){
		header('Location: ../admin/logout.php');
	}
	$name = Session::get('Nombre');
	if ($name == "") {
		$IS =" INICIAR SESIÓN";
	}


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
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
	<!-- Modal -->
	<div id="myModal" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Modal Header</h4>
	      </div>
	      <div class="modal-body">
	        <div class="container">
	                <div class="row">
	                    <div class="col-md-6">
	                        <div class="panel panel-login">
	                            <div class="panel-heading">
	                                <div class="row">
	                                    <div class="col-xs-6">
	                                        <a href="#" class="active" id="login-form-link">Login</a>
	                                    </div>
	                                    <div class="col-xs-6">
	                                        <a href="#" id="register-form-link">Register</a>
	                                    </div>
	                                </div>
	                                <hr>
	                            </div>
	                            <div class="panel-body">
	                                <div class="row">
	                                    <div class="col-lg-12">
	                                        <form id="login-form" action="#" method="post" role="form" style="display: block;">
	                                            <div class="form-group">
	                                                <input type="text" name="txtUser" id="txtUser" tabindex="1" Rclass="form-control" placeholder="Username" >
	                                            </div>
	                                            <div class="form-group">
	                                                <input type="password" name="txtPass" id="txtPass" tabindex="2" class="form-control" placeholder="Password">
	                                                <input type="hidden" name="txtTab" id="txtTab" tabindex="2" class="form-control" value="0">
	                                            </div>
	                                            <div class="form-group">
	                                                <div class="row">
	                                                    <div class="col-sm-6 col-sm-offset-3">
	                                                        <button type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login">ENTRAR</button>
	                                                    </div>
	                                                </div>
	                                            </div>
	                                            <div class="form-group">
	                                                <div class="row">
	                                                    <div class="col-lg-12">
	                                                        <div class="text-center">
	                                                            <a href="https://phpoll.com/recover" tabindex="5" class="forgot-password">Forgot Password?</a>
	                                                        </div>
	                                                    </div>
	                                                </div>
	                                            </div>
	                                        </form>
	                                    </div>
	                                    <div class="col-lg-12">
	                                    	<form id="usuarios"  action="#" method="post" role="form" style="display: none;">
	                                    	      <div class="form-group">
	                                    	      <label class="">Adjuntar Foto</label>
	                                    	          <input type="file" class="form-control" name="txtImg" id="txtImg" autofocus>
	                                    	      </div>
	                                    	    <div class="form-group">
	                                    	      <input type="text" class="form-control" id="txtDoc" name="txtDoc" placeholder="Ingrese su cedula">
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
	                                    	    </div>
	                                    	    <div class="form-group">
	                                    	      <input type="text" class="form-control" id="txtPass1" name="txtPass1" placeholder="Genere una contraseña">
	                                    	    </div>
	                                    	    <div class="form-group">
	                                    	      <input type="text" class="form-control" id="txtPass2" name="txtPass2" placeholder="Confirme su contraseña">
	                                    	       <input type="hidden" name="txtId" id="txtId" value="0">
	                                    	      <input type="hidden" name="accion" id="" value="ins">
	                                    	    </div>
	                                    	    <button type="submit" class="btn btn-default">Enviar</button>
	                                    	</form>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </div>

	  </div>
	</div>

	<div class="container login">
		<div class="row">
			<?php
				if ($name == "") {
					echo '
						<div class="col-xs-offset-8 col-sm-offset-10 col-md-offset-10 col-xs-4 col-sm-2 col-md-2 login-content">
							<strong class="icon"><a href="#" data-toggle="modal" data-target="#myModal"><img src="../front/images/iniciar-session.png" class="" ></strong><p>'.$IS.'</a></p>
						</div>

					';
				}else{
					echo '
						<div class="dropdown login-content" style="float: right;">
						  <button class="btn dropdown-toggle per" type="button" data-toggle="dropdown"><strong class="icon"><img src="../front/images/iniciar-session.png" class="" > </strong>'.$name.'
						  <span class="caret"></span></button>
						  <ul class="dropdown-menu">
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
	        <li><a href="#">INICIO</a></li>

	        <li><a href="../">FIRMA DE PACTO</a></li>
	        <li><a href="../#bene">BENEFICIOS</a></li>
	        <li><a href="../#resultados">VIVE LOS RESULTADOS</a></li>
	        <li><a href="../#experiencias">EXPERIENCIAS</a></li>
	        <li><a href="#">PREGUNTAS FRECUENTES</a></li>
	        <li><a href="../aliados/">FIRMANTES Y ALIADOS</a></li>
	      </ul>
	    </div>
	  </div>
	</nav>

	<div class="container franjapf">
		<div class="row">
			<div class="col-xs-6 col-sm-6 col-md-6">
				<h1 class="t">PREGUNTAS FRECUENTES</h1>
			</div>
		</div>
	</div>


	<div class="container mainpf">
		<div class="row">
			<div class="col-md-offset-1 col-md-10">
				<div class="row">
					<p class="pre">¿Existe algún requisito para firmar el pacto de autorregulación por el ejercicio ético de la profesión de la arquitectura y profesiones auxiliares?</p>
					<p class="rta">Ser una ser una organización legalmente constituida en Colombia y querer que la ética en general y de estas profesiones,  haga parte de manera visible en sus procesos. </p>
				</div>
				<div class="row">
					<p class="pre">¿Existe algún requisito para firmar el pacto de autorregulación por el ejercicio ético de la profesión de la arquitectura y profesiones auxiliares?</p>
					<p class="rta">Ser una ser una organización legalmente constituida en Colombia y querer que la ética en general y de estas profesiones,  haga parte de manera visible en sus procesos. </p>
				</div>
				<div class="row">
					<p class="pre">¿Existe algún requisito para firmar el pacto de autorregulación por el ejercicio ético de la profesión de la arquitectura y profesiones auxiliares?</p>
					<p class="rta">Ser una ser una organización legalmente constituida en Colombia y querer que la ética en general y de estas profesiones,  haga parte de manera visible en sus procesos. </p>
				</div>
				<div class="row">
					<p class="pre">¿Existe algún requisito para firmar el pacto de autorregulación por el ejercicio ético de la profesión de la arquitectura y profesiones auxiliares?</p>
					<p class="rta">Ser una ser una organización legalmente constituida en Colombia y querer que la ética en general y de estas profesiones,  haga parte de manera visible en sus procesos. </p>
				</div>
				<div class="row">
					<p class="pre">¿Existe algún requisito para firmar el pacto de autorregulación por el ejercicio ético de la profesión de la arquitectura y profesiones auxiliares?</p>
					<p class="rta">Ser una ser una organización legalmente constituida en Colombia y querer que la ética en general y de estas profesiones,  haga parte de manera visible en sus procesos. </p>
				</div>
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