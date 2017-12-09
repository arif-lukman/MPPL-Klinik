<?php
date_default_timezone_set("Asia/Jakarta");
$jam = date('Y-m-d | h:i:s');
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
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        
    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<style>
	  
  .modal-header, h4, .close {
      background-color: #333;
      color: #fff !important;
      text-align: center;
      font-size: 30px;
  }
  
  
  
  
  .modal-header, .modal-body {
      padding: 30px 50px;
  }
	</style>
  </head>

  <body onload="getTime()">

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
            <a href="index.html" class="logo"><b>Form Registrasi</b></a>
            <!--logo end-->
           
            <div class="top-menu">
            	<ul class="nav pull-right top-menu">
                    <li><a class="logout" href="login.html">Logout</a></li>
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
              
              	  <p class="centered"><a href="profile.html"><img src="assets/img/ui-sam.jpg" class="img-circle" width="60"></a></p>
              	  <h5 class="centered">Klinik Gigi</h5>
              	  	
                  <li class="mt">
                      <a class="active" href="index.html">
                          <i class="fa fa-dashboard"></i>
                          <span>Dashboard</span>
                      </a>
                  </li>

                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-desktop"></i>
                          <span>ADMIN</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="pendaftaran.html">Pendaftaran Pasien</a></li>
						  <li><a  href="antrian.html">Antrian</a></li>
                          <li><a  href="data_pasien.html">Data Pasien</a></li>
                      </ul>
                  </li>

                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-cogs"></i>
                          <span>DOKTER</span>
                      </a>
                      <ul class="sub"> 
                          <li><a  href="dokter.html">Rekam Medis Pasien</a></li>
                          <li><a  href="list_obat.html">List Obat</a></li>
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-book"></i>
                          <span>PEMBAYARAN</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="pembayaran.html">Pembayaran</a></li>
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-tasks"></i>
                          <span>KARYAWAN</span>
                      </a>
                      
					  <ul class="sub">
                          <li><a  href="form_karyawan.html">Form Pendaftaran Karyawan</a></li>
						  <li><a  href="data_karyawan.html">Data Karyawan</a></li>
                      </ul>
                  </li>
                  
				  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-cogs"></i>
                          <span>EXTRA</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="calendar.html">Calendar</a></li>
                          <li><a  href="gallery.html">Gallery</a></li>
                          <li><a  href="todo_list.html">Todo List</a></li>
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
          <section class="wrapper site-min-height">
          	<h1 class="text-center">PENDAFTARAN</h3>  
				<ul class="nav nav-tabs">
    				<li class="active"><a data-toggle="tab" href="#home">Pendaftaran</a></li>
					<li><a data-toggle="tab" href="#menu1">Form Pendaftaran Pasien</a></li>
					
 				</ul>
				<div class="tab-content">
				    <div id="home" class="tab-pane fade in active table-responsive">
				     
					<table class="table">
						<tr>
							<td><br><br><br><br>
							<input type="image" src="assets/img/pasien-lama.jpg" name ="button" alt="pasien-lama" data-toggle="modal" data-target="#myModal"/></td>
							<td  valign="middle" rowspan="3"><br><br><br><br><br><br><br><br><br> 
							<input type="image" src="assets/img/booking.jpg" name ="button" alt="pasien-lama" /></td>
						</tr>	  
						<tr></tr>
						<tr>
							<td><input type="image" src="assets/img/pasien-baru.jpg" name ="button" alt="pasien-lama" /></td>
						</tr>
						<tr></tr>
						</table>
					</div>
    				<div id="menu1" class="tab-pane fade">
    				  <h2>Chandler Bing, Guitarist</h2>
    				  <p>Always a pleasure people! Hope you enjoyed it as much as I did. Could I BE.. any more pleased?</p>
					</div>
    				
  				</div>
			
		</section><! --/wrapper -->
      </section><!-- /MAIN CONTENT -->

      <!--main content end-->
      <!--footer start-->
      <footer class="site-footer">
          <div class="text-center">
              2014 - Alvarez.is
              <a href="blank.html#" class="go-top">
                  <i class="fa fa-angle-up"></i>
              </a>
          </div>
      </footer>
      <!--footer end-->
	  
	  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
		
          <button type="button" class="close" data-dismiss="modal">		x</button>
          <h4><span class="glyphicon glyphicon-lock"></span> Pendaftaran Pasien Lama</h4>
        </div>
        <div class="modal-body">
          <form role="form">
            <div class="form-group">
              <label for="no_rekam_medis">Nomor Rekam Medis</label>
              <input type="text" class="form-control" id="no_rekam_medis" placeholder="Nomor Rekam Medis">
            </div>
			
            <div class="form-group">
              <label for="jam_layan">Jam Layanan</label>
              <input type="text" class="form-control" id="jam_layan" placeholder="Jam Layanan">
            </div>
			<div class="form-group">
              <label for="jam_layan">Jam Daftar</label>
              <input type="text" class="form-control" id="jam_layan" placeholder="Jam Daftar" value="<?php echo $jam;?>" disabled>
			  <p class="form-control-static"></p>
            </div>
              <button type="submit" class="btn btn-block">Daftar
                <span class="glyphicon glyphicon-ok"></span>
              </button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal">
            <span class="glyphicon glyphicon-remove"></span> Cancel
          </button>
          <p>Need <a href="#">help?</a></p>
        </div>
      </div>
    </div>
  </div>
</div>
	  
  </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery-ui-1.9.2.custom.min.js"></script>
    <script src="assets/js/jquery.ui.touch-punch.min.js"></script>
    <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>


    <!--common script for all pages-->
    <script src="assets/js/common-scripts.js"></script>

    <!--script for this page-->
    
  <script>
      //custom select box

      $(function(){
          $('select.styled').customSelect();
      });

  </script>
  <script>
        function getTime()
        {
            var today=new Date();
            var h=today.getHours();
            var m=today.getMinutes();
            var s=today.getSeconds();
            // add a zero in front of numbers<10
            m=checkTime(m);
            s=checkTime(s);
            document.getElementById('showtime').innerHTML=h+":"+m+":"+s;
            t=setTimeout(function(){getTime()},500);
        }

        function checkTime(i)
        {
            if (i<10)
            {
                i="0" + i;
            }
            return i;
        }
    </script>
  </body>
</html>
