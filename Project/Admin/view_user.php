<!DOCTYPE html>
<html>

<head>
	<title>View user</title>
    <link rel="stylesheet" href="viewUser.css">
</head>

<body>
<?php
    session_start();
    require_once('../config.php');
    include('Admin_homepage.html');
   
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
    $findUser = "SELECT * FROM users WHERE userid='$userid'";
    $findLogin = "SELECT * FROM login WHERE userid='$userid'";
    
    //perform query against database using variable "$findUser"
    if($resultUser = mysqli_query($conn, $findUser))
    {
        $resultLogin=mysqli_query($conn, $findLogin);
        //return number of rows inn result set "$resultUser"
        //greater than 0 means that there exist a row that hold the data 
        if(mysqli_num_rows($resultUser) > 0)
        {
            //fetch result row as numeric array and as an associative array
            $dataUser = mysqli_fetch_array($resultUser);
            $dataLogin = mysqli_fetch_array($resultLogin);

            //then the array can use keyword to find the data
            echo '<div class="profile_list" style=text-align:center>';
            echo '<h1 align="center">View user</h1>';
            echo '<span>Full name: </span>' . $dataUser['fullName'] . '<br>';
            echo '<span>User id: </span>' . $dataUser['userid'] . '<br>';
            echo '<span>IC number: </span>' . $dataUser['ic'] . '<br>';
            echo '<span>Date of Birth: </span>' . $dataUser['DOB'] . '<br>';
            echo '<span>Age: </span>' . $dataUser['age'] . '<br>';
            echo '<span>Email address: </span>' . $dataUser['email'] . '<br>';
            echo '<span>Home address: </span>' . $dataUser['homeAddress'] . '<br>';
            echo '<span>Phone number: </span>' . $dataUser['phone'] . '<br>';
            echo '<span>Username: </span>' . $dataLogin['username'] . '<br>';
            echo '<span>Password: </span>' . $dataLogin['password'] . '<br>';
            echo '<span>Role: </span>';
            if($dataLogin['userlevel'] == 1){
                echo 'Admin' . '<br>';
            }
            else if($dataLogin['userlevel'] == 2){
                echo 'Student' . '<br>';
            }
            else if($dataLogin['userlevel'] == 3){
                echo 'Manager' . '<br>';
            }
            echo '</div>';
        }
    }
    echo ' <form method="POST" action="view_all_user.php">
    <input class="back_btn" type="submit" name="returnback" value="Back"/>
    </form>';
    mysqli_close($conn);
    
    include ('../footer.php');
?>
</body>
</html>