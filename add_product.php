<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Product</title>
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

input[type="text"],
input[type="number"] {
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
    <h2>Add New Product</h2>
    <form action="add_product.php" method="POST">
        <label for="name">Product Name:</label>
        <input type="text" id="name" name="name" required>
        <label for="price">Price per Unit:</label>
        <input type="number" step="0.01" id="price" name="price" required>
        <label for="quantity">Quantity:</label>
        <input type="number" step="0.01" id="quantity" name="quantity" required>
        <button type="submit">Add Product</button>
    </form>

    <?php
    include 'db.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];

        $sql = "INSERT INTO products (name, price, quantity) VALUES (:name, :price, :quantity)";
        $stmt = $pdo->prepare($sql);

        try {
            $stmt->execute([
                'name' => $name,
                'price' => $price,
                'quantity' => $quantity
            ]);
            echo "<p>Product added successfully.</p>";
        } catch (PDOException $e) {
            echo "<p>Error: " . $e->getMessage() . "</p>";
        }
    }
    ?>

    <a href="index.php">Back to Home</a>
</body>
</html>
