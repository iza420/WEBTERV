<?php
// Session kezelés inicializálása
session_start();

// Ellenőrizzük, hogy a kérés metódusa POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Betöltjük a felhasználók adatait tartalmazó JSON fájlt
    $usersData = file_get_contents('json/users.json');
    $users = json_decode($usersData, true);

    // Ellenőrizzük, hogy az adott felhasználó létezik-e a JSON fájlban
    $loggedInUserEmail = $_SESSION['email'];

    $userIndex = -1; // Kezdetben -1, hogy jelezzük, nem találtuk meg a felhasználót
    foreach ($users as $index => $user) {
        if ($user['email'] === $loggedInUserEmail) {
            $userIndex = $index;
            break;
        }
    }

    // Ha megtaláltuk a felhasználót, frissítjük az adatait
    if ($userIndex !== -1) {
        // Frissítjük a felhasználó adatait az űrlapról érkező adatokkal
        $users[$userIndex]['fname'] = $_POST['firstName'];
        $users[$userIndex]['lname'] = $_POST['lastName'];
        $users[$userIndex]['phone-number'] = $_POST['phone'];
        $users[$userIndex]['country'] = $_POST['country'];
        $users[$userIndex]['postal-code'] = $_POST['zip'];
        $users[$userIndex]['city'] = $_POST['city'];
        $users[$userIndex]['address'] = $_POST['address'];

        // Mentjük az frissített felhasználói adatokat a JSON fájlba
        file_put_contents('json/users.json', json_encode($users, JSON_PRETTY_PRINT));

        // Visszairányítás a profile.php oldalra, hogy az új adatok megjelenjenek
        header("Location: profile.php");
        exit();
    } else {
        die("User not found.");
    }
} else {
    die("Invalid request.");
}
?>