<?php
$servername = "127.0.0.1:3306";
$username = "root";
$password = "";
$dbname = "forum";
$conn = new mysqli($servername, $username, $password, $dbname   );

if(mysqli_connect_errno($connect))
{
    echo 'Failed to connect';
}

?>