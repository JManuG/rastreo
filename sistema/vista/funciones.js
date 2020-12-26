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

function procesarMantAgencia(cli_id,id_agencia,codigo_agencia,nombre_agencia,direccion_agencia,telefono_agencia)
{
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
          $('#respuesta').html('<span style="color:green;"><b>Agencia <b>'+ codigo_agencia +'</b> Ingresada Correctamente.</b></span>');
          $('#codigo_agencia').val('');
          $('#nombre_agencia').val('');
          $('#direccion_agencia').val('');
          $('#telefono_agencia').val('');
          $('#id_agencia').prop('selectedIndex', 0);
        }else
        {
          $("#respuesta").html('<span style="color:red;"><b>Error form_mant_agencias:</b>  <p> '+res[0]+res[1]+'</span></p>');
          //$('.submitBtn').removeAttr("disabled");
        }
      }
    })
}

function procesarMantCCosto(id_ccosto,cli_id,id_agencia,codigo_ccosto,nombre_ccosto,direccion_ccosto,telefono_ccosto)
{
  var datos_origen={
    "id_ccosto":id_ccosto,
    "cli_id":cli_id,
    "id_agencia":id_agencia,
    "codigo_ccosto":codigo_ccosto,
    "nombre_ccosto":nombre_ccosto,
    "direccion_ccosto":direccion_ccosto,
    "telefono_ccosto":telefono_ccosto
  };
  $.ajax({
    data:datos_origen,
    url:'../sistema/prg/mant_ccosto.php',
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
        $('#respuesta').html('<span style="color:green;"><b>Centro de Costo <b>'+ codigo_ccosto +'</b> Ingresado Correctamente.</b></span>');
        $('#codigo_ccosto').val('');
        $('#nombre_ccosto').val('');
        $('#direccion_ccosto').val('');
        $('#telefono_ccosto').val('');
        $('#id_agencia').prop('selectedIndex', 0);
        $('#id_ccosto').prop('selectedIndex', 0);
        
      }else
      {
        $("#respuesta").html('<span style="color:red;"><b>Error form_mant_ccostos:</b>  <p> '+res[0]+res[1]+'</span></p>');
        //$('.submitBtn').removeAttr("disabled");
      }
    }
  })
}

function changeAgencia()
{
  var id_agencia = $("#id_agencia").val();

  $.ajax({
    type: "POST",
    data: {id_agencia:id_agencia},
    url: "../sistema/prg/selects/changeAgencia.php",
    cache: false,
    success: function (response){
      //alert(response);return false;
      var str = response;
      var res = str.split("-");
      if(res[0]==200)
      {
        $('#codigo_agencia').val(res[3]);
        $('#nombre_agencia').val(res[4]);
        $('#direccion_agencia').val(res[5]);
        $('#telefono_agencia').val(res[6]);
      }
      //$("#nombre_agencia").val(response);
    }
  });
}

function changeCCosto()
{
  var id_ccosto = $("#id_ccosto").val();

  $.ajax({
    type: "POST",
    data: {id_ccosto:id_ccosto},
    url: "../sistema/prg/selects/changeCCosto.php",
    cache: false,
    success: function (response){
      //alert(response);return false;
      var str = response;
      var res = str.split("+");
      if(res[0]==200)
      { 
        $('#codigo_ccosto').val(res[4]);
        $('#nombre_ccosto').val(res[5]);
        $('#direccion_ccosto').val(res[6]);
        $('#telefono_ccosto').val(res[7]);
      }
      //$("#nombre_agencia").val(response);
    }
  });
}