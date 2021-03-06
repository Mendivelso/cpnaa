<?php
	include_once("../../AnsTek_libs/integracion.inc.php");
	include_once("../resourcesView.php");
	Session::valida_sesion("","../../admin/logout.php");
	if(Session::get('Perfil') != 1)
	header('Location: ../../admin/logout.php');
	include_once("../../model/usuarios.class.php");
	include_once("../../model/experiencias.class.php");

	// Objeto Usuario
	$user = new usuario($db);
	$result = $user->selectAll();

	// Objeto Arquitectos
	$where = " Where Id > 0 ORDER BY Id DESC ";
	$Exp = new experiencia($db);
	$resultExp = $Exp->selectAll($where);

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
	<div id="editarExpectativa" class="modal fade" role="dialog">
	  <div class="modal-dialog">
	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Estado del registro</h4>
	      </div>
	      <div class="modal-body">
	      	<div id="linkImg" class="text-center"></div>
	        <form id="upd_exp">
	        	<div class="form-group">
	        		<input  class="form-control" type="hidden" name="txtId" id="txtId">
	        	</div>
				<div class="form-group">
				<label class="">Seleccione un estado</label>
					<select class="form-control" name="txtStatus" id="txtStatus">
						<option value="1">Activo</option>
						<option value="0">Inactivo</option>
					</select>
				</div>
				<div class="form-group">
				<label class="">Título</label>
					<input  class="form-control" type="text" name="txtTitle" id="txtTitle">
				</div>
				<div class="form-group">
				<label class="">Link de Youtube</label>
					<input  class="form-control" type="text" name="txtLink" id="txtLink">
				</div>
				<div class="form-group">
				<label class="">Documento Compartido</label>
					<input  class="form-control" type="text" name="txtDocu" id="txtDocu">
				</div>
				<div class="form-group">
				<label class="">Imagen</label>
					<input type="file" name="txtImg" id="txtImg">
				</div>
				<div class="form-group">
				<label class="">Descripción</label>
					<textarea class="form-control" name="txtDes" id="txtDes" rows="8"></textarea>
				</div>
				<div class="form-group" id="upd">
			
				</div>
	          <button type="submit" class="btn btn-default">Actualizar</button>
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
	            <h3 class="page-header"><i class="fa fa-laptop"></i>Experiencia</h3>
	            <ol class="breadcrumb">
	              <li><i class="fa fa-home"></i><a href="index.html">Inicio</a></li>
	              <li><i class="fa fa-laptop"></i>Experiencia</li>
	            </ol>
	          </div>
	        </div>
			<!-- <button type="button" class="btn btn-primary" id="new_User">Nuevo</button> -->
			<section class="panel">
	            <table class="table table-striped table-bordered table-hover " id="editable" >
		            <thead>
		            <tr>
		               <th width=""><i class="icon_profile"></i>Status</th>
		               <th><i class="icon_profile"></i>Título</th>
	                    <th><i class="icon_calendar"></i> Imagen</th>
	                    <th><i class="icon_mail_alt"></i>Descripción</th>
	                    <th><i class="icon_mail_alt"></i>Enlace</th>
	                    <th><i class="icon_mail_alt"></i>Documento</th>
	                    <th width="10%"><i class="icon_mobile"></i>Representante</th>
	                    <th><i class="icon_cogs"></i> Fecha</th>
		            </tr>
		            </thead>
		            <tbody>
						<?php
						$msj ="";
						if($db->numRows($resultExp) > 0){
						  while ($r = $db->datos($resultExp)) {
						    if ($r['Status'] == 1 ) {
						    	$msj = '<a onclick=javascript:Aprovacion('.$r['Id'].','. $r['Status'].') class="btn btn-success btn-md btn-xs" >  Aprobado </a>';
						    }
						    if ($r['Status'] == 2 ) {
						    	$msj = '<a onclick=javascript:Aprovacion('.$r['Id'].','. $r['Status'].') class="btn btn-danger btn-md btn-xs"> Rechazado</a>';
						    }
						    if ($r['Status'] == 3 ) {
						    	$msj = '<a onclick=javascript:Aprovacion('.$r['Id']. ','. $r['Status'].') class="btn btn-warning btn-md btn-xs" >Pendiente</a>';
						    }
						    echo "<tr>";
						    echo "<td>" .$msj. "<a href=\"#\" onclick=\"javascript:openExpectativa('".$r['Id']."');\" style=\"margin-bottom:-3px;\" class=\"btn btn-primary btn-md btn-xs\" title=\"Actividades\">Editar</a>&nbsp;</td>";
						    echo "<td>" . $r['Titulo']. " ". $r['Apellidos'] . "</td>";
						    echo "<td>" . "<img src=../../".$r['Imagen']." width=\"100px\"  " . "</td>";
						    echo "<td>" . $r['Descripcion'] . "</td>";
						    echo "<td>" . $r['Enlace'] . "</td>";
						    echo "<td>" . $r['Documento'] . "</td>";
						    echo "<td>" . $r['R_Legal'] . "</td>";
						    echo "<td>" . $r['Created_date'] . "</td>";
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
	<script type="text/javascript" src="../../js/jquery.validate.min.js"></script>
	<script type="text/javascript" src="../../js/process/usuarios.js"></script>
	<script type="text/javascript" src="../../js/process/experiencias.js"></script>
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
	        $('#editable').DataTable( {
	           ordering: false
	        } );
	    });
	</script>
</body>
</html>