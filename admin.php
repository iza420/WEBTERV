<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="css/admin.css" />
    <title>Admin</title>
  </head>
  <body>
  <?php include 'navbar.php'; ?>

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
        <label for="waffleName">Remove Waffle:</label>
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
    

    <?php include 'footer.php'; ?>

  </body>
</html>
