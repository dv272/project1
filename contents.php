<!DOCTYPE html>
<html>
<head>
  <title>Contents</title>
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
