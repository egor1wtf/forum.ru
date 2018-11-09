<?php
session_start();
include 'connect.php';
//echo "<link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css\">
//    <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js\"></script>
//    <script src=\"https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js\"></script>
//    <script src=\"https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js\"></script>
//     <style>
//        @import url('../style/index.css');
//        
//.button {
//@include   .btn;
//} 
//    </style>";
echo '<h1>Форум кафедры ИППО</h1>';
if (!isset($_SESSION['auth'])){
    echo <<< html
<center><a href='login.php'>Для доступа к форуму вам необходимо авторизоваться!</а><center><br>
html;
}
else{
    echo "<br><h5>Вы вошли на сайт как, <u>".$_SESSION['name']."</u>!</h5>";
    echo "<p align='left'><a href='logout.php'>Выйти</a></p>";
if(isset($_GET['act'])) {
    require_once ('action.php');
}
else{
    require_once ('show.php');
}


}