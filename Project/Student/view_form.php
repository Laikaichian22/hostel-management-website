<html>
    <head>
        <title> Your application form </title>
        <link rel="stylesheet" href="yoForm.css">
    </head>

    <body>
        <?php
            session_start();
            require_once('../config.php');
            include('Stud_homepage.html');
            $userid = $_SESSION["userid"];

            echo ' <form method="POST" action="Stud_homepage.php">
            <input class="back_btn" type="submit" name="returnback" value="Back"/>
            </form>';
            $userForm = mysqli_query($conn, "SELECT * FROM applicationForm where userid = '$userid'");
            
            if($resultForm = mysqli_fetch_array($userForm))
            {
                echo' <h2>Application Form</h2>
                <div class="view_form">
                <table class="form_list">
                <tr>
                    <td>Application ID: </td>
                    <td> <input type="number" name="applicationid" value = "'. $resultForm['applicationid'].'"disabled/></td>
                </tr>
                <tr>
                    <td>User ID: </td>
                    <td><input type="text" name="userid" value = "'. $resultForm['userid'].'"disabled/></td>
                </tr>
                <tr>
                    <td>Full Name: </td>
                    <td><input type="text" name="fullName" value = "'. $resultForm['fullName'].'"disabled/></td>
                </tr>
                <tr>
                    <td>College Name: </td>
                    <td><input type="text" name="collegeName" value = "'. $resultForm['collegeName'].'"disabled/></td>
                </tr>
                <tr>
                    <td> Block Name: </td>
                    <td><input type="text" name="blockName" value = "'.$resultForm['blockName'].'"disabled/></td>
                </tr>
                <tr>
                    <td> Room Type: </td>
                    <td><input type="text" name="roomType" value = "'.$resultForm['roomType'].'"disabled/></td>
                </tr>
                <tr>
                    <td>Room No:</td>
                    <td><input type="number" name="roomNo" value = "'.$resultForm['roomNo'].'"disabled/></td>
                </tr>
                <tr>
                    <td>Submission Date:</td>
                    <td><input type="date" name="submitDate" value = "'.$resultForm['submitDate'].'"disabled/></td>
                </tr>';
                if($resultForm['verifyStatus'] == 'Approve')
                {
                    echo' <tr>
                    <td>Status:</td>
                    <td><input class="approve" type="text" name="verifyStatus" value = "'.$resultForm['verifyStatus'].'"disabled/></td>
                    </tr>
                    <tr>
                    <td class="approve" style="text-align:center;" colspan="2">Your application has been approved</td>
                    </tr>';
                }
                else if($resultForm['verifyStatus'] == 'Reject'){
                    echo' <tr>
                    <td>Status:</td>
                    <td><input class="reject" type="text" name="verifyStatus" value = "'.$resultForm['verifyStatus'].'"disabled/></td>
                    </tr>
                    <tr>
                    <td class="reject" style="text-align:center;" colspan="2">Your application has been rejected</td>
                    </tr>';
                }
                else{
                    echo' <tr>
                    <td>Status:</td>
                    <td><input class="status" type="text" name="verifyStatus" value = "'.$resultForm['verifyStatus'].'"disabled/></td>
                    </tr>
                    <tr>
                    <td style="text-align:center;" colspan="2"><a href="edit_form.php">Edit</a></td>
                    </tr>
                    <tr>
                    <td style="text-align:center;" colspan="2"><a href="delete_form.php">Delete</a>
                    </tr>';
                }
                echo'
                </table>
                </div>';
            }
            else{
                echo '<p>There is no record for accommodation apply form</p>';
            }
        
            include("../footer.php");
        ?>

    </body>
</html>