<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Счёт-фактура</title>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="style.css">

</head>
<body>
<center>
<h4>Приходная накладная ведомость</h4>
<?php
require_once 'connection_params.php'; // подключаем скрипт
$link = mysqli_connect($host, $user, $password, $database)
    or die("Ошибка ".mysqli_error($link));
/*mysqli_character_set_charset(database_link link, string encoding) */

mysqli_set_charset($link, "utf8");

$query ="SELECT countfact.CountID, countfact.DateStart, countfact.Sum,  IF(countfact.Cash, \"Да\", \"Нет\"), client.Company, worker.Worker FROM countfact INNER JOIN client ON countfact.ClientID = client.ClientID INNER JOIN worker ON countfact.WorkerID = worker.WorkerID";

$result = mysqli_query($link, $query) or die("Ошибка ".mysqli_error($link));
if($result)
{
    $rows = mysqli_num_rows($result); // количество полученных строк
    // CountID 	DateStart 	Sum 	Cash 	ClientID 	WorkerID
    echo "<table border=1><tr><th>№ счёта-фактуры</th><th>Дата выписки</th><th>Сумма</th><th>Наличные</th><th>Клиент</th><th>Выдавший с/ф</th></tr>";
    for ($i = 0 ; $i < $rows ; ++$i)
    {
        $row = mysqli_fetch_row($result);
        echo "<tr>";
            for ($j = 0 ; $j < 6 ; ++$j) echo "<td>$row[$j]</td>";
        echo "</tr>";
    }
    echo "</table>";

    // очищаем результат
    mysqli_free_result($result);
}

mysqli_close($link);
?>
<a href="Menu.php">Вернуться в главное меню</a> <a href="countfact_add.php">Выписать счет-фактуру</a>
</center>
</body>
</html>
