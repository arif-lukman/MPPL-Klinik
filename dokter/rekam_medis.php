<?php
  //Library
  include "../connection/connect.php";
  include "../process/session_check.php";
  include "headside.php";

  //Ambil data
  $userData = GetData($conn, "SELECT * FROM user_klinik WHERE username = '$_SESSION[uid]'");
  //

  $resultTransaksi = $conn->query("SELECT * FROM transaksi, pasien, dokter, perawat WHERE transaksi.no_rekam_medis = pasien.no_rekam_medis AND transaksi.id_dokter = dokter.id_dokter AND transaksi.id_perawat = perawat.id_perawat AND transaksi.no_rekam_medis = '$_GET[no_rekam_medis]'");

  $resTransaksi = $conn->query("SELECT * FROM transaksi, pasien, detail_diagnosa");
  //echo $rowDiagnosa;
  //$rowTerapi = $resultTerapi->num_rows();
  //$rowObat = $resultObat->num_rows();

  //$dokter = GetData($conn, "SELECT id_dokter FROM antrian WHERE id_antrian = '$_GET[id_antrian]'");
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
			  <div class="row mt">
				<div class="col-lg-2">
				</div>

			 <!-- DATA PASIEN -->
				<div class="col-lg-8">
			
				<h3><center>Data Pasien</center></h3><hr>
				
				<?php
					$no_rekam = $_GET["no_rekam_medis"];
					$sql  = "SELECT * FROM pasien WHERE no_rekam_medis='$no_rekam'";
					$result = mysqli_query($conn, $sql);
          //$no_rekam = mysqli_fetch_assoc(mysqli_query($conn, "SELECT no_rekam_medis FROM pasien WHERE id_pasien='$id_pasien'"));
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
				<h3><center>Rekam Medis No. <?php echo $no_rekam?></center></h3><hr>
				<?php					
          /*
					$sql  = "SELECT * FROM transaksi WHERE id_pasien='$id_pasien'";
					$result = mysqli_query($conn, $sql);
          */
				?>

        <h4><center>Diagnosa</center></h4>
				<table class="table table-striped table-advance table-hover col-lg-12">
				<thead>
					<th>Tanggal</th>
					<th colspan="2">Gigi</th>
					<th>Keterangan</th>
				</thead>
				<tbody>
          <?php
              while ($transaksi = $resultTransaksi->fetch_assoc()) {
                $resultDiagnosa = $conn->query("SELECT * FROM transaksi, detail_diagnosa WHERE transaksi.id_transaksi = detail_diagnosa.id_transaksi AND transaksi.id_transaksi = '$transaksi[id_transaksi]' AND transaksi.no_rekam_medis = '$_GET[no_rekam_medis]'");

                $rowDiagnosa = $resultDiagnosa->num_rows;

                echo "
                  <tr>
                    <td rowspan=\"" . $rowDiagnosa * 2 . "\">
                      $transaksi[tanggal]
                    </td>
                ";

                //diagnosa
                if($rowDiagnosa != 0){
                  while ($diagnosa = $resultDiagnosa->fetch_assoc()) {
                    echo "
                        <td style=\"border-right: solid 2px #000000; border-bottom: solid 2px #000000; text-align: right;\">
                          $diagnosa[k1]
                        </td>
                        <td style=\"border-left: solid 2px #000000; border-bottom: solid 2px #000000; text-align: left;\">
                          $diagnosa[k2]
                        </td>
                        <td rowspan=\"2\">
                          $diagnosa[diagnosa]
                        </td>
                        <td align =\"right\" rowspan=\"2\">
                          <a href=\"edit_diagnosa.php?id_diagnosa=$diagnosa[id_detail_diagnosa]\" class=\"btn btn-primary btn-xs\" role=\"button\"><i class=\"fa fa-pencil\"></i></a>
                        
                          <a href=\"act/hapus_diagnosa.php?id_diagnosa=$diagnosa[id_detail_diagnosa]\" class=\"btn btn-danger btn-xs\" role=\"button\"><i class=\"fa fa-trash-o\"></i></a>
                        </td>
                      </tr>
                      <tr>
                        <td style=\"border-right: solid 2px #000000; border-top: solid 2px #000000; text-align: right;\">
                          $diagnosa[k3]
                        </td>
                        <td style=\"border-left: solid 2px #000000; border-top: solid 2px #000000; text-align: left;\">
                          $diagnosa[k4]
                        </td>
                      </tr>
                      ";
                  }
              }
            }
          ?>
        </tbody>
  			</table>
        <br><br><br><br>

        <h4><center>Terapi</center></h4>
        <table class="table table-striped table-advance table-hover col-lg-12">
        <thead>
          <th>Tanggal</th>
          <th>Terapi</th>
          <th>Keterangan</th>
          <th>Tarif</th>
        </thead>
        <tbody>
          <?php
                //$resultObat = $conn->query("SELECT * FROM transaksi, detail_transaksi_obat, obat WHERE transaksi.id_transaksi = detail_transaksi_obat.id_transaksi AND detail_transaksi_obat.id_obat = obat.id_obat");
              $resultTransaksi->data_seek(0);
              while ($transaksi = $resultTransaksi->fetch_assoc()) {
                $resultTerapi = $conn->query("SELECT * FROM transaksi, detail_transaksi_terapi, terapi WHERE transaksi.id_transaksi = detail_transaksi_terapi.id_transaksi AND detail_transaksi_terapi.id_terapi = terapi.id_terapi AND transaksi.id_transaksi = '$transaksi[id_transaksi]' AND transaksi.no_rekam_medis = '$_GET[no_rekam_medis]'");

                $rowTerapi = $resultTerapi->num_rows;

                if($rowTerapi != 0){
                  echo "
                    <tr>
                      <td rowspan=\"" . $rowTerapi . "\">
                        $transaksi[tanggal]
                      </td>
                  ";

                  //diagnosa
                  while ($terapi = $resultTerapi->fetch_assoc()) {
                    echo "
                        <td>
                          $terapi[nama_terapi]
                        </td>
                        <td>
                          $terapi[keterangan]
                        </td>
                        <td>
                          Rp " . number_format($terapi['biaya'], 0 , ",", ".") . "
                        </td>
                        <td align =\"right\">
                          <a href=\"edit_terapi.php?id_terapi=$terapi[id_detail_transaksi_terapi]\" class=\"btn btn-primary btn-xs\" role=\"button\"><i class=\"fa fa-pencil\"></i></a>
                        
                          <a href=\"act/hapus_terapi.php?id_terapi=$terapi[id_detail_transaksi_terapi]\" class=\"btn btn-danger btn-xs\" role=\"button\"><i class=\"fa fa-trash-o\"></i></a>
                        </td>
                      </tr>
                    ";
                  }
                }
              }
          ?>
        </tbody>
        </table>
        <br><br><br><br>

        <h4><center>Obat</center></h4>
        <table class="table table-striped table-advance table-hover col-lg-12">
        <thead>
          <th>Tanggal</th>
          <th>Nama Obat</th>
          <th>Jumlah per Satuan</th>
          <th>Harga Total</th>
        </thead>
        <tbody>
          <?php
                //$resultObat = $conn->query("SELECT * FROM transaksi, detail_transaksi_obat, obat WHERE transaksi.id_transaksi = detail_transaksi_obat.id_transaksi AND detail_transaksi_obat.id_obat = obat.id_obat");
              $resultTransaksi->data_seek(0);
              while ($transaksi = $resultTransaksi->fetch_assoc()) {
                $resultObat = $conn->query("SELECT * FROM transaksi, detail_transaksi_obat, obat, satuan WHERE transaksi.id_transaksi = detail_transaksi_obat.id_transaksi AND detail_transaksi_obat.id_obat = obat.id_obat AND obat.id_satuan = satuan.id_satuan AND transaksi.id_transaksi = '$transaksi[id_transaksi]' AND transaksi.no_rekam_medis = '$_GET[no_rekam_medis]'");
                

                $rowObat = $resultObat->num_rows;

                //echo $rowObat;

                if($rowObat != 0){
                  echo "
                    <tr>
                      <td rowspan=\"" . $rowObat . "\">
                        $transaksi[tanggal]
                      </td>
                  ";

                  //diagnosa
                  while ($obat = $resultObat->fetch_assoc()) {
                    echo "
                        <td>
                          $obat[nama_obat]
                        </td>
                        <td>
                          $obat[jumlah] $obat[nama_satuan]
                        </td>
                        <td>
                          Rp " . number_format($obat['biaya'], 0 , ",", ".") . "
                        </td>
                        <td align =\"right\">
                        <a href=\"edit_obat.php?id_obat=$obat[id_detail_transaksi_obat]\" class=\"btn btn-primary btn-xs\" role=\"button\"><i class=\"fa fa-pencil\"></i></a>
                      
                        <a href=\"act/hapus_obat.php?id_obat=$obat[id_detail_transaksi_obat]\" class=\"btn btn-danger btn-xs\" role=\"button\"><i class=\"fa fa-trash-o\"></i></a>
                      </td>
                      </tr>
                    ";
                  }
                }
              }
          ?>
        </tbody>
        </table>
        <br><br><br><br>

        <h4><center>Rincian</center></h4>
        <table class="table table-striped table-advance table-hover col-lg-12">
        <thead>
          <th>Tanggal</th>
          <th>Dokter</th>
          <th>Perawat</th>
          <th>Jam Selesai</th>
          <th>Metode Pembayaran</th>
          <th>Biaya Total</th>
          <th>Diskon</th>
        </thead>
        <tbody>
          <?php
                //$resultObat = $conn->query("SELECT * FROM transaksi, detail_transaksi_obat, obat WHERE transaksi.id_transaksi = detail_transaksi_obat.id_transaksi AND detail_transaksi_obat.id_obat = obat.id_obat");
              $resultTransaksi->data_seek(0);
              while ($transaksi = $resultTransaksi->fetch_assoc()) {
                echo "
                  <tr>
                    <td>
                      $transaksi[tanggal]
                    </td>
                    <td>
                      $transaksi[nama_dokter]
                    </td>
                    <td>
                      $transaksi[nama_perawat]
                    </td>
                    <td>
                      $transaksi[jam]
                    </td>
                    <td>
                      $transaksi[metode_pembayaran]
                    </td>
                    <td>
                      Rp " . number_format($transaksi['biaya_total'], 0 , ",", ".") . "
                    </td>
                    <td>
                      $transaksi[diskon]%
                    </td>
                    <td align =\"right\" rowspan=\"2\">
                      <a href=\"edit_transaksi.php?id_transaksi=$transaksi[id_transaksi]\" class=\"btn btn-primary btn-xs\" role=\"button\"><i class=\"fa fa-pencil\"></i></a>
                    
                      <a href=\"act/hapus_transaksi.php?id_transaksi=$transaksi[id_transaksi]\" class=\"btn btn-danger btn-xs\" role=\"button\"><i class=\"fa fa-trash-o\"></i></a>
                    </td>
                  <tr>
                ";
              }
          ?>
        </tbody>
        </table>
        <br><br><br><br>

				<div class="container">
				<table class="table table-striped">
				
				</table>
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
