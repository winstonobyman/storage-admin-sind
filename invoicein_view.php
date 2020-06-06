<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Приходная накладная ведомость</title>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="style.css">
</head>
<center>
<body>
<h4>Приходная накладная ведомость</h4>
<?php
require_once 'connection_params.php'; // подключаем скрипт
$link = mysqli_connect($host, $user, $password, $database)
    or die("Ошибка ".mysqli_error($link));
/*mysqli_character_set_charset(database_link link, string encoding) */

mysqli_set_charset($link, "utf8");

$query ="SELECT invoicein.InvoiceInID, good.Name, seller.Name, invoicein.Date, invoicein.Price FROM invoicein INNER JOIN good ON invoicein.GoodID = good.GoodID INNER JOIN seller ON invoicein.SellerID = seller.SellerId";

$result = mysqli_query($link, $query) or die("Ошибка ".mysqli_error($link));
if($result)
{
    $rows = mysqli_num_rows($result); // количество полученных строк
    //InvoiceInID 	GoodID 	SellerID 	Date 	Price
    echo "<table border=1><tr><th>№ приходной накладной</th><th>Товар</th><th>Поставщик</th><th>Дата</th><th>Цена</th></tr>";
    for ($i = 0 ; $i < $rows ; ++$i)
    {
        $row = mysqli_fetch_row($result);
        echo "<tr>";
            for ($j = 0 ; $j < 5 ; ++$j) echo "<td>$row[$j]</td>";
        echo "</tr>";
    }
    echo "</table>";

    // очищаем результат
    mysqli_free_result($result);
}

mysqli_close($link);
?>
<a href="Menu.php">Вернуться в главное меню</a> <a href="invoicein_add.php">Принять товар</a>
</center>
</body>
</html>
