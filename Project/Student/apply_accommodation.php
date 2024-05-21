<html>
    <head>
        <title> Application form </title>
        <link rel="stylesheet" href="applystyle1.css">
    </head>

<body>
    <?php
        session_start();
        require_once('../config.php');
        include('Stud_homepage.html');
        $userid = $_SESSION['userid'];

        echo ' <form method="POST" action="Stud_homepage.php">
        <input class="back_btn" type="submit" name="returnback" value="Back"/>
        </form>';

        $userdata = mysqli_query($conn, "SELECT * FROM users WHERE userid = '$userid'");
        $resultUser = mysqli_fetch_array($userdata);

        echo '<h2 id="title"> Accommodation application form </h2>';
        echo '<form action="selectRoom.php" method="POST" style=text-align:center>
            <div class="form">
            User ID: <input type="text" name="userid" value="'. $resultUser['userid'] .'" disabled/><br><br>
            Full Name: <input type="text" name="fullName" value="'. $resultUser['fullName']. '" disabled/><br><br>';

        echo ' College Name: 
                <select name="college_Name" id="choice" required>
                <option value="">[Select a college]</option>
                <option value="KOLEJ HITMAN REBORN">KOLEJ HITMAN REBORN</option>
                <option value="KOLEJ FAIRY TAIL">KOLEJ FAIRY TAIL</option>
                </select> ';

        echo ' <br><br><input class="confirm_btn" type="submit" name="confirm" value="Confirm"/>
            </div>
        </form>';


        echo "<h3>College List</h3>"; 
        //table
        echo '<div class="college-list-table">';
        echo "<table class='college'>";
        echo "<tr>
                <th>No.</th>
                <th>College ID</th>
                <th>College Name</th>
                <th>Block Name</th>
                <th>Room Type</th>
                <th>Room Number</th>
                <th>Room availability</th>
        </tr>";
        
        $collegeData = "SELECT * FROM accommodation ";
        $resultCollege = mysqli_query($conn, $collegeData);
        $number = 1;

        while ($rowCollege = mysqli_fetch_assoc($resultCollege)) {
            echo "<tr> 
                    <td>" . $number . "</td>
                    <td>" . $rowCollege['collegeid'] . "</td>
                    <td>" . $rowCollege['collegeName'] . "</td>
                    <td>" . $rowCollege['blockName'] . "</td>
                    <td>" . $rowCollege['roomType'] . "</td>
                    <td>" . $rowCollege['roomNo'] . "</td>
                    <td>" . $rowCollege['available'] . "</td>
                    </tr>";
            $number++;
        }
        echo "</table>";
        echo "</div>";
        ?>

        <?php include ('../footer.php'); ?>  
</body>
</html>