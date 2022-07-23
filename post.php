<?php 
session_start();
include('includes/functions.php');
if(!isset($_GET['post'])){
    header('location:index.php');
}
$post = $_GET['post'];
if (empty($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
}
$postid = call_user_func('single_post', $post, 'id');   
if(isset($_POST['submit'])){
    //Verifying CSRF Token
    if(!empty($_POST['csrftoken'])) {
       if(hash_equals($_SESSION['token'], $_POST['csrftoken'])) {
            $name=$_POST['name'];
            $email=$_POST['email'];
            $comment=$_POST['comment'];
            $st1='0';
            call_user_func('post_comment', $postid, $name, $email, $comment, $st1);
   }
   }
   }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="<?php echo call_user_func('single_post', $post, 'MetaDescription'); ?>" />
    <meta name="keywords" content="<?php echo call_user_func('single_post', $post, 'MetaKeywords'); ?>" />
    <meta property="og:image" content="<?php echo call_user_func('base_url', 'admin/postimages/'); ?><?php echo call_user_func('single_post', $post, 'PostImage'); ?>" />
    <title><?php echo call_user_func('single_post', $post, 'PostTitle'); ?></title>
    <link rel="icon" type="image/x-icon" href="<?php echo call_user_func('base_url', 'assets/favicon.ico'); ?>" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet"
        type="text/css" />
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800"
        rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="<?php echo call_user_func('base_url', 'css/styles.css'); ?>" rel="stylesheet" />
</head>
<style>

</style>

<body>
    <!-- Navigation-->
    <?php include('includes/header.php'); ?>
    <!-- Page Header-->
    <header class="masthead"
        style="background-image: url('<?php echo call_user_func('base_url', 'admin/postimages/'); ?><?php echo call_user_func('single_post', $post, 'PostImage'); ?>')">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="post-heading">
                        <h1><?php echo call_user_func('single_post', $post, 'PostTitle'); ?></h1>
                        <span style="margin-top: 20px; margin-bottom: 10px" class="meta">Category : <a
                                href="#"><?php $cat_id = call_user_func('single_post', $post, 'CategoryId'); echo call_user_func('get_category', $cat_id, 'CategoryName'); ?></a></span>
                        <span class="meta">
                            Posted on
                            <a
                                href="#!"><?php $date = date_create(call_user_func('single_post', $post, 'PostingDate')); echo date_format($date, 'F j Y \A\t g:i a');?></a>
                        </span>
                        <div class="d-flex justify-content-start mb-4" style="margin-top: 20px">
                            <a data-action="share/whatsapp/share"
                                href="https://api.whatsapp.com/send?text=<?php echo call_user_func('base_url', 'post/'.$post); ?>"
                                target="_blank"><img
                                    src="<?php echo call_user_func('base_url', 'assets/img/whatsapp.png'); ?>"
                                    style="width: 30px; background-color: white; border-radius: 6px"
                                    alt="Whatsapp"></a>&nbsp;&nbsp;&nbsp;
                            <a href="http://www.facebook.com/sharer.php?u=<?php echo call_user_func('base_url', 'post/'.$post); ?>"
                                target="_blank"><img
                                    src="<?php echo call_user_func('base_url', 'assets/img/facebook.png'); ?>"
                                    style="width: 30px; background-color: white; border-radius: 6px" alt="Facebook"></a>
                            &nbsp;&nbsp;&nbsp;
                            <a href="http://twitter.com/share?url=<?php echo call_user_func('base_url', 'post/'.$post); ?>"
                                target="_blank"><img
                                    src="<?php echo call_user_func('base_url', 'assets/img/twitter.png'); ?>"
                                    style="width: 30px; background-color: white; border-radius: 6px"
                                    alt="Twitter"></a>&nbsp;&nbsp;&nbsp;
                            <a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo call_user_func('base_url', 'post/'.$post); ?>"
                                target="_blank"><img
                                    src="<?php echo call_user_func('base_url', 'assets/img/linkedin.png'); ?>"
                                    style="width: 30px; background-color: white; border-radius: 6px"
                                    alt="Linkedin"></a>&nbsp;&nbsp;&nbsp;
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Post Content-->
    <article class="mb-4">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <?php echo call_user_func('get_ads', 'Ad_1'); ?>
                    <?php echo call_user_func('single_post', $post, 'PostDetails'); ?>
                    <?php echo call_user_func('get_ads', 'Ad_2'); ?>
                    <div class="row" style="margin-top: 0%">
                        <!-- <div class="d-flex justify-content-start mb-1"><a class="btn btn-primary text-uppercase"
                                data-bs-toggle="modal" data-bs-target="#commentModal"><img
                                    src="<?php echo call_user_func('base_url', 'assets/img/comment.png'); ?>"
                                    style="width: 30px" alt="comment">&nbsp;&nbsp; Post Comments</a></div> -->
                        <div class="d-flex justify-content-start mb-4" style="margin-top: 10px">
                            <a href="https://api.whatsapp.com/send?text=<?php echo call_user_func('base_url', 'post/'.$post); ?>"
                                target="_blank"><img
                                    src="<?php echo call_user_func('base_url', 'assets/img/whatsapp.png'); ?>"
                                    style="width: 30px; background-color: white; border-radius: 6px"
                                    alt="Whatsapp"></a>&nbsp;&nbsp;&nbsp;
                            <a href="http://www.facebook.com/sharer.php?u=<?php echo call_user_func('base_url', 'post/'.$post); ?>"
                                target="_blank"><img
                                    src="<?php echo call_user_func('base_url', 'assets/img/facebook.png'); ?>"
                                    style="width: 30px; background-color: white; border-radius: 6px" alt="Facebook"></a>
                            &nbsp;&nbsp;&nbsp;
                            <a href="http://twitter.com/share?url=<?php echo call_user_func('base_url', 'post/'.$post); ?>"
                                target="_blank"><img
                                    src="<?php echo call_user_func('base_url', 'assets/img/twitter.png'); ?>"
                                    style="width: 30px; background-color: white; border-radius: 6px"
                                    alt="Twitter"></a>&nbsp;&nbsp;&nbsp;
                            <a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo call_user_func('base_url', 'post/'.$post); ?>"
                                target="_blank"><img
                                    src="<?php echo call_user_func('base_url', 'assets/img/linkedin.png'); ?>"
                                    style="width: 30px; background-color: white; border-radius: 6px"
                                    alt="Linkedin"></a>&nbsp;&nbsp;&nbsp;
                        </div>
                        <h5 class="card-header">Leave a Comment:</h5>
                        <div class="card-body">
                            <form name="Comment" method="post">
                                <input type="hidden" name="csrftoken"
                                    value="<?php echo htmlentities($_SESSION['token']); ?>" />
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control"
                                        placeholder="Enter your fullname" required>
                                </div>

                                <div class="form-group" style="margin-top: 10px">
                                    <input type="email" name="email" class="form-control"
                                        placeholder="Enter your Valid email" required>
                                </div>


                                <div class="form-group" style="margin-top: 10px">
                                    <textarea class="form-control" name="comment" rows="3" placeholder="Comment"
                                        required></textarea>
                                </div>
                                <button style="margin-top: 10px" type="submit" class="btn btn-primary"
                                    name="submit">Submit</button>
                            </form>
                        </div>
                        <?php call_user_func('get_comment', $postid, 1); ?>
                    </div>
                </div>

            </div>
        </div>
        </div>
    </article>
    <!-- Footer-->
    <?php include('includes/footer.php'); ?>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="<?php echo call_user_func('base_url', 'js/scripts.js'); ?>"></script>
    <script>
    $(document).ready(function() {
        $('#comments').hide();
        $('#showcomment').on('click', function() {
            $('#comments').toggle();
        });
    });
    </script>
</body>

</html>