<!DOCTYPE html>
<html>
<head>
<title>Поступление товара</title>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="style.css">
<meta charset="utf-8">
</head>
<body>
<center>
<?php
require_once 'connection_params.php'; // подключаем скрипт

if(isset($_POST['sellerid']) && isset($_POST['goodid'])&& isset($_POST['date'])&& isset($_POST['price'])){

    // подключаемся к серверу
    $link = mysqli_connect($host, $user, $password, $database)
        or die("Ошибка " . mysqli_error($link));

    // экранирования символов для mysql
    $sellerid = $_POST['sellerid'];
    $goodid =  $_POST['goodid'];
    $date = htmlentities(mysqli_real_escape_string($link, $_POST['date']));
    $price = htmlentities(mysqli_real_escape_string($link, $_POST['price']));

    // создание строки запроса
    $query ="INSERT INTO invoicein VALUES(NULL, $goodid, $sellerid, $price, $date)";

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
<h4>Поступление на склад</h4>
<form autocomplete="off" method="POST">
<p>Выберите товар: <br>
	<select name="goodid">
		<?php
        require_once "connection_params.php";

        $link = mysqli_connect($host, $user, $password, $database)
        or die("Ошибка " . mysqli_error($link));
        mysqli_set_charset($link, "utf8");



            $query = "SELECT goodid, name FROM good";
            $result = mysqli_query($link, $query) or die("Ошибка ".mysqli_error($link));
            if($result)
            {
                $rows = mysqli_num_rows($result); // количество полученных строк

                for ($i = 0 ; $i < $rows ; ++$i)
                {
                    $row = mysqli_fetch_row($result);
                    echo "<option value='{$row[0]}'>{$row[1]}</option>";
                }
                // очищаем результат
                mysqli_free_result($result);
            }
                // закрываем подключение
                mysqli_close($link);
		?>
	</select></p>
<p>Выберите поставщика: <br>
<select name="sellerid">
<?php
        require_once "connection_params.php";

        $link = mysqli_connect($host, $user, $password, $database)
        or die("Ошибка " . mysqli_error($link));
        mysqli_set_charset($link, "utf8");



            $query = "SELECT sellerid, name FROM seller";
            $result = mysqli_query($link, $query) or die("Ошибка ".mysqli_error($link));
            if($result)
            {
                $rows = mysqli_num_rows($result); // количество полученных строк

                for ($i = 0 ; $i < $rows ; ++$i)
                {
                    $row = mysqli_fetch_row($result);
                    echo "<option value='{$row[0]}'>{$row[1]}</option>";
                }
                // очищаем результат
                mysqli_free_result($result);
            }
            // закрываем подключение
            mysqli_close($link);

		?>
	</select></p>
<p>Введите цену:<br>
<input type="int" required name="price" /></p>
<p>Дата выдачи счёта-фактуры: <br>
<input type="date" required name="date" /></p>
<input type="submit" value="Добавить">
</form>
</body>
<a href="Menu.php">Вернуться в главное меню</a>
</center>
</html>
