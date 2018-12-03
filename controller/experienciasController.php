<?php
    /** incluye todos los recursos */
    include_once("../AnsTek_libs/integracion.inc.php");
    include_once("../model/experiencias.class.php");
    /** Instancia la clase experiencia*/
    $Exp = new experiencia($db);
    $Cedula_RL = Session::get('Cedula');
    $user = Session::get('Id');
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
      $result = $Exp->selectAll($where);
      if($db->numRows($result) > 0)
      {
        $r = $db->datos($result);
        $jsondata['Id'] = $r["Id"];
        $jsondata['Titulo'] = $r["Titulo"];
        $jsondata['Imagen'] = $r["Imagen"];
        $jsondata['Descripcion'] = $r["Descripcion"];
        $jsondata['Enlace'] = $r["Enlace"];
        $jsondata['Documento'] = $r["Documento"];
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
      $Doc = $_FILES['txtFile']['name'];
       if ($Doc != "") {
        // Imagen Destacada
        $file = $_FILES['txtImagen']['name'];
        $vType = substr($_FILES['txtImagen']['name'], strlen($_FILES['txtImagen']['name'])-3, strlen($_FILES['txtImagen']['name']));

        // Validamos Documento Compartido
        $Doc = $_FILES['txtFile']['name'];
        $vDoc = substr($_FILES['txtFile']['name'], strlen($_FILES['txtFile']['name'])-3, strlen($_FILES['txtFile']['name']));

        if(($vDoc != "exe") or ($vDoc != "txt")){

          if(($vType == "png") or ($vType == "jpg")){

                // Realiza Insert
                $data = array("Titulo"=>$_REQUEST['txtTi'], "Descripcion"=>$_REQUEST['txtDes'], "Enlace"=>$_REQUEST['txtLink'], "R_Legal"=>$Cedula_RL, "Status"=>3, "Created_by"=>$user, "Created_date"=>date("Y-m-d H:i:s")
                );
                if($Exp->insertData($data)){
                    /* Tomamos el Id del ultimo registro*/
                    $vId = $db->lastInsert();
                    $carpeta = "../public/experiencias/".$vId;
                    if (!file_exists($carpeta)) {
                        mkdir($carpeta, 0777, true);
                    }
                    $name = $_FILES['txtImagen']['name'];
                    $destino = "../public/experiencias/".$vId."/".$name;
                    $dest = "public/experiencias/".$vId."/".$name."'-";
                    $ruta = $_FILES['txtImagen']['tmp_name'];
                    if(copy($ruta,$destino)){
                        $data = array("Imagen"=>$dest);
                        $where = " Id = " . $vId;
                        if($Exp->updateData($data, $where)){

                          $Doc = $_FILES['txtFile']['name'];
                          $destinoD = "../public/experiencias/".$vId."/".$Doc;
                          $destD = "public/experiencias/".$vId."/".$Doc."'-";
                          $rutaD = $_FILES['txtFile']['tmp_name'];
                          if(copy($rutaD,$destinoD)){
                              $dataD = array("Documento"=>$destD);
                              $whereD = " Id = " . $vId;
                              if($Exp->updateData($dataD, $whereD)){
                                $jsondata['success'] = true;
                                $jsondata['message'] = "Tu Experiencia ha sido registrada";
                              }else{
                                $jsondata['success'] = false;
                                $jsondata['message'] = "Algo paso al actualizar el documento";
                              }


                          }else{
                            $jsondata['success'] = false;
                            $jsondata['message'] = "No fue posible subir su documento";
                          }


                          // $jsondata['success'] = true;
                          // $jsondata['message'] = "Registrado correctamente";
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
              $jsondata['message'] = "Formato de imagen Incorrecto, Debe ser png o jpg";
          }


        }else{

          $jsondata['success'] = false;
          $jsondata['message'] = "El documento adjunto no es valido";

        }

       }else{
        // Cuando el formulario llena sin documneto, solo validamos la imagen
        // Imagen Destacada
        $file = $_FILES['txtImagen']['name'];
        $vType = substr($_FILES['txtImagen']['name'], strlen($_FILES['txtImagen']['name'])-3, strlen($_FILES['txtImagen']['name']));

        if(($vType == "png") or ($vType == "jpg")){

              // Realiza Insert
              $data = array("Titulo"=>$_REQUEST['txtTi'], "Descripcion"=>$_REQUEST['txtDes'], "Enlace"=>$_REQUEST['txtLink'], "R_Legal"=>$Cedula_RL, "Status"=>3, "Created_by"=>$user, "Created_date"=>date("Y-m-d H:i:s")
              );
              if($Exp->insertData($data)){
                  /* Tomamos el Id del ultimo registro*/
                  $vId = $db->lastInsert();
                  $carpeta = "../public/experiencias/".$vId;
                  if (!file_exists($carpeta)) {
                      mkdir($carpeta, 0777, true);
                  }
                  $name = $_FILES['txtImagen']['name'];
                  $destino = "../public/experiencias/".$vId."/".$name;
                  $dest = "public/experiencias/".$vId."/".$name."'-";
                  $ruta = $_FILES['txtImagen']['tmp_name'];
                  if(copy($ruta,$destino)){
                      $data = array("Imagen"=>$dest);
                      $where = " Id = " . $vId;
                      if($Exp->updateData($data, $where)){

                        $jsondata['success'] = true;
                        $jsondata['message'] = "Tu Experiencia ha sido registrada con exito";
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
            $jsondata['message'] = "Formato de imagen Incorrecto, Debe ser png o jpg";
        }




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
        $data = array("Titulo"=>$_REQUEST['txtTitle'], "Descripcion"=>$_REQUEST['txtDes'], "Enlace"=>$_REQUEST['txtLink'], "Status"=>$_REQUEST['txtStatus'], "Created_by"=>$user, "Created_date"=>date("Y-m-d H:i:s")
        );
        $where = "Id = " . $_REQUEST['txtId'];
        $Exp->updateData($data, $where);
        $vType = substr($_FILES['txtImg']['name'], strlen($_FILES['txtImg']['name'])-3, strlen($_FILES['txtImg']['name']));
        if(($vType == "png") or ($vType == "jpg")){
          $carpeta = "../public/beneficios/".$_REQUEST['txtId'];
          $destino2 = "../public/beneficios/".$_REQUEST['txtId']."/".$vimg;
          $dest = "public/beneficios/".$_REQUEST['txtId']."/".$vimg."'-";
          $ruta2 = $_FILES['txtImg']['tmp_name'];
          if(copy($ruta2,$destino2)){
            $data = array("Imagen_principal"=>$dest);
            $where = " Id = " . $_REQUEST['txtId'];
            if($Exp->updateData($data, $where)){
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
        $data = array("Titulo"=>$_REQUEST['txtTitle'], "Descripcion"=>$_REQUEST['txtDes'], "Enlace"=>$_REQUEST['txtLink'], "Status"=>$_REQUEST['txtStatus'], "Created_by"=>$user, "Created_date"=>date("Y-m-d H:i:s")
        );
        $where = "Id = " . $_REQUEST['txtId'];
        if($Exp->updateData($data, $where))
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
        $data = array("Status"=>$_REQUEST['txtStattus'], "Updated_by"=>$user, "Updated_date"=>date("Y-m-d H:i:s")
                  );
      $where = "Id = " . $_REQUEST['txtArq'];
     if( $Exp->updateData($data, $where))
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
     if($Exp->delData($Id))
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
