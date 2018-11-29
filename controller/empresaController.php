<?php
    /** incluye todos los datos de empresa */
    include_once("../AnsTek_libs/integracion.inc.php");
    include_once("../model/empresa.class.php");
    /** Instancia la clase experiencia*/
    $emp = new empresa($db);
    $user = 1;
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
      $result = $emp->selectAll($where);
      if($db->numRows($result) > 0)
      {
        $r = $db->datos($result);
        $jsondata['Id'] = $r["Id"];
        $jsondata['Titulo'] = $r["Titulo"];
        $jsondata['Imagen'] = $r["Imagen"];
        $jsondata['Descripcion'] = $r["Descripcion"];
        $jsondata['Titulo_benef'] = $r["Titulo_benef"];
        $jsondata['Beneficios'] = $r["Beneficios"];
        $jsondata['Direccion'] = $r["Direccion"];
        $jsondata['Telefono'] = $r["Telefono"];
        $jsondata['Email'] = $r["Email"];
        $jsondata['Status'] = $r["Status"];

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
                    $data = array("Titulo"=>$_REQUEST['txtTitle'], "Descripcion"=>$_REQUEST['txtDes'], "Titulo_benef"=>$_REQUEST['txtTben'], "Beneficios"=>$_REQUEST['txtBen'], "Direccion"=>$_REQUEST['txtDir'], "Telefono"=>$_REQUEST['txtTel'], "Email"=>$_REQUEST['txtEmail'], "Status"=>1, "Created_by"=> 1, "Created_date"=>date("Y-m-d H:i:s"));
                  if( $emp->insertData($data)){
                      /* Tomamos el Id del ultimo registro*/
                      $vId = $db->lastInsert();

                        $carpeta = "../public/empresa/".$vId;
                        if (!file_exists($carpeta)) {
                            mkdir($carpeta, 0777, true);
                        }
                        $name = $_FILES['txtImg']['name'];
                        $destino = "../public/empresa/".$vId."/".$name;
                        $dest = "public/empresa/".$vId."/".$name."'-";
                        $ruta = $_FILES['txtImg']['tmp_name'];
                        if(copy($ruta,$destino)){
                          $data = array("Imagen"=>$dest);
                          $where = " Id = " . $vId;
                          if($emp->updateData($data, $where)){
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
        $data = array("Titulo"=>$_REQUEST['txtTitle'], "Descripcion"=>$_REQUEST['txtDes'], "Titulo_benef"=>$_REQUEST['txtTben'], "Beneficios"=>$_REQUEST['txtBen'], "Direccion"=>$_REQUEST['txtDir'], "Telefono"=>$_REQUEST['txtTel'], "Email"=>$_REQUEST['txtEmail'], "Status"=>1, "Created_by"=> 1, "Created_date"=>date("Y-m-d H:i:s"));
        $where = "Id = " . $_REQUEST['txtId'];
        $emp->updateData($data, $where);
        $vType = substr($_FILES['txtImg']['name'], strlen($_FILES['txtImg']['name'])-3, strlen($_FILES['txtImg']['name']));
        if(($vType == "png") or ($vType == "jpg")){
          $carpeta = "../public/empresa/".$_REQUEST['txtId'];
          $destino2 = "../public/empresa/".$_REQUEST['txtId']."/".$vimg;
          $dest = "public/empresa/".$_REQUEST['txtId']."/".$vimg."'-";
          $ruta2 = $_FILES['txtImg']['tmp_name'];
          if(copy($ruta2,$destino2)){
            $data = array("Imagen"=>$dest);
            $where = " Id = " . $_REQUEST['txtId'];
            if($emp->updateData($data, $where)){
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
       $data = array("Titulo"=>$_REQUEST['txtTitle'], "Descripcion"=>$_REQUEST['txtDes'], "Titulo_benef"=>$_REQUEST['txtTben'], "Beneficios"=>$_REQUEST['txtBen'], "Direccion"=>$_REQUEST['txtDir'], "Telefono"=>$_REQUEST['txtTel'], "Email"=>$_REQUEST['txtEmail'], "Status"=>1, "Created_by"=> 1, "Created_date"=>date("Y-m-d H:i:s"));

        $where = "Id = " . $_REQUEST['txtId'];
        if($emp->updateData($data, $where))
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


   /* Crea delete de usuarios */
   case "del":
     $Id =  $_REQUEST['pId'];
     $jsondata = array();
     if($galeriaI->delData($Id))
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
