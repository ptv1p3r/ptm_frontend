<?php
/**
 * Created by PhpStorm.
 * User: V1p3r
 * Date: 21/11/2018
 * Time: 22:55
 */
?>
<?php if (!defined('ABSPATH')) exit; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--  CSS links -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
            integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
          integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">

    <!--  CSS custom que não pode ser apagado-->
    <link href="css/home/custom.css" rel="stylesheet">

    <!-- Template original CSS links -->

    <!--  <link href="css/home/color.css" rel="stylesheet">-->
    <!-- <link href="css/home/responsive.css" rel="stylesheet">-->
    <!-- <link href="css/home/owl.carousel.min.css" rel="stylesheet">-->
    <!-- <link href="css/home/bootstrap.min.css" rel="stylesheet">-->
    <!-- <link href="css/home/prettyPhoto.css" rel="stylesheet">-->
    <!-- <link href="css/home/all.min.css" rel="stylesheet">-->

    <!--  END CSS links -->
    <!--  Icon do template-->
    <link rel="icon" href="Images/home/favicon.png">

    <!--  Script auto-version-->
    <script src="<?php echo auto_version('../../js/global-functions.js'); ?>"></script>

    <title><?php echo $this->title ?></title>

</head>
<body>


<!-- left side of navbar
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <!- left side of navbar
    <div class="navbar-collapse ">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="navbar-brand" href="<?php //echo HOME_URI; ?>">
                <img src="../../Images/home.png" alt="Home" width="24" height="24"> </a>
            </li>
            <li class="nav-item">
                <a class="navbar-brand" href="<?php //echo HOME_URI; ?>">
                    <img src="../../Images/name.png" alt="Name" height="24"></a>
            </li>
        </ul>
        <!- right side of navbar
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <form class="form-inline" action="">
                    <a class="navbar-brand" href="<?php //echo HOME_URI . '/search/index/1_1'; ?>"><img src="../../Images/search.png" alt="Search" width="24" height="24"></a>
                </form>
            </li>
        </ul>
    </div>
</nav>
-->

<!--Header Start-->
<header class="header-style-2">
    <nav class="navbar navbar-expand-lg">
        <a class="navbar-brand" href="index.html"><img src="Images/home/h2logo.png" alt=""></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i
                    class="fas fa-bars"></i></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="index.html" role="button" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false"> Home </a>
                    <ul class="dropdown-menu">
                        <li><a href="index.html">Home One</a></li>
                        <li><a href="<?php echo HOME_URI . 'ptm_frontend/donation/donation-view.php'; ?>">TESTE CHANGE
                                PAGE</a></li>
                        <li><a href="Images/home/home-three.html">Home
                                Three</a></li>
                    </ul>
                </li>
                <li class="nav-item"><a class="nav-link"
                                        href="Images/home/about.html">About</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle"
                       href="Images/home/events-grid.html" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Events </a>
                    <ul class="dropdown-menu">
                        <li><a href="Images/home/events-grid.html">Events
                                Grid</a></li>
                        <li><a href="Images/home/events-grid-2.html">Events
                                Grid Two</a></li>
                        <li><a href="Images/home/events-grid-3.html">Events
                                Grid Three</a></li>
                        <li><a href="Images/home/events-list.html">Events
                                List</a></li>
                        <li><a href="Images/home/events-list-two.html">Events
                                List Two</a></li>
                        <li><a href="Images/home/event-details.html">Event
                                Details</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle"
                       href="Images/home/causes.html" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Causes </a>
                    <ul class="dropdown-menu">
                        <li><a href="Images/home/causes.html">Causes
                                Grid</a></li>
                        <li><a href="Images/home/causes-list.html">Causes
                                List</a></li>
                        <li><a href="Images/home/causes-details.html">Causes
                                Details</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle"
                       href="Images/home/blog.html" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Blogs </a>
                    <ul class="dropdown-menu">
                        <li><a href="Images/home/blog.html">Blog Default</a>
                        </li>
                        <li><a href="Images/home/blog-list.html">Blog
                                List</a></li>
                        <li><a href="Images/home/blog-grid.html">Blog
                                Grid</a></li>
                        <li><a href="Images/home/blog-two-col.html">Blog Two
                                Columns</a></li>
                        <li><a href="Images/home/blog-three-col.html">Blog
                                Three Columns</a></li>
                        <li><a href="Images/home/blog-details.html">Blog
                                Details</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false"> Pages </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#">Projects</a>
                            <ul class="dropdown-menu">
                                <li><a href="Images/home/projects.html">Projects</a>
                                </li>
                                <li>
                                    <a href="Images/home/projects-grid.html">Projects
                                        Grid</a></li>
                                <li>
                                    <a href="Images/home/projects-grid-two.html">Projects
                                        Grid Two</a></li>
                                <li>
                                    <a href="Images/home/projects-list.html">Projects
                                        List</a></li>
                                <li>
                                    <a href="Images/home/projects-details.html">Project
                                        Details</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">Shop</a>
                            <ul class="dropdown-menu">
                                <li><a href="Images/home/shop.html">Shop</a>
                                </li>
                                <li><a href="Images/home/shop-two.html">Shop
                                        Two</a></li>
                                <li><a href="Images/home/shop-details.html">Shop
                                        Details</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="Images/home/team.html">Team</a>
                            <ul class="dropdown-menu">
                                <li><a href="Images/home/team.html">Team
                                        One</a></li>
                                <li><a href="Images/home/team-two.html">Team
                                        Two</a></li>
                                <li><a href="Images/home/team-details.html">Team
                                        Details</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">Gallery</a>
                            <ul class="dropdown-menu">
                                <li><a href="Images/home/gallery-grid.html">Gallery
                                        Grid</a></li>
                                <li><a href="Images/home/gallery-full.html">Gallery
                                        Full</a></li>
                                <li>
                                    <a href="Images/home/gallery-masonry.html">Gallery
                                        Masonry</a></li>
                            </ul>
                        </li>
                        <li><a href="Images/home/testimonials.html">Testimonials</a>
                        </li>
                        <li><a href="Images/home/donation.html">Donation</a>
                        </li>
                        <li><a href="Images/home/my-account.html">My
                                Account</a></li>
                        <li><a href="Images/home/coming-soon.html">Coming
                                Soon</a></li>
                        <li><a href="Images/home/page-404.html">404
                                Error</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="contact.html" role="button" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false"> Contact </a>
                    <ul class="dropdown-menu">
                        <li><a href="Images/home/contact-one.html">Contact
                                One</a></li>
                        <li><a href="Images/home/contact-two.html">Contact
                                Two</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="topnav-right">
                <li><a class="mdonate"
                       href="Images/home/donation.html"><span>Make a Donation</span></a>
                </li>
                <li><a class="search-icon" href="#search"> <i class="fas fa-search"></i> </a></li>
                <li class="dropdown">
                    <a class="cart-icon" href="#" role="button" id="cartdropdown" data-toggle="dropdown"> <i
                                class="fas fa-shopping-cart"></i></a>
                    <div class="dropdown-menu cart-box" aria-labelledby="cartdropdown">
                        Recently added item(s)
                        <ul class="list">
                            <li class="item">
                                <a href="#" class="preview-image"><img class="preview" src="Images/home/pro.jpg" alt=""></a>
                                <div class="description"><a href="#">Sample Course</a> <strong class="price">1 x
                                        $44.95</strong></div>
                            </li>
                            <li class="item">
                                <a href="#" class="preview-image"><img class="preview" src="Images/home/pro.jpg" alt=""></a>
                                <div class="description"><a href="#">Sample Course</a> <strong class="price">1 x
                                        $44.95</strong></div>
                            </li>
                        </ul>
                        <div class="total">Total: <strong>$44.95</strong></div>
                        <div class="view-link"><a href="#">Proceed to Checkout</a> <a href="#">View cart </a></div>
                    </div>
                </li>
                <li class="login-reg"><a href="Images/home/my-account.html">Login</a>
                    | <a href="Images/home/my-account.html">Signup</a></li>
            </ul>
        </div>
    </nav>
</header>