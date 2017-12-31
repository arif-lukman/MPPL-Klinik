<?php
  //Library
  include "../connection/connect.php";
  include "../process/session_check.php";
  include "headside.php";

  //Ambil data
  $userData = GetData($conn, SelectTarget($_SESSION['tgt']));
  $dataAntrian = $conn->query("SELECT antrian.id_antrian as id_antrian, pasien.nama_pasien as nama_pasien, antrian.tanggal as tanggal, antrian.status as status, antrian.jam_daftar as jam_daftar, antrian.jam_layan as jam_layan, antrian.jam_selesai as jam_selesai, dokter.nama_dokter as nama_dokter FROM antrian, dokter, pasien WHERE antrian.id_pasien = pasien.id_pasien AND antrian.id_dokter = dokter.id_dokter AND antrian.tanggal = '" . date("Y-m-d") . "'");
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
    <link href="../assets/css/dataTables.bootstrap.min.css" rel="stylesheet">

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
            <center>
          	<h2>Daftar Antrian Hari Ini</h2>
            </center>
            <hr>
          	<div class="row mt">
          		<div class="col-lg-12">
          		<table class="table table-striped table-advance table-hover col-lg-12">
              <thead>
                <th>Nama Lengkap</th>
                <th>Status Layanan</th>
                <th>Jam Daftar</th>
                <th>Jam Layan</th>
                <th>Jam Selesai</th>
                <th>Dokter</th>
              </thead>
              <tbody>
                <?php
                while($antrian = $dataAntrian->fetch_assoc()){
                  echo "
                    <tr>
                      <td>
                        $antrian[nama_pasien]
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
                      ";
                      if(is_null($antrian['jam_selesai'])){
                        echo $antrian['status'];
                      } else {
                        echo $antrian['jam_selesai'];
                      }
                      echo "
                      </td>
                      <td>
                        $antrian[nama_dokter]
                      </td>
                      <td align =\"right\">
                        <a href=\"edit_antrian.php?id_antrian=$antrian[id_antrian]\" class=\"btn btn-primary btn-xs\" role=\"button\"><i class=\"fa fa-pencil\"></i></a>
                      
                        <a href=\"act/hapus_antrian.php?id_antrian=$antrian[id_antrian]\" class=\"btn btn-danger btn-xs\" role=\"button\"><i class=\"fa fa-trash-o\"></i></a>
                      </td>
                    </tr>
                  ";
                }
                ?>
              </tbody>
              </table>
              <a href="add_antrian.php" style="float: right" class="btn btn-round btn-theme02" role="button">Tambah</a>
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
