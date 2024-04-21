<?php
session_start();

if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    $file = fopen("previous_orders.txt", "a");
    foreach ($_SESSION['cart'] as $key => $waffle) {
        fwrite($file, $waffle['name'] . "\n");
    }
    fclose($file);

    $_SESSION['cart'] = array();
    header("Location: cart.php?order=success");
} else {
    header("Location: cart.php?order=empty");
}
?>
