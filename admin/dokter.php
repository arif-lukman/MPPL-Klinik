<?php
  //Library
  include "../connection/connect.php";
  include "../process/session_check.php";
  include "headside.php";

  //Ambil data
  $userData = GetData($conn, SelectTarget($_SESSION['tgt']));
  $dataDokter = $conn->query("SELECT * FROM dokter");
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

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- my script -->
    <script type="text/javascript">
      //JQUERY
      $(document).ready(function(){
        //search
        $("#search").keyup(function(){
          var search = document.getElementById("search").value;

          //console.log("ajax/uname_status.php?uname=" + uname);

          $.get("ajax/search_dokter.php?q=" + search, function(data, status){
            $("tbody").html(data);
          });
        });
      });
    </script>
  </head>

  <body onload="startTime()">

  <section id="container">
    <?php
      //DISPLAY HEADBAR AND SIDEBAR
      echo $headbar;
      echo $sidebar;
    ?>
    <!--MAIN CONTENT START-->
    <section id="main-content">
        <section class="wrapper">
        	<h2><center>Data Dokter</center></h2>
          <hr>
        	<div class="row mt">
        		<div class="col-lg-12">
              
            <form role="search">
              <div class="form-group">
                <div id="tabeldata_filter" class="dataTables_filter">
                  <label>Search:<input type="search" class="form-control input-sm" placeholder="" aria-controls="tabeldata" id="search"></label>
                </div>
              </div>
            </form>
            
        		<table class="table table-striped table-advance table-hover col-lg-12">
            <thead>
              <th>Nama</th>
              <th>Nomor Registrasi</th>
              <th>Alamat</th>
              <th>Tanggal Lahir</th>
              <th>Jenis Kelamin</th>
              <th>Nomor Telpon</th>
              <th>Email</th>
              <th><center>Status</center></th>
            </thead>
            <tbody>
              <?php
              while($dokter = $dataDokter->fetch_assoc()){
                echo "
                  <tr>
                    <td>
                      $dokter[nama_dokter]
                    </td>
                    <td>
                      $dokter[no_reg_dokter]
                    </td>
                    <td>
                      $dokter[alamat]
                    </td>
                    <td>
                      $dokter[tanggal_lahir]
                    </td>
                    <td>
                      $dokter[jenis_kelamin]
                    </td>
                    <td>
                      $dokter[no_telp]
                    </td>
                    <td>
                      $dokter[email]
                    </td>
                    <td align =\"center\">
                ";

                if($dokter['status'] === '1'){
                  //echo "Aktif";
                  echo "<span class=\"label label-success\">aktif</span>";
                } else {
                  echo "<span class=\"label label-danger\">non-aktif</span>";

                }
                 
                echo "
                    </td>
                    <td align =\"right\">
                      <a href=\"edit_dokter.php?id_dokter=$dokter[id_dokter]\" class=\"btn btn-primary btn-xs\" role=\"button\"><i class=\"fa fa-pencil\"></i></a>
                    
                    	<a href=\"act/hapus_dokter.php?id_dokter=$dokter[id_dokter]\" class=\"btn btn-danger btn-xs\" role=\"button\"><i class=\"fa fa-trash-o\"></i></a>
                    </td>
                  </tr>
                ";
              }
              ?>
            </tbody>
            </table>
            <a href="add_dokter.php" style="float: right" class="btn btn-round btn-theme02" role="button">Tambah</a>
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