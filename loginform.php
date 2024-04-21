<?php
// Ellenőrizzük, hogy a POST kérés megtörtént-e
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ellenőrizzük, hogy a szükséges mezők meg lettek-e adva
    if (isset($_POST["email"]) && isset($_POST["passwd"])) {
        $email = $_POST["email"];
        $passwd = $_POST["passwd"];

        // Betöltjük a users.json fájlt
        $usersFile = 'users.json';
        $usersData = file_get_contents($usersFile);

        if ($usersData !== false) {
            // JSON adatok dekódolása tömbbé
            $usersArray = json_decode($usersData, true);

            // Ellenőrizzük, hogy a felhasználó létezik-e és a jelszó helyes-e
            foreach ($usersArray as $user) {
                if ($user["email"] == $email && password_verify($passwd, $user["password"])) {
                    // Sikeres bejelentkezés
                    session_start();
                    $_SESSION["email"] = $email;
                    
                    // Átirányítás az index.html-re
                    header("Location: index.html");
                    exit();
                }
            }
            // Sikertelen bejelentkezés
            echo "Hibás e-mail vagy jelszó.";
        } else {
            echo "Hiba történt a felhasználók betöltésekor.";
        }
    } else {
        echo "Hiányzó e-mail vagy jelszó.";
    }
}

?>

