<?php 
    
    session_start();
    $username = $_SESSION['userName'];

?>
<?php 
    
    if(isset($_POST['change'])){
        $usern = "";
        $passw = "";
        $email = "";
        require("connection.php");
        $sql = "SELECT usern,userid FROM users WHERE usern='$username'";
        $users = mysqli_fetch_all(mysqli_query($conn,$sql), MYSQLI_ASSOC);
        $id = $users[0]["userid"];

        if(!empty($_POST["usern"]) ){
            $usern = $_POST["usern"];
            $sql = "UPDATE  users SET usern='$usern' WHERE userid= $id";
            if(!mysqli_query($conn,$sql)){
                echo"failure to change username<br>";
            }
            else{
                $_SESSION['userName']=$usern;
            }
        }

        if(!empty($_POST["passw"])){
            $passw = $_POST["passw"];
            $sql = "UPDATE  users SET passw='$passw' WHERE userid= $id";
            if(!mysqli_query($conn,$sql)){
                echo"failure to change password<br>";
            }
        }
  
        if(!empty($_POST["email"])){
            $email = $_POST["email"];
            $sql = "UPDATE  users SET email='$email' WHERE userid= $id";
            if(!mysqli_query($conn,$sql)){
                echo"failure to change email<br>";
            }
        }

    }
    require("result.php");

?>
