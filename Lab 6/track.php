<?php
    if(!isset($_COOKIE["times"])) {
        setcookie("times", 0);
        print 'Welcome! You are new here.<br>';
    }
    else {
        setcookie("times", $_COOKIE["times"] += 1);
        print "Hello, this is your ".$_COOKIE["times"];
        print ($_COOKIE["times"] == 11 || $_COOKIE["times"] == 12 || $_COOKIE["times"] == 13) ? "th" : ((($_COOKIE["times"] % 10)) == 1 ? "st" : ((($_COOKIE["times"] % 10) == 2) ? "nd" : ((($_COOKIE["times"] % 10) == 3) ? "rd" : "th")));
        print " here";
    }
?>