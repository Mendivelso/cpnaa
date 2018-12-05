// VALIDACION FORMULARIO CONTACTO
	$("#login-form").validate({
  	rules:{
  		txtUser:{
  			required: true
  		},
      txtPass:{
        required:true
      }

  	},
  	messages:{
  		txtUser:{
  			required: "Debe escribir su Usuario"
  		},
      txtPass:{
        required: "Debe escribir su Contraseña"
      }
  	 },
  submitHandler: function(form){
    var vUser = $('#txtUser').val();
    var vPass = $('#txtPass').val();
    var vId = $('#txtTab').val();
    // var vData = {"accion":"login", "txtUser":vUser, "txtPass":vPass}
    var Url = "";
    if (vId == 0) {
      var Url = " controller/accessController.php";
    }else{
      var Url = "../controller/accessController.php ";
    }


    $.ajax({
      data: {"accion":"login", "txtUser":vUser, "txtPass":vPass},
      type: "POST",
      datatype: "json",
      url:Url,
    })
    .done(function(data){
      if (data.success){
        if (data.Perfil == 1) {
          document.location.href = "../vista/home/";
        }else{

          alert(data.firma_pacto);
          if (data.firma_pacto == 1) {
            if (vId == 0) {
              document.location.href = "usuario/";
            }else{
              document.location.href = "../usuario/";
            }


          }else{
            if (vId == 0) {
              document.location.href = "firma_del_pacto/";
            }else{
              document.location.href = "../firma_del_pacto/";
            }

          }

          document.getElementById("form_zonasegura").reset();
        }
      }
      else{
        alertify.alert(data.message);
        document.getElementById("login-form").reset();
      }
    })
    .fail(function(data){
      alert('Se ha presentado un problema al iniciar sesión');
    });
   }
});



// Validación Recuperar Contraseña
  $("#remember").validate({
    rules:{
      txtEmail:{
        required: true
      },
      txtCed:{
        required: true
      }
    },
    messages:{
      txtEmail:{
        required: "Debe escribir un correo valido"
      },
      txtCed:{
        required: "Escriba su cédula"
      }
     },
  submitHandler: function(form){
    var vEmail = $('#txtEmail').val();
    var vCed = $('#txtCed').val();
    // var vData = {"accion":"login", "txtUser":vUser, "txtPass":vPass}
    $.ajax({
      data: {"accion":"rem", "txtEmail":vEmail, "txtCed":vCed},
      type: "POST",
      datatype: "json",
      url:"controller/accessController.php",
    })
    .done(function(data){
      if (data.success){
          alertify.alert(data.message);
          document.getElementById("remember").reset();
          // window.location.href = "index.php";
      }
      else{
        alertify.alert(data.message);
        document.getElementById("remember").reset();
      }
    })
    .fail(function(data){
      alert('Se ha presentado un problema al iniciar sesión');
    });
   }
});
