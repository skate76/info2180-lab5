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
        $stmt = $conn->prepare("SELECT * FROM countries WHERE name LIKE :country");
        $stmt->bindParam(':country', $country, PDO::PARAM_STR);
        $stmt->execute();
    } else {
        $stmt = $conn->query("SELECT * FROM countries");
    }

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>

<ul>
<?php if (!empty($results)): ?>
    <?php foreach ($results as $row): ?>
        <li><?= htmlspecialchars($row['name']) . ' is ruled by ' . htmlspecialchars($row['head_of_state']); ?></li>
    <?php endforeach; ?>
<?php else: ?>
    <li>No results found.</li>
<?php endif; ?>
</ul>
