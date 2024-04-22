<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["email"]) && isset($_POST["passwd"])) {
        $email = $_POST["email"];
        $passwd = $_POST["passwd"];

        $usersFile = 'json/users.json'; // A users.json fájl elérési útvonala
        $usersData = file_get_contents($usersFile);

        if ($usersData !== false) {
            $usersArray = json_decode($usersData, true);
            foreach ($usersArray as $user) {
                if ($user["email"] == $email && password_verify($passwd, $user["passwd"])) { // Megfelelő jelszó ellenőrzése
                    // Sikeres bejelentkezés
                    $_SESSION["email"] = $email;
                    header("Location: profile.php"); // Átirányítás a profil oldalra
                    exit();
                }
            }
            echo "Incorrect email or password."; // Hibás e-mail vagy jelszó
        } else {
            echo "An error occurred while loading users."; // Hiba az adatok betöltése közben
        }
    } else {
        echo "Missing email or password."; // Hiányzó e-mail vagy jelszó
    }
}
?>


