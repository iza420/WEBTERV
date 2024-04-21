<?php
$usersData = file_get_contents('users.json');
$users = json_decode($usersData, true);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['adminname']) && isset($_POST['passwd'])) {
        $adminname = $_POST['adminname'];
        $password = $_POST['passwd'];
        $isAdmin = false;
        foreach ($users as $key => $user) {
            if (isset($user['first_name']) && isset($user['last_name']) && isset($user['email']) && isset($user['password'])) {
                $fullName = $user['first_name'] . ' ' . $user['last_name'];
                $userEmail = $user['email'];
                $userPasswordHash = $user['password'];
                if ($adminname === $fullName && $userEmail === $password) {
                    if (substr($userEmail, -10) === '@waffle.hu') {
                        $isAdmin = true;
                        break;
                    }
                }
            }
        }
        if ($isAdmin) {
            header("Location: admin.php");
            exit();
        } else {
            echo "Permission denied!";
        }
    }
}
?>


