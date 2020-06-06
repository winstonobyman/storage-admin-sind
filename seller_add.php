<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Добавление поставщика</title>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="style.css">
</head>
<body>
<h4>Добавление поставщика</h4>
<?php
require_once 'connection_params.php'; // подключаем скрипт

//SellerId	Name	Address	Phone	INN	Sign

if(isset($_POST['name']) && isset($_POST['address']) && isset($_POST['phone']) && isset($_POST['inn'])&& isset($_POST['sign'])){

    // подключаемся к серверу
    $link = mysqli_connect($host, $user, $password, $database)
        or die("Ошибка " . mysqli_error($link));

    // экранирования символов для mysql
    $name = htmlentities(mysqli_real_escape_string($link, $_POST['name']));
    $address = htmlentities(mysqli_real_escape_string($link, $_POST['address']));
    $phone = htmlentities(mysqli_real_escape_string($link, $_POST['phone']));
    $inn = htmlentities(mysqli_real_escape_string($link, $_POST['inn']));
    $sign = (htmlentities(mysqli_real_escape_string($link, $_POST['sign'])) == "Да") ? 1 : 0;


    // создание строки запроса
    $query ="INSERT INTO seller VALUES(NULL, '$name','$address', '$phone', '$inn', '$sign')";

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
<h4>Добавить поставщика</h4>
<form autocomplete="off" method="POST">
<p>Название компании: <br>
<input type="text" name="name" required /></p>

<p>Адрес:<br>
<input type="text" name="address" required /></p>

<p>Телефон: <br>
<input type="text" name="phone" required /></p>

<p>ИНН:<br>
<input type="text" name="inn" required /></p>

<p>Посредник:<br>
<select name="sign">
<option value="Да">Да</option>
<option value="Нет">Нет</option>
</select></p>

<input type="submit" value="Добавить">
</form>
<center><a href="Menu.php" class="a2" >Вернуться в главное меню</a></center>
</body>
</html>
