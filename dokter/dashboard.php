<?php
  //Library
  include "../connection/connect.php";
  include "../process/session_check.php";
  include "headside.php";

  //Ambil data
  $userData = GetData($conn, SelectTarget($_SESSION['tgt']));
  $dataDokter = $conn->query("SELECT * FROM dokter");
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
    <link href="../assets/font-awesome/css/font-awesome.css" rel="stylesheet" >
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
    <!--MAIN CONTENT START-->
    <section id="main-content">
        <section class="wrapper">
         
            <div class="row mtbox">
                  <!--BOX DOKTER-->
                  <a href="dokter.php"> 
                  <div class="col-md-2 col-sm-2 col-md-offset-1 box0">
                    <div class="box1">
                      <span class="li_heart"></span>
                      <h3>DOKTER</h3>
                    </div>
                  <p>Data Dokter Riona Dental Care</p>
                  </div></a>

                  <!--BOX PERAWAT-->
                  <a href="perawat.php"> 
                  <div class="col-md-2 col-sm-2 box0">
                    <div class="box1">
                      <span class="li_heart"></span>
                      <h3>PERAWAT</h3>
                    </div>
                  <p>Data Perawat Riona Dental Care</p>
                  </div></a>

                  <!--BOX PASIEN-->
                  <a href="pasien.php"> 
                  <div class="col-md-2 col-sm-2 box0">
                    <div class="box1">
                      <span class="li_heart"></span>
                      <h3>PASIEN</h3>
                    </div>
                  <p>Data Pasien Riona Dental Care</p>
                  </div></a>

                  <!--BOX OBAT-->
                  <a href="obat.php"> 
                  <div class="col-md-2 col-sm-2 box0">
                    <div class="box1">
                      <span class="li_heart"></span>
                      <h3>OBAT</h3>
                    </div>
                  <p>Daftar Obat Riona Dental Care</p>
                  </div></a>

                  <!--BOX TERAPI-->
                  <a href="terapi.php"> 
                  <div class="col-md-2 col-sm-2 box0">
                    <div class="box1">
                      <span class="li_heart"></span>
                      <h3>TERAPI</h3>
                    </div>
                  <p>Jenis Terapi Riona Dental Care</p>
                  </div></a>
          </div><!-- /row mt -->
          <center>
          <div class="row mt">
          <div class="col-lg-12">
            <div class="row">
            <!--panel antrian-->
              <div class="col-lg-4 col-md-4 col-sm-4 mb">
              <div class="content-panel pn">
                <div id="profile-01">
                  <h1>ANTRIAN</h1>
                </div>
                <div class="profile-01 centered">
                  <a href="antrian_hari_ini.php"><p>ANTRIAN HARI INI</p></a>
                </div>
                <div class="profile-01 centered">
                  <a href="antrian_semua.php"><p>ANTRIAN KESELURUHAN</p></a>
                </div>
              </div><!--/content-panel -->
            </div><!--/col-md-4 -->

            <a href="booking.php">
            <div class="col-md-4 col-sm-4 mb">
              <div class="weather pn">
                <i class="fa fa-cloud fa-4x"></i>
                <h1>BOOKING</h1>
              </div>
            </div>
          </a>

         </div>
       </div>
     </div></center>
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
