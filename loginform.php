<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["email"]) && isset($_POST["passwd"])) {
        $email = $_POST["email"];
        $passwd = $_POST["passwd"];

        $usersFile = 'users.json';
        $usersData = file_get_contents($usersFile);

        if ($usersData !== false) {
            $usersArray = json_decode($usersData, true);
            foreach ($usersArray as $user) {
                if ($user["email"] == $email && password_verify($passwd, $user["password"])) {
                    // Sikeres bejelentkezés
                    session_start();
                    $_SESSION["email"] = $email;
                    header("Location: index.php");
                    exit();
                }
            }
            echo "Incorrect e-mail or password.";
        } else {
            echo "An error occurred while loading users.";
        }
    } else {
        echo "Missing email or password.";
    }
}
?>

