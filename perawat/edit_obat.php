<?php
  //Library
  include "../connection/connect.php";
  include "../process/session_check.php";
  include "headside.php";


  //Ambil data
  $userData = GetData($conn, SelectTarget($_SESSION['tgt']));
  $dataObat = $conn->query("SELECT * FROM obat WHERE id_obat = $_GET[id_obat]");
  $obat = $dataObat->fetch_assoc();
  $resultSat = $conn->query("SELECT id_satuan, nama_satuan FROM satuan");
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
	<SCRIPT language=Javascript>
	<!--
	function isNumberKey(evt)
	{
		var charCode = (evt.which) ? evt.which : event.keyCode
		if (charCode > 31 && (charCode < 48 || charCode > 57))

		return false;
		return true;
	}
	//-->
	</SCRIPT>
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
          	<h2><center>Daftar Obat</center></h2>
            <hr>
          	<div class="row mt">
              <div class="col-lg-2">
              </div>
          		<div class="col-lg-8">
            		<center>
                  <div class="form-panel">
                  <h4 class="mb"><center>Penambahan Data Baru</center></h4>
                  <br>

                  <form class="form-horizontal style-form" method="post" action = <?php echo "act/edit_obat.php?id_obat=$obat[id_obat]" ?>>

                    <!--nama_dokter-->
                    <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label">Nama Obat</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="nama_obat" id="nama_obat" value=<?php echo "\"$obat[nama_obat]\"";?> required>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label">Satuan</label>
                      <div class="col-sm-10">
                        <select class="form-control" name="satuan" id="satuan">
                          <?php
                            while($sat = $resultSat->fetch_assoc()){
							  if($obat['id_satuan'] == $sat['id_satuan']){
                                echo "
                                  <option value=\"$sat[id_satuan]\" selected>$sat[nama_satuan]</option>
                                ";
                              } else {
                                echo "
                                  <option value=\"$sat[id_satuan]\">$sat[nama_satuan]</option>
                                ";
                              }
                            }
                          ?>
                        </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label">Jumlah</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="jumlah" id="jumlah" onkeypress="return isNumberKey(event)" value=<?php echo "\"$obat[stok]\"";?> required>
                      </div>
                    </div>

                    <!--no_reg_dokter-->
                    <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label">Harga Per Satuan (Rp)</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="harga" id="harga" value=<?php echo "\"$obat[harga]\"";?> required>
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
