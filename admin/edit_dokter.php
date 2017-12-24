<?php
  //Library
  include "../connection/connect.php";
  include "../process/session_check.php";

  //Ambil data
  $userData = GetData($conn, SelectTarget($_SESSION['tgt']));
  $dataDokter = $conn->query("SELECT * FROM dokter, user_klinik WHERE dokter.id_user_klinik = user_klinik.id_user_klinik AND dokter.id_dokter = $_GET[id_dokter]");
  //echo "SELECT * FROM dokter, detail_akun_dokter, user_klinik WHERE dokter.id_dokter = detail_akun_dokter.id_dokter AND detail_akun_dokter.id_user_klinik = user_klinik.id_user_klinik AND dokter.id_dokter = $_GET[id_dokter]";
  $dokter = $dataDokter->fetch_assoc();
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

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- my script -->
    <script type="text/javascript">
      //JS Biasa
      function CekForm(){
        if(confirm("Apakah anda yakin ingin melanjutkan?")){
          return true;
        } else {
          return false;
        }
      }

      //cek email
      function CekEmail(){
        var mail = document.getElementById("email").value;
        var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
        if (filter.test(mail)) {
          $("#vld-email").html("");
          return true;
        }
        else {
          $("#vld-email").html("<div class=\"col-sm-12 alert alert-danger\">" +
              "Email tidak valid." +
              "<span class=\"glyphicon glyphicon-remove\"></span>" +
            "</div>");
          return false;
        }
      }

      function CekTelpon(){
        var telp = document.getElementById("no_telp").value;
        if(isNaN(telp) || telp === "" || telp === null){
          $("#vld-telp").html("<div class=\"col-sm-12 alert alert-danger\">" +
              "Nomor telpon tidak valid." +
              "<span class=\"glyphicon glyphicon-remove\"></span>" +
            "</div>");
          return false;
        } else {
          $("#vld-telp").html("");
          return true;
        }
      }

      //JQUERY
      $(document).ready(function(){
        //cek telpon valid apa enga
        $("#no_telp").keyup(function(){
          CekTelpon();
        });

        //cek email valid apa enga
        $("#email").keyup(function(){
          CekEmail();
        });

        //validasi form
        $("form").keyup(function(){
          var formFull = false;

          //CEK PENUH ENGGANYA FORM
          //jadiin data form jadi JSON object
          var formValues = $("form").serializeArray().reduce(function(obj, item){
            obj[item.name] = item.value;
            return obj;
          }, {});
          //console.log(formValues);

          //cek satu2 key value dari JSON objectnya
          var count = 0;
          Object.keys(formValues).forEach(function(key){
            //console.log("Key : " + key + ", Value : " + formValues[key]);
            if(formValues[key] != ""){
              count ++;
            }
          });

          //kasih true kalo udah penuh, kasih false kalo belum
          if(count < Object.keys(formValues).length-1){
            //console.log("count : " + count + ", formValues.length : " + Object.keys(formValues).length-1);
            console.log("Form belum penuh");
            formFull = false;
          } else {
            //console.log("count : " + count + ", formValues.length : " + Object.keys(formValues).length-1);
            console.log("Form sudah penuh");
            formFull = true;
          }

          //CEK BENER ENGGANYA FORM
          var telp = false;
          var email = false;

          telp = CekTelpon();
          email = CekEmail();

          //console.log("telp : " + telp);
          //console.log("email : " + email);
          //console.log("username : " + username);
          //console.log("password : " + password);
          //console.log("formFull : " + formFull);

          //GABUNGIN!!!!!
          if(telp && email && formFull){
            $("#submit").prop("disabled", false);
            //console.log("BERHASIL");
          } else {
            $("#submit").prop("disabled", true);
            //console.log("ISI DULU FORMNYA");
          }

        });
      });
    </script>
  </head>

  <body>

  <section id="container" >
      <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
      <!--header start-->
      <header class="header black-bg">
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>
            <!--logo start-->
            <a href="index.html" class="logo"><b>Sistem Informasi Klinik Gigi</b></a>
            <!--logo end-->
            <div class="top-menu">
            	<ul class="nav pull-right top-menu">
                    <li><a class="logout" href="../process/logout.php">Logout</a></li>
            	</ul>
            </div>
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
              
              	  <p class="centered"><a href="profile.html"><img src="../assets/img/ui-sam.jpg" class="img-circle" width="60"></a></p>
              	  <h5 class="centered"><?php echo $_SESSION['uid']?></h5>

                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-desktop"></i>
                          <span>DATABASE</span>
                      </a>
                      <ul class="sub">
                          <li><a href="dokter.php">Dokter</a></li>
                          <li><a href="perawat.php">Perawat</a></li>
                          <li><a href="admin.php">Admin</a></li>
                          <li><a href="akun.php">Akun Pengguna Sistem</a></li>
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-tasks"></i>
                          <span>LAYANAN</span>
                      </a>
                      <ul class="sub"> 
                          <li><a  href="jasa.php">Daftar Jasa</a></li>
                          <li><a  href="obat.php">Daftar Obat</a></li>
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-users"></i>
                          <span>PASIEN</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="antrian_hari_ini.php">Antrian Hari Ini</a></li>
                          <li><a  href="antrian_semua.php">Antrian Keseluruhan</a></li>
                          <li><a  href="booking.php">Booking</a></li>
                          <li><a  href="pasien.php">Data Pasien</a></li>
                      </ul>
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
          	<h2><center>Data Dokter</center></h2>
            <hr>
          	<div class="row mt">
              <div class="col-lg-2">
              </div>
          		<div class="col-lg-8">
            		<center>
                  <div class="form-panel">
                  <h4 class="mb"><center>Penambahan Data Baru</center></h4>
                  <br>

                  <form class="form-horizontal style-form" method="post" action = <?php echo "\"act/edit_dokter.php?id_dokter=$dokter[id_dokter]\""?>>

                    <!--nama_dokter-->
                    <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label">Nama Dokter</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="nama_dokter" id="nama_dokter" value=<?php echo "\"$dokter[nama_dokter]\"";?> autocomplete="off" required>
                      </div>
                    </div>

                    <!--no_reg_dokter-->
                    <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label">Nomor Registrasi Dokter</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="no_reg_dokter" id="no_reg_dokter" value=<?php echo "\"$dokter[no_reg_dokter]\"";?> autocomplete="off">
                      </div>
                    </div>

                    <!--alamat-->
                    <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label">Alamat</label>
                      <div class="col-sm-10">
                        <textarea class="form-control" name="alamat" id="alamat" style="max-width: 100%; min-width: 100%"><?php echo "$dokter[alamat]";?></textarea autocomplete="off" required>
                      </div>
                    </div>

                    <!--tanggal_lahir-->
                    <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label">Tanggal Lahir</label>
                      <div class="col-sm-10">
                        <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir" value=<?php echo "\"$dokter[tanggal_lahir]\"";?> autocomplete="off" required>
                      </div>
                    </div>

                    <!--jenis_kelamin-->
                    <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label">Jenis Kelamin</label>
                      <div class="radio col-sm-10">
                      <label>
                        <input type="radio" name="jenis_kelamin" id="optionsRadios1" value="L" required 
                        <?php 
                          if($dokter['jenis_kelamin'] == "L"){
                            echo "checked";
                          }
                        ?>
                        >
                      Laki-laki
                      </label>
                      <label>
                        <input type="radio" name="jenis_kelamin" id="optionsRadios2" value="P"
                        <?php 
                          if($dokter['jenis_kelamin'] == "P"){
                            echo "checked";
                          }
                        ?>
                        >
                      Perempuan
                      </label>
                      </div>
                    </div>

                    <!--nomor_telpon-->
                    <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label">Nomor Telpon</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="no_telp" id="no_telp" value=<?php echo "\"$dokter[no_telp]\"";?> autocomplete="off" required>
                        <span id="vld-telp"></span>
                      </div>
                    </div>

                    <!--email-->
                    <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label">Email</label>
                      <div class="col-sm-10">
                        <input type="email" class="form-control" name="email" id="email" value=<?php echo "\"$dokter[email]\"";?> autocomplete="off" required>
                        <span id="vld-email"></span>
                        <span class="help-block">contoh : email@example.com</span>
                      </div>
                    </div>

                    <!--status-->
                    <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label">Status</label>
                      <div class="col-sm-10">
                        <select class="form-control" name="status" id="status" required>
                          <option value="1">Aktif</option>
                          <option value="2">Pasif</option>
                        </select>
                      </div>
                    </div>

                    <center><button class="btn btn-theme" type="submit" name="submit" id="submit" disabled="false">Submit</button></center>
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
