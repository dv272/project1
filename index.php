<html>
<head>
	<title>CSV file</title>
</head>
<body>
	<form action="" method="post" enctype="multipart/form-data">
		<input type="file" name="file" id="file">
		<input type="submit" value="Upload CSV file" name="submit">
	</form>


	<?php
	//Getting path and target file parameters
	$dir = "uploads/";
	$target = $dir . basename($_FILES["file"]["name"]);
	
	if(isset($_POST["submit"])) {
		$upld = new CSVUploader();
		$upld->UploadFile($target);
	}

	//Class to handle file uploading task
	class CSVUploader {
		public function UploadFile($targetFile) {
			//Check for if file already exist
			if (file_exists($targetFile)) {
				echo $_FILES["file"]["name"]." already exists.";
				header('Location: contents.php?file='.$_FILES["file"]["name"]);
			}
			else {
				//Store file to server
				if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile))
				{
					echo basename($_FILES["file"]["name"]). " uploaded.";
					//will redirect to provided url
					header('Location: contents.php?file='.$_FILES["file"]["name"]);
				}
				else {
					echo "SORRY!!! Dwija";
				}
			}
		}
	}

	?>
</body>
</html>