<?php 
    require("connection.php");
    
    if(!$conn){
        echo "connection failure";
    }



    

    if(isset($_POST['subM'])){

        if(empty($_POST["usern"]) || empty($_POST["passw"]) || empty($_POST["email"])){
            require("signup.html");
            echo "You need to enter your username ,password and email";
        }
        else{
            $check=0;

            $email = mysqli_real_escape_string($conn,$_POST["email"]);
            $usern = mysqli_real_escape_string($conn,$_POST["usern"]);
            $passw = mysqli_real_escape_string($conn,$_POST["passw"]);

            $sql = "SELECT usern,email FROM users WHERE usern='$usern' OR email ='$email'";
            $users = mysqli_fetch_all(mysqli_query($conn,$sql), MYSQLI_ASSOC);//associative array


            for($i=0; $i<count($users);$i++){
            
                if( $users[$i]['usern']==$_POST["usern"]){
                    require("signup.html");
                    echo "That username already exists";
                    $check=1;
                    break;
                }
                else if($users[$i]['email']==$_POST["email"]){
                    require("signup.html");
                    echo "That email already exists";
                    $check=1;
                    break;
                }
            }
            if($check==0){

                $sql = "INSERT INTO users(usern,passw,email) VALUES('$usern','$passw','$email')";

                if(mysqli_query($conn,$sql)){
                    require("result.php");
                    echo "Your account has been registered";
                }
                else{
                    echo "Failed to sign your user up try again";
                }

            }
        }
        #else{
        #    echo htmlspecialchars($_POST["usern"])."</br>";
        #    $username = $_POST["usern"];
        #}
    }     
    

?>