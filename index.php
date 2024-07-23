<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management System</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<style type="text/css">
    body {
    font-family: Arial, sans-serif;
    /*background-color: #f4f4f4;*/
    margin: 0;
            padding: 0;
            background-image: url('4.jpg'); /* Adjust the path to your background image */
            background-size: cover;
            background-position: center;
            color: #fff;
}

h1 {
    text-align: center;
}

.nav-container {
    text-align: center;
    margin-bottom: 20px;
}

.nav-button {
    background-color: #4CAF50;
    color: white;
    border: none;
    padding: 15px 30px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 5px;
}

.nav-button:hover {
    background-color: #45a049;
}

/* Dropdown container */
.dropdown {
    position: relative;
    display: inline-block;
}

/* Dropdown button */
.dropbtn {
    background-color: #4CAF50;
    color: white;
    padding: 15px 30px;
    font-size: 16px;
    border: none;
    cursor: pointer;
    border-radius: 5px;
}

/* Dropdown content (hidden by default) */
.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

/* Links inside the dropdown */
.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

/* Change color of dropdown links on hover */
.dropdown-content a:hover {
    background-color: #f1f1f1;
}

/* Show the dropdown menu on hover */
.dropdown:hover .dropdown-content {
    display: block;
}

/* Change the background color of the dropdown button when the dropdown content is shown */
.dropdown:hover .dropbtn {
    background-color: #3e8e41;
}

</style>
<body>
    <h1>Product Management System</h1>
    <div class="nav-container">
        <!-- Products Dropdown -->
        <div class="dropdown">
            <button class="nav-button dropbtn">Products</button>
            <div class="dropdown-content">
                <a href="view_products.php">View Products</a>
                <a href="add_product.php">Add New Product</a>
                <a href="update_price.php">Update Product Price</a>
                <a href="update_quantity.php">Update Product Quantity</a>
            </div>
        </div>
        <!-- Sales Dropdown -->
        <div class="dropdown">
            <button class="nav-button dropbtn">Sales</button>
            <div class="dropdown-content">
                <a href="add_sale.php">Add Sale</a>
                <a href="view_sales.php">View All Sales</a>
            </div>
        </div>
        <!-- Report Dropdown -->
        <div class="dropdown">
            <button class="nav-button dropbtn">Report</button>
            <div class="dropdown-content">
                <a href="daily_report.php">Daily Report</a>
                <a href="weekly_report.php">Weekly Report</a>
                <a href="monthly_report.php">Monthly Report</a>
            </div>
        </div>
    </div>
</body>
</html>
