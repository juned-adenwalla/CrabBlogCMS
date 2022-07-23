<?php 
session_start();
include('includes/config.php');
include('../includes/functions.php');
error_reporting(0);
if(strlen($_SESSION['login'])==0)
  { 
header('location:index.php');
}
else{
if(isset($_POST['update']))
{
$sitetitle=$_POST['sitetitle'];
$facebook=$_POST['facebook'];
$twitter=$_POST['twitter'];
$instagram = $_POST['instagram'];
$linkedin = $_POST['linkedin'];

if($_FILES["sitelogo"]["name"] && $_FILES["reslogo"]["name"]){
    $imgfile=$_FILES["sitelogo"]["name"];
    $extension = substr($imgfile,strlen($imgfile)-4,strlen($imgfile));
    $logo=md5($imgfile).$extension;
    move_uploaded_file($_FILES["sitelogo"]["tmp_name"],"postimages/media/".$logo);


    $resfile=$_FILES["reslogo"]["name"];
    $rextension = substr($resfile,strlen($resfile)-4,strlen($resfile));
    $rlogo=md5($resfile).$rextension;
    move_uploaded_file($_FILES["reslogo"]["tmp_name"],"postimages/media/".$rlogo);
    $query=mysqli_query($con,"update tblsettings set SiteName='$sitetitle',`ResLogo` = '$rlogo', `SiteLogo` ='$logo', `Facebook` = '$facebook', `Instagram` = '$instagram', `Twitter` = '$twitter', `Linkedin` = '$linkedin' where id= 1 ");

}
else if($_FILES["sitelogo"]["name"]){
    $imgfile=$_FILES["sitelogo"]["name"];
    $extension = substr($imgfile,strlen($imgfile)-4,strlen($imgfile));
    $logo=md5($imgfile).$extension;
    move_uploaded_file($_FILES["sitelogo"]["tmp_name"],"postimages/media/".$logo);
    $query=mysqli_query($con,"update tblsettings set SiteName='$sitetitle', `SiteLogo`='$logo', `Facebook` = '$facebook', `Instagram` = '$instagram', `Twitter` = '$twitter', `Linkedin` = '$linkedin' where id= 1 ");
}
else if($_FILES["reslogo"]["name"]){
    $resfile=$_FILES["reslogo"]["name"];
    $rextension = substr($resfile,strlen($resfile)-4,strlen($resfile));
    $rlogo=md5($resfile).$rextension;
    move_uploaded_file($_FILES["reslogo"]["tmp_name"],"postimages/media/".$rlogo);
    $query=mysqli_query($con,"update tblsettings set SiteName='$sitetitle',`ResLogo` = '$rlogo', `Facebook` = '$facebook', `Instagram` = '$instagram', `Twitter` = '$twitter', `Linkedin` = '$linkedin' where id= 1 ");
}
else{
    $query=mysqli_query($con,"update tblsettings set SiteName='$sitetitle', `Facebook` = '$facebook', `Instagram` = '$instagram', `Twitter` = '$twitter', `Linkedin` = '$linkedin' where id= 1 ");
}
if($query)
{
$msg="Settings successfully updated ";
}
else{
$error="Something went wrong . Please try agSiteLogo='$imgnewfile',ain.";    
} 

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">

    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <!-- App title -->
    <title>Site Settings | <?php echo call_user_func('get_settings','SiteName');?></title>

    <!-- Summernote css -->
    <link href="../plugins/summernote/summernote.css" rel="stylesheet" />

    <!-- Select2 -->
    <link href="../plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />

    <!-- Jquery filer css -->
    <link href="../plugins/jquery.filer/css/jquery.filer.css" rel="stylesheet" />
    <link href="../plugins/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css" rel="stylesheet" />

    <!-- App css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="../plugins/switchery/switchery.min.css">
    <script src="assets/js/modernizr.min.js"></script>

</head>


<body class="fixed-left">

    <!-- Begin page -->
    <div id="wrapper">

        <!-- Top Bar Start -->
        <?php include('includes/topheader.php');?>
        <!-- ========== Left Sidebar Start ========== -->
        <?php include('includes/leftsidebar.php');?>
        <!-- Left Sidebar End -->



        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <div class="container">


                    <div class="row">
                        <div class="col-xs-12">
                            <div class="page-title-box">
                                <h4 class="page-title">Site Settings </h4>
                                <ol class="breadcrumb p-0 m-0">
                                    <li>
                                        <a href="#">Pages</a>
                                    </li>

                                    <li class="active">
                                        Site Settings
                                    </li>
                                </ol>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->

                    <div class="row">
                        <div class="col-sm-6">
                            <!---Success Message--->
                            <?php if($msg){ ?>
                            <div class="alert alert-success" role="alert">
                                <strong>Well done!</strong> <?php echo htmlentities($msg);?>
                            </div>
                            <?php } ?>

                            <!---Error Message--->
                            <?php if($error){ ?>
                            <div class="alert alert-danger" role="alert">
                                <strong>Oh snap!</strong> <?php echo htmlentities($error);?>
                            </div>
                            <?php } ?>


                        </div>
                    </div>
                    <?php 
$pagetype='homepage';
$query=mysqli_query($con,"select * from tblsettings where id= 1");
while($row=mysqli_fetch_array($query))
{

?>

                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <div class="p-6">
                                <div class="">
                                    <form name="aboutus" enctype="multipart/form-data" method="post">
                                        <div class="form-group m-b-20">
                                            <label for="exampleInputEmail1">Site Title</label>
                                            <input type="text" class="form-control" id="pagetitle" name="sitetitle"
                                                value="<?php echo htmlentities($row['SiteName'])?>" required>
                                        </div>

                                        <div class="form-group m-b-20">
                                            <label for="exampleInputEmail1">Site Logo</label>
                                            <input type="file" class="form-control" id="logo" name="sitelogo">
                                            <img src="postimages/media/<?php echo htmlentities($row['SiteLogo'])?>"
                                                alt="logo">
                                        </div>

                                        <div class="form-group m-b-20">
                                            <label for="exampleInputEmail1">Site Logo (Responsive)</label>
                                            <input type="file" class="form-control" id="reslogo" name="reslogo">
                                            <img src="postimages/media/<?php echo htmlentities($row['ResLogo'])?>"
                                                alt="logo">
                                        </div>

                                        <div class="form-group m-b-20">
                                            <label for="exampleInputEmail1">Facebook page</label>
                                            <input type="text" class="form-control" id="pagetitle" name="facebook"
                                                value="<?php echo htmlentities($row['Facebook'])?>" required>
                                        </div>

                                        <div class="form-group m-b-20">
                                            <label for="exampleInputEmail1">Instagram page</label>
                                            <input type="text" class="form-control" id="pagetitle" name="instagram"
                                                value="<?php echo htmlentities($row['Instagram'])?>" required>
                                        </div>

                                        <div class="form-group m-b-20">
                                            <label for="exampleInputEmail1">Linkedin Page</label>
                                            <input type="text" class="form-control" id="pagetitle" name="linkedin"
                                                value="<?php echo htmlentities($row['Linkedin'])?>" required>
                                        </div>

                                        <div class="form-group m-b-20">
                                            <label for="exampleInputEmail1">Twitter Account</label>
                                            <input type="text" class="form-control" id="pagetitle" name="twitter"
                                                value="<?php echo htmlentities($row['Twitter'])?>" required>
                                        </div>

                                        <?php } ?>

                                        <button type="submit" name="update"
                                            class="btn btn-success waves-effect waves-light">Update and Post</button>

                                    </form>
                                </div>
                            </div> <!-- end p-20 -->
                        </div> <!-- end col -->
                    </div>
                    <!-- end row -->



                </div> <!-- container -->

            </div> <!-- content -->

            <?php include('includes/footer.php');?>

        </div>


        <!-- ============================================================== -->
        <!-- End Right content here -->
        <!-- ============================================================== -->


    </div>
    <!-- END wrapper -->



    <script>
    var resizefunc = [];
    </script>

    <!-- jQuery  -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/detect.js"></script>
    <script src="assets/js/fastclick.js"></script>
    <script src="assets/js/jquery.blockUI.js"></script>
    <script src="assets/js/waves.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="../plugins/switchery/switchery.min.js"></script>

    <!--Summernote js-->
    <script src="../plugins/summernote/summernote.min.js"></script>
    <!-- Select 2 -->
    <script src="../plugins/select2/js/select2.min.js"></script>
    <!-- Jquery filer js -->
    <script src="../plugins/jquery.filer/js/jquery.filer.min.js"></script>

    <!-- page specific js -->
    <script src="assets/pages/jquery.blog-add.init.js"></script>

    <!-- App js -->
    <script src="assets/js/jquery.core.js"></script>
    <script src="assets/js/jquery.app.js"></script>

    <script>
    jQuery(document).ready(function() {

        $('.summernote').summernote({
            height: 240, // set editor height
            minHeight: null, // set minimum height of editor
            maxHeight: null, // set maximum height of editor
            focus: false // set focus to editable area after initializing summernote
        });
        // Select2
        $(".select2").select2();

        $(".select2-limiting").select2({
            maximumSelectionLength: 2
        });
    });
    </script>
    <script src="../plugins/switchery/switchery.min.js"></script>

    <!--Summernote js-->
    <script src="../plugins/summernote/summernote.min.js"></script>




</body>

</html>
<?php } ?>