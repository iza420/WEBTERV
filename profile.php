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

    <div class="profile-picture">
        <h3>Upload Profile Picture</h3>
        <form action="upload.php" method="post" enctype="multipart/form-data">
            Select image to upload:
            <input type="file" name="fileToUpload" id="fileToUpload">
            <input type="submit" value="Upload Image" name="submit">
        </form>
    </div>
    
    
    <div class="profile-image-container">
        <div class="profile-image">
            <img src="uploads/kiscica.jpg" alt="Profile Picture" id="uploadedProfileImage">
        </div>
    </div>

    <div class="container">
      <p>Personal data and shipping address</p>
      <form class="form">
        <div class="row">
          <div class="col">
            <label for="firstName">First name:</label>
            <input type="text" id="firstName" name="firstName" required>
          </div>
          <div class="col">
            <label for="lastName">Last name:</label>
            <input type="text" id="lastName" name="lastName" required>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
          </div>
          <div class="col">
            <label for="phone">Phone number:</label>
            <input type="tel" id="phone" name="phone">
          </div>
        </div>
        <div class="row">
          <div class="col">
            <label for="country">Country:</label>
            <select id="country" name="country" required>
              <option value="">Choose from...</option>
              <option value="hungary">Hungary</option>
            </select>
          </div>
          <div class="col">
            <label for="zip">Postal code:</label>
            <input type="text" id="zip" name="zip" required>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <label for="city">City:</label>
            <input type="text" id="city" name="city" required>
          </div>
          <div class="col">
            <label for="address">Address:</label>
            <input type="text" id="address" name="address">
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
              echo "<td> <button class='add-button'>Reorder</button></td>";
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