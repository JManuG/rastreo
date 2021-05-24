<?php
include("historico.php");

$nivel=$_SESSION['nivel'];

$nmruta=$_GET['nmr'];
$id_ruta=$_GET['id'];

$x1= new historico_ingresos();
if(isset($_GET['f1'])){
  $f1=$_GET['f1'];
  $f2=$_GET['f2'];
}else{
  $f1=date('Y-m-d');
  $f2=date('Y-m-d');
}




  $x2=$x1->ruta_detalle($id_ruta);


//print_r($x2);
include ("model/model_tab.php");
$db=new model_tab();


?>
<style>
  .btn-circle.btn-xl {
    width: 70px;
    height: 70px;
    padding: 10px 16px;
    border-radius: 35px;
    font-size: 24px;
    line-height: 1.33;
  }

  .btn-circle {
    width: 30px;
    height: 30px;
    padding: 6px 0px;
    border-radius: 15px;
    text-align: center;
    font-size: 12px;
    line-height: 1.42857;
  }
</style>
<!-- jQuery -->
<script src="vista/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="vista/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="vista/plugins/chart.js/Chart.min.js"></script>
<!-- AdminLTE App -->
<script src="vista/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<!--<script src="vista/dist/js/demo.js"></script>-->
<!-- daterange picker -->
<link rel="stylesheet" href="vista/plugins/daterangepicker/daterangepicker.css">
<!-- InputMask -->
<script src="vista/plugins/moment/moment.min.js"></script>
<script src="vista/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
<!-- date-range-picker -->
<script src="vista/plugins/daterangepicker/daterangepicker.js"></script>

<script>

  let hoy = new Date();

</script>

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
          <h1>Detalle de ruta: <?php echo $nmruta; ?> </h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#"></a></li>
            <li class="breadcrumb-item active"></li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->


    <label>Selecciona el periodo: <?php echo $f1."-".$f2?></label>
    <div class="input-group-prepend">

      <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
      <input type="text" name="daterange"  class="form-control float-right" value=document.write(hoy) + - + document.write(hoy)/>
    </div>
    <br>


    <div class="row"><div class="col-sm-12">
        <div id="load" class="alert alert-success" role="alert">
          <div class="text-center">
            <div class="spinner-border" role="status">
              <span class="sr-only">Loading...</span>
            </div>
            Cargando informacion...
          </div>
        </div>
<!-------------------------------mostrando los detalles------------------------------------->
        <table id="example" class="table table-hover table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">

          <thead>
            <tr>
              <th>N°          </th>
              <th>Punto       </th>
              <th>Hora inicio </th>
              <th>Hora Fin    </th>
              <th>Agencia     </th>
              <th>Dirección   </th>
              <th>Tipo        </th>

            </tr>
          </thead>

          <tbody>
            <?php
            $cnt=0;
                foreach ($x2 as $row){
                  $vn=$x1->vineta_ruta($row->agencia_codigo,$f1,$f2);
                  $vineta="0";
                    foreach ($vn as $v){
                      $vineta=$v->barra;
                    }
                  $cnt++;
                  echo "<tr>";
                  echo "<td><input id='boton".$cnt."' type='button' class='btn btn-success btn-circle btn-lg' value='+'></td>";
                  echo "<td>".$row->comentario."</td>";
                  echo "<td>".$row->hora_ini."</td>";
                  echo "<td>".$row->hora_fin."</td>";
                  echo "<td>".$row->agencia_nombre."</td>";
                  echo "<td>".$row->agencia_direccion."</td>";
                  echo "<td>".$row->des_periodicidad."</td>";
                  echo "</tr>";
                  echo "<tr class='prueba".$cnt."' style='display: none' ><td COLSPAN='7' > <div id='capa".$cnt."'></div> </td> </tr>";
                  echo '<script type="text/javascript">
                                $(document).ready(function(){  
                                    
                            $("#boton'.$cnt.'").click(function () {
                              
                              $("#capa'.$cnt.'").load("prg/Ruta_Movimientos.php?vineta='.$vineta.'");
                              $(".prueba'.$cnt.'").toggle("slow");
                            });
                            
                          });
                        </script>';
                }
            ?>
          </tbody>

          <tfoot>
            <tr>
              <th>N°          </th>
              <th>Punto       </th>
              <th>Hora inicio </th>
              <th>Hora Fin    </th>
              <th>Agencia     </th>
              <th>Dirección   </th>
              <th>Tipo        </th>

            </tr>
          </tfoot>
        </table>
<!--------------------------------mostrar los detalles---------------------------------------->
        <div class="col-md-12 text-center">
          <ul class="pagination" id="developer_page"></ul>
        </div>
      </div>

    </div>


        <!--------------------------------------Waning-------------------------------->
        <!-- Modal -->
        <div class="modal fade" id="myModal" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Imagen de Recolección</h4>
              </div>

              <div class="text-center ocultar text-primary" id="carga">
                <div class="spinner-border" role="status">
                  <span class="sr-only">Loading...</span>
                </div>  Cargando Imagen...

              </div>
              <div class="modal-body" id="imagen">
                <img id="myImg" alt="Entrega Efectiva" style="width:150%;" >
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>

          </div>
        </div>



        <script>

          
          function imagen(barra) {
            console.log('vista/img_reporte.php?b='+barra);
            $('#myModal').HTML="";
            $('.modal-body').load('vista/img_reporte.php?b='+barra,function () {
              $('#myModal').modal({show:true});
            });
          }
        </script>
        <!--------------------------------------Waning-------------------------------->


        <script>
          $(document).ready(function () {
            //showGraph();
          });


          $(function() {
            $('input[name="daterange"]').daterangepicker({
              opens: 'left'
            }, function(start, end) {
              redireccionar(start.format('YYYY-MM-DD'),end.format('YYYY-MM-DD'));
            });
          });
          function redireccionar(f1,f2){

            setTimeout(window.location='index.php?prc=reportehistorico&f1='+f1+'&f2='+f2,2);
          }

        </script>

        <script src="vista/plugins/daterangepicker/daterangepicker.js"></script>

        <script src="vista/plugins/jquery/jquery.min.js"></script>

        <script src="vista/DataTables/datatables.min.js"></script>

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
                this.api().columns(7).every( function () {
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
                  text      :   '<i class="fas fa-file-excel fa-x2"></i>',
                  titleAttrs:   'Exportar a Excel',
                  className :   'btn btn-success'
                },
              ]

            } );

            $('#example tbody').on('click', 'td.details-control', function () {
              var tr = $(this).closest('tr');
              var row = table.row( tr );

              if ( row.child.isShown() ) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
              }
              else {
                // Open this row
                row.child( format(row.data()) ).show();
                tr.addClass('shown');
              }
            } );
          } );

           


        </script>
        <?php

        echo '<script>
                          $(function() {
                            document.getElementById("load").classList.add("ocultar");
                            //console.log("entra")
                          });
                      </script>';

        ?>
        <script src="vista/imagen_rp.js"></script>
