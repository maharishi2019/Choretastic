<?php
    session_start(); 
    $_SESSION["username"] = $_POST["username"]; 
    $_SESSION["password"] = $_POST["password"]; 
    //checking if user is logging in as parent or child (TODO)
    $_SESSION["type_user"] = isset($_POST["parent"])? "parent" : "child"; 
    //connection to database
    $connection = new mysqli("localhost", "root", "", "choretastic"); 
    if($connection->connect_error){
        die("Connection failed: " . $connection->connect_error); 
    }
    //going through database and finding any matches
    $sql = "SELECT id, username, user_password FROM admin_table"; 
    $result = mysqli_query($connection, $sql); 
    while($row = mysqli_fetch_assoc($result)){
        if($row["username"] == $_SESSION["username"] && $row["user_password"] == $_SESSION["password"]){
            if($_SESSION["type_user"] == "parent"){
                header("Location: home.php"); 
            }else if($_SESSION["type_user"] == "child"){
                header("Location: childhome.php"); 
            }
        }
    }
    //no match leads to a message stating that account does not exist
    echo("Account does not exist."); 
?>