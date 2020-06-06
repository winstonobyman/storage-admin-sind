<?php
require_once ('connection_params.php');
$link = mysqli_connect($host, $user, $password, $database)
    or die("Ошибка ".mysqli_error($link));
/*mysqli_character_set_charset(database_link link, string encoding) */

mysqli_set_charset($link, "utf8");


if(isset($_GET['id'])) {
    $id = mysqli_real_escape_string($link, $_GET['id']);


    $query = "SELECT company, address, phone FROM client WHERE ClientID=$id";
    $result = mysqli_query($link, $query);
    $row = mysqli_fetch_assoc($result);
}

if(isset($_POST['send'])) {
    $company = mysqli_real_escape_string($link,htmlspecialchars($_POST['company']));
    $address = mysqli_real_escape_string($link,htmlspecialchars($_POST['address']));
    $phone = mysqli_real_escape_string($link,htmlspecialchars($_POST['phone']));

    $query ="UPDATE client SET Company='$company', Address='$address', phone='$phone' WHERE ClientID=$id";
    $result=mysqli_query($link, $query);
    if ($result) {
        $mes = "Успешно обновлено";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="styles/style.css" type="text/css" />
<link href="style/style.css" rel="stylesheet">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<title>Добавление клиента</title>
</head>
<body>
<h4>Добавление клиента</h4>
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
    //$query ="INSERT INTO client VALUES(NULL, '$company','$address', '$phone')";

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
<h4>Добавить клиента</h4>
<form autocomplete="off" method="POST">
<p>Название компании: <br>
<input type="text" value="<?= isset($_GET['id']) ? $row['company'] : ''; ?>" name="company" required/></p>

<p>Адрес:<br>
<input type="text" name="address" value="<?= isset($_GET['id']) ? $row['address'] : ''; ?>" required /></p>

<p>Телефон: <br>
<input type="text" name="phone" value="<?= isset($_GET['id']) ? $row['phone'] : ''; ?>" required /></p>

<input type="submit" value="Добавить" name="send">
</form>
<center><a href="Menu.php" class="a2" >Вернуться в главное меню</a></center>
</body>
</html>
