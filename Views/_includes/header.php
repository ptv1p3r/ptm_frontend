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


    <!-- JQuery 3.6.0 -->
    <script src="https://code.jquery.com/jquery-3.6.0.js"
            integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <!--  CSS links -->
    <!-- BootStrap 4.1.3 -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!-- Popper 1.14.3 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
            integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
            crossorigin="anonymous"></script>
    <!-- Fontawesome 5.15.4 -->
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"
            integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc"
            crossorigin="anonymous"></script>
    <!-- Carrossell 2.3.4 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <!-- SweetAlerts 2 -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Polifill -->
    <!--      <script href="https://cdn.jsdelivr.net/npm/promise-polyfill@7/dist/polyfill.min.js%22%3E</script>-->

    <!-- Template original CSS links -->
    <!--  CSS custom que não pode ser apagado-->
    <link href="../../css/home/custom.css" rel="stylesheet">
    <!--    <link href="../../css/home/prettyPhoto.css" rel="stylesheet">-->

    <!--     <link href="css/home/color.css" rel="stylesheet">-->
    <!--     <link href="css/home/responsive.css" rel="stylesheet">-->
    <!--     <link href="css/home/owl.carousel.min.css" rel="stylesheet">-->
    <!--     <link href="css/home/bootstrap.min.css" rel="stylesheet">-->

    <!--     <link href="css/home/all.min.css" rel="stylesheet">-->

    <!--  END CSS links -->

    <!--     <script src="js/home/jquery-3.3.1.min.js"></script>-->


    <!--  Icon do template-->
    <link rel="icon" href="/Images/home/favicon.png">

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
        <a class="navbar-brand" href="<?php echo HOME_URL . '/'; ?>"><img src="../../Images/home/logo.png" alt=""></a>
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
                        <li><a href="<?php //echo HOME_URI . 'ptm_frontend/donation/donation-view.php'; ?>">
                                PAGE</a></li>
                        <li><a href="/Images/home/home-three.html">Home
                                Three</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle"
                       href="/Images/home/causes.html" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Causas </a>
                    <ul class="dropdown-menu">
                        <li><a href="/Images/home/causes.html">Causa
                                Grid</a></li>
                        <li><a href="/Images/home/causes-list.html">Causes
                                List</a></li>
                        <li><a href="/Images/home/causes-details.html">Causes
                                Details</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle"
                       href="Images/home/events-grid.html" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Eventos </a>
                    <ul class="dropdown-menu">
                        <li><a href="/Images/home/events-grid.html">Events
                                Grid</a></li>
                        <li><a href="/Images/home/events-grid-2.html">Events
                                Grid Two</a></li>
                        <li><a href="/Images/home/events-grid-3.html">Events
                                Grid Three</a></li>
                        <li><a href="/Images/home/events-list.html">Events
                                List</a></li>
                        <li><a href="/Images/home/events-list-two.html">Events
                                List Two</a></li>
                        <li><a href="/Images/home/event-details.html">Event
                                Details</a></li>
                    </ul>
                </li>
                <li class="nav-item"><a class="nav-link"
                                        href="/Images/home/about.html">Sobre</a>
                </li>

                <!--                <li class="nav-item dropdown">-->
                <!--                    <a class="nav-link dropdown-toggle"-->
                <!--                       href="/Images/home/blog.html" role="button"-->
                <!--                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Blogs </a>-->
                <!--                    <ul class="dropdown-menu">-->
                <!--                        <li><a href="/Images/home/blog.html">Blog Default</a>-->
                <!--                        </li>-->
                <!--                        <li><a href="/Images/home/blog-list.html">Blog-->
                <!--                                List</a></li>-->
                <!--                        <li><a href="/Images/home/blog-grid.html">Blog-->
                <!--                                Grid</a></li>-->
                <!--                        <li><a href="/Images/home/blog-two-col.html">Blog Two-->
                <!--                                Columns</a></li>-->
                <!--                        <li><a href="/Images/home/blog-three-col.html">Blog-->
                <!--                                Three Columns</a></li>-->
                <!--                        <li><a href="/Images/home/blog-details.html">Blog-->
                <!--                                Details</a></li>-->
                <!--                    </ul>-->
                <!--                </li>-->
                <!--                <li class="nav-item dropdown">-->
                <!--                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"-->
                <!--                       aria-haspopup="true" aria-expanded="false"> Pages </a>-->
                <!--                    <ul class="dropdown-menu">-->
                <!--                        <li>-->
                <!--                            <a href="#">Projects</a>-->
                <!--                            <ul class="dropdown-menu">-->
                <!--                                <li><a href="/Images/home/projects.html">Projects</a>-->
                <!--                                </li>-->
                <!--                                <li>-->
                <!--                                    <a href="/Images/home/projects-grid.html">Projects-->
                <!--                                        Grid</a></li>-->
                <!--                                <li>-->
                <!--                                    <a href="/Images/home/projects-grid-two.html">Projects-->
                <!--                                        Grid Two</a></li>-->
                <!--                                <li>-->
                <!--                                    <a href="/Images/home/projects-list.html">Projects-->
                <!--                                        List</a></li>-->
                <!--                                <li>-->
                <!--                                    <a href="/Images/home/projects-details.html">Project-->
                <!--                                        Details</a></li>-->
                <!--                            </ul>-->
                <!--                        </li>-->
                <!--                        <li>-->
                <!--                            <a href="#">Shop</a>-->
                <!--                            <ul class="dropdown-menu">-->
                <!--                                <li><a href="/Images/home/shop.html">Shop</a>-->
                <!--                                </li>-->
                <!--                                <li><a href="/Images/home/shop-two.html">Shop-->
                <!--                                        Two</a></li>-->
                <!--                                <li><a href="/Images/home/shop-details.html">Shop-->
                <!--                                        Details</a></li>-->
                <!--                            </ul>-->
                <!--                        </li>-->
                <!--                        <li>-->
                <!--                            <a href="/Images/home/team.html">Team</a>-->
                <!--                            <ul class="dropdown-menu">-->
                <!--                                <li><a href="/Images/home/team.html">Team-->
                <!--                                        One</a></li>-->
                <!--                                <li><a href="/Images/home/team-two.html">Team-->
                <!--                                        Two</a></li>-->
                <!--                                <li><a href="/Images/home/team-details.html">Team-->
                <!--                                        Details</a></li>-->
                <!--                            </ul>-->
                <!--                        </li>-->
                <!--                        <li>-->
                <!--                            <a href="#">Gallery</a>-->
                <!--                            <ul class="dropdown-menu">-->
                <!--                                <li><a href="/Images/home/gallery-grid.html">Gallery-->
                <!--                                        Grid</a></li>-->
                <!--                                <li><a href="/Images/home/gallery-full.html">Gallery-->
                <!--                                        Full</a></li>-->
                <!--                                <li>-->
                <!--                                    <a href="/Images/home/gallery-masonry.html">Gallery-->
                <!--                                        Masonry</a></li>-->
                <!--                            </ul>-->
                <!--                        </li>-->
                <!--                        <li><a href="/Images/home/testimonials.html">Testimonials</a>-->
                <!--                        </li>-->
                <!--                        <li><a href="/Images/home/donation.html">Donation</a>-->
                <!--                        </li>-->
                <!--                        <li><a href="/Images/home/my-account.html">My-->
                <!--                                Account</a></li>-->
                <!--                        <li><a href="/Images/home/coming-soon.html">Coming-->
                <!--                                Soon</a></li>-->
                <!--                        <li><a href="/Images/home/page-404.html">404-->
                <!--                                Error</a></li>-->
                <!--                    </ul>-->
                <!--                </li>-->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="contact.html" role="button" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false"> Contactos </a>
                    <ul class="dropdown-menu">
                        <li><a href="/Images/home/contact-one.html">Contact
                                One</a></li>
                        <li><a href="/Images/home/contact-two.html">Contact
                                Two</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="topnav-right">
                <li class="login-reg"><a href="" data-toggle="modal" data-target="#loginModal"></i> Login</a>
                    | <a href="<?php echo HOME_URL . '/user'; ?>">Signup</a>
                </li>
            </ul>
        </div>
    </nav>
</header>


<!-- Login Modal HTML -->
<div id="loginModal" class="modal fade">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-dialog modal-login">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="avatar">
                        <img src="../../../Images/home/logo.png" alt="Avatar">
                    </div>
                    <h4 class="modal-title">Login</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <input type="text" class="form-control" name="username" placeholder="Username"
                                   required="required">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password" placeholder="Password"
                                   required="required">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg btn-block login-btn">Login</button>
                        </div>
                    </form>
                    <div class="modal-footer">
                        <a href="#">Esqueces-te a password?</a>
                    </div>
                    <br>
                    <!--                    <div class="text-center text-muted delimiter">Usa a redes sociais</div>-->
                    <!--                    <div class="d-flex justify-content-center social-buttons">-->
                    <!--                        <button type="button" class="btn btn-secondary btn-round" data-toggle="tooltip"-->
                    <!--                                data-placement="top" title="Twitter">-->
                    <!--                            <i class="fab fa-twitter"></i>-->
                    <!--                        </button>-->
                    <!--                        <button type="button" class="btn btn-secondary btn-round" data-toggle="tooltip"-->
                    <!--                                data-placement="top" title="Facebook">-->
                    <!--                            <i class="fab fa-facebook"></i>-->
                    <!--                        </button>-->
                    <!--                        <button type="button" class="btn btn-secondary btn-round" data-toggle="tooltip"-->
                    <!--                                data-placement="top" title="Linkedin">-->
                    <!--                            <i class="fab fa-linkedin"></i>-->
                    <!--                        </button>-->
                    <!--                        </di>-->
                    <!--                    </div>-->
                    <!--                </div>-->
                    <div class="modal-footer">
                        <div class="modal-footer d-flex justify-content-center">
                            <div class="signup-section">Ainda não és membro? <a
                                        href="<?php echo HOME_URL . '/user'; ?>"
                                        class="text-info"> Sign Up</a>.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Login Modal HTML -->


<script>


</script>


