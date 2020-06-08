<?php
include("../../connect.php");
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

  <!-- Custom styles for this page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

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
            <h1 class="h3 mb-0 text-gray-800">Data Customer</h1>
          </div>

          <!-- Content Row -->
          <div class="row">

            <div class="col-lg-12 mb-4">

              <!-- Approach -->
              <div class="card shadow mb-4">
                <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Email</th>
                      <th>Username</th>
                      <th>No HP</th>
                      <th>Status Akun</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Email</th>
                      <th>Username</th>
                      <th>No HP</th>
                      <th>Status Akun</th>
                      <th>Aksi</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php
                    $getCustomer = mysqli_query($con,"select * from users_customer order by email");
                    if($countCustomer=mysqli_num_rows($getCustomer) > 0){
                      while($printData=mysqli_fetch_array($getCustomer)){
                        if($printCustomer['status'] == 0){$status="Aktiv";}else{$status="Blokir";}
                        $email=base64_encode($printData[email]);
                    echo"
                    <tr>
                      <td>$printData[email]</td>
                      <td>$printData[username]</td>
                      <td>$printData[no_hp]</td>
                      <td>$status</td>
                      <td>
                        <button class='view_data btn btn-primary btn-sm' title='Detail' data-toggle='modal' data-target='#Detail' id='$printData[email]'><i class='fas fa-eye'></i></button>
                        <a class='btn btn-primary btn-sm' title='Bekukan Akun' href='data-customer-hapus.php?email=$email'><i class='fas fa-lock'></i></a>
                        <a class='btn btn-danger btn-sm' title='Hapus Akun & Data' href='data-customer-hapus.php?email=$email' ><i class='far fa-trash-alt'></i></a>
                      </td>
                    </tr>";
                      }
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>

              </div>

            </div>
          </div>

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

<script>
  $(document).ready(function(){
    $('.view_data').click(function(){
      var id = $(this).attr("id");
      $.ajax({
        url: 'data-plat-customer.php',
        method: 'post',
        data: {id:id},
        success:function(data){
          $('#data_customer').html(data);
        }
      });
    });
  });
</script>
 <!-- The Modal of Detail -->
  <div class="modal fade" id="Detail">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Detail</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body" id="data_customer">

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
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>

</body>

</html>
<?php
mysqli_close('$con');
?>