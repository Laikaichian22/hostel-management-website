<html>

<head>
   <title>Application Homepage</title>
   <link rel="stylesheet" href="applList1.css">
</head>

<body>

    <?php
    session_start();
    require_once('../config.php');

    if($_SESSION['userlevel'] == 1)
    {
        include('../Admin/Admin_homepage.html');
        $userid = $_SESSION['userid'];
        echo ' <form method="POST" action="../Admin/Admin_homepage.php">
        <input class="back_btn" type="submit" name="returnback" value="Back"/>
        </form>';
    }
    else if($_SESSION['userlevel'] == 3)
    {
        include('Manager_homepage.html');
        $userid = $_SESSION['userid'];
        echo ' <form method="POST" action="Manager_homepage.php">
        <input class="back_btn" type="submit" name="returnback" value="Back"/>
        </form>';
    }

    echo "<h2 style='text-align:center'>Students' Approved Application List</h2>"; 

    $array = array();
    
        $formData = "SELECT * FROM applicationForm WHERE verifyStatus='Approve' OR verifyStatus='Reject'";
    

    $resultForm = mysqli_query($conn, $formData);
    $rowData = 0;
    $number = 0;
        while ($rowData = mysqli_fetch_array($resultForm) ) 
        {
            if($number == 0)
            {
                echo '<div class="report_table">';
                echo "<table class='report'>";
                echo "<tr>
                    <th>Application ID</th>
                    <th>Applicant ID</th>
                    <th>Applicant Name</th>
                    <th>Block Name</th>
                    <th>Room Type</th>
                    <th>Room Number</th>
                    <th>Application Date</th>
                    <th>Status</th>
                </tr>";
            }
            
            $array['appID'] = $rowData['applicationid'];
            $array['userID'] = $rowData['userid'];
            $array['fName'] = $rowData['fullName'];
            $array['blockN'] = $rowData['blockName'];
            $array['roomT'] = $rowData['roomType'];
            $array['roomN'] = $rowData['roomNo'];
            $array['status'] = $rowData['verifyStatus']; 
            $array['date'] = $rowData['submitDate'];
        
            echo "<tr> 
                <td>" . $array['appID'] . "</td>
                <td>" . $array['userID'] . "</td>
                <td>" . $array['fName'] . "</td>
                <td>" . $array['blockN'] . "</td>
                <td>" . $array['roomT'] . "</td>
                <td>" . $array['roomN'] . "</td>
                <td>" . $array['date'] . "</td>";
            if($array['status']=='Approve')
            {                    
                echo "<td class='approve'>" . $array['status'] . "</td>";
            }
            else if($array['status']=='Reject'){
                echo "<td class='reject'>" . $array['status'] . "</td>";
            }
            echo "</tr>";
            $number++;
        }
        echo "</table>";
        echo "</div>";

        echo "<div class='toSort'>
        To view sorted report(by application date), click the button below
        
        <form method='POST' action='view_sorted_report.php'>
        <input class='view_btn' type='submit' name='view' value='Sort'/ >
        </form>
        </div>";
        
        if($number == 0){
            echo "<p>No application in this list</p>";
        }
    
    include("../footer.php");
    ?>


</body>

</html>