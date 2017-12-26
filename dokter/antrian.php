<?php
  //Library
  include "../connection/connect.php";
  include "../process/session_check.php";

  //Ambil data
  $userData = GetData($conn, SelectTarget($_SESSION['tgt']));
  $dataAntrian = $conn->query("SELECT antrian.id_antrian as id_antrian, pasien.nama_pasien as nama_pasien, antrian.tanggal as tanggal, antrian.status as status, antrian.jam_daftar as jam_daftar, antrian.jam_layan as jam_layan, antrian.jam_selesai as jam_selesai, dokter.nama_dokter as nama_dokter, antrian.status_pasien as status_pasien FROM antrian, dokter, pasien WHERE antrian.id_pasien = pasien.id_pasien AND antrian.id_dokter = dokter.id_dokter AND antrian.tanggal = '" . date("Y-m-d") . "'");
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
      <header class="header blue-bg">
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>
            <!--logo start-->
            <a href="index.php" class="logo"><b>Sistem Informasi Klinik Gigi</b></a>
            <!--logo end-->
            
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
              
              	  <p class="centered"><a href="profile.html"><img src="../assets/img/ui-sam.jpg" class="img-circle" width="60"></a></p>
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
                          <i class="fa fa-sign-out"></i>
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
            <center>
          	<h2>Daftar Antrian</h2>
            <h4><?php echo date("l - d/M/Y")?><h4>
            </center>
            <hr>
          	<div class="row mt">
          		<div class="col-lg-12">
          		<table class="table table-striped table-advance table-hover col-lg-12">
              <thead>
                <td>Nama Lengkap</td>
                <td>Nomor Rekam Medis</td>
                <td>Status Layanan</td>
                <td>Jam Daftar</td>
                <td>Jam Layan</td>
                <td>Dokter</td>
                <td>Status Pasien</td>
              </thead>
              <tbody>
                <?php
                while($antrian = $dataAntrian->fetch_assoc()){
                  echo "
                    <tr>
                      <td>
                        <a href=\"diagnosa.php?no_rek_med=$antrian[no_rekam_medis]\">$antrian[nama_pasien]</a>
                      </td>
                      <td>
                        $antrian[no_rekam_medis]
                      </td>
                      <td>
                        $antrian[status]
                      </td>
                      <td>
                        $antrian[jam_daftar]
                      </td>
                      <td>
                        $antrian[jam_layan]
                      </td>
                      <td>
                        $antrian[nama_dokter]
                      </td>
                      <td>
                      ";
                      if($antrian['status_pasien'] === '1'){
                        echo "Pasien Lama";
                      } else {
                        echo "Pasien Baru";
                      }
                      echo "
                      </td>
                    </tr>
                  ";
                }
                ?>
              </tbody>
              </table>
              
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
