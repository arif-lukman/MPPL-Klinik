<?php
	//include
	include "../../connection/connect.php";

	//ambil parameter
	$q = $_GET['q'];

	//ambil data

	$result = $conn->query("SELECT * FROM satuan WHERE nama_satuan LIKE '%$q%'");
	//echo "SELECT nama_pasien FROM pasien WHERE nama_pasien LIKE '%$q%'";
	//balikin
	$s = "";
	
	while($satuan = $result->fetch_assoc()){
		$s = $s . "
                   <tr>
                      <td>
                        $satuan[nama_satuan]
                      </td>
                      </td>
                      <td align =\"right\">
                        <a href=\"edit_satuan.php?id_satuan=$satuan[id_satuan]\" class=\"btn btn-primary btn-xs\" role=\"button\"><i class=\"fa fa-pencil\"></i></a>
                      
                      	<a href=\"act/hapus_satuan.php?id_satuan=$satuan[id_satuan]\" class=\"btn btn-danger btn-xs\" role=\"button\"><i class=\"fa fa-trash-o\"></i></a>
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