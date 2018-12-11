// VALIDACION FORMULARIO NUEVO USUARIO
    $("#usu").validate({
    rules:{
      txtImg:{
         extension: "png|jpg"
      },
      txtDocu1:{
          required: true
      },
      txtName1:{
          required: true
      },
      txtDir1:{
          required: true
      },
      txtTel1:{
          required: true
      },
      txtEml1:{
          required: true,
          email:true
      },
      txtUser1:{
          required: true
      }
    },
    messages:{

      txtImg:{
         extension: "Por favor adjunta un formato .png o .jpg"
      },
      txtDoc1:{
          required: "Debe escribir su cedula"
      },
      txtName1:{
          required: "Debe escribir su nombre"
      },
      txtDir1:{
          required: "Debe escribir su dirección"
      },
      txtTel1:{
          required: "Debe escribir su teléfono"
      },
      txtEml1:{
          required: "Debe escribir su E-mail",
          email: "E-mial Incorrecto"
      },
      txtUser1:{
          required: "Genere un Usuario"
      }

     },

  submitHandler: function(form){
      var vDoc = $('#txtDocu1').val();
      var vName = $('#txtName1').val();
      var vDir = $('#txtDir1').val();
      var vTel = $('#txtTel1').val();
      var vEml = $('#txtEml1').val();
      var vUser = $('#txtUser1').val();

      var vImg = $('#txtImg').val();
      var vData = '';

             var vId  = $('#txtId').val();

            if (vId > 0) {
             /* envia todos los campos del formulario*/
              var vData = new FormData(document.getElementById("usu"));
            }else{
              var vData = new FormData(document.getElementById("usu"));
            }


            // var vData = {"accion":"ins", "pNombre":vName, "pCedula":vDoc, "pDireccion":vDir, "pTelefono":vTel, "pEmail":vEml, "pUsuario":vUser, "pPassword":vPass, "txtImg":vImg};
            $.ajax({
              data: vData,
              type: "POST",
              datatype: "json",
              url:"../controller/usuariosController.php",
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

        /***************************************************************/
        /*               CARGA DATOS DE USUARIO                          */
        /***************************************************************/
        function perfil(Id,Tab){
          /* Realiza conexión con el servidor */
          var vId = Id;
          var vTab = Tab;

          var vurl = "";
          if (vTab == 0) {
            var vurl = "../controller/usuariosController.php";
          }else{
            var vurl = "../../controller/usuariosController.php";
          }
          if(vId != 0){

            $.ajax({
              data: {"accion":"single", "pId":vId},
              type: "POST",
              datatype: "json",
              url: vurl,
            })

            .done(function(data){
              if (data.success) {
                $('#txtCed').val(data.Cedula);
                $('#txtCed1').val(data.Cedula);
                $('#txtName1').val(data.Nombre);
                $('#txtDir1').val(data.Direccion);
                $('#txtTel1').val(data.Telefono);
                $('#txtEml1').val(data.Email);
                $('#txtUser1').val(data.Usuario);
                $('#txtUser2').val(data.Usuario);
                $(".linkImg").empty();
                $(".linkImg").append('<img src="../'+data.Foto+'"  width="140px">');
                $("#upd").empty();
                $("#upd").append('<input type="hidden" id="img" name="accion" class="form-control" value="upd2">');
                $('#txtId').val(vId);
              }
            })
            .fail(function(){
                alert("Ha ocurrido un problema");
            });
          }
        }

      /***************************************************************/
      /*              CAMBIA CONTRASEÑA                    */
      /***************************************************************/

        $("#cambiaPass").validate({
        rules:{
          txtPass:{
            required: true
          },
          txtPass2:{
              required: true,
              equalTo: "#txtPass"

          }
        },
        messages:{
          txtPass:{
            required: "Debes generar una contraseña"
          },
          txtPass2:{
              required: "Debes confirmar la contraseña",
              equalTo: "Las contraseñas no coinciden"
          }
         },

      submitHandler: function(form){
          var vPass2 = $('#txtPass2').val();
          var vId = $('#txtId').val();

          // if (vId > 0) {
          //  /* envia todos los campos del formulario*/
          //   var vData = new FormData(document.getElementById("usuarios"));
          // }else{
          //   var vData = new FormData(document.getElementById("usuarios"));
          // }
           var vData = {"accion":"chg", "pPass":vPass2, "pId":vId};
          $.ajax({
            data: vData,
            type: "POST",
            datatype: "json",
            url:"../../controller/usuariosController.php",
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
