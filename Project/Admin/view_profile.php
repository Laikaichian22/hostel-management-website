<!DOCTYPE html>
<html>
    <head>
        <title>Profile page</title>
        <link rel="stylesheet" href="profile.css">
    </head>

<body>
    <?php
        session_start();
        require_once('../config.php');
        include("Admin_homePage.html");

        if(isset($_POST["userid"]))
        {
            $userid =  $_POST["userid"];
        }
        else
        {
            $userid = $_SESSION["userid"];
        }
        
        $findUser = "SELECT * FROM users where userid='$userid'";
        echo ' <form method="POST" action="Admin_homePage.php">
        <input class="back_btn" type="submit" name="returnback" value="Back"/>
        <input type="hidden" name="userid" value="' . $userid .'" />
        </form>';
        if(isset($_POST['Submitted'])){ 
            header("Location: edit_profile.php"); 
            exit();
        }
        
        //perform query against database using variable "$findUser"
        if($resultUser = mysqli_query($conn, $findUser))
        {
            //return number of rows inn result set "$resultUser"
            //greater than 0 means that there exist a row that hold the data 
            if(mysqli_num_rows($resultUser) > 0)
            {
                //fetch result row as numeric array and as an associative array
                $dataUser = mysqli_fetch_array($resultUser);

                //then the array can use keyword to find the data
                echo "<h2 align='center'><b>Admin Profile</b></h2>";
                echo '<div class="profile_list">';
                echo '<table name="profile_table"  width=450px>';
                echo '<form method="post">';
                        echo '<tr>
                            <td> Full name: </td>
                            <td> '.$dataUser["fullName"].' </td>
                            </tr>
                            <tr>
                            <td> User id: </td>
                            <td> '.$dataUser["userid"].' </td>
                            </tr>
                            <tr>
                            <td> IC number: </td>
                            <td> '.$dataUser["ic"].' </td>
                            </tr>
                            <tr>
                            <td> Date of Birth: </td>
                            <td> '.$dataUser["DOB"].' </td>
                            </tr>
                            <tr>
                            <td> Age: </td>
                            <td> '.$dataUser["age"].' </td>
                            </tr>
                            <tr>
                            <td> Email address: </td>
                            <td> '.$dataUser["email"].' </td>
                            </tr>
                            <tr>
                            <td> Home address: </td>
                            <td> '.$dataUser["homeAddress"].' </td>
                            </tr>
                            <tr>
                            <td> Phone number: </td>
                            <td> '.$dataUser["phone"].' </td>
                            </tr>
                            <tr>
                            <td colspan="2" align="center"><input class="edit_btn" type="submit" name="Submitted" value="Edit"/></td>
                            </tr>';
                        echo '</form>';
                echo '</table>';
                echo '</div>';
            }
        }
        include("../footer.php");
    ?>
    
   
</body>
</html>