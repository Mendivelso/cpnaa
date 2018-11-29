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
            var vDetalle  = $('#txtDetalle').val();

            var vData = {"accion":"upd", "txtArq":vArq, "txtStattus":vEst, "txtDetalle":vDetalle}



              $.ajax({
                data: vData,
                type: "POST",
                datatype: "json",
                url: "../../controller/hojarutaController.php",
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




    /***************************************************************/
    /*               CARGA DATOS DE USUARIO                          */
    /***************************************************************/
    function Aprovacion(cedula, stado){
      /* Realiza conexión con el servidor */
      var vId = cedula;
      var vSta = stado;

      if(vId != 0){

           $("#txtStattus option[value="+ stado +"]").attr("selected",true);
          $('#textArq').val(vId);

          $("#Modal_aprovacion").modal({keyboard: true});

      }
    }
