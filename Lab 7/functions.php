<?php
    function connect() {
        @$GLOBALS['db'] = new mysqli('localhost', 'admin', 'mylib', 'library');
        if (mysqli_connect_errno()) {
            echo '<p>Error: Could not connect to database.<br/>Please try again later.</p>';
            return false;
        }

        $GLOBALS['db']->select_db('library');

        return true;
    }

    function listUsers() {
        print '<html>
        <head>
            <style>
                body {
                    display: flex;
                    flex-direction: column; 
                    justify-content: center; 
                    align-items: center;
                }

                table, th, td {
                    border: 1px solid black;
                }

                table {
                    width: 50%;
                }
            </style>
        </head>';
        print '<table class="renters"><tr><th>User ID</th><th>Username</th><th>Full Name</th><th>Total</th></tr>';
        $query = 'SELECT user.userid, username, full_name, sum(fees) as total FROM user, rent WHERE user.userid = rent.userid GROUP BY userid';
        $stmt = $GLOBALS['db']->prepare($query);
        $stmt->execute();
        $stmt->store_result();
        $id = $username = $full_name = $total = 0;
        $stmt->bind_result($id, $username, $full_name, $total);
        while($stmt->fetch())
        {
            print '<tr><td>'.$id.'</td><td>'.$username.'</td><td><a href=booksdetails.php?id='.$id.'>'.$full_name.'</a></td><td>'.$total.'$</td></tr>';
        }
        $stmt->free_result();
        print '</table>';
        //$GLOBALS['db']->close();
    }

    function fillSession() {
        $user = array(1 => array('asalim', 'Ahmad Salim'), 2 => array('skamal', 'Sarah Kamal'), 3 => array('ieldor', 'Issa Eldor'));
        $book = array(1 => 'Intro Computer', 2 => 'World Wide Web-Design', 3 => 'Visual Programming 1', 4 => 'Computer Organization');
        $rent = array(1 => array(array('1', '2019-04-15', '5.5'), array('1', '2019-07-15', '6'), array('2', '2019-05-12', '4')), 2 => array(array('1', '2019-05-12', '4.5'), array('3', '2019-04-20', '3.2')));
        $_SESSION["user"] = $user;
        $_SESSION["book"] = $book;
        $_SESSION["rent"] = $rent;
    }

    function listUsersSession() {
        print '<html>
        <head>
            <style>
                body {
                    display: flex;
                    flex-direction: column; 
                    justify-content: center; 
                    align-items: center;
                }

                table, th, td {
                    border: 1px solid black;
                }

                table {
                    width: 50%;
                }
            </style>
        </head>';
        print '<table><tr><th>User ID</th><th>Username</th><th>Full Name</th><th>Total</th></tr>';
        $rent = $_SESSION['rent'];
        $user = $_SESSION['user'];
        $book = $_SESSION['book'];

        foreach($rent as $userid => $booksRented) {
            $total = 0;
            for($i = 0; $i < sizeof($booksRented); $i += 1) {
                $total += (double) $booksRented[$i][2];
            }
            print '<tr><td>'.$userid.'</td><td>'.$user[$userid][0].'</td><td><a href=booksdetails.php?id='.$userid.'>'.$user[$userid][0].'</a></td><td>'.$total.'$</td></tr>';
        }
        print '</table>';
    }
?>
