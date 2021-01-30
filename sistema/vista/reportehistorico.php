<?php
include("historico.php");

$x1= new historico_ingresos();
if(isset($_GET['f1'])){
  $f1=$_GET['f1'];
  $f2=$_GET['f2'];
}else{
  $f1=date('Y-m-d');
  $f2=date('Y-m-d');
}

echo $f1;
$x2=$x1->reporte_h($f1,$f2);


//print_r($x2);
include ("model/model_tab.php");
$db=new model_tab();

?>

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
          <h1>Reporte de ingresos historico</h1>
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
        <div id="ok" class="alert alert-success ocultar" role="alert">
          Prosesando solicitud de arrivo(...)
        </div>

        <table id="table_id" class="table table-hover table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">

          <thead>
          <tr role="row">
            <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">
              Transaccion</th>
            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">
              Remitente</th>
            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">
              Fecha</th>
            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">
              Destinatario</th>
            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">
              Zona</th>
            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">
              Centro de Costo</th>
            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">
              Categoria</th>
            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">
              Estado</th>
            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">
              Mensajero</th>
            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">
              Arribar</th>
            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">
              Reimprecion</th>
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

              echo "<tr role='row' class='odd'>
                    <td class='dtr-control sorting_1' tabindex='0'>".$row->barra."</td>
                    <td>".$row->fecha."</td>
                    <td>".$row->remitente."</td>
                    <td>".$row->destinatario."</td>
                    <td>".$row->direccion."</td>
                     <td>".$row->centro_costo."</td>
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
            //fin validacion de estado
          }
          ?>

          </tbody>
          <tfoot>
          <tr>
            <th rowspan="1" colspan="1">Transaccion</th>
            <th rowspan="1" colspan="1">Fecha</th>
            <th rowspan="1" colspan="1">Remitente</th>
            <th rowspan="1" colspan="1">Destinatario</th>
            <th rowspan="1" colspan="1">Zona</th>
            <th rowspan="1" colspan="1">Centro de Costo</th>
            <th rowspan="1" colspan="1">Categoria</th>
            <th rowspan="1" colspan="1">Estado</th>
            <th rowspan="1" colspan="1">Mensajero</th>
            <th rowspan="1" colspan="1">Arribar</th>
            <th rowspan="1" colspan="1">Reimprecion</th>
          </tr>
          </tfoot>

        </table>

        <div class="col-md-12 text-center">
          <ul class="pagination" id="developer_page"></ul>
        </div>
      </div>

    </div>

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
