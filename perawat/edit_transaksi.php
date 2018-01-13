<?php
  //Library
  include "../connection/connect.php";
  include "../process/session_check.php";
  include "headside.php";

  //Ambil data
  $userData = GetData($conn, "SELECT * FROM user_klinik WHERE username = '$_SESSION[uid]'");
  $resultPerawat = $conn->query("SELECT id_perawat, nama_perawat FROM perawat");
  $resultDokter = $conn->query("SELECT nama_dokter, id_dokter FROM dokter");
  $transaksi = GetData($conn, "SELECT * FROM transaksi WHERE id_transaksi = '$_GET[id_transaksi]'");

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

  <body <?php echo "onload=\"startTime();CalcHargaObat(document.getElementById(\"ido1\"));\""?>>

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
          <form class="form-horizontal style-form" method="post" <?php echo "action = \"act/edit_transaksi.php?id_pasien=$_GET[id_pasien]&id_transaksi=$_GET[id_transaksi]\""?>>
            <!--diagnosa dokter-->
            <!--Form Perawat-->

            <h4>Pengubahan Data Transaksi</h4><hr>

            <div class="form-group">
              <label class="col-sm-2 col-sm-2 control-label">Tanggal</label>
              <div class="col-sm-10">
                <!--<textarea class="form-control" name="alamat" id="alamat" style="max-width: 100%; min-width: 100%"></textarea required>-->
                <input type="date" class="form-control" name="tanggal" id="tanggal" autocomplete="off" <?php echo "value=\"$transaksi[tanggal]\""; ?>>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 col-sm-2 control-label">Jam</label>
              <div class="col-sm-10">
                <!--<input type="time" class="form-control" name="jam_daftar" id="jam_daftar" required>-->
                <input type="time" class="form-control" id="jam" name="jam" autocomplete="off" <?php echo "value=\"$transaksi[jam]\""; ?>>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 col-sm-2 control-label">Dokter</label>
              <div class="col-sm-10">
                <!--DROPDOWN NAMA DOKTER-->
                <select class="form-control" name="id_dokter" id="id_dokter">
                  <option disabled selected hidden>Pilih Nama Dokter</option>
                  <?php
                    while($dokter = $resultDokter->fetch_assoc()){
                      if($dokter['id_dokter'] == $transaksi['id_dokter']){
                        echo "
                          <option value=\"$dokter[id_dokter]\" selected>$dokter[nama_dokter]</option>
                        ";
                      } else {
                        echo "
                          <option value=\"$dokter[id_dokter]\">$dokter[nama_dokter]</option>
                        ";
                      }
                    }
                  ?>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label">Perawat</label>
              <div class="col-sm-10">
                <select class="form-control" id="id_perawat" name="id_perawat" required>
                  <option disabled selected hidden>Pilih Nama Perawat</option>
                  <?php
                    while($perawat = $resultPerawat->fetch_assoc()){
                      if($perawat['id_perawat'] == $transaksi['id_perawat']){
                        echo "
                          <option value=\"$perawat[id_perawat]\" selected>$perawat[nama_perawat]</option>
                        ";
                      } else {
                        echo "
                          <option value=\"$perawat[id_perawat]\">$perawat[nama_perawat]</option>
                        ";
                      }
                    }
                  ?>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label">Metode Pembayaran</label>
              <div class="col-sm-10">
                <select class="form-control" id="metode_pembayaran" name="metode_pembayaran" required>
                  <option disabled selected hidden>Pilih Metode Pembayaran</option>
                  <option <?php if($transaksi['metode_pembayaran'] == "Tunai") echo "selected";?>>Tunai</option>
                  <option <?php if($transaksi['metode_pembayaran'] == "Kredit") echo "selected";?>>Kredit</option>
                  <option <?php if($transaksi['metode_pembayaran'] == "Debit") echo "selected";?>>Debit</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-2">Diskon (%)</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="diskon" id="diskon" <?php echo "value=\"$transaksi[diskon]\""; ?>>
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
