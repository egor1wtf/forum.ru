<?php
$sql="SELECT id, kodofrazdel, name, name_creator, name_last_answer, date_last_answer FROM TOPIC WHERE kodofrazdel=".$_GET['numrazdel']."";
//Выполняем его
$data=mysqli_query($conn,$sql);
//Задаем SQL-запрос, который вернет имя выбранного
//пользователем раздела
$sql2="SELECT name FROM TOPIC WHERE id=" .$_GET['numrazdel'];
//Выполняем его
$data2=mysqli_query($conn,$sql2);
//Получаем результат - одна запись
$line2=mysqli_fetch_row($data2);
//Выводим надпись
echo "<BIG><B>Список тем для ";
echo "раздела: ".$line2 [0] ."</B></BIG><BR><BR>";
//Кнопка для создания новой темы
?>

    <form action="?show=add_topic&numrazdel= <?php echo
    $_GET ['numrazdel'] ; ?>" method="post"><input type="submit" value="Создать новую тему">
    </form>

    <table BORDER=1 cellpadding=3 width=100%>
        <tr>
            <td width=60%>
                Название темы
            </td>
            <td width=10%>
                <font size=2>Автор</font>
            </td>
            <td width=30%>
                <font size=2>Последнее сообщение (Kто|Дата)</font>
            </td>
        </tr>
    </table>
    <?php
    //Выводим список всех тем для выбранного раздела
    while($line = $data->fetch_assoc())
    {
        ?>
        <table BORDER=1 cellpadding=20 width=100%>
            <tr>
                <td width=60%>
                    <?php
                    echo '<a href="?show=message&numtopic='.$line['id'].'">'
                        .$line['name'].'</a>';

                    if ($_SESSION['role']=='admin')
                    {
                        ?>
                        <form action="?show=edit_topic&numtopic=<?echo $line['id']?>"
                              method="post">
                            <input type="submit" value="Изменить название">
                        </form>
                        <form action="?show=del_topic&numtopic=<? echo $line['id']?>"
                              method="post"><input type="submit" value="Удалить тему">
                        </form>
                        <?php
                    }
?>
                </td>
                <td width-10%>
                    <?php
                    //Имя создавшего тему
                    echo $line['name_creator'];
                    ?>
                </td>
                <td width-10%>
                    <?php
                    //Имя последнего ответившего
                    echo $line['name_last_answer'];
                    ?>
                </td>
                <td width-20%>
                    <?php
                    echo $line['date_last_answer'];
                    ?>
                </td>
            </tr>
        </table>
        <?php
    }
    //end - while
    ?>
