<?php
    function loadClients() {
        $clients = file("./clients.txt");
        $sessionArray = array();
        foreach($clients as $client) {
            $details = explode(';', $client);
            $sessionArray[$details[0]] = array("fname" => $details[1], "lname" => $details[2], "accnb" => $details[3], "balance" => $details[4]);
        }
        return $sessionArray;
    }

    function saveClients($clients) {
        $file = fopen("./clients.txt", "w");
        foreach($clients as $user => $details) {
            fwrite($file, $user.";".$details["fname"].";".$details["lname"].";".$details["accnb"].";".$details["balance"]."\n");
        }
        fclose($file);
    }

?>