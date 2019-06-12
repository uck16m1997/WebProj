<?php 
    require("connection.php");
    
    if(!$conn){
        echo "connection failure";
    }

    $sql = 'SELECT usern,passw FROM users ';
    #$result = mysqli_query($conn,$sql);
    $users = mysqli_fetch_all(mysqli_query($conn,$sql), MYSQLI_ASSOC);//associative array
    #print_r($users);
    

    if(isset($_POST['subM'])){

        if(empty($_POST["usern"]) || empty($_POST["passw"])){
            require("login.html");
            echo "You need to enter your username ,password";
        }
        else{
            $check = 0;
            for($i=0; $i<count($users);$i++){
            
                if( $users[$i]['usern']==$_POST["usern"] && $users[$i]['passw']==$_POST["passw"]){
                    $check = 1;
                    require("result.php");
                    break;
                }

            }
            if($check==0){
                require("login.html");
                echo("User with entered credentials does not exist");
                
            }
        }
        #else{
        #    echo htmlspecialchars($_POST["usern"])."</br>";
        #    $username = $_POST["usern"];
        #}
    }     
    

?>