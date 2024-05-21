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

        echo '<form method="POST" action="Stud_homepage.php">
        <input class="back_btn" type="submit" name="returnback" value="Back"/>
        </form>';

        $userdata = mysqli_query($conn, "SELECT * FROM users WHERE userid = '$userid'");
        $resultUser = mysqli_fetch_array($userdata);

        //this if-else statement is dedicated for the moment when the user submit the application form
        if( isset($_POST['submitted']) ){
            $userid = $_POST['userid'];
            $collegeName = $_POST['college_Name'];
            $roomNo = $_POST['roomNumber'];
            $blockName = $_POST['blockName'];
            $roomType = $_POST['roomType'];
            $submitDate = $_POST['submitDate'];
            $fullName = $resultUser['fullName'];
            $status = "submitted";

            $formData = "INSERT INTO applicationForm(userid, fullName, collegeName, blockName, roomType, roomNo, verifyStatus, submitDate) 
            VALUES ('$userid', '', '', '', '', '$roomNo', '', '')";
            if(mysqli_query($conn, $formData)){
                $setData = "UPDATE applicationForm SET fullName='$fullName', collegeName='$collegeName', blockName='$blockName', roomType='$roomType', verifyStatus='$status', submitDate='$submitDate' WHERE userid='$userid'";
                $data1 = mysqli_query($conn, $setData);
                if($data1)
                {
                    echo '<script type="text/javascript">';
                    echo 'alert("The new record has been added")';
                    echo '</script>';
                }
            }
            else{
                echo "Error record" . mysqli_error($conn);
            }

            echo '<p>Your application form has been recorded.</p>
            <p>Press "back" button to return </p>';
        }

        //this if-else statement is called when the user confirm the selection of room
        if(isset($_POST['confirm']))
        {
            $userid = $_SESSION['userid'];
            $collegeChoice = $_POST['college_Name'];
            
            echo '<h2 id="title"> Accommodation application form (Con.)</h2>';
            echo ' <div class="form">
            College Name: ';
            echo $collegeChoice;

            echo '<br><hr>';
            echo '<form action="selectRoom.php" method="POST" style=text-align:center>';
                echo 'Room Number: ';
                echo '<select name="roomNumber" id="choiceNum" required>
                <option value="">[Select room Number]</option>';
                    $collegeChoice = $_POST['college_Name'];

                    $data = "SELECT * FROM accommodation WHERE collegeName = '$collegeChoice'AND available= 'EMPTY'";
                    $resultNo = mysqli_query($conn, $data);
                    if(mysqli_num_rows($resultNo) > 0)
                    {
                        while($optionDataNo = mysqli_fetch_assoc($resultNo))
                        {
                            $optionNo = $optionDataNo['roomNo'];
                            //to differentiate the name of value for each option
                            ?>
                            <option value="<?php echo $optionNo; ?>"><?php echo $optionNo;?></option>';
                            <?php
                        }
                    }
                echo '</select>';

                echo '<br><br>';
                echo 'Block Name: ';
                echo '<select name="blockName" id="blockName" required>

                    <option value="">[Select block]</option>';
                    $collegeChoice = $_POST['college_Name'];

                    $data = "SELECT * FROM accommodation WHERE collegeName = '$collegeChoice' AND available= 'EMPTY'";
                    $resultBlock = mysqli_query($conn, $data);
                    if(mysqli_num_rows($resultNo) > 0)
                    {
                        while($optionRoom = mysqli_fetch_assoc($resultBlock))
                        {
                            $option = $optionRoom['blockName'];
                            //to differentiate the name of value for each option
                            ?>
                            <option value="<?php echo $option; ?>"><?php echo $option;?></option>';
                            <?php
                        }
                    }
                echo '</select>';

                echo '<br><br>';
                echo 'Room Type: ';
                echo '<select name="roomType" id="room" required>
                    <option value="">[Select room]</option>
                    <option value="Single Room">Single Room</option>
                    <option value="Double Room">Double Room</option>';
                    
                echo '</select>';

                echo '<div class="form_below">
                    Date: <input type="date" name="submitDate" required/></td>
                    </div><br>';

                echo ' <input class="confirm_btn" type="submit" name="submitted" value="Confirm"/>
                    <input type="hidden" name="userid" value="'.$userid.'" />
                    <input type="hidden" name="college_Name" value="'.$collegeChoice.'" />
                </div>
                </form>
                </div>';

        }?>


        <?php 
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
        echo "</div>";?>
        <?php include ('../footer.php');?>
        
</body>
</html>