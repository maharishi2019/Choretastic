<?php
    session_start(); 
    $choreentry = $_POST["chore_entry"]; 
    //conenction to database
    $connection = new mysqli("localhost", "root", "", "choretastic"); 
    if($connection->connect_error){
        die("Connection failed: " . $connection->connect_error); 
    }
    //finds the family database
    $query = "SELECT id, username FROM admin_table WHERE username='".$_SESSION["username"]."'";
    $result = mysqli_query($connection, $query); 
    $row = mysqli_fetch_assoc($result); 
    //checks if chore is not already on list
    $query = "SELECT chore_message FROM `".strval($row["id"])."` WHERE chore_message='".$choreentry."'";
    $result= mysqli_query($connection, $query);
    if (mysqli_num_rows($result) > 0){
        header("Location: home.php"); 
        exit(); 
    }
    //inserts the chore into the database
    $sql = "INSERT INTO `".strval($row["id"])."` (chore_message) VALUES ('$choreentry')"; 
    if($connection->query($sql) === true){
        echo "success"; 
    }else{
        echo "error: " . $connection->error; 
    }
    header("Location: home.php"); 
?>