<?php
session_start();

?>
<!Doctype html>
<html>

<head>
    <meta charset="utf-8" />
    <style>
        .card{
            margin-bottom: 10px;
        }
        .button{
            margin: auto;
            display: block;
            margin-bottom: 5px;
        }
        .text{
            margin: auto;
            display: block;
            border-style: solid;
            border-color: black;
            border-width: 1px;
            margin-bottom: 3px;
            max-width: 250px;
            text-align: center;
            height: 250px;
        }
        .header{
            margin: auto;
            display: block;
            border-style: solid;
            border-color: black;
            border-width: 1px;
            margin-bottom: 3px;
            max-width: 250px;
            text-align: center;
            height: 50px;
        }
        h4{
            margin: 0px;
        }
    </style>
</head>

<body>
    <?php
        if (!isset($_SESSION['card'])) {
            $_SESSION['card'] = array();    
        }
        if(isset($_POST['header'], $_POST['text'])){
            $_SESSION['card'][] = ['header' => $_POST['header'], 'text' => $_POST['text']];
        }
        foreach($_SESSION['card'] as $index){
            echo
            '<div class="card">
                <div class="header">
                    <h4>
                        <p>'. $index['header'] . '</p>
                    </h4>
                </div>
                <div class="text">
                    <p>'. $index['text'] . '</p>
                </div>
            </div>';
        }

    echo
    '<form action="form.php" method="POST">
        <input class="button "type="submit" value="+">
    </form>';
    ?>
</body>

</html>
