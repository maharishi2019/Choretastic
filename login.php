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
            <form name="login" action="log.php" method="POST">
                Username: <input type="text" name="username" required><br>
                Password: <input type="text" name="password" required><br>
                Parent: <input type="checkbox" name="parent"><br>
                <input type="submit" name="submit" value="Login">
            </form>
        </div>
    </body>
</html>