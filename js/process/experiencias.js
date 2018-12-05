  // NUEVA IMAGEN GALERIA PRINCIPAL
    $("#form_exp").validate({
    rules:{
        txtTi:{
            required: true
        },
        txtImagen:{
            required: true
        },
        txtLink:{
          required: true
        },
        txtDes:{
          required:true
        }

    },
    messages:{
        txtTi:{
            required: "Este campo es requerido"
        },
        txtImagen:{
             required: "Este campo es requerido"
        },
        txtLink:{
          required: "Este campo es requerido"
        },
        txtDes:{
          required:"Este campo es requerido"
        }

     },

  submitHandler: function(form){
            // var vSta = $('#txtStatus').val();
            // var vTitle  = $('#txtTitle').val();
            // var vImg  = $('#txtImg').val();

            var vData = new FormData(document.getElementById("form_exp"));


            $.ajax({
              data: vData,
              type: "POST",
              datatype: "json",
              url: "../controller/experienciasController.php",
              contentType: false,
              processData: false,
             })
            .done(function(data){
              if (data.success)
              {
                alert(data.message);
                document.getElementById("form_exp").reset();
                document.location.href = "index.php";
              }
            else
            {
              alert(data.message);
              //$("#txtBtn").removeAttr("disabled");
            }
          })
          .fail(function(data){
            alert('algo ha sucedido al conectar con el servidor');
          });
   }
});



  /***************************************************************/
    /*               CARGA DATOS DE USUARIO                          */
    /***************************************************************/
    function Aprovacion(Id, stado){
      /* Realiza conexión con el servidor */
      var vId = Id;
      var vSta = stado;

      if(vId != 0){

           $("#txtStattus option[value="+ vSta +"]").attr("selected",true);
          $('#textArq').val(vId);

          $("#Modal_aprovacion").modal({keyboard: true});

      }
    }



  // VALIDACION FORMULARIO VALIDAR ARQUITECTO
  $("#form_aprovacion").validate({
    rules:{
      txtStattus:{
        required: true
      },
      txtDetalle:{
        required:true

      }

    },
    messages:{

      txtStattus:{
        required: "Debe escribir su Nombre"
      },
      txtDetalle:{
        required: "Debe escribir su E-mail"

      }
     },

  submitHandler: function(form){
            var urlc = "";
            var vArq = $('#textArq').val();
            var vEst = $('#txtStattus').val();


            var vData = {"accion":"status", "txtArq":vArq, "txtStattus":vEst}



              $.ajax({
                data: vData,
                type: "POST",
                datatype: "json",
                url: "../../controller/experienciasController.php",
               })
              .done(function(data){
                if (data.success)
                {
                  alert(data.message);
                  document.getElementById("form_aprovacion").reset();
                  document.location.href = "index.php";
                }
              else
              {
                alert(data.message);
                //$("#txtBtn").removeAttr("disabled");
              }
            })
            .fail(function(data){
              alert('algo ha sucedido al conectar con el servidor');
            });


   }
});