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
    $row = floor($value / $_SESSION["size"]);
    $coll = floor($value % $_SESSION["size"]);
   
    $_SESSION['valueArray'][$row][$coll] = 1;
    torightChecked(1);
    toleftChecked(1);
    colsChecked(1);
    rowsChecked(1);

    do{
        $rand1 = rand(0, $_SESSION["size"]-1);
        $rand2 = rand(0, $_SESSION["size"]-1);
        if($_SESSION['valueArray'][$rand1][$rand2] != 1 &&
        $_SESSION['valueArray'][$rand1][$rand2] != 2){
            $_SESSION['valueArray'][$rand1][$rand2] = 2;
            torightChecked(2);
            toleftChecked(2);
            colsChecked(2);
            rowsChecked(2);
            break;
        }            
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
                echo "<table>";
                for($i = 0; $i < $_SESSION["size"]; $i++){
                    echo "<tr>";
                    for($j = 0; $j < $_SESSION["size"]; $j++){
                        echo "<td style = 'border: 2px solid black'>";
                        if($_SESSION['valueArray'][$i][$j] === 0){
                            echo "<input type = 'radio' name = 'myRadio' value = '" . $i * $_SESSION['size'] + $j + 1 . "'>";           
                        } 
                        if($_SESSION['valueArray'][$i][$j] === 1){
                            echo "X";
                        }
                        if($_SESSION['valueArray'][$i][$j] === 2){
                            echo "O";
                        }                        
                        if($_SESSION['valueArray'][$i][$j] === 11){
                            echo "#";
                        }   
                        if($_SESSION['valueArray'][$i][$j] === 22){
                            echo "@";
                        }         
                        echo "</td>";
                    }
                    echo "</tr>";
                }
                echo "</table>";                 
            } 
            function torightChecked($value){
                $toright = true;
                for($i = 0; $i < $_SESSION['size']; $i++){
                    $toright &= ($_SESSION['valueArray'][$i][$i] === $value);
                    if ($toright && $value === 1){
                        $_SESSION['valueArray'][$i][$i] = 11;
                    }
                    if ($toright && $value === 2){
                        $_SESSION['valueArray'][$i][$i] = 22;
                    }       
                }
            }  
            function toleftChecked($value){
                $toleft = true;
                for($i = 0; $i < $_SESSION['size']; $i++){
                    $toleft &= ($_SESSION['valueArray'][$_SESSION['size'] - $i - 1][$i] === $value);
                    if($toleft && $value === 1){
                        $_SESSION['valueArray'][$_SESSION['size'] - $i - 1][$i] = 11;
                    }
                    if($toleft && $value === 2){
                        $_SESSION['valueArray'][$_SESSION['size'] - $i - 1][$i] = 22;
                    }
                }
            } 
            function colsChecked($value){
                $cols = true;
                for($i = 0; $i < $_SESSION['size']; $i++){
                    for($j = 0; $j < $_SESSION['size']; $j++){
                        $cols &= ($_SESSION['valueArray'][$i][$j] === $value);         
                        if($cols && $value === 1){
                            $_SESSION['valueArray'][$i][$j] = 11;
                        }
                        if($cols && $value === 2){
                            $_SESSION['valueArray'][$j][$i] = 22;
                        }
                    }
                }
            } 
            function rowsChecked($value){
                $rows = true;
                for($i = 0; $i < $_SESSION['size']; $i++){
                    for($j = 0; $j < $_SESSION['size']; $j++){
                        $rows &= ($_SESSION['valueArray'][$i][$j] === $value);         
                        if($rows && $value === 1){
                            $_SESSION['valueArray'][$i][$j] = 11;
                        }
                        if($rows && $value === 2){
                            $_SESSION['valueArray'][$j][$i] = 22;
                        }
                    }
                }
            }                    
        ?>    
        <div>
            <form action = 'index.php' method='POST'>  
                <?php  
                    myTable(); 
                ?>   
                <input type="submit" value="Отправить">
            </form>
            <a href="reset.php">Сброс</a>
        </div>
    </body>
</html>
