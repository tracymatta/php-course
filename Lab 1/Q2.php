<?php
    print '<body style="display: flex; flex-direction: column; justify-content: center; align-items: center;">';     
    print '<table style="font-size: 20px; border: 3px solid; border-collapse: collapse; position: absolute; margin: auto;">';
    for($i = 1; $i < 10; $i++) {
        print '<tr style="border: 2px solid; border-collapse: collapse;">';
        for($j = 1; $j < 10; $j++) {
            print '<td style="border: 2px solid; border-collapse: collapse; padding: 25px;">'.$i*$j."</td>";
        }
        print "</tr>";
    }
    print "</table> </body>";
?>