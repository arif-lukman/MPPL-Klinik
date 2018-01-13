<?php
	//include
	include "../../connection/connect.php";

	//ambil parameter
	$q = $_GET['q'];

	//ambil data

	$result = $conn->query("SELECT * FROM pasien WHERE nama_pasien LIKE '%$q%'");
	//echo "SELECT nama_pasien FROM pasien WHERE nama_pasien LIKE '%$q%'";
	//balikin
	$s = "";
	
	while($pasien = $result->fetch_assoc()){
		$s = $s . "
                   <tr>
                      <td>
                        <a href=\"rekam_medis.php?id_pasien=$pasien[id_pasien]\">$pasien[nama_pasien]</a>
                      </td>
                      <td>
                        $pasien[alamat]
                      </td>
                      <td>
                        $pasien[tanggal_lahir]
                      </td>
                      <td>
                        $pasien[pekerjaan]
                      </td>
                      <td>
                        $pasien[no_telp]
                      </td>
                      <td>
                        $pasien[jenis_kelamin]
                      </td>
                      <td>
                        $pasien[no_rekam_medis]
                      </td>
                      <td align =\"right\">
                        <a href=\"edit_pasien.php?id_pasien=$pasien[id_pasien]\" class=\"btn btn-primary btn-xs\" role=\"button\"><i class=\"fa fa-pencil\"></i></a>
                      
                        <a href=\"act/hapus_pasien.php?id_pasien=$pasien[id_pasien]\" class=\"btn btn-danger btn-xs\" role=\"button\"><i class=\"fa fa-trash-o\"></i></a>
                      </td>
                    </tr>
                  ";
	}

	echo $s;

	//Fungsi
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