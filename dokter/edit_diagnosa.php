<?php
  //Library
  include "../connection/connect.php";
  include "../process/session_check.php";
  include "headside.php";

  //Ambil data
  $userData = GetData($conn, "SELECT * FROM user_klinik WHERE username = '$_SESSION[uid]'");
  $diagnosa = GetData($conn, "SELECT * FROM detail_diagnosa WHERE id_detail_diagnosa = '$_GET[id_diagnosa]'");

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
        
        <div class="form-panel">
          <form class="form-horizontal style-form" method="post" action = "act/edit_diagnosa.php">
            <!--diagnosa dokter-->
              <h4>Pengubahan Data Diagnosa</h4><hr>                

              <center>
                <div class="form-group">
                  <div class="col-sm-6">
                    <label class="control-label">Kuadran 1</label>
                    <input type="text" class="form-control" name="k1d1" id="k1d1" <?php echo "value=\"$diagnosa[k1]\""; ?> autocomplete="off">
                  </div>
                  <div class="col-sm-6">
                    <label class="control-label">Kuadran 2</label>
                    <input type="text" class="form-control" name="k2d1" id="k2d1" <?php echo "value=\"$diagnosa[k2]\""; ?> autocomplete="off">
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-sm-6">
                    <label class="control-label">Kuadran 3</label>
                    <input type="text" class="form-control" name="k3d1" id="k3d1" <?php echo "value=\"$diagnosa[k3]\""; ?> autocomplete="off">
                  </div>
                  <div class="col-sm-6">
                    <label class="control-label">Kuadran 4</label>
                    <input type="text" class="form-control" name="k4d1" id="k4d1" <?php echo "value=\"$diagnosa[k4]\""; ?> autocomplete="off">
                  </div>
                </div>
              </center>

              <div class="form-group">
                <label class="col-sm-2 control-label">Keterangan</label>
                <div class="col-sm-10">
                  <textarea class="form-control" name="ketd1" id="ketd1" style="max-width: 100%; min-width: 100%" required autocomplete="off"><?php echo "$diagnosa[diagnosa]"; ?></textarea>
                </div>
              </div>

              <center><button class="btn btn-theme" type="submit" name="submit" id="submit">Submit</button></center>
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
    <script src="../assets/js/jquery-3.2.1.min.js"></script>
    <script src="../assets/js/ours/jam.js"></script>
    <script src="../assets/js/ours/diagnosa.js"></script>

  <script>
      //custom select box

      $(function(){
          $('select.styled').customSelect();
      });

  </script>

  </body>
</html>
