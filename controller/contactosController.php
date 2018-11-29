<?php
    /** incluye todos los recursos */
    include_once("../AnsTek_libs/integracion.inc.php");
    include_once("../model/contactos.class.php");
    /** Instancia la clase experiencia*/
    $contacto = new contacto($db);
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
      $where = " Where Id = " . $_REQUEST['pId'];
      $result = $contacto->selectAll($where);
      if($db->numRows($result) > 0)
      {
        $r = $db->datos($result);
        $jsondata['Id'] = $r["Id"];
        $jsondata['Nombre'] = $r["Nombre"];
        $jsondata['Correo'] = $r["Correo"];
        $jsondata['Telefono'] = $r["Telefono"];
        $jsondata['Mensaje'] = $r["Mensaje"];
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
      // Realiza Insert
        $data = array("Nombre"=>$_REQUEST['txtName'], "Correo"=>$_REQUEST['txtEmail'], "Telefono"=>$_REQUEST['txtTel'],
            "Mensaje"=>$_REQUEST['txtComent'], "Created_date"=>date("Y-m-d H:i:s")
                  );
      if($contacto->insertData($data))
     {

     	  $h2= "<h2 style=\"margin-top:2px; font-family:Arial_Black_V2; color:#000\">Cordial saludo <br></h2>";
     	  $mensaje = "
     	    <div style=\" background-color:/*#009ba8*/#fff; color:#000; width: 600px;\">
     	        <center><br>".$h2." <hr>
     	            <p style=\"font-family:Arial_Black_V2; font-size: 18px; color:#000\">Un nuevo contacto se ha registrado esta es su información: </p>
     	            <label style=\"font-family:Arial_Black_V2; font-size: 18px; color:#000\">Nombre: </label>".$_REQUEST['txtName']." <br>
     	            <label style=\"font-family:Arial_Black_V2; font-size: 18px; color:#000\">E-mail:</label>".$_REQUEST['txtEmail']." <br>
     	            <label style=\"font-family:Arial_Black_V2; font-size: 18px; color:#000\">Celular:</label>".$_REQUEST['txtTel']." <br>
     	            <label style=\"font-family:Arial_Black_V2; font-size: 18px; color:#000\">Comentario:</label>".$_REQUEST['txtComent']." <br>

     	            <hr>
     	            <p style=\"font-family:Arial_Black_V2; font-size:15px; color:#000\"> &Eacute;ste correo ha sido enviado autom&aacute;ticamente por favor no lo responda.</p>
     	        </center>
     	    </div>";
     	// Always set content-type when sending HTML email
     	    $headers = "MIME-Version: 1.0" . "\r\n";
     	    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
     	    $headers .= 'From: <info@zonasegura.com>' . "\r\n";
     	    $mensaje .= "Enviado el " . date('d/m/Y', time());
     	    $para  = 'info@zonasegura.com.co'.' ,'; // atención a la coma
     	    $asunto = 'Contacto desde pagina web';
     	    mail($para, $asunto, $mensaje, $headers);

       $jsondata['success'] = true;
      	$jsondata['message'] = ' Gracias por registrarte '. $_REQUEST['txtName'] . ' Pronto Nos Comunicaremos';
      }
      else
      {
        $jsondata['success'] = false;
        $jsondata['message'] = "Falla al realizar el registro";
      }
      header('Content-type: application/json; charset=utf-8');
      echo json_encode($jsondata);
   break;

    /*crea update de Expereincias */


    }
?>
