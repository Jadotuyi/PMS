<?php
// Fetching environment variables
$host = getenv('MYSQL_ADDON_HOST');
$db = getenv('MYSQL_ADDON_DB');
$user = getenv('MYSQL_ADDON_USER');
$pass = getenv('MYSQL_ADDON_PASSWORD');


try {
    // Creating a new PDO instance
    $pdo = new PDO(
        "mysql:host=$host;dbname=$db", 
        $user, 
        $pass, 
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
} catch (PDOException $e) {
    // Handling connection errors
    throw new PDOException($e->getMessage(), (int)$e->getCode());
}
?>