<?php
	include_once("../AnsTek_libs/integracion.inc.php");
	include_once("../model/firmantes.class.php");
	include_once("../model/arquitectos.class.php");
	include_once("../model/beneficios.class.php");
	include_once("../vista/resourcesView.php");
	include_once("../model/firmantes.class.php");
	include_once("../resources/footer.php");
	Session::valida_sesion("","../admin/logout.php");
	if(Session::get('Perfil') != 0)
	header('Location: ../admin/logout.php');

	$name = Session::get('Nombre');
	$Repre = Session::get('Cedula');

	$where = " Where Cedula_Repre = ". $Repre;
	$empresa = new firmante($db);
	$result = $empresa->selectAll($where);

	/** Carga Combo Empresas **/
	$option="";
	if($db->numRows($result) > 0){
	while ($r = $db->datos($result)) {
	  $option .= "<option value=".$r["Nit"].">".$r["Nit"]." - "  . $r["Razon_social"] . "</option>";
	}
	}

	$objArq = new arquitecto($db);
	$whereArq = " Where arq.Cedula_RL = ". $Repre. " GROUP BY Cedula ORDER BY Id DESC";
	$resultArq = $objArq->selectAll($whereArq);

	//OBJETO PARA LISTAR BENEFICIOS
	$bene = new beneficio($db);
	$whereB = " Where Status = 1";
	$resultB = $bene->selectAll($whereB);

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




?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo " Firmante - ".$name ?></title>
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
    <!-- Data Tables -->
    <link href="../css/dataTables.bootstrap.css" rel="stylesheet">
    <link href="../css/dataTables.responsive.css" rel="stylesheet">
    <link href="../css/dataTables.tableTools.min.css" rel="stylesheet">
    <style type="text/css">
    	.from_arq .error{color: #ff0000;}
    </style>
</head>
<body data-spy="scroll" data-target=".navbar" data-offset="60">

	<!-- Modal Cargar achivo excel -->
	<div id="SubirArq" class="modal fade" role="dialog">
	  <div class="modal-dialog">
	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title" style="color: #000;">Adjunte un archivo excel</h4>
	      </div>
	      <div class="modal-body">
	        <form id="excel_upload" enctype="multipart/form-data">
				<div class="form-group">
				<label class="">Adjuntar archivo</label>
					<input type="file" name="txtImg" id="txtImg" class="form-control" placeholder="">
					<input type="hidden" class="form-control" name="accion" id="" value="imp">
				</div>
	          <button type="submit" class="btn btn-default">Enviar</button>
	        </form>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
	      </div>
	    </div>
	  </div>
	</div>

	<div class="container login">
		<div class="row">
			<!-- <div class="col-xs-offset-8 col-sm-offset-9 col-md-offset-9 col-xs-4 col-sm-3 col-md-3 login-content">
				<strong class="icon"><img src="../front/images/iniciar-session.png" class="" > </strong><p><?php echo $name; ?></p>
			</div> -->
			<div class="dropdown login-content" style="float: right;">
			  <button class="btn dropdown-toggle per" type="button" data-toggle="dropdown"><strong class="icon"><img src="../front/images/iniciar-session.png" class="" > </strong><?php echo $name." - ". $nombreEmpresa; ?>
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
	        <li><a href="../">INICIO</a></li>
	        <li><a href="#">USUARIO</a></li>
	        <li><a href="#bene">BENEFICIOS</a></li>
	        <li><a href="#arq">TUS ARQUITECTOS</a></li>
	        <li><a href="#exp">EXPERIENCIAS</a></li>
	        <li><a href="../preguntas_frecuentes/">PREGUNTAS FRECUENTES</a></li>
	        <li><a href="../aliados/">FIRMANTES Y ALIADOS</a></li>
	      </ul>
	    </div>
	  </div>
	</nav>

	<div class="container">
		<div class="row">
			<img src="../front/images/pactos_por_regulacion.jpg" class="" width="100%">
		</div>
	</div>

	<div class="container galeria_beneficios" id="bene">
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

		<div class="row top_bene">
			<div class=" col-md-12 pdd">
				<div class="row">

					<?php
					if($db->numRows($resultB) > 0){
					  while ($rB = $db->datos($resultB)) {
					  	$enlace = '';
					  	if ($rB['Enlace'] != "") {
					  		$enlace = '<a href='.$rB['Enlace'].' class="ver" target="self">Ver más</a> ';
					  	}else{
					  		$enlace = '';
					  	}

					    echo '

							  <div class="col-sm-3 col-md-3 bdr text-center cont_bene">
							      <div class="row numero">
							          <h2>'.$rB['Titulo'].'</h2>
							      </div>
							      <div class="row imgB"> 
							      	<img src="../'.$rB['Imagen_principal'].'" class="" width="100%" title=""/>
 										
							      </div>
							      <div class="row desc">
						          <p>'.$rB['Descripcion'].'</p>
							      </div>
							      <div class="row" style="height: 33px; background-color: #fff">
							      	'.$enlace.'
							      </div>

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

	</div>

	<div class="container resultados white" id="arq">
		<div class="row">
			<div class="col-xs-6 col-sm-6">
				<h1 class="result">INSCRIBE A <span>TUS ARQUITECTOS</span></h1>
			</div>
		</div>
	</div>

	<div class="container subir_arq">
		<div class="row">
			<div class="col-md-offset-1 col-sm-12  col-md-10 cont_arq">
				<div class="col-sm-7 col-md-7 text-center">
					<form  class="from_arq" id="from_arq">
						<h4>Por favor llene el siguiente formulario para agregar sus arquitectos, si lo desea puede utilizar la opción de subir un archivo con varios registros.</h4>

					  <div class="form-group">
					    <input type="text" class="form-control input" id="txtName" name="txtName" placeholder="Ingrese un Nombre">
					  </div>
					  <div class="form-group">
					    <input type="text" class="form-control input" name="txtApe" id="txtApe" placeholder="Ingrese los Apellidos">
					  </div>
					  <div class="form-group">
					    <input type="text" class="form-control input" name="txtCed" id="txtCed" placeholder="Ingrese número de cédula">
					  </div>
					  <div class="form-group">
					    <input type="email" class="form-control input" name="txtEmail" id="txtEmail" placeholder="Ingrese un Email">
					  </div>
					  <div class="form-group">
					    <input type="text" class="form-control input" name="txtTel" id="txtTel" placeholder="Ingrese un Teléfono ">
					  </div>
					  <div class="form-group">
					    <select class="form-control input" name="txtPro" id="txtPro">
							<option value="">Nivel Acádemico</option>
							<option>Arquitecto/a</option>							
							<option>Técnico/a</option>
							<option>Tecnólogo/a</option>
					    </select>
					  </div>
					    <div class="form-group">
					      <select class="form-control input" name="txtEmp" id="txtEmp">
					  		<option value="">A que empresa pertenece ?</option>
					  		<?php echo $option; ?>
					      </select>
					    </div>
					  <button type="submit" class="btn btn-default">Enviar</button>
					</form>
				</div>
				<div class="col-sm-5 col-md-5">
					<a href="../arquitectos.xlsx" download="../arquitectos.xlsx" title="Descargar formato para subir arquitectos">
					<div class="row text-center rojo">
						<h4>Descarga el archivo en excel y sube a tus arquitectos </h4>
						<img src="../front/images/descargar.png" alt="Descargar" class="bajar">
					</div>
					</a>

					<a href="#" data-toggle="modal" data-target="#SubirArq" title="Importar Arquitectos">
					<div class="row text-center azul">
						<h4>Sube el mismo Archivo</h4>
						<img src="../front/images/subir.png" alt="subir" class="subir">
					</div>
					</a>
				</div>
			</div>

		</div>
	</div>



	<div class="container resultados white">
		<div class="row">
			<div class="col-xs-6 col-sm-6">
				<h1 class="result">ARQUITECTOS <span>REGISTRADOS</span></h1>
			</div>
		</div>
	</div>

	<div class="container subir_arq2">
		<div class="row">
			<div class="col-md-offset-1 col-sm-12  col-md-10 cont_arq">
						<section class="panel table-responsive">
				            <table class="table table-striped table-bordered table-hover " id="editable" >
					            <thead>
					            <tr>
					               <th width="5%"><i class="icon_profile"></i>Status</th>
					               <th width="5%"><i class="icon_profile"></i>Detalle</th>
					               <th><i class="icon_profile"></i>Nombres</th>
				                    <th><i class="icon_calendar"></i> Apellidos</th>
				                    <th><i class="icon_mail_alt"></i>Cédula</th>
				                    <th width="10%"><i class="icon_mobile"></i>E-mail</th>
				                    <th><i class="icon_mobile"></i>Teléfono</th>
				                    <th><i class="icon_mobile"></i>Nit Empresa</th>
				                    <th><i class="icon_cogs"></i> Nivel Educativo</th>
				                    <th><i class="icon_cogs"></i> Cédula Representante legal</th>
					            </tr>
					            </thead>
					            <tbody>
									<?php
									if($db->numRows($resultArq) > 0){
									  while ($r = $db->datos($resultArq)) {
									  	$msj = "";
									    if ($r['Status'] == 1 ) {
									    	$msj = '<a onclick=javascript:Aprovacion('.$r['Cedula'].','. $r['Status'].') class="btn btn-success btn-md btn-xs" >  Aprobado </a>';
									    }
									    if ($r['Status'] == 2 ) {
									    	$msj = '<a onclick=javascript:Aprovacion('.$r['Cedula'].','. $r['Status'].') class="btn btn-danger btn-md btn-xs"> Rechazado</a>';
									    }
									    if ($r['Status'] == 3 ) {
									    	$msj = '<a onclick=javascript:Aprovacion('.$r['Cedula']. ','. $r['Status'].') class="btn btn-warning btn-md btn-xs" >Pendiente</a>';
									    }
									    echo "<tr>";
									    echo "<td>" . $msj     . "</td>";
									    echo "<td>" . $r['Detalle']     . "</td>";
									    echo "<td>" . $r['Nombres']     . "</td>";
									    echo "<td>" . $r['Apellidos']     . "</td>";
									    echo "<td>" . $r['Cedula'] . "</td>";
									    echo "<td>" . $r['Email'] . "</td>";
									    echo "<td>" . $r['Telefono'] . "</td>";
									    echo "<td>" . $r['Nit_empresa'] . "</td>";
									    echo "<td>" . $r['Nivel_educativo']. "</td>";
									    echo "<td>" . $r['Cedula_RL']. "</td>";
									    echo "</tr>";

									  }
									}
									else{
									  echo "NO HAY REGISTROS PARA MOSTRAR";
									}
									?>
								</tbody>
				            </table>
						</section>

			</div>

		</div>
	</div>

	<div class="container resultados white" id="exp">
		<div class="row">
			<div class="col-xs-6 col-sm-6">
				<h1 class="result">EXPERIENCIAS</span></h1>
			</div>
		</div>
	</div>

	<div class="container Experiencias_user">
		<div class="row">
			<div class="col-sm-offset-1 col-md-offset-1 col-sm-10 col-md-10">
				<div class="col-sm-offset-1 col-md-offset-1 col-sm-10 col-md-10 msj">
					<p>
						En la siguiente sección de la pagína se listan los casos de exito  <br> más importantes para el CPNAA
					</p>
				</div>
			</div>
		</div>

		<div class="row cont_exp">
			<div class="col-sm-5 col-md-4">
				<form class="" role="form" id="form_exp">
					<h3>SUBE TU EXPERIENCIA </h3>
				  <div class="form-group">
				    <input type="text" class="form-control inp" id="txtTi" name="txtTi" placeholder="Título">
				  </div>
				  <div class="form-group">
				  	<label>Imagen Destacada (Dimensiones:400px * 400px)</label>
				    <input class="form-control inp" type="file" name="txtImagen" id="txtImagen" placeholder="Imagen Destacada">
				  </div>
				  <div class="form-group">
				    <input class="form-control inp" type="text" name="txtLink" id="txtLink" placeholder="Link de YouTube">
				  </div>
				  <div class="form-group">
				  	<label>Documento (opcional)</label>
				    <input class="form-control inp" type="file" name="txtFile" id="txtFile" placeholder="Un documento">
				    <input class="form-control inp" type="hidden" name="accion" id="accion" value="ins">
				  </div>

				  <div class="form-group">
				    <textarea class="form-control inp" name="txtDes" id="txtDes" placeholder="Cuentanos tu experiencia" rows="5"></textarea>
				  </div>

				  <button type="submit" class="btn btn-default">Enviar</button>
				</form>
			</div>
			<div class="col-md-8"></div>

		</div>


	</div>


	<!-- IMPRIMIMOS FOOTER -->
	<?php footer2(); ?>
	<!-- Botom ir arriba-->
	  <div id='IrArriba'>
	    <a href='#Arriba'><img src="../front/images/subir_lagrima.png" width="120px"></a>
	  </div>



    <!-- Scripts -->
    <script type="text/javascript" src="../front/js/jquery.min.js"></script>
    <script type="text/javascript" src="../front/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../front/js/jquery.validate.min.js"></script>
    <script type="text/javascript" src="../js/process/arquitectos.js"></script>
    <script type="text/javascript" src="../front/js/alertify.min.js"></script>
    <script type="text/javascript" src="../front/js/valid.js"></script>
    <script type="text/javascript" src="../js/process/experiencias.js"></script>
    <script type="text/javascript" src="../js/process/cargarArquitectos.js"></script>
    <script type="text/javascript" src="../front/js/scroll.js"></script>

    <!-- Data Tables -->
    <script src="../js/jquery.dataTables.js"></script>
    <script src="../js/dataTables.bootstrap.js"></script>
    <script src="../js/dataTables.responsive.js"></script>
    <script src="../js/dataTables.tableTools.min.js"></script>


    <script type="text/javascript" src="../front/js/sweetalert.min.js"></script>
    <script type="text/javascript" src="../front/js/scroll.js"></script>

    <script type="text/javascript">
      $(document).ready(function(){
      	jQuery("#IrArriba").hide();
      	jQuery(function () {
      	jQuery(window).scroll(function () {
      	if (jQuery(this).scrollTop() > 200) {
      	jQuery('#IrArriba').fadeIn();
      	} else {
      	jQuery('#IrArriba').fadeOut();
      	}
      	});
      	jQuery('#IrArriba a').click(function () {
      	jQuery('body,html').animate({
      	scrollTop: 0
      	}, 800);
      	return false;
      	});
      	});

      });

    $(function(){
      $('#txtTel').validCampoFranz('0123456789');
    });
    /* Init DataTables */
	        var oTable = $('#editable').dataTable();
    </script>
</body>
</html>