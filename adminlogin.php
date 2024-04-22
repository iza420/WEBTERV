<?php
session_start();

$admin_data = json_decode(file_get_contents('json/admin.json'), true);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $adminname = $_POST['adminname'];
    $passwd = $_POST['passwd'];

    if ($adminname == $admin_data['adminname'] && $passwd == $admin_data['passwd']) {
        $_SESSION['adminname'] = $adminname;
        header("Location: admin.php");
    } else {
        echo "Access denied!";
    }
}
?>
