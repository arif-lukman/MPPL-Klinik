<?php
  //Library
  include "../connection/connect.php";
  include "../process/session_check.php";
  include "headside.php";


  //Ambil data
  $userData = GetData($conn, SelectTarget($_SESSION['tgt']));
  $dataPerawat = $conn->query("SELECT * FROM perawat");
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
        return "SELECT * FROM user_klinik WHERE username = '$_SESSION[uid]'";
        break;
      case 3:
        //Perawat
        return "SELECT * FROM user_klinik WHERE username = '$_SESSION[uid]'";
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
    <link href="../assets/font-awesome/css/font-awesome.css" rel="stylesheet" >
    <link href="../assets/icofont/css/icofont.css" rel="stylesheet" >
    <link rel="stylesheet" type="text/css" href="../assets/lineicons/style.css"> 

    <!-- Custom styles for this template -->
    <link href="../assets/css/style.css" rel="stylesheet">
    <link href="../assets/css/style-responsive.css" rel="stylesheet">
    <link href="../assets/css/dataTables.bootstrap.min.css" rel="stylesheet">

    <script src="../assets/js/jquery-3.2.1.min.js"></script>
  </head>
  <body onload="startTime()">

  <section id="container">
    <?php
      //DISPLAY HEADBAR AND SIDEBAR
      echo $headbar;
      echo $sidebar;
    ?>
    <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
          	<div class="row mt">
              <div class="col-lg-2">
              </div>
          		<div class="col-lg-8">
            		<center>
					<div class="form-panel">
						<h4 class="mb"><center>Change Password</center></h4>
						<form class="form-horizontal style-form" method="post" action = "act/gantipass.php">

							<!--- Password saat ini ---->
							<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Password Saat Ini</label>
							<div class="col-sm-10">
							<input type="password" class="form-control" name="pass" id="pass" required>
							<br>
							</div>
							</div>

							<!--- Password Baru ---->
							<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Password Baru</label>
							<div class="col-sm-10">
							<input type="password" class="form-control" name="passbaru" id="password" required>
							<br>
							</div>
							</div>

							<!--- Verifikasi Password ---->
							<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Konfirmasi Password</label>
							<div class="col-sm-10">
							<input type="password" class="form-control" name="verpass" id="cnf_pw" required>
              <span id="pw-status"></span>
							<br>
							</div>
							</div>

							<center>
                <button class="btn btn-theme" type="submit" name="submit" id="submit">Submit</button>
                <button type="button" class="btn" onclick="history.back(-1)">Cancel</button>
              </center>
							<br>
							</div>
							</div>
						</form>
					</div>
				</div>
			</section>
		</section>
      </section>
    <!--MAIN CONTENT END-->
  </section>

  <!-- Offline JQuery -->
  <script src="../assets/js/jquery-3.2.1.min.js"></script>

  <!-- Our Javascript -->
  <script src="../assets/js/ours/jam.js"></script>

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
