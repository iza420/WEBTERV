<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" type="text/css" href="css/cart.css" />

  <title>Cart</title>
</head>
<body id="top">
<?php include 'navbar.php'; ?>
  <table>
    <caption>
      <h2>Cart</h2>
    </caption>
    <tbody>
    <?php
  if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
      foreach ($_SESSION['cart'] as $key => $waffle) {
          echo "<tr>";
          echo "<td class='img'><img src='" . $waffle['img'] . "' alt='Waffle Image' /></td>";
          echo "<td class='name'>" . $waffle['name'] . "</td>";
          echo "<td class='price'>" . $waffle['price'] . "$</td>";
          echo "<td>";
          echo "<label class='toppings'>" . $waffle['topping'] . "</label>";
          echo "</td>";
          echo "<td>";
          echo "<form action='removeFromCart.php' method='post'>";
          echo "<input type='hidden' name='item_key' value='" . $key . "'/>";
          echo "<button type='submit' class='remove-button'>-</button>";
          echo "</form>";
          echo "</td>";
          echo "</tr>";
      }
      echo "<tr class='ordercontainer'>";
      echo "<td>";
      echo "<form action='order.php' method='post'>";
      echo "<button type='submit' class='order-button'>Order All</button>";
      echo "</form>";
      echo "</td>";
      echo "</tr>";
  } else {
      echo "<tr><td>Your cart is empty.</td></tr>";
  }
?>

      
    </tbody>
  </table>


  <a href="#top" id="toparrowcontainer"> ↑ </a>

  <footer>
    <a href="index.html">Home</a>
    <a href="waffles.html">Order</a>
    <a href="cart.html">Cart</a>
    <a href="login.html">Login</a>
    <a href="register.html">Register</a>
    <a href="index.html">About us</a>
    <a href="index.html">Contact us</a>
  </footer>

</body>

</html>
