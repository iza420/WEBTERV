<?php
// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the required fields are filled
    if (isset($_POST['fname'], $_POST['lname'], $_POST['passwd'], $_POST['passwd-check'], $_POST['phone-number'], $_POST['email'], $_POST['country'], $_POST['postal-code'], $_POST['city'], $_POST['address'])) {
        
        // Check if the first name or last name exceeds 25 characters
        if (strlen($_POST['fname']) > 25 || strlen($_POST['lname']) > 25) {
            die("First name and/or last name cannot exceed 25 characters.");
        }
        // Check if passwords match
        if ($_POST['passwd'] !== $_POST['passwd-check']) {
            die("Passwords do not match.");
        }

        // Check if the password is at least 8 characters long
        if (strlen($_POST['passwd']) < 8) {
            die("Password is too short. It must be at least 8 characters long.");
        }

        // Check if the email address is valid
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            die("Invalid email address.");
        }

        // Check if the phone number is in the correct format
        if (!preg_match("/^36[0-9]{9}$/", $_POST['phone-number'])) {
            die("Invalid phone number. It should start with '36' and followed by 9 digits.");
        }

        // Check if the email address has not been registered already
        $usersData = file_get_contents('json/users.json');
        $users = json_decode($usersData, true);

        foreach ($users as $user) {
            if ($user['email'] === $_POST['email']) {
                die("This email address is already registered.");
            }
        }

        // If all checks pass, store the new user's data
        $newUser = [
            'fname' => $_POST['fname'],
            'lname' => $_POST['lname'],
            'passwd' => password_hash($_POST['passwd'], PASSWORD_DEFAULT), // Hash the password
            'phone-number' => $_POST['phone-number'],
            'email' => $_POST['email'],
            'country' => $_POST['country'],
            'postal-code' => $_POST['postal-code'],
            'city' => $_POST['city'],
            'address' => $_POST['address']
        ];

        // Add the new user to the list of users
        $users[] = $newUser;

        // Save the updated list of users to the users.json file
        file_put_contents('json/users.json', json_encode($users, JSON_PRETTY_PRINT));

        // Successful registration message
        echo "Registration successful!";

        // Redirect to login.php or profile.php as needed
        header("Location: login.php");
        exit();
    } else {
        die("Missing form fields.");
    }
}
?>
