<?php
include("reporte_ingresos.php");

$x1= new model_con();

$x2=$x1->reporte_n();

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
          <h1>Reporte de ingresos</h1>
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

          <table id="table_id" class="table table-hover table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">

            <thead>
            <tr role="row">
              <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">
                Transaccion</th>
              <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">
                Remitente</th>
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
              if($row->estado=="ARRIBO" or $row->estado=="INGRESO"){
              echo "<tr role='row' class='odd'>
                    <td class='dtr-control sorting_1' tabindex='0'>".$row->barra."</td>
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
              }//fin validacion de estado
            }
            ?>

            </tbody>
            <tfoot>
            <tr>
              <th rowspan="1" colspan="1">Transaccion</th>
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
