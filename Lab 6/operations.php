<?php
    session_start();
    require("functions.php");
    
    if(!isset($_SESSION["clients"])) {
        $_SESSION["clients"] = loadClients();
    }

    function debit($user, $amount) {
        $client = $_SESSION["clients"][$user];
        if($client["balance"] < (int)$amount) {
            print 'Not enough funds available\n';
            exit;
        }
        $client["balance"] -= (int)$amount;
        $_SESSION["clients"][$user] = $client;
    }

    function credit($user, $amount) {
        $client = $_SESSION["clients"][$user];
        $client["balance"] += (int)$amount;
        $_SESSION["clients"][$user] = $client;
        print "User ".$user." was credited ".(int)$amount;
    }

    function transfer($user, $amount, $accnb) {
        $client = $_SESSION["clients"][$user];
        if($client["balance"] < (int)$amount) {
            print 'Not enough funds available\n';
            exit;
        }
        $client["balance"] -= (int)$amount;
        $_SESSION["clients"][$user] = $client;
        foreach($_SESSION["clients"] as $x => $y) {
            if($y["accnb"] == (int)$accnb) $dest =$x;
        }
        $_SESSION["clients"][$dest]["balance"] += (int)$amount;
        print "User ".$user." transferred ".(int)$amount." dollars to ".$dest;
    }

    if(isset($_GET["destroy"])) {
        saveClients($_SESSION["clients"]);
        session_destroy();
    }

    if(isset($_POST["debit"])) {
        debit($_POST["user"], $_POST["amount"]);
    }

    if(isset($_POST["credit"])) {
        credit($_POST["user"], $_POST["amount"]);
    }

    if(isset($_POST["transfer"])) {
        transfer($_POST["user"], $_POST["amount"], $_POST["accnb"]);
    }

    if(isset($_POST["add"])) {
        $_SESSION["clients"][$_POST["nuser"]] = array("fname" => $_POST["nfname"], "lname" => $_POST["nlname"], "accnb" => $_POST["naccnb"], "balance" => $_POST["nbalance"]);
    }

    print '<table>';
    print '<tr><th>User</th>
               <th>First name</th>
               <th>Last name</th>
               <th>Account number</th>
               <th>Balance</th>
               <th>Operation</th>
               <th>Amount</th>
            </tr>';
    foreach($_SESSION["clients"] as $x => $y) {
        print "<tr><td>".$x."</td><td>".$y["fname"]."</td><td>".$y["lname"]."</td><td>".$y["accnb"]."</td><td>".$y["balance"]."</td>";
        print "<td><form method='post' action='".$_SERVER["PHP_SELF"]."'>";
        print "<input type='hidden' name='user' value='".$x."'>";
        print "<input type='submit' name='debit' value='Debit'>";
        print "<input type='submit' name='credit' value='Credit'>";
        print "<input type='submit' name='transfer' value='Transfer'>";
        print "<select name='accnb'>";
            foreach($_SESSION["clients"] as $z => $w) {
                if($w["accnb"] == $y["accnb"]) continue;
                print "<option value='".$w["accnb"]."'>".$w["accnb"]."</option>";
            }
        print "</select></td>";
        print "<td><input type='text' name='amount'></td>";
        print "</form></tr>";

    }
    print "<form method='post' action='".$_SERVER["PHP_SELF"]."'>
           <td><input type='text' name='nuser'></td>
           <td><input type='text' name='nfname'></td>
           <td><input type='text' name='nlname'></td>
           <td><input type='text' name='naccnb'></td>
           <td><input type='text' name='nbalance'></td>
           <td><input type='submit' name='add' value='Add Client'> - <a href='./operations.php?destroy=true'>Exit</a></td>
           </form>";
    print "</table>";
?>