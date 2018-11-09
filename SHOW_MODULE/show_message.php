<?php
//Задаем SQL-запрос, который выберет все сообщения для
//заданной темы
$sql="SELECT id, textmessage, name_man, date_answer".
    " FROM MESSAGE WHERE kodoftopic=".$_GET['numtopic'].
    " ORDER BY date_answer";
//Выполняем его
$data=mysqli_query($conn,$sql);
//Задаем SQL-запрос, который вернет имя выбранной пользователем
//темы
$sql2 = "SELECT name FROM TOPIC WHERE id = ".$_GET['numtopic'];
//Выполняем его
$data2=mysqli_query ($conn,$sql2) ;
//Получаем результат - одна запись
$line2=mysqli_fetch_row($data2);
//Выводим надпись
echo "<BIG><B>Список сообщений для ";
echo "темы: ". $line2[0]."</B></BIG><BR><BR>";
//Выводим заголовок для таблицы
?>
<table BORDER=1 cellpadding=3 width=100%>
    <tr>
        <td width=70%>
            Сообщение
        </td>
        <td width=10%>
            <font size=2>Автор</font>
        </td>
        <td width=20%>
            <font size=2>Дата</font>
        </td>
    </tr>
</table>
<?php
//Выводим список всех сообщений для выбранной темы
while($line=mysqli_fetch_row($data)) {
    ?>

    <table BORDER=1 cellpadding=20 width=100%>
        <tr>
            <td width=70%>
                <?php
                echo $line[1];
                //Если это админ,  то он может редактировать сообщение и
                //удалять его
                if ($_SESSION['role'] == 'admin') {
                    ?>
                    <form action="?show=edit_message&nummessage=<?= $line[0] ?>"
                          method="post">
                        <input type="submit" value="Редактировать сообщение">
                    </form>
                    <form action="?show=del_message&nummessage=<?= $line[0] ?>"
                          method="post">
                        <input type="submit" value="Удалить сообщение">
                    </form>
                    <?php
                }
                //end -if
                ?>
            </td>
            <td width=10%>
                <?php
                //имя пользователя, создавшего сообщение
                echo $line[2];
                ?>
            </td>
            <td width=20%>
                <?php
                //Дата размещения сообщения
                echo $line[3];
                ?>
            </td>
        </tr>
    </table>
    <form action="?act=add_message&numtopic=<?php echo $_GET['numtopic'] ?>" method="post">
        Текст сообщения:<BR>
        <textarea name="message" cols=40 rows=5></textarea>
        <BR>
        <input type="submit" value="Ответить">
    </form>
    <?php
}
 ?>