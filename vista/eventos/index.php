<?php
  include_once("../../AnsTek_libs/integracion.inc.php");
    Session::valida_sesion("","../../admin/logout.php");
    if(Session::get('Perfil') != 1)
    header('Location: ../../admin/logout.php');
  include_once("../resourcesView.php");
  include_once("../../model/eventos.class.php");

  $event = new evento($db);
  $result =  $event->selectAll();
  $vNom = Session::get('Nombre');
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


	  <!-- modal -->
	    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel" id="New_Act">
	  <div class="modal-dialog modal-xs" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="gridSystemModalLabel">Nuevo Evento</h4>
	        <div id="linkImg" style="float: right"></div>
	      </div>
	      <div class="modal-body">

	        <form id="Form_Act" enctype="multipart/form-data">
	          <div class="form-group">
	            <label for="email">Estado:</label>
	            <select class="form-control" name="txtStatus" id="txtStatus">
	                <option value="1">Activo</option>
	                <option value="0">Inactivo</option>
	            </select>
	          </div>
	          <div class="form-group">
	            <label for="txtDate">Fecha del evento:</label>
	            <input class="form-control" type="date" name="txtDate" id="txtDate" placeholder="">
	          </div>
	          <div class="form-group">
	            <label for="txtImg">Imagen Principal</label>
	            <input type="file" name="txtImg" id="txtImg" class="form-control">
	          </div>
	      <div class="form-group">
	        <label for="txtImg">Título</label>
	        <input type="text" name="txtTitle" id="txtTitle" class="form-control" placeholder="Ingrese un título">
	      </div>
	      <div class="form-group">
	        <label for="txtImg">Enlace</label>
	        <input type="text" name="txtLink" id="txtLink" class="form-control" placeholder="Ingrese un enlace">
	      </div>
	      <div class="form-group">
	        <label for="txtImg">Descripción</label>
	        <textarea class="form-control" rows="6" name="txtDes" id="txtDes" placeholder="Ingrese su descripción"></textarea>
	      </div>
	          <input type="hidden" name="txtId" id="txtId">
	          <input type="hidden" name="accion" id="" value="ins">
	          <div id="upd"></div>
	          <button type="submit" class="btn btn-primary">Registrar</button>
	        </form>

	      </div>
	      <div class="modal-footer">
	        <div id="upd"></div>
	        <button type="button" class="btn btn-danger" data-dismiss="modal" id="btnCloseCli">Close</button>
	              </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	  <!-- FIN modal -->

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
	            <h3 class="page-header"><i class="fa fa-laptop"></i>Eventos</h3>
	            <ol class="breadcrumb">
	              <li><i class="fa fa-home"></i><a href="index.html">Inicio</a></li>
	              <li><i class="fa fa-laptop"></i>Eventos</li>
	            </ol>
	          </div>
	        </div>
			<button type="button" class="btn btn-primary" id="new_exp_form">Nuevo</button>
			<section class="panel">
	            <table id="editable" class="table table-striped table-bordered table-hover table-responsive" width="100%">
	              <thead>
	                <tr>
	                   <th width="2%">#</th>
	                   <th width="2%">Estado</th>
	                   <th width="15%">Título</th>
	                   <th width="15%">Enlace</th>
	                   <th width="auto">Descripción</th>
	                   <th width="auto">Imagen_Principal</th>
	                   <th width="auto">Fecha del evento</th>
	                   <th width="10%">Fecha Registro</th>
	                   <th width="10%">Acciones</th>
	                </tr>
	              </thead>
	              <tbody>
	                <?php
	                  if($db->numRows($result) > 0){
	                    while ($r = $db->datos($result)) {
	                      $valStatus = ($r['Status'] == 1) ? "<img src='../../img/edo_ok.png' alt='Activo'>" : "<img src='../../img/edo_nok.png' alt='Inactivo'>";
	                      echo "<tr>";
	                      echo "<td>" . $r['Id']      . "</td>";
	                      echo "<td>" . $valStatus  . "</td>";
	                      echo "<td>" . $r['Titulo'] . "</td>";
	                      echo "<td>" . $r['Enlace'] . "</td>";
	                      echo "<td>" . $r['Descripcion'] . "</td>";
	                      echo "<td>". '<center>'. '<img src="../../'.$r['Imagen_principal'].'" width="100px">'.'<center>' ."</td>";
	                      echo "<td>" . $r['Fecha'] . "</td>";
	                      //echo "<td>" .$r['Imagen_principal']."</td>";
	                      echo "<td>" . $r['Created_date']     . "</td>";

	                      echo "<td>
	                          <center>
	                              <a href=\"#\" onclick=\"javascript:openAct('".$r['Id']."');\" style=\"margin-bottom:-3px;\" class=\"btn btn-success btn-md btn-xs\" title=\"Editar\"><i class=\"fa fa-refresh fa-lg\"></i></a>&nbsp;
	                              <a href=\"#\" onclick=\"javascript:DelAct('".$r['Id']."');\" style=\"margin-bottom:-3px;\" class=\"btn btn-danger btn-md btn-xs\" title=\"Editar\"><i class=\"fa fa- fa-lg\">borrar</i></a>&nbsp;
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
	<script type="text/javascript" src="../../js/process/eventos.js"></script>
	<script>
	    $(document).ready(function() {
	    	$("#new_User").click(function(){
	    	  $("#Modal_Usuarios").modal({keyboard: true});
	    	});

	    	$('#new_exp_form').click(function(){
	    	  $("#New_Act").modal({keyboard: true});
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