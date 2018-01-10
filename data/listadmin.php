<?php
/* Database connection start */
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbroit";

$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());

/* Database connection end */


// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;


$columns = array( 
// datatable column index  => database column name
	0 =>'adm_fullname', 
	1 => 'adm_username',
	2 => 'adm_status'
	);

// getting total number records without any search
$sql = "SELECT * ";
$sql.=" FROM admin  ";
$query=mysqli_query($conn, $sql) or die("listproduk-data.php: get employees");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


$sql = "SELECT * ";
$sql.=" FROM admin WHERE 1=1";
if( !empty($requestData['search']['value']) ) {  
	$sql.=" AND ( adm_fullname LIKE '".$requestData['search']['value']."%' ";    
	$sql.=" OR adm_username LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR adm_status LIKE '".$requestData['search']['value']."%' )";
}
$query=mysqli_query($conn, $sql) or die("listproduk-data.php: get employees");
$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */	
$query=mysqli_query($conn, $sql) or die("listproduk-data.php: get employees");

$data = array();
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	$nestedData=array(); 
	$full =  $row["adm_fullname"];
	$nestedData[] = $full;
	$nestedData[] = $row["adm_username"];
	if($row["adm_status"]=="Y"){
		$nestedData[] = 
		" <a href='../helper/admin.php?aksi=nonaktifkan&user=".$row["adm_username"]."' class='tombol' >Nonaktifkan</a>|<a href='ubah.php?jenis=admin&username=".$row["adm_username"]."' class='tombol' style='background-color: #d6d94f;' >Ubah Data</a>";
	}else{
		$nestedData[] = 
		" <a href='../helper/admin.php?aksi=aktifkan&user=".$row["adm_username"]."' class='tombol' style='background-color: #4fd99a;'>Aktifkan</a>";
	}

	$data[] = $nestedData;
}



$json_data = array(
"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
"recordsTotal"    => intval( $totalData ),  // total number of records
"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
"data"            => $data   // total data array
);

echo json_encode($json_data);  // send data as json format

?>
