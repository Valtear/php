<?php
session_start();
$_SESSION["size"] = 3;
if(!isset($_SESSION["valueArray"])){
    for ($i = 0; $i < $_SESSION["size"]; $i++){
        for ($j = 0; $j < $_SESSION["size"]; $j++){
            $_SESSION["valueArray"][$i][$j] = 0;
        }        
    }
}
if(!empty($_POST['myRadio'])){
    $value = $_POST['myRadio'] - 1;
    $row = $value / $_SESSION["size"];
    $coll = $value % $_SESSION["size"];
   
    $_SESSION['valueArray'][intval($row, 10)][$coll] = 1;


    do{
        if($_SESSION['valueArray'][$rand1 = rand(0, $_SESSION["size"]-1)][$rand2 = rand(0, $_SESSION["size"]-1)] != 1){
            echo $rand1;
            echo $rand2;
            $_SESSION['valueArray'][$rand1][$rand2] = 2;
        }
        break;
    }
    while(true);
}
?>
<!Doctype html>
<html>
    <head>       
    </head>
    <body>
        <?php           
            function myTable(){
                $index = 0;
                echo "<table>";
                for($i = 0; $i < $_SESSION["size"]; $i++){
                    echo "<tr>";
                    for($j = 0; $j < $_SESSION["size"]; $j++){
                        echo "<td style = 'border: 2px solid black'>";
                        if($_SESSION['valueArray'][$i][$j] === 1){
                            echo "X";
                        }
                        elseif($_SESSION['valueArray'][$i][$j] === 2){
                            echo "O";
                        }
                        else{
                            echo "<input type = 'radio' name = 'myRadio' value = '" . $index + 1 . "'>";
                            $index++;
                        }                       
                        echo "</td>";
                    }
                    echo "</tr>";
                }
                echo "</table>";  
            }                            
        ?>    
        <div>
            <form action = 'index.php' method='POST'>  
                <?php  
                    myTable(); 
                ?>   
                <input type="submit" value="Отправить">
            </form>
            <a href="reset.php">сброс</a>
        </div>
    </body>
</html>
