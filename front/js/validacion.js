function redireccionarPagina() {
  window.location = "https://www.bufa.es";
}
// VALIDACION FORMULARIO CONTACTO
	$("#form_uni").validate({
  	rules:{
  		txtName:{
  			required: true
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
      txtComent:{
        required:true,
        maxlength:200
      },
      txtCar:{
       required:true
      }

  	},
  	messages:{

  		txtName:{
  			required: "Debe escribir su Nombre"
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
      txtComent:{
        required:"Este escribir su comentario",
        maxlength:"Maxímo 200 Caracteres"
      },

      txtCar:{
        required: "Debe seleccionar una carrera"
      }


  	 },

  submitHandler: function(form){
            var urlc = "";
            var vNom = $('#txtName').val();
            var vEml = $('#txtEmail').val();
            var vTel  = $('#txtTel').val();
            var vMsj  = $('#txtComent').val();
            var vCar  = $('#txtCar').val();
            var vId  = $('#txtid').val();

            var vData = {"txtName":vNom, "txtEmail":vEml, "txtTel":vTel, "txtComent":vMsj, "txtCar":vCar}

            if (vId == 1) {
              var urlc = "enviado.php";
            }else{
              var urlc = "../enviado.php";
            }

              $.ajax({
                data: vData,
                type: "POST",
                datatype: "json",
                url: urlc,
               })
              .done(function(data){
                if (data.success)
                {
                  document.getElementById("form_uni").reset();
                  alert(data.message);
                  // window.location.replace ("http://es.stackoverflow.com");
                  setTimeout("redireccionarPagina()", 5000);
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