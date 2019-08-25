<?require "global.php";
if ($logged==0){ 
    ?>
    <script type="text/javascript">
            window.location = "./";
        </script>
    <?
}
?>

<?
//get all my projects
$query_myProjects = "select * from fyp_projects where userId='$session_userId';
    "; 
    $result_myProjects = $con->query($query_myProjects);
    $noProjects = true;
    if ($result_myProjects->num_rows > 0)
    { 
        while($row = $result_myProjects->fetch_assoc()) 
        { 
            $proj_id = $row['id'];
            $proj_name = $row['name'];
            $proj_tagline = $row['tagLine'];
            $noProjects = false;
        }
    }
    
//get all posts
$query_myProjPosts = "select * from fyp_posts p where p.projId='$proj_id' and (p.title!='' or p.content!='' or p.image!='') and p.status='' order by p.id desc;
    "; 
?>

<?
//uploading posts
if(isset($_POST["title"])||isset($_POST["content"])||isset($_POST["image"])){
    $title = $_POST["title"];
    $content = $_POST["content"];
    $projId = $proj_id;
    $timePosted = time();
    
    extract($_POST);
    $error=array();
    $images=array();
    $extension=array("jpeg","jpg","png","gif");
    foreach($_FILES["files"]["tmp_name"] as $key=>$tmp_name) {
        $file_name=$_FILES["files"]["name"][$key];
        $file_tmp=$_FILES["files"]["tmp_name"][$key];
        $ext=pathinfo($file_name,PATHINFO_EXTENSION);

        if(in_array($ext,$extension)) {
            $filename=basename($file_name,$ext);
            $newFileName=$filename.time().".".$ext;
            move_uploaded_file($file_tmp=$_FILES["files"]["tmp_name"][$key],"photo_gallery/".$newFileName);
            array_push($images,$newFileName);
        }
        else {
            array_push($error,"$file_name, ");
        }
    }
    
    foreach($images as $image) {
        $sql="insert into fyp_posts(`projId`, `userId`, `title`, `content`, `image`, `timePosted`) values ('$projId', '$session_userId', '$title', '$content', '$image', '$timePosted')";
        if(!mysqli_query($con,$sql))
        {
        echo"can not";
        }
    }
    //if no image
    if(count($images)==0){
        $sql="insert into fyp_posts(`projId`, `userId`, `title`, `content`, `timePosted`) values ('$projId', '$session_userId', '$title', '$content', '$timePosted')";
        if(!mysqli_query($con,$sql))
        {
        echo"can not";
        }
    }

}

//delete post

if(isset($_GET["deletePost"])){
    $post_del = $_GET["deletePost"];
    $sql="update fyp_posts set status='deleted' where id='$post_del'";
        if(!mysqli_query($con,$sql))
        {
        echo"can not";
        }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Fypo - Anomoz Softwares</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">
    <meta name="msapplication-tap-highlight" content="no">
<link href="./newMain.css" rel="stylesheet">
<link href="https://demo.dashboardpack.com/architectui-html-pro/main.cba69814a806ecc7945a.css" rel="stylesheet">

</head>
<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        <?require "./phpParts/upperBar.php"?>     
        
        <div class="app-main">
                 <?require "./phpParts/leftBar.php"?>
                <div class="app-main__outer">
                    <div class="app-main__inner row">
                        <div id="feed" class="col-lg-7">
                        <!--here goes content-->
                        <?if(isset($_GET['posted'])){?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                    Your post was posted successfully.
                                                </div>
                        <?}?>
                                                
                        <?if($noProjects){
                            ?>
                            <div class="app-page-title">
                            <div class="page-title-wrapper">
                                <div class="page-title-heading">
                                    <div class="page-title-icon">
                                        <i class="pe-7s-rocket icon-gradient bg-tempting-azure">
                                        </i>
                                    </div>
                                    <div>Create your first project
                                        <div class="page-title-subheading">
                                            Let the world know about your brilliant ideas by creating your first project.
                                        </div>
                                    </div>
                                </div>
                                <div class="page-title-actions">
                                    <div class="d-inline-block">
                                        <a href="./newProject">
                                            <button type="button" class="btn-shadow btn btn-info">
                                                Create new Project
                                            </button>
                                        </a>
                                    </div>
                                </div>    </div>
                        </div>
                            <?
                        }
                        else{
                            ?>
                            <div class="main-card mb-3 card">
                            <div class="card-body"><h5 class="card-title">Create Post</h5>
                                <form class="" action="./home?posted=1" method="post" enctype="multipart/form-data">
                                    <div class="position-relative form-group"><input name="title" id="examplePassword" placeholder="Title" type="text" class="form-control" ></div>
                                    <div class="position-relative form-group">
                                    <textarea name="content" id="exampleEmail" placeholder="What's happening?" type="text" class="form-control" ></textarea></div>
                                    
                                            <label for="exampleEmail" class="">Upload images (if any)</label>
                                            <div class="mt-12 btn ">
                                                <input id="exampleFile" type="file" name="files[]" multiple class="form-control-file mt-12 btn btn-primary"/>
                                            </div>
                                    <button class="mt-12 btn btn-success">Post</button>
                                </form>
                            </div>
                        </div>
                        
                            <!--show all posts-->
                            <?
                            $result_myProjPosts = $con->query($query_myProjPosts);
                            if ($result_myProjPosts->num_rows > 0)
                            { 
                                while($row = $result_myProjPosts->fetch_assoc())
                                {
                                    date_default_timezone_set("Asia/Karachi");
                                    $newDateTime = date('d/M/Y H:i: A',$row['timePosted']);
                                    //$newDateTime = date('h:i A', strtotime($currentDateTime));
                                    
                                    ?>
                                    <div class="main-card mb-3 card">
                                        <div class="card-header-tab card-header">
                                        <div class="card-header-title">
                                            <i class="header-icon lnr-rocket icon-gradient bg-tempting-azure"> </i>
                                            <?echo $row['title']?> - <?echo $newDateTime?> 
                                        </div>
                                        <div class="btn-actions-pane-right">
                                            <div class="nav">
                                                <a href="./home?deletePost=<?echo $row['id']?>" class="ml-1 btn-pill btn-wide border-0 btn-transition  btn btn-outline-alternate second-tab-toggle-alt">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                    
                                            <div class="card-body">
                                                <p><?echo $row['content']?></p>
                                                <?if($row['image']!=''){?>
                                                <img src="./photo_gallery/<?echo $row['image']?>" style="width:100%;">
                                                <?}?>
                                                </div>
                                        </div>
                                    <?
                                    
                                }
                            }
                            ?>
                            
                            <?
                        }
                        ?>
                        </div>
                        <div id="feed" class="col-lg-4 col-sm-0">
                        <!--here goes content-->
                  
                        
                        </div>
                    </div>
                    <div class="app-wrapper-footer">
                        <div class="app-footer">
                            <div class="app-footer__inner">
                                
                                <div class="app-footer-right">
                                    <ul class="nav">
                                        
                                        <li class="nav-item">
                                            <a href="https://www.anomoz.com" class="nav-link">
                                                <!--
                                                <div class="badge badge-success mr-1 ml-0">
                                                    <small>NEW</small>
                                                </div>
                                                -->
                                                Built by Anomoz Softwares
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>    
                </div>
        </div>
    </div>
<script type="text/javascript" src="./assets/scripts/main.js"></script>
</body>
</html>
