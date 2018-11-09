<?php
/**
 * Created by PhpStorm.
 * User: Arszorin
 * Date: 05.11.2018
 * Time: 17:43
 */
require_once 'connect.php';

$id = $_GET['userID'];


mysqli_set_charset($conn, "utf8");
$sql = "DELETE FROM `USERS` WHERE id = '$id'";
$result = mysqli_query($conn, $sql);
