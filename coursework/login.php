<?php	
session_start();
include('connection.php');
function login($username, $password){	
	$conn = connection();
	$sql = "SELECT username, password FROM authorization";
	if ($result = $conn->query($sql)) {
		foreach ($result as $row) {
			if($username == $row['username'] && password_verify($password, $row['password'])){					
				$conn->close();
				$_SESSION['auth'] = $username;
				if ($_SESSION['auth'] == "admin") {
					header("Location: worker.php");
				}
				else {
					header("Location: user.php");	
				}
			}												
		}
		echo '<div class="alert alert-warning alert-dismissible fade show w-50 container" role="alert">
					<strong>Неверные логин или пароль!</strong> Повторите попытку
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>';
	}	

}
?>

<!DOCTYPE HTML>
<html>
<head>
	<title>Банк-клиент</title>	
	<meta charset="utf-8">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</head>
<body>
  <form action="login.php" method="POST">
		<div class="container w-50">
			<div class="d-flex justify-content-center p-3">
				<h4>Вход<h4>
			</div>
			<div class="input-group mb-3">
				<span class="input-group-text" id="basic-addon1">Имя пользователя</span>
				<input type="text" class="form-control"  aria-describedby="basic-addon1" name="username" required>
			</div>
			<div class="input-group mb-3">
				<span class="input-group-text" id="basic-addon1">Пароль</span>
				<input type="password" class="form-control" aria-describedby="basic-addon1" name="password" required>
			</div>
			<div class="d-flex input-group justify-content-end p-3">
				<a class="btn btn-primary " href="index.php" ole="button">Назад</a>
				<button class="btn btn-primary" type="submit" name='btnSave'>Войти</button>
			</div>
		</div>
	</form>
	<?php
	if(isset($_POST['username'],$_POST['password']))
		login($_POST['username'],$_POST['password']);
	?>
</body>
</html>	