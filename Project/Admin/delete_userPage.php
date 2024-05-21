<!DOCTYPE html>
<html>
    <head>
        <title>Delete user</title>
        <link rel="stylesheet" href="deleteuse.css">
    </head>

<body>
    <?php
        session_start();
        require_once('../config.php');
        include("Admin_homepage.html");
       
        if( (isset($_POST["userID"])) )
        {
            $userid = $_POST["userID"];
        }
        else if( (isset($_GET["userID"])) )
        {
            $userid = $_GET["userID"];
        }
        else
        {
            echo '<p> Error, this page can not be access</p>';
            exit();
        }

        echo ' <form method="POST" action="view_all_user.php">
        <input class="back_btn" type="submit" name="returnback" value="Back"/>
        <input type="hidden" name="userid" value="' . $userid .'" />
        </form>';

        if(isset($_POST['confirm_delete']))
        {
            if($_POST['confirm'] == 'YES')
            {
                //sql statement to delete data from 
                $deleteData = "DELETE FROM users WHERE userid='$userid'";
                
                //$result = mysqli_query($conn, $deleteData);
                if(mysqli_query($conn, $deleteData)){
                   
                    if(mysqli_affected_rows($conn) == 1){
                        
                        echo '<script type="text/javascript">';
                        echo 'alert("The user record has been deleted")';
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

        echo '<h1 align="center">Delete user</h1>';
        $userdata = "SELECT * FROM users WHERE userid='$userid'";

        if($resultUser = mysqli_query($conn, $userdata))
        {
            //return number of rows inn result set "$resultUser"
            //equals to 1 means that there exist a row that hold the data 
            if(mysqli_num_rows($resultUser) == 1)
            {
                //fetch result row as numeric array and as an associative array
                $dataUser = mysqli_fetch_array($resultUser);

                echo '<div class = "delete_user_table">
                    <form action="delete_userPage.php" method="POST">';
                    
                    echo '<h3>UserID:</h3> ' . $dataUser['userid'] . '<br>';

                    echo '<h3>Full name:</h3> ' . $dataUser['fullName'] . '<br>';

                    echo '<p span style=color:red>If you confirm to delete this user, click "YES", else click "NO"</p>';

                    echo '<div><input type="radio" id="yes" name="confirm" value="YES"/> <label for="yes">YES</label><br>
                        <input type="radio" id="no" name="confirm" value="NO" checked="checked"/> <label for="no">NO</label></div>
                        <br><br>';
                        
                    echo '<input type="submit" name="confirm_delete" value="Confirm"/>
                    <input type="hidden" name="userID" value="' . $userid .'" />            
                    </form><br>
                </div>';
            }
            else{
                echo '<div class="delete"><p>The user record has been deleted. Please press the "back" button to continue</p></div>';
            }
        }
        mysqli_close($conn);
        include("../footer.php");
    ?>
</body>
</html>