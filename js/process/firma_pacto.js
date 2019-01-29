// VALIDACION FORMULARIO NUEVO USUARIO
    $("#from_pacto").validate({
    rules:{

      txtRazon:{
          required: true
      },
      txtNit:{
          required: true
      },
      txtPag:{
          required: true
      },
      txtTel:{
          required: true
      },
      txtRep:{
          required: true
      },
      txtCed:{
        required: true,
        number:true
      },
      txtTelR:{
        required: true,
        number:true
      },
      txtEmailR:{
          required: true,
          email:true
      },
      txtRes:{
          required: true
      },
      txtCedR:{
        required:true,
        number:true
      },
      txtTelRes:{
        required:true,
        number: true
      },
      txtEmailres:{
        required:true,
        email:true
      },
      txtTer:{
        required:true
      }
    },
    messages:{


      txtRazon:{
          required: "Debe escribir su Razón Social"
      },
      txtNit:{
          required: "Debe escribir su Nit"
      },
      txtPag:{
          required: "Debe escribir su Página Web"
      },
      txtTel:{
          required: "Debe escribir su teléfono"
      },
      txtRep:{
          required: "Escribe el nombre del representante"
        },
      txtCed:{
        required: "Escribe el número de cédula",
        number: "Escribe solo números"
      },
      txtTelR:{
        required: "Teléfono de contacto",
        number: "Escribe solo números"
      },
      txtEmailR:{
          required: "Debe escribir su E-mail",
          email: "E-mial Incorrecto"
      },
      txtRes:{
          required: "Genere un Usuario"
      },
      txtCedR:{
        required: "Escribe el número de documento",
        number: "Escribe solo números"
      },
      txtTelRes:{
        required:"Escribe Teléfono de contacto",
        number: "Escribe solo números"
      },
      txtEmailres:{
        required:"Escribe un Email valido",
        email:"Email NO es valido"
      },
      txtTer:{
        required: "Debes aceptar términos y condiciones"
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

            if (vId > 0) {
             /* envia todos los campos del formulario*/
              var vData = new FormData(document.getElementById("from_pacto"));
            }else{
              var vData = new FormData(document.getElementById("from_pacto"));
            }


            // var vData = {"accion":"ins", "pNombre":vName, "pCedula":vDoc, "pDireccion":vDir, "pTelefono":vTel, "pEmail":vEml, "pUsuario":vUser, "pPassword":vPass, "txtImg":vImg};
            $.ajax({
              data: vData,
              type: "POST",
              datatype: "json",
              url:"../controller/firmantesController.php",
              contentType: false,
              processData: false,
            })
            .done(function(data){
              if (data.success){
                alert(data.message);
                document.location.href = "../usuario/";
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
    /*                CARGAR INFORMACION FIRMANTE                  */
    /***************************************************************/

    function openFirmante(Id){

      /* Realiza conexión con el servidor */
      var vId = Id;
      if(vId != 0){
        $.ajax({
          data: {"accion":"single", "pId":vId},
          type: "POST",
          datatype: "json",
          url: "../../controller/firmantesController.php",
        })

        .done(function(data){
          if (data.success) {
           $('#name').text(data.Razon_social);
           $('#ape').text(data.Nit);
           $('#pag').text(data.Pagina_web);
           $('#tel1').text(data.Telefono_emp);

           $('#Nrl').text(data.Nombre_Repre);
           $('#Crl').text(data.Cedula_Repre);
           $('#Trl').text(data.Telefono_Repre);
           $('#Erl').text(data.Email_Repre);

           $('#Nr').text(data.Responsable_pacto);
           $('#Cr').text(data.Cedula_Res);
           $('#Tr').text(data.Telefono_Res);
           $('#Er').text(data.Email_Res);


           $('#date').text(data.Created_date);
            $("#verFirmante").modal({keyboard: true});
          }

        })
        .fail(function(){
            alert("Ha ocurrido un problema");
        });
      }
    }