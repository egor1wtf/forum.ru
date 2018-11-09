<?php
echo "<H2>Редактирование темы</H2>";

$sql = "SELECT id,name FROM TOPIC WHERE id= ".$_GET['numtopic'];
//Выполняем его
$data=mysqli_query($conn,$sql)or die(mysqli_error());
//Получаем результат запроса - одна запись
$line=mysqli_fetch_row($data);

?>
<!--Создаем форму для редактирования темы-->
<form action="?act=edit_topic&numtopic=<?php echo $line[0];?>" method="post">
    Название темы:<BR>
    <input name="name_topic" type="text" value="<?=$line[1]?>" size=40>
    <BR>
    <input type="submit" value="Изменить">
</form>
