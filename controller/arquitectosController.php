<?php
    /** incluye todos los recursos */
  include_once("../AnsTek_libs/integracion.inc.php");
  Session::valida_sesion("","../../index.php");
  include_once("../model/arquitectos.class.php");


  /** Instancia la clase firmantes*/
    $objArq = new  arquitecto($db);
    $UserId = Session::get('Id');
    $Cedula_RL = Session::get('Cedula');
  /** captura el tipo de accion a realizar*/
  $accion = $_REQUEST['accion'];
    /** conmutador que determina las acciones a realizar para
     * este modulo
     */
    switch($accion){
    /* Obtiene un solo registro de usuario */
        case "single":
        $jsondata = array();
      $where = " Where Id = " . $_REQUEST['pId'];
      $result = $objArq->selectAll($where);
      if($db->numRows($result) > 0)
      {
        $r = $db->datos($result);
        $jsondata['Id'] = $r["Id"];
        $jsondata['Nombres'] = $r["Nombres"];
        $jsondata['Apellidos'] = $r["Apellidos"];
        $jsondata['Cedula'] = $r["Cedula"];
        $jsondata['Email'] = $r["Email"];
        $jsondata['Telefono'] = $r["Telefono"];
        $jsondata['Nit_empresa'] = $r["Nit_empresa"];
        $jsondata['Nivel_educativo'] = $r["Nivel_educativo"];
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
    /* Crea insert de Cedula_Repres */
    case "ins":
    $jsondata = array();
      // Datos necesarios para el registro
    $data = array("Nombres"=>$_REQUEST['txtName'],"Apellidos"=>$_REQUEST['txtApe'], "Cedula"=>$_REQUEST['txtCed'],
            "Email"=>$_REQUEST['txtEmail'], "Telefono"=>$_REQUEST['txtTel'],
            "Nit_empresa"=>$_REQUEST['txtEmp'], "Nivel_educativo"=>$_REQUEST['txtPro'], "Cedula_RL" => $Cedula_RL,
             "Status"=>3, "Created_date"=>date('Y-m-d H:i:s'), "Created_by" => $UserId
          );
        // clausulas where para validar cedula y usuario
      $whereC = " Where Cedula = " . $_REQUEST['txtCed'];
       $resultC = $objArq->selectAll($whereC);
       // valida la existencia de una cedula igual
       if($db->numRows($resultC) > 0){
            if ($r = $db->datos($resultC)) {
                $jsondata['success'] = false;
                $jsondata['message'] = "Esta Cédula Ya Existe en nuestro sistema";
            }else{
                // valida si hay un nombre de ususario igual

              // realiza el registro a la base de datos
              if($objArq->insertData($data))
              {
                  $jsondata['success'] = true;
                  $jsondata['message'] = "Registrado correctamente";

              }
              else
              {
                  $jsondata['success'] = false;
                  $jsondata['message'] = "Falla al enviar el registro";
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
        $objArq->updateData($data, $where);
        $vType = substr($_FILES['txtImg']['name'], strlen($_FILES['txtImg']['name'])-3, strlen($_FILES['txtImg']['name']));
        if(($vType == "png") or ($vType == "jpg")){
          $carpeta = "../public/usuarios/".$_REQUEST['txtId'];
          $destino2 = "../public/usuarios/".$_REQUEST['txtId']."/".$vimg;
          $dest = "public/usuarios/".$_REQUEST['txtId']."/".$vimg."'-";
          $ruta2 = $_FILES['txtImg']['tmp_name'];
          if(copy($ruta2,$destino2)){
            $data = array("Foto"=>$dest);
            $where = " Id = " . $_REQUEST['txtId'];
            if($objArq->updateData($data, $where)){
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
        if($objArq->updateData($data, $where))
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
    /* Crea delete de usuarios */
    case "del":
      $Id =  $_REQUEST['pId'];
      $jsondata = array();
      if($objArq->delData($Id))
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
      if($objArq->updateData($data, $where))
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



        $file = $_FILES['txtImg']['name'];
        // echo $file;
        $vType = substr($_FILES['txtImg']['name'], strlen($_FILES['txtImg']['name'])-4, strlen($_FILES['txtImg']['name']));
        // echo $vType;
	      if($vType == 'xlsx'){
	      			// Creamos Carpeta
				  	$carpeta = "../public/Arquitectos/".$UserId;
				  	if (!file_exists($carpeta)) {
				  	    mkdir($carpeta, 0777, true);
				  	}
				  	$name = $_FILES['txtImg']['name'];
				  	$destino = "../public/Arquitectos/".$UserId."/".$name;
				  	$dest = "public/Arquitectos/".$UserId."/".$name."'-";
				  	$ruta = $_FILES['txtImg']['tmp_name'];
				  	if(copy($ruta,$destino)){

				  			     include_once("../Classes/PHPExcel/IOFactory.php");
				  			     set_time_limit(300);
				  		        $nombreArchivo = $destino;
				  		        $objPHPExcel = PHPExcel_IOFactory::load($nombreArchivo);
				  		        $objPHPExcel->setActiveSheetIndex(0);

				  		        // $numRows = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();
				  		        $sheet = $objPHPExcel->getSheet(0);
								$highestRow = $sheet->getHighestRow();
								$highestColumn = $sheet->getHighestColumn();
								$resta = ($highestRow - 1);
								$resta2 = ($highestRow - 2);


				  		        for ($i=2; $i <= $resta; $i++) {

	        		  		          //Recojemos el valor de cada columna
	        		  		          $nombres = $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue();
	        		  		          $apellidos = $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue();
	        		  		          $cedula = $objPHPExcel->getActiveSheet()->getCell('C'.$i)->getCalculatedValue();
	        		  		          $email = $objPHPExcel->getActiveSheet()->getCell('D'.$i)->getCalculatedValue();
	        		  		          $telefono = $objPHPExcel->getActiveSheet()->getCell('E'.$i)->getCalculatedValue();
	        		  		          $nit = $objPHPExcel->getActiveSheet()->getCell('F'.$i)->getCalculatedValue();
	        		  		          $nivel = $objPHPExcel->getActiveSheet()->getCell('G'.$i)->getCalculatedValue();
	        		  		          $cedula_rl = $objPHPExcel->getActiveSheet()->getCell('H'.$i)->getCalculatedValue();


		  		         	      		$data = array("Nombres"=>$nombres,"Apellidos"=>$apellidos, "Cedula"=>$cedula,
		  		         	      		        "Email"=>$email, "Telefono"=>$telefono,
		  		         	      		        "Nit_empresa"=>$nit, "Nivel_educativo"=>$nivel, "Cedula_RL" =>  $cedula_rl,
		  		         	      		         "Status"=>3, "Created_date"=>date('Y-m-d H:i:s'), "Created_by" => $UserId
		  		         	      		      );
			  		         	        // realiza el registro a la base de datos
			  		         	        if($objArq->insertData($data))
			  		         	        {
			  		         	            $jsondata['success'] = true;
			  		         	            $jsondata['message'] = "Registrado correctamente";
			  		         	            $jsondata['numRows'] = $resta2;

			  		         	        }
			  		         	        else
			  		         	        {
			  		         	            $jsondata['success'] = false;
			  		         	            $jsondata['message'] = "Falla al enviar el registro";
			  		         	        }

				  		        }


				  	}else {
		            $jsondata['success'] = false;
		            $jsondata['message'] = "No fue posible subir su Archivo";
		        }

	      }else{
	      	  $jsondata['success'] = false;
	      	  $jsondata['message'] = "Formato Incorrecto debe ser .xlsx";
	      }

	    header('Content-type: application/json; charset=utf-8');
        echo json_encode($jsondata);

        break;
  }
?>