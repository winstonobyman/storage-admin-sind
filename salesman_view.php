<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Продавцы</title>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="style.css">
</head>
<body>
<center>
<h3>Продавцы</h3>
<?php
require_once 'connection_params.php'; // подключаем скрипт
$link = mysqli_connect($host, $user, $password, $database)
    or die("Ошибка ".mysqli_error($link));
/*mysqli_character_set_charset(database_link link, string encoding) */

mysqli_set_charset($link, "utf8");

$query ="SELECT * FROM salesman";

$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
if($result)
{
    $rows = mysqli_num_rows($result);// количество полученных строк

    echo "<table>
    <tr><th>Id</th><th>Фамилия</th><th>Удалить</th></tr>";
    // <?php
    for ($i = 0 ; $i < $rows ; ++$i)
    {
        $row = mysqli_fetch_row($result);
        echo "<tr>";
            for ($j = 0 ; $j < 2 ; ++$j) echo "<td>$row[$j]</td>";
            echo '<td><a href="salesman_delete.php?id='.$row[0].'">Удалить</a></td>';
        echo "</tr>";
    }
    echo "</table>";

    // очищаем результат
    mysqli_free_result($result);
}

mysqli_close($link);
?>
<br>
<a href="Menu.php">Вернуться в главное меню</a> <a href="salesman_add.php">Добавить работника</a>
</center>
</body>
</html>
