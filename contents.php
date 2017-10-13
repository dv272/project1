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


  if(isset($_GET["file"])){
  $file = $_GET["file"];
  $test = new ParseCSV();
  $test->parse($file);
}

class ParseCSV {

  public function parse($name) {
    $csv = fopen('uploads/'.$name,'r');
    $columns = fgetcsv($csv,',');
    echo "<table>";
    echo "<tr>";
    foreach($columns as $column){
      echo "<th>".$column."</th>";
    }
    echo "</tr>";
    $temp = 1;
    while(($data = fgetcsv($csv,",")) !== FALSE) {
      $num = count($data);
      $temp++;
      echo "<tr>";
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
