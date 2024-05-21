<html>

<head>
   <title>Application Homepage</title>
   <link rel="stylesheet" href="collegeList1.css">
</head>

<body>
    
    <?php
    session_start();
    require_once('../config.php');
    include('Manager_homepage.html');
    echo ' <form method="POST" action="Manager_homepage.php">
    <input class="back_btn" type="submit" name="returnback" value="Back"/>
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

    include("../footer.php");
    ?>
</body>

</html>