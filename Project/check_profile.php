<!DOCTYPE HTML>
<html>
<head>
    <title>
        Profile page
    </title>
</head>

<body>
    <?php
   
        session_start();
        require_once('config.php');

        if(isset($_SESSION['userid']))
        {
            $userid=$_SESSION['userid'];
            $sql = "SELECT * FROM login WHERE userid='$userid'";
            if($result = mysqli_query($conn, $sql))
            {
                //find the number of rows where the login data located at
                $rows = mysqli_fetch_array($result);

                //determine whether the information match with any of the login data in database
                $count=mysqli_num_rows($result);
            }  
            $user_level=$rows['userlevel'];

            if($count==1) //result match
            {
                $_SESSION["Login"] = "YES";
                $_SESSION["LEVEL"] = $user_level;
           
                if($_SESSION["LEVEL"]=="1")
                {
                    header("Location: Admin/view_profile.php");
                }
                else if($_SESSION["LEVEL"]=="2")
                {
                    header("Location: Student/view_SProfile.php");
                }
                else if($_SESSION["LEVEL"]=="3")
                {
                    header("Location: Manager/view_MProfile.php");
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