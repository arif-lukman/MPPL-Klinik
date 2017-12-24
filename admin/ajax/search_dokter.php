<?php
	//include
	include "../../connection/connect.php";

	//ambil parameter
	$q = $_GET['q'];

	//ambil data

	$result = $conn->query("SELECT * FROM dokter WHERE nama_dokter LIKE '%$q%' or no_reg_dokter LIKE '%$q%'");
	//echo "SELECT nama_pasien FROM pasien WHERE nama_pasien LIKE '%$q%'";
	//balikin
	$s = "";
	
	while($dokter = $result->fetch_assoc()){
		$s = $s . "
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
	        $s = $s . "<span class=\"label label-success\">aktif</span>";
	      } else {
	        $s = $s . "<span class=\"label label-danger\">non-aktif</span>";
	      }

	      $s = $s . "
              </td>
              <td align =\"right\">
                <a href=\"edit_dokter.php?id_dokter=$dokter[id_dokter]\" class=\"btn btn-primary btn-xs\" role=\"button\"><i class=\"fa fa-pencil\"></i></a>
              
              	<a href=\"act/hapus_dokter.php?id_dokter=$dokter[id_dokter]\" class=\"btn btn-danger btn-xs\" role=\"button\"><i class=\"fa fa-trash-o\"></i></a>
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