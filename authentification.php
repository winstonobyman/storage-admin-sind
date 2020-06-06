<html>
	<head>
		<meta charset="utf-8">
		<title>Вход</title>
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<link rel="stylesheet" href="style.css">
	</head>
	<body>
	<div>
		<div>
		<div align="center"><h2>Вход</h2></div>
		<form autocomplete="off"  method="post" action="authentification.php" >
		<center>
		<div align="center">
			<input type="text" required placeholder="Логин" name="Login"><br><br>
			<input type="password" required placeholder="Пароль" name="Password"><br><br>
			<div class="btn-group">
				<input type="submit"  name="send" value="Войти" />
				<a href="register.php">Регистрация</a>
			</div>
	</div>
		</center>
		</form>

		<?php
		$flag='';
		session_start();
		if (isset($_SESSION['login'])) {
			header('Location: Menu.php');
			exit();
		}
		if (isset ($_POST['send'])){
			include_once("connection_params.php");

			$login = $_POST['Login'];
			$password = $_POST['Password'];

			// Проверяем есть ли такой логин в бд
			if ($result = mysqli_query($connection, " SELECT login FROM users ")){
				while($row = mysqli_fetch_assoc($result)){
					if ($row['login'] == $login) {
						$flag = 1;
					}
				}
			}
			if (!$flag){
				echo "<tr><div>
					<span><center>Пользователя с таким логином не существует</center></span></div>
					</tr>";
			}
			else{
				if ($result = mysqli_query($connection, " SELECT login, password, salt FROM users WHERE login='$login' ")){
					$row = mysqli_fetch_assoc($result);
					$salt = $row['salt'];
					$password = md5($password.$salt);
					if ($row['password'] == $password) {
						#$_SESSION['login'] = $login;
						header("Location: Menu.php");
						exit();
					}
					else {
						echo "<tr><div class='alert'>
							<span><center>Неверный пароль</center></span></div>
							</tr>";
					}
				}
			}
		}
		if (isset($_GET['success'])) {
			echo("<center>Вы успешно зарегистрированы. Теперь войдите</center>");
		}
		if (isset($_GET['logout'])) {
			echo("<center>Вы успешно вышли</center>");
		}

		?>

	</body>
</html>
