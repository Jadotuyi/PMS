<?php
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

// The rest of your protected page content goes here
?>
<?php 
 
 if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = $_POST['product_id'];
    $newQuantity = $_POST['new_quantity'];

    // Fetch the current quantity
    $sql = "SELECT quantity FROM products WHERE id = :product_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['product_id' => $productId]);
    $currentQuantity = $stmt->fetchColumn();

    if ($currentQuantity !== false) {
        // Calculate the new total quantity
        $totalQuantity = $currentQuantity + $newQuantity;

        // Update the quantity in the database
        $sql = "UPDATE products SET quantity = :total_quantity WHERE id = :product_id";
        $stmt = $pdo->prepare($sql);
        
        try {
            $stmt->execute([
                'total_quantity' => $totalQuantity,
                'product_id' => $productId
            ]);
            echo "<p>Product quantity updated successfully.</p>";
        } catch (PDOException $e) {
            echo "<p>Error: " . $e->getMessage() . "</p>";
        }
    } else {
        echo "<p>Product not found.</p>";
    }
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product Quantity</title>
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
    <h2>Update Product Quantity</h2>
    <form action="update_quantity.php" method="POST">
        <label for="product_id">Product:</label>
        <select id="product_id" name="product_id" required>
            <?php
            $sql = "SELECT id, name FROM products";
            $stmt = $pdo->query($sql);

            while ($row = $stmt->fetch()) {
                echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
            }
            ?>
        </select>
        <label for="new_quantity">New Quantity:</label>
        <input type="number" step="0.25" id="new_quantity" name="new_quantity" required>
        <button type="submit">Update Quantity</button>
    </form>

    <a href="home.php">Back to Home</a>
</body>
</html>
