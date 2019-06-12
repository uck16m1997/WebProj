
<?php
 if(isset($_POST['subM'])){
    //echo "submitted</br>";
    if(empty($_POST["usern"]) || empty($_POST["passw"])){
        echo "You need to enter your username and password";
    }
    else{
        #echo htmlspecialchars($_POST["userN"])."</br>";
        $username = $_POST["usern"];
        session_start();
        $_SESSION['userName'] = $username;
    }

}       
else{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $username = $_SESSION['userName'];
}
?>
<?php 

    require("connection.php");
    
    $sql = "SELECT usern,users.userid,file_loc,upload_time,title,content_type FROM users,contents WHERE users.userid=contents.userid AND usern='$username' ORDER BY upload_time DESC LIMIT 3";
    if(!$conn){
        echo "connection failure";
    }

    #$sql = 'SELECT usern,email,passw FROM users ';
    $contents = mysqli_fetch_all(mysqli_query($conn,$sql), MYSQLI_ASSOC);//associative array

    $sql = "SELECT usern,userid FROM users WHERE usern='$username'";
    $users = mysqli_fetch_all(mysqli_query($conn,$sql), MYSQLI_ASSOC);
    $id = $users[0]["userid"];

    $target_dir = "profilepics/";
    $target_file = $target_dir . $id .".jpg";

    $contentCount= count($contents);
?>
<?php require("head.html"); ?>
<body>
<?php require("header.html"); ?>
<?php require("homepage.html"); ?>
</body>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>