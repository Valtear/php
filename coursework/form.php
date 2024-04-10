<!DOCTYPE HTML>
<html>
  <head>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  </head>
  <body>
       <form action="index.php" method="POST">
            <div class="container">
                <div class="d-flex justify-content-center p-5">
                    <h4>Карта клиента<h4>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Имя</span>
                    <input type="text" class="form-control" aria-label="Имя пользователя" aria-describedby="basic-addon1">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Фамилия</span>
                    <input type="text" class="form-control" aria-label="Имя пользователя" aria-describedby="basic-addon1">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Отчество</span>
                    <input type="text" class="form-control" aria-label="Имя пользователя" aria-describedby="basic-addon1">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">№ счета</span>
                    <input type="text" class="form-control" paria-label="Имя пользователя" aria-describedby="basic-addon1" readonly>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Баланс</span>
                    <input type="text" class="form-control"  aria-label="Имя пользователя" aria-describedby="basic-addon1">
                </div>

                <div class="d-flex justify-content-end p-5">
                    <button class="btn btn-primary" type="submit">Сохранить</button>
                </div>
            </div>
        </form>
  </body>
</html>

