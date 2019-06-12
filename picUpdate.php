<?php 
        
    session_start();
    $username = $_SESSION['userName'];

    if($_FILES["fileToUpload"]['error']!=0){
        require("settings.php");
        echo "You need to enter a filetoUpload <br>";
    }
    else{
        $target_dir = "profilepics/";
        
        require("connection.php");

        $sql = "SELECT usern,userid FROM users WHERE usern='$username'";
        $users = mysqli_fetch_all(mysqli_query($conn,$sql), MYSQLI_ASSOC);
        $id = $users[0]["userid"];

        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $target_file = $target_dir . $id . ".jpg";
        $uploadOk = 1;

        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);

        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        if ($_FILES["fileToUpload"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        if($imageFileType != "jpg" ) {
            echo "Sorry, only JPG.";
            $uploadOk = 0;
        }
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
        require("settings.php");
    }
?>