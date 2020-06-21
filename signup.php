<!DOCTYPE html>

<html>
    <head>
        <title>Choretastic</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="styles.css">
        <script src="script.js"></script>
    </head>
    <body>
        <div id="login">
            <form action="add.php" method="POST">
                Username: <input type="text" name="username" required><br>
                Password: <input type="text" name="password" required><br>
                <input type="submit" name="submit" value="Sign Up">
            </form>
        </div>
    </body>
</html>