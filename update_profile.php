<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $country = isset($_POST["country"]) ? $_POST["country"] : "";
    $zip = isset($_POST["zip"]) ? $_POST["zip"] : "";
    $city = isset($_POST["city"]) ? $_POST["city"] : "";
    $address = isset($_POST["address"]) ? $_POST["address"] : "";

    
    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && isset($_SESSION["userdata"])) {
        $_SESSION["userdata"]["country"] = $country;
        $_SESSION["userdata"]["zip"] = $zip;
        $_SESSION["userdata"]["city"] = $city;
        $_SESSION["userdata"]["address"] = $address;

        file_put_contents('userdata.json', json_encode($_SESSION["userdata"]));

        header("location: profile.php");
        exit;
        
    }else {
       
        header("location: login.php");
        exit;
    }
}

?>