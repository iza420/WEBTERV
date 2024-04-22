<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['name']) && isset($_POST['price']) && isset($_POST['topping']) && isset($_POST['img'])) {
        $waffle = array(
            'name' => $_POST['name'],
            'price' => $_POST['price'],
            'topping' => $_POST['topping'],
            'img' => $_POST['img']
        );
        if (isset($_SESSION['cart'])) {
            $_SESSION['cart'][] = $waffle;
        } else {
            $_SESSION['cart'] = array($waffle);
        }
        header("Location: cart.php");
        exit();
    } else {
        echo "Error: Missing form data!";
    }
} else {
    echo "Error: Invalid request method!";
}
?>
