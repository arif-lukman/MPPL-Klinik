<?php
	$headbar = "
		<!--HEADBAR START-->
		<header class=\"header purple1-bg\">
	        <div class=\"sidebar-toggle-box\">
	            <div class=\"fa fa-bars tooltips\" data-placement=\"right\" data-original-title=\"Toggle Navigation\"></div>
	        </div>
	        <!--logo start-->
	        <a href=\"index.php\" class=\"logo\"><b>Sistem Informasi Riona Dental Care</b></a>
	        <!--logo end-->
	        <div id=\"waktu\" class=\"waktu\" 
	          style=\"
	            font-size: 20px;
	            color: #ffffff;
	            float: right;
	            margin-top: 15px;
	          \"
	        ></div>
      	</header>
      	<!--HEADBAR END-->
	";

	$sidebar = "
		<!--SIDEBAR START-->
		<aside>
        	<div id=\"sidebar\"  class=\"nav-collapse \">
               	<!-- sidebar menu start-->
              	<ul class=\"sidebar-menu\" id=\"nav-accordion\">
              
	          	  	<p class=\"centered\"><a href=\"profile.html\"><img src=\"../assets/img/ui-sam.jpg\" class=\"img-circle\" width=\"60\"></a></p>
	          	  	<h5 class=\"centered\">$_SESSION[uid]</h5>

	      			<li class=\"sub-menu\">
	                  	<a href=\"javascript:;\" >
	                      	<i class=\"fa fa-desktop\"></i>
	                      	<span>DATABASE</span>
	                  	</a>
	                  	<ul class=\"sub\">
	          				<li><a href=\"dokter.php\">Dokter</a></li>
	                      	<li><a href=\"perawat.php\">Perawat</a></li>
	                      	<li><a href=\"admin.php\">Admin</a></li>
	                      	<li><a href=\"satuan_obat.php\">Satuan Obat</a></li>
	                      	<li><a href=\"kategori_terapi.php\">Kategori Terapi</a></li>
	                      	<li><a href=\"akun.php\">Akun Pengguna Sistem</a></li>
	                  	</ul>
	          		</li>
	              	<li class=\"sub-menu\">
	                  	<a href=\"javascript:;\" >
	                      	<i class=\"fa fa-tasks\"></i>
	                      	<span>LAYANAN</span>
	                  	</a>
	                  	<ul class=\"sub\"> 
	                      	<li><a  href=\"terapi.php\">Daftar Terapi</a></li>
	                      	<li><a  href=\"obat.php\">Daftar Obat</a></li>
	                  	</ul>
	              	</li>
	          		<li class=\"sub-menu\">
	                  	<a href=\"javascript:;\" >
	                      	<i class=\"fa fa-users\"></i>
	                      	<span>PASIEN</span>
	                  	</a>
	                  	<ul class=\"sub\">
	                      	<li><a  href=\"antrian_hari_ini.php\">Antrian Hari Ini</a></li>
	                      	<li><a  href=\"antrian_semua.php\">Antrian Keseluruhan</a></li>
	                      	<li><a  href=\"booking.php\">Booking</a></li>
	                      	<li><a  href=\"pasien.php\">Data Pasien</a></li>
	                  	</ul>
	          		</li>
	              	<li class=\"sub-menu\">
	                  	<a href=\"../process/logout.php\" >
	                      	<i class=\"fa fa-sign-out\"></i>
	                      	<span>LOGOUT</span>
	                  	</a>
	              	</li>

          		</ul>
          		<!-- sidebar menu end-->
      		</div>
  		</aside>
  		<!--SIDEBAR START-->
	";
?>