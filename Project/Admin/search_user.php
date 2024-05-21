<!DOCTYPE html>
<html>

<head>
	<title>Search User</title>
</head>

<body>
<?php

require_once('../config.php');
include('Admin_homepage.html');
if(isset($_POST['userid'])){
   
    $userid = $_POST['userid'];
    $userdata = "SELECT * FROM users WHERE userid ='$userid'";
    $logindata = "SELECT * FROM login WHERE userid ='$userid'";
    if($resultdata = mysqli_query($conn, $userdata))
    {
        $resultLogin = mysqli_query($conn, $logindata);

        if (mysqli_num_rows($resultdata) == 1) { 
            $row=mysqli_fetch_array($resultdata);
            $row2=mysqli_fetch_array($resultLogin);

            echo 'User Information';
            
            echo '<div class="outer-user-table">
            <div class="user-table">
            
            <span class="profile">User ID: </span>'. $row['userid'].'<br>
        
            <span class="profile">Full Name: </span>'. $row['fullName'].'<br>
        
            <span class="profile">Age: </span>'. $row['age'].'<br>
        
            <span class="profile">Phone Number: </span>'. $row['phone'].'<br>
        
            <span class="profile">Email: </span>'. $row['email'].'<br>
        
            <span class="profile">Home Address: </span>'. $row['homeAddress'].'<br>
        
            <span class="profile">Username: </span>'. $row2['username'].'<br>
        
            <span class="profile">Password: </span>'. $row2['password'].'<br>';
        
            if($row2['userlevel']==1){
                echo "<span class='profile'>Role: Admin</span><br>";

            } else if ($row2['userlevel']==2){
                echo "<span class='profile'>Role: Student</span><br>";

            } else if ($row2['userlevel']==3){
                echo "<span class='profile'>Role: Manager</span><br>";

            }
            echo '<button class="insert-button" style="align:" onclick="history.back()">Go Back</button>';
            echo '<br>';
            echo '</div>';
        }else{
            header("Location: View all user.php");
        }
   }
}
echo '</div>
</form>
</div>';

mysqli_close($conn);
include ('../footer.php');

?>

</body>
</html>