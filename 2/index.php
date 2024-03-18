<?php
session_start();
$_SESSION["size"] = 3;
if (!isset($_SESSION["valueArray"])) {
    for ($i = 0; $i < $_SESSION["size"]; $i++) {
        for ($j = 0; $j < $_SESSION["size"]; $j++) {
            $_SESSION["valueArray"][$i][$j] = 0;
        }
    }
}
function process()
{
    if (!empty($_POST['myRadio'])) {
        $value = $_POST['myRadio'] - 1;
        $row = floor($value / $_SESSION["size"]);
        $coll = floor($value % $_SESSION["size"]);

        $_SESSION['valueArray'][$row][$coll] = 1;
        if (torightChecked(1) || toleftChecked(1) || colsChecked(1) || rowsChecked(1)) {
            return;
        }
        do {
            $rand1 = rand(0, $_SESSION["size"] - 1);
            $rand2 = rand(0, $_SESSION["size"] - 1);
            if (
                $_SESSION['valueArray'][$rand1][$rand2] != 1 &&
                $_SESSION['valueArray'][$rand1][$rand2] != 2
            ) {
                $_SESSION['valueArray'][$rand1][$rand2] = 2;
                if (torightChecked(2) || toleftChecked(2) || colsChecked(2) || rowsChecked(2)) {
                    return;
                }
                break;
            }
        } while (true);
    }
}
process();
?>
<!Doctype html>
<html>

<head>
</head>

<body>
    <?php
    function myTable()
    {
        echo "<table>";
        for ($i = 0; $i < $_SESSION["size"]; $i++) {
            echo "<tr>";
            for ($j = 0; $j < $_SESSION["size"]; $j++) {
                echo "<td style = 'border: 2px solid black'>";
                if ($_SESSION['valueArray'][$i][$j] === 0) {
                    echo "<input type = 'radio' name = 'myRadio' value = '" . $i * $_SESSION['size'] + $j + 1 . "'>";
                }
                if ($_SESSION['valueArray'][$i][$j] === 1) {
                    echo "X";
                }
                if ($_SESSION['valueArray'][$i][$j] === 2) {
                    echo "O";
                }
                if ($_SESSION['valueArray'][$i][$j] === 11) {
                    echo "#";
                }
                if ($_SESSION['valueArray'][$i][$j] === 22) {
                    echo "@";
                }
                echo "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }
    function torightChecked($value)
    {
        $toright = true;
        for ($i = 0; $i < $_SESSION['size']; $i++) {
            $toright = $toright && ($_SESSION['valueArray'][$i][$i] === $value);
        }
        if ($toright) {
            for ($i = 0; $i < $_SESSION['size']; $i++) {
                $_SESSION['valueArray'][$i][$i] = ($value === 1) ? 11 : 22;
            }
        }
        return $toright;
    }
    function toleftChecked($value)
    {
        $toleft = true;
        for ($i = 0; $i < $_SESSION['size']; $i++) {
            $toleft = $toleft && ($_SESSION['valueArray'][$_SESSION['size'] - $i - 1][$i] === $value);
        }
        if ($toleft) {
            for ($i = 0; $i < $_SESSION['size']; $i++) {
                $_SESSION['valueArray'][$_SESSION['size'] - $i - 1][$i] = ($value === 1) ? 11 : 22;
            }
        }
        return $toleft;
    }
    function colsChecked($value)
    {
        $cols = true;
        for ($i = 0; $i < $_SESSION['size']; $i++) {
            for ($j = 0; $j < $_SESSION['size']; $j++) {
                $cols = $cols && ($_SESSION['valueArray'][$i][$j] === $value);
            }
            if ($cols) {
                for ($j = 0; $j < $_SESSION['size']; $j++) {
                    $_SESSION['valueArray'][$i][$j] = ($value === 1) ? 11 : 22;
                }
                return true;
            } else {
                $cols = true;
            }
        }
    }
    function rowsChecked($value)
    {
        $rows = true;
        for ($i = 0; $i < $_SESSION['size']; $i++) {
            for ($j = 0; $j < $_SESSION['size']; $j++) {
                $rows = $rows && ($_SESSION['valueArray'][$j][$i] === $value);               
            }
            if ($rows) {
                for ($j = 0; $j < $_SESSION['size']; $j++) {
                    $_SESSION['valueArray'][$j][$i] = ($value === 1) ? 11 : 22;
                }
                return true;
            } else {
                $rows = true;
            }
        }
    }
    ?>
    <div>
        <form action='index.php' method='POST'>
            <?php
            myTable();
            ?>
            <input type="submit" value="Отправить">
        </form>
        <a href="reset.php">Сброс</a>
    </div>
</body>

</html>
