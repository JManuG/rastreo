function procesarformulario(ccosto_ori,ccosto_des,destinatario,descripcion,vineta){
  var datos_origen={
    "ccosto_ori":ccosto_ori,
    "ccosto_des":ccosto_des,
    "destinatario":destinatario,
    "descripcion":descripcion,
    "vineta":vineta
  };
  $.ajax({
    data:datos_origen,
    url:'../sistema/prg/ingreso_guia.php',
    type: 'post',
    beforeSend: function(){
      //$("#respuesta").html("procesando");
    },
    success: function (response){
      var str = response;
      var res = str.split("-");
      if(res[0]==200)
      {
        $("#respuesta").html(res[1]);
      }else
      {
        $("#respuesta").html("Error form_ingreso_guia<p> "+res[0]+res[1]+"</p>");
      }
    }
  })
}
