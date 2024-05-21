<html>

    <head>
        <title>Admin page</title>
    </head>

    <body>
        
        <?php
        include('Admin_homepage.html');
        ?>
        <div class="navigate">
            <a class="active" href="Admin_homePage.php">Home</a>
            <a href="view_all_user.php">View user list</a>
            <div class="dropdown">
                    <button class="dropbtn_view">View pages</button>
                    <div class="dropdown-content">
                        <a href="../check_applList.php">Application list</a>
                        <a href="collegeList.php">College list</a>
                        <a href="../check_report.php">Application report</a>
                        <a href="../check_student_record.php">Student's record</a> 
                    </div>
                </div>
        </div>
        
        <div class="image1" >
            <img src="../R.jpg"style="width:80%"; >    
        </div>
        

        <?php include '../footer.php' ?>
    </body>

</html>