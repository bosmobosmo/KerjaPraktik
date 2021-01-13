<?php
session_start();

function Redirect($url, $permanent = false)
    {
        if (headers_sent() === false)
        {
            header('Location: ' . $url, true, ($permanent === true) ? 301 : 302);
        }

        exit();
    }

$userinfo = array(
                'admin'=>'AKKq3rJgRzb7RjYF'
                );

if(isset($_GET['logout'])) {
    $_SESSION['username'] = '';
    header('Location:  ' . $_SERVER['PHP_SELF']);
}

if(isset($_POST['username'])) {
    if($userinfo[$_POST['username']] == $_POST['password']) {
        $_SESSION['username'] = $_POST['username'];
    }else {
        //Invalid Login
    }
}
if(isset($_SESSION['username'])){
    Redirect('vrs_list.php',false);
}
?>

<!DOCTYPE html>
<html class="history svg video supports boxshadow csstransforms3d csstransitions backgroundcliptext gecko win js sticky-header-enabled sticky-header-negative sticky-header-active"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">

	<!-- Basic -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<title>IFOLIB - Informatics Open Library</title>

	<meta name="keywords" content="Open Library">
	<meta name="description" content="IFOLIB - Informatics Open Library">
	<meta name="author" content="ajiul.com">

	<!-- Favicon -->
	<link rel="shortcut icon" href="http://openlibrary.elearning-mb.site/img/favicon.ico" type="image/x-icon">
	<link rel="apple-touch-icon" href="http://openlibrary.elearning-mb.site/img/apple-touch-icon.png">

	<!-- Mobile Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">

	<!-- Web Fonts  -->
	<link href="IFOLIB%20-%20Informatics%20Open%20Library_files/css.css" rel="stylesheet" type="text/css">

	<!-- Vendor CSS -->
	<link rel="stylesheet" href="IFOLIB%20-%20Informatics%20Open%20Library_files/bootstrap.css">
	<link rel="stylesheet" href="IFOLIB%20-%20Informatics%20Open%20Library_files/all.css">
	<link rel="stylesheet" href="IFOLIB%20-%20Informatics%20Open%20Library_files/animate.css">
	<link rel="stylesheet" href="IFOLIB%20-%20Informatics%20Open%20Library_files/simple-line-icons.css">
	<link rel="stylesheet" href="IFOLIB%20-%20Informatics%20Open%20Library_files/owl.css">
	<link rel="stylesheet" href="IFOLIB%20-%20Informatics%20Open%20Library_files/owl_002.css">
	<link rel="stylesheet" href="IFOLIB%20-%20Informatics%20Open%20Library_files/magnific-popup.css">

	<!-- Theme CSS -->
	<link rel="stylesheet" href="IFOLIB%20-%20Informatics%20Open%20Library_files/theme.css">
	<link rel="stylesheet" href="IFOLIB%20-%20Informatics%20Open%20Library_files/theme-elements.css">
	<link rel="stylesheet" href="IFOLIB%20-%20Informatics%20Open%20Library_files/theme-blog.css">
	<link rel="stylesheet" href="IFOLIB%20-%20Informatics%20Open%20Library_files/theme-shop.css">

	<!-- Current Page CSS -->
	<link rel="stylesheet" href="IFOLIB%20-%20Informatics%20Open%20Library_files/settings.css">
	<link rel="stylesheet" href="IFOLIB%20-%20Informatics%20Open%20Library_files/layers.css">
	<link rel="stylesheet" href="IFOLIB%20-%20Informatics%20Open%20Library_files/navigation.css">

	<!-- Demo CSS -->
	<link rel="stylesheet" href="IFOLIB%20-%20Informatics%20Open%20Library_files/demo-education.css">

	<!-- Skin CSS -->
	<link rel="stylesheet" href="IFOLIB%20-%20Informatics%20Open%20Library_files/skin-education.css">

	<!-- Theme Custom CSS -->
	<link rel="stylesheet" href="IFOLIB%20-%20Informatics%20Open%20Library_files/custom.css">

    <!-- Form CSS -->
    <link rel="stylesheet" href="IFOLIB%20-%20Informatics%20Open%20Library_files/form.css">

	<!-- Head Libs -->
	<script async="" src="IFOLIB%20-%20Informatics%20Open%20Library_files/analytics.js"></script><script src="IFOLIB%20-%20Informatics%20Open%20Library_files/modernizr.js"></script>

<script type="text/javascript" async="" src="IFOLIB%20-%20Informatics%20Open%20Library_files/js15_as.js"></script></head>

<body>

	<div class="body">	    
        <div role="main" class="main">
            <!--Form-->
            <section class="section bg-color-light border-0 my-0">
                <div class="container">
                    <div class="row justify-content-start form">
                        <div class="col-md-12 text-3">
                            <form action="" method="post" id="request" name="login">  
                                <h3 class="font-weight-semibold text-5">Username:</h3>
                                <input class="font-weight-semibold" type="text" name="username" tabIndex="1" required><br>
                                <h3 class="font-weight-semibold text-5">Password:</h3>
                                <input class="font-weight-semibold" type="password" name="password" tabIndex="2" required><br>
                                <input type="submit" name="submit" value="Submit">
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
	</div>
</body></html>