// NUEVA IMAGEN GALERIA PRINCIPAL
    $("#Form_Act").validate({
    rules:{
        txtTipo:{
            required: true
        },
        txtImg:{
            //required: true
        },
        txtTitle:{
          required: true
        },
        txtDes:{
          required:true
        },
        txtDate:{
          required:true
        }

    },
    messages:{
        txtTipo:{
            required: "Este campo es requerido"
        },
        txtImg:{
            //  required: "Este campo es requerido"
        },
        txtTitle:{
          required: "Este campo es requerido"
        },
        txtDes:{
          required:"Este campo es requerido"
        },
        txtDate:{
          required: "Ingrese una fecha"
        }

     },

  submitHandler: function(form){
            // var vSta = $('#txtStatus').val();
            // var vTitle  = $('#txtTitle').val();
            // var vImg  = $('#txtImg').val();
             var vId  = $('#txtId').val();

            if (vId > 0) {
             /* envia todos los campos del formulario*/
              var vData = new FormData(document.getElementById("Form_Act"));
            }else{
              var vData = new FormData(document.getElementById("Form_Act"));
            }

            $.ajax({
              data: vData,
              type: "POST",
              datatype: "json",
              url: "../../controller/eventosController.php",
              contentType: false,
              processData: false,
             })
            .done(function(data){
              if (data.success)
              {
                alert(data.message);
                document.getElementById("Form_Act").reset();
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
    /*                Actualizar servicios                  */
    /***************************************************************/

    function openAct(Id){

      /* Realiza conexión con el servidor */
      var vId = Id
      if(vId != 0){
        $.ajax({
          data: {"accion":"single", "pId":vId},
          type: "POST",
          datatype: "json",
          url: "../../controller/eventosController.php",
        })


        .done(function(data){
          if (data.success) {
            $("#txtStatus option[value="+ data.Status +"]").attr("selected",true);
             $('#txtTitle').val(data.Titulo);
             $('#txtDes').val(data.Descripcion);
             $('#txtLink').val(data.Enlace);
             $('#txtDate').val(data.Fecha);
             $('#txtId').val(data.Id);
            $("#linkImg").empty();
            $("#linkImg").append('<img src="../../'+data.Imagen_principal+'"  width="140px">');
            $("#upd").empty();
            $("#upd").append('<input type="hidden" id="img" name="accion" class="form-control" value="upd">');
            $("#New_Act").modal({keyboard: true});
          }

        })
        .fail(function(){
            alert("Ha ocurrido un problema");
        });
      }
    }

    /***************************************************************/
    /*                 Elimina servicio                    */
    /**************************************************************/
    function DelAct(Id){
      /* Realiza conexión con el servidor */
      var vId = Id;

      if (!confirm("Esta seguro de ElIMINAR éste registro?")) {
        return;
      };
      if(vId != 0){
        $.ajax({
          data: {"accion":"del", "pId":vId},
          type: "POST",
          datatype: "json",
          url: "../../controller/eventosController.php",
        })

        .done(function(data){
            alert(data.message);
            document.location.href = "index.php";
        })

        .fail(function(){
            alert("Ha ocurrido un problema");
        });
      }
    }