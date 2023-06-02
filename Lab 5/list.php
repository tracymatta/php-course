<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        body {
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
    </style>
</head>
<body>
    <a href="./cart.php">See the shopping cart</a>
    <table>
        <tr>
            <th style="width: 200px;"> Product </th>
            <th style="width: 60px;"> Price </th>
            <th style="width: 100px;"> Type </th>
        </tr>
            <?php
                $files = array_diff(scandir("./products"), array('.', '..'));
                foreach($files as $x) {
                    if(is_dir("./products/".$x)) {
                        $prod = array_diff(scandir("./products/".$x), array('.', '..'));
                        foreach($prod as $y) {
                            $hashpos = strpos($y, '@');
                            $point = strrpos($y, '.');
                            $name =  str_replace('-', ' ', substr($y, 0, $hashpos));
                            $price = substr($y, $hashpos + 1, $point - $hashpos - 1);
                            $link = "'view.php?name=".urlencode($name)."&src=./products/".$x."/".str_replace('@', '%40', $y)."'";
                            print "<tr><td><a href=".$link.">".$name."</a></td><td>".$price."</td><td>".$x."</td></tr>";
                        }
                    }
                }
            ?>
    </table>
    <a href="./cart.php?destroy=true" style="font-size: 18px;">Empty the shopping cart</a>
</body>
</html>