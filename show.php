<?php
require_once 'connect.php';
if  (!isset($_GET['show']))
{
//Задаем SQL-запрос
$sql = "SELECT id,name FROM TOPIC WHERE kodofrazdel=0";
//Выполняем его
$data = mysqli_query($conn, $sql); ;
//Надпись  "Список разделов"
echo "<big><b>Список paздeлoв</b></big><BR><BR>";
//Выводим список всех разделов
while($line=mysqli_fetch_row($data))
{
?>
<table BORDER=1  cellpadding=20 width=100%>
<tr>
<td>
<?php
//Ссылка на index.php только с параметром show-topic
echo
'<a href="?show=topic&numrazdel=
'.$line[0] .'">'.$line[1]."</a>";
?>
</td>
</tr>
</table>

<?php
}
//Больше ничего выполнять не стоит
exit;
}
// end - if  (!isset($_GET['show']))

//Если задан параметр show,  то в зависимости от него
//выводим соответствующую информацию
switch ($_GET ['show'] )
{
//Если нужно вывести темы для выбранного раздела

case 'topic' :
require_once ('SHOW_MODULE/show_topic.php');
	break;

//Если нужно вывести сообщения для выбранной темы
case 'message':
require_once ('SHOW_MODULE/show_message.php');
break;

//Если нужно вывести форму создания темы
case  'add_topic' :
require_once ('SHOW_MODULE/show_addtopic.php');
break;

//Если нужно вывести форму редактирования темы
case 'edit_topic':
require_once('SHOW_MODULE/show_edittopic.php');
 break;
//Если нужно удалить тему
case 'del_topic':
require_once('SHOW_MODULE/show_deltopic.php');
break;
//Если нужно вывести форму редактирования сообщения
case 'edit_message':
require_once('SHOW_MODULE/show_editmessage.php');
break;
//Если нужно удалить сообщение
case   'del_message':
require_once('SHOW_MODULE/show_delmessage.php');
break;
}
//end - case
?>
