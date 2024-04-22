<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["email"]) && isset($_POST["passwd"])) {
        $email = $_POST["email"];
        $passwd = $_POST["passwd"];

        $usersFile = 'json/users.json';
        $usersData = file_get_contents($usersFile);

        if ($usersData !== false) {
            $usersArray = json_decode($usersData, true);
            foreach ($usersArray as $user) {
                if ($user["email"] == $email && password_verify($passwd, $user["passwd"])) { 
                    $_SESSION["email"] = $email;
                    header("Location: profile.php"); 
                    exit();
                }
            }
            // If no matching user is found, redirect to index.php with alert
            header("Location: index.php?loginFailed=true");
            exit();
        } else {
            // Error loading users file
            header("Location: index.php?error=true");
            exit();
        }
    } else {
        // Missing email or password
        header("Location: index.php?error=true");
        exit();
    }
}
?>



