<?php
	include_once("../../AnsTek_libs/integracion.inc.php");
	include_once("../resourcesView.php");
	Session::valida_sesion("","../../admin/logout.php");
	if(Session::get('Perfil') != 1)
	header('Location: ../../admin/logout.php');
	include_once("../../model/usuarios.class.php");
	$user = new usuario($db);
	$result = $user->selectAll();
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
	<!-- Modal Cargar achivo excel -->
	<div id="verUsuario" class="modal fade" role="dialog">
	  <div class="modal-dialog">
	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Información del usuario</h4>
	      </div>
	      <div class="modal-body">
	      	<div class="row">
	      		
	      		<div id="cont" class="col-md-offset-2 col-md-6"></div>
	      		<div class="col-md-offset-2 col-md-6">  	
	      			<strong>Información de Usuario</strong>	 <br>     	  					
	      		  	<label>Nombre: <span id="name"></span></label><br>
	      		  	<label>Cédula: <span id="ced"></span></label><br>	      		  	
	      		  	<label>Dirección: <span id="dir"></span></label><br>
	      		  	<label>Teléfono: <span id="tel"></span></label><br>
	      		  	<label>Email: <span id="mail"></span></label><br>
	      		  	<label>Usuario: <span id="user"></span></label><br>
	      		  	<label>Foto: <span id="foto"></span></label><br>
	      		  	<label>Fecha Registrado: <span id="date"></span></label><br>
	      		  	
	      		</div>
	      	</div>
	        
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
	      </div>
	    </div>
	  </div>
	</div>


	<!-- Modal Nuevo Usuario -->
	<div id="Modal_Usuarios" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Nuevo Usuario</h4>
	      </div>
	      <div class="modal-body">
	        <form id="usuarios" enctype="multipart/form-data">
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
	            <input type="text" class="form-control" id="txtPass" name="txtPass" placeholder="Genere una contraseña">
	          </div>
	          <div class="form-group">
	            <input type="text" class="form-control" id="txtPass2" name="txtPass2" placeholder="Confirme su contraseña">
	             <input type="hidden" name="txtId" id="txtId" value="0">
	            <input type="hidden" name="accion" id="" value="ins">
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

	<!-- Modal Cargar achivo excel -->
	<div id="Modal_Excel" class="modal fade" role="dialog">
	  <div class="modal-dialog">
	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Adjunte un archivo excel</h4>
	      </div>
	      <div class="modal-body">
	        <form id="excel_upload" enctype="multipart/form-data" action="../../controller/usuariosController.php">
				<div class="form-group">
				<label class="">Adjuntar archivo</label>
					<input type="file" class="form-control" name="uploadExcel" id="uploadExcel" autofocus>
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
	            <h3 class="page-header"><i class="fa fa-laptop"></i>Usuarios</h3>
	            <ol class="breadcrumb">
	              <li><i class="fa fa-home"></i><a href="index.html">Inicio</a></li>
	              <li><i class="fa fa-laptop"></i>Usuarios</li>
	            </ol>
	          </div>
	        </div>
			<button type="button" class="btn btn-primary" id="new_User">Nuevo</button>
			<!-- <button type="button" class="btn btn-primary" id="cargar_excel">Cargar archivo</button> -->
			<section class="panel">
	            <table class="table table-striped table-bordered table-hover " id="editable" >
		            <thead>
		            <tr>
		               <th width="5%"><i class="icon_profile"></i>Status</th>
		               <th><i class="icon_profile"></i>Nombre completo</th>
	                    <th><i class="icon_calendar"></i> Cedula</th>
	                    <th><i class="icon_mail_alt"></i>Direccion</th>
	                    <th width="10%"><i class="icon_mobile"></i>E-mail</th>
	                    <th><i class="icon_mobile"></i>Usuario</th>
	                    <th><i class="icon_mobile"></i>Foto</th>
	                    <th><i class="icon_mobile"></i>Perfil</th>
	                    <th><i class="icon_cogs"></i> Action</th>

		            </tr>
		            </thead>
		            <tbody>
						<?php
						if($db->numRows($result) > 0){
						  while ($r = $db->datos($result)) {
						  	$perfil = ($r['Perfil'] == 1) ? "Administrador" : "Usuario";
						    $valStatus = ($r['Status'] == 1) ? "<img src='../../img/edo_ok.png' alt='Activo'>" : "<img src='../../img/edo_nok.png' alt='Inactivo'>";
						    echo "<tr>";
						    echo "<td>" . $valStatus       . "</td>";
						    echo "<td>" . $r['Nombre']     . "</td>";
						    echo "<td>" . $r['Cedula'] . "</td>";
						    echo "<td>" . $r['Direccion'] . "</td>";
						    echo "<td>" . $r['Email'] . "</td>";
						    echo "<td>" . $r['Usuario'] . "</td>";
						    echo "<td>" . '<center>'.'<img src="../../'.$r['Foto'].'" width="35%"> '.'</center>' . "</td>";
						    echo "<td>" . $perfil . "</td>";
						    echo "<td>
						            <center>
						             <a href=\"#\" onclick=\"javascript:openUsuario('".$r['Id']."');\" style=\"margin-bottom:-3px;\" class=\"btn btn-primary btn-md btn-xs\" title=\"Editar\">ver</a>&nbsp;						             
						              </center>
						          </td>";

						    echo "</tr>";


						    //$r['Id']
						  }
						}
						else{
						  echo "NO HAY REGISTROS PARA MOSTRAR";
						}
						?>
					</tbody>
	            </table>
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
	    	$("#new_User").click(function(){
	    	  $("#Modal_Usuarios").modal({keyboard: true});
	    	});
	    	Modal_Excel
	    	$("#cargar_excel").click(function(){
	    	  $("#Modal_Excel").modal({keyboard: true});
	    	});
	        $('.dataTables-example').dataTable({
	            responsive: true,
	            "dom": 'T<"clear">lfrtip',
	            "tableTools": {
	                "sSwfPath": "js/plugins/dataTables/swf/copy_csv_xls_pdf.swf"
	            }
	        });
	        /* Init DataTables */
	        var oTable = $('#editable').dataTable();
	    });
	</script>
</body>
</html>