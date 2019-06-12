<?php 
    
    session_start();
    $username = $_SESSION['userName'];

?>

<?php
    require("connection.php");

    $sql = "SELECT usern,userid FROM users WHERE usern='$username'";
    $users = mysqli_fetch_all(mysqli_query($conn,$sql), MYSQLI_ASSOC);
    $id = $users[0]["userid"];
    
    $sql = "SELECT userid FROM wallets WHERE userid='$id'";
    $wallets = mysqli_fetch_all(mysqli_query($conn,$sql), MYSQLI_ASSOC);

    if(count($wallets)>0){
        require("settings.php");
        echo"You already linked your account";
    }
    else{
        $sql="UPDATE users SET bank_linked=1 WHERE userid='$id'";
        mysqli_query($conn,$sql);

        $sql = "INSERT INTO wallets(userid) VALUES('$id')";

        if(mysqli_query($conn,$sql)){
            require("settings.php");
            echo "Your bank linking was succesiful";
        }

    }
    

?>