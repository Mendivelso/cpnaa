<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" type="text/css" href="front/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="front/css/style.css">
    <link rel="stylesheet" type="text/css" href="front/css/login.css">
    <link rel="stylesheet" type="text/css" href="front/css/alertify.core.css">
    <link rel="stylesheet" type="text/css" href="front/css/alertify.default.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="front/css/sweetalert.css">
    <link rel="shortcut icon" href="front/img/favicon.ico"/>

    <!-- Galeria -->
    <!-- Load miSlider -->
    <link href="front/css/mislider.css" rel="stylesheet">
    <link href="front/css/mislider-skin-cameo.css" rel="stylesheet">
    <link href="front/css/styles.css" rel="stylesheet">
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
			<div class="col-xs-offset-8 col-sm-offset-10 col-md-offset-10 col-xs-4 col-sm-2 col-md-2 login-content">
				<strong class="icon"><a href="#" data-toggle="modal" data-target="#myModal"><img src="front/images/iniciar-session.png" class="" ></strong><p>INICIAR SESIÓN</a></p>
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
	      <a class="navbar-brand" href="#"><img src="front/images/logo.png" class="logo" width="100%"></a>
	    </div>
	    <div class="collapse navbar-collapse not" id="myNavbar">
	      <ul class="nav navbar-nav">
	        <li><a href="#">INICIO</a></li>

	        <li><a href="#">FIRMA DE PACTO</a></li>
	        <li><a href="#">BENEFICIOS</a></li>
	        <li><a href="#">VIVE LOS RESULTADOS</a></li>
	        <li><a href="#">EXPERIENCIAS</a></li>
	        <li><a href="#">PREGUNTAS FRECUENTES</a></li>
	        <li><a href="#">FIRMANTES Y ALIADOS</a></li>
	      </ul>

	    </div>
	  </div>
	</nav>

	<div class="container bm">
		<div class="row">
			<img src="front/images/banner_movil.jpg" class="" width="100%">
		</div>
	</div>

	<div class="container banner">
		<div class="row">
			<div class="col-xs-3 col-sm-3 col-md-3"></div>
			<div class="col-xs-3 col-sm-3 col-md-3 text-center">
				<div class="title"><p>PACTOS POR LA <br><strong>AUTORREGULACIÓN</strong> </p></div>

			</div>
			<div class="col-xs-1 col-sm-1 col-md-1"></div>
			<div class="col-xs-5 col-sm-9 col-md-5 ejercicio">
				<div class="row">
					<p>Por un ejercicio <span>ético y responsable</span> de la arquitectura en Colombia </p>
				</div>
			</div>

		</div>

	</div>


	<div class="container company">
		<div class="row">
			<div class="col-xs-12 col-sm-6 col-md-6">
				<h3 class="text-center"> EL SUEÑO:</h3>
				<p>
					Esta estrategia busca incrementar el número de empresas, sin importar su tamaño,
					a nivel nacional con capacidad de incrementar el compromiso con el ejercicio ético
					y responsable de la profesión de la arquitectura y las profesiones auxiliares,
					fortaleciendo conocimientos blandos y fortaleciendo las acciones éticas
					y responsables  en sus acciones.
				</p>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-6">
				<h3 class="text-center">EL OBJETIVO:</h3>
				<p>
					El objetivo principal de esta iniciativa, es lograr que los empresarios Colombianos,
					con el apoyo del CPNAA, trabajen en las organizaciones para fortalecer el ejercicio
					ético y responsable de la arquitectura y las profesiones auxiliares.
				</p>
			</div>
		</div>
	</div>


	<div class="container white">
		<div class="row">
			<div class="col-sm-11 col-md-11 beneficios pd">
				<div class="col-xs-6 col-sm-6 col-md-6">
					<h1 class="t">BENEFICIOS</h1>
				</div>
				<div class="col-xs-6 col-sm-6 col-md-6">
					<p class="p">Una vez firmado el pacto, puedes acceder a diferentes oportunidades:</p>
				</div>
			</div>
		</div>
		<div class="row line">
		</div>
	</div>


	<div class="container white">
		<div class="row">
			<div id="beneficios" class="carousel slide col-xs-offset-1 col-sm-offset-1 col-md-offset-1 col-xs-10 col-sm-10 col-md-10" data-ride="carousel">
			  <!-- Indicators -->
			  <ol class="carousel-indicators">
			    <li data-target="#beneficios" data-slide-to="0" class="active"></li>
			    <li data-target="#beneficios" data-slide-to="1"></li>
			    <li data-target="#beneficios" data-slide-to="2"></li>
			  </ol>

			  <!-- Wrapper for slides -->
			  <div class="carousel-inner">
			    <div class="item active">
			      <img src="front/images/beneficios_1.png" alt="Chania" width="100%">
			      <div class="carousel-caption">
			      	<div class="col-md-8 text-galeria">
			      		<div class="cnt_t">
			      			<p>Acceso a documentos y módulos de aprendizaje a través de la página web del CPNAA</p>
			      		</div>

			      	</div>

			      </div>
			    </div>

			    <div class="item">
			      <img src="front/images/beneficios_1.png" alt="Chicago" width="100%">
			      <div class="carousel-caption">
			      	<div class="col-md-8 text-galeria">
			      		<div class="cnt_t">
			      			<p>Acceso a documentos y módulos de aprendizaje a través de la página web del CPNAA</p>
			      		</div>

			      	</div>

			      </div>
			    </div>

			    <div class="item">
			      <img src="front/images/beneficios_1.png" alt="New York" width="100%">
			      <div class="carousel-caption">
			      	<div class="col-md-8 text-galeria">
			      		<div class="cnt_t">
			      			<p>Acceso a documentos y módulos de aprendizaje a través de la página web del CPNAA</p>
			      		</div>

			      	</div>

			      </div>
			    </div>
			  </div>

			  <!-- Left and right controls -->
			  <a class="left carousel-control" href="#beneficios" data-slide="prev">
			    <img src="front/images/flecha-hacia-la-izquierda.png" class="dir">
			  </a>
			  <a class="right carousel-control" href="#beneficios" data-slide="next">
			    <img src="front/images/flecha-derecha.png" class="dir">
			  </a>
			</div>
		</div><br>
	</div>


	<div class="container resultados white">
		<div class="row">
			<div class="col-xs-6 col-sm-6">
				<h1 class="result">VIVE LOS <span>RESULTADOS</span></h1>
			</div>
		</div>
	</div>

	<div class="container white">
		<div class="row">
			<div class="col-sm-offset-1 col-md-offset-1 col-xs-12 col-sm-10 col-md-10 plano">
				<div class=" col-md-offset-1 col-sm-12 col-md-10">
					<div class="row msj">
						<p>Sabemos lo importante que es para tu organización hacer visible el
					compromiso con el  ejercicio ético y responsable de la arquitectura, para los siguientes procesos:</p>
					</div>
					<div class="row">
						<div class="row">
							<ul class="resul">
								<li class="pestana"></li>
								<li class="pestana"></li>
								<li class="pestana"></li>
								<li class="pestana"></li>
								<li class="pestana"></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<div class="container white">
		<div class="row">
			<div class="col-sm-11 col-md-11 beneficios pd">
				<div class="col-xs-6 col-sm-6 col-md-6">
					<h1 class="t">PARA ELLO EL CPNAA</h1>
				</div>
				<div class="col-md-6">

				</div>
			</div>
		</div>
	</div>


	<div class="container white para_cpnaa">
		<div class="row">
			<div class=" col-md-offset-1 col-xs-12 col-sm-12 col-md-10">
				<div class="col-xs-6 col-sm-6 col-md-6 border_r"><br>
					<div class="row">
						<div class="col-sm-4 col-md-4"><img src="front/images/circle_1.png" class="num"></div>
						<div class="col-sm-8 col-md-8">
							<p>
								Divulgara en sus redes sociales  las actividades y logros
								alcanzados en el ejercicio ético y responsable de la profesión.
							</p>
						</div>



					</div>
					<div class="row"><br>
						<div class="col-sm-4 col-md-4"><img src="front/images/circle_3.png" class="num"></div>
						<div class="col-sm-8 col-md-8">
							<p>
								Divulgara a través del boletín que llega a las de 35.000 profesionales a Nivel Nacional.
							</p>
						</div>

					</div>

				</div>
				<div class="col-xs-6 col-sm-6 col-md-6">
					<div class="row"><br>
						<div class="col-sm-4 col-md-4"><img src="front/images/circle_2.png" class="num"></div>
						<div class="col-sm-8 col-md-8">
							<p>
								Gestiónara las comunicaciones con medios y en revistas donde se
								resalte el ejercicio ético y responsable de la arquitectura de las
								empresas que han alcanzado objetivos con el pacto.
							</p>
						</div>

					</div>
					<div class="row"><br class="none">
						<div class="col-sm-4 col-md-4"><img src="front/images/circle_4.png" class="num"></div>
						<div class="col-sm-8 col-md-8">
							<p>
								El CPNAA en el Encuentro de Responsabilidad social de arquitectura que realiza cada dos años,
								exaltará de manera pública y ante los medios de comunicación a las organizaciones que hayan firmado
								el pacto y que se hayan comprometido activamente con el desarrollo de las actividades propuestas y otras, en el fomento de la ética.
							</p>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>


	<div class="container resultados white">
		<div class="row">
			<div class="col-xs-6 col-sm-6">
				<h1 class="result">EXPERIENCIAS</span></h1>
			</div>
		</div>
	</div>

	<div class="container white">
		<div class="row">
			<div class="col-sm-offset-1 col-md-offset-1 col-sm-10 col-md-10">
				<div class="col-sm-offset-1 col-md-offset-1 col-sm-10 col-md-10 msj">
					<p>
						En la siguiente sección de la pagína se listan los casos de exito  <br> más importantes para el CPNAA
					</p>
				</div>
			</div>
		</div>

		<!-- Galeria -->
		<div class="row">
			<figure class="pdd1">
			    <div class="mis-stage">
			        <!-- The element to select and apply miSlider to - the class is optional -->
			        <ol class="mis-slider">


				 	<li class="mis-slide">
				 	    <a href="#" class="mis-container">
				 	        <figure onclick="">
				 	            <img src="front/images/arq1.jpg" alt='titulo1'>
				 	            <figcaption>Titulo 1</figcaption>
				 	        </figure>
				 	    </a>
				 	</li>

					<li class="mis-slide">
					    <a href="#" class="mis-container">
					        <figure onclick="">
					            <img src="front/images/arq2.jpg" alt='titulo1'>
					            <figcaption>Titulo 1</figcaption>
					        </figure>
					    </a>
					</li>

					<li class="mis-slide">
					    <a href="#" class="mis-container">
					        <figure onclick="">
					            <img src="front/images/arq3.jpg" alt='titulo1'>
					            <figcaption>Titulo 1</figcaption>
					        </figure>
					    </a>
					</li>

					<li class="mis-slide">
					    <a href="#" class="mis-container">
					        <figure onclick="">
					            <img src="front/images/arq1.jpg" alt='titulo1'>
					            <figcaption>Titulo 1</figcaption>
					        </figure>
					    </a>
					</li>

					<li class="mis-slide">
					    <a href="#" class="mis-container">
					        <figure onclick="">
					            <img src="front/images/arq3.jpg" alt='titulo1'>
					            <figcaption>Titulo 1</figcaption>
					        </figure>
					    </a>
					</li>




			        </ol>
			    </div>
			</figure><br><br>
		</div>

		<div class="row line2">
		</div>

	</div>


	<div class="container white ">
		<div class="row text-center info">
			<p>Miembros del consejo / Sala Plena </p>
			<img src="front/images/logos_i.png" class="miembros">
			<p>Certificación</p>
			<img src="front/images/certificados.png">
		</div>

	</div>


	<footer class="container text-center bg">
		<p>www.cpnaa.gov.co</p>
		<ul class="redes">
			<li><a href=""><img src="front/images/face.png"></a></li>
			<li><a href=""><img src="front/images/twi.png"></a></li>
			<li><a href=""><img src="front/images/goo.png"></a></li>
			<li><a href=""><img src="front/images/you.png"></a></li>
			<li><a href=""><img src="front/images/ins.png"></a></li>
			<li><a href=""><img src="front/images/link.png"></a></li>
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
    <script type="text/javascript" src="front/js/jquery.min.js"></script>
    <script type="text/javascript" src="front/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="front/js/jquery.validate.min.js"></script>
    <script type="text/javascript" src="front/js/validacion.js"></script>
    <script type="text/javascript" src="front/js/alertify.min.js"></script>
    <script type="text/javascript" src="front/js/valid.js"></script>
    <script type="text/javascript" src="front/js/login.js"></script>
    <script type="text/javascript" src="js/process/registros.js"></script>
    <script type="text/javascript" src="front/js/sweetalert.min.js"></script>
    <script type="text/javascript" src="js/validacion.js"></script>

	<!-- Galeria trabajos -->
	<script src="//cdn.jsdelivr.net/modernizr/2.8.3/modernizr.min.js"></script>
	<!-- <script>window.modernizr || document.write('<script src="js/modernizr-custom.js"><\/script>')</script> -->
	<script src="front/js/mislider.js"></script>
	<script src="front/js/gallery.js"></script>
	<script>
	    jQuery(function ($) {
	        var slider = $('.mis-stage').miSlider({
	            //  The height of the stage in px. Options: false or positive integer. false = height is calculated using maximum slide heights. Default: false
	            //stageHeight: 380,
	            //  Number of slides visible at one time. Options: false or positive integer. false = Fit as many as possible.  Default: 1
	            slidesOnStage: false,
	            //  The location of the current slide on the stage. Options: 'left', 'right', 'center'. Defualt: 'left'
	            slidePosition: 'center',
	            //  The slide to start on. Options: 'beg', 'mid', 'end' or slide number starting at 1 - '1','2','3', etc. Defualt: 'beg'
	            slideStart: 'mid',
	            //  The relative percentage scaling factor of the current slide - other slides are scaled down. Options: positive number 100 or higher. 100 = No scaling. Defualt: 100
	            slideScaling: 150,
	            //  The vertical offset of the slide center as a percentage of slide height. Options:  positive or negative number. Neg value = up. Pos value = down. 0 = No offset. Default: 0
	            offsetV: -5,
	            //  Center slide contents vertically - Boolean. Default: false
	            centerV: true,
	            //  Opacity of the prev and next button navigation when not transitioning. Options: Number between 0 and 1. 0 (transparent) - 1 (opaque). Default: .5
	            navButtonsOpacity: 1
	        });
	    });
	</script>



    <script type="text/javascript">
      $(document).ready(function(){



      });

    $(function(){
      $('#txtTel').validCampoFranz('0123456789');
    });
    </script>
</body>
</html>