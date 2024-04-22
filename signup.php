<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    if (isset($_POST['fname'], $_POST['lname'], $_POST['passwd'], $_POST['passwd-check'], $_POST['phone-number'], $_POST['email'], $_POST['country'], $_POST['postal-code'], $_POST['city'], $_POST['address'])) {
        
        
        if (strlen($_POST['fname']) > 25 || strlen($_POST['lname']) > 25) {
            die("First name and/or last name cannot exceed 25 characters.");
        }
        
        if ($_POST['passwd'] !== $_POST['passwd-check']) {
            die("Passwords do not match.");
        }

        if (strlen($_POST['passwd']) < 8) {
            die("Password is too short. It must be at least 8 characters long.");
        }

        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            die("Invalid email address.");
        }

        if (!preg_match("/^36[0-9]{9}$/", $_POST['phone-number'])) {
            die("Invalid phone number. It should start with '36' and followed by 9 digits.");
        }

        $usersData = file_get_contents('json/users.json');
        $users = json_decode($usersData, true);

        foreach ($users as $user) {
            if ($user['email'] === $_POST['email']) {
                die("This email address is already registered.");
            }
        }

        $newUser = [
            'fname' => $_POST['fname'],
            'lname' => $_POST['lname'],
            'passwd' => password_hash($_POST['passwd'], PASSWORD_DEFAULT),
            'phone-number' => $_POST['phone-number'],
            'email' => $_POST['email'],
            'country' => $_POST['country'],
            'postal-code' => $_POST['postal-code'],
            'city' => $_POST['city'],
            'address' => $_POST['address']
        ];

        $users[] = $newUser;
        file_put_contents('json/users.json', json_encode($users, JSON_PRETTY_PRINT));
        echo "Registration successful!";

        header("Location: login.php");
        exit();
    } else {
        die("Missing form fields.");
    }
}
?>
