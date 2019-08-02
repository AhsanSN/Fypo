<?include_once("global.php");?>
    <?
if(isset($_POST['email'])&&isset($_POST['password'])){
    $errMsg="none";
    $email = (($_POST['email']));
    $password = ( md5(md5(sha1( $_POST['password'])).'Anomoz'));
    $query_selectedPost= "select * from fyp_users where email= '$email' and password='$password'"; 
    $result_selectedPost = $con->query($query_selectedPost); 
    if ($result_selectedPost->num_rows > 0)
    { 
        //successfull login
        while($row = $result_selectedPost->fetch_assoc()) 
        { 
            $logged=1;
            $_SESSION['email'] = $email;
            $_SESSION['userId'] = $row['id'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['password'] = $row['password'];
            ?>
            <script type="text/javascript">
            if (window.location.search.indexOf('fallBack') > -1) {
                var url_string = window.location.href; //window.location.href
                var url = new URL(url_string);
                var c = url.searchParams.get("fallBack");
                window.location = c;
                //window.location = "./home?askldnasd";
            }else{
                window.location = "./home";
            }
            
                
            </script>
            <?
        }
    }
    else{
        // is email being used
        $query_selectedPost= "select * from fyp_users where email= '$email'"; 
        $result_selectedPost = $con->query($query_selectedPost); 
        if ($result_selectedPost->num_rows > 0)
        { 
            //problem diagnosed: email correct, incorrect pass
            $errMsg = "Incorrect password.";
        }else{
            //emaail not taken. create new account
            /**
            $dateTime = time();
            $userId = intval((strval(1)).(strval(mt_rand(111111111, 999999999))));
            $sql="insert into fyp_users (`id`, `name`,`email`, `password`, `userImg`) values ('$userId', 'User','$email', '$password', 'profilePic.png')";
            if(!mysqli_query($con,$sql))
            {
                echo "err";
            }
            else{
                 $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;
            
                ?>
            <script type="text/javascript">
                window.location = "./home";
            </script>
            <?
            
            }
            **/
            
            
        }
        
        
    }

}
else{
    //do nothing
    1;
}
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" media="screen" href="./assets/login.css" />
</head>
<body class='login'>


<img class="logo" height="75" width="35" src="/assets/logo.png" alt="Digitalocean logo white" />
<form class="vertical-form sign-in" id="sign-in" action="" accept-charset="UTF-8" method="post"><input name="utf8" type="hidden" value="&#x2713;" /><input type="hidden" name="authenticity_token" value="hdUVjCES74CVhwLA0M6Rl/fmZL8gCTIy/JOGWwpYcCPh11MccSGihLZL9ScOsIjn6hzPRuEskcM+46RVnsAPuA==" /><input type="hidden" name="i" id="i" />
<input type="hidden" name="browser" id="browser" value="" />
<input type="hidden" name="operating_system" id="operating_system" value="" />
<input type="hidden" name="timezone_offset" id="timezone_offset" value="" />

<legend>
Sign In
</legend>
<input type="email" placeholder="Email Address" label="false" spellcheck="false" class="is-sensitive" value="" name="email" id="user_email" required />
<input placeholder="Password" label="false" autocomplete="off" class="is-sensitive" type="password" name="password" id="user_password" required/>
<input type="submit" name="commit" value="Sign In" />
</form>
<div class='footer'>
<p>
Don't have an account?
<a href="/signup">Create one now</a>
</p>
</div>

</body>
</html>
