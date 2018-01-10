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
//ALL Page
date_default_timezone_set('Asia/Jakarta');
$now=date('Y-m-d H:i:s');
$columns = array( 
	// datatable column index  => database column name
	0 =>'lpk_username', 
	1 => 'lpk_name',
	2 => 'mem_email',
	3 => 'lpk_activehour',
	4 => 'lpk_freeongkir',
	5 => 'lpk_status'
	);

	// getting total number records without any search
$sql = "SELECT l.lpk_username,l.lpk_name,m.mem_email,l.lpk_activehour,l.lpk_freeongkir,l.lpk_status";
$sql.=" FROM lapak  l INNER JOIN member m ON l.mem_id=m.mem_id";
$query=mysqli_query($conn, $sql) or die("listproduk-data.php: get employees");
$totalData = mysqli_num_rows($query);
	$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


	$sql = "SELECT  l.lpk_username,l.lpk_name,m.mem_email,l.lpk_activehour,l.lpk_freeongkir,l.lpk_status";
	$sql.=" FROM lapak l INNER JOIN member m ON l.mem_id=m.mem_id WHERE 1=1";
	if( !empty($requestData['search']['value']) ) {   
	// if there is a search parameter, $requestData['search']['value'] contains search parameter
		$sql.=" AND ( lpk_username LIKE '".$requestData['search']['value']."%' ";    
		$sql.=" OR lpk_name LIKE '".$requestData['search']['value']."%' ";
		$sql.=" OR mem_email LIKE '".$requestData['search']['value']."%' ";
		$sql.=" OR lpk_activehour LIKE '".$requestData['search']['value']."%' ";
		$sql.=" OR lpk_freeongkir LIKE '".$requestData['search']['value']."%' ";
		$sql.=" OR lpk_status LIKE '".$requestData['search']['value']."%' )";

	}
	$query=mysqli_query($conn, $sql) or die("listproduk-data.php: get employees");
	$totalFiltered = mysqli_num_rows($query); 
	// when there is a search parameter then we have to modify total number filtered rows as per search result. 
	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
	/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */	
	$query=mysqli_query($conn, $sql) or die("listproduk-data.php: get employees");
	
	$data = array();
	while( $row=mysqli_fetch_array($query) ) {  
	// preparing an array
		$nestedData=array(); 

		$nestedData[] = $row["lpk_username"];
		$nestedData[] = $row["lpk_name"];
		$nestedData[] = $row["mem_email"];
		$nestedData[] = $row["lpk_activehour"];
		if($row["lpk_freeongkir"]=="0" ){
			$nestedData[] =
			"Tidak Gratis Ongkir";	
		}else{
			$nestedData[] =
			"Gratis Ongkir";	
		}
		if($row["lpk_status"]=="N" ){
			$nestedData[] =
			"<a  href='../helper/lapak.php?aksi=nonaktifkan&user=".$row["lpk_username"]."' class='tombol' style='background-color: #4fd99f;'>Aktifkan</a>";
		}else{
			$nestedData[] =
			"<a   href='../helper/lapak.php?aksi=aktifkan&user=".$row["lpk_username"]."' class='tombol' >Nonaktifkan</a>";	
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
