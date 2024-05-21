<!DOCTYPE html>
<html>
    <head>
        <title>Add user</title>
        <link rel="stylesheet" href="add_user.css">
    </head>

<body>

    <?php
        
        session_start();
        require_once('../config.php');
        include('Admin_homepage.html');

        echo ' <form method="POST" action="Admin_homePage.php">
        <input class="back_btn" type="submit" name="returnback" value="Back"/>
        </form>';

        //use to insert data into database, and display message if any error
        $completed=FALSE;
        $usernameErr = $passwordErr = $icErr = $useridErr = $dobErr = $genderErr = $emailErr = $addressErr = $phoneErr = "";
        $userlvlErr = $ageErr = $nameErr="";
        $error = 0;
        if(isset($_POST['Submitted'])){                 //return true if the user press the submit button
            
            if(empty($_POST['fullName'])){                      //if nameis empty, return true
                $nameErr = "User's full name is required!";     //notify the user about the error
                $error += 1;                                    //count the number of errors
            }else if(is_numeric($_POST['fullName'])){
                $nameErr = "Only letters are allowed";
                $error += 1; 
            }
            else{
                $fullName = trim($_POST['fullName']);           //trim() function removes whitespace from both sides of the string
            }

            if(empty($_POST['ic'])){
                $icErr = "Ic number is required!";
                $error += 1;
            }else{
                $ic = trim($_POST['ic']);
            }

            if(empty($_POST['userid'])){
                $useridErr = "User id is required!";
                $error += 1;
            }
            else if(!empty($_POST['userid'])){
                $userid = $_POST['userid'];
                $userdata = mysqli_query($conn, "SELECT userid FROM users WHERE userid='$userid'");
                if($resultUser= mysqli_fetch_array($userdata))
                {   
                    $useridErr = "!Error, the userid is duplicated";
                }
            }
            else{
                $userid = trim($_POST['userid']);
            }

            if(empty($_POST['DOB'])){
                $dobErr = "Date of Birth is required!";
                $error += 1;
            }else{
                $DOB = trim($_POST['DOB']);
            }

            if(empty($_POST['age'])){
                $ageErr = "Age is required!";
                $error += 1;
            }
            else{
                $age = trim($_POST['age']);
            }

            if(empty($_POST['gender'])){
                $genderErr = "Gender is required!";
                $error += 1;
            }
            else{
                $gender = trim($_POST['gender']);
            }

            if(empty($_POST['email'])){
                $emailErr = "Email address is required!";
                $error += 1;
            }else if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                $emailErr = "Email address is invalid!";
            }
            else{
                $email = trim($_POST['email']);
            }

            if(empty($_POST['homeAddress'])){
                $addressErr = "Home address is required!";
                $error += 1;
            }else{
                $homeAddress = trim($_POST['homeAddress']);
            }

            if(empty($_POST['phone'])){
                $phoneErr = "Phone number is required!";
                $error += 1;
            }else{
                $phone = trim($_POST['phone']);
            }

            if($error==0){
                $newUser = "INSERT INTO users(userid, fullName, ic, DOB, age, gender, email, homeAddress, phone)
                VALUES('$userid', '$fullName', '$ic', '$DOB', '$age', '$gender', '$email', '$homeAddress', '$phone');";
                $newLogin = "INSERT INTO login(username, password, userlevel, userid)
                VALUES('', '', '', '$userid')";
                $data1 = mysqli_query($conn, $newUser);
                $data2 = mysqli_query($conn, $newLogin);
                //perform query against database
                if (mysqli_affected_rows($conn)==1) {
                    echo '<script type="text/javascript">';
                    echo 'alert("The new record has been added")';
                    echo '</script>';
                } 
                else{
                    echo "Error record" . mysqli_error($conn);
                }
                $completed = TRUE;
            }
    } 
    ?>

<div id="adduser">
        <form name="add_user" method="post" action="add_userPage.php">
            <h2>Add user(Personal Details)</h2>
            <div id="line">Please fill in all the blanks in the form below.
            </div>
            <hr>

            <!--htmlspecialchars() function convert special characters to HTML entity-->

            <!--User personal details-->
            Full Name: <input class="add" type="text" name="fullName"
            value="<?php if(isset($_POST['fullName'])) echo htmlspecialchars($_POST['fullName']);?>"/>
            <span class="error">* <?php echo $nameErr; ?></span>
            <br><br>

            User id: <input class="add" type="text" name="userid"
            value="<?php if(isset($_POST['userid'])) echo htmlspecialchars($_POST['userid']);?>"/>
            <span class="error">* <?php echo $useridErr; ?></span>
            <br><br>

            Date of Birth: <input class="add" type="date" name="DOB"
            value="<?php if(isset($_POST['DOB'])) echo htmlspecialchars($_POST['DOB']);?>"/>
            <span class="error">* <?php echo $dobErr; ?></span>
            <br><br>

            IC number: <input class="add" type="text" name="ic"
            value="<?php if(isset($_POST['ic'])) echo htmlspecialchars($_POST['ic']);?>"/>
            <span class="error">* <?php echo $icErr; ?></span>
            <br><br>

            Age: <input class="add" type="number" name="age"
            value="<?php if(isset($_POST['age'])) echo htmlspecialchars($_POST['age']);?>"/>
            <span class="error">* <?php echo $ageErr; ?></span>
            <br><br>

            Gender: <input class="add" type="text" name="gender"
            value="<?php if(isset($_POST['gender'])) echo htmlspecialchars($_POST['gender']);?>"/>
            <span class="error">* <?php echo $genderErr; ?></span>
            <br><br>

            Email address: <input class="add" type="text" name="email"
            value="<?php if(isset($_POST['email'])) echo htmlspecialchars($_POST['email']);?>" placeholder="abc@gmail.com"/>
            <span class="error">* <?php echo $emailErr; ?></span>
            <br><br>

            Home address: <input class="add" type="text" name="homeAddress"
            value="<?php if(isset($_POST['homeAddress'])) echo htmlspecialchars($_POST['homeAddress']);?>"/>
            <span class="error">* <?php echo $addressErr; ?></span>
            <br><br>

            Phone number: <input class="add" type="text" name="phone"
            value="<?php if(isset($_POST['phone'])) echo htmlspecialchars($_POST['phone']);?>" placeholder="012-234456, with '-' "/>
            <span class="error">* <?php echo $phoneErr; ?></span>
            <br><br>

            <?php
            if(!$completed)
            {
                echo '<input class="add_user_btn" type="submit" name="Submitted" onclick="addUser()" value="Add user"/>
                <br><br><br>';
            }
            else
            {
                echo 'Click to continue to next page
                </form>';
            }?>
</div>
        <?php
            if($completed)
            {
                echo ' <div class="conti_btn">
                <form method="POST" action="add_userAccount.php">
                <input class="continue_btn" type="submit" name="continue" value="Continue"/>
                <input type="hidden" name="userid" value="' . $userid .'" />      
                </form>
                </div>';
            }
        ?>

    <?php include ('../footer.php');?>
</body>
<!--<form method="POST" action="add_userAccount.php">
                <input class="continue_btn" type="submit" name="continue" value="Continue"/>
                <br><br><br>
                </form>-->
</html>