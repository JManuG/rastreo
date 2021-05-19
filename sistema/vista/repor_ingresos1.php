<?php

include("reporte_ingresos.php");

$x1= new model_con();
//109412
$nivel=$_SESSION['nivel'];

if($nivel>2){
  $x2 = $x1->reporte_n2();
}else {
  $x2 = $x1->reporte_n();
}

//print_r($x2);
include ("model/model_tab.php");
$db=new model_tab();
?>



<style type="text/css">
  .ocultar{
    display: none;

  }

  .mostrar{
    display:block;
  }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Reporte de ingresos </h1>
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
          <div id="ok" class="alert alert-success ocultar" role="alert">
            Prosesando solicitud de arrivo(...)
          </div>

          <table id="example" class="table table-hover table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">

            <thead>
            <tr role="row">
              <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">
                Transaccion</th>
              <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">
                Remitente</th>
              <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">
                Departamento</th>
              <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">
                Destinatario</th>
              <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">
                Zona</th>
              <!--th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">
                Centro de Costo</th-->
              <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">
                Categoria</th>
              <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">
                Estado</th>
              <?php
              if($nivel>2){

              }else{
              ?>
              <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">
                Mensajero</th>
              <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">
                Arribar</th>
              <?php

              }
              ?>

              <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">
                Reimpresi&oacute;n</th>
            </tr>
            </thead>
            <tbody id="developers">

            <?php
            $cn=0;
            foreach($x2 as $row){
              $cn++;
              if($row->mensajero==""){
                  $msj="<a href='index.php?prc=proc&accion=ld&br=$row->barra' target='_blank' ><i class='fas fa-people-carry fa-2x'></i></a>";
              }else{
                $msj=$row->mensajero;
              }

            if($nivel>2) {
              echo "<tr role='row' class='odd'>
                    <td class='dtr-control sorting_1' tabindex='0'>".$row->barra."</td>
                    <td>".$row->remitente."</td>
                    <td>".$row->remitente_dep."</td>
                    <td>".$row->destinatario."</td>
                    
                    <td>".$row->direccion."</td>
                     
                    <td>".$row->categoria."</td>
                    <td>".$row->estado."</td>
                    <td><a href='prg/generaAcuse.php?v=$row->barra' target='_blank'><i class='fas fa-print fa-2x'></i></a></td>

                    </tr>";

            }else{
              if($row->estado=="ARRIBO" or $row->estado=="INGRESO"){
              echo "<tr role='row' class='odd'>
                    <td class='dtr-control sorting_1' tabindex='0'>".$row->barra."</td>
                    <td>".$row->remitente."</td>
                    <td>".$row->remitente_dep."</td>
                    <td>".$row->destinatario."</td>
                    
                    <td>".$row->direccion."</td>
                     
                    <td>".$row->categoria."</td>
                    <td>".$row->estado."</td>
                    <td>".$msj


                ."</td>
                    <td>
                    <div id='ok".$cn."' class='alert alert-success ocultar' role='alert'>
                            Prosesando solicitud de arrivo(...)
                        </div>
                    <button type='button' class='btn btn-link' id='vineta' name='vineta' autocomplete='off' autofocus placeholder='vi&ntilde;eta' onclick='procesarAR(".$row->barra.");recargar(".$cn.");' >
                      <i class='fas fa-inbox fa-2x'></i></button>
                    
                    <script src='vista/funciones.js'></script>
                    <script>
                        function recargar(c){
                            $('p').show();
                            document.getElementById('ok'+c).classList.remove('ocultar');
                            setTimeout('document.location.reload()',3000);
                    }
                    </script>
                
                    </td>
                    <td><a href='prg/generaAcuse.php?v=$row->barra' target='_blank'><i class='fas fa-print fa-2x'></i></a></td>

</tr>";
              }//fin validacion de estado

              }


            }
            ?>

            </tbody>
            <tfoot>
            <tr>
              <th rowspan="1" colspan="1">Transaccion</th>
              <th rowspan="1" colspan="1">Remitente</th>
              <th rowspan="1" colspan="1">Departamento</th>
              <th rowspan="1" colspan="1">Destinatario</th>
              <th rowspan="1" colspan="1">Zona</th>
              <th rowspan="1" colspan="1">Categoria</th>
              <th rowspan="1" colspan="1">Estado</th>
              <?php
              if($nivel>2){

              }else{
              ?>
              <th rowspan="1" colspan="1">Mensajero</th>
              <th rowspan="1" colspan="1">Arribar</th>
              <?php
              }
              ?>
              <th rowspan="1" colspan="1">Reimpresi&oacute;n</th>
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
          initComplete: function () {
            this.api().columns(6).every( function () {
              var column = this;
              var select = $('<select><option value="">Estado</option></select>')
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
          },

          //funcion par alos botones de exportacion...
          responsive: "true",
          "scrollX": true,
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


