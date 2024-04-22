<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        if (isset($_SESSION['orders'])) {
            $_SESSION['orders'] = array_merge($_SESSION['orders'], $_SESSION['cart']);
        } else {
            $_SESSION['orders'] = $_SESSION['cart'];
        }
        $_SESSION['cart'] = array();
    }
    header("Location: profile.php");
    exit();
}
?>
