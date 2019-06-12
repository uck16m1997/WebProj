<?php 
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $username = $_SESSION['userName'];
?>
<?php
 require("connection.php");
 $sql = "SELECT usern,users.userid,walletid,money FROM users,wallets WHERE usern='$username' AND users.userid=wallets.userid";
 $wallets = mysqli_fetch_all(mysqli_query($conn,$sql), MYSQLI_ASSOC);

 $sql = "SELECT usern,userid FROM users WHERE usern='$username'";
 $users = mysqli_fetch_all(mysqli_query($conn,$sql), MYSQLI_ASSOC);
 $id = $users[0]["userid"];

 $target_dir = "profilepics/";
 $target_file = $target_dir . $id .".jpg";

?>
<?php require("head.html"); ?>
<body>
<?php require("header.html"); ?>
<?php require("settings.html"); ?>
</body>