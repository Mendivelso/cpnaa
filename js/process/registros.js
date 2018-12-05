// VALIDACION FORMULARIO NUEVO USUARIO
    $("#usuarios").validate({
    rules:{

      txtDoc:{
          required: true
      },
      txtName:{
          required: true
      },
      txtDir:{
          required: true
      },
      txtTel:{
          required: true
      },
      txtEml:{
          required: true,
          email:true
      },
      txtUser:{
          required: true
      },
      txtPass1:{
        required:true
      },
      txtPass2:{
        required:true,
        equalTo: "#txtPass1"
      }
    },
    messages:{


      txtDoc:{
          required: "Debe escribir su cedula"
      },
      txtName:{
          required: "Debe escribir su nombre"
      },
      txtDir:{
          required: "Debe escribir su dirección"
      },
      txtTel:{
          required: "Debe escribir su teléfono"
      },
      txtEml:{
          required: "Debe escribir su E-mail",
          email: "E-mial Incorrecto"
      },
      txtUser:{
          required: "Genere un Usuario"
      },
      txtPass1:{
        required: "Debe escribir su Contraseña"
      },
      txtPass2:{
        required:"Debe confirmar su contraseña",
        equalTo: "Las contraseñas no coinciden"
      }

     },

  submitHandler: function(form){
      var vDoc = $('#txtDoc').val();
      var vName = $('#txtName').val();
      var vDir = $('#txtDir').val();
      var vTel = $('#txtTel').val();
      var vEml = $('#txtEml').val();
      var vUser = $('#txtUser').val();
      var vPass = $('#txtPass').val();
      var vImg = $('#txtImg').val();
      var vData = '';

      var vId  = $('#txtId').val();
            var vurl = "";
            if (vId > 0) {
             /* envia todos los campos del formulario*/
              var vData = new FormData(document.getElementById("usuarios"));
              var vurl = "../controller/usuariosController.php";
            }else{
              var vData = new FormData(document.getElementById("usuarios"));
              var vurl = "controller/usuariosController.php";
            }


            // var vData = {"accion":"ins", "pNombre":vName, "pCedula":vDoc, "pDireccion":vDir, "pTelefono":vTel, "pEmail":vEml, "pUsuario":vUser, "pPassword":vPass, "txtImg":vImg};
            $.ajax({
              data: vData,
              type: "POST",
              datatype: "json",
              url:vurl,
              contentType: false,
              processData: false,
            })
            .done(function(data){
              if (data.success){
                alert(data.message);
                document.location.href = "index.php";
              }
              else{
                alert(data.message);
                // document.getElementById("login").reset();
              }
            })
            .fail(function(data){
              alert('Se ha presentado un problema al iniciar sesión');
            });
   }
});
