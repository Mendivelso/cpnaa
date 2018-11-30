// NUEVA IMAGEN GALERIA PRINCIPAL
    $("#excel_upload").validate({
    rules:{
        txtTipo:{
            required: true
        },
        txtImg:{
            required: true
        },
        txtTitle:{
          required: true
        },
        txtDes:{
          required:true
        }

    },
    messages:{
        txtTipo:{
            required: "Este campo es requerido"
        },
        txtImg:{
           required: "Este campo es requerido"
        },
        txtTitle:{
          required: "Este campo es requerido"
        },
        txtDes:{
          required:"Este campo es requerido"
        }

     },

  submitHandler: function(form){

            var vId  = $('#txtId').val();
            var vData = new FormData(document.getElementById("excel_upload"));

            $.ajax({
              data: vData,
              type: "POST",
              datatype: "json",
              url: "../controller/arquitectosController.php",
              contentType: false,
              processData: false,
             })
            .done(function(data){
              if (data.success)
              {
                alert(data.message);
                document.getElementById("excel_upload").reset();
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