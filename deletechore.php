<?php
    session_start(); 
    $choreentry = $_POST["chore_entry"]; 
    //connection to database
    $connection = new mysqli("localhost", "root", "", "choretastic"); 
    if($connection->connect_error){
        die("Connection failed: " . $connection->connect_error); 
    }
    //deletes the chore entry
    $query = "SELECT id, username FROM admin_table WHERE username='".$_SESSION["username"]."'";
    $result = mysqli_query($connection, $query); 
    $row = mysqli_fetch_assoc($result); 
    $sql = "DELETE FROM `".strval($row["id"])."` WHERE chore_message='".$choreentry."'"; 
    if($connection->query($sql) === true){
        echo "success"; 
    }else{
        echo "error: " . $connection->error; 
    }
    header("Location: home.php"); 
?>