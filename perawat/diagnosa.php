<?php
  //Library
  include "../connection/connect.php";
  include "../process/session_check.php";
  include "headside.php";


  //Ambil data
  $userData = GetData($conn, SelectTarget($_SESSION['tgt']));
  $resultKat = $conn->query("SELECT id_kategori_terapi, nama_kategori_terapi FROM kategori_terapi");
  $resultObat2 = $conn->query("SELECT id_obat, nama_obat FROM obat");
  $resultPerawat = $conn->query("SELECT id_perawat, nama_perawat FROM perawat");
  $resultTransaksi = $conn->query("SELECT * FROM transaksi, pasien, dokter, perawat WHERE transaksi.id_pasien = pasien.id_pasien AND transaksi.id_dokter = dokter.id_dokter AND transaksi.id_perawat = perawat.id_perawat AND transaksi.id_pasien = '$_GET[id_pasien]'");
  $dokter = GetData($conn, "SELECT id_dokter FROM antrian WHERE id_antrian = '$_GET[id_antrian]'");
  $dokter = GetData($conn, "SELECT id_dokter FROM antrian WHERE id_antrian = '$_GET[id_antrian]'");
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

  function CheckQ($q){
    if($q != 0){
      return $q;
    } else {
      return "-";
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

  <section id="container" >
      <?php
        echo $headbar;
        echo $sidebar;
      ?>
      <!--main content start-->
      <section id="main-content">
        <section class="wrapper">
			  <div class="row mt">
        <div class="col-lg-12">
        <a href="antrian.php" style="float: left" class="btn btn-round btn-theme02" role="button"><< Kembali ke Daftar Antrian</a>
        </div>
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
				<?php					
					$sql  = "SELECT * FROM transaksi WHERE id_pasien='$id_pasien'";
					$result = mysqli_query($conn, $sql);
				?>
				
				<h4><center>Diagnosa</center></h4>
        <table class="table table-striped table-advance table-hover col-lg-12">
        <thead>
          <th>Tanggal</th>
          <th colspan="2">Gigi</th>
          <th>Diagnosa</th>
          <th>Terapi</th>
          <th>Keterangan Terapi</th>
          <th>Biaya</th>
        </thead>
        <tbody>
          <?php
              while ($transaksi = $resultTransaksi->fetch_assoc()) {
                $resultDiagnosa = $conn->query("SELECT * FROM transaksi, detail_diagnosa, terapi WHERE transaksi.id_transaksi = detail_diagnosa.id_transaksi AND detail_diagnosa.id_terapi = terapi.id_terapi AND transaksi.id_transaksi = '$transaksi[id_transaksi]' AND transaksi.id_pasien = '$_GET[id_pasien]'");

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
                          " . CheckQ($diagnosa['k1']) . "
                        </td>
                        <td style=\"border-left: solid 2px #000000; border-bottom: solid 2px #000000; text-align: left;\">
                          " . CheckQ($diagnosa['k2']) . "
                        </td>
                        <td rowspan=\"2\">
                          $diagnosa[diagnosa]
                        </td>
                        <td rowspan=\"2\">
                          $diagnosa[nama_terapi]
                        </td>
                        <td rowspan=\"2\">
                          $diagnosa[terapi]
                        </td>
                        <td rowspan=\"2\">
                          Rp " . number_format($diagnosa['biaya'], 0, ".", ",") . "
                        </td>
                      </tr>
                      <tr>
                        <td style=\"border-right: solid 2px #000000; border-top: solid 2px #000000; text-align: right;\">
                          " . CheckQ($diagnosa['k3']) . "
                        </td>
                        <td style=\"border-left: solid 2px #000000; border-top: solid 2px #000000; text-align: left;\">
                          " . CheckQ($diagnosa['k4']) . "
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
                $resultObat1 = $conn->query("SELECT * FROM transaksi, detail_transaksi_obat, obat, satuan WHERE transaksi.id_transaksi = detail_transaksi_obat.id_transaksi AND detail_transaksi_obat.id_obat = obat.id_obat AND obat.id_satuan = satuan.id_satuan AND transaksi.id_transaksi = '$transaksi[id_transaksi]' AND transaksi.id_pasien = '$_GET[id_pasien]'");
                

                $rowObat = $resultObat1->num_rows;

                //echo $rowObat;

                if($rowObat != 0){
                  echo "
                    <tr>
                      <td rowspan=\"" . $rowObat . "\">
                        $transaksi[tanggal]
                      </td>
                  ";

                  //diagnosa
                  while ($obat1 = $resultObat1->fetch_assoc()) {
                    echo "
                        <td>
                          $obat[nama_obat]
                        </td>
                        <td>
                          $obat[jumlah] $obat[nama_satuan]
                        </td>
                        <td>
                          Rp " . number_format($obat1['biaya'], 0 , ",", ".") . "
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
				
            	<center>
                  
				  <br>
				  <br>
				  
          <div class="form-panel">
					<h3 class="mb"><center>Diagnosa Pasien</center></h3><hr>
					<br>
					<form class="form-horizontal style-form" method="post" action = "act/diagnosa.php?">

            <!-- hidden input data pasien -->
            <input type="hidden" name="id_pasien" <?php echo "value=\"$_GET[id_pasien]\"";?>>
            <input type="hidden" name="id_dokter" <?php echo "value=\"$dokter[id_dokter]\"";?>>
            <input type="hidden" name="id_antrian" <?php echo "value=\"$_GET[id_antrian]\"";?>>

						<!--diagnosa dokter-->
            <h4>Diagnosa</h4><hr>

            <h5>1 )</h5>                 

            <center>
              <div class="form-group">
                <div class="col-sm-6">
                  <label class="control-label">Kuadran 1</label>
                  <input type="text" class="form-control" name="k1d1" id="k1d1" autocomplete="off">
                </div>
                <div class="col-sm-6">
                  <label class="control-label">Kuadran 2</label>
                  <input type="text" class="form-control" name="k2d1" id="k2d1" autocomplete="off">
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-6">
                  <label class="control-label">Kuadran 3</label>
                  <input type="text" class="form-control" name="k3d1" id="k3d1" autocomplete="off">
                </div>
                <div class="col-sm-6">
                  <label class="control-label">Kuadran 4</label>
                  <input type="text" class="form-control" name="k4d1" id="k4d1" autocomplete="off">
                </div>
              </div>
            </center>

            <div class="form-group">
              <label class="col-sm-2 control-label">Diagnosa</label>
              <div class="col-sm-10">
                <textarea class="form-control" name="ketd1" id="ketd1" style="max-width: 100%; min-width: 100%" required autocomplete="off"></textarea>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 col-sm-2 control-label">Kategori Terapi</label>
              <div class="col-sm-10">
                <!--DROPDOWN NAMA DOKTER-->
                <select class="form-control" name="idk1" id="idk1" onchange="SetChildOpt(this);" required>
                  <option disabled selected hidden>-- Pilih Kategori Terapi --</option>
                  <?php
                    while($kat = $resultKat->fetch_assoc()){
                      echo "
                        <option value=\"$kat[id_kategori_terapi]\">$kat[nama_kategori_terapi]</option>
                      ";
                    }
                  ?>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 col-sm-2 control-label">Jenis Terapi</label>
              <div class="col-sm-10">
                <!--DROPDOWN NAMA DOKTER-->
                <select class="form-control" name="idt1" id="idt1" onchange="LoadTarifTerapi(this);" required>
                  <option disabled selected hidden>Pilih kategori terlebih dahulu</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label">Tarif (Rp)</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="tarift1" id="tarift1" onkeyup="CalcBiayaTotal()" required autocomplete="off">
                <div id="minmaxt1"></div>
              </div>
            </div>
          
            <div class="form-group">
              <label class="col-sm-2 control-label">Keterangan Terapi</label>
              <div class="col-sm-10">
                <textarea class="form-control" name="kett1" id="kett1" style="max-width: 100%; min-width: 100%" required autocomplete="off"></textarea>
              </div>
            </div>

            <!-- DIAGNOSA BARU DIAPPEND KE SINI -->
            <div id="field-diagnosa">
            </div>

            <!-- TOMBOL BUAT NAMBAH DIAGNOSA -->
            <div class="form-group col-sm-12">
              <center>
              <input type="hidden" name="diag-num" id="diag-num" value="1">
              <input type="button" class="btn" name="btn-diag" id="btn-diag" value="+">
              <input type="button" class="btn" name="btn-diag-" id="btn-diag-" value="-" style="display:none;">
              </center>
            </div>

            <!--Form obat-->
            <h4>Obat</h4><hr>
            <h5>1 )</h5>
						<div class="form-group">
              <div class="col-sm-3"></div>
							<label class="col-sm-2 control-label">Nama Obat</label>
							<div class="col-sm-4">
								<select class="form-control" id="ido1" name="ido1" onchange="CalcHargaObat(this);">
                  <option disabled selected hidden>Pilih Nama Obat</option>
									<?php
                    while($obat2 = $resultObat2->fetch_assoc()){
                      echo "
                        <option value=\"$obat2[id_obat]\">$obat2[nama_obat]</option>
                      ";
                    }
                  ?>
								</select>
							</div>
						</div>

            <div class="form-group">
              <div class="col-sm-3"></div>
              <label class="control-label col-sm-2">Jumlah</label>
              <div class="col-sm-4">
                <input type="text" class="form-control" name="jumo1" id="jumo1" onkeyup="CalcHargaObat(document.getElementById('ido1')); CekStok(document.getElementById('ido1'), this);">
                <div id="cekstok1"></div>
                <input type="hidden" name="hrgo1" id="hrgo1">
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-3"></div>
              <div class="col-sm-6" id="hargao1" style="text-align: center;"></div>
            </div>

            <!--menu drop down jenis tindakan-->
            <div id="field-obat">
            </div>

            <!-- BUTTON BUAT NAMBAH OBAT -->
            <div class="form-group col-sm-12">
              <center>
              <input type="hidden" name="obat-num" id="obat-num" value="1">
              <input type="button" class="btn" name="btn-obat" id="btn-obat" value="+">
              <input type="button" class="btn" name="btn-obat-" id="btn-obat-" value="-" style="display:none;">
              </center>
            </div>

            <!--Form Perawat-->
            <h4>Perawat</h4><hr>
            <div class="form-group">
              <div class="col-sm-3"></div>
              <label class="col-sm-2 control-label">Nama Perawat</label>
              <div class="col-sm-4">
                <select class="form-control" id="id_perawat" name="id_perawat" onchange="CalcHargaObat(this);" required>
                  <option disabled selected hidden>Pilih Nama perawat</option>
                  <?php
                    while($perawat = $resultPerawat->fetch_assoc()){
                      echo "
                        <option value=\"$perawat[id_perawat]\">$perawat[nama_perawat]</option>
                      ";
                    }
                  ?>
                </select>
              </div>
            </div>

            <!--Biaya Total & Metode Pembayaran-->
            <h4>Biaya</h4><hr>

            <div class="form-group">
              <div class="col-sm-3"></div>
              <label class="col-sm-2 control-label">Metode Pembayaran</label>
              <div class="col-sm-4">
                <select class="form-control" id="metode_pembayaran" name="metode_pembayaran" onchange="CalcHargaObat(this);" required>
                  <option disabled selected hidden>Pilih Metode Pembayaran</option>
                  <option>Tunai</option>
                  <option>Kredit</option>
                  <option>Debit</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-3"></div>
              <label class="control-label col-sm-2">Diskon (Rp)</label>
              <div class="col-sm-4">
                <input type="text" class="form-control" name="diskon" id="diskon" onkeyup="CalcBiayaTotal();" value="0">
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-3"></div>
              <div class="col-sm-6" id="biaya-total" style="text-align: center;"><h4>Total Biaya (Sebelum Diskon): </h4></div>
              <input type="hidden" name="biaya_total" id="biaya_total" value="100">
            </div>

            <div class="form-group">
              <div class="col-sm-3"></div>
              <div class="col-sm-6" id="biaya-total-diskon" style="text-align: center;"><h4>Total Biaya (Sesudah Diskon): </h4></div>
              <input type="hidden" name="biaya_total_diskon" id="biaya_total_diskon" value="100">
            </div>

						<center><button class="btn btn-theme" type="submit" name="submit" id="submit">Submit</button></center>
						<br>
					</form>
					</div>
				</div><!-- col-lg-12-->
            </div><!-- /row -->
              </center>
          		</div>
				
          	</div>

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

    <script src="../assets/js/ours/diagnosa.js"></script>
  <!--script for this page-->

  <script>
      //custom select box

      $(function(){
          $('select.styled').customSelect();
      });

  </script>
  </body>
</html>
