<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = clean_input($_POST["fname"]);
    $lname = clean_input($_POST["lname"]);
    $password = clean_input($_POST["passwd"]);
    $password_check = clean_input($_POST["passwd-check"]);
    $phone_number = clean_input($_POST["phone-number"]);
    $email = clean_input($_POST["email"]);

    $errors = [];

    if (strlen($fname) > 25 || strlen($lname) > 25) {
        $errors[] = "First name or last name cannot exceed 25 characters.";
    }

    if ($password !== $password_check) {
        $errors[] = "Passwords do not match.";
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    // Check if email already exists
    $existingUsers = getUsersData();
    foreach ($existingUsers as $userData) {
        if ($userData['email'] === $email) {
            $errors[] = "Email address already registered.";
            break;
        }
    }

    if (empty($errors)) {
        $userData = [
            "first_name" => $fname,
            "last_name" => $lname,
            "phone_number" => $phone_number,
            "email" => $email
        ];

        // Save new user data to users.json
        $existingUsers[] = $userData;
        saveUsersData($existingUsers);

        // Store user data in session (without password)
        $_SESSION["loggedin"] = true;
        unset($userData['password']); // Remove password before storing in session
        $_SESSION["user_data"] = $userData;

        // Redirect to profile.php after successful registration
        header("Location: profile.php");
        exit;
    } else {
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

function getUsersData() {
    $jsonFile = 'users.json';
    if (file_exists($jsonFile)) {
        return json_decode(file_get_contents($jsonFile), true);
    }
    return [];
}

function saveUsersData($usersData) {
    $jsonFile = 'users.json';
    file_put_contents($jsonFile, json_encode($usersData, JSON_PRETTY_PRINT));
}
?>


