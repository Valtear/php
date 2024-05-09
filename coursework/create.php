<?php
session_start();
if ($_SESSION['auth'] != "admin"){
	header("Location: http://localhost/");
}
include('connection.php');
function randomBill()
{
	$conn = connection();
	$sql = "SELECT bill FROM clients";
	$flag = true;
	if ($result = $conn->query($sql)) {
		do {
			$randBill = rand(100000, 999999);
			foreach ($result as $row) {
				if ($row["bill"] == $randBill) {
					$flag = false;
					break;
				}
			}
		}
		while ($flag != true);
	}
	$conn->close();
	return $randBill;
}

$_SESSION['randBill'] = randomBill();

function saveDB($name, $surname, $fatherName, $bill, $balance)
{
	$conn = connection();
	$sql = "INSERT INTO clients (name, surname, father_name, bill, balance) VALUES ('$name', '$surname', '$fatherName', '$bill', '$balance')";
	if ($result = $conn->query($sql)) {
		header('Location: worker.php');
		$conn->close();
	}
}
?>
<!DOCTYPE HTML>
<html>

<head>
	<title>Банк-клиент</title>
	<meta charset="utf-8">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
			<div class="container">
				<div class="d-flex justify-content-center p-3">
					<h4>Карта клиента<h4>
				</div>
				<div class="input-group mb-3">
					<span class="input-group-text" id="basic-addon1">Имя</span>
					<input type="text" class="form-control"  aria-describedby="basic-addon1" name="name" required>
				</div>
				<div class="input-group mb-3">
					<span class="input-group-text" id="basic-addon1">Фамилия</span>
					<input type="text" class="form-control" aria-describedby="basic-addon1" name="surname" required>
				</div>
				<div class="input-group mb-3">
					<span class="input-group-text" id="basic-addon1">Отчество</span>
					<input type="text" class="form-control" aria-describedby="basic-addon1" name="fatherName" required>
				</div>
				<div class="input-group mb-3">
					<span class="input-group-text" id="basic-addon1">№ счета</span>
					<input type="text" class="form-control" aria-describedby="basic-addon1" readonly value="<?php print($_SESSION['randBill']); ?>" name="bill">
				</div>
				<div class="input-group mb-3">
					<span class="input-group-text" id="basic-addon1">Баланс</span>
					<input type="text" class="form-control" aria-describedby="basic-addon1" onkeypress='validate(event)' name="balance" required>
				</div>
				
				<div class="d-flex input-group justify-content-end p-3">
					<a class="btn btn-primary " href="worker.php" ole="button">Назад</a>
					<button class="btn btn-primary" type="submit" name='btnSave'>Сохранить</button>
				</div>
			</div>
		</form>
		<?php
		if (isset($_POST["name"], $_POST["surname"], $_POST["fatherName"], $_POST["bill"], $_POST["balance"])) {
			saveDB($_POST["name"], $_POST["surname"], $_POST["fatherName"], $_POST["bill"], $_POST["balance"]);
		}

		?>
  </body>
</html>