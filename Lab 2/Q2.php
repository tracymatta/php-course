<html>
    <head>
        <?php
            function verify_pass($username, $password) {
                if(strlen($password) < 6 || !is_bool(strpos($username, $password))) {
                    return false;
                }
                return true;
            }

            if(isset($_POST["submit"])) {
                if(!verify_pass(trim($_POST["username"]), trim($_POST["password"]))) {
                    $message = "Invalid password!";
                } 
                else {
                    $message = "Hello ".trim($_POST["username"]);
                }
            } 
            else {
                $message = '';
            }
        ?>
    </head>
    <body>
        <form method="post" action="<?php print $_SERVER["PHP_SELF"]; ?>">
            Username : <input type="text" name="username"> <br>
            Password : <input type="password" name="password"> <br>
            <input type="submit" name="submit" value="Send">
            <input type="reset" name="reset" value="Delete">
        </form>
        <h3> <?php print $message; ?> </h3>
    </body>
</html>