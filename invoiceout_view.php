<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Приходная накладная ведомость</title>
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

$query ="SELECT invoiceout.InvoiceOutID, invoiceout.CountID, salesman.SalesManName FROM invoiceout INNER JOIN salesman ON invoiceout.SalesmanID = salesman.SalesManID ";

$result = mysqli_query($link, $query) or die("Ошибка ".mysqli_error($link));
if($result)
{
    $rows = mysqli_num_rows($result); // количество полученных строк
    //InvoiceOutID 	CountID 	SalesmanID
    echo "<table><tr><th>№ выходной накладной</th><th>№ счёта-фактуры</th><th>Продавец</th></tr>";
    for ($i = 0 ; $i < $rows ; ++$i)
    {
        $row = mysqli_fetch_row($result);
        echo "<tr>";
            for ($j = 0 ; $j < 3 ; ++$j) echo "<td>$row[$j]</td>";
        echo "</tr>";
    }
    echo "</table>";

    // очищаем результат
    mysqli_free_result($result);
}

mysqli_close($link);
?>
<a href="Menu.php" class="a2" >Вернуться в главное меню</a> <a href="invoiceout_add.php">Отпустить товар со склада</a>
</center>
</body>
</html>
