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
        $('#destinatario').val('');
        $('#destinatario').focus();
        $('#descripcion').val('');
        $('#vineta').val('');



        $("#respuesta").html(res[1]);
      }else
      {
        $("#respuesta").html("Error form_ingreso_guia<p> "+res[0]+res[1]+"</p>");
      }
    }
  })
}

function procesarMantAgencia(cli_id,id_agencia,codigo_agencia,nombre_agencia,direccion_agencia,telefono_agencia){
  var datos_origen={
    "cli_id":cli_id,
    "id_agencia":id_agencia,
    "codigo_agencia":codigo_agencia,
    "nombre_agencia":nombre_agencia,
    "direccion_agencia":direccion_agencia,
    "telefono_agencia":telefono_agencia
  };
  $.ajax({
    data:datos_origen,
    url:'../sistema/prg/mant_agencias.php',
    type: 'post',
    beforeSend: function(){
      //$("#respuesta").html("procesando");
      //$('.submitBtn').attr("disabled","disabled");
    },
    success: function (response){
      var str = response;
      var res = str.split("-");
      if(res[0]==200)
      {
        $('#respuesta').html('<span style="color:green;"><b>Agencia '+ codigo_agencia +' Ingresada Correctamente.</b></span>');
        $('#codigo_agencia').val('');
        $('#nombre_agencia').val('');
        $('#direccion_agencia').val('');
        $('#telefono_agencia').val('');
      }else
      {
        $("#respuesta").html('<span style="color:red;">Error form_mant_agencias<p> '+res[0]+res[1]+'</span></p>');
        //$('.submitBtn').removeAttr("disabled");
      }
    }
  })    
}

function procesarMantAgencia2(){
  var reg = /^[A-Z0-9._%+-]+@([A-Z0-9-]+.)+[A-Z]{2,4}$/i;
  var name = $('#id_agencia').val();
  var email = $('#codigo_agencia').val();
  var message = $('#nombre_agencia').val();
  var message = $('#direccion_agencia').val();
  var message = $('#telefono_agencia').val();

  if(name.trim() == '' ){
      alert('Please enter your name.');
      $('#id_agencia').focus();
      return false;
  }else if(email.trim() == '' ){
      alert('Please enter your email.');
      $('#codigo_agencia').focus();
      return false;
  }else if(email.trim() != '' && !reg.test(email)){
      alert('Please enter valid email.');
      $('#nombre_agencia').focus();
      return false;
  }else if(message.trim() == '' ){
      alert('Please enter your message.');
      $('#telefono_agencia').focus();
      return false;
  }else{
      $.ajax({
          type:'POST',
          url:'../sistema/prg/ingreso_guia.php',
          data:'contactFrmSubmit=1&name='+name+'&email='+email+'&message='+message,
          beforeSend: function () {
              $('.submitBtn').attr("disabled","disabled");
              $('.modal-body').css('opacity', '.5');
          },
          success:function(msg){
              if(msg == 'ok'){
                  $('#codigo_agencia').val('');
                  $('#nombre_agencia').val('');
                  $('#direccion_agencia').val('');
                  $('.respuesta').html('<span style="color:green;">Thanks for contacting us, well get back to you soon.</p>');
              }else{
                  $('.respuesta').html('<span style="color:red;">Some problem occurred, please try again.</span>');
              }
              $('.submitBtn').removeAttr("disabled");
              $('.modal-body').css('opacity', '');
          }
      });
  }

}
