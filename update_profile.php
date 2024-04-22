<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usersData = file_get_contents('json/users.json');
    $users = json_decode($usersData, true);

    $loggedInUserEmail = $_SESSION['email'];

    $userIndex = -1; 
    foreach ($users as $index => $user) {
        if ($user['email'] === $loggedInUserEmail) {
            $userIndex = $index;
            break;
        }
    }

    if ($userIndex !== -1) {
        $users[$userIndex]['fname'] = $_POST['firstName'];
        $users[$userIndex]['lname'] = $_POST['lastName'];
        $users[$userIndex]['phone-number'] = $_POST['phone'];
        $users[$userIndex]['country'] = $_POST['country'];
        $users[$userIndex]['postal-code'] = $_POST['zip'];
        $users[$userIndex]['city'] = $_POST['city'];
        $users[$userIndex]['address'] = $_POST['address'];

        file_put_contents('json/users.json', json_encode($users, JSON_PRETTY_PRINT));

        header("Location: profile.php");
        exit();
    } else {
        die("User not found.");
    }
} else {
    die("Invalid request.");
}
?>