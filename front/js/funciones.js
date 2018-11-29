$(document).ready(function(){

});

  //  --------------------  Función para redireccionar     -----------------------------
  function redireccionarPagina() {
    window.location.href = "http://service.uan.edu.co/common/inscriptions/university_inscription/inscription_formHome.jsp";
  }

// VALIDACION FORMULARIO CONTACTO
  $("#form_uan").validate({
    rules:{
      txtName:{
        required: true
      },
      txtCed:{
        required: true,
        minlength:7
      },
      txtCity:{
        required: true
      },
      txtCelular:{
        required:true,
        minlength:7,
        maxlength:20
      },
      txtEmail:{
        required:true,
        email:true
      },
      txtEdad:{
        required:true
      },
      carrera:{
        required:true
      },

      txtMsj:{
        required:true,
        maxlength:300
      },
      terminos:{
        required:true
      }

    },
    messages:{

      txtName:{
        required: "Debe escribir su Nombre"
      },
      txtCed:{
        required: "Escribe tu cédula",
        minlength: "Ingrese mínimo 7 números"
      },
      txtCity:{
        required: "Seleccione una ciudad"
      },
      txtCelular:{
       required:"Este escribir su Teléfono",
       minlength: "Ingrese mínimo 7 números",
        maxlength: "Debe escribir Máximo 20 números"
      },
      txtEmail:{
        required: "Escribe su E-mail",
        email: "Tu E-mail es incorrecto"
      },
      txtEdad:{
        required:"Ingrese su edad"
      },
      carrera:{
        required: "Seleccione un idioma"
      },

      txtMsj:{
        required:"Déjanos tu comentario",
        maxlength:"Maxímo 300 Caracteres"
      },
      terminos:{
        required: "Acepta los términos | <br>"
      }


     },

  submitHandler: function(form){

          $( "#Enviar" ).prop( "disabled", true );
            var urlc = "";
            var vNom = $('#txtName').val();
            var vCed = $('#txtCed').val();
            var vCity = "Medellin";
            var vEml = $('#txtEmail').val();
            var vCel  = $('#txtCelular').val();
             var vOrigen  = $('#txtOrigen').val();
             var vEdad = $('#txtEdad').val();

             var vcarrera = "";
            var vIdioma = $('#txtIdioma').val();



            var vMsj  = $('#txtMsj').val();
            var vIdM = $('#txtId').val();


            var vData = {"accion":'ins', "txtName":vNom, "txtCed":vCed, "txtCity":vCity,
            "txtEmail":vEml, "txtCelular":vCel, "txtEdad":vEdad,
            "txtIdioma":vIdioma,
             "txtMsj":vMsj,  "txtId":vIdM}


              var urlc = "controller/contactosController.php";

              $.ajax({
                data: vData,
                type: "POST",
                datatype: "json",
                url: urlc,
               })
              .done(function(data){
                if (data.success)
                {
                  alertify.alert(data.message);
                  document.getElementById("form_uan").reset();
                   $( "#Enviar" ).prop( "disabled", false );
                   // Activamos la redirección luego de 5seg
                  // setTimeout("redireccionarPagina()", 5000);
                }
              else
              {
                alertify.alert(data.message);

                //$("#txtBtn").removeAttr("disabled");
              }
            })
            .fail(function(data){
              alert('algo ha sucedido al conectar con el servidor');
            });
   }
});