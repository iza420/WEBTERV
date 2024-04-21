<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["waffleName"])) {
        $waffleName = $_POST["waffleName"];
        $wafflesData = file("waffles.txt");
        $file = fopen("waffles.txt", "w");
        if ($file) {
            foreach ($wafflesData as $waffle) {
                $waffleDetails = explode("|", $waffle);
                if ($waffleDetails[0] != $waffleName) {
                    fwrite($file, $waffle);
                }
            }
            fclose($file);
            header("Location: waffles.php");
            exit();
        } else {
            echo "Error: Unable to open waffles file.";
        }
    } else {
        echo "Error: Waffle name not provided.";
    }
}
?>
