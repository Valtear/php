<!Doctype html>
<html>

<head>
    <meta charset="utf-8" />
    <style>
        .style{
            display: block;
            margin: auto;
            border-style: solid;
            text-align: center;
            max-width: 350px;
        }
    </style>
</head>

<body>
    <div>
        <form action="index.php" method="POST">
            <div class="style">
                <p>Заголовок: <input type=text name="header"></p>
                <p>Текст: <input type=text name="text"></p>

                <p><input type="submit" value="Сохранить"></p>
            </div>
        </form>
    </div>
</body>

</html>
