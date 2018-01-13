<?php
  //Library
  include "../connection/connect.php";
  include "../process/session_check.php";
  include "headside.php";

  //Ambil data
  $userData = GetData($conn, SelectTarget($_SESSION['tgt']));
  $dataPasien = $conn->query("SELECT * FROM pasien");

  $report = $conn->query("SELECT transaksi.tanggal AS tanggal, pasien.nama_pasien AS nama_pasien, pasien.jenis_kelamin AS jenis_kelamin, pasien.alamat AS alamat, pasien.tanggal_lahir AS tanggal_lahir, pasien.no_rekam_medis AS no_rekam_medis, terapi.nama_terapi AS nama_terapi, detail_diagnosa.biaya, dokter.nama_dokter AS nama_dokter, perawat.nama_perawat AS nama_perawat from transaksi, pasien, detail_diagnosa, terapi, dokter, perawat WHERE transaksi.id_pasien = pasien.id_pasien AND transaksi.id_transaksi=detail_diagnosa.id_transaksi AND detail_diagnosa.id_terapi=terapi.id_terapi AND dokter.id_dokter=transaksi.id_dokter AND perawat.id_perawat=transaksi.id_perawat");
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

	<!-- Offline JQuery -->
    <script src="../assets/js/jquery-3.2.1.min.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<script type="text/javascript">
      //JQUERY
      $(document).ready(function(){
        //search
        $("#search").change(function(){
          var search = document.getElementById("search").value;
          var searchp= document.getElementById("searchp").value;
          console.log(search);
          console.log(searchp);

          //console.log("ajax/uname_status.php?uname=" + uname);
          console.log("ajax/search_bulanan.php?q=" + search + "&p=" + searchp);
          $.get("ajax/search_bulanan.php?q=" + search + "&p=" + searchp, function(data, status){
            $("tbody").html(data);
          });
        });
      });
    </script>
  <body onload="startTime()">

  <section id="container" >
      <?php
        echo $headbar;
        echo $sidebar;
      ?>
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
          	<h2><center>Laporan</center></h2>
            <hr>
          	<div class="row mt">
          	<div class="col-lg-12">
                <div class="table-responsive">
				<form role="search">
                <div class="form-group">
                  <label>Search :</label>
                  <div id="tabeldata_filter" class="dataTables_filter">
                    <!--<label>Search :</label>-->
                      <div class="col-sm-3">
                        <select class="form-control" name="bulan" id="search" required>
                          <option selected hidden disabled>Bulan</option>
                          <?php
                            $bulan=array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
                            $jlh_bln=count($bulan);
                            for($c=0; $c<$jlh_bln; $c+=1){
                              echo"<option value=\"" . ($c+1) ."\"> $bulan[$c] </option>";
                            }
                          ?>
                        </select>
                      </div>
                      <div class="col-sm-3">
                        <select class="form-control" name="tahun" id="searchp" required>
                          <option selected hidden disabled>Tahun</option>
                          <?php
                            $now=date('Y');
                            for ($a=2000;$a<=$now;$a++)
                            {
                                echo "<option value='$a'>$a</option>";
                            }
                            ?>
                        </select>
                      </div>
                  </div>
                </div>
				</form>

          		<table class="table table-striped table-advance table-hover col-lg-12">
              <thead>
				<th>Tanggal</th>
                <th>Nama</th>
				<th>JK</th>
                <th>Alamat</th>
                <th>Tanggal Lahir</th>
				<th>Nomor Rekam Medis</th>
                <th>Terapi</th>
                <th>Biaya</th>
				<th>Dokter / Perawat
              </thead>
              <tbody>
                <?php

                while($rep = $report->fetch_assoc()){
                  echo "
                    <tr>
                      <td>
                        $rep[tanggal]
                      </td>
                      <td>
                        $rep[nama_pasien]
                      </td>
                      <td>
                        $rep[jenis_kelamin]
                      </td>
                      <td>
                        $rep[alamat]
                      </td>
                      <td>
                        $rep[tanggal_lahir]
                      </td>
					  <td>
						$rep[no_rekam_medis]
					  </td>
                      <td>
                        $rep[nama_terapi]
                      </td>
                      <td>
                        Rp " . number_format($rep['biaya'], 0 , ",", ".") . "
                      </td>
					  <td>
						$rep[nama_dokter] / $rep[nama_perawat]
					  </td>
                    </tr>
                  ";
                }
                ?>
              </tbody>
              </table>
          		</div>
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
