<?php include('includes/functions.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Page Not Found" />
    <meta property="og:image" content="<?php $data = call_user_func('get_metaData', 'homepage', 'PageBanner'); echo call_user_func('base_url', "admin/postimages/media/$data") ?>" />
    <title>Page Not Found</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet"
        type="text/css" />
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800"
        rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
</head>

<style>
    @charset "UTF-8";body{background:#fff;padding:0;margin:0;font-family:Helvetica,Arial,sans-serif}.container{background-color:#fff;margin:0 auto;text-align:center;padding-top:50px}h3{font-size:16px;color:#3498db;font-weight:700;text-align:center;line-height:130%}.buton{background:#3498db;padding:10px 20px;color:#fff;font-weight:700;text-align:center;border-radius:3px;text-decoration:none}a:hover{color:#ff0}span{font-size:14px;color:#fff;font-weight:400;text-align:center}span a{color:#ff0;text-decoration:none}span a:hover{color:red}@media screen and (max-width:500px){img{width:70%}.container{padding:70px 10px 10px}h3{font-size:14px}};
</style>

<body>
<div class="container">
<img class="ops" src="assets/img/404.svg" />
<br />
<br />
<h3>Maybe this page moved? Got deleted? Is hiding out in quarantine? Never existed in the first place?</h3>
<br />
<a class="buton" href="">Back to Homepage</a>
</div>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>

</html>