<?php
// Betöltjük a felhasználók adatait tartalmazó JSON fájlt
$usersData = file_get_contents('users.json');
$users = json_decode($usersData, true);

// Ellenőrizzük, hogy POST kérés történt-e
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ellenőrizzük, hogy a POST adatok megtörténtek-e
    if (isset($_POST['adminname']) && isset($_POST['passwd'])) {
        $adminname = $_POST['adminname'];
        $password = $_POST['passwd'];

        // Ellenőrizzük, hogy a bejelentkezett admin felhasználó létezik és admin email címmel rendelkezik
        $isAdmin = false;
        foreach ($users as $key => $user) {
            if (isset($user['first_name']) && isset($user['last_name']) && isset($user['email']) && isset($user['password'])) {
                $fullName = $user['first_name'] . ' ' . $user['last_name'];
                $userEmail = $user['email'];
                $userPasswordHash = $user['password'];

                // Ellenőrizzük, hogy a felhasználónév és jelszó helyes
                if ($adminname === $fullName && $userEmail === $password) {
                    // Ellenőrizzük az admin jogosultságot (email vége: waffle.hu)
                    if (substr($userEmail, -10) === '@waffle.hu') {
                        $isAdmin = true;
                        break;
                    }
                }
            }
        }

        // Ha a bejelentkezés sikeres és admin jogosultsággal rendelkező felhasználó
        if ($isAdmin) {
            // Átirányítás az admin.php oldalra
            header("Location: admin.php");
            exit();
        } else {
            // Hibás bejelentkezési adatok vagy nincs megfelelő jogosultság
            echo "Permission denied!";
        }
    }
}
?>


