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
	0 => 'sld_created', 
	1 => 'sld_desc',
	2 => 'sld_amount',
	3 => 'sld_status'
	);

	// getting total number records without any search
$sql = "SELECT sld_id,mem_id,sld_desc,sld_amount,sld_status,sld_created";
$sql.=" FROM saldo where mem_id like '$memid ORDER BY sld_created DESC'";
$query=mysqli_query($conn, $sql) or die("listsaldo.php: get employees");
$totalData = mysqli_num_rows($query);
	$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


	$sql = "SELECT  sld_id,mem_id,sld_desc,sld_amount,sld_status,sld_created";
	$sql.=" FROM saldo WHERE 1=1 AND mem_id like '$memid' ";
	if( !empty($requestData['search']['value']) ) {   
	// if there is a search parameter, $requestData['search']['value'] contains search parameter
		$sql.=" AND ( sld_created LIKE '".$requestData['search']['value']."%' ";    
		$sql.=" OR sld_desc LIKE '".$requestData['search']['value']."%' ";
		$sql.=" OR sld_amount LIKE '".$requestData['search']['value']."%' ";
		$sql.=" OR sld_status LIKE '".$requestData['search']['value']."%' )";

	}

	$query=mysqli_query($conn, $sql) or die("listsaldo.php: get employees");
	$totalFiltered = mysqli_num_rows($query); 
	// when there is a search parameter then we have to modify total number filtered rows as per search result. 
	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
	/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */	
	$query=mysqli_query($conn, $sql) or die("listsaldo.php: get employees");
	
	$data = array();
	while( $row=mysqli_fetch_array($query) ) {  
	// preparing an array
		$nestedData=array(); 
		$tanggal = $row['sld_created'];
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
		$angka = $row["sld_amount"];
		$jumlah_desimal ="0";
		$pemisah_desimal =",";
		$pemisah_ribuan =".";
		$status = $row["sld_status"];
		$nestedData[] = $indDate;
		$nestedData[] = $row["sld_desc"];
		if($status=="Debit"){
			$nestedData[] = "+".number_format($angka, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
		}elseif($status=="Credit"){
			$nestedData[] = "-".number_format($angka, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
		}else{
			$nestedData[] = "+".number_format($angka, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
		}
		
		$nestedData[] = $row["sld_status"];

		
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
