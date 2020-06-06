<?php
$id = $_GET['id'];

require_once 'connection_params.php';

$conn = mysqli_connect($host, $user, $password, $database)
    or die("Ошибка ". mysqli_error($conn));

$query = "DELETE FROM salesman WHERE SalesManID = $id";

if (mysqli_query($conn, $query)) {
    mysqli_close($conn);
    header('Location: salesman_view.php'); //If book.php is your main page where you list your all records
    exit;
} else {
    echo "Error deleting record";
}
?>
