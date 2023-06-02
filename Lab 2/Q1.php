<?php 
    $age = array("woeikw@gmail.com","vcgefycewf@hotmail.com","dswfyew@ul.edu.lb",",weopeowk@ul.edu.lb","euifei@ul.edu.lb","eodkwepod@hotmail.com"); 
    for ($i=0; $i < sizeof($age); $i++) { 
        $age[$i] = substr($age[$i], strpos($age[$i], "@") + 1); 
    } 
    $res = array_count_values($age); 
    foreach ($res as $x => $y) { 
        print "$x : $y"; 
        print ($y > 1) ? " times<br>" : " time<br>";
    } 
?>