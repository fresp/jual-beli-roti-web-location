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
	0 =>'lpk_username', 
	1 => 'pro_name',
	2 => 'pro_description',
	3 => 'pro_status'
);

// getting total number records without any search
$sql = "SELECT l.lpk_username, p.pro_name, p.pro_description,p.pro_status";
$sql.=" FROM produk  p INNER JOIN lapak l ON l.lpk_id=p.lpk_id";
$query=mysqli_query($conn, $sql) or die("listproduk-data.php: get employees");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


$sql = "SELECT l.lpk_username, p.pro_name, p.pro_description,p.pro_status,p.pro_id";
$sql.=" FROM produk  p INNER JOIN lapak l ON l.lpk_id=p.lpk_id WHERE 1=1";
if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
	$sql.=" AND ( lpk_username LIKE '".$requestData['search']['value']."%' ";    
	$sql.=" OR pro_name LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR pro_status LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR pro_description LIKE '".$requestData['search']['value']."%' )";
}
$query=mysqli_query($conn, $sql) or die("listproduk-data.php: get employees");
$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */	
$query=mysqli_query($conn, $sql) or die("listproduk-data.php: get employees");

$data = array();
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	$nestedData=array(); 

	$nestedData[] = $row["lpk_username"];
	$nestedData[] = $row["pro_name"];
	$nestedData[] = $row["pro_description"];
	$nestedData[] = $row["pro_status"];
	if($row["pro_status"]=="review"){
		$nestedData[] = 
		" <a href='?idp=".$row["pro_id"]."' class='tombol' style='background-color: #d6d94f;'>LIHAT</a>";
	}elseif($row["pro_status"]=="dijual"){
		$nestedData[] = 
		"<a href='../helper/produk.php?aksi=tidak&idp=".$row["pro_id"]."' class='tombol'>Nonaktifkan</a>";
	}elseif($row["pro_status"]=="tidak"){
		$nestedData[] = 
		" <a href='../helper/produk.php?aksi=dijual&idp=".$row["pro_id"]."' class='tombol' style='background-color: #4fd99a;'>Aktifkan</a>";
	}elseif($row["pro_status"]=="diblokir"){
		$nestedData[] = 
		" <a href='#' class='tombol' style='background-color: #636966;'>DIBLOKIR</a>";
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
