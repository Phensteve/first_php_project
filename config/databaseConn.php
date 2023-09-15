<?php
$connect = mysqli_connect(  'localhost','random_guy','1208','oluyo_apps');
    
if (!$connect) {
        echo "Connection error: " . mysqli_connect_error();
    }
?>