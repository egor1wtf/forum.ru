<?php
session_start();
include 'connect.php';
echo '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>';

echo '<h1>Авторизация</h1>';
echo <<< html
<form action="login.php"> 
<table>
<tr> <td>
        Логин: </td> <td>
        <input type="text" name="login" required> </td> </tr>
       <tr> <td> Пароль: </td>
      <td>  <input type="password" name="password" required></td> </tr>
            <tr>
			<td> </td> <td>
                <button type="submit">Войти</button>
				</td>
            </tr>
			</table>
    </form>
html;

if(isset($_GET['login'])) {
    $name = $_GET['login'];
    $pass = md5($_GET['password']);

    $sql = "SELECT * FROM `USERS` WHERE name = '$name' AND pass = '$pass'";
    $result = mysqli_query($conn, $sql);
    if ($result->num_rows > 0) {
        if ($row = $result->fetch_assoc()) {
            $_SESSION['auth'] = true;
            $_SESSION['name'] = $name;
            $_SESSION['role'] = $row['role'];
            echo <<< html
        <script>
        alert("Вы вошли как $name");
        window.location = "index.php"
        </script>
html;
        }
    }
    else{
        echo '
        <script>
        alert("Пользователь не найден!");
        </script>';
    }
}
