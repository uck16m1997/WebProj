<?php 
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $username = $_SESSION['userName'];
?>
<?php
    $amount = number_format($_POST['amount']);
    if($amount<=0){
        require("settings.php");
        echo" Amount given was too small";
    }
    else{
        $type = "withdraw";

        $date = date('Y-m-d H:i:s');
    
        require("connection.php");

        $sql = "SELECT usern,userid FROM users WHERE usern='$username'";
        $users = mysqli_fetch_all(mysqli_query($conn,$sql), MYSQLI_ASSOC);
        $id = $users[0]["userid"];


  
    

        $sql = "SELECT walletid,money FROM wallets,contents WHERE wallets.userid=$id ";
        $info = mysqli_fetch_all(mysqli_query($conn,$sql), MYSQLI_ASSOC);
        
        $wid =$info[0]["walletid"];
        $money =$info[0]["money"];

        if($money-$amount<0){
            require("settings.php");
            echo" Not enough money in your account ";
        }
        else{
            $sql = "INSERT INTO monetary_actions(moactype,moacdate,userid) VALUES('$type','$date','$id')";
            mysqli_query($conn,$sql);

            $sql = "SELECT moacid FROM monetary_actions WHERE  monetary_actions.userid =$id AND moacdate=\"$date\" ";
            
            $info = mysqli_fetch_all(mysqli_query($conn,$sql), MYSQLI_ASSOC);
            $mcid = $info[0]["moacid"];

            $sql = "INSERT INTO withdraws(withdrawers_wallet,money_withdrawn,moacid,withdraw_method) VALUES('$wid','$amount','$mcid','Credit')";
            mysqli_query($conn,$sql);

            $sql = "UPDATE wallets SET money= money-$amount WHERE walletid='$wid'";
            mysqli_query($conn,$sql);
            

            require("result.php");
        }
    }
 
   

    
?> 