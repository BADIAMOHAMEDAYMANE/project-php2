<?php
include("credentials.php");
mysqli_select_db($conn,'website'); 
$url = $_SERVER['REQUEST_URI']; 
$pathParts = explode('/', trim($url, '/'));
$id = $pathParts[2];
$sql = "DELETE FROM users WHERE id=".$id;
if (mysqli_query($conn, $sql)) {
    header("location:/tp2/adminusers.php");
    } else {
    mysqli_error($conn);
    }
?>