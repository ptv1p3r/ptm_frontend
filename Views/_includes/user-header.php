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
    <!-- Popper 1.14.3 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
            integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
            crossorigin="anonymous"></script>
    <!-- BootStrap 4.1.3 -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!-- Fontawesome 5.15.4 -->
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"
            integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc"
            crossorigin="anonymous"></script>
    <!-- BootStrap 3.6.1 toogle handler -->
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css"
          rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
    <!-- Twitter Bootstrap 4.1.1 -->
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/js/bootstrap.js"></script>

    <!-- Carrossell 2.3.4 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <!-- SweetAlerts 2 -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Polifill -->
    <!--      <script href="https://cdn.jsdelivr.net/npm/promise-polyfill@7/dist/polyfill.min.js%22%3E</script>-->
    <!-- Leaflet lib 1.8.0 -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css"
          integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ=="
          crossorigin=""/>
    <!-- Leaflet javascript lib 1.8.0 -->
    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"
            integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ=="
            crossorigin=""></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.13.5/js/standalone/selectize.min.js"
            integrity="sha512-JFjt3Gb92wFay5Pu6b0UCH9JIOkOGEfjIi7yykNWUwj55DBBp79VIJ9EPUzNimZ6FvX41jlTHpWFUQjog8P/sw=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.13.5/css/selectize.bootstrap5.min.css"
          integrity="sha512-w4sRMMxzHUVAyYk5ozDG+OAyOJqWAA+9sySOBWxiltj63A8co6YMESLeucKwQ5Sv7G4wycDPOmlHxkOhPW7LRg=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <!-- Bootstrap tables lib 1.20.2 -->
    <link href="https://unpkg.com/bootstrap-table@1.20.2/dist/bootstrap-table.min.css" rel="stylesheet">
    <!-- dataTables -->


<!--    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>-->
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
    <!--<script src="https://cdn.datatables.net/rowreorder/1.2.8/js/dataTables.rowReorder.min.js"></script>-->
    <link rel="stylesheet" href="https://cdn.datatables.net/colreorder/1.5.6/js/dataTables.colReorder.min.js">
    <script src="https://cdn.datatables.net/plug-ins/1.12.1/i18n/pt-PT.json"></script>
<!--    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css">-->


    <!-- Template original CSS links -->
    <!--  CSS custom que não pode ser apagado-->
    <link href="<?php echo HOME_URL . '/'; ?>css/home/custom.css" rel="stylesheet">
    <!--    <link href="../../css/home/prettyPhoto.css" rel="stylesheet">-->

    <!--     <link href="css/home/color.css" rel="stylesheet">-->
    <!--     <link href="css/home/responsive.css" rel="stylesheet">-->
    <!--     <link href="css/home/owl.carousel.min.css" rel="stylesheet">-->
    <!-- <link href="../../css/home/bootstrap.min.css" rel="stylesheet">    -->

    <!--     <link href="css/home/all.min.css" rel="stylesheet">-->

    <!--  END CSS links -->
    <!--     <script src="js/home/jquery-3.3.1.min.js"></script>-->


    <!--  Icon do template-->
    <link rel="icon" href="<?php echo HOME_URL . '/'; ?>Images/home/favicon.png">

    <!--  Script auto-version-->
    <!--    <script src="--><?php //echo auto_version('../../js/global-functions.js'); ?><!--"></script>-->

    <title><?php echo $this->title ?></title>

</head>
<body class>

<!--Header Start-->
<header class="header-style-2">
    <nav class="navbar navbar-expand-lg">
        <a class="navbar-brand" href="<?php echo HOME_URL . '/home/dashboard'; ?>"><img
                    src="../../Images/logo/adoteUma.png"
                    alt=""></a>
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
            <ul class="float-right topside-menu">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle square1"
                       role="button"
                       data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-envelope" style="color: white;"></i>
                        <!-- Counter - Messages -->
                        <?php if (!empty($this->userdata['totalMessagesNotViewed']) && $this->userdata['totalMessagesNotViewed'] !== 0) { ?>
                            <span class="position-absolute translate-middle badge rounded-pill bg-danger"><?php echo $this->userdata['totalMessagesNotViewed'] ?></span>
                        <?php } ?>
                    </a>
                    <ul class="dropdown-menu">
                        <h6 class="dropdown-header">Mensagens</h6>
                        <?php if (!empty($this->userdata['userMessageList'])) {
                            $count = 0;
                            foreach ($this->userdata['userMessageList'] as $key => $message) {
                                if ($message["receptionDate"] === null && $count < 5) { ?>
                                    <a class="dropdown-item d-flex align-items-center"
                                       href="<?php echo HOME_URL . '/home/usermessages/' . $message["id"]; ?>">
                                        <div class="dropdown-item">
                                            <div class="d-inline-block text-truncate"
                                                 style="max-width: 150px;"><?php echo $message["message"] ?></div>
                                            <div class="text-truncate small text-gray-500"><?php echo $message["fromName"] ?>
                                                · <?php echo $message["notificationDate"] ?></div>
                                        </div>
                                    </a>
                                    <?php $count++;
                                }
                            }
                        } ?>
                        <a class="dropdown-item text-center small text-gray-500"
                           href="<?php echo HOME_URL . '/home/usermessages/inbox'; ?>">Mais mensagens...</a>
                    </ul>
                </li>
                <li class="burger"><a href="#"><i class="fas fa-bars"></i> Menu</a></li>
            </ul>
        </div>
    </nav>
</header>


<nav class="sidenav">
    <ul class="main">
        <li><a href="<?php echo HOME_URL . '/home/dashboard'; ?>">Home</a></li>
        <li><a href="<?php echo HOME_URL . '/home/usermessages'; ?>">Mensagens</a></li>
        <li><a href="<?php echo HOME_URL . '/home/usersettings'; ?>">Definições</a></li>
        <li><a href="" data-toggle="modal" data-target="#logoutModal">Logout</a></li>
        <!--        <li><a href="causes.html">Causes</a></li>-->
        <!--        <li><a href="projects-grid.html">Projects</a></li>-->
        <!--        <li><a href="blog.html">Blog</a></li>-->
        <!--        <li><a href="shop-two.html">Shop</a></li>-->
        <!--        <li><a href="contact-one.html">Contact</a></li>-->
    </ul>
</nav>

<div class="overlay" style="z-index: 9998 !important;"></div>

<!-- Start Logout  account Modal HTML -->
<div id="logoutModal" class="modal fade" style="z-index: 9999 !important;" >
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Logout <i class='fa-sign-out'></i></i></h4>
            </div>
            <div class="modal-body"><i class="fa fa-question-circle"></i> De certeza que deseja sair?</div>
            <div class="modal-footer"><a href="<?php echo HOME_URL . '/home/homelogout'; ?>"
                                         class="btn btn-danger btn-block">Sair</a></div>
            <input type="button" class="btn btn-default" data-dismiss="modal" value="Voltar">
        </div>
    </div>
</div>
<!-- End Logout account Modal HTML -->


