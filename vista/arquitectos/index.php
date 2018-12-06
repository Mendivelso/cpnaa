<?php
	include_once("../../AnsTek_libs/integracion.inc.php");
	include_once("../resourcesView.php");
	Session::valida_sesion("","../../admin/logout.php");
	if(Session::get('Perfil') != 1)
	header('Location: ../../admin/logout.php');
	include_once("../../model/usuarios.class.php");
	include_once("../../model/arquitectos.class.php");

	// Objeto Usuario
	$user = new usuario($db);
	$result = $user->selectAll();

	// Objeto Arquitectos
	$where = " Where arq.Id > 0 GROUP BY Cedula";
	$Arq = new arquitecto($db);
	$resultArq = $Arq->selectAll($where);





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
	<div id="Modal_aprovacion" class="modal fade" role="dialog">
	  <div class="modal-dialog">
	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Adjunte un archivo excel</h4>
	      </div>
	      <div class="modal-body">
	        <form id="form_aprovacion">
	        	<div class="form-group">
	        		<input  class="form-control" type="hidden" name="textArq" id="textArq">
	        	</div>
				<div class="form-group">
				<label class="">Seleccione un estado</label>
					<select class="form-control" name="txtStattus" id="txtStattus">
						<option value="">seleccione</option>
						<option value="1">Aprobado</option>
						<option value="2">Rechazado</option>
						<option value="3">Pendiente</option>
					</select>
				</div>
				<div class="form-group">
					<textarea class="form-control" name="txtDetalle" id="txtDetalle" rows="6" placeholder="Ingrese una observación"></textarea>
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
	            <h3 class="page-header"><i class="fa fa-laptop"></i>Arquitectos</h3>
	            <ol class="breadcrumb">
	              <li><i class="fa fa-home"></i><a href="index.html">Inicio</a></li>
	              <li><i class="fa fa-laptop"></i>Arquitectos</li>
	            </ol>
	          </div>
	        </div>
			<button type="button" class="btn btn-primary" id="new_User">Nuevo</button>
			<section class="panel">
	            <table class="table table-striped table-bordered table-hover " id="editable" >
		            <thead>
		            <tr>
		               <th width="5%"><i class="icon_profile"></i>Status</th>
		               <th><i class="icon_profile"></i>Nombre completo</th>
	                    <th><i class="icon_calendar"></i> Cedula</th>
	                    <th><i class="icon_mail_alt"></i>Email</th>
	                    <th width="10%"><i class="icon_mobile"></i>Teléfono</th>
	                    <th><i class="icon_mobile"></i>Empresa</th>
	                    <th><i class="icon_mobile"></i>Nivel_educativo</th>
	                    <th><i class="icon_cogs"></i> Cedula_RL</th>
	                    <th><i class="icon_cogs"></i> Fecha</th>
	                    <th><i class="icon_cogs"></i> Acción</th>
		            </tr>
		            </thead>
		            <tbody>
						<?php
						$msj ="";
						if($db->numRows($resultArq) > 0){
						  while ($r = $db->datos($resultArq)) {
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
						    echo "<td>" .$msj. "</td>";
						    echo "<td>" . $r['Nombres']. " ". $r['Apellidos'] . "</td>";
						    echo "<td>" . $r['Cedula'] . "</td>";
						    echo "<td>" . $r['Email'] . "</td>";
						    echo "<td>" . $r['Telefono'] . "</td>";
						    echo "<td>" . $r['Nit_empresa'] . "</td>";
						    echo "<td>" . $r['Nivel_educativo'] . "</td>";
						    echo "<td>" . $r['Cedula_RL'] . "</td>";
						    echo "<td>" . $r['Created_date'] . "</td>";
						    echo "<td>
						            <center>
						             <a href=\"#\" onclick=\"javascript:cargarDatos('');\" style=\"margin-bottom:-3px;\" class=\"btn btn-primary btn-md btn-xs\" title=\"Editar\">ver</a>&nbsp;
						             <a href=\"#\" onclick=\"javascript:cargaAct('".$r['Id']."');\" style=\"margin-bottom:-3px;\" class=\"btn btn-success btn-md btn-xs\" title=\"Actividades\">Editar</a>&nbsp;
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
	<script type="text/javascript" src="../../js/process/aprovar_arquitecto.js"></script>
	<script>
	    $(document).ready(function() {
	    	$("#new_User").click(function(){
	    	  $("#Modal_Usuarios").modal({keyboard: true});
	    	});

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