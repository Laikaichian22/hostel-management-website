<?php
session_start();
require_once('../config.php');
include('Stud_homepage.html');
//update the profile in database
if(isset($_POST['Submitted']))
{
    $user_id = $_SESSION["userid"];
    $name=$_POST['fullName'];
    $ic=$_POST['ic'];
    $userid = $_POST['userid'];
    $DOB = $_POST['DOB'];
    $age=$_POST['age'];
    $gender = $_POST['gender'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $homeAddress=$_POST['homeAddress'];
    
    
    $findUser= "SELECT * FROM users WHERE userid='$user_id'";
    $sql = mysqli_query($conn, $findUser);
    $row = mysqli_fetch_assoc($sql);           //return data in a association array
    $result= $row['userid'];
    if($result == $user_id)
    {
       $update = "UPDATE users SET fullName='$name', ic='$ic', userid='$userid', DOB='$DOB', age='$age', gender='$gender', email='$email', phone='$phone', homeAddress='$homeAddress' where userid='$user_id'";
       
       $sql = mysqli_query($conn, $update);
    }
    //echo '<script type="text/javascript">';
    //echo 'alert("The profile has been updated")';
    //echo '</script>';
  
    echo 'The profile has been updated <br>';
    echo 'Please press the button to continue <br>';
    echo '<button class="insert-button" style="align:" onclick="history.back()">Go Back</button>';

    
}
?>
