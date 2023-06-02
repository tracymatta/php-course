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
    </style>
    <?php
        $messages = '';

        function verify_pass($username, $password) {
            if(strlen($password) < 6 || !is_bool(strpos($username, $password))) {
                return false;
            }
            return true;
        }

        if(isset($_POST["read"])) {
            if(!verify_pass(trim($_POST["username"]), trim($_POST["password"]))) {
                header("Location: ./index.php");
                exit;
            } 
            else {
                $file = fopen("messages.txt", "r");
                while(!feof($file)) {
                    $messages .=fgets($file)."<br>";
                }
                fclose($file);
            }
        } 
    ?>
</head>
<body>
    <img src="./profile.jpg">
    <h1>Science Dep.</h1>
    <a href="./index.php">Send a Message</a>
    <p>Make your message fruitful!</p>
    <form method="post" action="<?php print $_SERVER["PHP_SELF"]; ?>">
        <span> Username: <input type="text" name="username"> </span>
        <br>
        <span> Password: <input type="password" name="password"> </span>
        <br>
        <input type="submit" name="read" value="Read">
    </form>
    <p> <?php print $messages?> </p>
</body>
</html>