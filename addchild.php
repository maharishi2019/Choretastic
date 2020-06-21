<?php
    session_start(); 
    $username = $_POST["username"];
    $password = $_POST["password"]; 
    //connection to database
    $connection = new mysqli("localhost", "root", "", "choretastic"); 
    if($connection->connect_error){
        die("Connection failed: " . $connection->connect_error); 
    }
    //checks if username already exists
    $query = "SELECT username FROM admin_table WHERE username='".$username."'";
    $result= mysqli_query($connection, $query);
    if (mysqli_num_rows($result) > 0){
        echo "Username already exists";
        exit(); 
    }
    //adds user with the same id as parent so they can access the family table
    $query = "SELECT id, username FROM admin_table WHERE username='".$_SESSION["username"]."'";
    $result = mysqli_query($connection, $query); 
    $row = mysqli_fetch_assoc($result); 
    $sql = "INSERT INTO admin_table (username, user_password, id) VALUES ('$username', '$password', ".$row["id"].")"; 
    if($connection->query($sql) === true){
        echo "success"; 
    }else{
        die("Connection failed: " . $connection->error); 
    }
    header("Location: home.php"); 
?>