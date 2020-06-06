<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="style.css">
<title>Товары</title>
</head>
<body>
<center>
<?php
require_once 'connection_params.php'; // подключаем скрипт
$link = mysqli_connect($host, $user, $password, $database)
    or die("Ошибка ".mysqli_error($link));
/*mysqli_character_set_charset(database_link link, string encoding) */

mysqli_set_charset($link, "utf8");

$query ="SELECT * FROM good";

$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
if($result)
{
    $rows = mysqli_num_rows($result); // количество полученных строк

    echo "<table border=1><tr><th>Id товара</th><th>Название товара</th><th>Ссылка на штрих-код</th>".
    "<th>Дата производства</th><th>Срок годности</th><th>Номер сертификата соответствия</th>".
    "<th>Дата сертификата соответствия</th><th>Данные о производителе</th><th>Примечания</th><th>Вид упаковки</th></tr>";
    for ($i = 0 ; $i < $rows ; ++$i)
    {
        $row = mysqli_fetch_row($result);
        echo "<tr>";
            for ($j = 0 ; $j < 2 ; ++$j) echo "<td>$row[$j]</td>";
            echo "<td><a href=\"$row[2]\">$row[2]</a></td>";
            for ($j = 3 ; $j < 10 ; ++$j) echo "<td>$row[$j]</td>";
        echo "</tr>";
    }
    echo "</table>";

    // очищаем результат
    mysqli_free_result($result);
}

mysqli_close($link);
?>
</body>
<a href="Menu.php" class="a2" >Вернуться в главное меню</a> <a href="good_add.php">Добавить товар</a>
</center>
</html>
