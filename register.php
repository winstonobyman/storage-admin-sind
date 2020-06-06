<html>
	<head>
		<meta charset="utf-8">
		<title>Регистрация</title>
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<link rel="stylesheet" href="style.css">
	</head>
	<body>
		<center>
	<div>
		<div>
		<div align="center"><h2>Регистрация</h2></div>
		<form autocomplete="off"  method="post" action="register.php" >
			<div>
				<label for="Name">Имя</label>
				<input type="text" required name="Name">
			</div>
			<diV>
				<label for="Surname">Фамилия</label>
				<input  type="text" required name="Surname">
			</div>
			<div >
				<label for="Login">Логин</label>
				<input  type="text" required name="Login">
			</div>
			<div>
				<label  rowspan="2" for="Password">Пароль</label></td>
				<input  type="Password" required name="Password"></td>
			</div>
			<div>
				<label for="Password_r">Повторите пароль</label>
				<input  type="password" required name="Password_r">
			</div>


		<?php
		session_start();

		function GenerateSalt($n = 3){
				$key = '';
				$pattern = '1234567890abcdefghijklmnopqrstuvwxyz./*_-=+';
				$counter = strlen($pattern)-1;
				for($i=0; $i<$n; $i++){
					$key .= $pattern{rand(0,$counter)};
				}
				return $key;
			}

		if (isset($_SESSION['login'])) {
			header('Location: Menu.php');
		}

		$flag='';
		if(isset($_POST['send'])){
			include_once("connection_params.php");

			$Name = htmlentities(mysqli_real_escape_string($connection, $_POST['Name']));
			$Surname = htmlentities(mysqli_real_escape_string($connection, $_POST['Surname']));
			$Login = htmlentities(mysqli_real_escape_string($connection, $_POST['Login']));
			$Password = htmlentities(mysqli_real_escape_string($connection, $_POST['Password']));
			$Password_r = htmlentities(mysqli_real_escape_string($connection, $_POST['Password_r']));

			//Проверяем правильность введенного пароля
			if($Password != $Password_r){
				$flag=1;
				echo "<tr><div class='alert'>
						<span><center>Неверный пароль. Проверьте правильность введенных данных.</center></span></div>

						</tr>";
			}

			//Проверяем есть ли пользователь с таким логином
			if ($result = mysqli_query($connection, " SELECT login FROM users WHERE login='$Login' ")){
				while($row = mysqli_fetch_assoc($result)){
					if ($row['login']==$Login && $flag==''){
						$flag=1;
						echo "<tr><div class='alert'>
							<span><center>Пользователь с таким логином уже существует. Введите другой логин</center></span></div>

							</tr>";
					}
				}
			}

			if(!$flag){
				$salt = GenerateSalt();
				$hasher_password = md5($Password.$salt);

				$query = "INSERT INTO users VALUES ('$Login', '$hasher_password',  '$salt')";
				$result = mysqli_query($connection, $query);
				if ($result == true){
					header('Location: authentification.php?success=true');
				}
			}
		}
		?>
		<div >
							<div >
								<button type="submit" name="send" value="Регистрация" >Регистрация</button>
								<button type="reset" value="Очистить">Очистить</button>
							</div>
							<button type="reset" style="background-color:transparent" ><a href="authentification.php">Уже есть аккаунт</a></button>
						</div>
		</form>
	</center>
	</body>
</html>
