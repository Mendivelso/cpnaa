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
	
	<!-- Modal Cargar achivo excel -->
	<div id="verFirmante" class="modal fade" role="dialog">
	  <div class="modal-dialog">
	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Información Firmante</h4>
	      </div>
	      <div class="modal-body">
	      	<div class="row">
	      		<div class="col-md-6">  	
	      			<strong>Información de la Empresa</strong>	 <br>     	  					
	      		  	<label>Nombre: <span id="name"></span></label><br>
	      		  	<label>Nit: <span id="ape"></span></label><br>	      		  	
	      		  	<label>Télefono: <span id="tel1"></span></label><br>
	      		  	<label>Página web: <span id="pag"></span></label><br>
	      		  	
	      		</div>
	      		<div class="col-md-6">
	      			<strong>Información Representante Legal</strong><br>     	
	      			<label>Nombre: <span id="Nrl"></span></label><br>
	      			<label>Cédula: <span id="Crl"></span></label><br>
	      			<label>Teléfono: <span id="Trl"></span></label><br>
	      			<label>E-mail: <span id="Erl"></span></label><br>
	      		</div>
	      		<div class="col-md-12">
	      			<strong>Información Responsable del pacto</strong><br>     	
	      			<label>Nombre: <span id="Nr"></span></label><br>
	      			<label>Cédula: <span id="Cr"></span></label><br>
	      			<label>Teléfono: <span id="Tr"></span></label><br>
	      			<label>E-mail: <span id="Er"></span></label><br>
	      			<label>Fecha Registro: <span id="date"></span></label><br>
	      		</div>
	      	</div>
	      	
	      	
	        
	         
	        	
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
	      </div>
	    </div>
	  </div>
	</div>

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
	            <h3 class="page-header"><i class="fa fa-laptop"></i>Firmantes</h3>
	            <ol class="breadcrumb">
	              <li><i class="fa fa-home"></i><a href="index.html">Inicio</a></li>
	              <li><i class="fa fa-laptop"></i>Firmantes</li>
	            </ol>
	          </div>
	        </div>
			
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
    					                   <a href=\"#\" onclick=\"javascript:openFirmante('".$r['Id']."');\" style=\"margin-bottom:-3px;\" class=\"btn btn-primary btn-md btn-xs\" title=\"Editar\">Ver más</a>&nbsp;
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
	<script type="text/javascript" src="../../js/process/firma_pacto.js"></script>

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