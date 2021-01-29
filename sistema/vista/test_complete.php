<script type="text/javascript" src="../lib/jquery.js"></script>
<script type="text/javascript" src="../lib/jquery.ui.js"></script>
<link rel="stylesheet" href="../lib/jquery.ui.css">

<script>


  $( function() {

    // Single Select
    $( "#destinatario" ).autocomplete({
      source: function( request, response ) {
        // Fetch data
        $.ajax({
          url: "../destinatario.php",
          type: 'post',
          dataType: "json",
          data: {
            search: request.term
          },
          success: function( data ) {
            response( data );
          }
        });
      },
      select: function (event, ui) {
        // Set selection
        $('#destinatario').val(ui.item.label); // display the selected text
        $('#cod_destinatario').val(ui.item.value); // save selected id to input
        return false;
      }
    });
  });
  function split( val ) {
    return val.split( /,\s*/ );
  }
  function extractLast( term ) {
    return split( term ).pop();
  }
</script>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Ingreso de Env&iacute;os</h1>
          <table>
            <tr>
             <td>Single selection</td>
             <td><input type='text' id='destinatario' ></td>
            </tr>

            <tr>
              <td>Selected User id</td>
              <td><input type='text' id='cod_destinatario' /></td>
            </tr>

          </table>

        </div>
        </div>
      </div>
    </div>
  </section>
</div>
</div>


<!--<table>-->
<!--  <tr>-->
<!--    <td>Single selection</td>-->
<!--    <td><input type='text' id='destinatario' ></td>-->
<!--  </tr>-->
<!---->
<!--  <tr>-->
<!--    <td>Selected User id</td>-->
<!--    <td><input type='text' id='cod_destinatario' /></td>-->
<!--  </tr>-->
<!---->
<!--</table>-->
