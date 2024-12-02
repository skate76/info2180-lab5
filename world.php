<?php
$host = 'localhost';  // Your database host, usually 'localhost'
$username = 'lab5_user';  // Your database username
$password = 'password123';  // Your database password
$dbname = 'world';  // The name of your database

try {
    // Create PDO connection
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_GET['country'])) {
        // Prepare and execute the query to search for the country
        $country = "%" . $_GET['country'] . "%";
        $stmt = $conn->prepare("SELECT name, head_of_state FROM countries WHERE name LIKE :country");
        $stmt->bindParam(':country', $country, PDO::PARAM_STR);
        $stmt->execute();
    } else {
        // If no country is provided, return all countries
        $stmt = $conn->query("SELECT name, head_of_state FROM countries");
    }

    // Fetch the results
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Return the results as JSON
    echo json_encode($results);

} catch (PDOException $e) {
    // Handle connection error
    echo json_encode(['error' => 'Database connection failed: ' . $e->getMessage()]);
}
?>
