<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
    <p>menu: <a href="view.php">view</a> <a href="upload.php">upload photo</a>
    <form method="post" action="save.php" enctype="multipart/form-data">
        <input type="file" name="flower" id="flower" value="Choose a photo">
        <input type="submit" name="upload" value="Upload">
    </form>
</body>
</html>