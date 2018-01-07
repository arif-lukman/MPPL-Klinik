<?php
  //Library
  include "../connection/connect.php";
  include "../process/session_check.php";
  include "headside.php";

  //Ambil data
  $userData = GetData($conn, SelectTarget($_SESSION['tgt']));
  $dataBooking = $conn->query("SELECT booking.id_booking as id_booking, booking.nama_pasien as nama_pasien, booking.tanggal as tanggal, booking.jam as jam, dokter.nama_dokter as nama_dokter, booking.status_pasien as status_pasien FROM booking, dokter WHERE booking.id_dokter = dokter.id_dokter");
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
	
	<!-- Offline JQuery -->
    <script src="../assets/js/jquery-3.2.1.min.js"></script>

    <!-- Custom styles for this template -->
    <link href="../assets/css/style.css" rel="stylesheet">
    <link href="../assets/css/style-responsive.css" rel="stylesheet">
    <link href="../assets/css/dataTables.bootstrap.min.css" rel="stylesheet">

    <script src="../assets/js/jquery-3.2.1.min.js"></script>
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
          	<h2><center>Daftar Booking</center></h2>
            <hr>
          	<div class="row mt">
          		<div class="col-lg-12">
          		<table class="table table-striped table-advance table-hover col-lg-12">
              <thead>
                <th>Nama Lengkap</th>
                <th>Tanggal</th>
                <th>Jam</th>
                <th>Dokter</th>
                <th>Status Pasien</th>
              </thead>
              <tbody>
                <?php
                while($booking = $dataBooking->fetch_assoc()){
                  echo "
                    <tr>
                      <td>
                        $booking[nama_pasien]
                      </td>
                      <td>
                        $booking[tanggal]
                      </td>
                      <td>
                        $booking[jam]
                      </td>
                      <td>
                        $booking[nama_dokter]
                      </td>
                      <td>
                      ";
                      if($booking['status_pasien'] === '1'){
                        echo "Pasien Lama";
                      } else {
                        echo "Pasien Baru";
                      }
                      echo "
                    </tr>
                  ";
                }
                ?>
              </tbody>
              </table>
          		</div>
          	</div>
			
		      </section>
      </section>
    <!--MAIN CONTENT END-->

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
