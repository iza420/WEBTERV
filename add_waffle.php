<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $waffleName = $_POST["waffleName"];
    $wafflePrice = $_POST["wafflePrice"];
    $waffleIngredients = $_POST["waffleIngredients"];
    $additionalToppings = $_POST["additionalToppings"];

    if(isset($_FILES['waffleImage'])) {
        $file_tmp = $_FILES['waffleImage']['tmp_name'];
        $file_name = uniqid() . '.png';
        $upload_dir = 'newimages/';
        move_uploaded_file($file_tmp, $upload_dir . $file_name);
        $image_path = $upload_dir . $file_name;
    } else {
        $image_path = '';
    }

    $data = "$waffleName|$wafflePrice|$waffleIngredients|$additionalToppings|$image_path\n";

    $file = fopen("waffles.txt", "a");
    if ($file) {
        fwrite($file, $data);
        fclose($file);
        header("Location: waffles.php");
        exit();
    } else {
        echo "Error: Unable to add waffle.";
    }
}
?>
