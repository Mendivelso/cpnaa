// VALIDACION FORMULARIO VALIDAR ARQUITECTO
  $("#excel_upload").validate({
    rules:{
      txtImg:{
        required: true
      },
      txtDetalle:{
        required:true

      }

    },
    messages:{

      txtImg:{
        required: "Debe subir el mismo archivo"
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
                  alert(data.message + "\n Registros cargados : "+data.numRows);
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
