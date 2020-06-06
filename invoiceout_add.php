<!DOCTYPE html>
<html>
<head>
<title>Поступление товара</title>
<meta charset="utf-8">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="style.css">
</head>
<body>
<center>
<?php
require_once 'connection_params.php'; // подключаем скрипт

if(isset($_POST['salesmanid']) && isset($_POST['countid'])){

    // подключаемся к серверу
    $link = mysqli_connect($host, $user, $password, $database)
        or die("Ошибка " . mysqli_error($link));

    // экранирования символов для mysql
    $countid = htmlentities(mysqli_real_escape_string($link, $_POST['countid']));
    $salesmanid = htmlentities(mysqli_real_escape_string($link, $_POST['salesmanid']));

    // создание строки запроса
    $query ="INSERT INTO invoicein VALUES(NULL, $countid, $salesmanid)";

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
<h4>Забор товара</h4>
<form autocomplete="off" method="POST">
<p>Выберите продавца: <br>
	<select name="salesmanid">
		<?php
        require_once "connection_params.php";

        $link = mysqli_connect($host, $user, $password, $database)
        or die("Ошибка " . mysqli_error($link));
        mysqli_set_charset($link, "utf8");



            $query = "SELECT salesmanid, salesmanname FROM salesman";
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
<p>Выберите номер счёт-фактуры: <br>
<select name="countid">
<?php
        require_once "connection_params.php";

        $link = mysqli_connect($host, $user, $password, $database)
        or die("Ошибка " . mysqli_error($link));
        mysqli_set_charset($link, "utf8");



            $query = "SELECT countid FROM countfact";
            $result = mysqli_query($link, $query) or die("Ошибка ".mysqli_error($link));
            if($result)
            {
                $rows = mysqli_num_rows($result); // количество полученных строк

                for ($i = 0 ; $i < $rows ; ++$i)
                {
                    $row = mysqli_fetch_row($result);
                    echo "<option value='{$row[0]}'>{$row[0]}</option>";
                }
                // очищаем результат
                mysqli_free_result($result);
            }
            // закрываем подключение
            mysqli_close($link);

		?>
	</select></p>
<input type="submit" required value="Добавить">
</form>
<a href="Menu.php" >Вернуться в главное меню</a></center>
</body>
</html>
