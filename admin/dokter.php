<?php
  //Library
  include "../connection/connect.php";
  include "../process/session_check.php";

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
              
              	  <p class="centered"><a href="profile.html"><img src="../assets/img/ui-sam.jpg" class="img-circle" width="60"></a></p>
              	  <h5 class="centered"><?php echo $_SESSION['uid']?></h5>

                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-desktop"></i>
                          <span>DATABASE</span>
                      </a>
                      <ul class="sub">
                          <li><a href="dokter.php">Dokter</a></li>
                          <li><a href="perawat.php">Perawat</a></li>
                          <li><a href="akun.php">Akun Pengguna Sistem</a></li>
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-tasks"></i>
                          <span>LAYANAN</span>
                      </a>
                      <ul class="sub"> 
                          <li><a  href="jasa.php">Daftar Jasa</a></li>
                          <li><a  href="obat.php">Daftar Obat</a></li>
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-users"></i>
                          <span>PASIEN</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="antrian.php">Antrian</a></li>
                          <li><a  href="booking.php">Booking</a></li>
                          <li><a  href="pasien.php">Data Pasien</a></li>
                      </ul>
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
          	<h2><center>Data Dokter</center></h2>
            <hr>
          	<div class="row mt">
          		<div class="col-lg-12">
          		<table class="table-bordered col-lg-12">
              <thead>
                <td>Nama</td>
                <td>Nomor Registrasi</td>
                <td>Alamat</td>
                <td>Tanggal Lahir</td>
                <td>Jenis Kelamin</td>
                <td>Nomor Telpon</td>
                <td>Email</td>
                <td>Status</td>
              </thead>
              <tbody>
                <?php
                while($dokter = $dataDokter->fetch_assoc()){
                  echo "
                    <tr>
                      <td>
                        $dokter[nama_dokter]
                      </td>
                      <td>
                        $dokter[no_reg_dokter]
                      </td>
                      <td>
                        $dokter[alamat]
                      </td>
                      <td>
                        $dokter[tanggal_lahir]
                      </td>
                      <td>
                        $dokter[jenis_kelamin]
                      </td>
                      <td>
                        $dokter[no_telp]
                      </td>
                      <td>
                        $dokter[email]
                      </td>
                      <td>
                  ";

                  if($dokter['status'] === '1'){
                    echo "Aktif";
                  } else {
                    echo "Pasif";
                  }
                  echo "
                      </td>
                      <td>
                      	<a href=\"edit_dokter.php?id_dokter=$dokter[id_dokter]\">Edit</a>
                      </td>
                      <td>
                      	<a href=\"act/hapus_dokter.php?id_dokter=$dokter[id_dokter]\">Hapus</a>
                      </td>
                    </tr>
                  ";
                }
                ?>
              </tbody>
              </table>
              <button style="float: right"><a href="add_dokter.php">Tambah</a></button>
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
