<?php
include("usr_mante_proc.php");
$x1 = new usuarios();

$data_gps=$x1->get_GPS();

?>

<style type="text/css">
  .ocultar{
    display: none;

  }

  .mostrar{
    display:block;
  }
</style>';

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Reporte de usuarios</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#"></a></li>
            <li class="breadcrumb-item active"></li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->



    <br>



    <div class="row"><div class="col-sm-12">
        <div id="ok" class="alert alert-success" role="alert">
          <div class="text-center">
            <div class="spinner-border" role="status">
              <span class="sr-only">Loading...</span>
            </div>
            Cargando informacion...
          </div>
        </div>

        <table id="example" class="table table-hover table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">
          <thead>
            <tr role="row">
              <td>N°                  </td>
              <td>Nombre              </td>
              <td>Telefono            </td>
              <td>Fecha               </td>
              <td>Hora                </td>
              <td>Posicion            </td>
            </tr>
          </thead>
          <tbody>

              <?php

                $cn=0;
                foreach($data_gps as $row){
                  
                  $cn++;
                  echo '<tr><td>'.$cn             .'</td>
                            <td>'.$row['nombre']  .'</td>
                            <td>'.$row['telefono']  .'</td>
                            <td>'.$row['fecha']  .'</td>
                            
                            <td>'.$row['tiempo'] .'</td>
                            <td><a href="https://www.google.com/maps/place/'.$row['latitude'].','.$row['longitude'].'" target="_blank">
                            <i class="fas fa-map-marker-alt mr-1"></i>
                        </a></td></tr>';

                }


              ?>

          </tbody>
          <tfoot>
            <tr>
              <td>N°                  </td>
              <td>Nombre              </td>
              <td>Telefono            </td>
              <td>Fecha               </td>
              <td>Hora                </td>
              <td>Posicion            </td>
              
            </tr>
          </tfoot>

        </table>


      </div>

    </div>

    <script src="vista/plugins/jquery/jquery.min.js"></script>

    <script src="vista/DataTables/datatables.min.js"></script>



    <!--buttons for exporting to excel, html5 and flash-->

    <script src="vista/DataTables/Buttons-1.6.5/js/dataTables.buttons.min.js"></script>
    <script src="DataTables/JSZip-2.5.0/jszip.min.js"></script>
    <script src="DataTables/pdfmake-0.1.36/pdfmake.min.js"></script>
    <script src="DataTables/Buttons-1.6.5/js/buttons.bootstrap4.min.js"></script>
    <script src="DataTables/Buttons-1.6.5/js/buttons.colVis.min.js"></script>
    <script src="DataTables/Buttons-1.6.5/js/buttons.html5.min.js"></script>
    <script src="DataTables/Scroller-2.0.3/js/dataTables.scroller.min.js"></script>



    <!--script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script-->


    <script>

      $(document).ready(function() {
        $('#example').DataTable( {
          //traduccion de la libreria al español
          language: {
            "decimal": "",
            "emptyTable": "No hay información",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
            "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
            "infoFiltered": "(Filtrado de _MAX_ total entradas)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ Entradas",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "Sin resultados encontrados",
            "paginate": {
              "first": "Primero",
              "last": "Ultimo",
              "next": "Siguiente",
              "previous": "Anterior"
            }
          },
          //funcion para poder selecionar el estado de forma dinamica.
         /* initComplete: function () {
            this.api().columns(4).every( function () {
              var column = this;
              var select = $('<select><option value="">perfil</option></select>')
                .appendTo( $(column.header()).empty() )
                .on( 'change', function () {
                  var val = $.fn.dataTable.util.escapeRegex(
                    $(this).val()
                  );

                  column
                    .search( val ? '^'+val+'$' : '', true, false )
                    .draw();
                } );

              column.data().unique().sort().each( function ( d, j ) {
                select.append( '<option value="'+d+'">'+d+'</option>' )
              } );
            } );
          },*/

          //funcion par alos botones de exportacion...
          //responsive: "true",
          //"scrollX": true,
          //"scrollY": 400,
          "order": [[ 0, "desc" ]],
          dom: 'Bfrtilp',
          buttons:[
            {
              extend    :   'excelHtml5',
              text      :   '<i class="fas fa-file-excel fa-2x"></i>',
              titleAttrs:   'Exportar a Excel',
              className :   'btn btn-success'
            },
          ] /**/

        } );
      } );
    </script>

<?php

echo '<script>
                          $(function() {
                            document.getElementById("ok").classList.add("ocultar");
                            console.log("entra")
                          });
                      </script>';

?>
