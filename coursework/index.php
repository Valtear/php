<?php
session_start();
session_destroy();

?>
<!DOCTYPE HTML>
<html>
<head>
	<title>Банк-клиент</title>
	<meta charset="utf-8">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
	<div class="d-flex justify-content-center p-3">
		<h1 class="display-1">Какой-то банк</h1>
	</div>
	<div class="btn-group position-absolute top-50 start-50 translate-middle">		
		<a href="login.php" class="btn btn-primary fs-4">Войти</a>
		<a href="reg.php" class="btn btn-primary fs-4" name="reg">Зарегестрироваться</a>
	</div>
</body>
</html>	