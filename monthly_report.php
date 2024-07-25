<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monthly Report</title>
    <link rel="stylesheet" href="css/style.css">
     <link rel="icon" type="image/png" sizes="32x32" href="path/to/your/favicon.png">
</head>
<style type="text/css">
    /* Reset some default browser styles */
body, h2, table {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    line-height: 1.6;
    background-color: #f4f4f4;
    color: #333;
    padding: 20px;
}

h2 {
    color: #333;
    margin-bottom: 20px;
}

form {
    margin-bottom: 20px;
    padding: 10px;
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 5px;
}

label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

input[type="date"], input[type="number"], button {
    display: block;
    margin-bottom: 10px;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

button {
    background-color: #5cb85c;
    color: white;
    border: none;
    cursor: pointer;
}

button:hover {
    background-color: #4cae4c;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

table, th, td {
    border: 1px solid #ddd;
}

th, td {
    padding: 12px;
    text-align: left;
}

th {
    background-color: #f2f2f2;
}

tr:nth-child(even) {
    background-color: #f9f9f9;
}

tr:hover {
    background-color: #f1f1f1;
}

a {
    display: inline-block;
    margin-top: 20px;
    padding: 10px;
    text-decoration: none;
    color: #5cb85c;
    border: 1px solid #5cb85c;
    border-radius: 4px;
}

a:hover {
    background-color: #5cb85c;
    color: white;
}

</style>
<body>
    <h2>Monthly Sales Report</h2>
    <form action="monthly_report.php" method="GET">
        <label for="month">Select Month:</label>
        <input type="month" id="month" name="month" required>
        <button type="submit">Generate Report</button>
    </form>
    
    <?php
    include 'db.php';  // Ensure this path is correct

    if (isset($_GET['month'])) {
        $month = $_GET['month'];
        $sql = "SELECT s.id, s.product_id, s.quantity, s.sale_price, s.sale_date, p.price AS unit_price
                FROM sales s
                JOIN products p ON s.product_id = p.id
                WHERE DATE_FORMAT(s.sale_date, '%Y-%m') = :month";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['month' => $month]);

        echo "<h3>Sales for " . htmlspecialchars($month) . "</h3>";
        echo "<table>";
        echo "<tr><th>ID</th><th>Product Name</th><th>Quantity Sold</th><th>Sale Price</th><th>Unit Price</th><th>Profit</th><th>Sale Date</th></tr>";

        $totalProfit = 0;
        $i=1;
        while ($row = $stmt->fetch()) {
            // Fetch product name for display
            $productId = $row['product_id'];
            $productNameQuery = "SELECT name FROM products WHERE id = :product_id";
            $productStmt = $pdo->prepare($productNameQuery);
            $productStmt->execute(['product_id' => $productId]);
            $product = $productStmt->fetch();
            $productName = $product['name'];

            // Calculate profit
            $profit = $row['sale_price'] - ($row['unit_price'] * $row['quantity']);
            $totalProfit += $profit;

            echo "<tr>";
            echo "<td>" . $i . "</td>";
            echo "<td>" . htmlspecialchars($productName) . "</td>";
            echo "<td>" . $row['quantity'] . "</td>";
            echo "<td>" . $row['sale_price'] . "</td>";
            echo "<td>" . $row['unit_price'] . "</td>";
            echo "<td>" . number_format($profit, 2) . "</td>";
            echo "<td>" . $row['sale_date'] . "</td>";
            echo "</tr>";
            $i=$i+1;
        }
        echo "<tr><td colspan='5'><strong>Total Profit:</strong></td><td colspan='2'><strong>" . number_format($totalProfit, 2) . "</strong></td></tr>";
        echo "</table>";
    }
    ?>

    <a href="index.php">Back to Home</a>
</body>
</html>
