<!DOCTYPE html>
<html>
    <head>
        <title>Delete user</title>
        <link rel="stylesheet" href="deleteForm.css">
    </head>

<body>
    <?php
        session_start();
        require_once('../config.php');
        include('Stud_homepage.html');
        $userid = $_SESSION['userid'];

        echo ' <form method="POST" action="view_form.php">
        <input class="back_btn" type="submit" name="returnback" value="Back"/>
        <input type="hidden" name="userid" value="' . $userid .'" />
        </form>';
        
        if(isset($_POST['confirm_delete']))
        {
            if($_POST['confirmation'] == 'YES')
            {
                //sql statement to delete data from 
                $deleteData = "DELETE FROM applicationForm WHERE userid='$userid'";
                
                if(mysqli_query($conn, $deleteData)){
                    if(mysqli_affected_rows($conn) == 1)
                    {
                        echo '<script type="text/javascript">';
                        echo 'alert("The application form has been deleted")';
                        echo '</script>';
                    }
                }
                else{
                    echo '<script type="text/javascript">';
                    echo 'alert("The record can not be deleted due to system error")';
                    echo '</script>';
                    echo mysqli_error($conn);
                }
            }
            else{
                echo '<script type="text/javascript">';
                echo 'alert("The user record has NOT been deleted")';
                echo '</script>';
            }
        }
        
        echo '<h1 align="center">Delete form</h1>';
        $formdata = "SELECT * FROM applicationForm where userid = '$userid'";

        if($resultForm = mysqli_query($conn, $formdata))
        {
            //return number of rows inn result set "$resultUser"
            //equals to 1 means that there exist a row that hold the data 
            if(mysqli_num_rows($resultForm) == 1)
            {
                //fetch result row as numeric array and as an associative array
                $resultForm = mysqli_fetch_array($resultForm);

                echo '<div class = "delete_form_table">
                    <form action="delete_form.php" method="POST">';
                    echo 'UserID: ' . $resultForm['userid'] . '<br><br>
                    Full name ' . $resultForm['fullName'] . '<br><br>
                    College Name: ' . $resultForm['collegeName'] . '<br><br>
                    Block Name: ' . $resultForm['blockName'] . '<br><br>
                    Room Number: ' . $resultForm['roomNo'] . '<br><br>
                    Date of Submission: ' . $resultForm['submitDate'] . '<br><br>
        
                    If you confirm to delete this user, click "YES", else click "NO"<br><br>
                    <div><input type="radio" name="confirmation" value="YES"/> YES 
                    <input type="radio" name="confirmation" value="NO" checked="checked"/> NO</div>
                    <br>';
                echo '<input type="submit" name="confirm_delete" value="Confirm"/>
                    <input type="hidden" name="userID" value="' . $userid .'" />            
                    </form>
                </div>';
            }
            else{
                echo '<div class="delete"><p>The form record has been deleted. Please press the "back" button to continue</p></div>';
            }
        }
        mysqli_close($conn);
        include("../footer.php");
    ?>
</body>
</html>