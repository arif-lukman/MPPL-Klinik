<?php
	$headbar = "
		<!--HEADBAR START-->
		<header class=\"header blue-bg\">
	        <div class=\"sidebar-toggle-box\">
	            <div class=\"fa fa-bars tooltips\" data-placement=\"right\" data-original-title=\"Toggle Navigation\"></div>
	        </div>
	        <!--logo start-->
	        <a href=\"dashboard.php\" class=\"logo\"><img src=\"../assets/img/logordc2.png\" width=\"200\"></a>
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
		<aside>
      	<div id=\"sidebar\"  class=\"nav-collapse \">
	       	<!-- sidebar menu start-->
	      	<ul class=\"sidebar-menu\" id=\"nav-accordion\">
	      
		  	  	<p class=\"centered\"><a href=\"dashboard.php\"><img src=\"../assets/img/ui-sam.jpg\" class=\"img-circle\" width=\"60\"></a></p>
		  	  	<h5 class=\"centered\">$_SESSION[uid]</h5>

		      	<li class=\"sub-menu\">
		          	<a href=\"profile.php\" >
		              	<i class=\"fa fa-user-o\"></i>
		              	<span>PROFILE</span>
		          	</a>
		      	</li>
		      	<li class=\"sub-menu\">
		          	<a href=\"pasien.php\" >
		              	<i class=\"fa fa-users\"></i>
		              	<span>PASIEN</span>
		          	</a>
		      	</li>
		      	<li class=\"sub-menu\">
		          	<a href=\"antrian.php\" >
		              	<i class=\"fa fa-tasks\"></i>
		              	<span>ANTRIAN</span>
		          	</a>
		      	</li>
		      	<li class=\"sub-menu\">
		          	<a href=\"booking.php\" >
		              	<i class=\"fa fa-bell-o\"></i>
		              	<span>BOOKING</span>
		          	</a>
		      	</li>
		      	<li class=\"sub-menu\">
		          	<a href=\"../process/logout.php\" >
		              	<i class=\"fa fa-sign-out\"></i>
		              	<span>LOGOUT</span>
		          	</a>
		      	</li>

	      	</ul>
      	</div>
      	</aside>
	";
?>