<?php
	include_once("../AnsTek_libs/integracion.inc.php");
	include_once("../model/usuarios.class.php");
	include_once("../model/firmantes.class.php");
	include_once("../resources/footer.php");
	Session::valida_sesion("","../admin/logout.php");
	if(Session::get('Perfil') != 0)
	header('Location: ../admin/logout.php');
	

	$name = Session::get('Nombre');
	$firmo = Session::get('firma_pacto');
	$Id = Session::get('Id');
	$cedula1 =Session::get('Cedula');

	if ($cedula1 != "") {
		//OBJETO PARA CONSULTAR SI ES FIRMANTE
		$firmante = new firmante($db);
		$whereFir = " Where Cedula_Repre = ". $cedula1;
		$resultF= $firmante->selectAll($whereFir);
		if($db->numRows($resultF) > 0){
			if($rF = $db->datos($resultF)){
				$nombreEmpresa=$rF['Razon_social'];
				$cedulaRepresentante=$rF['Cedula_Repre'];

			}else{
				$nombreEmpresa = "NO ERES FIRMANTE";
			}
		}
		
	}else{

		
	}

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
					$firma = '<li><a href="firma_del_pacto/">FIRMA EL PACTO</a></li>';
				}else{
					$firma = '<li><a href="usuario/">USUARIO</a></li>';
				}

			}else{

			}
		}else{

		}


	}else{
		$IS =" INICIAR SESIÓN";
		$firma = '<li><a href="firma_del_pacto/">FIRMA EL PACTO</a></li>';

	}



?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Firma el Pacto con el CPNAA</title>
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
	<div id="Mensaje" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content mimodal">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">info</h4>
	      </div>
	      <div class="modal-body">
	        <p class="msj1">
	        Favor llena estos datos básicos de la empresa para iniciar el proceso para hacer parte de los Pactos de Autorregulación del CPNAA.
	    	</p>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </div>

	  </div>
	</div>

	<div class="container login">
		<div class="row">
			<div class="dropdown login-content" style="float: right;">
			  <button class="btn dropdown-toggle per" type="button" data-toggle="dropdown"><strong class="icon"><img src="../front/images/iniciar-session.png" class="" > </strong><?php echo $name. " - ".$nombreEmpresa; ?>
			  <span class="caret"></span></button>
			  <ul class="dropdown-menu">
			    <li><a href="../perfil/" title="">Perfil</a></li>
			    <li><a href="../cambiar_contrasena/" title="">Cambiar contraseña</a></li>
			    <li><a href="../logout.php" title="">Cerrar Sessión</a></li>
			  </ul>
			</div>
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

	        <li><a href="#">FIRMA DE PACTO</a></li>
	        <li><a href="../#bene">BENEFICIOS</a></li>
	        <li><a href="../#resultados">VIVE LOS RESULTADOS</a></li>
	        <li><a href="../#experiencias">EXPERIENCIAS</a></li>
	        <li><a href="../preguntas_frecuentes/">PREGUNTAS FRECUENTES</a></li>
	        <li><a href="../aliados/">FIRMANTES Y ALIADOS</a></li>
	      </ul>
	    </div>
	  </div>
	</nav>

	<div class="container">
		<div class="row">
			<img src="../front/images/fondo_firma_pacto.jpg" class="" width="100%">
		</div>
	</div>

	<div class="container cont_firma">
		<div class="row">
			<div class="col-sm-6 col-md-6">
				<div class="row descripcion_firma">
					<p>
						Entiendo que la ética y el ejercicio ético de la profesión debe hacer parte de la
						dinámica normal de las organizaciones, participar voluntariamente en este pacto
						hemos buscado que la ejecución  no implique tareas engorrosas para las
						organizaciones, sino por el contrario los apoye en esas dinámicas. El pacto
						entonces se conviene como un reto que le da vida al ejercicio ético de la profesión
						y al compromiso de viva voz de las organizaciones.
					</p>

				</div>
				<div class="row firmantes">
					<p>Los firmantes del pacto por el ejercicio ético y responsable se comprometen a :</p>
				</div>
				<div class="row"><br>
					<div class="col-sm-6 col-md-6">
						<div class="number">
							1
						</div>
						<div class="number_p">
							<p>
								Capacitar y formar el talento humano  en ética.
							</p>

						</div>
					</div>
					<div class="col-sm-6 col-md-6">
						<div class="number">
							2
						</div>
						<div class="number_p">
							<p>
								Incluir la ética como parte de la estrategia de crecimiento organizacional.
							</p>

						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6 col-md-6">
						<div class="number">
							3
						</div>
						<div class="number_p">
							<p>
								Promover la difusión, el entendimiento  y el compromiso
								de los pactos de autorregulación.
							</p>

						</div>
					</div>
					<div class="col-sm-6 col-md-6">
						<div class="number">
							4
						</div>
						<div class="number_p">
							<p>
								Nombrar un veedor de la ética dentro de la organización que ayuda a palancar
								y transmitir la información del cpnaa relacionada con esta temática.
							</p>

						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6 col-md-6">
						<div class="number">
							5
						</div>
						<div class="number_p">
							<p>
								Incluir en los procesos de inducción y re inducción la participación
								en la plataforma virtual de aprendizaje del cpnaa
							</p>

						</div>
					</div>
					<div class="col-sm-6 col-md-6">
						<div class="number">
							6
						</div>
						<div class="number_p">
							<p>
								Reportar al CPNAA  de manera permanente a los arquitectos
								y profesionales auxiliares de la arquitectura , producto de nuevas contrataciones.
							</p>

						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6 col-md-6">
						<div class="number">
							7
						</div>
						<div class="number_p">
							<p>
								Propiciar la participación de los trabajadores en eventos que realice el CPNAA
								y sus aliados para el fomento del ejercicio ético.
							</p>

						</div>
					</div>
					<div class="col-sm-6 col-md-6">
						<div class="number">
							8
						</div>
						<div class="number_p">
							<p>
								Generar espacios en sus eventos congresos y actividades masivas
								en los que el CPNAA pueda hacer divulgación de sus funciones.
							</p>

						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-6 col-md-6">
				<!-- formulario para la firma del pacto -->
				<div class="row">
					<form  class="from_pacto"  id="from_pacto" enctype="multipart/form-data">
						<h4>PACTOS POR LA  <br> AUTORREGULACIÓN</h4>
						<div class="form-group">
							<label>Información de la Empresa:</label>
						</div>
					  <div class="form-group">
					    <input type="text" class="form-control input" id="txtRazon" name="txtRazon" placeholder="Razón Social" autofocus="true">
					  </div>
					  <div class="form-group">
					    <input type="text" class="form-control input" name="txtNit" id="txtNit" placeholder="Nit">
					  </div>
					  <div class="form-group">
					    <input type="text" class="form-control input" name="txtTel" id="txtTel" placeholder="Teléfono">
					  </div>
					  <div class="form-group">
					    <input type="text" class="form-control input" name="txtPag" id="txtPag" placeholder="Página Web">
					  </div>
					  <div class="form-group">
					  	<label>Información Representante Legal:</label>
					  </div>
					  <div class="form-group">
					    <input type="text" class="form-control input" name="txtRep" id="txtRep" placeholder="Nombre Completo">
					  </div>
					  <div class="form-group">
					    <input type="text" class="form-control input" name="txtCed" id="txtCed" placeholder="Cédula">
					  </div>
					  <div class="form-group">
					    <input type="text" class="form-control input" name="txtTelR" id="txtTelR" placeholder="Teléfono de contacto">
					  </div>
					  <div class="form-group">
					    <input type="email" class="form-control input" name="txtEmailR" id="txtEmailR" placeholder="Email">
					  </div>
					  <div class="form-group">
					  	<label>Información Responsable del Pacto:</label>
					  </div>
					  <div class="form-group">
					    <input type="text" class="form-control input" name="txtRes" id="txtRes" placeholder="Nombre Completo">
					  </div>
						<div class="form-group">
					    <input type="text" class="form-control input" name="txtCedR" id="txtCedR" placeholder="Cédula">
					  </div>
					  <div class="form-group">
					    <input type="text" class="form-control input" name="txtTelRes" id="txtTelRes" placeholder="Teléfono">
					  </div>
					  <div class="form-group">
					    <input type="text" class="form-control input" name="txtEmailres" id="txtEmailres" placeholder="Email">
					    <input type="hidden" class="form-control input" name="txtId" id="txtId" value="0">
					    <input type="hidden" class="form-control input" name="accion"  value="ins">
					  </div>
					<div class="form-group">
					    <input type="checkbox" class="" name="txtTer" id="txtTer">
					    <label for="txtTer">Acepto la firma del pacto</label>
					  </div>


					  <button type="submit" class="btn btn-default">HAZTE FIRMANTE</button>
					</form>
				</div>
			</div>
		</div>
	</div>


	<!-- IMPRIMIMOS FOOTER -->
	<?php footer2(); ?>



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
      	$('#Mensaje').modal({
      	  keyboard: false
      	})


      });

    $(function(){
      $('#txtTel').validCampoFranz('0123456789');
    });
    </script>
</body>
</html>