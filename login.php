<?php
// Ellenőrizzük, hogy a form elküldte az adatokat a POST metódussal
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ellenőrizzük és mentjük a beérkező adatokat
    $fname = htmlspecialchars($_POST["fname"]);
    $lname = htmlspecialchars($_POST["lname"]);
    $passwd = $_POST["passwd"];
    $passwd_check = $_POST["passwd-check"];
    $phone_number = htmlspecialchars($_POST["phone-number"]);
    $email = $_POST["email"];

    // Ellenőrizzük, hogy a jelszavak megegyeznek-e
    if ($passwd !== $passwd_check) {
        echo json_encode(array("success" => false, "message" => "A megadott jelszavak nem egyeznek."));
        exit;
    }

    // Validáljuk az e-mail címet
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(array("success" => false, "message" => "Érvénytelen e-mail cím formátum."));
        exit;
    }

    // A regisztráció sikeres volt, ha minden validáció rendben van
    // Itt lehetőség van az adatok adatbázisba mentésére vagy más kezelésére

    // Példa: sikeres regisztráció válasz küldése JSON formátumban
    echo json_encode(array("success" => true, "message" => "Sikeres regisztráció. Üdvözöljük, $fname $lname!"));
} else {
    // Ha nem POST metódussal érkezett az adat, hiba választ küldünk
    echo json_encode(array("success" => false, "message" => "Érvénytelen kérési mód."));
}
?>
