<?php

session_start();
include 'connect.php';
$sql = "SELECT * FROM `USERS`";
$result = $conn->query($sql);

echo "<link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css\">
    <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js\"></script>
    <script src=\"https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js\"></script>
    <script src=\"https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js\"></script>
     <style>
        @import url('../style/index.css');
        
.button {
@include   .btn;
} 
body {
    background: #c7b39b url(images/background.jpg);
    color: #000000; /* Цвет текста */
    background-size: 100%;

}
    </style>";
echo '<center><h1>Панель администратора кафедры ИППО</h1><center>';
echo "<p align='center'><a href='index.php'>Вернуться на форум</a></p>";

if ($_SESSION['role'] == "admin") {
//    echo '<h1>Статистика</h1><br><br>';
//    echo '<table border="1" cellspacing="15" cellpadding="20" align="center">';
//    echo '<th>ID</th>';
//    echo '<th>Имя пользователя</th>';
//    echo '<th>Роль пользователя</th>';
//    echo '<th>ОБНОВИТЬ✔ / УДАЛИТЬ ❌</th>';
//    echo '<tbody>';
//    echo '<tr>';
//    echo '<td></td>';
//    echo '<td></td>';
//    echo '<td></td>';
//    echo '<td></td>';
//    echo '</tr></tbody>';
//    echo '</table>';




    echo '<h1>Управление пользователями</h1><br><br>';
    if ($result->num_rows > 0) {
        echo '<table border="1" cellspacing="15" cellpadding="20" align="center">';
        echo '<th>ID</th>';
        echo '<th>Имя пользователя</th>';
        echo '<th>Роль пользователя</th>';
        echo '<th>ОБНОВИТЬ✔ / УДАЛИТЬ ❌</th>';
        echo '<tbody>';
        while ($row = $result->fetch_assoc()) {
            $id = $row['id'];
            $name = $row['name'];
            echo '<tr>';
            echo '<td>' . $row['id'] . '</td>';
            echo "<td><input type='text' size='10' value='$name' id='name$id'></td>";
            echo "<td><select size='2' name='role' id='$id'>";
            if ($row['role'] == "admin") {
                echo '<option value="admin" selected>Администратор</option>
                  <option value="user">Пользователь</option>';
            } else {
                echo '<option value="admin" >Администратор</option>
                  <option value="user" selected>Пользователь</option>';
            }
            echo
                ' </select></td><td><button type="submit" onclick="update(' . $row['id'] . ')" class="btn btn-success btn-xs" title="Обновить данные пользователя?">✔</button>
                                             <button type="submit" onclick="delet(' . $row['id'] . ')" class="btn btn-danger btn-xs" title="Удалить пользователя?">❌</button>  
        </td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
    }

    echo '<br><br><br><br><br><br><br><br><h1>Регистрация пользователей</h1><br><br>';
    echo <<< html
<form action="register.php">
        Логин:
		<br>
        <input type="text" name="login" required>
		<br>
        Пароль:
		<br>
        <input type="password" name="password" required>
		<br>
        Роль:
        <br><select size='2' name='role' required>
        <option value="admin" >Администратор</option>
        <option value="user" selected>Пользователь</option></select>
        </th><tr>
            <br>
               <br> <button type="submit" class="btn btn-primary">Зарегистрировать</button> </br>
            </center>
    </form>
html;


    echo
    <<< html
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
     <style>
        @import url("../style/index.css"); 
    </style>
     <script>
    function update(id){
        var name = document.getElementById("name"+id).value;
        var e = document.getElementById(id);
        var role = e.options[e.selectedIndex].value;
      $.ajax({
        url: 'updateUserRole.php',
        data: {
          userID: id,
          role: role,
          name: name
        },
        success: function (response) {
            window.location.reload()
          
        },
        error: function (jqXHR, textStatus, errorThrown) {
          console.log(textStatus, errorThrown);
        }
      });
    }      
</script>
<script>
    function delet(id){
      $.ajax({
        url: 'deleteUser.php',
        data: {
          userID: id
        },
        success: function (response) {
            window.location.reload()
        },
        error: function (jqXHR, textStatus, errorThrown) {
          console.log(textStatus, errorThrown);
        }
      });
    }
</script>
<BR>
 <div id="footer">
     <p>Fedoseev E.A. &copy; 2018 <p>
 </div>
html;
}else{
    echo "Вы не авторизованы как администратор!";
}