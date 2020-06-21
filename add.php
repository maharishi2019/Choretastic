<?php
    session_start(); 
    //setting session cookies
    $_SESSION["username"]= $_POST["username"];
    $_SESSION["password"] = $_POST["password"]; 
    //connection to database
    $connection = new mysqli("localhost", "root", "", "choretastic"); 
    if($connection->connect_error){
        die("Connection failed: " . $connection->connect_error); 
    }
    //checking if username already exists
    $query = "SELECT username FROM admin_table WHERE username='".$_SESSION["username"]."'";
    $result= mysqli_query($connection, $query);
    if (mysqli_num_rows($result) > 0){
        echo "Username already exists";
        exit(); 
    }
    //inserting the username and password into databaase
    $sql = "INSERT INTO admin_table (username, user_password) VALUES ('".$_SESSION["username"]."', '".$_SESSION["password"]."')"; 
    if($connection->query($sql) === true){
        echo "success"; 
    }else{
        die("Connection failed: " . $connection->error); 
    }
    //creating a table from the id given to the user
    $query = "SELECT id, username FROM admin_table WHERE username='".$_SESSION["username"]."'";
    $result = mysqli_query($connection, $query); 
    $row = mysqli_fetch_assoc($result); 
    $table_id = strval($row["id"]); 
    $sql = "CREATE TABLE `".$table_id."`(chore_message varchar(255))";
    if($connection->query($sql) === true){
        echo "success"; 
    }else{
        die("Connection failed: " . $connection->error); 
    }
    header("Location: home.php"); 
?>