<!DOCTYPE html>
<html>
    <head>
        <title>Add user</title>
        <link rel="stylesheet" href="edituser.css">
    </head>
<body>
    <?php
        session_start();
        require_once('../config.php');
        include('Admin_homepage.html');
        //use to insert data into database, and display message if any error
        
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
            echo '<p> Error, the user editting page can not be access</p>';
            exit();
        }
        echo ' <form method="POST" action="view_all_user.php">
        <input class="back_btn" type="submit" name="returnback" value="Back"/>
        <input type="hidden" name="userid" value="' . $userid .'" />
        </form>';
        $completed = FALSE;
        $usernameErr = $passwordErr = $icErr = $dobErr = $genderErr = $emailErr = $addressErr = $phoneErr = "";
        $userlvlErr = $ageErr = $nameErr="";
        $error = 0;
        if(isset($_POST['Submitted'])){                 //return true if the user press the submit button
            
            if(empty($_POST['username'])){              //if username is empty, return true
                $usernameErr = " Username is required!"; //notify the user about the error
                $error += 1;                            //count the number of errors
            }else{
                $username = trim($_POST['username']);   //trim() function removes whitespace from both sides of the string
            }

            if(empty($_POST['password'])){
                $passwordErr = " Password is required!";
                $error += 1;
            }else{
                $password = trim($_POST['password']);
            }

            if(empty($_POST['userlevel'])){
                $userlvlErr = " User level is required!";
                $error += 1;
            }else{
                $userlevel = trim($_POST['userlevel']);
            }
            if(empty($_POST['fullName'])){
                $nameErr = " User's full name is required!";
                $error += 1;
            }else{
                $fullName = trim($_POST['fullName']);
            }

            if(empty($_POST['ic'])){
                $icErr = " Ic number is required!";
                $error += 1;
            }else{
                $ic = trim($_POST['ic']);
            }

            if(empty($_POST['DOB'])){
                $dobErr = " Date of Birth is required!";
                $error += 1;
            }else{
                $DOB = trim($_POST['DOB']);
            }

            if(empty($_POST['age'])){
                $ageErr = " Age is required!";
                $error += 1;
            }else{
                $age = trim($_POST['age']);
            }

            if(empty($_POST['gender'])){
                $genderErr = " Gender is required!";
                $error += 1;
            }else{
                $gender = trim($_POST['gender']);
            }

            if(empty($_POST['email'])){
                $emailErr = " Email address is required!";
                $error += 1;
            }else{
                $email = trim($_POST['email']);
            }

            if(empty($_POST['homeAddress'])){
                $addressErr = " Home address is required!";
                $error += 1;
            }else{
                $homeAddress = trim($_POST['homeAddress']);
            }

            if(empty($_POST['phone'])){
                $phoneErr = " Phone number is required!";
                $error += 1;
            }else{
                $phone = trim($_POST['phone']);
            }

            if(empty($_POST['userlevel'])){
                $userlevelErr = " User level is required!";
                $error += 1;
            }else{
                $userlevel = trim($_POST['userlevel']);
            }

            if($error==0){
                $updateLogin = "UPDATE login SET username='$username', password='$password', userlevel='$userlevel' WHERE userid='$userid'";
                $updateUser = "UPDATE users SET fullName='$fullName', ic='$ic', DOB='$DOB', age='$age', gender='$gender', email='$email', homeAddress='$homeAddress', phone='$phone' WHERE userid='$userid'";

                $sql = mysqli_query($conn, $updateLogin);
                $sql2 = mysqli_query($conn, $updateUser);
                //perform query against database
                if ($sql && $sql2) {
                    echo '<script type="text/javascript">';
                    echo 'alert("The login record and user record has been edited")';
                    echo '</script>';
                    $completed = TRUE;
                } 
                else{
                    echo 'The user record could not be edited';
                    echo "Error record" . mysqli_error($conn);
                }
            }
            
        }

    $findUser = "SELECT * FROM users WHERE userid='$userid'";
    $findLogin = "SELECT * FROM login WHERE userid='$userid'";
    
    //perform query against database using variable "$findUser"
    if($resultUser = mysqli_query($conn, $findUser))
    {
        $resultLogin=mysqli_query($conn, $findLogin);
        //return number of rows inn result set "$resultUser"
        //greater than 0 means that there exist a row that hold the data 
        if(mysqli_num_rows($resultUser) == 1)
        {
            //fetch result row as numeric array and as an associative array
            $dataUser = mysqli_fetch_array($resultUser);
            $dataLogin = mysqli_fetch_array($resultLogin);

            echo '<h2 align="center">Edit user</h2>';
            echo '<div class="edit_user">';
            echo '<form method="post" action="edit_user.php">
            Below shows the original data of the user<br><br>

            Full name: <input class="userInfo" type="text" name="fullName" value="'. $dataUser['fullName'] . '">';
            echo '<span class="error"> '. $nameErr. '</span><br><br>';

            echo 'Date of Birth: <input class="userInfo" type="text" name="DOB" value="'. $dataUser['DOB'] . '">';
            echo '<span class="error"> '. $dobErr .' </span> <br><br>';
            

            echo 'IC number: <input class="userInfo" type="text" name="ic" value="'. $dataUser['ic'] . '">';
            echo '<span class="error"> '. $icErr .' </span> <br><br>';
            

            echo 'Age: <input class="userInfo" type="number" name="age" value="'. $dataUser['age'] . '">';
            echo '<span class="error"> '. $ageErr .' </span> <br><br>';
            

            echo 'Gender: <input class="userInfo" type="text" name="gender" value="'. $dataUser['gender'] . '">';
            echo '<span class="error"> '. $genderErr .' </span> <br><br>';
            

            echo 'Email address: <input class="userInfo" type="text" name="email" value="'. $dataUser['email'] . '">';
            echo '<span class="error"> '. $emailErr .' </span><br><br>';
           

            echo 'Home address: <input class="userInfo" type="text" name="homeAddress" value="'. $dataUser['homeAddress'] . '">';
            echo '<span class="error"> '. $addressErr .' </span> <br><br>';
            

            echo 'Phone number: <input class="userInfo" type="text" name="phone" value="'. $dataUser['phone'] . '">';
            echo '<span class="error"> '. $phoneErr .' </span><br><br>';
            

            echo 'Username: <input class="userInfo" type="text" name="username" value="'. $dataLogin['username'] . '">';
            echo '<span class="error"> '. $usernameErr .' </span><br><br>';
            

            echo 'Password: <input class="userInfo" type="text" name="password" value="'. $dataLogin['password'] . '">';
            echo '<span class="error"> '.  $passwordErr .' </span><br><br>';
            
            echo '
            Role: <select class="select" name="userlevel">
                    <option value="" selected="selected"> - [Select role] - </option>
                    <option value="1"> Admin </option>
                    <option value="2"> Student </option>
                    <option value="3"> Manager </option>
                  </select>
                  <span class="error"> '.  $userlvlErr .' </span><br><br>
            <br><br>';
            
        
            echo '<input class="edit_user_btn" type="submit" name="Submitted" value="Update"/>
            <input type="hidden" name="userID" value="' . $userid .'" />';

            echo '
            </form></div>';
        }
    }
    include('../footer.php'); ?>
</body>

</html>