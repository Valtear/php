<!doctype html>
<html>
	<head>
	</head>
	<body>
		<?php
			$name = $_POST["firstname"];
			$surname = $_POST["lastname"];
			$rows = $_POST["row"];
			$colls = $_POST["coll"];
			$fontSize = 12;
			$colorRand = ["red", "green", "blue"];

			for($i = 0; $i <= strlen($name) - 1; $i++){
				echo "<span style = 'font-size:" . $fontSize . "px'>" . $name[$i] . "</span>";
				$fontSize += 2;
			}
			echo "<br/>";
			for($i = 0; $i <= strlen($surname) - 1; $i++){
				echo "<span style = 'color:" . $colorRand[rand(0, 2)]."'>" . $surname[$i] . "</span>";
			}
		?>
	</body>
</html>

