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
    <!--MAIN CONTENT START-->
    <section id="main-content">
        <section class="wrapper">
          <?php
        $sql  = "SELECT * FROM user_klinik, dokter WHERE user_klinik.username = '$_SESSION[uid]' and user_klinik.id_user_klinik=dokter.id_user_klinik";
        $result = mysqli_query($conn, $sql);
      ?>
          <div class="row mt">
          <div class="col-lg-12">
            <div class="row">
            <!--panel antrian-->

           <?php while($row=mysqli_fetch_assoc($result))
           echo "
            <div class=\"col-lg-4 col-md-4 col-sm-4 col-md-offset-4 mb\">
              <div class=\"white-panel pn\">
                <div class=\"white-header\">
                 <h2>PROFILE</h2>
                </div>
                <p><img src=\"assets/img/login-bgg.jpg\" class=\"img-circle\" width=\"50\"></p>
                <p class=\"medium mt\"><b>".$row['nama_dokter']."</b></p>
                  <div class=\"row\">
                    <div class=\"col-md-6\">
                      <p class=\"small mt\">".$row['alamat']."</p>
                      <p>".$row['no_telp']."</p>
                    </div>
                    
                    <div class=\"col-md-6\">
                      <p class=\"small mt\">".$row['tanggal_lahir']."</p>
                      <p>".$row['email']."</p>
                    </div>
                  </div>
              </div>
            </div><!-- /col-md-4 -->
            </div>
            ";
        ?>
                  <!--BOX PASIEN--><br><br>
                  <a href="../dokter/pasien.php"> 
                  <div class="col-md-2 col-sm-2 col-md-offset-3 box0">
                    <div class="box1">
                      <span class="fa fa-users"></span>
                      <h3>PASIEN</h3>
                    </div>
                  <p>Data Pasien Riona Dental Care</p>
                  </div></a>

                  <!--BOX ANTRIAN-->
                  <a href="antrian.php"> 
                  <div class="col-md-2 col-sm-2 box0">
                    <div class="box1">
                      <span class="fa fa-tasks"></span>
                      <h3>ANTRIAN</h3>
                    </div>
                  <p>Daftar Antrian Pasien Riona Dental Care </p>
                  </div></a>

                  <!--BOX BOOKING-->
                  <a href="booking.php"> 
                  <div class="col-md-2 col-sm-2 box0">
                    <div class="box1">
                      <span class="fa fa-bell-o"></span>
                      <h3>BOOKING</h3>
                    </div>
                  <p>Daftar Booking Pasien Riona Dental Care</p>
                  </div></a>
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
