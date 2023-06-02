<?php session_start() ?>
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
    </style>
</head>
<body>
    <a href="./list.php">List of products</a>
    <a href="./cart.php">See the shopping cart</a>
    <?php
        $name = $src = $price = $link = ''; 
        if(isset($_GET["name"]) && isset($_GET["src"])) {
            $name = $_GET["name"];
            $src = $_GET["src"];
            $hashpos = strpos($src, '@');
            $point = strrpos($src, '.');
            $price = substr($src, $hashpos + 1, $point - $hashpos - 1)."$";
            $link = str_replace('%40', '@', $src);
        }

        $explodedString = explode('/', $link);
        if(isset($_POST["submit"])) {
            if(empty($_SESSION[str_replace(' ', '-', $name)])) {
                $_SESSION[str_replace(' ', '-', $name)] = Array("price" => substr($price, 0, strlen($price) - 1), "cat" => $explodedString[2], "quantity" => $_POST["quantity"]);
            }
            else {
                $p = $_SESSION[str_replace(' ', '-', $name)];
                $p["quantity"] = $_POST["quantity"];
                $_SESSION[str_replace(' ', '-', $name)] = $p;
            }
            print "<h2> Product added to shopping cart. </h2>";
        }
    ?>
    <h1><?php print $name ?></h1>
    <h2><?php print $price ?></h2>
    <img src=<?php print $link ?>>
    <form method="post" action="view.php?name=<?php print urlencode($_GET["name"]) ?>&src=<?php print $_GET["src"] ?>">
        <span>  
            <input type="text" name="quantity">
            <input type="submit" name="submit">
        </span>
    </form>
</body>
</html>