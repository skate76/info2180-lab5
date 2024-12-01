<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);


if(isset($_GET['country'])){
  $country = $_GET['country'];
  $stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%'");
  #$stmt -> execute();


}else{
  $stmt = $conn-> query("SELECT * FROM countries");
}

#$con = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

#$tt = $con echo $_GET['country']


$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<ul>
<?php foreach ($results as $row): ?>
  <li><?= $row['name'] . ' is ruled by ' . $row['head_of_state']; ?></li>
<?php endforeach; ?>
</ul>
