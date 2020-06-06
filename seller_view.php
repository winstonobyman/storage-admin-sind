<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Поставщики</title>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="style.css">
</head>
<body>
<center>
<h4>Поставщики</h4>
<?php
require_once 'connection_params.php'; // подключаем скрипт
$link = mysqli_connect($host, $user, $password, $database)
    or die("Ошибка ".mysqli_error($link));
/*mysqli_character_set_charset(database_link link, string encoding) */

mysqli_set_charset($link, "utf8");

$query ="SELECT * FROM seller";

$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
if($result)
{
    $rows = mysqli_num_rows($result); // количество полученных строк

    echo "<table><tr><th>Id</th><th>Название компании</th><th>Адрес</th><th>Телефон</th><th>ИНН</th><th>Посредник</th></tr>";
    for ($i = 0 ; $i < $rows ; ++$i)
    {
        $row = mysqli_fetch_row($result);
        echo "<tr>";
            for ($j = 0 ; $j < 5 ; ++$j) echo "<td>$row[$j]</td>";
            if ($j[5] == 1) {echo "<td>Да</td>";} else {echo "<td>Нет</td>";}
        echo "</tr>";
    }
    echo "</table>";

    // очищаем результат
    mysqli_free_result($result);
}

mysqli_close($link);
?>
<a href="Menu.php" >Вернуться в главное меню</a> <a href="seller_add.php">Добавить поставщика</a>
</center>
</body>
</html>
