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
        //use to insert data into database, and display message if any error
        $usernameErr = $passwordErr = $userlvlErr = "";
        
        $userid = $_POST["userid"];        
       
        if(isset($_POST["Submitted"]))
        {
            
            $error = 0;
            if(isset($_POST['Submitted'])){                 //return true if the user press the submit button
                
                if(empty($_POST['username'])){              //if username is empty, return true
                    $usernameErr = "Username is required!"; //notify the user about the error
                    $error += 1;                            //count the number of errors
                }
                else if(!empty($_POST['username'])){
                    $username = $_POST['username'];
                    $userdata = mysqli_query($conn, "SELECT username FROM users WHERE username='$username'");
                    if($resultUser= mysqli_fetch_array($userdata))
                    {   
                        $usernameErr = "!Error, the username is duplicated";
                    }
                }
                else{
                    $username = trim($_POST['username']);   //trim() function removes whitespace from both sides of the string
                }

                if(empty($_POST['password'])){
                    $passwordErr = "Password is required!";
                    $error += 1;
                }
                else{
                    $password = trim($_POST['password']);
                }

                if(empty($_POST['userlevel'])){
                    $userlvlErr = "User level is required!";
                    $error += 1;
                }else{
                    $userlevel = trim($_POST['userlevel']);
                }

                if($error==0){

                    $newLogin = "UPDATE login SET username='$username', password='$password', userlevel='$userlevel' WHERE userid='$userid'";
                    $data1 = mysqli_query($conn, $newLogin);

                    //perform query against database
                    if ($data1) {
                        echo '<script type="text/javascript">';
                        echo 'alert("The new record has been added")';
                        echo '</script>';
                    } 
                    else{
                        echo "Error record" . mysqli_error($conn);
                    }
                }
                mysqli_close($conn);
            } 
        }
    ?>

<div id="adduser">
        <form name="add_user" method="post" action="add_userAccount.php">
            <h2>Add user(Personal Details)</h2>
            <div id="line">Please fill in all the blanks in the form below.
            </div>
            <hr>

            <!--htmlspecialchars() function convert special characters to HTML entity-->
            Username: <input class="add" type="text" name="username" 
            value="<?php if(isset($_POST['username'])) echo htmlspecialchars($_POST['username']);?>"/>
            <span class="error">* <?php echo $usernameErr; ?></span>
            <br><br>
 
            Password: <input class="add" type="text" name="password"
            value="<?php if(isset($_POST['password'])) echo htmlspecialchars($_POST['password']);?>"/>
            <span class="error">* <?php echo $passwordErr; ?></span>
            <br><br>

            User level: <input class="add" type="number" name="userlevel"
            value="<?php if(isset($_POST['userlevel'])) echo htmlspecialchars($_POST['userlevel']);?>" min="1" max="3"/>
            <span class="error">* <?php echo $userlvlErr; ?></span>
            <br><br>

            <input class="add_user_btn" type="submit" name="Submitted" value="Add user's account"/>
            <?php echo '<input type="hidden" name="userid" value="'.$userid.'" />'; ?> 
            <br><br><br>
        </form>
</div>

   <?php include ('../footer.php');?>
</body>

</html>