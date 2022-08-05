<?php echo call_user_func('get_ads', 'Varification'); 
include('includes/config.php');
include('includes/alerts.php');
if(isset($_POST['subscribe'])){
  $email = $_POST['email'];
  if($email != ''){
    $sql = "SELECT * FROM `tblsubscribers` WHERE `email` = '$email'";
    $query = mysqli_query($con,$sql);
    $count = mysqli_num_rows($query);
    if($count > 1){
      $alert = new PHPAlert();
      $alert->warn("Allready Subscribed");
    }else{
      $sql = "INSERT INTO `tblsubscribers`(`email`, `active`) VALUES ('$email', 1)";
      $query = mysqli_query($con, $sql);
      if($query){
        $alert = new PHPAlert();
        $alert->success("Subscribed Successfully");
      }
      else{
        $alert = new PHPAlert();
        $alert->warn("Subscription Failed");
      }
    }
  }
}

?>
<nav style="position: absolute" class="navbar navbar-expand-lg navbar-light" id="mainNav">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="<?php echo call_user_func('base_url', ''); ?>"><img class="logo" style="width: 180px" src="<?php $data = call_user_func('get_settings','SiteLogo'); echo call_user_func('base_url', "admin/postimages/media/$data");?>" alt="Logo"></a>
                <a class="navbar-brand-responsive" href="<?php echo call_user_func('base_url', 'index'); ?>"><img class="rlogo" style="width: 180px" src="<?php $data = call_user_func('get_settings','ResLogo'); echo call_user_func('base_url', "admin/postimages/media/$data");?>" alt="Logo"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto py-4 py-lg-0">
                        <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="<?php echo call_user_func('base_url', ''); ?>">Home</a></li>
                        <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="<?php echo call_user_func('base_url', 'all-posts'); ?>">All Posts</a></li>
                        <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="<?php echo call_user_func('base_url', 'about-us'); ?>">About Us</a></li>
                        <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="<?php echo call_user_func('base_url', 'contact-us'); ?>">Contact Us</a></li>
                        <li class="nav-item navbar-brand"><a data-bs-toggle="modal" data-bs-target="#exampleModal" class="nav-link px-lg-3 py-3 py-lg-4"><img  src="<?php echo call_user_func('base_url', 'assets/img/loupe.png'); ?>" style="width: 18px; cursor:pointer; margin-top: -15px " alt="search"></a></li>
                        <li class="nav-item navbar-brand"><a data-bs-toggle="modal" data-bs-target="#newsletter" class="nav-link px-lg-3 py-3 py-lg-4"><img  src="<?php echo call_user_func('base_url', 'assets/img/letter.png'); ?>" style="width: 24px; cursor:pointer; margin-top: -15px; margin-left: -30px " alt="search"></a></li>
                        <li class="nav-item navbar-brand-responsive"><a> <form action="<?php echo call_user_func('base_url', 'search.php'); ?>" method="get">
      <div class="d-flex" style="margin-top: 20px"><input class="form-control" style="height: 50px; border-radius: 8px" type="text" name="query" placeholder="Type to Search....">&nbsp;&nbsp;<button style="height: 50px;" type="submit" class="btn btn-primary"><img src="<?php echo call_user_func('base_url', 'assets/img/loupe.png'); ?>" style="width: 18px; margin-top: -8px" alt="search"></button></div>
      </form></a></li>
      <li class="nav-item navbar-brand-responsive"><a data-bs-toggle="modal" data-bs-target="#newsletter" style="margin-top: 20px; border-radius: 8px" class="btn btn-success nav-link px-lg-3 py-3 py-lg-4 text-white"><img  src="<?php echo call_user_func('base_url', 'assets/img/letter.png'); ?>" style="width: 24px; cursor:pointer; margin-top: -5px; margin-left: -30px " alt="search">&nbsp;&nbsp;&nbsp;Subscribe Newsletter</a></li>   
                    </ul>
                </div>
            </div>
        </nav>

  <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style="border-radius: 6px">
      <div class="modal-body">
        <form action="<?php echo call_user_func('base_url', 'search.php'); ?>" method="get">
      <div class="d-flex"><input class="form-control" style="height: 50px; border-radius: 8px" type="text" name="query" placeholder="Type to Search....">&nbsp;&nbsp;<button style="height: 50px;" type="submit" class="btn btn-primary"><img src="<?php echo call_user_func('base_url', 'assets/img/loupe.png'); ?>" style="width: 18px; margin-top: -8px" alt="search"></button></div>
      </form>
      </div>
    </div>
  </div>
</div>

<!-- Newsletter -->
<div class="modal fade" id="newsletter" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style="border-radius: 6px">
      <div class="modal-body">
      <section class="fdb-block bg-gray">
      <form action="" method="post">
  <div class="container">
    <div class="row justify-content-center">
      <div class="text-center">
        <img alt="image" height="60" src="admin/assets/images/icons/mail.png">
        <h3 style="margin-top: 20px">Subscribe Newsletter</h3>
        <div class="input-group mt-4 mb-4">  
          <input type="text" style="border-radius: 8px" name="email" class="form-control" placeholder="Enter your email address">
          <div class="input-group-append">
            &nbsp;&nbsp;<button class="btn btn-primary" name="subscribe" type="submit"><img height="20px" src="assets/img/sub.png" alt="subscribe"></button>
          </div>
        </div>
        <p class="h6 text-muted"><em>*Your email address is safe with us. We never share your email address with anyone.</em></p>
      </div>
    </div>
  </div>
  </form>
</section>
      </div>
    </div>
  </div>
</div>