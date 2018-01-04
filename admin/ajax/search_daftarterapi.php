<?php
	//include
	include "../../connection/connect.php";

	//ambil parameter
	$q = $_GET['q'];

	//ambil data

	$result = $conn->query("SELECT * FROM terapi, kategori_terapi WHERE kategori_terapi.id_kategori_terapi = terapi.kategori and nama_terapi LIKE '%$q%'");
	//echo "SELECT nama_pasien FROM pasien WHERE nama_pasien LIKE '%$q%'";
	//balikin
	$s = "";
	
	while($terapi = $result->fetch_assoc()){
		$s = $s . "
                   <tr>
                      <td>
                        $terapi[nama_terapi]
                      </td>
                      <td>
                        $terapi[nama_kategori_terapi]
                      </td>
                      <td>
                        $terapi[tarif_min]
                      </td>
                      <td>
                        $terapi[tarif_max]
                      </td>
                      <td align =\"right\">
                        <a href=\"edit_terapi.php?id_terapi=$terapi[id_terapi]\" class=\"btn btn-primary btn-xs\" role=\"button\"><i class=\"fa fa-pencil\"></i></a>
                        
                        <a href=\"act/hapus_terapi.php?id_terapi=$terapi[id_terapi]\" class=\"btn btn-danger btn-xs\" role=\"button\"><i class=\"fa fa-trash-o\"></i></a>
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