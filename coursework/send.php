<?php
session_start();
include ("connection.php");
$conn = connection();
if (!$_SESSION['auth'] || $_SESSION['auth'] == 'admin')
	header("Location: http://localhost/");

$username = $_SESSION['auth'];
$sql = "SELECT username FROM authorization WHERE username = '$username' AND username != 'admin'";
if ($result = $conn->query($sql)) {	
	$sql = "SELECT * FROM clients AS c
			INNER JOIN authorization AS a ON (a.client_id = c.id)
			WHERE a.username = '$username'";
	if ($result = $conn->query($sql)) {
		foreach ($result as $row) {
			$_SESSION['name'] =  $row['name'];
			$_SESSION['fatherName'] = $row['father_name'];
			$_SESSION['balance'] = $row['balance'];
			$_SESSION['bill'] = $row['bill'];
		}
	}
}

if (isset($_POST['btnSave'])) {
	$sum = $_POST['sum'];
	$billIn = $_POST['bill'];
	$billEx = $_SESSION['bill'];
	$date = date('Y-m-d');
	$balanceEx = $_SESSION['balance'];
	$sql = "SELECT balance FROM clients WHERE bill = '$billIn'";
	if ($result = $conn->query($sql)){
		foreach ($result as $row) {
			$balanceIn= $row['balance'];

		}
	}
	

	if (isset($balanceIn) && $sum > $balanceEx) {
		echo '<div class="alert alert-warning alert-dismissible fade show w-50 container" role="alert">
				<strong>Недостаточно средств</strong>
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>';
	} else if(isset($balanceIn)){
		$balanceInSum = $sum + $balanceIn;
		$balanceExSum = $balanceEx - $sum;
		$sqlUpdateEx = "UPDATE clients
						SET balance = '$balanceExSum'
						WHERE bill = '$billEx'";
		$conn->query($sqlUpdateEx);

		$sqlInsertEx = "INSERT INTO transactions (date, expenditure, client_id)
						SELECT '$date','$sum', clients.id
						FROM clients WHERE clients.bill = '$billEx'";
		$conn->query($sqlInsertEx);

		$sqlUpdateIn = "UPDATE clients
						SET balance = '$balanceInSum'
						WHERE bill = '$billIn'";
		$conn->query($sqlUpdateIn);

		$sqlInsertIn = "INSERT INTO transactions (date,  income, client_id)
						SELECT '$date','$sum', clients.id
						FROM clients WHERE clients.bill = '$billIn'";
		$conn->query($sqlInsertIn);
		$conn->close();
		Header("Location:user.php");
	} else
		echo '<div class="alert alert-warning alert-dismissible fade show w-50 container" role="alert">
				<strong>Номер счета не найден</strong>
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>';					
}
?>

<!DOCTYPE HTML>
<html>

<head>
	<title>Банк-клиент</title>
	<meta charset="utf-8">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
		crossorigin="anonymous"></script>
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
	<nav class="navbar bg-primary" data-bs-theme="dark">
		<div class="container-fluid">
			<span class="navbar-brand mb-0 h1">Здравствуйте,
				<?php print ($_SESSION['name'] . " " . $_SESSION['fatherName'] . "! Ваш баланс: " . $_SESSION['balance']); ?></span>
			<a class="btn btn-primary" href="index.php" ole="button" name="exit">Выход</a>
		</div>
	</nav>
	<form name="form" action="" method="post">
		<div class="container w-50">
			<div class="d-flex justify-content-center p-3">
				<h4>Перечислить на другой счет<h4>
			</div>
			<div class="input-group mb-3">
				<span class="input-group-text" id="basic-addon1">№ счета</span>
				<input type="text" class="form-control" aria-describedby="basic-addon1" onkeypress='validate(event)'
					name="bill" maxlength="6" required>
			</div>
			<div class="input-group mb-3">
				<span class="input-group-text" id="basic-addon1">Сумма</span>
				<input type="text" class="form-control" aria-describedby="basic-addon1" onkeypress='validate(event)'
					name="sum" required>
			</div>
			<div class="d-flex input-group justify-content-end p-3">
				<a class="btn btn-primary " href="user.php" ole="button">Назад</a>
				<button class="btn btn-primary" type="submit" name='btnSave'>Отправить</button>
			</div>
		</div>
	</form>
</body>

</html>