<!DOCTYPE html>
<html>
<head>
  <title>E-PARK</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container-fluid">
  <h1>E-PARK IN</h1>
  <div class="row">
    <div class="col-sm-6" style="background-color:white;">
     <div class="card">
        <div class="card-header bg-primary">Scanner</div>
        <div class="card-body">
          <video id="preview" style="width: 100%; height:auto;"></video>
          <hr>
          <label>Scanner Reader</label>
          <form>
            <div class="form-group">
                <input type="text" id="My" class="form-control">
            </div>
          </form>
        </div>
     </div>
    </div>

    <div class="col-sm-6" style="background-color:white;">
      <div class="card">
        <div class="card-header bg-primary">Information</div>
        <div class="card-body" id="data">

        </div>
        <div class="card-footer"><h6>SLOT PARKIR TERSEDIA : <strong id="kalkulasi"></strong> </h6> </div>
    </div>
    </div>
  </div>
</div>

<script>
var refreshId = setInterval(function()
{
$('#kalkulasi').load('kalkulasi.php');
}, 1000);
</script>

    <script type="text/javascript">
      let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
      scanner.addListener('scan', function (content) {
        //alert(content);
        document.getElementById("My").value = content;

            var kode_parkir = document.getElementById("My").value;
            $.ajax({
                url:"insert.php",
                type:"POST",
                data:{
                    kode_parkir:kode_parkir
                },
                success:function(data){
                $('#data').html(data);
                 }
            });

      });
      Instascan.Camera.getCameras().then(function (cameras) {
        if (cameras.length > 0) {
          scanner.start(cameras[0]);
        } else {
          console.error('No cameras found.');
        }
      }).catch(function (e) {
        console.error(e);
      });
    </script>

</body>
</html>