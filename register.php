<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" type="text/css" href="css/register.css">
</head>
<body>
    </header>
    <div id="background"></div>
    <div id="formcontainer">  
        <div id="formcontainerinside">
            <div id="image">
                <img src="resources/waffleregister.jpg" alt="">
            </div>
            <div id="form">
                <form action="signup.php" id="forminside" method="post">
                    <h1>Sign up</h1>
                    <label>First name: <input type="text" name="fname" size="25"></label>
                    <label>Last name: <input type="text" name="lname" size="25"></label>
                    <label>Password: <input type="password" name="passwd" required></label>
                    <label>Password again: <input type="password" name="passwd-check" required></label>
                    <label>Phone number: <input type="tel" name="phone-number" placeholder="36012345678" pattern="36[0-9]{9}" required title="Format: 36012345678"></label>
                    <label>E-mail: <input type="email" name="email" required></label>
                    <label>Country:
                    <select name="country" required>
                        <option value="Hungary">Hungary</option>
                    </select>
                    </label>

                    <label>Postal code: <input type="text" name="postal-code" required></label>
                    <label>City: <input type="text" name="city" required></label>
                    <label>Address: <input type="text" name="address" required></label>

                </form>
                <p>One click and you are done!</p>
                <button type="submit" id="submit">Submit</button>
            </div>
        </div>
    </div>
    <a href="index.php" id="gobackbutton">←</a>
    <script>
        document.getElementById('submit').addEventListener('click', function() {
            document.getElementById('forminside').submit();
        });
    </script>
</body>
</html>
