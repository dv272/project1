<html>
<head>
	<title>CSV file</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<style>
		table {
			font-family: arial, sans-serif;
			border-collapse: collapse;
			width: 100%;
		}

		td, th {
			border: 1px solid #dddddd;
			text-align: left;
			padding: 8px;
		}

		tr:nth-child(even) {
			background-color: #dddddd;
		}
	</style>
</head>
<body>
	<?php
	$page = "home";
	if (isset($_GET["page"])) {
		$page = $_GET["page"];
	}else {
		echo "<div class=\"container\">";
			echo "<div class=\"row\">";
				echo "<div class=\"col-m-12\">";
					echo "<form method=\"post\" enctype=\"multipart/form-data\">";
						echo "<table class=\"table\">";
							echo "<tr><td><input type=\"file\" name=\"file\" id=\"file\"></td></tr>";
							echo "<tr><td><input type=\"submit\" value=\"Upload CSV file\" name=\"submit\"></td></tr>";
						echo "</table></form></div></div></div>";
	}
	?>


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
				header('Location: index.php?page=table&file='.$_FILES["file"]["name"]);
			}
			else {
				//Store file to server
				if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile))
				{
					echo basename($_FILES["file"]["name"]). " uploaded.";
					//will redirect to provided url
					header('Location: index.php?file='.$_FILES["file"]["name"]);
				}
				else {
					echo "SORRY!!! Dwija";
				}
			}
		}
	}

	?>

	<?php

  //Check for if valid parameters are coming in request
	if(isset($_GET["file"])){
		$file = $_GET["file"];
		$test = new ParseCSV();
		$test->parse($file);
	}

//Class to handle all CSV parsing task
	class ParseCSV {

		public function parse($name) {
    //Open file with valid file name
			$csv = fopen('uploads/'.$name,'r');
			$columns = fgetcsv($csv,',');
			echo "<table>";
			echo "<tr>";
    //Will display heading of each column
			foreach($columns as $column){
				echo "<th>".$column."</th>";
			}
			echo "</tr>";
			$temp = 1;
    //Will traverse for each row of file
			while(($data = fgetcsv($csv,",")) !== FALSE) {
				$num = count($data);
				$temp++;
				echo "<tr>";
      //Traverse for each value in row
				for($i = 0; $i < $num; $i++) {
					echo "<td>".$data[$i]."</td>";
				}
				echo "</tr>";
			}
			echo "</table>";
		}
	}

	?>

</body>
</html>