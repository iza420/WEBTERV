<?php
session_start();

if (!isset($_SESSION['email']) || empty($_SESSION['email'])) {
    die("User not logged in.");
}
$usersData = file_get_contents('json/users.json');
$users = json_decode($usersData, true);

$loggedInUserEmail = $_SESSION['email'];
$userData = null;

foreach ($users as $user) {
    if (isset($user['email']) && $user['email'] === $loggedInUserEmail) {
        $userData = $user;
        break;
    }
}

if (!$userData) {
    die("User data not found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" type="text/css" href="css/profile.css">
</head>
<body>
<?php include 'navbar.php'; ?>
<h2>Profile</h2>
<div class="container">
    <p>Personal data and shipping address</p>
    <form class="form" method="post" action="update_profile.php">
        <div class="row">
            <div class="col">
                <label for="firstName">First name:</label>
                <input type="text" id="firstName" name="firstName" value="<?php echo $userData['fname']; ?>" required>
            </div>
            <div class="col">
                <label for="lastName">Last name:</label>
                <input type="text" id="lastName" name="lastName" value="<?php echo $userData['lname']; ?>" required>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo $userData['email']; ?>" required autocomplete="email">
            </div>
            <div class="col">
                <label for="phone">Phone number:</label>
                <input type="tel" id="phone" name="phone" value="<?php echo $userData['phone-number']; ?>" autocomplete="tel">
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label for="country">Country:</label>
                <input type="text" id="country" name="country" value="<?php echo $userData['country']; ?>" required autocomplete="country">
            </div>
            <div class="col">
                <label for="zip">Postal code:</label>
                <input type="text" id="zip" name="zip" value="<?php echo $userData['postal-code']; ?>" required>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label for="city">City:</label>
                <input type="text" id="city" name="city" value="<?php echo $userData['city']; ?>" required>
            </div>
            <div class="col">
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" value="<?php echo $userData['address']; ?>" autocomplete="address-line1">
            </div>
        </div>
        <button type="submit">Save</button>
    </form>
    <button id="deletebutton">Delete Profile</button>
    
    </div>
    
    <h2>Order history</h2>
        <table>
        <tbody>
        <?php
if (isset($_SESSION['orders']) && !empty($_SESSION['orders'])) {
    foreach ($_SESSION['orders'] as $key => $order) {
        echo "<tr>";
        echo "<td class='img'><img src='" . $order['img'] . "' alt='Order Image' /></td>";
        echo "<td class='name'>" . $order['name'] . "</td>";
        echo "<td class='price'>" . $order['price'] . "$</td>";
        echo "<td>";
        echo "<label class='toppings'>" . $order['topping'] . "</label>";
        echo "</td>";
        echo "<td>";
        echo "<form action='addToCart.php' method='post'>";
        echo "<input type='hidden' name='name' value='" . $order['name'] . "'>";
        echo "<input type='hidden' name='img' value='" . $order['img'] . "'>";
        echo "<input type='hidden' name='price' value='" . $order['price'] . "'>";
        echo "<input type='hidden' name='topping' value='" . $order['topping'] . "'>";
        echo "<button type='submit' class='reorder-button'>Reorder</button>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td>You have no previous orders.</td></tr>";
}
?>


    </tbody>
        </table>
      <p id="no-orders-message">You haven't ordered yet.</p>
      <a href="adminlog.php" id="adminlink"> Admin </a>
      <a href="#top" id="toparrowcontainer"> ↑ </a>
      <footer>
      <a href="#top">Home</a>
      <a href="waffles.php">Order</a>
      <a href="cart.php">Cart</a>
      <a href="login.php">Login</a>
      <a href="register.php">Register</a>
      <a href="#aboutcontainer">About us</a>
      <a href="#contactus">Contact us</a>
    </footer>
    
  </body>
</html>