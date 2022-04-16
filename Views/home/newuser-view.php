<?php
/**
 * Created by PhpStorm.
 * User: V1p3r
 * Date: 17/10/2018
 * Time: 20:14
 */
?>
<?php if (!defined('ABSPATH')) exit; ?>

<div id="wrapper">
    <!--New User Register Start-->
    <section class="wf100 p80">
        <div class="container">
            <div class="row">
                <div class="col-lg-18">
                    <div class="myaccount-form">
                        <div>
                            <h3>Registe-se</h3>
                            <h4>É rápido e fácil.</h4>
                            <br>
                        </div>
                        <!--Form Init-->
                        <form id="addNewUser">
                            <ul class="row">
                                <li class="col-md-12">
                                    <div class="form-group input-group">
                                        <input type="text" id="name" placeholder="Nome completo" class="form-control"
                                               required>
                                    </div>
                                </li>
                                <li class="col-md-12">
                                    <div class="form-group input-group">
                                        <input type="text" id="entity" placeholder="Entidade" class="form-control"
                                               required>
                                    </div>
                                </li>
                                <li class="col-md-12">
                                    <div class="form-group input-group">
                                        <input type="text" id="address" placeholder="Morada" class="form-control"
                                               required>
                                    </div>
                                </li>
                                <li class="col-md-2">
                                    <div class="form-group input-group">
                                        <input type="text" id="codPost" placeholder="Código-postal" class="form-control"
                                               required>
                                    </div>
                                </li>
                                <li class="col-md-6">
                                    <div class="form-group input-group">
                                        <input type="text" id="locality" placeholder="Localidade" class="form-control"
                                               required>
                                    </div>
                                </li>

                                <!-Dropdown Menu with Countries-->
                                <li class="col-md-4">
                                    <div>
                                        <select name="industry" class="form-control customDropdown">
                                            <option value="" disabled selected>Selecione o País</option>
                                            <option value="financial-service">Portugal</option>
                                            <!--                                        <option value="healthcare-lifescience">Healthcare & Life Science</option>-->
                                            <!--                                        <option value="communications">Communications</option>-->
                                        </select>
                                    </div>
                                </li>
                                <!-End Dropdown Menu with Countries-->

                                <li class="col-md-6">
                                    <div class="form-group input-group">
                                        <input type="text" id="nif" placeholder="NIF" class="form-control" required>
                                    </div>
                                </li>
                                <li class="col-md-6">
                                    <div class="form-group input-group">
                                        <input type="text" id="mobile" placeholder="Telefone" class="form-control"
                                               required>
                                    </div>
                                </li>
                                <li class="col-md-6">
                                    <div class="form-group input-group">
                                        <input type="text" id="email" placeholder="Email" class="form-control" required>
                                    </div>
                                </li>
                                <li class="col-md-6">
                                    <div class="form-group input-group">
                                        <input type="text" id="username" placeholder="User Name" class="form-control"
                                               required>
                                    </div>
                                </li>
                                <li class="col-md-6">
                                    <div class="form-group input-group">
                                        <input type="text" id="password" placeholder="Password" class="form-control"
                                               required>
                                    </div>
                                </li>
                                <li class="col-md-6">
                                    <div class="form-group input-group">
                                        <input type="text" id="password" placeholder="Repita a password"
                                               class="form-control" required>
                                    </div>
                                </li>
                                <li class="col-md-12">
                                    <div class="input-group form-check">
                                        <input type="checkbox" class="form-check-input" id="active">
                                        <!--secção dos termos temos de analisar isto com o grupo de direito-->
                                        <label class="form-check-label" for="exampleCheck1">Eu concordo com os termos <a
                                                    href="<?php echo HOME_URL . '/rights'; ?>">Regulamento & Política de
                                                Privacidade</a></label>
                                    </div>
                                </li>
                                <li class="col-md-12">
                                    <button type="submit" class="register">Regista a sua conta</button>
                                </li>
                            </ul>
                        </form>
                        <!--Form End-->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--New User Register End-->

    <!-- Login Modal HTML -->
    <div id="loginModal" class="modal fade">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-dialog modal-login">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="avatar">
                            <img src="../../Images/home/logo.png" alt="Avatar">
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
</div>

    <!--Script's section-->
    <script>
        //Main functions from this view
        $(document).ready(function () {

            // New User
            $('#addNewUser').submit(function (event) {
                event.preventDefault(); //prevent default action
                //alert('ola');
                let formData = {
                    'action': "AddNewUser",
                    'data': $(this).serializeArray()
                };
                $.ajax({
                    url: "<?php echo HOME_URL . '/user/newuser';?>",
                    dataType: "json",
                    type: 'POST',
                    data: formData,
                    success: function (data) {
                        console.log(data);

                        Swal.fire({
                            title: 'Success!',
                            text: data['message'],
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 2000,
                            // didClose: () => {
                            //     location.reload();
                            // }
                        });
                    },
                    error: function (data) {
                        Swal.fire({
                            title: 'Error!',
                            text: data['message'],
                            icon: 'error',
                            showConfirmButton: false,
                            timer: 2000,
                            // didClose: () => {
                            //     location.reload();
                            // }
                        });
                    }
                });
            });
        });
    </script>
    <!--Script's end section-->