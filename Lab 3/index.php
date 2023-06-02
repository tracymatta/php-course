<html>
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
            if(isset($_POST["submit"])) {
                $file = fopen("messages.txt", "a") or die("Unable to open file!");
                fwrite($file, $_POST["message"]."\n");
                fclose($file);
            }
        ?>
    </head>
    <body>
        <img src="./profile.jpg">
        <h1>Science Dep.</h1>
        <a href="./see.php">Read Messages</a>
        <p>Make your message fruitful!</p>
        <form method="post" action="<?php print $_SERVER["PHP_SELF"]; ?>">
            <textarea name="message" rows="10" cols="100"></textarea>
            <br/>
            <input type="submit" name="submit" value="Send">
        </form>
    </body>
</html>