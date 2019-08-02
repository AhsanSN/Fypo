<?
ini_set('session.cookie_lifetime', 60 * 60 * 24 * 100);
ini_set('session.gc_maxlifetime', 60 * 60 * 24 * 100);
ini_set('session.save_path', '/tmp');

session_start();

//maybe you want to precise the save path as well
include_once("./assets/database.php");

if (isset($_SESSION['email'])&&isset($_SESSION['password']))
{
        $session_password = $_SESSION['password'];
        $session_userId = $_SESSION['userId'];
        $session_email =  $_SESSION['email'];
        $query = "SELECT *  FROM fyp_users WHERE email='$session_email' AND password='$session_password'";
}
$result = $con->query($query);
if ($result->num_rows > 0){
    while($row = $result->fetch_assoc()) 
    {
    $logged=1;
    $session_userId = $row['id'];
    $session_name = $row['name'];
    $session_image = $row['userImg'];
    $session_email = $row['email'];
    }
    
}
else
{
        $logged=0;
}
?>


