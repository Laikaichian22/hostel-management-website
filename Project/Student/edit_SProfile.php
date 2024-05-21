<!DOCTYPE html>
<html>
    <head>
        <title>Profile editing page</title>
        <link rel="stylesheet" href="profile.css">
    </head>

<body>
    <?php
        session_start();
        require_once('../config.php');
        include('Stud_homepage.html');
        $userid = $_SESSION["userid"];
        $findUser = "SELECT * FROM users where userid='$userid'";

        echo ' <form method="POST" action="view_SProfile.php">
            <input class="back_btn" type="submit" name="returnback" value="Back"/>
            <input type="hidden" name="userid" value="' . $userid .'" />
        </form>';

        echo "<h1 style='text-align:center'>Editing profile</h1>";
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
                echo '<script type="text/javascript">';
                echo 'alert("The profile has been updated")';
                echo '</script>';
                $sql = mysqli_query($conn, $update);
            }
        }
    
        if($resultUser = mysqli_query($conn, $findUser))
        {
            if(mysqli_num_rows($resultUser) > 0)
            {
                $dataUser = mysqli_fetch_array($resultUser);
                
                echo '<div class="edit_profile">';
                echo '<form method="post" action="edit_SProfile.php">

                Full name: <input class="profileInfo" type="text" name="fullName" required value="'. $dataUser['fullName'] . '">
                <br><br>

                User id: <input class="profileInfo" type="text" name="userid" required value="'. $dataUser['userid'] . '">
                <br><br>

                Date of Birth <input class="profileInfo" type="text" name="DOB" required value="'. $dataUser['DOB'] . '">
                <br><br>

                IC number: <input class="profileInfo" type="text" name="ic" required value="'. $dataUser['ic'] . '">
                <br><br>

                Age: <input class="profileInfo" type="number" name="age" required value="'. $dataUser['age'] . '">
                <br><br>

                Gender: <input class="profileInfo" type="text" name="gender" required value="'. $dataUser['gender'] . '">
                <br><br>

                Email address: <input class="profileInfo" type="text" name="email" required value="'. $dataUser['email'] . '">
                <br><br>

                Home address: <input class="profileInfo" type="text" name="homeAddress" required value="'. $dataUser['homeAddress'] . '">
                <br><br>

                Phone number: <input class="profileInfo" type="text" name="phone" required value="'. $dataUser['phone'] . '">
                <br><br>
                
                <input class="profile_update_button" type="submit" name="Submitted" value="Update"/>';
                echo '</form>
                </div>';
            }
            
        }
        include("../footer.php");
    ?>

</body>
</html>