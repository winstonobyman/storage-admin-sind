<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="style.css">
<title>Добавление товара</title>
</head>
<body>
<center>
<?php
require_once 'connection_params.php'; // подключаем скрипт

if(isset($_POST['name']) && isset($_POST['company'])){

    // подключаемся к серверу
    $link = mysqli_connect($host, $user, $password, $database)
        or die("Ошибка " . mysqli_error($link));

    // экранирования символов для mysql
    $name = htmlentities(mysqli_real_escape_string($link, $_POST['name']));
    $international = htmlentities(mysqli_real_escape_string($link, $_POST['international']));
    $begin = $_POST['begin'];
    $end = $_POST['end'];
    $numberyes = $_POST['numberyes'];
    $dateyes = $_POST['dateyes'];
    $producer = htmlentities(mysqli_real_escape_string($link, $_POST['producer']));
    $instrucrions = htmlentities(mysqli_real_escape_string($link, $_POST['instructions']));
    $batch = htmlentities(mysqli_real_escape_string($link, $_POST['batch']));


    // создание строки запроса
    $query ="INSERT INTO good VALUES(NULL, '$name','$international', '$begin', '$end', '$numberyes', '$dateyes'  '$producer', '$instruction', '$batch')";

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
<h4>Добавить товар</h4>
<form autocomplete="off" method="POST">
<p>Название товара: <br>
<input type="text" required name="name" /></p>

<p>Ссылка на штрих-код: <br>
<input type="text" required name="international" /></p>

<p>Дата производства: <br>
<input type="date" required name="begin" /></p>

<p>Срок годности: <br>
<input type="date" required name="end" /></p>

<p>Номер сертификата соответствия: <br>
<input type="int" required name="numberyes" /></p>

<p>Дата выдачи сертификата соответствия: <br>
<input type="date" required name="dateyes" /></p>

<p>Информация о производителе: <br>
<input type="text" required name="producer" /></p>

<p>Примечания к товару:<br>
<input type="text" required name="instructions" /></p>

<p>Тип упаковки:<br>
<input type="text" required name="batch" /></p>

<input type="submit" value="Добавить">
</form>
<a href="Menu.php" >Вернуться в главное меню</a>
</center>
</body>
</html>
