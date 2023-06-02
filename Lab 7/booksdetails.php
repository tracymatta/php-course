<?php
    include 'main.php';
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

            .renters {
                display: none;
            }

        </style>
    </head>';
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = 'SELECT full_name FROM user WHERE user.userid = ?';
        $stmt = $GLOBALS['db']->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($full_name);
        $stmt->fetch();
        print '<table><tr><td colspan="3">Books rented by '.$full_name.'</td></tr><tr><th>Title</th><th>Date</th><th>Fees</th></tr>';
        $stmt->free_result();
        $query = 'SELECT book.title, rdate, fees FROM book, rent WHERE book.bookid = rent.bookid AND rent.userid = ?';
        $stmt = $GLOBALS['db']->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($title, $date, $fees);

        while($stmt->fetch()) {
            print '<tr><td>'.$title.'</td><td>'.$date.'</td><td>'.$fees.'$</td></tr>';
        }
        $stmt->free_result();
    }
    
?>