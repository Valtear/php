<?php
session_start();
if ($_SESSION['auth'] != "admin"){
	header("Location: http://localhost/");
}

include('connection.php');
function drawTable($search, $order)
{
	$conn = connection();
	echo
		"<div class='p-3'>
		<table class='table table-hover '>
		  <thead>
			<tr>
			  <th scope='col'>#</th>
			  <th scope='col'>Имя</th>
			  <th scope='col'>Фамилия</th>
			  <th scope='col'>Отчество</th>
			  <th scope='col'>№ счета</th>
			  <th scope='col'>Баланс</th>
			  <th scope='col'>Удаление</th>
			  <th scope='col'>Изменение</th>
			</tr>
		  </thead>
		  <tbody>";
	if ($search != null && $order == null)
		$sql = "SELECT * FROM clients WHERE bill = $search";	
	if ($search == null && $order == null)
		$sql = "SELECT * FROM clients";
	if ($search == null && $order == "asc")
		$sql = "SELECT * FROM clients ORDER BY surname $order";
	if ($search == null && $order == "desc")
		$sql = "SELECT * FROM clients ORDER BY surname $order";
	
	$i = 0;
	if ($result = $conn->query($sql)) {
		foreach ($result as $row) {
			$id = $row["id"];
			$name = $row["name"];
			$surname = $row["surname"];
			$fatherName = $row["father_name"];
			$bill = $row["bill"];
			$balance = $row["balance"];
			if($row['bill'] != '0'){
				echo
					"<tr>
							<th scope='row'>" . ++$i . "</th>
							<td> $name </td>
							<td> $surname </td>
							<td> $fatherName </td>
							<td> $bill </td>
							<td> $balance </td>
							<td>
								<a class='btn btn-primary' href='worker.php?delete=$id' ole='button' name = 'delete'>Удалить</a>
							</td>
							<td>
								<a class='btn btn-primary' href='edit.php?edit=$id' ole='button name = edit'>Изменить</a>
							</td>
						</tr>";
			}
			if (isset($_GET['delete'])) {
				$conn = connection();
				$userid = $conn->real_escape_string($_GET["delete"]);
				$sql = "DELETE FROM clients WHERE id = $userid";
				if ($result = $conn->query($sql)) {
					header("Location: worker.php");
					$conn->close();
				} else
					echo 'error';
			}
		}
	}
	echo
		"</tbody>
		</table>
		</div>";
	$conn->close();
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

	<form class="input-group p-3" action="worker.php" method="POST">
		<a class="btn btn-primary " href="create.php" ole="button">Добавить</a>
		<div class="dropdown">
			<button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
				Сортировка
			</button>
			<ul class="dropdown-menu">
				<li><a href="worker.php?asc"class="dropdown-item" name="asc">По возрастанию</a></li>
				<li><a href="worker.php?desc" class="dropdown-item" name="desc">По убыванию</a></li>
			</ul>
		</div>
		<input type="text" class="form-control w-25" placeholder="Номер счета" maxlength="6"
			onkeypress='validate(event)' name="bill">
		<button class="btn btn-primary" type="submit" name="btnSearch">Поиск</button>
		<a class="btn btn-primary" href="worker.php" ole="button">Сбросить</a>
		<a class="btn btn-primary" href="index.php" ole="button" name="exit">Выход</a>
	</form>
	<?php

	if(isset($_POST["bill"])) {
		$search = $_POST["bill"];
		drawTable($search, null);
	}
	else if (isset($_GET["asc"])){
		$order = "asc";
		drawTable(null, $order);
	}
	else if (isset($_GET["desc"])){
		$order = "desc";
		drawTable(null, $order);
	}
	else{
		drawTable(null, null);
	}


	?>

</body>

</html>