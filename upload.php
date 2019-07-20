<?php

	// Check if the picture is upload
	if (empty($_FILES["fileToUpload"]["name"])) {
		header('Location: added.php');
	}
	else {
		$uploadOk = 1;
		$target_dir = "uploads/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"])) {
			$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
			if($check !== false) {
				echo "File is an image - " . $check["mime"] . ". ";
				$uploadOk = 1;
			} 
			else {
				echo '<div style="Color:white">File is not an image. </div>';
				$uploadOk = 0;
			}
		}
		// Check if file already exists
		if (file_exists($target_file)) {
			echo '<div style="Color:white">Sorry, file already exists. You should change the file name. </div>';
			$uploadOk = 0;
		}
		// Check file size
		if ($_FILES["fileToUpload"]["size"] > 500000) {
			echo '<div style="Color:white">Sorry, your file is too large. </div>';
			$uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
			echo '<div style="Color:white">Sorry, only JPG, JPEG, PNG & GIF files are allowed. </div>';
			$uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			echo '<div style="Color:white">Sorry, your file was not uploaded. </div>';
		} 
		else { 
			// if everything is ok, try to upload file
			if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
				//echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded. ";
				header('Location: added.php');
			} 
			else {
				echo '<div style="Color:white">Sorry, there was an error uploading your file. </div>';
			}
		}
	}
	
?>