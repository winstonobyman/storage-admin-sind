<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="style.css">

</head>
<body>
<center>
<?php
require_once 'connection_params.php'; // подключаем скрипт

//	DateStart 	Sum 	Cash 	ClientID 	WorkerID

if(isset($_POST['datestart']) && isset($_POST['sum'])&& isset($_POST['cash'])&& isset($_POST['clientid']) && isset($_POST['workerid'])){

    // подключаемся к серверу
    $link = mysqli_connect($host, $user, $password, $database)
        or die("Ошибка " . mysqli_error($link));

    // экранирования символов для mysql
    $datestart = htmlentities(mysqli_real_escape_string($link, $_POST['datestart']));
    $sum = htmlentities(mysqli_real_escape_string($link, $_POST['sum']));
    $cash = (htmlentities(mysqli_real_escape_string($link, $_POST['cash'])) == "Да") ? 1 : 0;
    $clientid = htmlentities(mysqli_real_escape_string($link, $_POST['clientid']));
    $workerid = htmlentities(mysqli_real_escape_string($link, $_POST['workerid']));
    $invoiceinid = htmlentities(mysqli_real_escape_string($link, $_POST['invoiceinid']));

    // создание строки запроса
    $query ="INSERT INTO countfact VALUES(NULL, $datestart, $sum, $cash, $clientid, $workerid)";

    // выполняем запрос
    $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
    // добавление записи в общую таблицу вхоной накладной и счёта-фактуры
    $latest_id = mysqli_insert_id($link);

    $sc_query = "INSERT INTO invoiceincountid VALUES($invoiceinid, $latest_id)";
    $result2 = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
    if($result && $result2)
    {
        echo "<span style='color:blue;'>Данные добавлены</span>";
    }
    // закрываем подключение
    mysqli_close($link);
}
?>
<h4>Выписка счёт-фактуры</h4>
<form autocomplete="off" method="POST">
<p>Выберите клиента: <br>
	<select name="clientid">
		<?php
        require_once "connection_params.php";

        $link = mysqli_connect($host, $user, $password, $database)
        or die("Ошибка " . mysqli_error($link));
        mysqli_set_charset($link, "utf8");



            $query = "SELECT clientid, company FROM client";
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
		?>
	</select></p>
<p>Кто выдал счёт-фактуру? <br>
<select name="workerid">
<?php
        require_once "connection_params.php";

        $link = mysqli_connect($host, $user, $password, $database)
        or die("Ошибка " . mysqli_error($link));
        mysqli_set_charset($link, "utf8");



            $query = "SELECT workerid, worker FROM worker";
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
            } //	DateStart 	Sum 	Cash
		?>
	</select></p>

<p>Введите цену:<br>
<input type="int" required name="sum" /></p>
<p>Дата выдачи счёта-фактуры: <br>
<input type="date" required name="datestart" /></p>

<p>Оплата наличными? <br>
<select name="cash">
<option value="Да">Да</option>
<option value="Нет">Нет</option>
</select></p>

<p>Выберите товар: <br>
<select name="invoiceinid">
<?php
        require_once "connection_params.php";

        $link = mysqli_connect($host, $user, $password, $database)
        or die("Ошибка " . mysqli_error($link));
        mysqli_set_charset($link, "utf8");



            $query = "SELECT invoicein.InvoiceInID, good.Name FROM invoicein INNER JOIN good ON invoicein.GoodID = good.GoodID";
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
		?>
	</select></p>

<input type="submit" value="Добавить">
<a href="Menu.php" class="a2" >Вернуться в главное меню</a>
</center>
</form>
</body>
</html>
