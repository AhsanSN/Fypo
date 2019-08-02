<?php

$host='localhost';
$username='anomser';
$user_pass='rasdasdasd+';
$database_in_use='ano_r';

$con = mysqli_connect($host,$username,$user_pass,$database_in_use);
if (!$con)
{
    echo"not connected";
}
if (!mysqli_select_db($con,$database_in_use))
{
    echo"database not selected";
}
?>