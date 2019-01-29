<?php
	$name="";
	include_once("../AnsTek_libs/integracion.inc.php");
	include_once("../model/usuarios.class.php");
	include_once("../model/firmantes.class.php");
	include_once("../resources/footer.php");
	// Session::valida_sesion("","../admin/logout.php");
	if(Session::get('Perfil') != 0  ){
		header('Location: ../admin/logout.php');
	}
	$firma ="";
	$name = Session::get('Nombre');
	$firmo = Session::get('firma_pacto');
	$cedula1 =Session::get('Cedula');

	$Id = Session::get('Id');

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
    <title>Preguntas Frecuentes Pactos CPNAA</title>
    <link rel="stylesheet" type="text/css" href="../front/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../front/css/style.css">
    <link rel="stylesheet" type="text/css" href="../front/css/login.css">
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
							<div class="row" style="margin-left: 0px; margin-right: 0px;">
								<div class="panel panel-login">
									<div class="panel-heading">
									    <div class="row">
									        <div class="col-xs-6">
									            <a href="#" class="active" id="login-form-link">Login</a>
									        </div>
									        <div class="col-xs-6">
									            <a href="#" id="register-form-link">Registrese</a>
									        </div>
									    </div>
									    <hr>
									</div>
								</div>
								<div class="panel-body">
									<div class="row">
										<div class="col-lg-12">
										    <form id="login-form" action="#" method="post" role="form" style="display: block;">
										    	<h3 class="text-center">INICIAR SESIÓN</h3>
										        <div class="form-group">
										            <input type="text" name="txtUser" id="txtUser" tabindex="1" class="form-control" placeholder="Usuario">
										        </div>
										        <div class="form-group">
										            <input type="password" name="txtPass" id="txtPass" tabindex="2" class="form-control" placeholder="Contraseña">
										            <input type="hidden" name="txtTab" id="txtTab" tabindex="2" class="form-control" value="1">
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
										                        <a href="../remember_password.php?v=1" tabindex="5" class="forgot-password">Olvido su contraseña?</a>
										                    </div>
										                </div>
										            </div>
										        </div>
										    </form>
										</div>
										<div class="col-lg-12">
											<form id="usuarios"  action="#" method="post" role="form" style="display: none;">
											      <div class="form-group">
											      <label class="">Adjuntar Logo (Dimensiones: 225px * 225px)</label>
											          <input type="file" class="form-control" name="txtImg" id="txtImg" autofocus>
											      </div>
											    <div class="form-group">
											      <input type="text" class="form-control" id="txtDoc" name="txtDoc" placeholder="Ingrese su cédula">
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
											      <input type="password" class="form-control" id="txtPass1" name="txtPass1" placeholder="Genere una contraseña">
											    </div>
											    <div class="form-group">
											      <input type="password" class="form-control" id="txtPass2" name="txtPass2" placeholder="Confirme su contraseña">
											       <input type="hidden" name="txtId" id="txtId" value="1">
											      <input type="hidden" name="accion" id="" value="ins">
											    </div>
											    <button type="submit" class="btn btn-default btn-register">Enviar</button>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
	          		</div>
	        	</div>
	      	</div>
	<!-- Fin modal -->


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
						  <button class="btn dropdown-toggle per" type="button" data-toggle="dropdown"><strong class="icon"><img src="../front/images/iniciar-session.png" class="" > </strong>'.$name.' - '.$nombreEmpresa.'
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
				<div class="row"><hr class="sepa">
					<p class="pre">¿Necesito un mínimo de arquitectos dentro de la empresa para firmar el pacto?</p>
					<p class="rta">No, los pactos se realizan para las organizaciones que tengan o vayan a contratar arquitectos y/o profesionales auxiliares de la arquitectura, sin importar el número.</p>
				</div>
				<div class="row"><hr class="sepa">
					<p class="pre">¿Cuáles son los compromisos al firmar el pacto?</p>
					<p class="rta">La firma es un compromiso VOLUNTARIO de las organizaciones a incrementar la divulgación y fortalecimiento de la ética en sus organizaciones. No hay contratos ni obligaciones, solo el sentido compromiso por escrito de hacer viva la ética en sus empresas y llevar a cabo las acciones requeridas de mejoramiento. </p>
				</div>
				<div class="row"><hr class="sepa">
					<p class="pre">¿ Tiene algún costo firmar el pacto?</p>
					<p class="rta">NO tiene ningún costo. No se pagan membresías y sostenimientos.</p>
				</div>
				<div class="row"><hr class="sepa">
					<p class="pre">¿ La Empresa que firma el pacto debe entregar recursos a alguna Entidad?</p>
					<p class="rta">No. Las organizaciones deben propender por buscar incrementar acciones dentro de sus empresas que les generen crecimiento organizacional, pero no deben entregar recursos a otras Entidades.

					De manera colaborativa, pueden integrarse a proyectos conjuntos que puedan o no involucrar recursos, pero siempre será una decisión voluntaria.
					</p>
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
    <script type="text/javascript" src="../front/js/login.js"></script>
    <script type="text/javascript" src="../js/validacion.js"></script>
    <script type="text/javascript" src="../js/process/registros.js"></script>

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