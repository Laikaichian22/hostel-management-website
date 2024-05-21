<html>
<head>
    <title> Update application </title>
    <link rel="stylesheet" href="applList1.css">
</head>

<body>
<?php
    session_start();
    require_once('../config.php');
    include("Manager_homepage.html");
    $userid = $_POST['userID'];
    $applicationid = $_POST['applicationID'];
    $roomNo = $_POST['roomNo'];

    echo ' <form method="GET" action="view_applicationList.php">
    <input class="back_btn" type="submit" name="returnback" value="Back"/>
    <input type="hidden" name="userid" value="' . $userid .'" />
    </form>';

    echo "<h2 style='text-align:center'>Application updated</h2>"; 
    if(isset($_POST['approve']))
    {
        $status = "Approve";
        $available = "Occupied";
    
        $collegeData = "SELECT * FROM accommodation WHERE roomNo='$roomNo'";
        $findCollege = mysqli_query($conn, $collegeData);
        $rowCollege = mysqli_fetch_assoc($findCollege);
        $resultNo = $rowCollege['roomNo'];
    
        $formData= "SELECT * FROM applicationForm WHERE userid='$userid'";
        $sql = mysqli_query($conn, $formData);
        $row = mysqli_fetch_assoc($sql);
        $resultID = $row['userid'];
        
        if($resultID == $userid && $resultNo == $roomNo)
        {
            $updateForm = "UPDATE applicationForm SET verifyStatus='$status' WHERE applicationid='$applicationid' ";
            $updateCollege = "UPDATE accommodation SET available='$available' WHERE roomNo='$roomNo' ";
            $sql2 = mysqli_query($conn, $updateForm);
            $sql3 = mysqli_query($conn, $updateCollege);
            if($sql2 && $sql3)
            { 
                echo '<script type="text/javascript">';
                echo 'alert("The application form has been reviewed")';
                echo '</script>';
            }
        }
    }
    else if(isset($_POST['reject']))
    {
        $status="Reject";
    
        $formData= "SELECT * FROM applicationForm WHERE userid='$userid'";
        $sql = mysqli_query($conn, $formData);
        $row = mysqli_fetch_assoc($sql);
        $res= $row['userid'];
        if($res == $userid)
        {
           $update = "UPDATE applicationForm SET verifyStatus='$status' WHERE applicationid='$applicationid'";
           $sql2=mysqli_query($conn, $update);
            if($sql2)
            { 
                echo '<script type="text/javascript">';
                echo 'alert("The application form has been reviewed")';
                echo '</script>';
            }
        } 
    }
    else{
        echo '<p> Error, this page can not be access</p>';
        echo "Error " . mysqli_error($conn);
        exit();
    }

    echo '<p>The application form has been reviewed and updated. Press "back" button to continue</p>';

 

include("../footer.php");
?>
</body>
</html>