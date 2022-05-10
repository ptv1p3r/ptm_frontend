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
                                        <input type="text" name="addUserName" placeholder="Nome completo"
                                               class="form-control"
                                               required>
                                    </div>
                                </li>
                                <li class="col-md-12">
                                    <div class="form-group input-group">
                                        <input type="text" name="addUserEntity" placeholder="Entidade"
                                               class="form-control"
                                        >
                                    </div>
                                </li>
                                <li class="col-md-12">
                                    <div class="form-group input-group">
                                        <input type="text" name="addUserAddress" placeholder="Morada"
                                               class="form-control"
                                               required>
                                    </div>
                                </li>
                                <li class="col-md-2">
                                    <div class="form-group input-group">
                                        <input type="text" name="addUserCodPost" placeholder="Código-postal"
                                               class="form-control"
                                               required>
                                    </div>
                                </li>
                                <li class="col-md-6">
                                    <div class="form-group input-group">
                                        <input type="text" name="addUserLocality" placeholder="Localidade"
                                               class="form-control"
                                               required>
                                    </div>
                                </li>

                                <!-Dropdown Menu with Countries-->
                                <li class="col-md-4">
                                    <div>
                                        <select name="addUserCountry" id="addUserCountry"
                                                class="form-control customDropdown">
                                            <option value="" disabled selected>Selecione o País</option>
                                            <?php if (!empty($this->userdata['countryList'])) {
                                                foreach ($this->userdata['countryList'] as $key => $country) { ?>
                                                    <option value="<?php echo $country['id'] ?>">
                                                        <?php echo $country["name"] ?></option>
                                                <?php }
                                            } ?>
                                        </select>
                                    </div>
                                </li>
                                <!-End Dropdown Menu with Countries-->

                                <li class="col-md-6">
                                    <div class="form-group input-group">
                                        <input type="text" name="addUserNif" placeholder="NIF" class="form-control"
                                               required>
                                    </div>
                                </li>
                                <li class="col-md-6">
                                    <div class="form-group input-group">
                                        <input type="text" name="addUserMobile" placeholder="Telefone"
                                               class="form-control"
                                               required>
                                    </div>
                                </li>

                                <!-Dropdown Menu with Gender-->
                                <li class="col-md-6">
                                    <div>
                                        <select name="addUserGender" id="addUserGender"
                                                class="form-control customDropdown">
                                            <option value="" disabled selected>Sexo</option>
                                            <?php if (!empty($this->userdata['genderList'])) {
                                                foreach ($this->userdata['genderList'] as $key => $gender) { ?>
                                                    <option value="<?php echo $gender['id'] ?>">
                                                        <?php echo $gender["name"] ?></option>
                                                <?php }
                                            } ?>
                                        </select>
                                    </div>
                                </li>
                                <!-End Dropdown Menu with Gender-->

                                <li class="col-md-6">
                                    <div class="form-group input-group">
                                        <input type="date" name="addUserDateBirth" class="form-control"
                                               required>
                                    </div>
                                </li>
                                <li class="col-md-6">
                                    <div class="form-group input-group">
                                        <input type="email" name="addUserEmail" placeholder="Email" class="form-control"
                                               required>
                                    </div>
                                </li>

                                <li class="col-md-6">
                                    <div class="form-group input-group">
                                        <input type="text" name="addUserPassword" placeholder="Password"
                                               class="form-control"
                                               required>
                                    </div>
                                </li>


                                <!-- Image loader -->
                                <div class="loaderOverlay lds-dual-ring hidden" id="loader" >
                                    <svg class="loader" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="50" cy="50" r="46"/>
                                    </svg>
                                </div>
                                <!-- Image loader -->

                                <li class="col-md-12">
                                    <div class="input-group form-check">
                                        <input type="checkbox" id="checkBtn" class="form-check-input" onchange="isChecked(this, 'sub1')">

                                        <!--secção dos termos temos de analisar isto com o grupo de direito-->
                                        <label class="form-check-label" for="exampleCheck1">Eu concordo com os termos <a
                                                    href="<?php echo HOME_URL . '/home/rights'; ?>">Regulamento &
                                                Política de
                                                Privacidade</a></label>
                                    </div>
                                </li>
                                <li class="col-md-12">
                                    <button type="submit" class="register" id="subBtn" disabled="disabled">Regista a sua conta</button>
<!--                                    <div id="loader" class="lds-dual-ring hidden overlay"></div>-->
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
        $('#addNewUser').submit(function (event) {
            event.preventDefault(); //prevent default action
            let formData = {
                'action': "AddNewUser",
                'data': $(this).serializeArray()
            };
            $.ajax({
                url: "<?php echo HOME_URL . '/register/newUser';?>",
                dataType: "json",
                type: 'POST',
                data: formData,
                beforeSend: function () { // Load the spinner.
                    $('#loader').removeClass('hidden')
                },
                success: function (data) {
                    if (data.statusCode === 201) {
                        //mensagem de Success
                        Swal.fire({
                            title: 'Success!',
                            text: data.body.message,
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 2000,
                            didClose: () => {
                                window.location.href = "<?php echo HOME_URL . '/home';?>";
                            }
                        });
                    } else {
                        //mensagem de Error
                        Swal.fire({
                            title: 'Error!',
                            text: data.body.message,
                            icon: 'error',
                            showConfirmButton: false,
                            timer: 2000,
                            didClose: () => {
                                //location.reload();
                            }
                        });
                    }
                }, complete: function () { // Set our complete callback, adding the .hidden class and hiding the spinner.
                    $('#loader').addClass('hidden')
                },
                error: function (data) {
                    //mensagem de Error
                    Swal.fire({
                        title: 'Error!',
                        text: "Connection error, please try again.",
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 2000,
                        didClose: () => {
                            //location.reload();
                        }
                    });
                },
            });
        });


        //Function to lock the button
        $(function() {
            $('#checkBtn').click(function() {
                if ($(this).is(':checked')) {
                    $('#subBtn').removeAttr('disabled');
                } else {

                    $('#subBtn').attr('disabled', 'disabled');

                }
            });
        });



    });


</script>
<!--Script's end section-->