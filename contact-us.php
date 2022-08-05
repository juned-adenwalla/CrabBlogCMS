<?php include('includes/functions.php');

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];
    if($name && $email && $phone && $message == ''){
        echo "All Feilds are Required";
    }
    else{
        call_user_func('contact_form', $name, $phone, $email, $message);
    }
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="<?php echo call_user_func('get_metaData', 'contactus', 'MetaDescription'); ?>" />
        <meta name="keywords" content="<?php echo call_user_func('get_metaData', 'contactus', 'MetaKeywords'); ?>" />
        <meta property="og:image" content="<?php $data = call_user_func('get_metaData', 'contactus', 'PageBanner'); echo call_user_func('base_url', "admin/postimages/media/$data") ?>" />   
        <title><?php echo call_user_func('get_metaData', 'contactus', 'PageTitle'); ?></title>
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
        <header class="masthead" style="background-image: url(<?php $data = call_user_func('get_metaData', 'contactus', 'PageBanner'); echo call_user_func('base_url', "admin/postimages/media/$data") ?>)">
            <div class="container position-relative px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <div class="page-heading">
                            <h1>Contact Us</h1>
                            <span class="subheading">Have questions? We have answers.</span>
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
                        <div class="my-5">
                            <?php echo call_user_func('get_metaData', 'contactus', 'Description'); ?>
                            <form id="contactForm" method="POST" action="">
                                <div class="form-floating">
                                    <input class="form-control" id="name" name="name" type="text" placeholder="Enter your name..." required/>
                                    <label for="name">Name</label>
                                </div>
                                <div class="form-floating">
                                    <input class="form-control" id="email" type="email" name="email" placeholder="Enter your email..." required/>
                                    <label for="email">Email address</label>
                                </div>
                                <div class="form-floating">
                                    <input class="form-control" id="phone" type="tel" name="phone" placeholder="Enter your phone number..." required/>
                                    <label for="phone">Phone Number</label>
                                </div>
                                <div class="form-floating">
                                    <textarea class="form-control" id="message" name="message" placeholder="Enter your message here..." style="height: 10rem" required></textarea>
                                    <label for="message">Message</label>
                                </div>
                                <br />
                                <!-- Submit Button-->
                                <input class="btn btn-primary text-uppercase" id="submitButton" name="submit" type="submit" value="Send">
                            </form>
                        </div>
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
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- * *                               SB Forms JS                               * *-->
        <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </body>
</html>
