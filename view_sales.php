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
    <title>View Sales</title>
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

/* Table styles */
table {
    width: 80%;
    margin: 20px auto;
    border-collapse: collapse;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    overflow: hidden;
}

th, td {
    padding: 10px;
    text-align: left;
    border-bottom: 1px solid #ddd;
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

</style>
<body>
    <h2>View All Sales</h2>
    <?php


$sql = "SELECT sales.id, sales.product_id, sales.quantity, sales.sale_price, sales.sale_date, products.name AS product_name, products.price AS unit_price 
        FROM sales 
        JOIN products ON sales.product_id = products.id";
$stmt = $pdo->query($sql);

echo "<table>";
echo "<tr><th>ID</th><th>Product Name</th><th>Quantity Sold</th><th>Sale Price</th><th>Unit Price</th><th>Profit</th><th>Sale Date</th></tr>";
$i=1;
while ($row = $stmt->fetch()) {
    $profit = $row['sale_price'] - ($row['unit_price'] * $row['quantity']);
    echo "<tr>";
    echo "<td>" . $i . "</td>";
    echo "<td>" . $row['product_name'] . "</td>";
    echo "<td>" . $row['quantity'] . "</td>";
    echo "<td>" . $row['sale_price'] . "</td>";
    echo "<td>" . $row['unit_price'] . "</td>";
    echo "<td>" . number_format($profit, 2) . "</td>";
    echo "<td>" . $row['sale_date'] . "</td>";
    echo "</tr>";
    $i=$i+1;
}
echo "</table>";
echo "<a href='home.php'>Back to Home</a>";
?>

    

</body>
</html>
