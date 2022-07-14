<?php
/**
 * Created by PhpStorm.
 * User: V1p3r
 * Date: 21/11/2018
 * Time: 22:55
 */
?>
<?php if (!defined('ABSPATH')) exit; ?>

<?php if ($this->login_required && !$this->logged_in) return; ?>

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
    <!-- Template original CSS links -->
    <!--  CSS custom que não pode ser apagado-->
    <link href="<?php echo HOME_URL . '/'; ?>css/home/custom.css" rel="stylesheet">
    <!--  Icon do template-->
    <link rel="icon" href="<?php echo HOME_URL . '/'; ?>Images/home/favicon.png">
<!--    Page title-->
    <title><?php echo $this->title ?></title>
</head>
<body>

<!--Header Start-->
<header class="header-style-2">
    <nav class="navbar navbar-expand-lg">
        <a class="navbar-brand" href="<?php echo HOME_URL . '/'; ?>"><img src="<?php echo HOME_URL . '/Images/logo/adoteUma.png'; ?>" alt=""></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i
                    class="fas fa-bars"></i></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <!--Menu go to homepage-->
                <li class="nav-item"><a class="nav-link"
                                        href="<?php echo HOME_URL . '/'; ?>">Início</a>
                </li>
                <!--Menu go to presentation-->
                <li class="nav-item"><a class="nav-link"
                                        href="<?php echo HOME_URL . '/home/presentation'; ?>">O projeto</a>
                </li>
                <!--Menu go to trees-->
                <li class="nav-item"><a class="nav-link"
                                        href="<?php echo HOME_URL . '/' . '#myTabContentTrees'; ?>">As árvores</a>
                </li>
                <!--Menu go to trees-->
                <li class="nav-item"><a class="nav-link"
                                        href="<?php echo HOME_URL . '/' . '#events'; ?>">Eventos</a>
                </li>
                <!--Menu go to causes-->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle"
                       href="/Images/home/causes.html" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Sobre </a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo HOME_URL . '/home/rights'; ?>">Regulamento</a></li>
                    </ul>
                </li>
                <!--Menu go to contact-->
                <li class="nav-item"><a class="nav-link"
                                        href="<?php echo HOME_URL . '/home/contact'; ?>">Contacto</a>
                </li>
            </ul>
            <ul class="topnav-right">
                <li class="login-reg"><a href="" data-toggle="modal" data-target="#loginModal"></i>Entrar</a>
                    | <a href="<?php echo HOME_URL . '/register'; ?>">Registar</a>
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
                        <img src="<?php echo HOME_URL . '/Images/logo/adoteUma.png'; ?>" alt="Avatar">
                    </div>
                    <h4 class="modal-title">Entrar</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="doLogin">
                        <div class="form-group">
                            <input type="email" class="form-control" name="email" placeholder="Email"
                                   required="required">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="pass" placeholder="Palavra-passe"
                                   required="required">
                        </div>

                        <div id="liveAlert">

                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-lg btn-block login-btn btnLogin">Entrar</button>
                        </div>
                    </form>
                    <div class="modal-footer">
                        <a href="<?php echo HOME_URL . '/register/recover'; ?>">Esqueceu a palavra-passe?</a>
                    </div>
                    <br>
                    <div>
                        <div class="modal-footer d-flex justify-content-center">
                            <div >Ainda não é membro? <a
                                        href="<?php echo HOME_URL . '/register'; ?>"
                                        class="text-info"> Registe-se</a>
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
    //Main functions from this view
    $(document).ready(function () {
        // ajax to login
        $('#doLogin').submit(function (event) {
            event.preventDefault(); //prevent default action

            let formData = {
                'action': "Login",
                'data': $(this).serializeArray()
            };

            $.ajax({
                url: "<?php echo HOME_URL . '/home/login';?>",
                dataType: "json",
                type: 'POST',
                data: formData,
                success: function (data) {


                        if(data === 200){
                            alert("Acesso autorizado!", "success");
                            location.reload();
                        } else {
                            alert("Email/Password errado!", "danger");
                        }

                },

                error: function (data) {
                    alert("Erro de conexão, por favor tente novamente.", "danger");
                }
            });
        });

        //Error message
        let alertPlaceholder = document.getElementById('liveAlert')
        function alert(message, type) {
            let wrapper = document.createElement('div')
            wrapper.innerHTML = '<div class="alert alert-' + type + ' alert-dismissible" role="alert">' + message + '</div>'

           $('#liveAlert').html(wrapper)

            // timeout alert message
            setTimeout(function () {
                $(".alert").remove()
            }, 3000);
        }
    });
</script>


