<!DOCTYPE HTML>
<html>
<head>
    <title>
        User main page php file
    </title>
</head>

<body>
    <?php
   
        session_start();
        require_once('config.php');

        //get inputs from the login page
        if( isset($_POST['username']) && isset($_POST['password']) && isset($_POST['userType']))
        {
            $username=$_POST['username'];
            $password=$_POST['password'];
            $userlevel=$_POST['userType'];

            //fetch user login data from database
            $sql="SELECT * FROM login WHERE username='$username' and password='$password' and userlevel='$userlevel'";

            if($result = mysqli_query($conn, $sql))
            {
                //find the number of rows where the login data located at
                $rows = mysqli_fetch_array($result);

                //determine whether the information match with any of the login data in database
                $count=mysqli_num_rows($result);
            }  
            
            /* echo '<script type="text/javascript">';
                echo 'alert("Wrong input! Please enter again")';
                echo '</script>';*/
            //assign the data from database into the variables
            $user_name=$rows['username'];
            $user_id=$rows['userid'];
            $user_level=$rows['userlevel'];

            if($count==1) //result match
            {
                $_SESSION["Login"] = "YES";
                $_SESSION["LEVEL"] = $user_level;
                $_SESSION["userid"] = $user_id;
                $_SESSION["username"] = $user_name;

                if($_SESSION["LEVEL"]=="1")
                {
                    header("Location: Admin/Admin_homepage.php");
                }
                else if($_SESSION["LEVEL"]=="2")
                {
                    header("Location: Student/Stud_homepage.php");
                }
                else if($_SESSION["LEVEL"]=="3")
                {
                    header("Location: Manager/Manager_homepage.php");
                }
            }
            else
            {
                $_SESSION["Login"] = "NO";
                header("Location: Login_page.html");    
            }
        }   
    ?>
</body>
</html>