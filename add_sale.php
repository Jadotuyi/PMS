<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = $_POST['product_id'];
    $quantitySold = $_POST['quantity'];
    $salePrice = $_POST['sale_price'];

    try {
        // Fetch the current quantity and unit price of the product
        $sql = "SELECT quantity, price FROM products WHERE id = :product_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['product_id' => $productId]);
        $product = $stmt->fetch();

        if ($product) {
            $currentQuantity = $product['quantity'];
            $unitPrice = $product['price'];

            if ($quantitySold <= $currentQuantity) {
                // Calculate the new quantity
                $newQuantity = $currentQuantity - $quantitySold;

                // Insert the sale into the sales table
                $sql = "INSERT INTO sales (product_id, quantity, sale_price) VALUES (:product_id, :quantity, :sale_price)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    'product_id' => $productId,
                    'quantity' => $quantitySold,
                    'sale_price' => $salePrice
                ]);

                // Update the product quantity in the products table
                $sql = "UPDATE products SET quantity = :new_quantity WHERE id = :product_id";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    'new_quantity' => $newQuantity,
                    'product_id' => $productId
                ]);

                echo "<p>Sale added and product quantity updated successfully.</p>";
            } else {
                echo "<p>Not enough stock available.</p>";
            }
        } else {
            echo "<p>Product not found.</p>";
        }
    } catch (PDOException $e) {
        echo "<p>Error: " . $e->getMessage() . "</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Sale</title>
    <link rel="stylesheet" href="css/style.css">
     <link rel="icon" type="image/png" sizes="32x32" href="path/to/your/favicon.png">
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

/* Form container styles */
.container {
    width: 80%;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

/* Form styles */
form {
    display: flex;
    flex-direction: column;
    gap: 10px;
    max-width: 600px;
    margin: 0 auto;
}

label {
    font-weight: bold;
    margin-bottom: 5px;
}

input[type="number"],
select {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    width: 100%;
}

button {
    padding: 10px;
    border: none;
    border-radius: 4px;
    background-color: #007bff;
    color: #fff;
    cursor: pointer;
    font-size: 16px;
}

button:hover {
    background-color: #0056b3;
}

/* Message styles */
p {
    text-align: center;
    color: #333;
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
    <h2>Add Sale</h2>
    <form action="add_sale.php" method="POST">
        <label for="product_id">Product:</label>
        <select id="product_id" name="product_id" required>
            <?php
            include 'php/db.php';
            $sql = "SELECT id, name FROM products";
            $stmt = $pdo->query($sql);
            while ($row = $stmt->fetch()) {
                echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
            }
            ?>
        </select>
        <label for="quantity">Quantity Sold:</label>
        <input type="number" step="0.25" id="quantity" name="quantity" required>
        <label for="sale_price">Sale Price:</label>
        <input type="number" step="0.01" id="sale_price" name="sale_price" required>
        <button type="submit">Add Sale</button>
        
    </form>
    
    <a href="index.php">Back to Home</a>

</body>
</html>
