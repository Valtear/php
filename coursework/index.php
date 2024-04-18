<?php
	require_once('connection.php');
	function drawTable($search){
		$conn = connection();
		echo						
	  "<div class='p-3'>
		<table class='table table-hover'>
		  <thead>
			<tr>
			  <th scope='col'>#</th>
			  <th scope='col'>Имя</th>
			  <th scope='col'>Фамилия</th>
			  <th scope='col'>Отчество</th>
			  <th scope='col'>№ счета</th>
			  <th scope='col'>Баланс</th>
			  <th scope='col'>Удаление</th>
			</tr>
		  </thead>
		  <tbody>";
		  if($search == "") $sql = "SELECT * FROM clients";
		  else $sql = "SELECT * FROM clients WHERE bill LIKE $search";
			$i = 0;
			if($result = $conn->query($sql)){
				foreach($result as $row){			 
					$id = $row["id"];
					$name = $row["name"];
					$surname = $row["surname"];
					$fatherName = $row["father_name"];
					$bill = $row["bill"];
					$balance = $row["balance"];
					echo 
					"<tr>
						<th scope='row'>". ++$i ."</th>
						<td> $name </td>
						<td> $surname </td>
						<td> $fatherName </td>
						<td> $bill </td>
						<td> $balance </td>
						<td>
							<a class='btn btn-primary' href='index.php' ole='button'>Удалить</a>
						</td>
					</tr>";
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
  <meta charset="utf-8">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
	  if( !regex.test(key) ) {
		theEvent.returnValue = false;
		if(theEvent.preventDefault) theEvent.preventDefault();
	  }
	}
	</script>
</head>

<body>

  <form class="input-group p-3" action="index.php" method="POST">
    <a class="btn btn-primary " href="form.php" ole="button">Добавить</a>
    <input type="text" class="form-control w-25" placeholder="Номер счета" maxlength="6" onkeypress='validate(event)' name="bill">
    <button class="btn btn-primary" type="submit" name="btnSearch">Поиск</button>
  </form>
	<?php

	if(isset($_POST["bill"])){
			$search = $_POST["bill"];
			drawTable($search);
	}
	else{
		$search = "";
		drawTable($search);
	}
	?>


  <div class="position-relative p-3">
    <div class="d-flex justify-content-end">
      <a class="btn btn-primary" href="index.php" ole="button">Сбросить</a>
    </div>
  </div>


</body>

</html>
