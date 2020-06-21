<?php
    session_start(); 
    $username = $_POST["username"]; 
    $password = $_POST["password"]; 
    $connection = new mysqli("localhost", "root", "", "choretastic"); 
    if($connection->connect_error){
        die("Connection failed: " . $connection->connect_error); 
    }
    if($_SESSION["username"] == $username && $_SESSION["password"] == $password){
        $query = "SELECT id, username FROM admin_table WHERE username='".$_SESSION["username"]."'";
        $result = mysqli_query($connection, $query); 
        $row = mysqli_fetch_assoc($result);
        $sql = "DROP TABLE `".strval($row["id"])."`"; 
        if($connection->query($sql) === true){
            echo "Connection successful"; 
        }else{
            echo "Connection failed" . $connection->error; 
        }
        $sql = "DELETE FROM admin_table WHERE id='".$row["id"]."'"; 
        if($connection->query($sql) === true){
            echo "Connection successful"; 
        }else{
            echo "Connection failed" . $connection->error; 
        }
        header("Location: login.php"); 
    }else{
        $query = "SELECT id, username FROM admin_table WHERE username='".$username."'";
        $result = mysqli_query($connection, $query); 
        $row = mysqli_fetch_assoc($result);
        $sql = "DELETE FROM admin_table WHERE username='".$username."'"; 
        if($connection->query($sql) === true){
            echo "Connection successful"; 
        }else{
            echo "Connection failed" . $connection->error; 
        }
    }
    header("Location: home.php"); 
?>