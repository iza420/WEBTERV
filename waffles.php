<?php
$file = fopen("waffles.txt", "r");
if ($file) {
  while ($line = fgets($file)) {
    $waffleData[] = explode("|", $line);
  }
  fclose($file);
} else {
  echo "Error: Unable to read waffle data.";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" type="text/css" href="css/waffles.css" />

  <title>Menu</title>
</head>

<body id="top">
  <header>
    <div id="logo">
      <a href="index.html" id="index">Fluffy Stack Café</a>
    </div>
    <div id="headerlinks">
      <a href="index.html">Home</a>
      <a href="waffles.html" id="current">Waffles</a>
      <a href="login.html">Login</a>
      <a href="register.html">Register</a>
      <a href="profile.html">Profile</a>
      <a href="cart.html"><img src="resources/cart.png" alt="cart" /></a>
    </div>
  </header>

  <table>
    <caption>
      <h2>Menu</h2>
    </caption>
    <tbody>
      <?php foreach ($waffleData as $data) : ?>
        <tr>
          <td class="img"><img src="<?php echo $data[4]; ?>" alt="" /></td>
          <td class="name"><?php echo $data[0]; ?></td>
          <td class="ingredients"><?php echo $data[2]; ?></td>
          <td class="price"><?php echo $data[1]; ?>$</td>
          <td>
            <label class="toppings">Additional Toppings:</label>
            <select name="topping" class="toppings">
              <option value="none" selected>Choose Additional Topping:</option>
              <?php
              $toppingsArray = explode(",", $data[3]);
              foreach ($toppingsArray as $topping) {
                echo "<option value='$topping'>$topping</option>";
              }
              ?>
            </select>
          </td>
          <td>
            <form action="addToCart.php" method="post">
              <input type="hidden" name="name" value="<?php echo $data[0]; ?>">
              <input type="hidden" name="img" value="<?php echo $data[4]; ?>">
              <input type="hidden" name="price" value="<?php echo $data[1]; ?>">
              <input type="hidden" name="topping" value="<?php echo $topping; ?>">
              <button type="submit" class="add-button">+</button>
            </form>

          </td>
        </tr>
      <?php endforeach; ?>

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