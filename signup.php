<?php
session_start();

// Űrlap adatok ellenőrzése és feldolgozása
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = clean_input($_POST["fname"]);
    $lname = clean_input($_POST["lname"]);
    $password = clean_input($_POST["passwd"]);
    $password_check = clean_input($_POST["passwd-check"]);
    $phone_number = clean_input($_POST["phone-number"]);
    $email = clean_input($_POST["email"]);

    // Ellenőrzési logika
    $errors = [];

    if (strlen($fname) > 25) {
        $errors[] = "First name or last name cannot exceed 25 characters.";
    }
    if ( strlen($lname) > 25) {
        $errors[] = "First name or last name cannot exceed 25 characters.";
    }

    if ($password !== $password_check) {
        $errors[] = "Passwords do not match.";
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    // Ha nincs hiba, regisztráció végrehajtása
    if (empty($errors)) {
        // Adatok mentése JSON fájlba
        $userData = [
            "first_name" => $fname,
            "last_name" => $lname,
            "password" => password_hash($password, PASSWORD_DEFAULT),
            "phone_number" => $phone_number,
            "email" => $email
        ];

        $jsonFile = 'users.json';
        $usersData = json_decode(file_get_contents($jsonFile), true);
        $usersData[] = $userData;
        file_put_contents($jsonFile, json_encode($usersData, JSON_PRETTY_PRINT));

        // Sikeres regisztráció esetén átirányítás a login oldalra
        $_SESSION["loggedin"] = true;
        $_SESSION["username"] = $email;
        header("Location: login.php");
        exit;
    } else {
        // Hibaüzenetek megjelenítése
        foreach ($errors as $error) {
            echo "<p>Error: $error</p>";
        }
    }
}

function clean_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
