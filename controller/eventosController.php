<?php
    /** incluye todos los recursos */
    include_once("../AnsTek_libs/integracion.inc.php");
    include_once("../model/eventos.class.php");
    /** Instancia la clase experiencia*/
    $event = new evento($db);
    $user =Session::get('Id');
    /** captura el tipo de accion a realizar*/
    $accion = $_REQUEST['accion'];
    /** conmutador que determina las acciones a realizar para
     * este modulo
     */
    switch($accion){
    /* Obtiene un solo registro de Experiencias */
      case "single":
      $jsondata = array();
      $where = " Where Id = " . $_REQUEST['pId'];
      $result = $event->selectAll($where);
      if($db->numRows($result) > 0)
      {
        $r = $db->datos($result);
        $jsondata['Id'] = $r["Id"];
        $jsondata['Titulo'] = $r["Titulo"];
        $jsondata['Imagen_principal'] = $r["Imagen_principal"];
        $jsondata['Descripcion'] = $r["Descripcion"];
        $jsondata['Enlace'] = $r["Enlace"];
        $jsondata['Fecha'] = $r["Fecha"];
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
    /* insert  de Servicios */
    case "ins":
      $jsondata = array();
      $file = $_FILES['txtImg']['name'];
      $vType = substr($_FILES['txtImg']['name'], strlen($_FILES['txtImg']['name'])-3, strlen($_FILES['txtImg']['name']));
      // if(($vType == "png") or ($vType == "jpg")){
      if(($vType == "png") or ($vType == "jpg")){
        //validamos el peso de la imagen
        if($_FILES['txtImg']['size'] <= 1000000){
          //validamos las dimensiones de la imagen
          $infoImagen = getimagesize($_FILES['txtImg']['tmp_name']);
          if ($infoImagen[0] <= 400 || $infoImagen[1] <= 400) {
              // Realiza Insert
            $data = array("Titulo"=>$_REQUEST['txtTitle'], "Descripcion"=>$_REQUEST['txtDes'], "Enlace"=>$_REQUEST['txtLink'], "Fecha"=>$_REQUEST['txtDate'], "Status"=>$_REQUEST['txtStatus'], "Created_by"=>$user, "Created_date"=>date("Y-m-d H:i:s")
            );
            if($event->insertData($data)){
              /* Tomamos el Id del ultimo registro*/
              $vId = $db->lastInsert();
              $carpeta = "../public/eventos/".$vId;
              if (!file_exists($carpeta)) {
                  mkdir($carpeta, 0777, true);
              }
              $name = $_FILES['txtImg']['name'];
              $destino = "../public/eventos/".$vId."/".$name;
              $dest = "public/eventos/".$vId."/".$name."'-";
              $ruta = $_FILES['txtImg']['tmp_name'];
              if(copy($ruta,$destino)){
                $data = array("Imagen_principal"=>$dest);
                $where = " Id = " . $vId;
                if($event->updateData($data, $where)){
                  $jsondata['success'] = true;
                  $jsondata['message'] = "Registrado correctamente";
                }else {
                  $jsondata['success'] = false;
                  $jsondata['message'] = "NO fue posible Registrar sus datos";
                }
              }else {
                  $jsondata['success'] = false;
                  $jsondata['message'] = "No fue posible subir su Imagen";
              }
            }
            else
            {
              $jsondata['success'] = false;
              $jsondata['message'] = "Falla al realizar el registro";
            }


          }else{
            $jsondata['success'] = false;
            $jsondata['message'] = "La imagen no cumple las medidas solicitadas ";
          }

        }else{
          $jsondata['success'] = false;
          $jsondata['message'] = "No se pueden subir Imagenes con pesos superiores a 1MB";
        }
                            
      }else{
      	  $jsondata['success'] = false;
      	  $jsondata['message'] = "Formato de imagen Incorrecto, Debe ser png o jpg";
      }
      header('Content-type: application/json; charset=utf-8');
      echo json_encode($jsondata);
   break;

    /*crea update de Expereincias */

    case "upd":
      $jsondata = array();
      $vimg = $_FILES['txtImg']['name'];
      if ($vimg != "") {
        // si file viene lleno
		$data = array("Titulo"=>$_REQUEST['txtTitle'], "Descripcion"=>$_REQUEST['txtDes'], "Enlace"=>$_REQUEST['txtLink'], "Fecha"=>$_REQUEST['txtDate'], "Status"=>$_REQUEST['txtStatus'], "Created_by"=>$user, "Created_date"=>date("Y-m-d H:i:s")
		);
        $where = " Id = " . $_REQUEST['txtId'];
        $event->updateData($data, $where);
        $vType = substr($_FILES['txtImg']['name'], strlen($_FILES['txtImg']['name'])-3, strlen($_FILES['txtImg']['name']));
        if(($vType == "png") or ($vType == "jpg")){
          //validamos el peso de la imagen
          if($_FILES['txtImg']['size'] <= 1000000){
            //validamos las dimensiones de la imagen
            $infoImagen = getimagesize($_FILES['txtImg']['tmp_name']);
            if ($infoImagen[0] <= 400 || $infoImagen[1] <= 400) {
              $carpeta = "../public/eventos/".$_REQUEST['txtId'];
              $destino2 = "../public/eventos/".$_REQUEST['txtId']."/".$vimg;
              $dest = "public/eventos/".$_REQUEST['txtId']."/".$vimg."'-";
              $ruta2 = $_FILES['txtImg']['tmp_name'];
              if(copy($ruta2,$destino2)){
                $data = array("Imagen_principal"=>$dest);
                $where = " Id = " . $_REQUEST['txtId'];
                if($event->updateData($data, $where)){
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
              $jsondata['message'] = "La imagen no cumple las medidas solicitadas ";
            }

          }else{
            $jsondata['success'] = false;
            $jsondata['message'] = "No se pueden subir Imagenes con pesos superiores a 1MB";
          }
                  
        }else{
          $jsondata['success'] = false;
          $jsondata['message'] = "Formato de imagen Incorrecto, Debe ser png o jpg";
        }

      }else{
        /*si tipo file esta vacio*/
        $data = array("Titulo"=>$_REQUEST['txtTitle'], "Descripcion"=>$_REQUEST['txtDes'], "Enlace"=>$_REQUEST['txtLink'], "Fecha"=>$_REQUEST['txtDate'], "Status"=>$_REQUEST['txtStatus'], "Created_by"=>$user, "Created_date"=>date("Y-m-d H:i:s")
        );
        $where = "Id = " . $_REQUEST['txtId'];
        if($event->updateData($data, $where))
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

   // cambia estado

   case "status":
      $jsondata = array();
      // Realiza Insert
        $data = array("Status"=>$_REQUEST['pStatus'], "Descripcion"=>$_REQUEST['txtDes'], "Enlace"=>$_REQUEST['txtLink'], "Fecha"=>$_REQUEST['txtDate'], "Updated_by"=>$user, "Updated_at"=>date("Y-m-d H:i:s")
                  );
      $where = "Id = " . $_REQUEST['pId'];
     if($eventvicio->updateData($data, $where))
     {
       $jsondata['success'] = true;
       $jsondata['message'] = "Modificado correctamente";
      }
      else
      {
        $jsondata['success'] = false;
        $jsondata['message'] = "Falla al modificar el registro";
      }
      header('Content-type: application/json; charset=utf-8');
      echo json_encode($jsondata);
   break;
   /* Crea delete de usuarios */
   case "del":

     $Id =  $_REQUEST['pId'];
     $jsondata = array();
     if($event->delData($Id))
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


    }
?>
