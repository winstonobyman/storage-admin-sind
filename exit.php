<?php
session_start();
unset($_SESSION['login']);
header("Location: authentification.php?logout=true");
?>