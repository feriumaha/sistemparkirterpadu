<?php
include("../connect.php");
include("../check.php");
$date = date("d/M/Y");
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SPT | Dashboard</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

  <!--Jquery for ajax-->
  <script src="js/jquery.min.js"></script>

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <?php
    include("nav.php");
    ?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>


          <?php include("nav-top.php");?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Content Column -->
            <div class="col-lg-6 mb-4">

              <!-- Project Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Tambah Kendaraan</h6>
                </div>
                <div class="card-body">
                  <form id="kendaraan-form" name="form-kendaraan" onsubmit="return false;" method="post">
                    <div>
                      <label>NOPOL</label>
                      <input class="form-control" type="text" name="nopol" required="required">
                    </div>
                    <hr>
                    <div>
                      <button class="btn btn-primary" id="btn-reg" type="submit">Tambahkan</button>
                      <button class="btn btn-danger" type="reset">Reset</button>
                    </div>
                  </form>

<script type="text/javascript">

// ajax save
    $('#kendaraan-form').on('submit',function(){
      $.ajax({
        url:'qrcode/tambahkan-kendaraan.php',
        type:'post',
        data:$(this).serialize(),
        success : function (i){
          if(i != 1){
            alert(i);
          }else{
            alert('NOPOL baru berhasil ditambahkan');
          }
        }
      });
    });
</script>
                </div>
              </div>

            </div>

            <div class="col-lg-6 mb-4">

              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">NOPOL Kendaraan</h6>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>NOPOL</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody id="data">

                    </tbody>
                  </table>
                  </div>
<script>
var refreshId = setInterval(function()
{
$('#data').load('nopol-load.php');
}, 1000);
</script>
                </div>
              </div>

            </div>


            <div class="col-lg-12 mb-4">
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">History</h6>
                </div>
                <div class="card-body" >
                <div class="table-responsive">
                 <table class="table">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Tanggal</th>
                        <th>Kode Parkir</th>
                        <th>Jam Masuk</th>
                        <th>Jam Keluar</th>
                        <th>Durasi</th>
                        <th>Total</th>
                      </tr>
                    </thead>
                    <tbody id="history">

                    </tbody>
                  </table>
                </div>
                </div>
              </div>
            </div>
<script>
var refreshId = setInterval(function()
{
$('#history').load('history.php');
}, 1000);
</script>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <?php include("footer.php"); ?>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

<!-- The Modal -->
  <div class="modal fade" id="QRCODE">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">QR Code</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body" id="data_QR">

        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>

      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>
<?php
mysqli_close('$con');
?>