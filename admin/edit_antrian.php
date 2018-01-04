<?php
  //Library
  include "../connection/connect.php";
  include "../process/session_check.php";
  include "headside.php";

  //Ambil data
  $userData = GetData($conn, SelectTarget($_SESSION['tgt']));
  $resultDokter = $conn->query("SELECT nama_dokter, id_dokter FROM dokter");
  $dataAntrian = $conn->query("SELECT * FROM antrian, dokter WHERE antrian.id_dokter = dokter.id_dokter AND antrian.id_antrian = $_GET[id_antrian]");
  $antrian = $dataAntrian->fetch_assoc();
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

  <body onload="startTime()">

  <section id="container" >
      <?php
        echo $headbar;
        echo $sidebar;
      ?>
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
          	<h2><center>Daftar Antrian</center></h2>
            <hr>
          	<div class="row mt">
              <div class="col-lg-2">
              </div>
          		<div class="col-lg-8">
            		<center>
                  <div class="form-panel">
                  <h4 class="mb"><center>Penambahan Data Baru</center></h4>
                  <br>

                  <form class="form-horizontal style-form" method="post" action = <?php echo "\"act/edit_antrian.php?id_antrian=$antrian[id_antrian]\""?>>

                    <!--no_reg_dokter-->
                    <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label">Nama Pasien</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="nama_pasien" id="nama_pasien" onKeyUp="search(this.value)" autocomplete="off" onblur="" value=<?php echo "\"$antrian[nama_pasien]\"";?> required>
                        <input type="hidden" name="id_pasien" id="id_pasien" value=<?php echo "\"$antrian[id_pasien]\"";?>>
                        <div id="livesearch"></div>
                      </div>
                    </div>

                    <!--alamat-->
                    <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label">Tanggal</label>
                      <div class="col-sm-10">
                        <!--<textarea class="form-control" name="alamat" id="alamat" style="max-width: 100%; min-width: 100%"></textarea required>-->
                        <input type="date" class="form-control" name="tanggal" id="tanggal" autocomplete="off" value=<?php echo "\"$antrian[tanggal]\"";?> readonly>
                        <input type="hidden" name="status" id="status" value="Menunggu">
                      </div>
                    </div>

                    <!--tanggal_lahir-->
                    <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label">Jam Daftar</label>
                      <div class="col-sm-10">
                        <!--<input type="time" class="form-control" name="jam_daftar" id="jam_daftar" required>-->
                        <input type="text" class="form-control" id="jam_daftar" name="jam_daftar" value=<?php echo "\"$antrian[jam_daftar]\"";?> autocomplete="off" readonly>
                      </div>
                    </div>

                    <!--jenis_kelamin-->
                    <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label">Jam Layan</label>
                      <div class="col-sm-10">
                        <input type="time" class="form-control" name="jam_layan" id="jam_layan" autocomplete="off" value=<?php echo "\"$antrian[jam_layan]\"";?> required>
                      </div>
                    </div>

                    <!--nomor_telpon-->
                    <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label">Dokter</label>
                      <div class="col-sm-10">
                        <!--DROPDOWN NAMA DOKTER-->
                        <select class="form-control" name="id_dokter" id="id_dokter">
                          <?php
                            while($dokter = $resultDokter->fetch_assoc()){
                              if($dokter['id_dokter'] == $antrian['id_dokter']){
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

                    <center>
                      <button class="btn btn-theme" type="submit" name="submit" id="submit">Submit</button>
                      <button type="button" class="btn" onclick="history.back(-1)">Cancel</button>
                    </center>
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
