<?php
  //Library
  include "../connection/connect.php";
  include "../process/session_check.php";
  include "headside.php";

  //Ambil data
  $userData = GetData($conn, SelectTarget($_SESSION['tgt']));
  $dataPasien = $conn->query("SELECT * FROM pasien WHERE pasien.id_pasien = $_GET[id_pasien]");
  //echo "SELECT * FROM dokter, detail_akun_dokter, user_klinik WHERE dokter.id_dokter = detail_akun_dokter.id_dokter AND detail_akun_dokter.id_user_klinik = user_klinik.id_user_klinik AND dokter.id_dokter = $_GET[id_dokter]";
  $pasien = $dataPasien->fetch_assoc();
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

    <!-- Offline JQuery -->
    <script src="../assets/js/jquery-3.2.1.min.js"></script>

    <!-- Our Javascript -->
    <script src="../assets/js/ours/validation_pasien.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body onload="startTime(); GetLatestRM();">

  <section id="container" >
      <?php
        echo $headbar;
        echo $sidebar;
      ?>
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
          	<h2><center>Data Pasien</center></h2>
            <hr>
          	<div class="row mt">
              <div class="col-lg-2">
              </div>
          		<div class="col-lg-8">
            		<center>
                  <div class="form-panel">
                  <h4 class="mb"><center>Penambahan Data Baru</center></h4>
                  <br>

                  <form class="form-horizontal style-form" method="post" action = <?php echo "\"act/edit_pasien.php?id_pasien=$pasien[id_pasien]\""?>>

                  	<div class="form-group">
                      <center>
                      <div class="col-sm-12" id="rm-now">
                        Nomor Rekam Medis Terakhir:
                      </div>
                      </center>
                    </div>
                    
                    <!--email-->
                    <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label">Nomor Rekam Medis (12 digit)</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="no_rekam_medis" id="no_rekam_medis" autocomplete="off" required>
                        <div id="vld-rm"></div>
                      </div>
                    </div>

                    <!--nama_dokter-->
                    <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label">Nama Pasien</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="nama_pasien" id="nama_pasien" value=<?php echo "\"$pasien[nama_pasien]\"";?> autocomplete="off" required>
                      </div>
                    </div>

                    <!--no_reg_dokter-->
                    <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label">Alamat Pasien</label>
                      <div class="col-sm-10">
                        <textarea class="form-control" name="alamat" id="alamat" style="max-width: 100%; min-width: 100%"><?php echo "$pasien[alamat]"?></textarea autocomplete="off" required>
                      </div>
                    </div>

                    <!--alamat-->
                    <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label">Tanggal Lahir</label>
                      <div class="col-sm-10">
                        <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir" value=<?php echo "\"$pasien[tanggal_lahir]\"";?> autocomplete="off" required>
                      </div>
                    </div>

                    <!--tanggal_lahir-->
                    <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label">Pekerjaan</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="pekerjaan" id="pekerjaan" value=<?php echo "\"$pasien[pekerjaan]\"";?> autocomplete="off" required>
                      </div>
                    </div>

                    <!--jenis_kelamin-->
                    <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label">Nomor Telpon</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="no_telp" id="no_telp" value=<?php echo "\"$pasien[no_telp]\"";?> autocomplete="off" required>
                        <span id="vld-telp"></span>
                      </div>
                    </div>

                    <!--nomor_telpon-->
                    <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label">Jenis Kelamin</label>
                      <div class="radio col-sm-10">
                      <label>
                        <input type="radio" name="jenis_kelamin" id="optionsRadios1" value="L" required
                        <?php
                          if($pasien['jenis_kelamin'] == "L"){
                            echo "checked";
                          }
                        ?>
                        >
                      Laki-laki
                      </label>
                      <label>
                        <input type="radio" name="jenis_kelamin" id="optionsRadios2" value="P"
                        <?php
                          if($pasien['jenis_kelamin'] == "P"){
                            echo "checked";
                          }
                        ?>
                        >
                      Perempuan
                      </label>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label">Nomor Rekam Medis Terkini:</label>
                      <div class="col-sm-10" id="rm-now">
                       	
                      </div>
                    </div>

                    <!--email-->
                    <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label">Nomor Rekam Medis (12 digit)</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="no_rekam_medis" id="no_rekam_medis" value=<?php echo "\"$pasien[no_rekam_medis]\"";?> autocomplete="off" required>
                        <div id="vld-rm"></div>
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
