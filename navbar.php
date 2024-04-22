<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="css/navbar.css">
</head>
<body>
<header>
      <div id="logo">
        <a href="index.php" id="index">Fluffy Stack Café</a>
      </div>
      <div id="headerlinks">
        <a <?php if(basename($_SERVER['PHP_SELF']) == 'index.php') echo 'class="active"'; ?> href="index.php">Home</a>
        <a <?php if(basename($_SERVER['PHP_SELF']) == 'waffles.php') echo 'class="active"'; ?> href="waffles.php">Waffles</a>
        <a <?php if(basename($_SERVER['PHP_SELF']) == 'login.php'); ?> href="login.php">Login</a>
        <a <?php if(basename($_SERVER['PHP_SELF']) == 'register.php'); ?> href="register.php">Register</a>
        <a <?php if(basename($_SERVER['PHP_SELF']) == 'profile.php') echo 'class="active"'; ?> href="profile.php">Profile</a>
        <a <?php if(basename($_SERVER['PHP_SELF']) == 'cart.php')?> href="cart.php">
            <?php if(basename($_SERVER['PHP_SELF']) == 'cart.php') : ?>
                <img src="resources/blackcart.png" alt="cart">
            <?php else: ?>
                <img src="resources/cart.png" alt="cart">
            <?php endif; ?>
        </a>
      </div>
</header>
</body>
</html>
