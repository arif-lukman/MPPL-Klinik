<?php
  //Library
  include "../connection/connect.php";
  include "../process/session_check.php";

  //Ambil data
  $userData = GetData($conn, "SELECT * FROM user_klinik WHERE username = '$_SESSION[uid]'");
  //echo SelectTarget($_SESSION['tgt']);

  //Fungsi
  function SelectTarget($usrType){
    switch ($usrType) {
      case 1:
        //Admin
        echo "SELECT * FROM user_klinik WHERE username = '$_SESSION[uid]'";
        return "SELECT * FROM user_klinik WHERE username = '$_SESSION[uid]'";
        break;
      case 2:
        //Dokter
        echo "SELECT * FROM user_klinik WHERE username = '$_SESSION[uid]'";
        return "SELECT * FROM dokter WHERE username = '$_SESSION[uid]'";
        break;
      case 3:
        //Perawat
        echo "SELECT * FROM user_klinik WHERE username = '$_SESSION[uid]'";
        return "SELECT * FROM perawat WHERE username = '$_SESSION[uid]'";
        break;
    }
  }

  function GetData($conn, $sql){
    $result = $conn -> query($sql);
    if (!$result) {
      trigger_error('Invalid query: ' . $conn->error);
    }
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


    <!-- coba pake tombol remove, ini scriptnya-->
    <script>
      $(document).ready(function(){
        $("#btn-hapus").live('click', function () {
          $("#ap").remove();
        });
      });
    </script>
    <!--akhir script remove-->

    <script>
    $(document).ready(function(){
        $("#btn-tarif").click(function(){
            $("#appendtarif").append("<div class='ap'> \n" +
              "<br><br><br><label class='col-sm-2 control-label'>Terapi</label> \n" +
        "<div class='col-sm-4'> \n" +
          "<select class='form-control' id='tindakan'> \n" +
            "<option value=''>tindakan 1</option> \n" +
          "</select> \n" +
          "</div> \n" +
              "<label class='col-sm-1 control-label'>Tarif</label> \n" +
              "<div class='col-sm-4'> \n" +
                "<input type='text' class='form-control' name='tarif' id='tarif' required> \n" +
              "</div> \n"+
              //"<div class='col-sm-1'> \n" +
                //"<input type='button' class='btn' name='btn-hapus' id='btn-hapus' value='-'> \n" +
              //"</div> \n"+
            "</div>");
        })
    });
    </script>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

  <section id="container" >
      <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
      <!--header start-->
      <header class="header blue-bg">
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>
            <!--logo start-->
            <a href="index.php" class="logo"><b>Sistem Informasi Klinik Gigi</b></a>
            <!--logo end-->

        </header>
      <!--header end-->

      <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
               <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">

              	  <p class="centered"><a href="profile.php"><img src="../assets/img/ui-sam.jpg" class="img-circle" width="60"></a></p>
              	  <h5 class="centered"><?php echo $_SESSION['uid']?></h5>

                  <li class="sub-menu">
                      <a href="profile.php" >
                          <i class="fa"></i>
                          <span>PROFILE</span>
                      </a>
                  </li>
                  <li class="sub-menu">
                      <a href="antrian.php" >
                          <i class="fa"></i>
                          <span>ANTRIAN</span>
                      </a>
                  </li>
                  <li class="sub-menu">
                      <a href="../process/logout.php" >
                          <i class="fa fa-sign-out"></i>
                          <span>LOGOUT</span>
                      </a>
                  </li>

              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->

      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
          	<div class="row mt">
              <div class="col-lg-2">
              </div>
          		<div class="col-lg-8">
            		<center>

                  <!--menu tabs-->
                  <ul class="nav nav-tabs">
                    <li class="active"><a href="index.php">Rekam Medis</a></li>
                    <li><a href="#">Riwayat Rekam Medis</a></li>
                  </ul>
                  <!-- end tabs-->

                  <div class="form-panel">
                  <h4 class="mb"><center>Diagnosa Pasien</center></h4>
                  <br>
                  <form class="form-horizontal style-form" method="post" action = "act/diagnosa.php">

                    <!--no rekam medis pasien-->
                    <div class="form-group">
                      <label class="col-sm-2 control-label">No Rekam Medis</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="no_rekam_medis" id="no_rekam_medis" required>
                      </div>
                    </div>

                    <!--diagnosa dokter-->
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Diagnosa</label>
                      <div class="col-sm-10">
                        <textarea class="form-control" name="diagnosa" id="diagnosa" style="max-width: 100%; min-width: 100%"></textarea required>
                      </div>
                    </div>

                    <!--Form terapi-->
                      <div class="form-group">
                        <div id="appendtarif" class="col-sm-12">
                        <label class="col-sm-2 control-label">Terapi</label>

                    <!--menu drop down jenis tindakan-->
                    <div class="col-sm-4">
                      <select class="form-control" id="tindakan">
                        <option value="">tindakan 1</option>
                      </select>
                      </div>
                      <!-- end menu drop down jenis tindakan-->

                          <!--tarif-->
                          <label class="col-sm-1 control-label">Tarif</label>
                          <div class="col-sm-4">
                            <input type="text" class="form-control" name="tarif" id="tarif" required>
                          </div>

                          <div class="col-sm-1">
                            <input type="button" class="btn" name="btn-tarif" id="btn-tarif" value="+">
                          </div>
                          </div>
                        </div>
                        <!--end form terapi-->

                      <!--form keterangan-->
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Keterangan</label>
                        <div class="col-sm-10">
                          <textarea class="form-control" name="keterangan" id="keterangan" style="max-width: 100%; min-width: 100%"></textarea>
                        </div>
                      </div>
                      <!-- end form keterangan-->

                      <!--menu drop down jenis tindakan-->
                      <div class="form-group">
                          <label class="col-sm-2 control-label">Pilih Obat</label>
                        <div class="col-sm-4">
                          <select class="form-control" id="tindakan">
                            <option value="">tindakan 1</option>
                          </select>
                        </div>
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

  <script>
      //custom select box

      $(function(){
          $('select.styled').customSelect();
      });

  </script>

  </body>
</html>
