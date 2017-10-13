<html>
<head>
	<title>CSV file</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-m-12">
				<form action="" method="post" enctype="multipart/form-data">
				<table class="table">
						<tr>
							<td><input type="file" name="file" id="file"></td>
						</tr>
						<tr>
							<td><input type="submit" value="Upload CSV file" name="submit"></td>
						</tr>
					</table>
				</form>
			</div>
		</div>
	</div>


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