<html>

<head>
   <title>Student's record page</title>
   <link rel="stylesheet" href="applList1.css">

</head>

<body>
    <?php
        session_start();
        require_once('../config.php');
        if($_SESSION['userlevel'] == 1)
        {
           include('../Admin/Admin_homepage.html');
           $userlevel = $_SESSION['userlevel'];
           $userid = $_SESSION['userid'];
           echo ' <form method="POST" action="../Admin/Admin_homepage.php">
           <input class="back_btn" type="submit" name="returnback" value="Back"/>
           </form>';
        }
        else if($_SESSION['userlevel'] == 3)
        {
           include('Manager_homepage.html');
           $userlevel = $_SESSION['userlevel'];
           $userid = $_SESSION['userid'];
           echo ' <form method="POST" action="Manager_homepage.php">
           <input class="back_btn" type="submit" name="returnback" value="Back"/>
           </form>';
        }

        echo "<h2 style='text-align:center'>Student's accommodation record</h2>"; 

        if($_SESSION['userlevel'] == 3)
        {
            echo '<form name="searchForm" method="POST" action="search_record.php" style=text-align:center>
            <input class="searchInput" style="height:50px padding:20px; font-size:14px;" type="text" name="userid" placeholder="Search" required/>
            <input class="search-btn" style="size:smaller; font-size:14px;" type="submit" value="Search"/>
            <br><br>';
        }
    
        $applicationData = "SELECT * FROM applicationForm WHERE verifyStatus='Approve'";
        $resultForm = mysqli_query($conn, $applicationData);
        $number = 1;
    
        if(mysqli_num_rows($resultForm) > 0)
        {
            $rowRecord = mysqli_fetch_assoc($resultForm);
            echo '<div class="record_table">';
            echo "<table class='record'>";
            echo "<tr>
                    <th>No.</th>
                    <th>User ID</th>
                    <th>Full Name</th>
                    <th>College Name</th>
                    <th>Block Name</th>
                    <th>Room Type</th>
                    <th>Room Number</th>
                    <th>Application Date</th>
                    </tr>";
            echo "<tr> 
                    <td>" . $number . "</td>
                    <td>" . $rowRecord['userid'] . "</td>
                    <td>" . $rowRecord['fullName'] . "</td>
                    <td>" . $rowRecord['collegeName'] . "</td>
                    <td>" . $rowRecord['blockName'] . "</td>
                    <td>" . $rowRecord['roomType'] . "</td>
                    <td>" . $rowRecord['roomNo'] . "</td>
                    <td>" . $rowRecord['submitDate'] . "</td>
                </tr>";
            echo "</table>";
            echo "</div>";
            $number++;
        }
        else{
            //when there is no record yet
            echo '<p id="record"> No record in this list</p>';
        }
        
        
        include("../footer.php");
    ?>


</body>

</html>