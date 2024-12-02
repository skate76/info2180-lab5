<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';  
$dbname = 'world';

try {
   
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

    
    if (isset($_GET['country']) && !empty($_GET['country'])) {
        $country = "%" . $_GET['country'] . "%";  
        $stmt = $conn->prepare("SELECT name, head_of_state FROM countries WHERE name LIKE :country");
        $stmt->bindParam(':country', $country, PDO::PARAM_STR);
    } else {
        
        $stmt = $conn->query("SELECT name, head_of_state FROM countries");
    }

   
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

   
    if (!empty($results)) {
        echo "<ul>";
        foreach ($results as $row) {
            echo "<li>" . htmlspecialchars($row['name']) . " is ruled by " . htmlspecialchars($row['head_of_state']) . "</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>No countries found for that search.</p>";
    }

} catch (PDOException $e) {
    echo "<p>Error: " . $e->getMessage() . "</p>";
}
?>
