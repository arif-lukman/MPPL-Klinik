<?php
  //Library
  include "../connection/connect.php";
  include "../process/session_check.php";
  include "headside.php";

  //Ambil data
  $userData = GetData($conn, SelectTarget($_SESSION['tgt']));
  $resultDokter = $conn->query("SELECT nama_dokter, id_dokter FROM dokter");
  $dataBooking = $conn->query("SELECT * FROM booking, dokter WHERE booking.id_dokter = dokter.id_dokter AND booking.id_booking = $_GET[id_booking]");
  $booking = $dataBooking->fetch_assoc();
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

    <style type="text/css">
      #livesearch{
        overflow-y: scroll;
        box-shadow: 0px 2px 4px #444;
        max-height: 260px;
      }

      #searchitem:hover {
        background-color: #e6e6e6;
        user-select: none;
      }
    </style>

    <script type="text/javascript">
      //ajax
      function search(str){
        if(str.length==0){
          document.getElementById("livesearch").innerHTML = "";
          document.getElementById("id_pasien").value = null;
          return;
        }

        var xmlhttp;
        if(window.XMLHttpRequest){
          xmlhttp = new XMLHttpRequest();
        } else {
          xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }

        xmlhttp.onreadystatechange=function(){
          if (xmlhttp.readyState==4 && xmlhttp.status==200){
            document.getElementById("livesearch").innerHTML = xmlhttp.responseText;
          }
        }

        xmlhttp.open("GET", "ajax/pasien.php?q=" + str, true);
        xmlhttp.send();
      }

      //masukin nilai ke input
      function setPasien(str, id){
        document.getElementById("nama_pasien").value = str;
        document.getElementById("id_pasien").value = id;
        document.getElementById("livesearch").innerHTML = "";
      }

      function checkStat(){
        var str = document.getElementById("nama_pasien").value;
        var stat = document.getElementById("status_pasien").value;
        console.log(stat);

        if(stat == 1){
          search(str);
        } else {
          document.getElementById("id_pasien").value = null;
        }
      }
    </script>

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
              <div class="col-lg-2">
              </div>
              <div class="col-lg-8">
                <center>
                  <div class="form-panel">
                  <h4 class="mb"><center>Penambahan Data Baru</center></h4>
                  <br>

                  <form class="form-horizontal style-form" method="post" action = <?php echo "\"act/edit_booking.php?id_booking=$booking[id_booking]\""?>>

                    <!--status-->
                    <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label">Status Pasien</label>
                      <div class="col-sm-10">
                        <select class="form-control" name="status_pasien" id="status_pasien" onchange="checkStat()" required>
                          <option value="1"
                          <?php
                            if($booking['status_pasien'] == 1)
                              echo "selected";
                          ?>
                          >Pasien Lama</option>
                          <option value="2"
                          <?php
                            if($booking['status_pasien'] == 2)
                              echo "selected";
                          ?>
                          >Pasien Baru</option>
                        </select>
                      </div>
                    </div>

                    <!--nama_dokter-->
                    <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label">Nama Lengkap Pasien</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="nama_pasien" id="nama_pasien" onkeyup="checkStat()"  autocomplete="off" value=<?php echo "\"$booking[nama_pasien]\"";?> required>
                        <input type="hidden" name="id_pasien" id="id_pasien"
                        <?php
                          if($booking['id_pasien'] != null)
                            echo "value=\"$booking[id_pasien]\"";
                        ?>
                        >
                        <div id="livesearch"></div>
                      </div>
                    </div>

                    <!--alamat-->
                    <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label">Tanggal</label>
                      <div class="col-sm-10">
                        <!--<textarea class="form-control" name="alamat" id="alamat" style="max-width: 100%; min-width: 100%"></textarea required>-->
                        <input type="date" class="form-control" name="tanggal" id="tanggal" autocomplete="off" value=<?php echo "\"$booking[tanggal]\"";?> required>
                      </div>
                    </div>

                    <!--tanggal_lahir-->
                    <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label">Jam</label>
                      <div class="col-sm-10">
                        <input type="time" class="form-control" name="jam" id="jam" autocomplete="off" value=<?php echo "\"$booking[jam]\"";?> required>
                      </div>
                    </div>

                    <!--tanggal_lahir-->
                    <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label">Nomor Telpon</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="no_telp" id="no_telp" autocomplete="off" value=<?php echo "\"$booking[no_telp]\"";?> required>
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
                              if($dokter['id_dokter'] == $booking['id_dokter']){
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
