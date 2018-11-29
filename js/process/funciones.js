$(document).ready(function(){
    $("#carrera").change(function(){
        var value = $(this).val();
        if (value == 11) {

            $("#artes_carreras").hide("fast");
           $("#ciencias_carreras").hide("fast");
           $("#salud_carreras").hide("fast");
           $("#agro_carreras").hide("fast");
           $("#educacion_carreras").hide("fast");
           $("#educacion_carreras").hide("fast");
           $("#sociales_carreras").hide("fast");
           $("#ingenierias_carreras").hide("fast");
           $("#economicas_carreras").hide("fast");
           $("#economicas_carreras").hide("fast");
           $("#doctorados").hide("fast");
           $("#Especializaciones").hide("fast");
           $("#maestrias").hide("fast");


           $("#artes_carreras").focus();

        }


        if (value == 'Artes') {
          $("#artes_carreras").show("fast");

           $("#ciencias_carreras").hide("fast");
           $("#salud_carreras").hide("fast");
           $("#agro_carreras").hide("fast");
           $("#educacion_carreras").hide("fast");
           $("#educacion_carreras").hide("fast");
           $("#sociales_carreras").hide("fast");
           $("#ingenierias_carreras").hide("fast");
           $("#economicas_carreras").hide("fast");
           $("#economicas_carreras").hide("fast");
           $("#Especializaciones").hide("fast");
           $("#maestrias").hide("fast");


           $("#artes_carreras").focus();

        }

        if (value == 'Ciencias') {

          $("#ciencias_carreras").show("fast");

          $("#artes_carreras").hide("fast");
          $("#salud_carreras").hide("fast");
          $("#agro_carreras").hide("fast");
          $("#educacion_carreras").hide("fast");
          $("#educacion_carreras").hide("fast");
          $("#sociales_carreras").hide("fast");
          $("#ingenierias_carreras").hide("fast");
          $("#economicas_carreras").hide("fast");
          $("#economicas_carreras").hide("fast");
          $("#Especializaciones").hide("fast");
          $("#maestrias").hide("fast");
          $("#artes_carreras").focus();
        }


        if (value == 'Salud') {

          $("#salud_carreras").show("fast");

          $("#artes_carreras").hide("fast");
          $("#ciencias_carreras").hide("fast");
          $("#agro_carreras").hide("fast");
          $("#educacion_carreras").hide("fast");
          $("#educacion_carreras").hide("fast");
          $("#sociales_carreras").hide("fast");
          $("#ingenierias_carreras").hide("fast");
          $("#economicas_carreras").hide("fast");
          $("#economicas_carreras").hide("fast");
          $("#Especializaciones").hide("fast");
          $("#maestrias").hide("fast");

          $("#artes_carreras").focus();
        }

        if (value == 'Ciencias Agropecuarias') {

          $("#agro_carreras").show("fast");

          $("#artes_carreras").hide("fast");
          $("#ciencias_carreras").hide("fast");
          $("#salud_carreras").hide("fast");
          $("#educacion_carreras").hide("fast");
          $("#educacion_carreras").hide("fast");
          $("#sociales_carreras").hide("fast");
          $("#ingenierias_carreras").hide("fast");
          $("#economicas_carreras").hide("fast");
          $("#economicas_carreras").hide("fast");
          $("#Especializaciones").hide("fast");
          $("#maestrias").hide("fast");



          $("#artes_carreras").focus();
        }

        if (value == 'Educación') {

          $("#educacion_carreras").show("fast");

          $("#artes_carreras").hide("fast");
          $("#ciencias_carreras").hide("fast");
          $("#salud_carreras").hide("fast");
          $("#agro_carreras").hide("fast");
          $("#sociales_carreras").hide("fast");
          $("#ingenierias_carreras").hide("fast");
          $("#economicas_carreras").hide("fast");
          $("#economicas_carreras").hide("fast");
          $("#Especializaciones").hide("fast");
          $("#maestrias").hide("fast");





          $("#artes_carreras").focus();
        }

        if (value == 'Ciencias Sociales') {

          $("#sociales_carreras").show("fast");


          $("#artes_carreras").hide("fast");
          $("#ciencias_carreras").hide("fast");
          $("#salud_carreras").hide("fast");
          $("#agro_carreras").hide("fast");
          $("#educacion_carreras").hide("fast");
          $("#ingenierias_carreras").hide("fast");
          $("#economicas_carreras").hide("fast");
          $("#economicas_carreras").hide("fast");
          $("#Especializaciones").hide("fast");
          $("#maestrias").hide("fast");





          $("#artes_carreras").focus();
        }

        if (value == 'Ingenierías') {

          $("#ingenierias_carreras").show("fast");


          $("#artes_carreras").hide("fast");
          $("#ciencias_carreras").hide("fast");
          $("#salud_carreras").hide("fast");
          $("#agro_carreras").hide("fast");
          $("#educacion_carreras").hide("fast");
          $("#sociales_carreras").hide("fast");
          $("#economicas_carreras").hide("fast");
          $("#economicas_carreras").hide("fast");
          $("#Especializaciones").hide("fast");
          $("#maestrias").hide("fast");




          $("#artes_carreras").focus();
        }

        if (value == 'Ciencias Económicas') {

          $("#economicas_carreras").show("fast");



          $("#artes_carreras").hide("fast");
          $("#ciencias_carreras").hide("fast");
          $("#salud_carreras").hide("fast");
          $("#agro_carreras").hide("fast");
          $("#educacion_carreras").hide("fast");
          $("#sociales_carreras").hide("fast");
          $("#ingenierias_carreras").hide("fast");
          $("#Especializaciones").hide("fast");
          $("#maestrias").hide("fast");




          $("#artes_carreras").focus();
        }


        if (value == 'Doctorados') {

          $("#doctorados").show("fast");


          $("#artes_carreras").hide("fast");
          $("#ciencias_carreras").hide("fast");
          $("#salud_carreras").hide("fast");
          $("#agro_carreras").hide("fast");
          $("#educacion_carreras").hide("fast");
          $("#sociales_carreras").hide("fast");
          $("#ingenierias_carreras").hide("fast");
          $("#economicas_carreras").hide("fast");
          $("#Especializaciones").hide("fast");
          $("#maestrias").hide("fast");

          $("#artes_carreras").focus();
        }

        if (value == 'Maestrías') {

          $("#maestrias").show("fast");


          $("#artes_carreras").hide("fast");
          $("#ciencias_carreras").hide("fast");
          $("#salud_carreras").hide("fast");
          $("#agro_carreras").hide("fast");
          $("#educacion_carreras").hide("fast");
          $("#sociales_carreras").hide("fast");
          $("#ingenierias_carreras").hide("fast");
          $("#economicas_carreras").hide("fast");
          $("#Especializaciones").hide("fast");
          $("#doctorados").hide("fast");

          $("#artes_carreras").focus();
        }

        if (value == 'Especializaciones') {

          $("#Especializaciones").show("fast");

          $("#artes_carreras").hide("fast");
          $("#ciencias_carreras").hide("fast");
          $("#salud_carreras").hide("fast");
          $("#agro_carreras").hide("fast");
          $("#educacion_carreras").hide("fast");
          $("#sociales_carreras").hide("fast");
          $("#ingenierias_carreras").hide("fast");
          $("#economicas_carreras").hide("fast");
          $("#doctorados").hide("fast");
          $("#maestrias").hide("fast");

          $("#artes_carreras").focus();
        }



    });
});