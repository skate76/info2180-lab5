<?php
$host = 'localhost';  
$username = 'lab5_user';  
$password = 'password123';  
$dbname = 'world';  

try {
   
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_GET['country'])) {
        
        $country = "%" . $_GET['country'] . "%";
        $stmt = $conn->prepare("SELECT name, head_of_state FROM countries WHERE name LIKE :country");
        $stmt->bindParam(':country', $country, PDO::PARAM_STR);
        $stmt->execute();
    } else {
        
        $stmt = $conn->query("SELECT name, head_of_state FROM countries");
    }

    
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

  
    echo json_encode($results);

} catch (PDOException $e) {
    
    echo json_encode(['error' => 'Database connection failed: ' . $e->getMessage()]);
}
?>
