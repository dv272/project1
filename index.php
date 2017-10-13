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
	$dir = "uploads/";
	$target = $dir . basename($_FILES["file"]["name"]);
	
	if(isset($_POST["submit"])) {
		$upld = new CSVUploader();
		$upld->UploadFile($target);
	}


	class CSVUploader {
		public function UploadFile($targetFile) {
			if (file_exists($targetFile)) {
				echo $_FILES["file"]["name"]." already exists.";
			}
			else {
				if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile))
				{
					echo basename($_FILES["file"]["name"]). " uploaded.";
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