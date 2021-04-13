<?php
include 'config.php';

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>
    <div class="alert alert-info home-msg">
        <p>Hello there <strong><?php echo $_SESSION['username'] ?></strong></p>
        <span><a href="logout.php">Logout</a></span>
    </div>
</body>

</html>