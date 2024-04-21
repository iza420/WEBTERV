<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="css/admin.css" />
    <title>Admin</title>
  </head>
  <body>
    <header>
      <div id="logo">
        <a href="index.html" id="index">Fluffy Stack Café</a>
      </div>
      <div id="headerlinks">
        <a href="index.html">Home</a>
        <a href="waffles.html">Waffles</a>
        <a href="login.html">Login</a>
        <a href="register.html">Register</a>
        <a href="profile.html">Profile</a>
        <a href="cart.html"><img src="resources/cart.png" alt="cart" /></a>
      </div>
    </header>

    <h2>Admin Page</h2>
    <form action="add_waffle.php" id="waffleForm" method="POST" enctype="multipart/form-data">
      <div>
        <label for="waffleName">Waffle Name:</label>
        <input type="text" id="waffleName" name="waffleName" required />
      </div>
      <div>
        <label for="wafflePrice">Waffle Price:</label>
        <input
          type="number"
          id="wafflePrice"
          name="wafflePrice"
          step="0.01"
          required
        />
      </div>
      <div>
        <label for="waffleIngredients">Waffle Ingredients:</label>
        <textarea
          id="waffleIngredients"
          name="waffleIngredients"
          required
        ></textarea>
      </div>
      <div>
        <label for="additionalToppings">Additional Toppings: (list the toppings with commas)</label>
        <textarea id="additionalToppings" name="additionalToppings"></textarea>
      </div>
      <div>
        <label for="waffleImage">Waffle Image:</label>
        <input
          type="file"
          id="waffleImage"
          name="waffleImage"
          accept="image/*" required
        />
      </div>
      <button type="submit">Save Waffle</button>
    </form>

    <form action="deleteWaffle.php" class="delete" id="deleteForm" method="post">
      <div>
        <label for="waffleName">Waffle Name:</label>
        <select id="waffleName" name="waffleName" required>
          <option value="" selected disabled>Select Waffle</option>
          <?php
          $wafflesData = file("waffles.txt", FILE_IGNORE_NEW_LINES);
          foreach ($wafflesData as $waffle) {
              $waffleDetails = explode("|", $waffle);
              echo "<option value='{$waffleDetails[0]}'>{$waffleDetails[0]}</option>";
          }
          ?>
        </select>
      </div>
      <button type="submit">Remove Waffle</button>
    </form>
    

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
