<!DOCTYPE html>
<html>
    <head>
        <title>View all users</title>
        <link rel="stylesheet" href="viewAll.css">
    </head>
        
<body>
   
    <?php
        session_start();
        require_once('../config.php');
        include('Admin_homepage.html');
        echo "<h1 style=text-align:center>List of all users</h1>";
    ?>

    <!--Input box for searching-->
    <form name="searchForm" method="POST" action="search_user.php" style=text-align:center>
    <input class="searchInput" style="height:50px padding:20px; font-size:14px;" type="text" name="userid" required/>
    <input class="search-btn" style="size:smaller; font-size:14px;" type="submit" value="Search"/>
    </form>
    <br>
    <?php
        //find the userdata from the database
        $userdata = mysqli_query($conn, "SELECT * FROM users");
        $logindata = mysqli_query($conn, "SELECT * FROM login");
        
        echo '<form action="add_userPage.php" style=text-align:center>
        <button type="submit">Add User</button>
        </form>';
        echo '&nbsp;&nbsp;&nbsp;';
        echo '<div class="user_list_table">';
        echo '<table class="table" border=1, style="wdith:100px;">
            <tr>
                <th> User ID </th>
                <th> Username </th>
                <th> Full name </th>
                <th> Role </th>
                <th> View </th>
                <th> Edit </th>
                <th> Delete </th>  
            </tr>';
        
        //find the user data using array
        while($resultUser= mysqli_fetch_array($userdata))
        {
            $resultLogin = mysqli_fetch_array($logindata);
            echo '<tr>';
                echo '<td>' . $resultUser['userid'] . '</td>';
                echo '<td>' . $resultLogin['username'] . '</td>';
                echo '<td>' . $resultUser['fullName'] . '</td>';
                echo '<td>';
                if($resultLogin['userlevel'] == 1) {
                    echo "Admin";
                }
                else if($resultLogin['userlevel'] == 2){
                    echo "Student";   
                }
                else if($resultLogin['userlevel'] == 3){
                    echo "Manager"; 
                }
                echo '</td>';

                //php passing id in href link
                echo '<td> <a href="view_user.php?userID=' . $resultUser["userid"] . '">View</a></td>
                <td> <a href="edit_user.php?userID=' . $resultUser["userid"] . '">Edit</a></td>
                <td> <a href="delete_userPage.php?userID=' . $resultUser["userid"] . '">Delete</a></td>
            </tr>';
        }
       
        echo "</table>";
        echo "</div>";
        echo '&nbsp;&nbsp;&nbsp;';
        echo '<form method="POST" action="Admin_homePage.php">
        <input class="back_btn" type="submit" name="returnback" value="Back"/>
        </form>';

        mysqli_close($conn);

       include ('../footer.php'); 
    ?>
    
</body>
</html>