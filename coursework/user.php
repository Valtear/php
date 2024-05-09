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
			<a href="selfSend.php" class="btn btn-primary fs-5">Пополнить свой счет</a>
			<a href="send.php" class="btn btn-primary fs-5">Перечислить на другой счет</a>
			<a class="btn btn-primary" href="index.php" ole="button" name="exit">Выход</a>
		</div>
	</nav>
	<?php
	$conn = connection();
	echo
		"<div class='p-3'>
		<table class='table table-hover '>
		  <thead>
			<tr>
			  <th scope='col'>#</th>
			  <th scope='col'>Дата операции</th>
			  <th scope='col'>Доходы</th>
			  <th scope='col'>Расходы</th>
			</tr>
		  </thead>
		  <tbody>";
	$bill = $_SESSION['bill'];
	$sql = "SELECT * FROM transactions AS t
			INNER JOIN clients AS c ON (t.client_id = c.id)
			WHERE c.bill = '$bill'";
	$i = 0;
	if ($result = $conn->query($sql)) {
		foreach ($result as $row) {
			$date = $row["date"];
			$in = $row["income"];
			$ex = $row["expenditure"];

			echo
				"<tr>
					<th scope='row'>" . ++$i . "</th>
					<td> $date </td>
					<td> $in </td>
					<td> $ex </td>
				</tr>";
		}
	}
	echo
		"</tbody>
		</table>
		</div>";
	$conn->close();
	?>
</body>

</html>