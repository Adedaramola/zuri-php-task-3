<?php
include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>
    <div class="container">
        <?php if ($msg['success']) : ?>
            <div class="alert alert-success">
                <span><?php echo $msg['success'] ?> Click to </span><a class="alert-link" href="login.php">login</a>
            </div>
        <?php endif; ?>
        <?php if ($msg['error']) : ?>
            <div class="alert alert-danger">
                <span><?php echo $msg['error'] ?>
            </div>
        <?php endif; ?>
        <form action="" method="post">
            <label for="">Email Address</label>
            <input type="email" name="email" placeholder="Email Address">
            <label for="">New Password</label>
            <input type="password" name="password" placeholder="Password">
            <button type="submit" name="reset_password">Reset</button>

            <a href="login.php">Back to login</a>
            <a href="register.php">Not yet registered?</a>
        </form>
    </div>
</body>

</html>