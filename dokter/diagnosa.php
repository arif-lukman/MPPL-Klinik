<?php
  //Library
  include "../connection/connect.php";
  include "../process/session_check.php";
  include "headside.php";

  //Ambil data
  $userData = GetData($conn, SelectTarget($_SESSION['tgt']));
  //echo SelectTarget($_SESSION['tgt']);

  //Fungsi
  function SelectTarget($usrType){
    switch ($usrType) {
      case 1:
        //Admin
        return "SELECT * FROM user_klinik WHERE username = '$_SESSION[uid]'";
        break;
      case 2:
        //Dokter
        return "SELECT * FROM dokter WHERE username = '$_SESSION[uid]'";
        break;
      case 3:
        //Perawat
        return "SELECT * FROM perawat WHERE username = '$_SESSION[uid]'";
        break;
    }
  }

  function GetData($conn, $sql){
    $result = $conn -> query($sql);
    //echo $result -> num_rows;
    if($result -> num_rows > 0){
      return $result -> fetch_assoc();
    } else {
      return false;
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>Dashboard</title>

    <!-- Bootstrap core CSS -->
    <link href="../assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="../assets/font-awesome/css/font-awesome.css" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="../assets/css/style.css" rel="stylesheet">
    <link href="../assets/css/style-responsive.css" rel="stylesheet">

    <script src="../assets/js/ours/jam.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body onload="startTime()">

  <section id="container" >
      <?php
        echo $headbar;
        echo $sidebar;
      ?>
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
			<div class="row mt">
				<div class="col-lg-2">
				</div>

			 <!-- DATA PASIEN -->
				<div class="col-lg-8">
			
				<h3><center>Data Pasien</center></h3><hr>
				
				<?php
					$id_pasien = $_GET["id_pasien"];
					$sql  = "SELECT * FROM pasien WHERE id_pasien='$id_pasien'";
					$result = mysqli_query($conn, $sql);
          $no_rekam = mysqli_fetch_assoc(mysqli_query($conn, "SELECT no_rekam_medis FROM pasien WHERE id_pasien='$id_pasien'"));
				?>
				
				<table class="table table-striped">
				<?php
					while($row=mysqli_fetch_assoc($result))
						//$umur= YEAR(curdate()) - YEAR($row['tgllahir']);
						/*$lahir = new DateTime($row['tanggal_lahir']);
						$today = new DateTime();
						$umur = $today->diff($lahir);*/
						
					echo "
					<tr>
						<td> Nama </td>
						<td> : </td>
						<td> ".$row['nama_pasien']."</td>
						<td> Pekerjaan </td>
						<td> : </td>
						<td> ".$row['pekerjaan']."</td>
					</tr>
					<tr>
						<td> Alamat </td>
						<td> : </td>
						<td> ".$row['alamat']."</td>
						<td> No. Telepon </td>
						<td> : </td>
						<td> ".$row['no_telp']."</td>
					</tr>
					<tr>
						<td> Tanggal Lahir </td>
						<td> : </td>
						<td> ".$row['tanggal_lahir'] ."</td>
						<td> Jenis Kelamin </td>
						<td> : </td>
						<td> ".$row['jenis_kelamin']."</td>
					</tr>
					";
				?>
				</table>
				
				<br>
				<br>
				
        <!-- REKAM MEDIS PASIEN -->
				<h3><center>Rekam Medis No. <?php echo $no_rekam['no_rekam_medis']?></center></h3><hr>
				<?php					
					$sql  = "SELECT * FROM transaksi WHERE id_pasien='$id_pasien'";
					$result = mysqli_query($conn, $sql);
				?>
				
				<table class="table table-striped table-advance table-hover col-lg-12">
				<thead>
					<th>Tanggal</th>
					<th>Diagnosa</th>
					<th>Terapi</th>
					<th>Harga</th>
					<th>Dokter</th>
				</thead>
				<tbody>
				</table>

				<div class="container">
				<table class="table table-striped">
				
				</table>
				</div>
				
            	<center>
                  
				  <br>
				  <br>
				  
          <div class="form-panel">
					<h3 class="mb"><center>Diagnosa Pasien</center></h3><hr>
					<br>
					<form class="form-horizontal style-form" method="post" action = "act/diagnosa.php?">

						<!--diagnosa dokter-->
            <h4>Diagnosa</h4><hr>

            <h5>1 )</h5>

            <!-- DIAGNOSA BARU DIAPPEND KE SINI -->
            <div id="field-diagnosa">

              <center>
                <div class="form-group">
                  <div class="col-sm-6">
                    <label class="control-label">Kuadran 1</label>
                    <input type="text" class="form-control" name="k1d1" id="k1d1">
                  </div>
                  <div class="col-sm-6">
                    <label class="control-label">Kuadran 2</label>
                    <input type="text" class="form-control" name="k2d1" id="k2d1">
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-sm-6">
                    <label class="control-label">Kuadran 3</label>
                    <input type="text" class="form-control" name="k3d1" id="k3d1">
                  </div>
                  <div class="col-sm-6">
                    <label class="control-label">Kuadran 4</label>
                    <input type="text" class="form-control" name="k4d1" id="k4d1">
                  </div>
                </div>
              </center>

  						<div class="form-group">
  							<label class="col-sm-2 control-label">Keterangan</label>
  							<div class="col-sm-10">
  								<textarea class="form-control" name="ketd1" id="ketd1" style="max-width: 100%; min-width: 100%"></textarea required>
  							</div>
  						</div>

            </div>

            <!-- TOMBOL BUAT NAMBAH DIAGNOSA -->
            <div class="form-group col-sm-12">
              <center>
              <input type="button" class="btn" name="btn-diag" id="btn-diag" value="+">
              </center>
            </div>

						<!--Form terapi-->
            <h4>Terapi</h4><hr>
            <h5>1 )</h5>
            <div id="field-terapi">

  						<div class="form-group">
                <!-- TERAPI BARU DIAPPEND KE SINI -->
  							<label class="col-sm-2 control-label">Terapi</label>
  							<!--menu drop down jenis tindakan-->
  							<div class="col-sm-4">
  								<select class="form-control" id="tindakan">
  								<option value="">tindakan 1</option>
  								</select>
  							</div>
  							<!-- end menu drop down jenis tindakan-->

  							<!--tarif-->
  							<label class="col-sm-2 control-label">Tarif</label>
  							<div class="col-sm-4">
  								<input type="text" class="form-control" name="tarif" id="tarif" required>
  							</div>
              </div>
						
						  <!--end form terapi-->

  						<!--form keterangan-->
  						<div class="form-group">
  							<label class="col-sm-2 control-label">Keterangan</label>
  							<div class="col-sm-10">
  								<textarea class="form-control" name="keterangan" id="keterangan" style="max-width: 100%; min-width: 100%"></textarea>
  							</div>
  						</div>
  						<!-- end form keterangan-->
            </div>

            <!-- BUTTON BUAT NAMBAH TERAPI -->
            <div class="form-group col-sm-12">
              <center>
              <input type="button" class="btn" name="btn-terapi" id="btn-terapi" value="+">
              </center>
            </div>

            <!--Form obat-->
            <h4>Obat</h4><hr>
            <h5>1 )</h5>
						<!--menu drop down jenis tindakan-->
						<div class="form-group">
              <div class="col-sm-3"></div>
							<label class="col-sm-2 control-label">Pilih Obat</label>
							<div class="col-sm-4">
								<select class="form-control" id="tindakan">
									<option value="">tindakan 1</option>
								</select>
							</div>
						</div>

            <!-- BUTTON BUAT NAMBAH OBAT -->
            <div class="form-group col-sm-12">
              <center>
              <input type="button" class="btn" name="btn-obat" id="btn-obat" value="+">
              </center>
            </div>

						<center><button class="btn btn-theme" type="submit" name="submit" id="submit">Submit</button></center>
						<br>
					</form>
					</div>
				</div><!-- col-lg-12-->
            </div><!-- /row -->
              </center>
          		</div>
				
          	</div>

		      </section>
      </section><!-- /MAIN CONTENT -->

      <!--main content end-->
      <!--footer start-->
      <!--
      <footer class="site-footer">
          <div class="text-center">
              2014 - Alvarez.is
              <a href="blank.html#" class="go-top">
                  <i class="fa fa-angle-up"></i>
              </a>
          </div>
      </footer>
    -->
      <!--footer end-->
  </section>

      <!--main content end-->
      <!--footer start-->
      <!--
      <footer class="site-footer">
          <div class="text-center">
              2014 - Alvarez.is
              <a href="blank.html#" class="go-top">
                  <i class="fa fa-angle-up"></i>
              </a>
          </div>
      </footer>
    -->
      <!--footer end-->
  </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="../assets/js/jquery.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/jquery-ui-1.9.2.custom.min.js"></script>
    <script src="../assets/js/jquery.ui.touch-punch.min.js"></script>
    <script class="include" type="text/javascript" src="../assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="../assets/js/jquery.scrollTo.min.js"></script>
    <script src="../assets/js/jquery.nicescroll.js" type="text/javascript"></script>


    <!--common script for all pages-->
    <script src="../assets/js/common-scripts.js"></script>

    <!--script for this page-->

  <script>
      //custom select box

      $(function(){
          $('select.styled').customSelect();
      });

  </script>

  </body>
</html>
