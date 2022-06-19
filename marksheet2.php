<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marksheet</title>
</head>
<body>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "studentdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT roll, firstname, lastname FROM student where roll = ".$_POST["roll"];

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "Roll: ".$row["roll"]. "  ". $row["firstname"]."  ". $row["lastname"]."<br>";
    }
}

$sql = "SELECT mark.subcode as sc, subjectname, maxmark, mark FROM Mark, subject
where mark.subcode = subject.subcode and roll = ". $_POST["roll"];

$result = $conn->query($sql);
// 
echo "<table border = 1>";
echo "<tr><th>Pcode</th><th>Paper</th><th>Max Mark</th><th>Mark Obtained</th></tr>";

$totalMarks = 0;
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "<tr><td> {$row['sc']} </td><td> {$row['subjectname']}</td>
          <td>{$row['maxmark']} </td> <td>{$row['mark']}</td> </tr>";
    $totalMarks += $row['mark'];
  }
  echo "<tr><td>  </td><td> </td> <td>Total </td> <td>$totalMarks</td> </tr>";
} else {
  echo "0 results";
}
echo "</table>";
$conn->close();
?>
</body>
</html>