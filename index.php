<?php
session_start();
if(!isset($_SESSION["valueArray"])){
    for ($i = 0;$i<9;$i++){
        $_SESSION["valueArray"][$i] = 0;
    }
}
if(!empty($_POST['myRadio'])){
    $value = $_POST['myRadio'] - 1;
    $_SESSION['valueArray'][$value] = 1;

    do{
        if($_SESSION['valueArray'][$rand = rand(0,9)] != 1){
            $_SESSION['valueArray'][$rand] = 2;
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
                echo "<table>";
                for($i = 0; $i < 3; $i++){
                    echo "<tr>";
                    for($j = 0; $j < 3; $j++){
                        echo "<td style = 'border: 2px solid black'>";
                        if($_SESSION['valueArray'][($i*3)+$j] === 1){
                            echo "X";
                        }
                        elseif($_SESSION['valueArray'][($i*3)+$j] === 2){
                            echo "O";
                        }
                        else{
                            echo "<input type = 'radio' name = 'myRadio' value = '" . (($i*3)+$j) + 1 . "'>";
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
