<!DOCTYPE html>
<html>
    <head> 
        <?php
            if(isset($_POST["submit"])) {
                $guess = $_POST["guess"];
                $num = $_POST["randnum"];
                $tries = $_POST["tries"] - 1;
                if($guess < $num) {
                    $message = "Your number is smaller than mine. You have ".$tries." tries left!";
                } 
                elseif($guess > $num) {
                    $message = "Your number is greater than mine. You have ".$tries." tries left!";
                }
                else {
                    $message = "You WON in ".(8-$tries)." tries!";
                }
            }
            else {
                $num = mt_rand(0, 100);
                $message = "Guess a number!";
                $guess = '';
                $tries = 8;
            }
        ?>
    </head>
    <body>
        <h1>Guess the number between 1 and 100</h1>
        <form method="post" action="<?php print $_SERVER["PHP_SELF"]; ?>">
            <input type="text" name="guess" value="<?php print $guess; ?>">
            <input type="submit" name="submit" value="Guess">
            <input type="hidden" name="randnum" value="<?php print $num; ?>">
            <input type="hidden" name="tries" value="<?php print $tries; ?>">
        </form>
        <h2><?php print $message; ?></h2>
    </body>
</html>