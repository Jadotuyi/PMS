<?php
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

// The rest of your protected page content goes here
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Products</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<style type="text/css">
    /* General styles */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
}

/* Heading styles */
h2 {
    color: #333;
    text-align: center;
    margin-top: 20px;
}

/* Container styles */
.container {
    width: 80%;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

/* Table styles */
table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
}

table, th, td {
    border: 1px solid #ddd;
}

th, td {
    padding: 12px;
    text-align: left;
}

th {
    background-color: #007bff;
    color: white;
}

tr:nth-child(even) {
    background-color: #f2f2f2;
}

tr:hover {
    background-color: #ddd;
}

/* Link styles */
a {
    display: block;
    text-align: center;
    margin-top: 20px;
    padding: 10px;
    color: #007bff;
    text-decoration: none;
    font-weight: bold;
}

a:hover {
    color: #0056b3;
}

</style>

<body>
    <h2>All Products</h2>

    <?php
    

    $sql = "SELECT * FROM products";
    $stmt = $pdo->query($sql);

    echo "<table>";
    echo "<tr><th>ID</th><th>Name</th><th>Price</th><th>Quantity</th></tr>";
    $i=1;

    while ($row = $stmt->fetch()) {
        echo "<tr>";
        echo "<td>" . $i . "</td>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['price'] . "</td>";
        echo "<td>" . $row['quantity'] . "</td>";
        echo "</tr>";
        $i=$i+1;
    }
    echo "</table>";
    ?>

    <a href="home.php">Back to Home</a>
</body>
</html>
