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
                                                    href="<?php echo HOME_URL . '/home/rights'; ?>">Regulamento & Política de
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