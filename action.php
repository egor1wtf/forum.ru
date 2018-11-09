<?php
require_once 'connect.php';
if($_GET['act']=='add_topic')
{
     $sSQL = "INSERT INTO `TOPIC`(`name`, `name_creator`, `date_last_answer`, `kodofrazdel`) VALUES ('".$_POST['name_topic']."','".$_SESSION['name']."','".date('Y-m-d')."','".$_GET['numrazdel']."')";
     mysqli_query($conn, $sSQL) or die(mysqli_error($conn));

    $id=mysqli_insert_id($conn);
//SQL-запрос, добавляющий сообщение для вновь созданной темы
    $sSQL="INSERT INTO MESSAGE SET kodoftopic=".$id.",
textmessage='".$_POST['message']. "',name_man='" .$_SESSION['name']
        ."' , date_answer= '".date ( 'Y-m-d')."'";
//Выполняем запрос
    mysqli_query($conn,$sSQL) or die (mysql_error());

    echo "Тема Создана <BR>";
    echo "<a href='index.php?show=topic&numrazdel=
".$_GET['numrazdel']."'>";
    echo "Назад к списку тем</a>";
}


//Изменение названия темы
if($_GET['act']=='edit_topic')
{
//SQL-запрос, который изменит название темы
    $sSQL="UPDATE TOPIC SET name='".$_POST['name_topic']."'
 WHERE id=".$_GET['numtopic'];
//Выполняем запрос
    mysqli_query($conn,$sSQL)or die(mysqli_error($conn));
//Выбираем код раздела, чтобы можно было перенаправить
//пользователя на список тем для этого раздела
    $sSQL="SELECT kodofrazdel FROM TOPIC
WHERE id=".$_GET['numtopic'];
    $data=mysqli_query($conn,$sSQL);
//Получаем результат - одна запись
    $line=mysqli_fetch_row($data);
//Выводим надпись и ссылку на список тем для текущего раздела
    echo "Название темы изменено<BR>";
    echo "<a href='index.php?show=topic&numrazdel=$line[0]'>";
    echo "Назад к списку тем</a>";

}
//Удаление темы и всех ее сообщений
if($_GET['act'] == 'del_topic')
{
//Выбираем код раздела,  чтобы можно было вернуться в него
    $sSQL="SELECT kodofrazdel FROM TOPIC WHERE id=".$_GET['numtopic'];
    $data=mysqli_query($conn,$sSQL);
//Получаем результат - одна запись
    $line=mysqli_fetch_row($data);
//Удаляем все сообщения для выбранной темы
    $sSQL="DELETE FROM MESSAGE WHERE kodoftopic =".$_GET['numtopic'];
    mysqli_query($conn,$sSQL);
//Удаляем саму тему
    $sSQL="DELETE FROM TOPIC WHERE id=".$_GET['numtopic'];
    mysqli_query($conn,$sSQL);
//Выводим надпись и ссылку на список тем для текущего раздела
    echo"Тема удалена<BR>";
    echo "<a href='index.php?show=topic&numrazdel=$line[0]'>Назад к списку тем</a>";
}
//Добавление нового сообщения
if($_GET['act']=='add_message')
{
//Обрабатываем текст в целях безопасности
    $safe_message=mysqli_escape_string($conn,$_POST['message']);
//Запрос для добавления сообщения
    $sSQL="INSERT INTO MESSAGE  SET kodoftopic=".$_GET['numtopic'].", textmessage='" . $safe_message."' , name_man= '".$_SESSION[
        'name']."' , date_answer= '" . date ('Y-m-d')."'";
//Выполняем запрос
    mysqli_query($conn,$sSQL);
//Теперь добавляем информацию об имени посетителя и дате
//размещаемого сообщения для темы, которой принадлежит сообщение
    $sSQL="UPDATE TOPIC SET name_last_answer='". $_SESSION['name']."', date_last_answer= '".date('Y-m-d')."'WHERE id=".$_GET['numtopic'];
    mysqli_query($conn,$sSQL);
//Выводим надпись и ссылку на список сообщений для текущэй темы
    echo"Ответ принят<BR>";
    echo "<a href='index.php?show=message&numtopic=
".$_GET['numtopic']."'>";
    echo"Назад к обсуждению темы</а>";
}
//Изменение сообщения
if($_GET['act']=='edit_message')
{
//Обрабатываем название в целях безопасности
    $safe_message=mysqli_escape_string($conn,$_POST['message']);
//Меняем текст сообщения
    $sSQL="UPDATE MESSAGE SET textmessage='".$safe_message."'
 WHERE id=".$_GET['nummessage'];
    mysqli_query($conn,$sSQL);
//Выбираем код темы, чтобы можно было перенаправить
//пользователя на список сообщений для этой темы
    $sSQL="SELECT kodoftopic FROM MESSAGE WHERE
 id=".$_GET['nummessage'];
    $data=mysqli_query($conn,$sSQL);
//Получаем результат - одна запись
    $line=mysqli_fetch_row($data);
//Выводим надпись и ссылку на список сообщений для текущей темы
    echo"Название сообщения изменено<BR>";
    echo"<a href = 'index.php?show=message&numtopic=".$line[0]."'>";
    echo"Назад к обсуждению темы </a>";
}
//Удаление сообщения
if ($_GET['act']=='del_message')
{
//Выбираем код темы, чтобы можно было вернуться
//в список сообщений для нее
    $sSQL="SELECT kodoftopic FROM MESSAGE
WHERE id=". $_GET['nummessage'];
    $data=mysqli_query($conn,$sSQL);
//Получаем результат - одна запись
    $line=mysqli_fetch_row($data);
//Удаляем выбранное сообщение
    $sSQL="DELETE FROM MESSAGE WHERE id=".$_GET['nummessage'];
//Выполняем запрос
    mysqli_query($conn,$sSQL);
//Выводим -надпись и ссылку на список сообщений для текущей темы echo"Тема удалена<BR>";
    echo "<a href='index.php?show=message&numtopic=".$line[0]."'>"; echo "Назад к обсуждению темы </a>";
}
?>
