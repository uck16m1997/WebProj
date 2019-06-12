<?php 
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $username = $_SESSION['userName'];
?>
<?php
    $amount = number_format($_POST['amount']);
    $type = "donation";
    $conid = number_format($_POST['contentid']);

    $date = date('Y-m-d H:i:s');
    require("connection.php");

    $sql = "SELECT usern,userid FROM users WHERE usern='$username'";
    $users = mysqli_fetch_all(mysqli_query($conn,$sql), MYSQLI_ASSOC);
    $id = $users[0]["userid"];


    $sql = "INSERT INTO monetary_actions(moactype,moacdate,userid) VALUES('$type','$date','$id')";
   
    mysqli_query($conn,$sql);

    $sql = "SELECT walletid FROM wallets,contents WHERE contentid='$conid' AND contents.userid=wallets.userid ";
    $info = mysqli_fetch_all(mysqli_query($conn,$sql), MYSQLI_ASSOC);
    $wid =$info[0]["walletid"];

    $sql = "SELECT moacid FROM monetary_actions WHERE  monetary_actions.userid =$id AND moacdate=\"$date\" ";
    
    $info = mysqli_fetch_all(mysqli_query($conn,$sql), MYSQLI_ASSOC);
    $mcid = $info[0]["moacid"];

    $sql = "INSERT INTO donations(receiving_wallet,moneydonated,donated_content,moacid) VALUES('$wid','$amount','$conid','$mcid')";
    mysqli_query($conn,$sql);

    $sql = "UPDATE wallets SET money= money+$amount WHERE walletid='$wid'";
    mysqli_query($conn,$sql);
    

    require("hub.php");
    
 
   

    
?> 