<?php
session_start();
/* Database connection start */
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbroit";
$memid =$_SESSION['iduser'];

$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());



// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;
//ALL Page
date_default_timezone_set('Asia/Jakarta');
$now=date('Y-m-d H:i:s');
$columns = array( 
	// datatable column index  => database column name
	0 => 'wdr_created', 
	1 => 'wdr_accountname',
	2 => 'wdr_bank',
	3 => 'wdr_accountnumber',
	4 => 'wdr_amount',
	5 => 'wdr_status'
	);

	// getting total number records without any search
$sql = "SELECT wdr_id,mem_id,wdr_accountname,wdr_bank,wdr_accountnumber,wdr_amount,wdr_status,wdr_created";
$sql.=" FROM withdrawal where mem_id like '$memid ORDER BY sld_created DESC'";
$query=mysqli_query($conn, $sql) or die("listsaldo.php: get employees");
$totalData = mysqli_num_rows($query);
	$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


	$sql = "SELECT wdr_id,mem_id,wdr_accountname,wdr_bank,wdr_accountnumber,wdr_amount,wdr_status,wdr_created";
	$sql.=" FROM withdrawal WHERE 1=1 AND mem_id like '$memid' ";
	if( !empty($requestData['search']['value']) ) {   
	// if there is a search parameter, $requestData['search']['value'] contains search parameter
		$sql.=" AND ( wdr_created LIKE '".$requestData['search']['value']."%' ";    
		$sql.=" OR wdr_bank LIKE '".$requestData['search']['value']."%' ";
		$sql.=" OR wdr_accountname LIKE '".$requestData['search']['value']."%' ";
		$sql.=" OR wdr_status LIKE '".$requestData['search']['value']."%' )";

	}

	$query=mysqli_query($conn, $sql) or die("listsaldo.php: 2get employees");
	$totalFiltered = mysqli_num_rows($query); 
	// when there is a search parameter then we have to modify total number filtered rows as per search result. 
	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
	/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */	
	$query=mysqli_query($conn, $sql) or die("listsaldo.php: get employees");
	
	$data = array();
	while( $row=mysqli_fetch_array($query) ) {  
	// preparing an array
		$nestedData=array(); 
		$tanggal = $row['wdr_created'];
		$engDate=date("l F d, Y H:i:s A", strtotime($tanggal));
		switch (date("w")) {
			case "0" : $hari="Minggu";break;
			case "1" : $hari="Senin";break;
			case "2" : $hari="Selasabreak;
			"; case "3" : $hari="Rabu";break;
			case "4" : $hari="Kamis";break;
			case "5" : $hari="Jumat";break;
			case "6" : $hari="Sabtu";break;
		} switch (date("m")) {
			case "1" : $bulan="Januari";break;
			case "2" : $bulan="Februari";break;
			case "3" : $bulan="Maret";break;
			case "4" : $bulan="April";break;
			case "5" : $bulan="Mei";break;
			case "6" : $bulan="Juni";break;
			case "7" : $bulan="Juli";break;
			case "8" : $bulan="Agustus";break;
			case "9" : $bulan="Septemberbreak;
			"; case "10" : $bulan="Oktober";break;
			case "11" : $bulan="November";break;
			case "12" : $bulan="Desember";break;
		}
		$indDate="$hari ". date("d") ." $bulan". date(" Y H:i:s ", strtotime($tanggal));
		$angka = $row["wdr_amount"];
		$jumlah_desimal ="0";
		$pemisah_desimal =",";
		$pemisah_ribuan =".";
		$nestedData[] = $indDate;
		$nestedData[] = $row["wdr_status"];
		$nestedData[] = $row["wdr_bank"];
		$nestedData[] = $row["wdr_accountname"];
		$nestedData[] = $row["wdr_accountnumber"];
		$nestedData[] = "Rp. ".number_format($angka, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
		
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
