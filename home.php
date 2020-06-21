<!DOCTYPE html>

<html>
    <head>
        <title>Choretastic</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
        <link href="styles.css" rel="stylesheet">
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
        <div id="home-widget">
            <form action="addchore.php" method="POST">
                Add: <input type="text" name="chore_entry" required>
                <input type="submit" name="submit" value="Submit">
            </form>
            <form action="deletechore.php" method="POST">
                Delete: <input type="text" name="chore_entry" required>
                <input type="submit" name="submit" value="Submit">
            </form>
        </div>
        <div id="home-widget">
            <form action="addchild.php" method="POST">
                Add Child: <br>
                Username: <input type="text" name="username" required><br>
                Password: <input type="text" name="password" required><br>
                <input type="submit" name="submit" value="Submit">
            </form>
        </div>
        <div id="home-widget">
            <form action="removeuser.php" method="POST">
                Remove Child: <br>
                Username: <input type="text" name="username" required><br>
                Password: <input type="text" name="password" required><br>
                <input type="submit" name="submit" value="Submit">
            </form>
        </div>
        
        <div id="chorelist">
            <h3>Family Members</h3>
            <ul>
            <?php 
                //connection to database
                $connection = new mysqli("localhost", "root", "", "choretastic"); 
                if($connection->connect_error){
                    die("Connection failed: " . $connection->connect_error); 
                }
                //prints out all childs
                $query = "SELECT id, username FROM admin_table WHERE username='".$_SESSION["username"]."'";
                $result = mysqli_query($connection, $query); 
                $row = mysqli_fetch_assoc($result);
                $query = "SELECT id, username FROM admin_table WHERE id='".$row["id"]."'";
                $result = mysqli_query($connection, $query); 
                if($result && $result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        if($row["username"] == $_SESSION["username"]){
                            echo "<li>".$row["username"]." (admin)</li>"; 
                        }elseif(strlen($row["username"]) > 0){
                            echo "<li>".$row["username"]."</li>"; 
                        }
                    }
                }
            ?>
            </ul>
        </div>
        <a href="login.php" id="redirect-button">Logout</a><br>
    </body>
</html>