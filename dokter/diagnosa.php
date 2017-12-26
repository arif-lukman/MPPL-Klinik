<?php
  //Library
  include "../connection/connect.php";
  include "../process/session_check.php";

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

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

  <section id="container" >
      <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
      <!--header start-->
      <header class="header black-bg">
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>
            <!--logo start-->
            <a href="index.php" class="logo"><b>Sistem Informasi Klinik Gigi</b></a>
            <!--logo end-->
            <div class="top-menu">
            	<ul class="nav pull-right top-menu">
                    <li><a class="logout" href="../process/logout.php">Logout</a></li>
            	</ul>
            </div>
        </header>
      <!--header end-->

      <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
               <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">

              	  <p class="centered"><a href="profile.php"><img src="../assets/img/ui-sam.jpg" class="img-circle" width="60"></a></p>
              	  <h5 class="centered"><?php echo $_SESSION['uid']?></h5>

                  <li class="sub-menu">
                      <a href="profile.php" >
                          <i class="fa"></i>
                          <span>PROFILE</span>
                      </a>
                  </li>
                  <li class="sub-menu">
                      <a href="antrian.php" >
                          <i class="fa"></i>
                          <span>ANTRIAN</span>
                      </a>
                  </li>
                  <li class="sub-menu">
                      <a href="../process/logout.php" >
                          <i class="fa"></i>
                          <span>LOGOUT</span>
                      </a>
                  </li>

              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->

      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
			<div class="row mt">
				<div class="col-lg-2">
				</div>
			
				<div class="col-lg-8">
			
				<h4><center>Data Pasien</center></h4>
				
				<?php
					$norekam = $_GET["no_rek_med"];
					$sql  = "SELECT * FROM pasien WHERE no_rekam_medis='$norekam'";
					$result = mysqli_query($conn, $sql);
					
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
				
				<h4><center>Rekam Medis</center></h4>
				<?php
					
					$sql  = "SELECT * FROM transaksi WHERE no_rekam_medis='$norekam'";
					$result = mysqli_query($conn, $sql);
				?>
				
				<table class="table col-lg-12">
				<thead>
					<td>Tanggal</td>
					<td>Diagnosa</td>
					<td>Terapi</td>
					<td>Harga</td>
					<td>Dokter</td>
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
					<h3 class="mb"><center>Diagnosa Pasien</center></h3>
					<br>
					<form class="form-horizontal style-form" method="post" action = "act/diagnosa.php">

						<!--no rekam medis pasien-->
						<div class="form-group">
						<label class="col-sm-2 control-label">No Rekam Medis</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="no_rekam_medis" id="no_rekam_medis" required>
							</div>
						</div>

						<!--diagnosa dokter-->
						<div class="form-group">
							<label class="col-sm-2 control-label">Diagnosa</label>
							<div class="col-sm-10">
								<textarea class="form-control" name="diagnosa" id="diagnosa" style="max-width: 100%; min-width: 100%"></textarea required>
							</div>
						</div>

						<!--Form terapi-->
						<div class="form-inline">
							<div class="form-group">
								<label class="col-sm-3 control-label">Terapi</label>

								<!--menu drop down jenis tindakan-->
								<div class="col-sm-4">
									<select class="form-control" id="tindakan">
									<option value="">tindakan 1</option>
									</select>
								</div>
								<!-- end menu drop down jenis tindakan-->

								<!--tarif-->
								<label class="col-sm-2 control-label">Tarif</label>
								<div class="col-sm-2">
									<input type="text" class="form-control" name="tarif" id="tarif" required>
								</div>
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

						<!--menu drop down jenis tindakan-->
						<div class="form-group">
							<label class="col-sm-2 control-label">Pilih Obat</label>
							<div class="col-sm-4">
								<select class="form-control" id="tindakan">
									<option value="">tindakan 1</option>
								</select>
							</div>
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
