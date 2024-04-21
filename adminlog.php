<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" type="text/css" href="css/adminlog.css" >
</head>
<body>
    <div id="background"></div>
    <div id="formcontainer">
        <div id="formcontainerinside">
            <div id="form">
                <form action="adminlogin.php" id="forminside" method="post">
                    <h1>Admin Page</h1>
                    <label>Admin name: <input type="text" name="adminname"></label>
                    <label>Password: <input type="password" name="passwd" required></label>
                    <input type="submit" value="Submit" id="submit">
                </form>
            </div>
        </div>
    </div>
    <a href="index.html" id="gobackbutton">←</a>
</body>
</html>