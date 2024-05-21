<!DOCTYPE html>
<html>

<head>
	<title>Search Record</title>
    <link rel="stylesheet" href="applList1.css">
</head>

<body>
<?php
require_once('../config.php');

echo ' <form method="POST" action="Manager_homepage.php">
<input class="back_btn" type="submit" name="returnback" value="Back"/>
</form>';
   
if(isset($_POST['userid'])){
   
    $userid = $_POST['userid'];
    $applicationData = "SELECT * FROM applicationForm WHERE userid='$userid' && verifyStatus='Approve'";

    if($resultdata = mysqli_query($conn, $applicationData))
    {
        if (mysqli_num_rows($resultdata) == 1) { 
            $row=mysqli_fetch_array($resultdata);

            echo '<h2 style="text-align:center">Student record</h2>';
            
            echo '<div class="userrecord_table">
            <span class="record">User ID: </span>'. $row['userid'].'<br><br>
            <span class="record">Full Name: </span>'. $row['fullName'].'<br><br>
            <span class="record">College Name: </span>'. $row['collegeName'].'<br><br>
            <span class="record">Block Name: </span>'. $row['blockName'].'<br><br>
            <span class="record">Room Type: </span>'. $row['roomType'].'<br><br>
            <span class="record">Room Number: </span>'. $row['roomNo'].'<br><br>
            <span class="record">Submitted Date: </span>'. $row['submitDate'].'<br><br>';
            echo '</div>';
        }
   }
}


mysqli_close($conn);
include ('../footer.php');

?>

</body>
</html>