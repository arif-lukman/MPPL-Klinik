<?php
	//include
	include "../../connection/connect.php";

	//ambil parameter
	$q = $_GET['q'];

	//ambil data

	$result = $conn->query("SELECT * FROM admin WHERE nama_admin LIKE '%$q%'");
	//echo "SELECT nama_pasien FROM pasien WHERE nama_pasien LIKE '%$q%'";
	//balikin
	$s = "";
	
	while($admin = $result->fetch_assoc()){
		$s = $s . "
                    <tr>
                      <td>
                        $admin[nama_admin]
                      </td>
                      <td>
                        $admin[alamat]
                      </td>
                      <td>
                        $admin[tanggal_lahir]
                      </td>
                      <td>
                        $admin[jenis_kelamin]
                      </td>
                      <td>
                        $admin[no_telp]
                      </td>
                      <td>
                        $admin[email]
                      </td>
                      <td align =\"center\">
                  ";

	      if($admin['status'] === '1'){
	        //echo "Aktif";
	        $s = $s . "<span class=\"label label-success\">aktif</span>";
	      } else {
	        $s = $s . "<span class=\"label label-danger\">non-aktif</span>";
	      }

	      $s = $s . "
              </td>
              <td align =\"right\">
                <a href=\"edit_admin.php?id_admin=$admin[id_admin]\" class=\"btn btn-primary btn-xs\" role=\"button\"><i class=\"fa fa-pencil\"></i></a>
              
              	<a href=\"act/hapus_admin.php?id_admin=$admin[id_admin]\" class=\"btn btn-danger btn-xs\" role=\"button\"><i class=\"fa fa-trash-o\"></i></a>
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