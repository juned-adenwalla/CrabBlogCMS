<?php include('includes/functions.php');?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="<?php echo call_user_func('get_metaData', 'aboutus', 'MetaDescription') ?>" />
        <meta name="author" content="<?php echo call_user_func('get_metaData', 'aboutus', 'MetaKeywords') ?>" />
        <meta property="og:image" content="<?php $data = call_user_func('get_metaData', 'aboutus', 'PageBanner'); echo call_user_func('base_url', "admin/postimages/media/$data") ?>" />
        <title><?php echo call_user_func('get_metaData', 'aboutus', 'PageTitle') ?></title>
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body>
        <!-- Navigation-->
        <?php include('includes/header.php'); ?>
        <!-- Page Header-->
        <header class="masthead" style="background-image: url(<?php $data = call_user_func('get_metaData', 'aboutus', 'PageBanner'); echo call_user_func('base_url', "admin/postimages/media/$data") ?>)">
            <div class="container position-relative px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <div class="page-heading">
                            <h1>About Us</h1>
                            <span class="subheading">We hope you enjoyed what we do.</span>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main Content-->
        <main class="mb-4">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                    <?php echo call_user_func('get_metaData', 'aboutus', 'Description') ?>
                    </div>
                </div>
            </div>
        </main>
        <!-- Footer-->
        <?php include('includes/footer.php'); ?>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
