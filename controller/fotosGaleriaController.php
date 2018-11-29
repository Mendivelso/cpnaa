<?php
    /** incluye todos los recursos */
    include_once("../AnsTek_libs/integracion.inc.php");
    include_once("../model/galeriasServicios.class.php");
    /** Instancia la clase experiencia*/
    $fotoS = new fotoServicio($db);
    $user = 0;
    /** captura el tipo de accion a realizar*/
    $accion = $_REQUEST['accion'];
    /** conmutador que determina las acciones a realizar para
     * este modulo
     */
    switch($accion){
    /* Obtiene un solo registro de Experiencias */
      case "single":
      $jsondata = array();
      $where = " Where ft.Id = " . $_REQUEST['pId'];
      $result = $fotoS->selectAll($where);
      if($db->numRows($result) > 0)
      {
        $r = $db->datos($result);
        $jsondata['Id'] = $r["Id"];
        $jsondata['Imagen'] = $r["Imagen"];
        $jsondata['Status'] = $r["Status"];
        $jsondata['Servicio_id'] = $r["Servicio_id"];
        $jsondata['title'] = $r["title"];
        $jsondata['Created_date'] = $r["Created_date"];
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
              $vType = substr($_FILES['txtImg']['name'], strlen($_FILES['txtImg']['name'])-3, strlen($_FILES['txtImg']['name']));

              if(($vType == "png") or ($vType == "jpg")){
                  // Realiza Insert
                    $data = array("Status"=>$_REQUEST['txtStatus'], "Servicio_id"=>$_REQUEST['txtSer'], "Created_by"=> 1, "Created_date"=>date("Y-m-d H:i:s"));
                  if( $fotoS->insertData($data)){
                      /* Tomamos el Id del ultimo registro*/
                      $vId = $db->lastInsert();

                        $carpeta = "../public/fotos_servicios/".$vId;
                        if (!file_exists($carpeta)) {
                            mkdir($carpeta, 0777, true);
                        }
                        $name = $_FILES['txtImg']['name'];
                        $destino = "../public/fotos_servicios/".$vId."/".$name;
                        $dest = "public/fotos_servicios/".$vId."/".$name."'-";
                        $ruta = $_FILES['txtImg']['tmp_name'];
                        if(copy($ruta,$destino)){
                          $data = array("Imagen"=>$dest);
                          $where = " Id = " . $vId;
                          if($fotoS->updateData($data, $where)){
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

                  }else{
                        $jsondata['success'] = false;
                        $jsondata['message'] = "Falla al realizar el registro";
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
        $data = array("Status"=>$_REQUEST['txtStatus'], "Servicio_id"=>$_REQUEST['txtSer'], "Updated_by"=> 1, "Updated_date"=>date("Y-m-d H:i:s"));
        $where = "Id = " . $_REQUEST['txtId'];
        $fotoS->updateData($data, $where);
        $vType = substr($_FILES['txtImg']['name'], strlen($_FILES['txtImg']['name'])-3, strlen($_FILES['txtImg']['name']));
        if(($vType == "png") or ($vType == "jpg")){
          $carpeta = "../public/fotos_servicios/".$_REQUEST['txtId'];
          $destino2 = "../public/fotos_servicios/".$_REQUEST['txtId']."/".$vimg;
          $dest = "public/fotos_servicios/".$_REQUEST['txtId']."/".$vimg."'-";
          $ruta2 = $_FILES['txtImg']['tmp_name'];
          if(copy($ruta2,$destino2)){
            $data = array("Imagen"=>$dest);
            $where = " Id = " . $_REQUEST['txtId'];
            if($fotoS->updateData($data, $where)){
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
        $data = array("Status"=>$_REQUEST['txtStatus'], "Servicio_id"=>$_REQUEST['txtSer'], "Created_by"=> 1, "Created_date"=>date("Y-m-d H:i:s"));

        $where = "Id = " . $_REQUEST['txtId'];
        if($fotoS->updateData($data, $where))
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
        $data = array("Status"=>$_REQUEST['pStatus'],"Updated_by"=>$user, "Updated_at"=>date("Y-m-d H:i:s")
                  );
      $where = "Id = " . $_REQUEST['pId'];
     if($act->updateData($data, $where))
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
     if($fotoS->delData($Id))
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
