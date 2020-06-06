<?php
require_once ('connection_params.php');

$link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка ".mysqli_error($link)); 
/*mysqli_character_set_charset(database_link link, string encoding) */    

mysqli_set_charset($link, "utf8");

if(isset($_GET['id'])) {
    $del_id = mysqli_real_escape_string($link,$_GET['id']);

    $query ="DELETE FROM client WHERE ClientID=$del_id";
    $result=mysqli_query($link, $query);
}
?>


<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Клиенты</title>
<style>
h4, a{
font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
font-size: 14px;
text-align: center;

}
p{
    text-align: center;    
}
table {
font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
font-size: 14px;
border-collapse: collapse;
text-align: center;
}
th, td:first-child {
background: #AFCDE7;
color: white;
padding: 10px 20px;
}
th, td {
border-style: solid;
border-width: 0 1px 1px 0;
border-color: white;
}
td {
background: #D8E6F3;
}
th:first-child, td:first-child {
text-align: left;
}

</style>
</head>
<body>
<p><h4>Клиенты</h4></p>

<center><?php
require_once 'connection_params.php'; // подключаем скрипт с данными о подключении 
$link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка ".mysqli_error($link)); 
/*mysqli_character_set_charset(database_link link, string encoding) */    

mysqli_set_charset($link, "utf8");

$query ="SELECT * FROM client";
 
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
if($result)
{
    $rows = mysqli_num_rows($result); // количество полученных строк
     
    echo "<table><tr><th>Id</th><th>Название</th><th>Адрес</th><th>Inn</th><th>Запись</th></tr>";
    for ($i = 0 ; $i < $rows ; ++$i)
    {
        $row = mysqli_fetch_row($result);
        echo "<tr>";
            for ($j = 0 ; $j < count($row) ; ++$j) echo "<td>$row[$j]</td>";
            echo "<td><a href=\"?id=$row[0] \" class=\"\">Удалить</a>
            <a href=\"update.php?id=$row[0]\" class=\"\">Изменить</a></td>";
        echo "</tr>";
    }
    echo "</table>";
     
    // очищаем результат
    mysqli_free_result($result);
}
 
mysqli_close($link);
?></center>
<p><a href="client_add.php" class="a2">Добавить запись</a></p>
<p><a href="Menu.php" class="a2" >Вернуться в главное меню</a></p>
</body>
</html>