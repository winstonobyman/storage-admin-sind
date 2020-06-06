<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="style.css">

<title>Добавление клиента</title>
</head>
<body>
<?php
require_once 'connection_params.php'; // подключаем скрипт

if(isset($_POST['address']) && isset($_POST['company']) && isset($_POST['phone'])){

    // подключаемся к серверу
    $link = mysqli_connect($host, $user, $password, $database)
        or die("Ошибка " . mysqli_error($link));

    mysqli_set_charset($link, "utf8");

    // экранирования символов для mysql
    $company = htmlentities(mysqli_real_escape_string($link, $_POST['company']));
    $address = htmlentities(mysqli_real_escape_string($link, $_POST['address']));
    $phone = htmlentities(mysqli_real_escape_string($link, $_POST['phone']));

    // создание строки запроса
    $query ="INSERT INTO client VALUES(NULL, '$company','$address', '$phone')";

    // выполняем запрос
    $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
    if($result)
    {
        echo "<span style='color:blue;'>Данные добавлены</span>";
    }
    // закрываем подключение
    mysqli_close($link);
}
?>
<center>
<h4>Добавить клиента</h4>
<form autocomplete="off" method="POST">
<p>Название компании: <br>
<input required type="text" name="company" /></p>

<p>Адрес:<br>
<input required type="text" name="address" /></p>

<p>Телефон: <br>
<input required type="text" name="phone" /></p>

<input required type="submit" value="Добавить">
</form>
<a href="Menu.php">Вернуться в главное меню</a>
</center>
</body>
</html>
