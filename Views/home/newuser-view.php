<!--New user register Start-->
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
                    <!--Form init-->
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
                                    <input type="text" id="entity" placeholder="Entidade" class="form-control" required>
                                </div>
                            </li>
                            <li class="col-md-12">
                                <div class="form-group input-group">
                                    <input type="text" id="address" placeholder="Morada" class="form-control" required>
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
                            <!-Menu dropdown com países-->
                            <li class="col-md-4">
                                <div class="form-group input-group">
                                    <input type="text" id="country" placeholder="País" class="form-control" required>
                                </div>
                            </li>
                            <li class="col-md-6">
                                <div class="form-group input-group">
                                    <input type="text" id="nif" placeholder="NIF" class="form-control" required>
                                </div>
                            </li>
                            <li class="col-md-6">
                                <div class="form-group input-group">
                                    <input type="text" id="mobile" placeholder="Telefone" class="form-control" required>
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
                                                href="#">Services & Privacy Policy</a></label>
                                </div>
                            </li>
                            <li class="col-md-12">
                                <button type="submit" class="register">Regista a sua conta</button>
                            </li>
                        </ul>
                    </form>
                    <!--Form end-->
                </div>
            </div>
        </div>
    </div>
</section>
<!--New user register End-->
<script>

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
                        didClose: () => {
                            location.reload();
                        }
                    });
                },
                error: function (data) {
                    Swal.fire({
                        title: 'Error!',
                        text: data['message'],
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 2000,
                        didClose: () => {
                            location.reload();
                        }
                    });
                }
            });
        });
    });
</script>
