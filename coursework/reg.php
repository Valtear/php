<?php
function registration($username, $password, $password2, $bill){
    include('connection.php');
	$conn = connection();	
	$sql = "SELECT username FROM authorization";
	if ($result = $conn->query($sql)){
		foreach ($result as $row) {
			if($username == $row['username']){
				echo '<div class="alert alert-warning alert-dismissible fade show w-50 container" role="alert">
					<strong>Данное имя уже используется</strong>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>';
				
			}	
		}
	}	
	if($password != $password2){
		echo '<div class="alert alert-warning alert-dismissible fade show w-50 container" role="alert">
					<strong>Пароли на совпадают</strong>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>';
	}	
	try {
		$password_hash = password_hash($password, PASSWORD_BCRYPT);

		$sql = "SELECT bill FROM clients ";
		if ($result = $conn->query($sql)){			
			foreach ($result as $row) {
				if($bill == $row['bill'] && $password == $password2){
					$sql = "INSERT INTO authorization (username, password, client_id)
							SELECT '$username', '$password_hash', clients.id
							FROM clients WHERE clients.bill = $bill";
					if ($result = $conn->query($sql)){
						header("Location: index.php");		
						$conn->close();
					}				
				}					
			}	
			echo '<div class="alert alert-warning alert-dismissible fade show w-50 container" role="alert">
						<strong>Номер счета не найден </strong>
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>';
		}
	} catch(Exception $e){
		echo '<div class="alert alert-warning alert-dismissible fade show w-50 container" role="alert">
					<strong>Данный номер счета уже зарегестрирован</strong>
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
	<script>
		function validate(evt) {
			var theEvent = evt || window.event;
			if (theEvent.type === 'paste') {
				key = event.clipboardData.getData('text/plain');
			} else {
				var key = theEvent.keyCode || theEvent.which;
				key = String.fromCharCode(key);
			}
			var regex = /[0-9]|\./;
			if (!regex.test(key)) {
				theEvent.returnValue = false;
				if (theEvent.preventDefault) theEvent.preventDefault();
			}
		}
	</script>
</head>
<body>
  <form action="#" method="POST">
		<div class="container w-50">
			<div class="d-flex justify-content-center p-3">
				<h4>Регистрация<h4>
			</div>
			<div class="input-group mb-3">
				<span class="input-group-text" id="basic-addon1">Имя пользователя</span>
				<input type="text" class="form-control"  aria-describedby="basic-addon1" name="username" required>
			</div>
			<div class="input-group mb-3">
				<span class="input-group-text" id="basic-addon1">Пароль</span>
				<input type="password" class="form-control" aria-describedby="basic-addon1" name="password" required>
			</div>
			<div class="input-group mb-3">
				<span class="input-group-text" id="basic-addon1">Повторите пароль</span>
				<input type="password" class="form-control" aria-describedby="basic-addon1" name="password2" required>
			</div>
			<div class="input-group mb-3">
				<span class="input-group-text" id="basic-addon1">№ счета</span>
				<input type="text" class="form-control"  aria-describedby="basic-addon1"  onkeypress='validate(event)' maxlength="6" name="bill" required>
			</div>
			<div class="d-flex input-group justify-content-end p-3">
				<a class="btn btn-primary " href="index.php" ole="button">Назад</a>
				<button class="btn btn-primary" type="submit" name='btnSave'>Регистрация</button>
			</div>
		</div>
	</form>
	<?php
	if(isset($_POST['username'],$_POST['password'],$_POST['password2'],$_POST['bill']))
		registration($_POST['username'],$_POST['password'],$_POST['password2'],$_POST['bill']);
	?>
</body>
</html>	