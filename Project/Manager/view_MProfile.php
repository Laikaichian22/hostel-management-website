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
        include('Manager_homepage.html');
        $userid= $_SESSION["userid"];
        $findUser = "SELECT * FROM users where userid='$userid'";

        echo ' <form method="POST" action="Manager_homepage.php">
        <input class="back_btn" type="submit" name="returnback" value="Back"/>
        <input type="hidden" name="userid" value="' . $userid .'" />
        </form>';

        if(isset($_POST['Submitted'])){ 
            header("Location: edit_MProfile.php"); 
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
                echo "<h1 align='center'><b>Manager Profile</b></h1>";
                //then the array can use keyword to find the data
                echo '<div class="profile_list" >';
                    echo 'Full name: ' . $dataUser['fullName'] . '<br><br>';
                    echo 'User id: ' . $dataUser['userid'] . '<br><br>';
                    echo 'IC number: ' . $dataUser['ic'] . '<br><br>';
                    echo 'Date of Birth: ' . $dataUser['DOB'] . '<br><br>';
                    echo 'Age: ' . $dataUser['age'] . '<br><br>';
                    echo 'Email address: ' . $dataUser['email'] . '<br><br>';
                    echo 'Home address: ' . $dataUser['homeAddress'] . '<br><br>';
                    echo 'Phone number: ' . $dataUser['phone'] . '<br><br>';
                echo '</div>';
                echo '<form method="post">';
                echo '<input class="edit_btn" type="submit" name="Submitted" value="Edit"/>';
                echo '</form>';
            }
        }
        include("../footer.php");
    ?>

</body>
</html>