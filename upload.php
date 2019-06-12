<?php 
    session_start();
    $username = $_SESSION['userName'];

 


?>
<?php require("head.html"); ?>
<body>
<?php require("header.html"); ?>
<?php require("upload.html"); ?>
</body>

<?php 

if(isset($_POST['submit'])){
    //echo "submitted</br>";
    if(empty($_POST["title"]) ){
        echo "You need to enter title <br>";
    }
    else if($_FILES["fileToUpload"]['error']!=0){
        echo "You need to enter a filetoUpload <br>";
    }
    else if(!isset($_POST['radio'])){
        echo "You need to select the filetype <br>";
    }
    else{
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        while((file_exists($target_file))) {
            echo "Sorry, file already exists.";
            $a = uniqid().".".$imageFileType;
            echo $a;
            $target_file = $target_dir . basename($a);
            $uploadOk = 0;

        }
        

        #if ($_FILES["fileToUpload"]["size"] > 500000) {//500KB
        #    echo "Sorry, your file is too large.";
        #}

        require("connection.php");
    
        if(!$conn){
            echo "connection failure";
        }
        

        else if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";

            $sql = "SELECT usern,userid FROM users WHERE usern='$username'";
            $users = mysqli_fetch_all(mysqli_query($conn,$sql), MYSQLI_ASSOC);


            $title = mysqli_real_escape_string($conn,$_POST["title"]);
            $target_file_sql = mysqli_real_escape_string($conn,$target_file);
            $type = mysqli_real_escape_string($conn,$_POST["radio"]);
            $userid = mysqli_real_escape_string($conn,$users[0]["userid"]);
            $date = date('Y-m-d H:i:s');
            
            $sql = "INSERT INTO contents(userid,content_type,upload_time,title,file_loc) VALUES('$userid','$type','$date','$title','$target_file_sql')";

            if(mysqli_query($conn,$sql)){
                echo "Your content has been uploaded";
            }

        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }


}
?>