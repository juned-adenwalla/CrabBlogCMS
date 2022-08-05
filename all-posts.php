<?php include('includes/functions.php');
include('includes/config.php'); 
if (isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
} else {
    $pageno = 1;
}
$no_of_records_per_page = 10;
$offset = ($pageno-1) * $no_of_records_per_page; 
$total_pages_sql = "SELECT COUNT(*) FROM `tblposts` WHERE `Is_Active` = 1";
$result = mysqli_query($con,$total_pages_sql);
$total_rows = mysqli_fetch_array($result)[0];
$total_pages = ceil($total_rows / $no_of_records_per_page);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="<?php echo call_user_func('get_metaData', 'allpost', 'MetaDescription') ?>" />
        <meta name="keywords" content="<?php echo call_user_func('get_metaData', 'allpost', 'MetaKeywords') ?>" />
        <meta property="og:image" content="<?php $data = call_user_func('get_metaData', 'allpost', 'PageBanner'); echo call_user_func('base_url', "admin/postimages/media/$data") ?>" />
        <title><?php echo call_user_func('get_metaData', 'allpost', 'PageTitle') ?></title>
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
        <!-- Navigation-->
<?php include('includes/header.php'); ?>
    </head>
    <style>
<?php echo call_user_func('get_settings','CustomCss');?>
</style>
    <body>
        <!-- Page Header-->
        <header class="masthead" style="background-image: url(<?php $data = call_user_func('get_metaData', 'allpost', 'PageBanner'); echo call_user_func('base_url', "admin/postimages/media/$data") ?>)">
            <div class="container position-relative px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <div class="site-heading">
                            <?php echo call_user_func('get_metaData', 'allpost', 'Description') ?>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main Content-->
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <?php echo call_user_func('get_Feeds','', '', $no_of_records_per_page, $offset) ?>
                    <!-- Pager-->
                    <div class="d-flex justify-content-start mb-4"><a class="btn btn-primary text-uppercase <?php if($pageno <= 1){ echo 'd-none'; } ?>" href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">← New Posts</a>&nbsp;&nbsp;<a class="btn btn-primary text-uppercase <?php if($pageno >= $total_pages){ echo 'invisible'; } ?>" href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Older Posts →</a></div>
                </div>
            </div>
        </div>
        <!-- Footer-->
        <?php include('includes/footer.php'); ?>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
