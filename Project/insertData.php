<?php
 
//like a header file, to create connection to database 
require_once ("config.php");
 

//User information
$sql = "INSERT INTO users(userid, fullName, ic, DOB, age, gender, email, homeAddress, phone) 
VALUES('AU1001', 'AQUA HOSHINO', '000711-01-1140', '2000-07-11', '23', 'MALE', 'aquahoshino@gmail.com', '02A, JALAN OSHI, 34750, SKUDAI', '011-853123231');";  //admin
$sql .= "INSERT INTO users(userid, fullName, ic, DOB, age, gender, email, homeAddress, phone) 
VALUES('BU2001', 'JACK SULLY', '900120-01-1223', '1990-01-20', '33', 'MALE', 'jacksully@gmail.com', '12,JALAN MALL, 34750, SKUDAI', '012-3456789');";          //manager
$sql .= "INSERT INTO users(userid, fullName, ic, DOB, age, gender, email, homeAddress, phone) 
VALUES('BU2002', 'LUCY FILIA', '960401-01-1140', '1996-04-01', '27', 'FEMALE', 'lucyfilia@gmail.com', '13L, JALAN DINO, 34750, SKUDAI', '019-878908654');";    //manager
$sql .= "INSERT INTO users(userid, fullName,  ic, DOB, age, gender, email, homeAddress, phone) 
VALUES('SU001', 'RENGOKU KYOJURO', '010528-01-1143', '2001-05-28', '22', 'MALE', 'rengoku@gmail.com', '10Q, JALAN REN, 34750, SKUDAI', '019-23437684');";      //student
$sql .= "INSERT INTO users(userid, fullName,  ic, DOB, age, gender, email, homeAddress, phone) 
VALUES('SU002', 'RUBY HOSHINO', '020711-01-1140', '2002-07-11', '21', 'FEMALE', 'rubyhoshino@gmail.com', '11A, JALAN OSHI, 34750, SKUDAI', '017-112887933');"; //student
$sql .= "INSERT INTO users(userid, fullName, ic, DOB, age, gender, email, homeAddress, phone) 
VALUES('SU003', 'SAWADA TSUNA', '010901-01-0981', '2001-09-10', '22', 'MALE', 'sawadatsuna@gmail.com', '15K, JALAN REBORN, 34750, SKUDAI', '013-5792468');";   //student
$sql .= "INSERT INTO users(userid, fullName,  ic, DOB, age, gender, email, homeAddress, phone) 
VALUES('SU004', 'WENDY WU', '010420-01-1140', '2001-04-20', '22', 'FEMALE', 'wendywu@gmail.com', '10A, JALAN LINE, 34750, SKUDAI', '019-87654321');";          //student

//Login data
$sql .= "INSERT INTO login(username, password, userlevel, userid) VALUES('AQUA', 'ah123', 1, 'AU1001');";        //admin
$sql .= "INSERT INTO login(username, password, userlevel, userid) VALUES('JACK', 'js123', 3, 'BU2001');";       //manager
$sql .= "INSERT INTO login(username, password, userlevel, userid) VALUES('LUCY', 'lf123', 3, 'BU2002');";       //manager
$sql .= "INSERT INTO login(username, password, userlevel, userid) VALUES('RENGOKU', 'rg123', 2, 'SU001');";    //student
$sql .= "INSERT INTO login(username, password, userlevel, userid) VALUES('RUBY', 'rh123', 2, 'SU002');";       //student
$sql .= "INSERT INTO login(username, password, userlevel, userid) VALUES('SAWADA', 'st123', 2, 'SU003');";     //student
$sql .= "INSERT INTO login(username, password, userlevel, userid) VALUES('WENDY', 'ww123', 2, 'SU004');";      //student





$sql .=  "INSERT INTO accommodation(collegeid, collegeName, blockName, roomType, roomNo, available) VALUES('AM01', 'KOLEJ HITMAN REBORN', 'HR1', 'SINGLE ROOM', 101, 'EMPTY');";
$sql .=  "INSERT INTO accommodation(collegeid, collegeName, blockName, roomType, roomNo, available) VALUES('AM01', 'KOLEJ HITMAN REBORN', 'HR2', 'SINGLE ROOM', 102, 'EMPTY');";
$sql .=  "INSERT INTO accommodation(collegeid, collegeName, blockName, roomType, roomNo, available) VALUES('AM01', 'KOLEJ HITMAN REBORN', 'HR3', 'SINGLE ROOM', 103, 'EMPTY');";
$sql .=  "INSERT INTO accommodation(collegeid, collegeName, blockName, roomType, roomNo, available) VALUES('AM01', 'KOLEJ HITMAN REBORN', 'HR4', 'DOUBLE ROOM', 104, 'EMPTY');";
$sql .=  "INSERT INTO accommodation(collegeid, collegeName, blockName, roomType, roomNo, available) VALUES('AM01', 'KOLEJ HITMAN REBORN', 'HR5', 'DOUBLE ROOM', 105, 'EMPTY');";
$sql .=  "INSERT INTO accommodation(collegeid, collegeName, blockName, roomType, roomNo, available) VALUES('AM01', 'KOLEJ HITMAN REBORN', 'HR6', 'DOUBLE ROOM', 106, 'EMPTY');";

$sql .=  "INSERT INTO accommodation(collegeid, collegeName, blockName, roomType, roomNo, available) VALUES('BM01', 'KOLEJ FAIRY TAIL', 'FT1', 'SINGLE ROOM', 201, 'EMPTY');";
$sql .=  "INSERT INTO accommodation(collegeid, collegeName, blockName, roomType, roomNo, available) VALUES('BM01', 'KOLEJ FAIRY TAIL', 'FT2', 'SINGLE ROOM', 202, 'EMPTY');";
$sql .=  "INSERT INTO accommodation(collegeid, collegeName, blockName, roomType, roomNo, available) VALUES('BM01', 'KOLEJ FAIRY TAIL', 'FT3', 'SINGLE ROOM', 203, 'EMPTY');";
$sql .=  "INSERT INTO accommodation(collegeid, collegeName, blockName, roomType, roomNo, available) VALUES('BM01', 'KOLEJ FAIRY TAIL', 'FT4', 'DOUBLE ROOM', 204, 'EMPTY');";
$sql .=  "INSERT INTO accommodation(collegeid, collegeName, blockName, roomType, roomNo, available) VALUES('BM01', 'KOLEJ FAIRY TAIL', 'FT5', 'DOUBLE ROOM', 205, 'EMPTY');";
$sql .=  "INSERT INTO accommodation(collegeid, collegeName, blockName, roomType, roomNo, available) VALUES('BM01', 'KOLEJ FAIRY TAIL', 'FT6', 'DOUBLE ROOM', 206, 'EMPTY');";
$sql .=  "INSERT INTO accommodation(collegeid, collegeName, blockName, roomType, roomNo, available) VALUES('BM01', 'KOLEJ FAIRY TAIL', 'FT7', 'DOUBLE ROOM', 207, 'EMPTY');";





//with the exist of config.php, can use $conn
if (mysqli_multi_query($conn, $sql)) {
    echo "New records created successfully";
} 
else {
    echo "Error record" . mysqli_error($conn);
}
    

mysqli_close($conn);
?>