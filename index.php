<?php

include 'db.php';  // Ensure this path is correct and points to your database connection file



// Check if user is already logged in
if (isset($_SESSION['user_id'])) {
    header("Location: home.php");
    exit();
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and execute the SQL query to fetch user details
    $sql = "SELECT id, password FROM users WHERE username = :username";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch();

    // Verify the user's password
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        header("Location: home.php");
        exit();
    } else {
        $error = 'Invalid username or password.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<style type="text/css">
    /* Reset some basic styles */
body, h2, form {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Set the background image */
body {
    background: url('5.jpg') no-repeat center center fixed;
    background-size: cover;
    font-family: Arial, sans-serif;
    
}

/* Center the form on the page */
form {
    background: rgba(255, 255, 255, 0.8);
    padding: 20px;
    max-width: 400px;
    margin: 100px auto;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
}

/* Style the form elements */
h2 {
    text-align: center;
    margin-bottom: 20px;
}

label {
    display: block;
    margin-bottom: 5px;
}

input[type="text"], input[type="password"] {
    width: calc(100% - 22px);
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

button {
    width: 100%;
    padding: 10px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

button:hover {
    background-color: #45a049;
}

p {
    color: red;
    text-align: center;
    margin-top: -15px;
}

</style>
<body>
   
    <form action="index.php" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <button type="submit">Login</button>
        <?php if ($error): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>
    </form>
</body>
</html>
