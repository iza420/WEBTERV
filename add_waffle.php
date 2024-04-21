<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $waffleName = $_POST["waffleName"];
    $wafflePrice = $_POST["wafflePrice"];
    $waffleIngredients = $_POST["waffleIngredients"];
    $additionalToppings = $_POST["additionalToppings"];

    // Check if file has been uploaded
    if(isset($_FILES['waffleImage'])) {
        $file_tmp = $_FILES['waffleImage']['tmp_name'];
        // Generate a unique filename
        $file_name = uniqid() . '.png'; // You may want to adjust the extension depending on the uploaded file type
        // Define the directory to save the images
        $upload_dir = 'newimages/';
        // Move the uploaded file to the destination directory
        move_uploaded_file($file_tmp, $upload_dir . $file_name);
        // Store the file path in the text data
        $image_path = $upload_dir . $file_name;
    } else {
        // Handle the case where no image is uploaded
        $image_path = '';
    }

    // Format the data for storage
    $data = "$waffleName|$wafflePrice|$waffleIngredients|$additionalToppings|$image_path\n";

    // Open the text file
    $file = fopen("waffles.txt", "a");
    if ($file) {
        // Write data to the file
        fwrite($file, $data);
        fclose($file);
        header("Location: waffles.php");
        exit();
    } else {
        echo "Error: Unable to add waffle.";
    }
}
?>
