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
   
    $_SESSION['valueArray'][floor($row)][floor($coll)] = 1;
    
    do{
        $rand1 = rand(0, $_SESSION["size"]-1);
        $rand2 = rand(0, $_SESSION["size"]-1);
        if($_SESSION['valueArray'][$rand1][$rand2] != 1 &&
        $_SESSION['valueArray'][$rand1][$rand2] != 2){
            $_SESSION['valueArray'][$rand1][$rand2] = 2;
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
                        if($_SESSION['valueArray'][$i][$j] === 1){
                            echo "X";
                        }
                        if($_SESSION['valueArray'][$i][$j] === 2){
                            echo "O";
                        }
                        if($_SESSION['valueArray'][$i][$j] === 0){
                            echo "<input type = 'radio' name = 'myRadio' value = '" . $i * $_SESSION['size'] + $j + 1 . "'>";                         
                        }                 
                        echo "</td>";
                    }
                    echo "</tr>";
                }
                echo "</table>";  
                $toright = true;
                for($i = 0; $i < $_SESSION['size']; $i++){
                    $toright &= ($_SESSION['valueArray'][$i][$i] === 1);
                }
                if ($toright){
                    
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
            <a href="reset.php">сброс</a>
        </div>
    </body>
</html>
