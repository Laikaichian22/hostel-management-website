<html>

<head>
   <title>Application Homepage</title>
   <link rel="stylesheet" href="applList1.css">
</head>

<body>
   
    <?php
        session_start();
        require_once('../config.php');
        include('Manager_homepage.html');
        $appID = $_GET['applicationid'];
        $userID = $_GET['userid'];

        echo ' <form method="POST" action="view_applicationList.php">
        <input class="back_btn" type="submit" name="returnback" value="Back"/>
        </form>';
        
        echo "<h2 style='text-align:center'>View Student's Application Information</h2>";
       
        $formData = "SELECT * from applicationForm WHERE applicationid = '$appID' AND userid = '$userID'";
        if($resultForm = mysqli_query($conn, $formData))
        {
            if(mysqli_num_rows($resultForm) == 1)
            {
                $rowData = mysqli_fetch_assoc($resultForm);
                echo '<div class="viewForm">';
                echo 'Application ID: '. $rowData['applicationid']  . '<br><br>
                User ID: ' . $rowData['userid']. '<br><br>
                Full Name: ' .$rowData['fullName'] . '<br><br>  
                Block Name: ' . $rowData['blockName']. '<br><br>
                Room Type: ' . $rowData['roomType']. '<br><br>
                Room Number: ' . $rowData['roomNo']. '<br><br>
                Verification Status: ' . $rowData['verifyStatus']. '<br><br>
                Submission Date: ' . $rowData['submitDate']. '<br><br>';

                echo "<form class='inline' method='POST' action='update_application.php'>";
                echo "<input class='approve_btn' type='submit' name='approve' value='Approve'>";
                echo '<input type="hidden" name="userID" value="' . $rowData['userid'] .'" />'; 
                echo '<input type="hidden" name="applicationID" value="' . $rowData['applicationid'] .'" />';     
                echo '<input type="hidden" name="roomNo" value="' . $rowData['roomNo'] .'" />'; 

                echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';

                echo "<input class='reject_btn' type='submit' name='reject' value='Reject'>";
                echo '<input type="hidden" name="userID" value="' . $rowData['userid'] .'" />'; 
                echo '<input type="hidden" name="applicationID" value="' . $rowData['applicationid'] .'" />';     
                echo '<input type="hidden" name="roomNo" value="' . $rowData['roomNo'] .'" />';
                echo '<br><br>';
                echo '</div>';
                echo "</form>";
            }
            else{
                echo "Error in accessing this form";
            }   
        }
        echo '';
        include("../footer.php");
    ?>

</body>
</html>