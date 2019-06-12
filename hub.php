<?php 
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $username = $_SESSION['userName'];
?>

<?php
    require("connection.php");
    $sql = "SELECT usern,users.userid,bank_linked,contentid,file_loc,upload_time,title,content_type FROM users,contents WHERE users.userid=contents.userid  ORDER BY upload_time DESC LIMIT 10";
 
    $contents = mysqli_fetch_all(mysqli_query($conn,$sql), MYSQLI_ASSOC);

    

    $contentCount= count($contents);
?>
<?php require("head.html"); ?>
<body>
<?php require("header.html"); ?>
<?php require("hub.html"); ?>
</body>