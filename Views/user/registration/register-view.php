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
                                        <input type="text"  name="addUserName" placeholder="Nome completo" class="form-control"
                                               required>
                                    </div>
                                </li>
                                <li class="col-md-12">
                                    <div class="form-group input-group">
                                        <input type="text"  name="addUserEntity" placeholder="Entidade" class="form-control"
                                               >
                                    </div>
                                </li>
                                <li class="col-md-12">
                                    <div class="form-group input-group">
                                        <input type="text"  name="addUserGender" placeholder="Género" class="form-control"
                                               required>
                                    </div>
                                </li>
                                <li class="col-md-12">
                                    <div class="form-group input-group">
                                        <input type="text" name="addUserAddress" placeholder="Morada" class="form-control"
                                               required>
                                    </div>
                                </li>
                                <li class="col-md-2">
                                    <div class="form-group input-group">
                                        <input type="text" name="addUserCodPost" placeholder="Código-postal" class="form-control"
                                               required>
                                    </div>
                                </li>
                                <li class="col-md-6">
                                    <div class="form-group input-group">
                                        <input type="text" name="addUserLocality" placeholder="Localidade" class="form-control"
                                               required>
                                    </div>
                                </li>

                                <!-Dropdown Menu with Countries-->
                                <li class="col-md-4">
                                    <div>
                                        <select name="addUserCountry" id="addUserCountry" class="form-control customDropdown">
                                            <option value="" disabled selected>Selecione o País</option>
                                            <?php if (!empty($this->userdata['countryList'])) {
                                                foreach ($this->userdata['countryList'] as $key => $country) { ?>
                                                    <option  value="<?php echo $country['id'] ?>">
                                                        <?php echo $country["name"] ?></option>
                                                <?php }
                                            } ?>
                                        </select>
                                    </div>
                                </li>
                                <!-End Dropdown Menu with Countries-->

                                <li class="col-md-6">
                                    <div class="form-group input-group">
                                        <input type="text" name="addUserNif" placeholder="NIF" class="form-control" required>
                                    </div>
                                </li>
                                <li class="col-md-6">
                                    <div class="form-group input-group">
                                        <input type="text" name="addUserMobile" placeholder="Telefone" class="form-control"
                                               required>
                                    </div>
                                </li>
                                <li class="col-md-6">
                                    <div class="form-group input-group">
                                        <input type="text" name="addUserEmail" placeholder="Email" class="form-control" required>
                                    </div>
                                </li>
                                <li class="col-md-6">
                                    <div class="form-group input-group">
                                        <input type="text" name="addUserDateBirth" placeholder="yyyy-mm-dd" class="form-control"
                                               required>
                                    </div>
                                </li>
                                <li class="col-md-6">
                                    <div class="form-group input-group">
                                        <input type="text" name="addUserPassword" placeholder="Password" class="form-control"
                                               required>
                                    </div>
                                </li>
                                <!-- <li class="col-md-6">
                                     <div class="form-group input-group">
                                         <input type="text" id="password" placeholder="Repita a password"
                                                class="form-control" required>
                                     </div>
                                 </li> -->
                                <li class="col-md-12">
                                    <div class="input-group form-check">
                                        <input type="checkbox" class="form-check-input">
                                        <!--secção dos termos temos de analisar isto com o grupo de direito-->
                                        <label class="form-check-label" for="exampleCheck1">Eu concordo com os termos <a
                                                    href="<?php echo HOME_URL . '/home/rights'; ?>">Regulamento &
                                                Política de
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
            let formData = {
                'action': "AddNewUser",
                'data': $(this).serializeArray()
            };
            $.ajax({
                url: "<?php echo HOME_URL . '/register/newuser';?>",
                dataType: "json",
                type: 'POST',
                data: formData,
                success: function (data) {
                    console.log(data);

                    Swal.fire({
                        title: 'Conta criado com sucesso!',
                        text: data['message'],
                        icon: 'success',
                        showConfirmButton: true,
                        //timer: 2000,
                        didClose: () => {
                            window.location = "<?php echo HOME_URL . '/home';?>";
                        }
                    });
                },
                error: function (data) {
                    Swal.fire({
                        title: 'Error!',
                        text: data['message'],
                        icon: 'error',
                        showConfirmButton: false,
                        //timer: 2000,
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