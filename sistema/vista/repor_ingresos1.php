<?php
include("reporte_ingresos.php");

$x1= new model_con();

$x2=$x1->reporte_n();

//print_r($x2);

?>

<link rel="stylesheet" href="vista/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="vista/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="vista/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.js">
</script>

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



    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4"><div class="row"><div class="col-sm-12 col-md-6">
          <div class="dt-buttons btn-group flex-wrap">
            <button class="btn btn-secondary buttons-copy buttons-html5" tabindex="0" aria-controls="example1" type="button">
              <span>Copy</span>
            </button> <button class="btn btn-secondary buttons-csv buttons-html5" tabindex="0" aria-controls="example1" type="button">
              <span>CSV</span>
            </button> <button class="btn btn-secondary buttons-excel buttons-html5" tabindex="0" aria-controls="example1" type="button">
              <span>Excel</span>
            </button> <button class="btn btn-secondary buttons-pdf buttons-html5" tabindex="0" aria-controls="example1" type="button">
              <span>PDF</span>
            </button> <button class="btn btn-secondary buttons-print" tabindex="0" aria-controls="example1" type="button">
              <span>Print</span>
            </button><div class="btn-group"><button class="btn btn-secondary buttons-collection dropdown-toggle buttons-colvis" tabindex="0" aria-controls="example1" type="button" aria-haspopup="true" aria-expanded="false">
                <span>Column visibility</span>
              </button>
            </div>
          </div>
        </div>
        <div class="col-sm-12 col-md-6"><div id="example1_filter" class="dataTables_filter">
            <label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="example1"></label>
          </div>
        </div>
      </div>
      <div class="row"><div class="col-sm-12">

          <table id="table_id" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">

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
              <!--th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">
                Consulta</th-->
              <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">
                Reimprecion</th>
            </tr>
            </thead>
            <tbody>

            <?php
            foreach($x2 as $row){
              echo "<tr role='row' class='odd'>
                    <td class='dtr-control sorting_1' tabindex='0'>".$row->barra."</td>
                    <td>".$row->remitente."</td>
                    <td>".$row->destinatario."</td>
                    <td>".$row->direccion."</td>
                     <td>".$row->centro_costo."</td>
                    <td>".$row->categoria."</td>
                    <td>".$row->estado."</td>
                    <td>".$row->mensajero."</td>
                    <!--td>Consulta</td-->
                    <td><a href='prg/generaAcuse.php?v=$row->barra' target='_blank'>Reimpresión</a></td>

</tr>";
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
              <!--th rowspan="1" colspan="1">Consulta</th-->
              <th rowspan="1" colspan="1">Reimprecion</th>
            </tr>
            </tfoot>
          </table></div></div>
      <div class="row">
        <div class="col-sm-12 col-md-5">
          <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">
            Showing 1 to 10 of 57 entries
          </div>
        </div>
        <div class="col-sm-12 col-md-7">
          <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
            <ul class="pagination">
              <li class="paginate_button page-item previous disabled" id="example1_previous">
                <a href="#" aria-controls="example1" data-dt-idx="0" tabindex="0" class="page-link">Previous</a>
              </li>
              <li class="paginate_button page-item active">
                <a href="#" aria-controls="example1" data-dt-idx="1" tabindex="0" class="page-link">1</a>
              </li>
              <li class="paginate_button page-item ">
                <a href="#" aria-controls="example1" data-dt-idx="2" tabindex="0" class="page-link">2</a>
              </li>
              <li class="paginate_button page-item ">
                <a href="#" aria-controls="example1" data-dt-idx="3" tabindex="0" class="page-link">3</a>
              </li>
              <li class="paginate_button page-item ">
                <a href="#" aria-controls="example1" data-dt-idx="4" tabindex="0" class="page-link">4</a>
              </li>
              <li class="paginate_button page-item ">
                <a href="#" aria-controls="example1" data-dt-idx="5" tabindex="0" class="page-link">5</a>
              </li>
              <li class="paginate_button page-item ">
                <a href="#" aria-controls="example1" data-dt-idx="6" tabindex="0" class="page-link">6</a>
              </li><li class="paginate_button page-item next" id="example1_next">
                <a href="#" aria-controls="example1" data-dt-idx="7" tabindex="0" class="page-link">Next</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>



    <!-- DataTables  & Plugins -->
    <script src="vista/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="vista/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="vista/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="vista/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="vista/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="vista/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="vista/plugins/jszip/jszip.min.js"></script>
    <script src="vista/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="vista/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="vista/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="vista/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="vista/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <!-- AdminLTE App -->
    <script src="vista/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="vista/dist/js/demo.js"></script>
    <!-- Page specific script -->
    <script>
      $(function () {
        $("#example1").DataTable({
          "responsive": true, "lengthChange": false, "autoWidth": false,
          "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "responsive": true,
        });
      });
    </script>

<script>
  $(document).ready( function () {
    $('#table_id').DataTable();
  } );
</script>
