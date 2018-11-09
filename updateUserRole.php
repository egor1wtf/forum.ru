<?php
/**
 * Created by PhpStorm.
 * User: Arszorin
 * Date: 05.11.2018
 * Time: 17:15
 */
require_once 'connect.php';

$id = $_GET['userID'];
$role = $_GET['role'];
$name = $_GET['name'];

    mysqli_set_charset($conn, "utf8");
    $sql = "UPDATE `USERS` SET  role = '$role', name = '$name' WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
