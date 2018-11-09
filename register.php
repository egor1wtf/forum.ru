<?php
/**
 * Created by PhpStorm.
 * User: Arszorin
 * Date: 05.11.2018
 * Time: 17:55
 */
require_once 'connect.php';
$login = $_GET['login'];
$role = $_GET['role'];
$password = md5($_GET['password']);

$sql = "INSERT into `USERS`(id,name,pass,role) VALUES (null,'$login','$password','$role')";
$result = mysqli_query($conn, $sql);

echo '<script>alert("Пользователь зарегистрирован."); history.back();</script>';
