<?php
#
$serverName = 'localhost';
$username = 'root';
$password = '';
$dbName = 'carservice';
#
# creating the connection...
$connection = mysqli_connect($serverName, $username, $password, $dbName);
#
# checking the connection...
if(!$connection){
    die("Connection failed: ".mysqli_connect_error());
}
