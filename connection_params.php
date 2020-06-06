<?php
$host = 'localhost'; // адрес сервера 
$database = 'storage'; // имя базы данных
$user = 'root'; // имя пользователя
$password = ''; // пароль
$connection =  mysqli_connect("localhost","root","","storage");
mysqli_set_charset($connection, "utf8");
?>