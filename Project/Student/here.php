<html>
    <head>
        <title> Application form </title>
        <link rel="stylesheet" href="applystyle1.css">
    </head>
</html>
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


        if( isset($_POST['submitted']) ){
            $userid = $_SESSION['userid'];
            $collegeName = $_POST['college_Name'];
            $roomNo = $_POST['roomNo'];
            $blockName = $_POST['blockName'];
            $roomType = $_POST['roomType'];
            $submitDate = $_POST['submitDate'];
            $fullName = $resultUser['fullName'];
            $status = "submitted";


            $formData = "INSERT INTO applicationForm(userid, fullName, collegeName, blockName, roomType, roomNo, verifyStatus, submitDate) 
            VALUES ('$userid', '$fullName', '$collegeName', '$blockName', '$roomType', '$roomNo', '$status', '$submitDate')";
            if(mysqli_query($conn, $formData)){

            }
            else{
                echo "Error record" . mysqli_error($conn);
            }
        }
    ?>

        <h2 id="title"> Student's accommodation application form </h2>
    
        <form action="apply_accommodation.php" method="POST" style=text-align:center>
            <div class="form">
                <table class="formTable">
                    <tr>
                        <td>User ID: <input type="text" name="userid" value="<?php echo $resultUser['userid']; ?>" /></td><br>
                        <td>College Name: 
                            <select name="college_Name" id="choice" required>
                            <option value="default">[Select a college]</option>
                            <option value="college1">KOLEJ HITMAN REBORN</option>
                            <option value="college2">KOLEJ FAIRY TAIL</option>
                            </select>
                        </td>
                        
                    </tr>
                    <tr>
                        <td>Full Name: <input type="text" name="fullName" value="<?php echo $resultUser['fullName']; ?>" /></td>
                        <td>Room Number: 
                            <select name="roomNumber" id="choiceNum" required>
                            <option value="default">[Select room Number]</option>
                            <?php
                                $collegeChoice = $_POST['college_Name'];
                                $data = "SELECT collegeid, roomNo FROM accommodation WHERE collegeName = '$collegeChoice'";
                                $resultNo = mysqli_query($conn, $data);
                                if(mysqli_num_rows($resultNo) > 0)
                                {
                                    while($optionDataNo = mysqli_fetch_assoc($resultNo))
                                    {
                                        $optionNo = $optionDataNo['roomNo'];
                                        //to differentiate the name of value for each option
                                        $name = $optionDataNo['collegeid'];
                                        ?>
                                        <option value="<?php echo $name; ?>"><?php echo $optionNo;?></option>
                                        <?php
                                    }
                                }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Block Name: <input type="text" name="blockName" required/></td>
                        <td>Type of Room: <input type="text" name="roomType" required/></td>
                    </tr>
                </table>

                <div class="form_below">
                    Date: <input type="date" name="submitDate" required/></td>
                </div><br>

                <input class="apply_btn" type="submit" name="submitted" value="Submit"/>
            </div>
        </form>  
        <?php include ('../footer.php'); ?>  
</body>