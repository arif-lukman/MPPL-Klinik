<?php
	/*<============================================================Constants==================================================================>*/
	//konstanta buat navbar 1
	define("NAVBAR", 
		"
		<nav class='navbar navbar-inverse navbar-fixed-top'>
			<div class='container-fluid'>
				<ul class='nav navbar-nav'>
					<li><a href='../admin/main_menu.php'>Registrasi</a></li>
					<li><a href='../admin/companies.php'>Data Perusahaan</a></li>
					<li><a href='../admin/proposals.php'>Status Pengajuan</a></li>
					<li><a href='../admin/expiry.php'>Kadaluarsa</a></li>
					<li><a href='../admin/cfg_gen.php'>Admin</a></li>
					<li><a href='#''>Bantuan</a></li>
				</ul>
				<ul class='nav navbar-nav navbar-right'>
					<li><a href='../controller/logout.php'>Logout</a></li>
				</ul>
			</div>
		</nav>
		");

	//konstanta buat navbar 2
	define("NAVBAR2", 
		"
		<nav class='navbar navbar-inverse navbar-fixed-top'>
			<div class='container-fluid'>
				<ul class='nav navbar-nav'>
					<li><a href='../admin/companies.php'>Data Perusahaan</a></li>
					<li><a href='../admin/proposals.php'>Status Pengajuan</a></li>
					<li><a href='../admin/expiry.php'>Kadaluarsa</a></li>
					<li><a href='#''>Bantuan</a></li>
				</ul>
				<ul class='nav navbar-nav navbar-right'>
					<li><a href='../controller/logout.php'>Logout</a></li>
				</ul>
			</div>
		</nav>
		");

	//konstanta buat menu admin
	define("MENU", 
		"
		<!--menu panel-->
			<div class='col-sm-3'>
				<div class='panel-group lp' id='accordion'>
				  <div class='panel panel-default'>
				    <div class='panel-heading'>
				      <h4 class='panel-title'>
				        <a data-toggle='collapse' data-parent='#accordion' href='#collapse1'>
				        > Umum</a>
				      </h4>
				    </div>
				    <div id='collapse1' class='panel-collapse collapse'>
				      <div class='panel-body'>
				      	<ul>
				      		<li><a href='../admin/cfg_gen.php'>Konfigurasi Umum</a></li>
				      		<li><a href='../admin/cfg_reg.php'>Konfigurasi Pendaftaran</a></li>
				      		<li><a href='../admin/cfg_exp.php'>Setting Kadaluarsa</a></li>
				      	</ul>
				      </div>
				    </div>
				  </div>
				  <div class='panel panel-default'>
				    <div class='panel-heading'>
				      <h4 class='panel-title'>
				        <a data-toggle='collapse' data-parent='#accordion' href='#collapse2'>
				        > Group Privileges</a>
				      </h4>
				    </div>
				    <div id='collapse2' class='panel-collapse collapse'>
				      <div class='panel-body'>
				      	<ul>
				      		<li><a href='../admin/admins.php'>User</a></li>
				      		<li><a href='../admin/groups.php'>Group Privileges</a></li>
				      	</ul>
				      </div>
				    </div>
				  </div>
				  <div class='panel panel-default'>
				    <div class='panel-heading'>
				      <h4 class='panel-title'>
				        <a data-toggle='collapse' data-parent='#accordion' href='#collapse3'>
				        > Data Master</a>
				      </h4>
				    </div>
				    <div id='collapse3' class='panel-collapse collapse'>
				      <div class='panel-body'>
				      	<ul>
				      		<li><a href='../admin/typ_cpy.php'>Tipe Perusahaan</a></li>
				      		<li><a href='../admin/typ_ofc.php'>Tipe Kantor</a></li>
				      		<li><a href='../admin/typ_mgr.php'>Tipe Pengurus</a></li>
				      		<li><a href='../admin/typ_doc.php'>Tipe Dokumen</a></li>
				      		<li><a href='../admin/typ_doc+.php'>Tipe Dokumen Tambahan</a></li>
				      		<li><a href='../admin/typ_afc.php'>Tipe Afiliasi</a></li>
				      		<li><a href='../admin/typ_scp.php'>Tipe Bidang Pekerjaan</a></li>
				      		<li><a href='../admin/typ_cls.php'>Tipe Klasifikasi Perusahaan</a></li>
				      		<li><a href='../admin/typ_qual.php'>Tipe Kualifikasi Perusahaan</a></li>
				      		<li><a href='../admin/country.php'>Negara</a></li>
				      		<li><a href='../admin/province.php'>Propinsi</a></li>
				      		<li><a href='../admin/bank.php'>Bank</a></li>
				      		<li><a href='../admin/currency.php'>Mata Uang</a></li>
				      		<li><a href='../admin/distributor.php'>Distributor</a></li>
				      	</ul>
				      </div>
				    </div>
				  </div>
				</div>
			</div>
		");

	/*<==========================================================Function umum================================================================>*/
	//fungsi buat inisialisasi head
	function initHead(){
		echo "
		<title>SPR Langgak</title>

		<!-- Latest compiled and minified CSS -->
		<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>

		<!-- jQuery library -->
		<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>

		<!-- Latest compiled JavaScript -->
		<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>

		<!-- CSS Overriding -->
		<style type='text/css'>
			.dis{
				text-decoration: underline;
			}
		</style>
		";
	}

	//fungsi buat bikin koneksi ke db
	function createConnection($servername, $username, $password, $dbname){
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		}
		else{
			return $conn;
		}
	}

	/*<=====================================================Function buat multiform===========================================================>*/

	//fungsi cek yes/no
	function check($value){
		if($value){
			return "selected";
		}
	}

	//fungsi set teks tombol
	function setButtonText($op){
		if($op == "update"){
			return "Update";
		}
		else{
			return "Create";
		}
	}

	//fungsi set target form
	function setTarget($op, $id){
		if($op == "update")
			return "../controller/admins.php?op=update&id=" . $id;
		else
			return "../controller/admins.php?op=create";
	}

	//fungsi cek yes/no
	function checkBox($field){
		if($field){
			return "checked";
		}
	}

	//fungsi buat eksekusi sql command
	function getResults($sql,$conn){
		$result = $conn->query($sql);
		return $result;
	}

	//fungsi buat nge-push array
	function pushArray($result){
		$all_prop = array();
		while ($prop = mysqli_fetch_field($result)){
			array_push($all_prop, $prop->name);
		}
		return $all_prop;
	}

	//fungsi eksekusi operasi CUD(Create, Update, Delete)
	function execCud($sql, $conn, $location){
		if ($conn->query($sql) === TRUE) {
			echo "<script> alert('Saving Data Success');
			location='" . $location . "';
			</script>";
		} else {
		    echo "Saving Data Failed" . $sql . "<br>" . $conn->error;
		}
	}

	//fungsi eksekusi banyak operasi CUD(Create, Update, Delete)
	function execCudMulti($sql, $conn, $location){
		if ($conn->multi_query($sql) === TRUE) {
			echo "<script> alert('Saving Data Success');
			location='" . $location . "';
			</script>";
		} else {
		    echo "Saving Data Failed" . $sql . "<br>" . $conn->error;
		}
	}

	//fungsi buat generate tabel
	function generateTable($fieldNames, $fieldValues, $allValues, $targetPhp, $editable){
		echo "
		<table class='table table-bordered'>
			<thead>
				<tr>
		";
				while ($colNames = $fieldNames->fetch_assoc()){
					echo "
					<th>$colNames[Field]</th>
					";
				}
		echo "
				</tr>
			</thead>
			<tbody>
		";
		while($colValues = $fieldValues->fetch_assoc()){
			echo "<tr>";
			foreach($allValues as $item){
				echo "<td>$colValues[$item]</td>";
			}
			if($editable){
				echo "
				<td><a href=\"../forms/" . $targetPhp . "?op=update&id=$colValues[_id]\">edit</a></td>
				<td><a href=\"../controller/" . $targetPhp . "?op=delete&id=$colValues[_id]\">delete</td>
				";
			}
			echo "</tr>";
		}
		echo "
			</tbody>
		</table>
		";
	}

	//fungsi buat generate tabel
	function generateTableGO($fieldNames, $fieldValues, $allValues, $targetPhp, $editable, $info){
		echo "
		<table class='table table-bordered'>
			<thead>
				<tr>
		";
				while ($colNames = $fieldNames->fetch_assoc()){
					echo "
					<th>$colNames[Field]</th>
					";
				}
		echo "
				</tr>
			</thead>
			<tbody>
		";
		while($colValues = $fieldValues->fetch_assoc()){
			echo "<tr>";
			foreach($allValues as $item){
				echo "<td>$colValues[$item]</td>";
			}
			if($editable){
				echo "
				<td><a href=\"../forms/" . $targetPhp . "?op=update&id=$colValues[_id]\">edit</a></td>
				<td><a href=\"../controller/" . $targetPhp . "?op=delete&id=$colValues[_id]\">delete</td>
				";
			}
			if($info){
				echo "
				<td><a href=\"../admin/" . $targetPhp . "?id=$colValues[_id]\">info</a></td>
				";
			}
			echo "</tr>";
		}
		echo "
			</tbody>
		</table>
		";
	}

	//fungsi buat bikin navbar
	function createNavbar($content){
		echo $content;
	}

	//fungsi buat bikin menu
	function createMenu($content){
		echo $content;
	}

	//fungsi buat ngeset link navbar jadi aktif
	function setActiveNav($targetStr, $targetPhp){
		$search = "<li><a href='../admin/" . $targetPhp . "'>";
		$replace = "<li class='active'><a href='../admin/" . $targetPhp . "'>";
		$replacedStr = str_replace($search, $replace, $targetStr);
		return $replacedStr;
	}

	//fungsi buat ngeset link menu jadi aktif
	function setActiveMenu($targetStr, $targetPhp, $panelNum){
		//linknya diaktifin
		$search = "<li><a href='../admin/" . $targetPhp . "'>";
		$replace = "<li class='dis'><a href='../admin/" . $targetPhp . "'>";
		$replacedActive = str_replace($search, $replace, $targetStr);

		//panel dimana linknya aktif di collpase biar link aktifnya keliatan
		$search2 = "<div id='collapse" . $panelNum . "' class='panel-collapse collapse'>";
		$replace2 = "<div id='collapse" . $panelNum . "' class='panel-collapse collapse in'>";
		$replacedStr = str_replace($search2, $replace2, $replacedActive);
		return $replacedStr;
	}

	//fungsi buat bikin input field
	function createInputField($type, $label, $name, $id, $value, $class, $warn, $warningText){
		//tambahin dulu atribut-atributnya
		if($warn)
			$warning = "<p class='text-warning'>" . $warningText . "</p>";
		else
			$warning = "";
		
		$inputField = "
			<div class='form-group " . $class . "'>
		  		<label for='" . $id . "'>" . $label . "</label>
			  	<input type='" . $type . "' class='form-control' name='" . $name . "' id='" . $id . "' value='" . $value . "' required>
			  	" . $warning . "
			</div>
		";
		return $inputField;
	}

	//fungsi buat bikin input field
	function createInputFieldB($type, $label, $name, $id, $value, $class, $warn, $warningText){
		//tambahin dulu atribut-atributnya
		if($warn)
			$warning = "<p class='text-warning'>" . $warningText . "</p>";
		else
			$warning = "";
		
		$inputField = "
			<div class='form-group " . $class . "'>
		  		<label for='" . $id . "'>" . $label . "</label>
			  	<input type='" . $type . "' class='form-control' name='" . $name . "' id='" . $id . "' value='" . $value . "'>
			  	" . $warning . "
			</div>
		";
		return $inputField;
	}

	//fungsi buat bikin textarea
	function createTextArea($rows, $label, $name, $id, $value, $class, $warn, $warningText){
		if($warn)
			$warning = "<p class='text-warning'>" . $warningText . "</p>";
		else
			$warning = "";
		
		$textArea = "
		<div class='form-group " . $class . "'>
	  		<label for='" . $id . "'>" . $label . "</label>
		  	<textarea class='form-control' rows='" . $rows . "' id='" . $id . "' name='" . $name . "'>" . $value . "</textarea>
		  	" . $warning . "
		</div>
		";
		return $textArea;
	}

	//fungsi buat bikin JS Array dari database
	function createJSArray($sql, $conn){
		$jsarray = array();
		$jsarraystring = "";
		$result = getResults($sql, $conn);
		while($data = $result->fetch_assoc()){
			$jsarraystring = "{display: \"" . $data["_name"] . "\", value: \"" . $data["_name"] . "\"}";
			array_push($jsarray, $jsarraystring);
		}
		return implode(",
			", $jsarray);
	}

	//fungsi buat bikin fungsi JS onchange
	function createFunction($sql, $conn, $name){
		$result = getResults($sql, $conn);
		$cases = "";
		while($data = $result->fetch_assoc()){
			$cases .= "case '" . $data["_name"] . "':
            list(" . $data["_name"] . ");
            break;
            ";
		}
		$function = "
			\$(\"" . $name . "\").change(function(){
				var parent = $(this).val();
				switch(parent){
					"
				. $cases .
				"}
			});
		";
		return $function;
	}

	//fungsi buat bikin select option
	function createSelectOptionByName($label, $id, $name, $default, $conn, $sql, $allowChecking, $param, $class, $warn, $warningText, $js){
		//ambil list group
		$options = "";
		$default = "<option disabled selected hidden>" . $default . "</option>";
		if($sql != ""){
			$result1 = getResults($sql, $conn);
			while($data1 = $result1->fetch_assoc()){
				if($allowChecking && ($param == $data1["_name"] || $param == $data1["_id"])){
					$options = $options . "<option selected>" . $data1["_name"] . "</option>";
				}
				else{
					$options = $options . "<option>" . $data1["_name"] . "</option>";
				}
			}
		}

		if($warn)
			$warning = "<p class='text-warning'>" . $warningText . "</p>";
		else
			$warning = "";

		$selectOption = "
		<div class='form-group " . $class . "'>
	  		<label for='" . $id . "'>" . $label . "</label>
		  	<select class='form-control' id='" . $id . "' name='" . $name . "' " . $js . ">
		  	" . $default . $options . "
			</select>
			" . $warning . "
		</div>
		";
		return $selectOption;
	}

	//fungsi buat bikin select option
	function createSelectOptionById($label, $id, $name, $default, $conn, $sql, $allowChecking, $param, $class, $warn, $warningText, $js){
		//ambil list group
		$options = "";
		$default = "<option disabled selected hidden>" . $default . "</option>";
		if($sql != ""){
			$result1 = getResults($sql, $conn);
			while($data1 = $result1->fetch_assoc()){
				if($allowChecking && ($param == $data1["_name"] || $param == $data1["_id"])){
					$options = $options . "<option value='" . $data1["_id"] . "' selected>" . $data1["_name"] . "</option>";
				}
				else{
					$options = $options . "<option value='" . $data1["_id"] . "'>" . $data1["_name"] . "</option>";
				}
			}
		}

		if($warn)
			$warning = "<p class='text-warning'>" . $warningText . "</p>";
		else
			$warning = "";

		$selectOption = "
		<div class='form-group " . $class . "'>
	  		<label for='" . $id . "'>" . $label . "</label>
		  	<select class='form-control' id='" . $id . "' name='" . $name . "' " . $js . ">
		  	" . $default . $options . "
			</select>
			" . $warning . "
		</div>
		";
		return $selectOption;
	}

	//fungsi buat ngambil parameter get kalau ada
	function getParamGet($paramGet){
		if(isset($_GET[$paramGet])){
			$param = $_GET[$paramGet];
			return $param;
		}
	}

	//fungsi buat ngambil parameter post kalau ada
	function getParamPost($paramPost){
		if(isset($_POST[$paramPost])){
			$param = $_POST[$paramPost];
			return $param;
		}
	}

	//fungsi buat cek operasi
	function checkOperation($op, $sqlC, $sqlU, $sqlD){
		if($op == "create" || $op == "update"){
			if($op == "create"){
				return $sqlC;
			}
			else if($op == "update"){
				return $sqlU;
			}
		}
		else if($op == "delete"){
			return $sqlD;
		}
	}

	//fungsi buat assign nilai form
	function checkData($data, $key){
		if(isset($data[$key])){
			return $data[$key];
		}
		else{
			return "";
		}
	}

	//fungsi buat download attachment
	function downloadFile($tableName, $fileId, $conn){
		$sql = "SELECT * FROM " . $tableName . " WHERE  id = " . $fileId;
		//echo $sql;
		$data = getResults($sql, $conn)->fetch_assoc();
		$filesize = $data['filesize'];
		$type = $data['type'];
		$filename = $data['filename'];
		$content = $data['data'];
		//echo $filesize . $type . $filename . $content;
		header("Content-length: $filesize");
	    header("Content-type: $type");
	    header("Content-Disposition: attachment; filename=$filename");
	    ob_clean();
	    flush();
	    echo $content;
	}
?>