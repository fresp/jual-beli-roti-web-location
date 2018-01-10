<?php
session_start();

if(isset($_POST))
{
	############ Edit settings ##############
	$ThumbSquareSize 		= 100; //Thumbnail will be 200x200
	$BigImageMaxSize 		= 300; //Image Maximum height or width
	$ThumbPrefix			= "thumb_"; //Normal thumb Prefix
	$DestinationDirectory	= 'uploads/'; //specify upload directory ends with / (slash)
	$Quality 				= 90; //jpeg quality
	##########################################
	
	//check if this is an ajax request
	if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
		die();
	}
	
	// check $_FILES['ImageFile'] not empty
	if(!isset($_FILES['ImageFile']) || !is_uploaded_file($_FILES['ImageFile']['tmp_name']))
	{
			die('Something wrong with uploaded file, something missing!'); // output error when above checks fail.
	}
	
	// Random number will be added after image name
	$RandomNumber 	= rand(1000, 999999); 

	$ImageName 		= str_replace(' ','-',strtolower($_FILES['ImageFile']['name'])); //get image name
	$ImageSize 		= $_FILES['ImageFile']['size']; // get original image size
	$TempSrc	 	= $_FILES['ImageFile']['tmp_name']; // Temp name of image file stored in PHP tmp folder
	$ImageType	 	= $_FILES['ImageFile']['type']; //get file type, returns "image/png", image/jpeg, text/plain etc.

	//Let's check allowed $ImageType, we use PHP SWITCH statement here
	switch(strtolower($ImageType))
	{
		case 'image/png':
			//Create a new image from file 
			$CreatedImage =  imagecreatefrompng($_FILES['ImageFile']['tmp_name']);
			break;
		case 'image/gif':
			$CreatedImage =  imagecreatefromgif($_FILES['ImageFile']['tmp_name']);
			break;			
		case 'image/jpeg':
		case 'image/pjpeg':
			$CreatedImage = imagecreatefromjpeg($_FILES['ImageFile']['tmp_name']);
			break;
		default:
			die('Unsupported File!'); //output error and exit
	}
	
	//PHP getimagesize() function returns height/width from image file stored in PHP tmp folder.
	//Get first two values from image, width and height. 
	//list assign svalues to $CurWidth,$CurHeight
	list($CurWidth,$CurHeight)=getimagesize($TempSrc);
	
	//Get file extension from Image name, this will be added after random name
	$ImageExt = substr($ImageName, strrpos($ImageName, '.'));
  	$ImageExt = str_replace('.','',$ImageExt);
	
	//remove extension from filename
	$ImageName 		= preg_replace("/\\.[^.\\s]{3,4}$/", "", $ImageName); 
	
	//Construct a new name with random number and extension.
	$NewImageName = $ImageName.'-'.$RandomNumber.'.'.$ImageExt;
	
	//set the Destination Image
	$thumb_DestRandImageName 	= $DestinationDirectory.$ThumbPrefix.$NewImageName; //Thumbnail name with destination directory
	$DestRandImageName 			= $DestinationDirectory.$NewImageName; // Image with destination directory
	
	//Resize image to Specified Size by calling resizeImage function.
	if(resizeImage($CurWidth,$CurHeight,$BigImageMaxSize,$DestRandImageName,$CreatedImage,$Quality,$ImageType))
	{
		//Create a square Thumbnail right after, this time we are using cropImage() function
		if(!cropImage($CurWidth,$CurHeight,$ThumbSquareSize,$thumb_DestRandImageName,$CreatedImage,$Quality,$ImageType))
			{
				echo 'Error Creating thumbnail';
			}
		/*
		We have succesfully resized and created thumbnail image
		We can now output image to user's browser or store information in the database
		*/
		echo '<table width="100%" border="0" cellpadding="4" cellspacing="0">';
		echo '<tr>';
		echo '<td align="center"><img src="uploads/'.$ThumbPrefix.$NewImageName.'" alt="Thumbnail"></td>';
		echo '</tr>';
		echo '</table>';
		$a = $NewImageName;
		$_SESSION['thumb'] = $a;

		?>
		<br>
		<form id="imageform" action="simpandata.php" method="POST" enctype="multipart/form-data">
	      <div style=" text-align: left; padding: 0px 5px;">
	          <div>
	              <input type="text" class="kb-input" hidden="hidden" name="gambar" style="" value="<?php echo $a ?>" >
	              <div class="row" style="margin-bottom: 10px;">
	                <div class="column-12">
	                  <div>
	                    <div class="">
	                      <select class="kb-input">
	                        <option value="32">Kue Tradisional</option>
	                        <option value="21">Roti Tawar</option>
	                        <option value="14">Roti Manis</option>
	                        <option value="66">Donat</option>
	                        <option value="18">Cake</option>
	                        <option value="95">Tart</option>
	                        <option value="14">Keringan</option>
	                        <option value="269">Lain lain</option>
	                      </select>
	                      
	                     </div>
	                  </div>
	                </div>
	              </div>
	              <div class="row" style="margin-bottom: 10px;">
	                <div class="column-12">
	                  <input type="text" class="kb-input" id="product-name" style="" value="" placeholder="Nama Produk">
	                </div>
	              </div>
	              <div class="row" style="margin-bottom: 10px;">
	                <div class="column-12">
	                  <input type="number" class="kb-input" style=""
	                      value="" id="product-price" placeholder="Harga">
	                  </div>
	              </div>
	              <div class="row" style="margin-bottom: 10px;">
	                <div class="column-12">
	                  <textarea class="kb-textarea" id="product-description" style="width: 96%;height: 7em;" placeholder="Deskripsi Produk"></textarea>
	                </div>
	              </div>
	              
	              <div class="row" style="margin-bottom: 10px;">
	                <div class="column-12">
	                  <input type="file" style="display:none;" id="uploaded-product-img" value="">
	                  <input type="text" style="display:none; width: 100%;" id="image-results" value="">
	                  <div class="attachment-product-image-list">
	                    <ul class="preview-img-list">
	                    </ul>
	                  </div>
	                </div>
	              </div>
	              <div class="row" style="margin-bottom: 10px;">
	                <div class="column-12">
	                  <button id="post-button" class="kb-button  button-float kb-button2" type="button" style="width: 100%;">
	                  <i class="material-icons button-icon">done</i>
	                        Posting
	                  </button>
	                 </div>
	              </div>
	          </div>
	      </div>
	    </form>   
		<?php

	}else{
		die('Resize Error'); //output error
	}
}


// This function will proportionally resize image 
function resizeImage($CurWidth,$CurHeight,$MaxSize,$DestFolder,$SrcImage,$Quality,$ImageType)
{
	//Check Image size is not 0
	if($CurWidth <= 0 || $CurHeight <= 0) 
	{
		return false;
	}
	
	//Construct a proportional size of new image
	$ImageScale      	= min($MaxSize/$CurWidth, $MaxSize/$CurHeight); 
	$NewWidth  			= ceil($ImageScale*$CurWidth);
	$NewHeight 			= ceil($ImageScale*$CurHeight);
	$NewCanves 			= imagecreatetruecolor($NewWidth, $NewHeight);
	
	// Resize Image
	if(imagecopyresampled($NewCanves, $SrcImage,0, 0, 0, 0, $NewWidth, $NewHeight, $CurWidth, $CurHeight))
	{
		switch(strtolower($ImageType))
		{
			case 'image/png':
				imagepng($NewCanves,$DestFolder);
				break;
			case 'image/gif':
				imagegif($NewCanves,$DestFolder);
				break;			
			case 'image/jpeg':
			case 'image/pjpeg':
				imagejpeg($NewCanves,$DestFolder,$Quality);
				break;
			default:
				return false;
		}
	//Destroy image, frees memory	
	if(is_resource($NewCanves)) {imagedestroy($NewCanves);} 
	return true;
	}

}

//This function corps image to create exact square images, no matter what its original size!
function cropImage($CurWidth,$CurHeight,$iSize,$DestFolder,$SrcImage,$Quality,$ImageType)
{	 
	//Check Image size is not 0
	if($CurWidth <= 0 || $CurHeight <= 0) 
	{
		return false;
	}
	
	//abeautifulsite.net has excellent article about "Cropping an Image to Make Square bit.ly/1gTwXW9
	if($CurWidth>$CurHeight)
	{
		$y_offset = 0;
		$x_offset = ($CurWidth - $CurHeight) / 2;
		$square_size 	= $CurWidth - ($x_offset * 2);
	}else{
		$x_offset = 0;
		$y_offset = ($CurHeight - $CurWidth) / 2;
		$square_size = $CurHeight - ($y_offset * 2);
	}
	
	$NewCanves 	= imagecreatetruecolor($iSize, $iSize);	
	if(imagecopyresampled($NewCanves, $SrcImage,0, 0, $x_offset, $y_offset, $iSize, $iSize, $square_size, $square_size))
	{
		switch(strtolower($ImageType))
		{
			case 'image/png':
				imagepng($NewCanves,$DestFolder);
				break;
			case 'image/gif':
				imagegif($NewCanves,$DestFolder);
				break;			
			case 'image/jpeg':
			case 'image/pjpeg':
				imagejpeg($NewCanves,$DestFolder,$Quality);
				break;
			default:
				return false;
		}
	//Destroy image, frees memory	
	if(is_resource($NewCanves)) {imagedestroy($NewCanves);} 
	return true;

	}
	  
}