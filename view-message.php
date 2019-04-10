<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['emplogin'])==0)
    {   
header('location:index.php');
}
else{
if(isset($_POST['apply']))
{
$empid=$_SESSION['eid'];
 $leavetype=$_POST['leavetype'];
$fromdate=$_POST['fromdate'];  
$todate=$_POST['todate'];
$description=$_POST['description'];  
$status=0;
$isread=0;
if($fromdate > $todate){
                $error=" ToDate should be greater than FromDate ";
           }
$sql="INSERT INTO tblleaves(LeaveType,ToDate,FromDate,Description,Status,IsRead,empid) VALUES(:leavetype,:fromdate,:todate,:description,:status,:isread,:empid)";
$query = $dbh->prepare($sql);
$query->bindParam(':leavetype',$leavetype,PDO::PARAM_STR);
$query->bindParam(':fromdate',$fromdate,PDO::PARAM_STR);
$query->bindParam(':todate',$todate,PDO::PARAM_STR);
$query->bindParam(':description',$description,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->bindParam(':isread',$isread,PDO::PARAM_STR);
$query->bindParam(':empid',$empid,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$msg="Leave applied successfully";
}
else 
{
$error="Something went wrong. Please try again";
}

}

    ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Title -->
        <title>Employe | Apply task</title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
        <meta charset="UTF-8">
        <meta name="description" content="Responsive Admin Dashboard Template" />
        <meta name="keywords" content="admin,dashboard" />
        <meta name="author" content="Steelcoders" />
        
        <!-- Styles -->
        <link type="text/css" rel="stylesheet" href="assets/plugins/materialize/css/materialize.min.css"/>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="assets/plugins/material-preloader/css/materialPreloader.min.css" rel="stylesheet"> 
        <link href="assets/css/alpha.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/custom.css" rel="stylesheet" type="text/css"/>
  <style>
        .errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
        </style>
 


    </head>
    <body>
  <?php include('includes/header.php');?>
            
       <?php include('includes/sidebar.php');?>
   <main class="mn-inner">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="page-title"><b>Task Manage</b></div>
                    </div>
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-content">
           
<h3>Message Details View</h3>
<?php 
$m_id=$_GET['id']; 
$query="Select * from task where `t_id`='".$m_id."' ";
    $res=mysqli_query($conn,$query);
    $count=mysqli_num_rows($res);
    if($count>0)
    $row=mysqli_fetch_array($res);

?>

<div class="col-sm-12" style="background-color: #402407;padding: 15px">
<?php echo $row['task'];?>
</div>
<div class="col-sm-12">
<br>
<?php 
if(isset($_REQUEST['m_reply'])){
    $mid=$_POST['m_id'];
    $User_id=$_POST['User_id'];
    $reply=mysqli_real_escape_string($conn,$_POST['m_reply']);
    
    $query="insert into `task_reply` (`r_id`,`reply`,`m_id`,`reply_by`) values('','$reply','$mid','$User_id')";
    $res=mysqli_query($conn,$query);
    if($res){
        echo "Reply Inserted";
}else{
    echo"Reply not inserted,please try again";
}   
    
}
?>
<form action="" method="post">
<fieldset>

<input type="hidden" name="m_id" value="<?php echo $m_id;?>">
<input type="hidden" name="User_id" value="<?php echo $_SESSION['User_id'];?>">

<div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label"><h3>Write your Reply:</h3></label>
      <div class="col-lg-10">
<textarea name="m_reply" rows="5" style="width:100%;background:#d9d9d9;padding:5px;">
</textarea>
</div>
</div>
    <div class="form-group">
      <div class="col-lg-10 col-lg-offset-2">
        <button type="submit" class="btn btn-primary" style="background-color: #402407;">Submit Reply</button>
      </div>
    </div>
</form>
</div>
<div class="col-sm-12">
<fieldset>
<p>&nbsp;</p>
<?php $m_id=$_GET['id']; 
    $query1="Select * from `task_reply`  join `users` on `users`.`User_id`=`task_reply`.`reply_by` where `m_id`='".$m_id."' ";
    $res1=mysqli_query($conn,$query1);
    $count1=mysqli_num_rows($res1);
    while($row1=mysqli_fetch_array($res1)){
?>
<div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label"><h3>&nbsp;</h3></label>
      <div class="col-lg-10">
    
<div class="col-sm-12" style="background:#f9f9f9;padding:15px;">
<?php echo $row1['Name'].':- '.$row1['reply'];?>
</div>
    
      </div>
      </fieldset>
      </div>
      <?php  }
    ?>

                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div class="left-sidebar-hover"></div>
        
        <!-- Javascripts -->
        <script src="assets/plugins/jquery/jquery-2.2.0.min.js"></script>
        <script src="assets/plugins/materialize/js/materialize.min.js"></script>
        <script src="assets/plugins/material-preloader/js/materialPreloader.min.js"></script>
        <script src="assets/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="assets/js/alpha.min.js"></script>
        <script src="assets/js/pages/form_elements.js"></script>
          <script src="assets/js/pages/form-input-mask.js"></script>
                <script src="assets/plugins/jquery-inputmask/jquery.inputmask.bundle.js"></script>
    </body>
</html>
<?php } ?> 