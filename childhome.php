<!DOCTYPE html>

<html>
    <head>
        <title>Choretastic</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="styles.css">
        <script src="script.js"></script>
    </head>
    <body>
        <div id="chorelist">
            <ul>
            <?php 
                session_start(); 
                //connection to database
                $connection = new mysqli("localhost", "root", "", "choretastic"); 
                if($connection->connect_error){
                    die("Connection failed: " . $connection->connect_error); 
                }
                //prints out all user messages
                $query = "SELECT id, username FROM admin_table WHERE username='".$_SESSION["username"]."'";
                $result = mysqli_query($connection, $query); 
                $row = mysqli_fetch_assoc($result); 
                $query = "SELECT chore_message FROM `".strval($row["id"])."`"; 
                $result = mysqli_query($connection, $query); 
                if($result && $result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        if(strlen($row["chore_message"]) > 0){
                            echo "<li>".$row["chore_message"]."</li>"; 
                        }
                    }
                }
            ?>
            </ul>
        </div>
        <a href="login.php" id="redirect-button">Logout</a><br>
    </body>
</html>