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
if($_GET['page']=="all"){
	$columns = array( 
	// datatable column index  => database column name
		0 =>'inv_id', 
		1 => 'mem_email',
		2 => 'inv_totalpayment',
		3 => 'inv_method',
		4 => 'inv_date',
		5 => 'inv_duedate',
		6 => 'inv_status'
		);

	// getting total number records without any search
	$sql = "SELECT i.inv_id, m.mem_email,i.inv_method,i.inv_status,i.inv_duedate,i.inv_date,i.inv_totalpayment";
	$sql.=" FROM invoice  i INNER JOIN member m ON i.mem_id=m.mem_id";
	$query=mysqli_query($conn, $sql) or die("listproduk-data.php: get employees");
	$totalData = mysqli_num_rows($query);
	$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


	$sql = "SELECT i.inv_id, m.mem_email,i.inv_method,i.inv_status,i.inv_date,i.inv_duedate,i.inv_totalpayment";
	$sql.=" FROM invoice  i INNER JOIN member m ON i.mem_id=m.mem_id WHERE 1=1";
	if( !empty($requestData['search']['value']) ) {   
	// if there is a search parameter, $requestData['search']['value'] contains search parameter
		$sql.=" AND ( inv_id LIKE '".$requestData['search']['value']."%' ";    
		$sql.=" OR mem_email LIKE '".$requestData['search']['value']."%' ";
		$sql.=" OR inv_totalpayment LIKE '".$requestData['search']['value']."%' ";
		$sql.=" OR inv_method LIKE '".$requestData['search']['value']."%' ";
		$sql.=" OR inv_date LIKE '".$requestData['search']['value']."%' ";
		$sql.=" OR inv_duedate LIKE '".$requestData['search']['value']."%' ";
		$sql.=" OR inv_status LIKE '".$requestData['search']['value']."%' )";

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

		$nestedData[] = $row["inv_id"];
		$nestedData[] = $row["mem_email"];
		$nestedData[] = $row["inv_totalpayment"];
		$nestedData[] = $row["inv_method"];
		$nestedData[] = $row["inv_date"];
		$nestedData[] = $row["inv_duedate"];

		if($row["inv_status"]=="Menunggu Pembayaran" AND $now >= $row["inv_duedate"]){
			$nestedData[] =
			"<a class='tombol'>Kadarluasa</a>";	
		}
		elseif($row["inv_status"]=="lunas" AND $row["inv_method"]=="cod" AND $now >= $row["inv_duedate"]){
			$nestedData[] =
			"<a  class='tombol'>Kadarluasa</a>";	
		}elseif($row["inv_status"]=="lunas"){
			$nestedData[] =
			"<a  class='tombol'>Lunas</a>";	
		}
		else{
			$nestedData[] =
			"<a  class='tombol' style='background-color: #d6d94f;'>Menunggu Konfirmasi</a>";
		}

		
		$data[] = $nestedData;
	}
}elseif($_GET['page']=="new"){
	$columns = array( 
	// datatable column index  => database column name
		0 =>'inv_id', 
		1 => 'mem_email',
		2 => 'inv_totalpayment',
		3 => 'inv_method',
		3 => 'inv_date',
		4 => 'inv_duedate',
		5 => 'inv_status'
		);

	// getting total number records without any search
	$sql = "SELECT i.inv_id, m.mem_email,i.inv_method,i.inv_status,i.inv_duedate,i.inv_date,i.inv_totalpayment";
	$sql.=" FROM invoice  i INNER JOIN member m ON i.mem_id=m.mem_id where inv_method NOT LIKE 'cod' AND inv_status  LIKE 'Menunggu Pembayaran' AND inv_duedate >= '$now' ";
	$query=mysqli_query($conn, $sql) or die("listproduk-data.php: get employees");
	$totalData = mysqli_num_rows($query);
	$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


	$sql = "SELECT i.inv_id, m.mem_email,i.inv_method,i.inv_status,i.inv_date,i.inv_duedate,i.inv_totalpayment";
	$sql.=" FROM invoice  i INNER JOIN member m ON i.mem_id=m.mem_id WHERE 1=1 AND inv_method NOT LIKE 'cod' and inv_status  LIKE 'Menunggu Pembayaran' AND inv_duedate >= '$now'";
	if( !empty($requestData['search']['value']) ) {   
	// if there is a search parameter, $requestData['search']['value'] contains search parameter
		$sql.=" AND ( inv_id LIKE '".$requestData['search']['value']."%' ";    
		$sql.=" OR mem_email LIKE '".$requestData['search']['value']."%' ";
		$sql.=" OR inv_totalpayment LIKE '".$requestData['search']['value']."%' ";
		$sql.=" OR inv_method LIKE '".$requestData['search']['value']."%' ";
		$sql.=" OR inv_date LIKE '".$requestData['search']['value']."%' ";
		$sql.=" OR inv_duedate LIKE '".$requestData['search']['value']."%' ";
		$sql.=" OR inv_status LIKE '".$requestData['search']['value']."%' )";

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

		$nestedData[] = $row["inv_id"];
		$nestedData[] = $row["mem_email"];
		$nestedData[] = $row["inv_totalpayment"];
		$nestedData[] = $row["inv_method"];
		$nestedData[] = $row["inv_date"];
		$nestedData[] = $row["inv_duedate"];

		if($row["inv_status"]=="Menunggu Pembayaran" AND $now >= $row["inv_duedate"]){
			$nestedData[] =
			"<a href='#' class='tombol'>Kadarluasa</a>";	
		}else{
			$nestedData[] =
			"<a href='../helper/payment.php?konfid=".$row["inv_id"]."' class='tombol' style='background-color: #d6d94f;'>KONFIRMASI</a>";
		}

		
		$data[] = $nestedData;
	}
}elseif($_GET['page']=="konfirmasimanual"){
	$columns = array( 
	// datatable column index  => database column name
		0 =>'inv_id', 
		1 =>'inv_totalpayment', 
		2 => 'conf_bankwm',
		3 => 'conf_bankcust',
		4 => 'conf_accountname',
		5 => 'conf_accountnumber',
		6 => 'conf_method',
		7 => 'conf_nominal',
		8 => 'conf_transfer'
		);

	// getting total number records without any search
	$sql = "SELECT i.inv_id, i.inv_totalpayment, c.conf_bankwm,c.conf_bankcust, c.conf_accountname,c.conf_accountnumber, c.conf_method,c.conf_nominal,c.conf_transfer";
	$sql.=" FROM confirmation c INNER JOIN invoice i ON i.inv_id=c.inv_id";
	$query=mysqli_query($conn, $sql) or die("listproduk-data.php: get employees");
	$totalData = mysqli_num_rows($query);
	$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


	$sql = "SELECT i.inv_id, i.inv_totalpayment, c.conf_bankwm,c.conf_bankcust, c.conf_accountname,c.conf_accountnumber, c.conf_method,c.conf_nominal,c.conf_transfer";
	$sql.=" FROM confirmation c INNER JOIN invoice i ON i.inv_id=c.inv_id WHERE 1=1";
	if( !empty($requestData['search']['value']) ) {   
	// if there is a search parameter, $requestData['search']['value'] contains search parameter
		$sql.=" AND ( inv_id LIKE '".$requestData['search']['value']."%')";
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

		$nestedData[] = $row["inv_id"];
		$nestedData[] = $row["inv_totalpayment"];
		$nestedData[] = $row["conf_bankwm"];
		$nestedData[] = $row["conf_bankcust"];
		$nestedData[] = $row["conf_accountname"];
		$nestedData[] = $row["conf_accountnumber"];
		$nestedData[] = $row["conf_method"];
		$nestedData[] = $row["conf_nominal"];
		$nestedData[] = $row["conf_transfer"];
		$nestedData[] =
			"<a href='../helper/payment.php?konfid=".$row["inv_id"]."' class='tombol' style='background-color: #d6d94f;'>KONFIRMASI</a>";
		
		$data[] = $nestedData;
	}
}	



$json_data = array(
			"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
			"recordsTotal"    => intval( $totalData ),  // total number of records
			"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
			"data"            => $data   // total data array
			);

echo json_encode($json_data);  // send data as json format

?>
