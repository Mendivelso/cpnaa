<?php
    /** incluye todos los recursos */
  include_once("../AnsTek_libs/integracion.inc.php");
    Session::valida_sesion("","../../index.php");
  include_once("../model/videos.class.php");
  /** Instancia la clase usuarios*/
    $video = new video($db);
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
      $result = $video->selectAll($where);
      if($db->numRows($result) > 0)
      {
        $r = $db->datos($result);
        $jsondata['Id'] = $r["Id"];
        $jsondata['Video'] = $r["Video"];
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
      // Realiza Insert
            $data = array("Video"=>$_REQUEST['txtCod'], "Status"=>$_REQUEST['pStatus'], "Created_by"=>1,  "Created_date"=>date('Y-m-d H:i:s')
                  );
      if($video->insertData($data))
      {
          $jsondata['success'] = true;
          $jsondata['message'] = "Registrado correctamente";
      }
      else
      {
          $jsondata['success'] = false;
          $jsondata['message'] = "Falla al enviar el registro";
      }
      header('Content-type: application/json; charset=utf-8');
      echo json_encode($jsondata);
    break;



      /* Crea Update de usuarios */

    case "upd":
      $jsondata = array();
      // Realiza Insert
      $data = array("Video"=>$_REQUEST['txtCod'], "Status"=>$_REQUEST['txtStatus'], "Created_by"=>1,  "Created_date"=>date('Y-m-d H:i:s')
            );
      $where = "Id = " . $_REQUEST['txtId'];
     if($video->updateData($data, $where))
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

  }
?>