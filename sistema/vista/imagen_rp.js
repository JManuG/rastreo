function solicitar_imagen(barra){
  document.getElementById('carga').classList.remove('ocultar');
  $("#imagen").html('');
  var dtorigen = {'barra':barra};
  $.ajax({
    data: dtorigen,
    url:'vista/img_reporte.php',
    type:'post',
    success:function (response){
      var img = JSON.parse(response);

      if(img.codigo==200){ //codigo satisfactorio//
        document.getElementById('carga').classList.add('ocultar');
        $("#imagen").html('<img src="data:image/jpeg;base64,'+img.imagen+'" style="width:150%;" >');

      }else{ //codigo de error//
        document.getElementById('carga').classList.add('ocultar');
        $("#imagen").html('<div class="alert alert-danger" role="alert">' + img.imagen + '</div>');
      }
    }

  });
}
