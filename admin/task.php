<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{



 ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Title -->
        <title>Admin | Total Task </title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
        <meta charset="UTF-8">
        <meta name="description" content="Responsive Admin Dashboard Template" />
        <meta name="keywords" content="admin,dashboard" />
        <meta name="author" content="Steelcoders" />
        
        <!-- Styles -->
        <link type="text/css" rel="stylesheet" href="../assets/plugins/materialize/css/materialize.min.css"/>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="../assets/plugins/material-preloader/css/materialPreloader.min.css" rel="stylesheet">
        <link href="../assets/plugins/datatables/css/jquery.dataTables.min.css" rel="stylesheet">

                <link href="../assets/plugins/google-code-prettify/prettify.css" rel="stylesheet" type="text/css"/>  
        <!-- Theme Styles -->
        <link href="../assets/css/alpha.min.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/css/custom.css" rel="stylesheet" type="text/css"/>
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
                        <span style="font-size:18px;"><b>Allot task</b></span>
                        <hr>
                    </div>
                   
                    
                        <div class="card col-xs-10">
                            <div class="card-content">
                                
                                <form class="form-horizontal" method="post" action="insert task.php" onsubmit="return formvalidation();">
  <fieldset>
    
    <!--leftbox-->
    <div class="col-xs-6" style="background-color: #402407;padding:15px;">
        <div class="form-group">
      <label class="col-xs-12"><b>Employee List<b></label>
      <input type="hidden" name="assign_by" value="<?php echo $_SESSION['User_id']; ?>">
      <div class="col-lg-10">
        <?php
        $query="Select * from users where `role`='employee' order by User_id DESC ";
    $res=mysqli_query($conn,$query);
    $count=mysqli_num_rows($res);
    while($row=mysqli_fetch_array($res))
    {
        ?>
        <div class="checkbox">
          <label>
            <input type="checkbox" name="emp[]" id="department" value="<?php echo $row['User_id']?>" >
            <?php echo $row['Name']?>
          </label>
        </div>
    <?php }?>
      </div>
    </div>
    </div>

    <!--Rightbox-->
    <div class="col-xs-6">
    <div class="form-group">
      <label for="text" class="col-lg-12"><b>Message</b></label>
      <div class="col-lg-12">
        <textarea class="form-control" rows="10" name="message" placeholder="Message/Text"  style="background-color:#d9d9d9; padding:5px;">
      </textarea>
      </div>
    </div>
    
    </div>  
    
    
        <div class="form-group">
      <div class="col-lg-12 col-lg-offset-3">
        <button type="reset" class="btn btn-default">Cancel</button>
        <button type="submit" class="btn btn-primary"  style="background-color: #402407;">Submit</button>
      </div>
    </div>
  </fieldset>
</div>
  </form>





                            </div>
                        </div>
                  
                </div>
            </main>
         
        </div>
        <div class="left-sidebar-hover"></div>
        
        <!-- Javascripts -->
        <script src="../assets/plugins/jquery/jquery-2.2.0.min.js"></script>
        <script src="../assets/plugins/materialize/js/materialize.min.js"></script>
        <script src="../assets/plugins/material-preloader/js/materialPreloader.min.js"></script>
        <script src="../assets/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="../assets/plugins/datatables/js/jquery.dataTables.min.js"></script>
        <script src="../assets/js/alpha.min.js"></script>
        <script src="../assets/js/pages/table-data.js"></script>
         <script src="assets/js/pages/ui-modals.js"></script>
        <script src="assets/plugins/google-code-prettify/prettify.js"></script>
        
    </body>
</html>
<?php } ?>