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
        $stmt = $conn->prepare("SELECT name, head_of_state, continent, independence_year FROM countries WHERE name LIKE :country");
        $stmt->bindParam(':country', $country, PDO::PARAM_STR);
    } else {
        
        $stmt = $conn->query("SELECT name, head_of_state, continent, independence_year FROM countries");
    }

   
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    
    if (!empty($results)) {
        echo "<table border='1'>";
        echo "<tr><th>Name</th><th>Continent</th><th>Independence Year</th><th>Head of State</th></tr>"; 
        foreach ($results as $row) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
            echo "<td>" . htmlspecialchars($row['continent']) . "</td>";
            echo "<td>" . htmlspecialchars($row['independence_year']) . "</td>";
            echo "<td>" . htmlspecialchars($row['head_of_state']) . "</td>";
            echo "</tr>";
        }
        echo "</table>";  
    } else {
        echo "<p>No countries found for that search.</p>";
    }
} catch (PDOException $e) {
   
    echo "<p>Error: " . $e->getMessage() . "</p>";
}
?>
