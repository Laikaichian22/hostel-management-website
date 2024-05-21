<html>

<head>
   <title>Application Homepage</title>
   <link rel="stylesheet" href="applList1.css">
</head>

<body>
   <?php
   session_start();
   require_once('../config.php');
   if($_SESSION['userlevel'] == 1)
   {
      include('../Admin/Admin_homepage.html');
      $userid = $_SESSION['userid'];
      echo ' <form method="POST" action="../Admin/Admin_homepage.php">
      <input class="back_btn" type="submit" name="returnback" value="Back"/>
      </form>';
   }
   else if($_SESSION['userlevel'] == 3)
   {
      include('Manager_homepage.html');
      $userid = $_SESSION['userid'];
      echo ' <form method="POST" action="Manager_homepage.php">
      <input class="back_btn" type="submit" name="returnback" value="Back"/>
      </form>';
   }
  
   
   echo "<h2 style='text-align:center'>Students' Application List</h2>"; 

   $array = array();

   
   $formData = "SELECT * FROM applicationForm WHERE verifyStatus='submitted'";
   $resultForm = mysqli_query($conn, $formData);
   $rowData = 0;
   $number = 0;
   
   while($rowData = mysqli_fetch_array($resultForm))
   {
      if($number == 0)
      {
         echo '<div class="application_list_table">';
         echo "<table class='form_list'>";
         echo "<tr>
            <th>No.</th>
            <th>Application ID</th>
            <th>Applicant ID</th>
            <th>Applicant Name</th>
            <th>Block Name</th>
            <th>Room Type</th>
            <th>Room Number</th>
            <th>Application Date</th>
            <th>Status</th>
            <th>Availability</th>
            <th>CLICK</th>
         </tr>";
      }
      $roomNo = $rowData["roomNo"];
      $collegeData = "SELECT * FROM accommodation WHERE roomNo='$roomNo'";
               
      $resultCollege = mysqli_query($conn, $collegeData);
      $rowCollege = mysqli_fetch_assoc($resultCollege);
            
      $array['appID'] = $rowData['applicationid'];
      $array['userID'] = $rowData['userid'];
      $array['fName'] = $rowData['fullName'];
      $array['blockN'] = $rowData['blockName'];
      $array['roomT'] = $rowData['roomType'];
      $array['roomN'] = $rowData['roomNo']; 
      $array['date'] = $rowData['submitDate'];
      $array['status'] = $rowData['verifyStatus'];
      $array['availability'] = $rowCollege['available'];
            
      echo "<tr> 
         <td>" . ($number+1 ). "</td>
         <td>" . $array['appID'] . "</td>
         <td>" . $array['userID'] . "</td>
         <td>" . $array['fName'] . "</td>
         <td>" . $array['blockN'] . "</td>
         <td>" . $array['roomT'] . "</td>
         <td>" . $array['roomN'] . "</td>
         <td>" . $array['date'] . "</td>
         <td class='status'>" . $array['status'] . "</td>";
      if($array['availability'] == 'EMPTY')
      {
         echo "<td class='empty'>" . $array['availability'] . "</td>";
      }
      else{
         echo "<td class='full'>" . $array['availability'] . "</td>";
      }

      echo" <td>";
      if($_SESSION['userlevel'] == 3){
         echo "<a href='review_application.php?userid=". $array["userID"]." & applicationid=". $array["appID"]."'> View </a>"; 
      }
      else{
         //admin can not proceed any more
      }
      echo "</td></tr>";
      $number++;  
   }
   echo "</table>";
   echo "</div>"; 
   
   if($number == 0)
   {
      echo '<p>No application form in this list</p>';
   }
   
   echo "<div class='college_list'>";
   if($_SESSION['userlevel'] == 3){
      echo "<a href='view_college.php'> View College List </a>";
   }
   else{
      //admin can not proceed any more
   }
   echo "</div>";

  
   include("../footer.php");
   ?>


</body>

</html>