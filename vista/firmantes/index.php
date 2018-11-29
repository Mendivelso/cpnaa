<?php
	include_once("../../AnsTek_libs/integracion.inc.php");
	include_once("../resourcesView.php");
	Session::valida_sesion("","../../admin/logout.php");
	if(Session::get('Perfil') != 1)
	header('Location: ../../admin/logout.php');
	include_once("../../model/firmantes.class.php");
	$Fir = new firmante($db);
	$result = $Fir->selectAll();
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
	            <h3 class="page-header"><i class="fa fa-laptop"></i>Firmantes</h3>
	            <ol class="breadcrumb">
	              <li><i class="fa fa-home"></i><a href="index.html">Inicio</a></li>
	              <li><i class="fa fa-laptop"></i>Firmantes</li>
	            </ol>
	          </div>
	        </div>
			<!-- <button type="button" class="btn btn-primary" id="new_User">Nuevo</button> -->
			<section class="panel">
	            <table class="table table-striped table-bordered table-hover " id="editable" >
		            <thead>
		            <tr>
		               <th width="5%"><i class="icon_profile"></i>Status</th>
		               <th><i class="icon_profile"></i>Nombre</th>
	                    <th><i class="icon_calendar"></i>Nit</th>
	                    <th><i class="icon_mail_alt"></i>Teléfono empresa</th>
	                    <th width="10%"><i class="icon_mobile"></i>Sitio Web</th>
	                    <th><i class="icon_mobile"></i>Representante</th>
	                    <th><i class="icon_mobile"></i>Cedula Representante</th>
	                    <th><i class="icon_cogs"></i> Télefono Repreentante</th>
	                    <th><i class="icon_cogs"></i> Acción</th>
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
							    echo "<td>" . $r['Razon_social']     . "</td>";
							    echo "<td>" . $r['Nit'] . "</td>";
							    echo "<td>" . $r['Telefono_emp'] . "</td>";
							    echo "<td>" . $r['Pagina_web'] . "</td>";
							    echo "<td>" . $r['Nombre_Repre'] . "</td>";
							    echo "<td>" . $r['Cedula_Repre'] . "</td>";
							    echo "<td>" . $r['Telefono_Repre'] . "</td>";
							   
					          echo "<td>
					                  <center>
					                   <a href=\"#\" onclick=\"javascript:cargarDatos();\" style=\"margin-bottom:-3px;\" class=\"btn btn-primary btn-md btn-xs\" title=\"Editar\">Ver más</a>&nbsp;
					                    </center>
					                </td>";
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