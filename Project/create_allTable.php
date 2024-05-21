<?php
 
//like a header file, to create connection to database 
require_once ("config.php");

$sql = "CREATE TABLE users(
  userid VARCHAR(20) NOT NULL PRIMARY KEY,
  fullName VARCHAR(20) NOT NULL,
  ic VARCHAR(20) NOT NULL,
  DOB VARCHAR(20) NOT NULL,
  age INT(3) NOT NULL,
  gender VARCHAR(10) NOT NULL,
  email VARCHAR(30) NOT NULL,
  homeAddress VARCHAR(90) NOT NULL,
  phone VARCHAR(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8";

$sql2 = "CREATE TABLE login(
  username VARCHAR(20) NOT NULL,
  password VARCHAR(20) NOT NULL,
  userlevel INT(1) NOT NULL,
  userid VARCHAR(20) NOT NULL,
  FOREIGN KEY (userid) REFERENCES users(userid)
  ON DELETE CASCADE
  ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8";

$sql3 = "CREATE TABLE accommodation(
  collegeid VARCHAR(10) NOT NULL,
  collegeName VARCHAR(30) NOT NULL,
  blockName VARCHAR(5) NOT NULL,
  roomType VARCHAR(20) NOT NULL,
  roomNo INT(4) NOT NULL PRIMARY KEY,
  available VARCHAR(20) NOT NULL

)ENGINE=InnoDB DEFAULT CHARSET=utf8";

$sql4 = "CREATE TABLE applicationForm(
  applicationid int(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  userid VARCHAR(20),
  fullName VARCHAR(20),
  collegeName VARCHAR(30),
  blockName VARCHAR(5),
  roomType VARCHAR(20),
  roomNo INT(4),
  verifyStatus VARCHAR(20),
  submitDate VARCHAR(20), 
  FOREIGN KEY (userid) REFERENCES users(userid),
  FOREIGN KEY (roomNo) REFERENCES accommodation(roomNo)
  
)ENGINE=InnoDB DEFAULT CHARSET=utf8";


//with the exist of config.php, can use $conn
if (mysqli_query($conn, $sql)) {
  echo "<br>Table users created successfully";
} 
else {
  echo "Error creating table: " . mysqli_error($conn);
}

if (mysqli_query($conn, $sql2)) {
  echo "<br>Table login created successfully";
} 
else {
  echo "Error creating table: " . mysqli_error($conn);
}

if (mysqli_query($conn, $sql3)) {
  echo "<br>Table accommodation created successfully";
} 
else {
  echo "Error creating table: " . mysqli_error($conn);
}

if (mysqli_query($conn, $sql4)) {
  echo "<br>Table applicationForm created successfully";
} 
else {
  echo "Error creating table: " . mysqli_error($conn);
}

mysqli_close($conn);
?>