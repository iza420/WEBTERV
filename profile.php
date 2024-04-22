<?php
session_start();

// Ellenőrizzük, hogy be van-e jelentkezve a felhasználó
if (!isset($_SESSION['email']) || empty($_SESSION['email'])) {
    die("User not logged in.");
}

// Betöltjük a felhasználó adatait a users.json fájlból
$usersData = file_get_contents('json/users.json');
$users = json_decode($usersData, true);

// Ellenőrizzük, hogy a bejelentkezett felhasználó szerepel-e a listában
$loggedInUserEmail = $_SESSION['email']; // Az aktuálisan bejelentkezett felhasználó e-mail címe
$userData = null;

foreach ($users as $user) {
    if ($user['email'] === $loggedInUserEmail) {
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
                <input type="email" id="email" name="email" value="<?php echo $userData['email']; ?>" required>
            </div>
            <div class="col">
                <label for="phone">Phone number:</label>
                <input type="tel" id="phone" name="phone" value="<?php echo $userData['phone-number']; ?>">
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label for="country">Country:</label>
                <input type="text" id="country" name="country" value="<?php echo $userData['country']; ?>" required>
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
                <input type="text" id="address" name="address" value="<?php echo $userData['address']; ?>">
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
$file = fopen("previous_orders.txt", "r");
if ($file) {
    while (($line = fgets($file)) !== false) {
        $waffleName = trim($line);
        echo "<tr>";
        echo "<td class='name'>" . $waffleName . "</td>";
        echo "<td>";
        echo "<form action='addprevioustocart.php' method='post'>";
        echo "<input type='hidden' name='waffleName' value='" . $waffleName . "'/>";
        echo "<button type='submit' class='add-button'>Reorder</button>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
    }
    fclose($file);
} else {
    echo "<tr><td>Error: Unable to open previous_orders.txt.</td></tr>";
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