<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="style.css">
<title>Добавление продавца</title>
</head>
<body>
<center>
<?php
require_once 'connection_params.php'; // подключаем скрипт

if(isset($_POST['name'])){

    // подключаемся к серверу
    $link = mysqli_connect($host, $user, $password, $database)
        or die("Ошибка " . mysqli_error($link));

    // экранирования символов для mysql
    $name = htmlentities(mysqli_real_escape_string($link, $_POST['name']));
    // создание строки запроса
    $query ="INSERT INTO salesman VALUES(NULL, '$name')";

    // выполняем запрос
    $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
    if($result)
    {
        echo "<span>Данные добавлены</span>";
    }
    // закрываем подключение
    mysqli_close($link);
}
?>
<h4>Добавить сотрудника</h4>
<form autocomplete="off" method="POST">
<p>Введите имя: <br>
<input type="text" required name="name" /></p>

<input type="submit" required value="Добавить" class="w3-button w3-round w3-green">
</form>
<br>
<a href="Menu.php" class="w3-button w3-round w3-green">Вернуться в главное меню</a></center>
</body>
</html>
