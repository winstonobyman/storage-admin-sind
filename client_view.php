<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<meta charset="utf-8">
<link rel="stylesheet" href="style.css">

<title>Клиенты</title>
</head>
<body>
<center>
<h4>Клиенты</h4>
<?php
require_once 'connection_params.php'; // подключаем скрипт
$link = mysqli_connect($host, $user, $password, $database)
    or die("Ошибка ".mysqli_error($link));
/*mysqli_character_set_charset(database_link link, string encoding) */

mysqli_set_charset($link, "utf8");

$query ="SELECT * FROM client";

$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
if($result)
{
    $rows = mysqli_num_rows($result); // количество полученных строк

    echo '<table id="tablew"><tr><th>Id</th><th>Название компании</th><th>Адрес</th><th>Телефон</th></tr>';
    for ($i = 0 ; $i < $rows ; ++$i)
    {
        $row = mysqli_fetch_row($result);
        echo "<tr>";
            for ($j = 0 ; $j < 4 ; ++$j) echo "<td>$row[$j]</td>";
        echo "</tr>";
    }
    echo "</table>";

    // очищаем результат
    mysqli_free_result($result);
}

mysqli_close($link);
?>
<a href="Menu.php">Вернуться в главное меню</a> <a href="client_add.php">Добавить клиента</a>
</center>
</body>
</html>
