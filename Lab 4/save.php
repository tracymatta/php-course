<?php
    print '<p>menu: <a href="view.php">view</a> <a href="upload.php">upload photo</a><br/>';
    //directory to move the uploaded image
    $file_dir = "./flowers";
    //check if any error occured
    if(isset($_POST["upload"])) {
        if($_FILES['flower']['error'] > 0) {
            print 'Problem: ';
            switch ($_FILES['flower']['error']) {
            case 1: print "File exceeded upload_max_filesize."; break;
            case 2: print "File exceeded max_file_size."; break;
            case 3: print "File only partially uplaoded."; break;
            case 4: print "No file uploaded."; break;
            case 6: print "Cannot upload file: No temp directory specified."; break;
            case 7: print "Upload failed: cannot write to disk."; break;
            case 8: print "PHP extension blocked the file upload."; break;
            }
            exit;
        }
        //Does the file have the right MIME type?
        if($_FILES['flower']['type'] != 'image/png') {
            print "Problem: file is not a PNG image.";
            exit;
        }
        //put the file where we'd like to
        if(is_uploaded_file($_FILES['flower']['tmp_name'])) {
            //move_uploaded_file(from_path, to_file_path)
            // this example: the to_file_path is the filedir/filename
            if(!move_uploaded_file($_FILES['flower']['tmp_name'], "$file_dir/".$_FILES['flower']["name"])) {
                print "Problem: Could not move file to destination directory.";
                exit;
            }
        }
        else {
            print "Problem: Possible file upload attack. Filename: ";
            print "" . $_FILES['flower']['name'];
            exit;
        }
        print "Photo uploaded!";
    }
?>
