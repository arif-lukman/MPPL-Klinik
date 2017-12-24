<?php
	//include
	include "../../connection/connect.php";

	//ambil parameter
	$q = $_GET['q'];

	//ambil data

	$result = $conn->query("SELECT * FROM perawat WHERE nama_perawat LIKE '%$q%' or no_reg_perawat LIKE '%$q%'");
	//echo "SELECT nama_pasien FROM pasien WHERE nama_pasien LIKE '%$q%'";
	//balikin
	$s = "";
	
	while($perawat = $result->fetch_assoc()){
		$s = $s . "
                    <tr>
                      <td>
                        $perawat[nama_perawat]
                      </td>
                      <td>
                        $perawat[no_reg_perawat]
                      </td>
                      <td>
                        $perawat[alamat]
                      </td>
                      <td>
                        $perawat[tanggal_lahir]
                      </td>
                      <td>
                        $perawat[jenis_kelamin]
                      </td>
                      <td>
                        $perawat[no_telp]
                      </td>
                      <td>
                        $perawat[email]
                      </td>
                      <td align =\"center\">
                  ";

	      if($perawat['status'] === '1'){
	        //echo "Aktif";
	        $s = $s . "<span class=\"label label-success\">aktif</span>";
	      } else {
	        $s = $s . "<span class=\"label label-danger\">non-aktif</span>";
	      }

	      $s = $s . "
              </td>
              <td align =\"right\">
                <a href=\"edit_perawat.php?id_perawat=$perawat[id_perawat]\" class=\"btn btn-primary btn-xs\" role=\"button\"><i class=\"fa fa-pencil\"></i></a>
              
              	<a href=\"act/hapus_perawat.php?id_perawat=$perawat[id_perawat]\" class=\"btn btn-danger btn-xs\" role=\"button\"><i class=\"fa fa-trash-o\"></i></a>
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