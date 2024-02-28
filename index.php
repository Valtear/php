<!Doctype html>
<html>
    <head>       
    </head>
    <body>
        <div>
            <?php
                session_start();
                $id = 0;

                echo "<table>";
                for($i = 0; $i < 3; $i++){
                    echo "<tr>";
                    for($j = 0; $j < 3; $j++){
                        echo "<td style = 'border: 2px solid black'>"
                        //$_SESSION['radioArray'][] = "<input type = 'radio' id = '" . $id++ . "'>";
                        $radioArray[] = "<input type = 'radio' id = '" . $id++ . "'>";
                        "</td>";
                    }
                    echo "</tr>";
                }
                echo "</table>";  
                         
            ?>
        </div>       
        <div>
            <form action = '' method='POST'>  
                <input type="submit" value="Отправить">
            </form>
            <?php
                //echo $_SESSION['radioArray'][1];
                echo $radioArray[1];
            ?>
        </div>
    </body>
</html>