<?php
	/** incluye todos los recursos */
  include_once("../AnsTek_libs/integracion.inc.php");
	// Session::valida_sesion("","../../index.php");
  include_once("../model/usuarios.class.php");
  /** Instancia la clase usuarios*/
	$objUser = new usuario($db);
	$vname = Session::get('Id');
  /** captura el tipo de accion a realizar*/
  $accion = $_REQUEST['accion'];
	/** conmutador que determina las acciones a realizar para
	 * este modulo
	 */
	switch($accion){
    /* Obtiene un solo registro de usuario */
		case "single":
		$jsondata = array();
      $where = " Where Us.Id = " . $_REQUEST['pId'];
      $result = $objUser->selectAll($where);
      if($db->numRows($result) > 0)
      {
        $r = $db->datos($result);
		$jsondata['Id'] = $r["Id"];
		$jsondata['Nombre'] = $r["Nombre"];
		$jsondata['Cedula'] = $r["Cedula"];
		$jsondata['Direccion'] = $r["Direccion"];
		$jsondata['Telefono'] = $r["Telefono"];
		$jsondata['Email'] = $r["Email"];
		$jsondata['Usuario'] = $r["Usuario"];
		$jsondata['Foto'] = $r["Foto"];
		$jsondata['Status'] = $r["Status"];
		$jsondata['success'] = true;
		$jsondata['message'] = "recuperado correctamente";
      }
      else
      {
	      $jsondata['success'] = false;
	      $jsondata['message'] = "Fallo al obtener el registro";
      }
      header('Content-type: application/json; charset=utf-8');
      echo json_encode($jsondata);
  	break;
    /* Crea insert de usuarios */
    case "ins":
    $jsondata = array();
      // Datos necesarios para el registro
	$data = array("Nombre"=>$_REQUEST['txtName'],"Cedula"=>$_REQUEST['txtDoc'], "Direccion"=>$_REQUEST['txtDir'],
	        "Telefono"=>$_REQUEST['txtTel'], "Email"=>$_REQUEST['txtEml'],
	        "Usuario"=>$_REQUEST['txtUser'], "Password"=>md5($_REQUEST['txtPass1']), "Status"=>1, "Created_at"=>date('Y-m-d H:i:s')
	      );
		// clausulas where para validar cedula y usuario
      $whereC = " Where Us.Cedula = " . $_REQUEST['txtDoc'];
      $whereU = " Where Us.Usuario = " . "'". $_REQUEST['txtUser']. "'";
       $resultC = $objUser->selectAll($whereC);
       // valida la existencia de una cedula igual
       if($db->numRows($resultC) > 0){
	       	if ($r = $db->datos($resultC)) {
	       		$jsondata['success'] = false;
	       		$jsondata['message'] = "El numero de cedula ya existe";
	       	}else{
	       		// valida si hay un nombre de ususario igual
   		   		$resultU = $objUser->selectAll($whereU);
   		   		if($db->numRows($resultU) > 0){
   		   			if ($u = $db->datos($resultU)) {
   		   				$jsondata['success'] = false;
   		   				$jsondata['message'] = "El nombre de Usuario ya existe";
   		   			}else{
   		   				// Tomamos el formato de la imagen adjuntada
   		   				$vType = substr($_FILES['txtImg']['name'], strlen($_FILES['txtImg']['name'])-3, strlen($_FILES['txtImg']['name']));
   		   				// validamos el formato de la imagen 'png' o 'jpg'
   		   				if(($vType == "png") or ($vType == "jpg")){
   		   					// realiza el registro a la base de datos
   		   					if($objUser->insertData($data))
   		   					{
   		   						/* Tomamos el Id del ultimo registro*/
   		   						$vId = $db->lastInsert();
   		   						// creamos la carpeta
   		   						$carpeta = "../public/usuarios/".$vId;
   		   						if (!file_exists($carpeta)) {
   		   						    mkdir($carpeta, 0777, true);
   		   						}
   		   						// datos de la imagen necesarios para el registro
   		   						$name = $_FILES['txtImg']['name'];
   		   						$destino = "../public/usuarios/".$vId."/".$name;
   		   						$dest = "public/usuarios/".$vId."/".$name."'-";
   		   						$ruta = $_FILES['txtImg']['tmp_name'];
   		   						// se mueve el archivo en la carpeta indicada
   		   						if(copy($ruta,$destino)){
   		   						  $data = array("Foto"=>$dest);
   		   						  $where = " Id = " . $vId;
   		   						  // actualizamos el ultimo regsitro
   		   						  if($objUser->updateData($data, $where)){
   		   						    $jsondata['success'] = true;
   		   						    $jsondata['message'] = "Registrado correctamente";
   		   						  }else {
   		   						    $jsondata['success'] = false;
   		   						    $jsondata['message'] = "No fue posible Registrar sus datos";
   		   						  }

   		   						}else {
   		   						  $jsondata['success'] = false;
   		   						  $jsondata['message'] = "No fue posible subir su Imagen";
   		   						}
   		   					}
   		   					else
   		   					{
   		   					    $jsondata['success'] = false;
   		   					    $jsondata['message'] = "Falla al enviar el registro";
   		   					}

   		   				}else{
   		   				  $jsondata['success'] = false;
   		   				  $jsondata['message'] = "Formato de imagen Incorrecto, Debe ser png o jpg";
   		   				}
   		   			}
   		   		}
	       	}
       	}
      header('Content-type: application/json; charset=utf-8');
      echo json_encode($jsondata);
    break;
      /* Crea Update de usuarios */
    case "upd":
      $jsondata = array();
      $vimg = $_FILES['txtImg']['name'];
      if ($vimg != "") {
      	// si file viene lleno
      	$data = array("Nombre"=>$_REQUEST['txtName'],"Cedula"=>$_REQUEST['txtDoc'], "Direccion"=>$_REQUEST['txtDir'],
      	        "Telefono"=>$_REQUEST['txtTel'], "Email"=>$_REQUEST['txtEml'],
      	        "Usuario"=>$_REQUEST['txtUser'],  "Status"=>1, "Updated_by"=>$vname,  "Updated_at"=>date('Y-m-d H:i:s')
      	      );
      	$where = " Id = " . $_REQUEST['txtId'];
      	$objUser->updateData($data, $where);
      	$vType = substr($_FILES['txtImg']['name'], strlen($_FILES['txtImg']['name'])-3, strlen($_FILES['txtImg']['name']));
      	if(($vType == "png") or ($vType == "jpg")){
      	  $carpeta = "../public/usuarios/".$_REQUEST['txtId'];
      	  $destino2 = "../public/usuarios/".$_REQUEST['txtId']."/".$vimg;
      	  $dest = "public/usuarios/".$_REQUEST['txtId']."/".$vimg."'-";
      	  $ruta2 = $_FILES['txtImg']['tmp_name'];
      	  if(copy($ruta2,$destino2)){
      	    $data = array("Foto"=>$dest);
      	    $where = " Id = " . $_REQUEST['txtId'];
      	    if($objUser->updateData($data, $where)){
      	      $jsondata['success'] = true;
      	      $jsondata['message'] = "Modificado Correctamente";
      	    }else {
      	      $jsondata['success'] = false;
      	      $jsondata['message'] = "No fue posible Actualizar sus Datos";
      	    }

      	  }else{
      	    $jsondata['success'] = false;
      	    $jsondata['message'] = "No Fue posible subir su Imagen";
      	  }

      	}else{
      	  $jsondata['success'] = false;
      	  $jsondata['message'] = "Formato de imagen Incorrecto, Debe ser png o jpg";
      	}

      }else{
      	/*si tipo file esta vacio*/
      	$data = array("Nombre"=>$_REQUEST['txtName'],"Cedula"=>$_REQUEST['txtDoc'], "Direccion"=>$_REQUEST['txtDir'],
      	        "Telefono"=>$_REQUEST['txtTel'], "Email"=>$_REQUEST['txtEml'],
      	        "Usuario"=>$_REQUEST['txtUser'], "Status"=>1, "Updated_by"=>$vname,  "Updated_at"=>date('Y-m-d H:i:s')
      	      );
      	$where = "Id = " . $_REQUEST['txtId'];
      	if($objUser->updateData($data, $where))
      	 {
      	   $jsondata['success'] = true;
      	   $jsondata['message'] = "Actualizado correctamente";
      	 }else {
      	  $jsondata['success'] = false;
      	  $jsondata['message'] = "No fue posible Actualizar sus Datos";
      	}

      }


      header('Content-type: application/json; charset=utf-8');
      echo json_encode($jsondata);
    break;
      /* Crea Update de usuarios */
    case "upd2":
      $jsondata = array();
      $vimg = $_FILES['txtImg']['name'];

      if ($vimg != "") {
      	// si file viene lleno
      	$data = array("Nombre"=>$_REQUEST['txtName1'],"Cedula"=>$_REQUEST['txtCed1'], "Direccion"=>$_REQUEST['txtDir1'],
      	        "Telefono"=>$_REQUEST['txtTel1'], "Email"=>$_REQUEST['txtEml1'],
      	        "Usuario"=>$_REQUEST['txtUser2'],  "Status"=>1, "Updated_by"=>$vname,  "Updated_at"=>date('Y-m-d H:i:s')
      	      );
      	$where = " Id = " . $_REQUEST['txtId'];
      	$objUser->updateData($data, $where);
      	$vType = substr($_FILES['txtImg']['name'], strlen($_FILES['txtImg']['name'])-3, strlen($_FILES['txtImg']['name']));
      	if(($vType == "png") or ($vType == "jpg")){
      	  $carpeta = "../public/usuarios/".$_REQUEST['txtId'];
      	  $destino2 = "../public/usuarios/".$_REQUEST['txtId']."/".$vimg;
      	  $dest = "public/usuarios/".$_REQUEST['txtId']."/".$vimg."'-";
      	  $ruta2 = $_FILES['txtImg']['tmp_name'];
      	  if(copy($ruta2,$destino2)){
      	    $data = array("Foto"=>$dest);
      	    $where = " Id = " . $_REQUEST['txtId'];
      	    if($objUser->updateData($data, $where)){
      	      header('Location: ../msj/');
      	    }else {
      	      $jsondata['success'] = false;
      	      $jsondata['message'] = "No fue posible Actualizar sus Datos";
      	    }

      	  }else{
      	    $jsondata['success'] = false;
      	    $jsondata['message'] = "No Fue posible subir su Imagen";
      	  }

      	}else{
      	  $jsondata['success'] = false;
      	  $jsondata['message'] = "Formato de imagen Incorrecto, Debe ser png o jpg";
      	}

      }else{
      	/*si tipo file esta vacio*/

      	$data = array("Nombre"=>$_REQUEST['txtName1'],"Cedula"=>$_REQUEST['txtCed1'], "Direccion"=>$_REQUEST['txtDir1'],
      	        "Telefono"=>$_REQUEST['txtTel1'], "Email"=>$_REQUEST['txtEml1'],
      	        "Usuario"=>$_REQUEST['txtUser2'], "Status"=>1, "Updated_by"=>$vname,  "Updated_at"=>date('Y-m-d H:i:s')
      	      );
      	$where = "Id = " . $_REQUEST['txtId'];
      	if($objUser->updateData($data, $where))
      	 {
      	 	header('Location: ../msj/');
      	 }else {
      	  $jsondata['success'] = false;
      	  $jsondata['message'] = "No fue posible Actualizar sus Datos";
      	}

      }


      header('Content-type: application/json; charset=utf-8');
      echo json_encode($jsondata);
    break;
    /* Crea delete de usuarios */
    case "del":
      $Id =  $_REQUEST['pId'];
      $jsondata = array();
      if($objUser->delData($Id))
      {
        $jsondata['success'] = true;
        $jsondata['message'] = "Eliminado correctamente";
      }
      else
      {
       $jsondata['success'] = false;
       $jsondata['message'] = "Falla al Desactivar el registro";
      }
      header('Content-type: application/json; charset=utf-8');
      echo json_encode($jsondata);
    break;
    /* Cambia el password del usuario */
    case "chg":
      // Determina el pasword
    	$jsondata = array();
		$pass = md5($_REQUEST['pPass']);
		$data = array("Password"=>"".$pass."''");
		$where = " Id = " . $_REQUEST['pId'];
      if($objUser->updateData($data, $where))
      {
          $jsondata['success'] = true;
          $jsondata['message'] = "Contraseña modificada correctamente";
      }
      else
      {
           $jsondata['success'] = false;
           $jsondata['message'] = "Falla al modificar el registro";
      }
      header('Content-type: application/json; charset=utf-8');
      echo json_encode($jsondata);
    break;

    case "imp":
    include_once("../Classes/PHPExcel/IOFactory.php");
    set_time_limit(300);
    // header('Content-type: application/json; charset=utf-8');
    // echo json_encode($jsondata);
    // $nombreArchivo = $_FILES['uploadExcel']['name'];
    $nombreArchivo = '../usuarios.xlsx';
    $objPHPExcel = PHPExcel_IOFactory::load($nombreArchivo);
    $objPHPExcel->setActiveSheetIndex(0);
    $numRows = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();
    echo 'Numero de registros cargados'. $numRows. ' ';
    echo '
		<html>
		<head> </head>
		<body>
        <table class="table table-striped table-bordered table-hover">
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
                <th><i class="icon_cogs"></i> Pass</th>
                <th><i class="icon_cogs"></i> Status</th>
                <th><i class="icon_cogs"></i> Creacion</th>
                <th><i class="icon_cogs"></i> user_updated</th>
                <th><i class="icon_cogs"></i> actualiza</th>
            </tr>
            </thead>
			<tbody>
    ';
    for ($i=2; $i <= $numRows; $i++) {
    	//Recojemos el valor de cada columna
    	$nombre = $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue();
    	$cedula = $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue();
    	$direccion = $objPHPExcel->getActiveSheet()->getCell('C'.$i)->getCalculatedValue();
    	$telefono = $objPHPExcel->getActiveSheet()->getCell('D'.$i)->getCalculatedValue();
    	$email = $objPHPExcel->getActiveSheet()->getCell('E'.$i)->getCalculatedValue();
    	$usuario = $objPHPExcel->getActiveSheet()->getCell('F'.$i)->getCalculatedValue();
    	$foto = $objPHPExcel->getActiveSheet()->getCell('G'.$i)->getCalculatedValue();
    	$perfil = $objPHPExcel->getActiveSheet()->getCell('H'.$i)->getCalculatedValue();
    	$pass = $objPHPExcel->getActiveSheet()->getCell('I'.$i)->getCalculatedValue();
    	$status = $objPHPExcel->getActiveSheet()->getCell('J'.$i)->getCalculatedValue();
    	$creacion = $objPHPExcel->getActiveSheet()->getCell('K'.$i)->getCalculatedValue();
    	$user_updated = $objPHPExcel->getActiveSheet()->getCell('L'.$i)->getCalculatedValue();
    	$actualiza =  $objPHPExcel->getActiveSheet()->getCell('M'.$i)->getCalculatedValue();
    	echo '<tr>';
    	echo '<td>'.$nombre.'</td>';
    	echo '<td>'.$cedula.'</td>';
    	echo '<td>'.$direccion.'</td>';
    	echo '<td>'.$telefono.'</td>';
    	echo '<td>'.$email.'</td>';
    	echo '<td>'.$usuario.'</td>';
    	echo '<td>'.$foto.'</td>';
    	echo '<td>'.$perfil.'</td>';
    	echo '<td>'.$pass.'</td>';
    	echo '<td>'.$status.'</td>';
    	echo '<td>'.$creacion.'</td>';
    	echo '<td>'.$user_updated.'</td>';
    	echo '<td>'.$actualiza.'</td>';
    	echo '</body> </html>';

    	$data = array("Nombre"=>$nombre,"Cedula"=>$cedula, "Direccion"=>$direccion,
	        "Telefono"=>$telefono, "Email"=>$email,
	        "Usuario"=>$usuario, "Foto"=>$foto, "Perfil"=>$perfil,  "Password"=>$pass, "Status"=>$status, "Created_at"=>$creacion, "Updated_by"=>$user_updated, "Updated_at"=>$actualiza
    	);
    	if($objUser->insertData($data)){
    		$jsondata['success'] = true;
    		$jsondata['message'] = "Registros cargados correctamente";
    	}else{
    		$jsondata['success'] = false;
    		$jsondata['message'] = "Algo no va bien ! Revisa tu conexión";
    	}
    }
    break;
  }
?>