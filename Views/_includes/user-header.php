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
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/colreorder/1.5.6/js/dataTables.colReorder.min.js">
    <script src="https://cdn.datatables.net/plug-ins/1.12.1/i18n/pt-PT.json"></script>

    <!-- Template original CSS links -->
    <!--  CSS custom -->
    <link href="<?php echo HOME_URL . '/css/home/custom.css'; ?>" rel="stylesheet">
    <!--  Icon do template-->
    <link rel="icon" href="<?php echo HOME_URL . '/Images/home/favicon.png'; ?>">
    <!--    Page title-->
    <title><?php echo $this->title ?></title>

</head>
<body class>

<!--Header Start-->
<header class="header-style-2">
    <nav class="navbar navbar-expand-lg">
        <a class="navbar-brand" href="<?php echo HOME_URL . '/home'; ?>">
            <img src="<?php echo HOME_URL . '/Images/logo/adoteUma.png'; ?>" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="fas fa-bars"></i></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <!--Menu go to homepage-->
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo HOME_URL . '/home'; ?>">Início</a>
                </li>
                <!--Menu go to presentation-->
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo HOME_URL . '/home/presentation'; ?>">O projeto</a>
                </li>
                <!--Menu go to trees-->
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo HOME_URL . '/home' . '#myTabContentTrees'; ?>">As árvores</a>
                </li>
                <!--Menu go to causes-->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="/Images/home/causes.html" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Sobre </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="<?php echo HOME_URL . '/home/rights'; ?>">Regulamento</a>
                        </li>
                    </ul>
                </li>
                <!--Menu go to contact-->
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo HOME_URL . '/home/contact'; ?>">Contacto</a>
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
                                    <a class="dropdown-item d-flex align-items-center" href="<?php echo HOME_URL . '/home/usermessages/' . $message["id"]; ?>">
                                        <div class="dropdown-item">
                                            <div class="d-inline-block text-truncate" style="max-width: 150px;">
                                                <?php echo $message["message"] ?>
                                            </div>
                                            <div class="text-truncate small text-gray-500">
                                                <?php echo $message["fromName"] ?>· <?php echo $message["notificationDate"] ?>
                                            </div>
                                        </div>
                                    </a>
                                    <?php $count++;
                                }
                            }
                        } ?>
                        <a class="dropdown-item text-center small text-gray-500" href="<?php echo HOME_URL . '/home/usermessages/inbox'; ?>">Mais mensagens...</a>
                    </ul>
                </li>
                <li class="burger"><a href="#"><i class="fas fa-bars"></i> Menu</a></li>
            </ul>
        </div>
    </nav>
</header>

<nav class="sidenav">
    <ul class="main">
        <li><a href="<?php echo HOME_URL . '/home'; ?>">Home</a></li>
        <li><a href="<?php echo HOME_URL . '/home/usermessages'; ?>">Mensagens</a></li>
        <li><a href="<?php echo HOME_URL . '/home/usersettings'; ?>">Definições</a></li>
        <li><a href="" data-toggle="modal" data-target="#logoutModal">Sair</a></li>
    </ul>
</nav>

<div class="overlay" style="z-index: 9998 !important;"></div>

<!-- Logout Modal HTML -->
<div id="logoutModal" class="modal fade" style="z-index: 9999 !important;">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-dialog modal-login">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="avatar">
                        <img src="<?php echo HOME_URL . '/Images/logo/adoteUma.png'; ?>" alt="Avatar">
                    </div>
                    <h4 class="modal-title">Sair</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div _ngcontent-serverapp-c180="" style="text-align: center">
                        <i class="fas fa-sign-out-alt fa-3x"></i>
                    </div>
                    <br>
                    <div style="text-align: center">
                        <b>De certeza que deseja sair?</b>
                    </div>
                    <br>
                    <div class="modal-footer" style="background-color: #FFFFFF">
                        <!--<button type="button" class="btn btn-primary"></button>-->
                        <a type="button" class="btn btn-primary" href="<?php echo HOME_URL . '/home/homelogout'; ?>" style="color: #FFFFFF;line-height: unset">Terminar sessão</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Logout Modal HTML -->


