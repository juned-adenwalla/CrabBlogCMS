<?php

function get_metaData($page, $meta){
    require('config.php');
    $sql = "SELECT * FROM `tblpages` WHERE `PageName` = '$page'";
    $query = mysqli_query($con, $sql);
    $count = mysqli_num_rows($query);
    if($count == 1){
        foreach($query as $data){
            return $data[$meta];
        }
    }
}

function get_Feeds($query='', $filter='', $no_of_records_per_page, $offset){
    require('config.php');
    if($query && $filter != ''){
        $sql = "SELECT * FROM `tblposts` WHERE `$query` = '$filter' AND `Is_Active` = 1 ORDER BY `PostingDate` DESC LIMIT $offset, $no_of_records_per_page";
    }
    else if($query != ''){
        $sql = "SELECT * FROM `tblposts` WHERE `Is_Active` = 1 AND `PostTitle` LIKE '%$query%' OR `PostDetails` LIKE '%$query%' ORDER BY `PostingDate` DESC LIMIT $offset, $no_of_records_per_page";
    }
    else{
        $sql = "SELECT * FROM `tblposts` WHERE `Is_Active` = 1 ORDER BY `PostingDate` DESC LIMIT $offset, $no_of_records_per_page";
    }
    $query = mysqli_query($con, $sql);
    if($query){
        $i = 0;
        foreach($query as $data){ $i++ ?>
             <div class="post-preview">
                        <a href="post/<?php echo $data['PostUrl']; ?>">
                            <h2 class="post-title"><?php echo $data['PostTitle']; ?></h2>
                            <h3 class="post-subtitle"><?php echo substr(strip_tags($data['PostDetails']), 0, 100); ?></h3>
                        </a>
                        <p class="post-meta">
                            Posted on
                            <a href="#!">
                            <?php $date = date_create($data['PostingDate']); echo date_format($date, 'F j Y \A\t g:i a'); ?></a>
                        </p>
                    </div>
                    <?php  if($i == $no_of_records_per_page){ ?>
                        <hr class="my-4 d-none" />
                    <?php }else{ ?>
                        <hr class="my-4" />
                    <?php }
        }
    }
}

function single_post($post, $filter){
    require('config.php');
    $sql = "SELECT * FROM `tblposts` WHERE `PostUrl` = '$post' AND `Is_Active` = 1";
    $query = mysqli_query($con, $sql);
    $count = mysqli_num_rows($query);
    if($count == 1){
        foreach($query as $data){
            return $data[$filter];
        }
    }
    else{
        header('Location:'.base_url('404'));
    }
}

function get_category($category, $filter){
    require('config.php');
    $sql = "SELECT * FROM `tblcategory` WHERE `id` = $category AND `Is_Active` = 1";
    $query = mysqli_query($con, $sql);
    $count = mysqli_num_rows($query);
    if($count == 1){
        foreach($query as $data){
            return $data[$filter];
        }
    }
}

function base_url($url){
    require('config.php');
    return "$base_url".$url;
}

function post_comment($postid, $name, $email, $comment, $st1){
    require('config.php');
    require('alerts.php');
    $query=mysqli_query($con,"insert into tblcomments(postId,name,email,comment,status) values('$postid','$name','$email','$comment','$st1')");
   if($query):
     $alert = new PHPAlert();
     $alert->success("Comment Successfull");
     unset($_SESSION['token']);
   else :
    echo "<script>alert('Something went wrong. Please try again.');</script>";  
    $alert = new PHPAlert();
     $alert->warn("Comment Failed");
   
   endif;
}

function get_comment($pid, $sts){
    require('config.php');
    $query=mysqli_query($con,"select name,comment,postingDate from  tblcomments where postId='$pid' and status='$sts'");
    while ($row=mysqli_fetch_array($query)) { ?>
        <div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card" style="padding: 15px; border-radius: 8px; height: auto; margin-top: 10px">
                <div class="d-flex justify-content-start mb-1">
                    <div class="float-left image">
                        <img src="http://bootdey.com/img/Content/user_1.jpg" class="img-circle avatar" style="width: 30px; margin-right: 10px" alt="user profile image">
                    </div>
                    <div class="float-left meta">
                        <div class="title h5" style="font-size: 14px">
                            <a href="#" ><b><?php echo htmlentities($row['name']);?></b></a>
                            made a comment.
                        </div>
                        <h6 class="text-muted time" style="margin-top: -5px; font-size: 12px"> Commented On : <b><?php $date = date_create(htmlentities($row['postingDate'])); echo date_format($date, 'F j Y');?></b> </h6>
                    </div>
                </div> 
                <div class="post-description" style="margin-top: -30px; font-size: 18px; line-height: 1.2"> 
                    <p><?php echo htmlentities($row['comment']);?></p>

                </div>
            </div>
        </div>
        
    </div></div><?php } 
}

function get_settings($filter){
    require('config.php');
    $sql = "SELECT * FROM `tblsettings`";
    $query = mysqli_query($con,$sql);
    if($query){
        foreach($query as $data){
            return $data[$filter];
        }
    }
}

function contact_form($name, $phone, $email, $message){
    require('config.php');
    require('alerts.php');
    $sql = "INSERT INTO `tblcontact`(`FullName`, `EmailId`, `PhoneNo`, `Message`) VALUES ('$name', '$email', '$phone', '$message')";
    $query = mysqli_query($con,$sql);
    if($query){
        $alert = new PHPAlert();
        $alert->success("Form Submitted");
    }
}

function get_ads($filter){
    require('config.php');
    $sql = "SELECT * FROM `tblads` WHERE `active` = 1";
    $query = mysqli_query($con,$sql);
    if($query){
        foreach($query as $data){
            return $data[$filter];
        }
    }
}

function install($dbhost, $dbname, $dbpass, $dbuser, $siteurl, $adminuser, $adminpassword, $adminemail){
    ini_set('display_errors', 1);
    require('alerts.php');
    if($dbhost && $dbname && $dbuser && $siteurl != ''){
        $temp_conn = new mysqli($dbhost, $dbuser, $dbpass);
        $enc_password = md5($adminpassword);
        if($temp_conn -> connect_errno){
            $alert = new PHPAlert();
            $alert->warn("Database Connection Failed");
            exit();
        }else{
            $db_tables = array(
                'db_server' => $dbhost,
                'db_username' => $dbuser,
                'db_password' => $dbpass,
                'db_name' => $dbname,
                'site_url' => $siteurl
            );
            
            $file_name = 'config.json';
            $db = "CREATE DATABASE IF NOT EXISTS $dbname";
            if($temp_conn->query($db)){
                $temp_conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

                $admin_table = "CREATE TABLE IF NOT EXISTS `tbladmin` (
                    `id` int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
                    `AdminUserName` varchar(255) NOT NULL,
                    `AdminPassword` varchar(255) NOT NULL,
                    `AdminEmailId` varchar(255) NOT NULL,
                    `Is_Active` int(11) NOT NULL,
                    `CreationDate` timestamp NOT NULL DEFAULT current_timestamp(),
                    `UpdationDate` timestamp NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
                  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

                $ad_table = "CREATE TABLE IF NOT EXISTS `tblads` (
                    `id` int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
                    `Ad_1` text NOT NULL,
                    `Ad_2` text NOT NULL,
                    `Varification` text NOT NULL,
                    `active` int(11) NOT NULL
                  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

                $category_table = "CREATE TABLE IF NOT EXISTS `tblcategory` (
                    `id` int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
                    `CategoryName` varchar(200) DEFAULT NULL,
                    `Description` mediumtext DEFAULT NULL,
                    `PostingDate` timestamp NULL DEFAULT current_timestamp(),
                    `UpdationDate` timestamp NULL DEFAULT NULL,
                    `Is_Active` int(1) DEFAULT NULL
                  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

                $comment_table = "CREATE TABLE IF NOT EXISTS `tblcomments` (
                    `id` int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
                    `postId` char(11) DEFAULT NULL,
                    `name` varchar(120) DEFAULT NULL,
                    `email` varchar(150) DEFAULT NULL,
                    `comment` mediumtext DEFAULT NULL,
                    `postingDate` timestamp NULL DEFAULT current_timestamp(),
                    `status` int(1) DEFAULT NULL
                  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
                  
                $contact_table = "CREATE TABLE IF NOT EXISTS `tblcontact` (
                    `id` int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
                    `FullName` varchar(50) NOT NULL,
                    `EmailId` varchar(100) NOT NULL,
                    `PhoneNo` varchar(20) NOT NULL,
                    `Message` varchar(250) NOT NULL,
                    `PostedAt` datetime NOT NULL DEFAULT current_timestamp()
                  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
                  
                $page_table = "CREATE TABLE IF NOT EXISTS `tblpages` (
                    `id` int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
                    `PageName` varchar(200) DEFAULT NULL,
                    `PageTitle` TEXT DEFAULT NULL,
                    `Description` TEXT DEFAULT NULL,
                    `PageBanner` varchar(100) DEFAULT NULL,
                    `MetaDescription` varchar(160) DEFAULT NULL,
                    `MetaKeywords` varchar(160) DEFAULT NULL,
                    `PostingDate` timestamp NULL DEFAULT current_timestamp(),
                    `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
                  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
                  
                $post_table = "CREATE TABLE IF NOT EXISTS `tblposts` (
                    `id` int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
                    `PostTitle` longtext DEFAULT NULL,
                    `CategoryId` int(11) DEFAULT NULL,
                    `SubCategoryId` int(11) DEFAULT NULL,
                    `PostDetails` text DEFAULT NULL,
                    `MetaDescription` varchar(200) NOT NULL,
                    `MetaKeywords` varchar(160) NOT NULL,
                    `PostingDate` timestamp NULL DEFAULT current_timestamp(),
                    `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
                    `Is_Active` int(1) DEFAULT NULL,
                    `PostUrl` mediumtext DEFAULT NULL,
                    `PostImage` varchar(255) DEFAULT NULL
                  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
                  
                $setting_table = "CREATE TABLE IF NOT EXISTS `tblsettings` (
                    `id` int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
                    `SiteName` varchar(50) DEFAULT NULL,
                    `SiteLogo` varchar(100) DEFAULT NULL,
                    `ResLogo` varchar(100) NOT NULL,
                    `Facebook` varchar(100) DEFAULT NULL,
                    `Twitter` varchar(100) DEFAULT NULL,
                    `Instagram` varchar(100) DEFAULT NULL,
                    `Linkedin` varchar(100) DEFAULT NULL,
                    `CustomCss` TEXT DEFAULT NULL
                  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

                $subcategory_table = "CREATE TABLE IF NOT EXISTS `tblsubcategory` (
                    `SubCategoryId` int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
                    `CategoryId` int(11) DEFAULT NULL,
                    `Subcategory` varchar(255) DEFAULT NULL,
                    `SubCatDescription` mediumtext DEFAULT NULL,
                    `PostingDate` timestamp NOT NULL DEFAULT current_timestamp(),
                    `UpdationDate` timestamp NULL DEFAULT NULL,
                    `Is_Active` int(1) DEFAULT NULL
                  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";  

                $subscribers_table = "CREATE TABLE IF NOT EXISTS `tblsubscribers` (
                    `id` int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
                    `email` varchar(255) DEFAULT NULL,
                    `active` int(11) DEFAULT NULL,
                    `created_at` timestamp NOT NULL DEFAULT current_timestamp()
                  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

                $tables = [$admin_table,$ad_table,$category_table,$comment_table,$contact_table,$page_table,$post_table,$setting_table,$subcategory_table,$subscribers_table];

                foreach($tables as $k => $sql){
                    $query = @$temp_conn->query($sql);
                
                    if(!$query){
                        $errors[] = "Table $k : Creation failed ($temp_conn->error)";
                    }
                    else{
                        $errors[] = "Table $k : Creation done";
                        $creation_done = true;
                    }
                }
                if($creation_done){
                    $admin_data = "INSERT INTO `tbladmin` (`id`, `AdminUserName`, `AdminPassword`, `AdminEmailId`, `Is_Active`) VALUES
                        (1, '$adminuser', '$enc_password', '$adminemail', 1);";

                    $ad_data = "INSERT INTO `tblads` (`id`, `Ad_1`, `Ad_2`, `Varification`, `active`) VALUES
                        (1, 'Insert Code', 'Insert Code', 'Insert Code', 1);";
                    $page_data =  "INSERT INTO `tblpages` (`id`, `PageName`, `PageTitle`, `Description`, `PageBanner`, `MetaDescription`, `MetaKeywords`) VALUES
                        (1, 'aboutus', 'Page Name', 'Page Description', '', 'Meta Description', 'Meta Keywords'),
                        (2, 'contactus', 'Page Name', 'Page Description', '', 'Meta Description', 'Meta Keywords'),
                        (3, 'homepage', 'Page Name', 'Page Description', '', 'Meta Description', 'Meta Keywords'),
                        (4, 'allpost', 'Page Name', 'Page Description', '', 'Meta Description', 'Meta Keywords')";    
                    $setting_data = "INSERT INTO `tblsettings` (`id`, `SiteName`, `SiteLogo`, `ResLogo`, `Facebook`, `Twitter`, `Instagram`, `Linkedin`) VALUES
                        (1, 'Site Title', '', '', 'https://facebook.com/yourpage', 'https://twitter.com/yourpage', 'https://instagram.com/yourpage', 'https://linkedin.com/yourpage');";      
                    $data = [$admin_data,$ad_data,$page_data,$setting_data];
                    
                    foreach($data as $k => $sql){
                        $query = @$temp_conn->query($sql);

                        if(!$query)
                            $errors[] = "Table $k : Creation failed ($temp_conn->error)";
                        else
                            $errors[] = "Table $k : Creation done";
                            $creation_done = true;
                    }
                    if($creation_done){
                        $json = file_put_contents(__DIR__.'/../config.json', json_encode($db_tables));
                        if(!file_exists('.htaccess')){
                            $content = "RewriteEngine On" ."\n";
                            $content .= "RewriteRule ^([^/\.]+)/([^/\.]+)?$ post.php?type=$1&post=$2" ."\n";
                            $content .= "RewriteCond %{REQUEST_FILENAME} !-f" ."\n";
                            $content .= "RewriteRule ^([^\.]+)$ $1.php [NC,L]" ."\n";
                            $content .= "ErrorDocument 404 /404.php" . "\n";
                            file_put_contents(__DIR__.'/../.htaccess', $content);
                        }
                        $delete_install = unlink(__DIR__.'/../install.php');
                        if($json){
                            $alert = new PHPAlert();
                            $alert->success("Installation Success");
                        }
                    }
                }
                else{
                    $alert = new PHPAlert();
                    $alert->warn("Installation Failed");
                }
            }
        }
    }
}

?>