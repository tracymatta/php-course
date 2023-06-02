<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        $dollar = '';
        $ll = '';
        if(isset($_POST["submit"])) {
            if($_POST["submit"] == "To LL") {
                $dollar = $_POST["dollar"];
                $ll = $dollar * 42000;
            }
            else {
                $ll = $_POST["LL"];
                $dollar = $ll/42000;
            }
        }
    ?>
</head>
<body>
    <form method="post" action="<?php print $_SERVER["PHP_SELF"]; ?>">
    Dollar: <input type="text" name="dollar" value="<?php print $dollar?>">
    <input type="submit" name="submit" value="To LL">
    <br/>
    LL: <input type="text" name="LL" value="<?php print $ll ?>">
    <input type="submit" name="submit" value="To Dollar">
    <br/>
    </form>
</body>
</html>