<?php
include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>
    <div class="container">
        <?php if ($msg['success']) : ?>
            <div class="alert alert-success">
                <span><?php echo $msg['success'] ?> Click to </span><a class="alert-link" href="login.php">login</a>
            </div>
        <?php endif; ?>
        <form action="" method="post">
            <label for="">Firstname</label>
            <input type="text" name="firstname" placeholder="firstname" required>
            <label for="">Lastname</label>
            <input type="text" name="lastname" placeholder="Lastname" required>
            <label for="">Email Address</label>
            <input type="email" name="email" placeholder="Email Address" required>
            <label for="">Password</label>
            <input type="password" name="password" placeholder="Pasword" required>
            <button type="submit" name="register">Submit</button>

            <a href="login.php">Already have account</a>
        </form>
    </div>
</body>

</html>