<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        body, form {
            display: flex;
            flex-direction: column; 
            justify-content: center; 
            align-items: center;
        }
        table, tr, th, td {
            border: 1px solid;
        }
        table {
            margin-top: 20px;
            margin-bottom: 20px;
            width: 50%;
        }

        <?php
            if(isset($_GET["destroy"])) {
                session_destroy();
            }

            if(isset($_POST["update"])) {
                foreach($_POST as $x => $y) {
                    if($x == "update") continue;
                    $p = $_SESSION[$x];
                    $p["quantity"] = $y;
                    $_SESSION[$x] = $p;
                }
            }
        ?>
    </style>
</head>
<body>
    <a href="./list.php">List of products</a>
        <table>
        <form method="post" action="./cart.php">
            <tr>
                <th style="width: 35%;"> Product </th>
                <th style="width: 10%;"> Price </th>
                <th style="width: 35%;"> Quantity </th>
                <th style="width: 10%;"> Total Price </th>
                <th style="width: 10%;"> Category </th>
            </tr>
                <?php
                    $total = 0; 
                    foreach($_SESSION as $name => $details) {
                        $totalPrice = $details["price"]*$details["quantity"];
                        $total += $totalPrice;
                        print "<tr><td>".$name."</td><td>".$details["price"]."$</td><td><input type='text' name=".$name." value=".$details["quantity"]."></td><td>".$totalPrice."$</td><td>".$details["cat"]."</td></tr>";
                    }
                ?>
        </table>
        <input type='submit' name='update' value='Update'>
    </form>
    <h2> The total price is: <?php print $total."$"; ?> </h2>
</body>
</html>