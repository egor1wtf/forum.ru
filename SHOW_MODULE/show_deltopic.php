<?php
echo "<H2>Удаление темы</H2>";
//Задаем SQL-запрос, который выберет данные по удаляемой теме
$sql = "SELECT id, name FROM TOPIC WHERE id=".$_GET['numtopic'];
//Выполняем его
$data = mysqli_query($conn, $sql);
//Получаем результат - одна запись
$line = mysqli_fetch_row($data);
//Выводим надпись
echo "Вы действительно хотите удалить тему: <B>".$line[1]."</B>, и все ее сообщения?";
?>
<!--Создаем форму для удаления темы-->
<form action="?act=del_topic&numtopic=<?php echo $line[0]?>"
      method="post">
    <input type="submit" value="Да  	">
</form>
<form action="index.php" method="post">
    <input type="submit" value="Отмена">
</form>
