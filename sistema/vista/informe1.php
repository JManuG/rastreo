<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <h1>Estad&iacute;stica de servicio</h1>
        </div>
        <div class="col-sm-12">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">ChartJS</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-10">
         <!-- BAR CHART -->
          <div class="card card-navy">
            <div class="card-header">
              <h3 class="card-title">Estad&iacute;stica de env&iacute;os</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <div id="chart-container">
                <canvas id="graphCanvas"></canvas>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->


        </div>
        <!-- /.col (RIGHT) -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>


<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Add Content Here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="vista/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="vista/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="vista/plugins/chart.js/Chart.min.js"></script>
<!-- AdminLTE App -->
<script src="vista/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="vista/dist/js/demo.js"></script>
<!-- Page specific script -->

  <script>
    $(document).ready(function () {
    showGraph();
  });


    function showGraph()
    {
      {
        $.post("prg/datainforme1.php",
          function (data)
          {
            console.log(data);
            var name = [];
            var marks = [];

            for (var i in data) {
              name.push(data[i].chk_descripcion);
              marks.push(data[i].cantidad);
            }

            var chartdata = {
              labels: name,
              datasets: [
                {
                  label: 'Punto de control',
                  backgroundColor: '#ee5628',
                  borderColor: '#ee5628',
                  hoverBackgroundColor: '#ce5611',
                  hoverBorderColor: '#ee5628',
                  data: marks
                }
              ]
            };

            var graphTarget = $("#graphCanvas");

            var barGraph = new Chart(graphTarget, {
              type: 'bar',
              data: chartdata
            });
          });
      }
    }
</script>

