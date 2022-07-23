<nav style="position: absolute" class="navbar navbar-expand-lg navbar-light" id="mainNav">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="<?php echo call_user_func('base_url', ''); ?>"><img style="width: 180px" src="<?php $data = call_user_func('get_settings','SiteLogo'); echo call_user_func('base_url', "admin/postimages/media/$data");?>" alt="Logo"></a>
                <a class="navbar-brand-responsive" href="<?php echo call_user_func('base_url', 'index'); ?>"><img style="width: 180px" src="<?php $data = call_user_func('get_settings','ResLogo'); echo call_user_func('base_url', "admin/postimages/media/$data");?>" alt="Logo"></a>
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
                        <li class="nav-item navbar-brand-responsive"><a> <form action="<?php echo call_user_func('base_url', 'search.php'); ?>" method="get">
      <div class="d-flex" style="margin-top: 20px"><input class="form-control" style="height: 50px; border-radius: 8px" type="text" name="query" placeholder="Type to Search....">&nbsp;&nbsp;<button style="height: 50px;" type="submit" class="btn btn-primary"><img src="<?php echo call_user_func('base_url', 'assets/img/loupe.png'); ?>" style="width: 18px; margin-top: -8px" alt="search"></button></div>
      </form></a></li>
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