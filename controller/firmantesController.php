<?php
    /** incluye todos los recursos */
  include_once("../AnsTek_libs/integracion.inc.php");
    Session::valida_sesion("","../../index.php");
  include_once("../model/firmantes.class.php");
  include_once("../model/usuarios.class.php");
    $objUser = new usuario($db);
  /** Instancia la clase firmantes*/
    $objFir = new firmante($db);
    $UserId = Session::get('Id');
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
      $result = $objFir->selectAll($where);
      if($db->numRows($result) > 0)
      {
        $r = $db->datos($result);
        $jsondata['Id'] = $r["Id"];
        $jsondata['Razon_social'] = $r["Razon_social"];
        $jsondata['Nit'] = $r["Nit"];
        $jsondata['Telefono_emp'] = $r["Telefono_emp"];
        $jsondata['Pagina_web'] = $r["Pagina_web"];
        $jsondata['Nombre_Repre'] = $r["Nombre_Repre"];
        $jsondata['Cedula_Repre'] = $r["Cedula_Repre"];
        $jsondata['Telefono_Repre'] = $r["Telefono_Repre"];
        $jsondata['Email_Repre'] = $r["Email_Repre"];
        $jsondata['Responsable_pacto'] = $r["Responsable_pacto"];
        $jsondata['Cedula_Res'] = $r["Cedula_Res"];
        $jsondata['Telefono_Res'] = $r["Telefono_Res"];
        $jsondata['Email_Res'] = $r["Email_Res"];
        $jsondata['Created_date'] = $r["Created_date"];
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
    $data = array("Razon_social"=>$_REQUEST['txtRazon'],"Nit"=>$_REQUEST['txtNit'], "Telefono_emp"=>$_REQUEST['txtTel'],
            "Pagina_web"=>$_REQUEST['txtPag'], "Nombre_Repre"=>$_REQUEST['txtRep'],
            "Cedula_Repre"=>$_REQUEST['txtCed'], "Telefono_Repre"=>$_REQUEST['txtTelR'], "Email_Repre"=>$_REQUEST['txtEmailR'],
            "Responsable_pacto"=>$_REQUEST['txtRes'], "Cedula_Res"=>$_REQUEST['txtCedR'], "Telefono_Res"=>$_REQUEST['txtTelRes'],
            "Email_Res"=>$_REQUEST['txtEmailres'],
             "Status"=>1, "Created_date"=>date('Y-m-d H:i:s'), "Created_by" => $UserId
          );
        // clausulas where para validar cedula y usuario
      $whereC = " Where Nit = " . $_REQUEST['txtNit'];
       $resultC = $objFir->selectAll($whereC);
       // valida la existencia de una cedula igual
       if($db->numRows($resultC) > 0){
            if ($r = $db->datos($resultC)) {
                $jsondata['success'] = false;
                $jsondata['message'] = "Este Nit Ya Existe en nuestro sistema";
            }else{
                // valida si hay un nombre de ususario igual

              // realiza el registro a la base de datos
              if($objFir->insertData($data))
              {
                $uno = 1;
                $data1 = array("firma_pacto" => $uno."' ");
                $Where1 = " Id = " . $UserId;
                // actualizamos el ultimo regsitro
                if($objUser->updateData($data1, $Where1)){
                  $jsondata['success'] = true;
                  $jsondata['message'] = "Registrado correctamente";
                }else {
                  $jsondata['success'] = false;
                  $jsondata['message'] = "No fue posible Registrar sus datos";
                }


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
        $objFir->updateData($data, $where);
        $vType = substr($_FILES['txtImg']['name'], strlen($_FILES['txtImg']['name'])-3, strlen($_FILES['txtImg']['name']));
        if(($vType == "png") or ($vType == "jpg")){
          $carpeta = "../public/usuarios/".$_REQUEST['txtId'];
          $destino2 = "../public/usuarios/".$_REQUEST['txtId']."/".$vimg;
          $dest = "public/usuarios/".$_REQUEST['txtId']."/".$vimg."'-";
          $ruta2 = $_FILES['txtImg']['tmp_name'];
          if(copy($ruta2,$destino2)){
            $data = array("Foto"=>$dest);
            $where = " Id = " . $_REQUEST['txtId'];
            if($objFir->updateData($data, $where)){
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
        if($objFir->updateData($data, $where))
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
      if($objFir->delData($Id))
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
      if($objFir->updateData($data, $where))
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


  }
?>