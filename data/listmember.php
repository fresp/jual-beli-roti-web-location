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
	0 =>'mem_firstname', 
	1 => 'mem_email',
	2 => 'mem_phone',
	3 => 'mem_lastlogin',
	4 => 'mem_status'
	);

// getting total number records without any search
$sql = "SELECT mem_firstname,mem_lastname,mem_email,mem_phone,mem_lastlogin,mem_status";
$sql.=" FROM member  ";
$query=mysqli_query($conn, $sql) or die("listproduk-data.php: get employees");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


$sql = "SELECT mem_firstname,mem_lastname,mem_email,mem_phone,mem_lastlogin,mem_status";
$sql.=" FROM member WHERE 1=1";
if( !empty($requestData['search']['value']) ) {  
	$sql.=" AND ( mem_firstname LIKE '".$requestData['search']['value']."%' ";    
	$sql.=" OR mem_email LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR mem_phone LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR mem_lastlogin LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR mem_status LIKE '".$requestData['search']['value']."%' )";
}
$query=mysqli_query($conn, $sql) or die("listproduk-data.php: get employees");
$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */	
$query=mysqli_query($conn, $sql) or die("listproduk-data.php: get employees");

$data = array();
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	$nestedData=array(); 
	$full =  $row["mem_firstname"]." ".$row["mem_lastname"];
	$nestedData[] = $full;
	$nestedData[] = $row["mem_email"];
	$nestedData[] = $row["mem_phone"];
	$periods         = array("detik", "menit", "jam", "hari", "minggu", "bulan", "tahun");
	$lengths         = array("60","60","24","7","4.35","12","10");
	$now             = time();
	$unix_date       = strtotime($row["mem_lastlogin"]);
	if(!($unix_date)) {   
		$waktu  = "Format tanggal salah";
	}
	if($now > $unix_date) {   
		$lastseen     = $now - $unix_date;
		$tense         = "yang lalu";
	} else {
		$lastseen     = $unix_date - $now;
		$tense         = "dari sekarang";
	}
	for($j = 0; $lastseen >= $lengths[$j] && $j < count($lengths)-1; $j++) {
		$lastseen /= $lengths[$j];
	}
	$lastseen = round($lastseen);
	if($lastseen != 1) {
		$periods[$j].= "";
	}
	$waktu = "$lastseen $periods[$j] {$tense}";
	$nestedData[] = $waktu;
	if($row["mem_status"]=="Y"){
	$nestedData[] = 
	" <a href='../helper/member.php?aksi=nonaktifkan&email=".$row["mem_email"]."' class='tombol' >Nonaktifkan</a>|<a href='ubah.php?jenis=member&email=".$row["mem_email"]."' class='tombol' style='background-color: #d6d94f;' >ubah password</a>";
}else{
$nestedData[] = 
" <a href='../helper/member.php?aksi=aktifkan&email=".$row["mem_email"]."' class='tombol' style='background-color: #4fd99a;'>Aktifkan</a>";
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
