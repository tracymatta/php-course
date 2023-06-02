<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        $dirName = "./flowers";
        $imageNames = array_diff(scandir($dirName), array('.', '..'));
        $file = fopen("photos.txt", "w");
        foreach($imageNames as $x) {
            fwrite($file, $x."\n");
        }
        fclose($file);
        $images = file("photos.txt");
        $count = count($images);
        if(isset($_GET["index"])) {
            $now = (int) $_GET["index"];
            $next = ($now + 1) % $count;
            $prev =  ($now - 1 + $count) % $count;
        }
        else {
            $now = 0;
            $prev = $count - 1;
            $next = 1;
        }
    ?>
</head>
<body>
    <p>menu: <a href="view.php">view</a> <a href="upload.php">upload photo</a> <br/>
    <a href="view.php?index=<?php print $prev ?>">prev</a>
    <img src=<?php print $dirName."/".$images[$now] ?> style="width: 50px; height: 50px;">
    <a href="view.php?index=<?php print $next ?>">next</a>
</body>
</html>
