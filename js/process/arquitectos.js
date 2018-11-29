function redireccionarPagina() {
  window.location = "https://www.bufa.es";
}
// VALIDACION FORMULARIO CONTACTO
    $("#arq").validate({
    rules:{
      txtName:{
        required: true
      },
      txtApe: {
        required: true
      },
      txtCed:{
        required: true,
        number:true,
        minlength:7
      },
      txtEmail:{
        required:true,
        email:true
      },
      txtTel:{
        required:true,
        number:true,
        minlength:7,
        maxlength:20
      },
      txtPro:{
        required:true
      },
      txtEmp:{
        required:true
      }


    },
    messages:{

        txtName:{
            required: "Debe escribir su Nombre"
        },
        txtApe: {
           required: "Escribe un apellido"
        },
        txtCed:{
           required: "Escriba número de cédula",
           number: "Solo números",
           minlength: "Escribe mínimo 7 numeros"
        },
        txtEmail:{
          required: "Debe escribir su E-mail",
          email: "Su e-mail es incorrecto"
        },

      txtTel:{
        required:"Este escribir su Teléfono",
        number:"Ingrese solo números",
        minlength: "Ingrese minimo 7 números",
        maxlength: "Debe escribir Máximo 20 números"

      },
      txtPro:{
        required: "Seleccione"
      },
      txtEmp:{
        required: "Seleccione"
      }



     },

  submitHandler: function(form){
            var urlc = "";
            var vNom = $('#txtName').val();
            var vApe = $('#txtApe').val();
            var vCed = $('#txtCed').val();
            var vEml = $('#txtEmail').val();
            var vTel  = $('#txtTel').val();
            var vPro  = $('#txtPro').val();
            var vEmp  = $('#txtEmp').val();


            var vData = {"accion":"ins", "txtName":vNom, "txtApe":vApe, "txtCed":vCed, "txtEmail":vEml, "txtTel":vTel, "txtPro":vPro, "txtEmp":vEmp}

              $.ajax({
                data: vData,
                type: "POST",
                datatype: "json",
                url: "../controller/arquitectosController.php",
               })
              .done(function(data){
                if (data.success)
                {
                  document.getElementById("arq").reset();
                  alert(data.message);

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