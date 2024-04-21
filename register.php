<?php
session_start();

// Adatbázis kapcsolódás
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "database_name";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

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

    if (strlen($fname) > 25 || strlen($lname) > 25) {
        $errors[] = "First name or last name cannot exceed 25 characters.";
    }

    if ($password !== $password_check) {
        $errors[] = "Passwords do not match.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(array("success" => false, "message" => "Érvénytelen e-mail cím formátum."));
        exit;
    }

    // További ellenőrzések...

    // Ha nincs hiba, regisztráció végrehajtása
    if (empty($errors)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (first_name, last_name, password, phone_number, email)
                VALUES ('$fname', '$lname', '$hashed_password', '$phone_number', '$email')";

        if ($conn->query($sql) === TRUE) {
            $_SESSION["loggedin"] = true;
            $_SESSION["username"] = $email;
            header("Location: welcome.php");
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
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

$conn->close();
?>
