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
    <!--Recover password start-->
    <section class="wf100 p80">
        <div class="container">
            <div class="recover">
                <div class="row">
                    <div class="col-lg-18">
                        <div class="myrecover-form">
                            <div>
                                <h3>Reponha a sua palavra passe</h3>
                                <br>
                            </div>
                            <!--  Change password form-->
                            <form id="recPass">
                                <div class="form-group">
                                </div>
                                <div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Nova password</label>
                                            <input type="password" id="pass" name="newPass" class="form-control"
                                                   required>
                                            <input type="checkbox" id="show-password">
                                            <label for="show-password">Ver palavra-passe
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Confirma a nova password</label>
                                            <input type="password" id="verify" name="confPass" class="form-control"
                                                   required>
                                            <input type="checkbox" id="show-password1">
                                            <label for="show-password">Ver palavra-passe
                                                <span id="verifyMatchPass" class="badge-warning hidden"></span>
                                        </div>
                                    </div>
                                </div>
                                <!-- Image loader -->
                                <div class="loaderOverlay lds-dual-ring hidden" id="loader">
                                    <svg class="loader" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="50" cy="50" r="46"/>
                                    </svg>
                                </div>
                                <!-- Image loader -->
                                <div>
                                    <div class=" form-submit">
                                        <button type="submit" class="btn btn-success recover">Alterar</button>
                                    </div>
                                </div>
                            </form>
                            <!--  End change password form-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End recover password-->
</div>


<!--Script's section-->
<script>

    //Main functions from this view
    $(document).ready(function () {
        $('#recPass').submit(function (event) {
            event.preventDefault(); //prevent default action
            let formData = {
                'action': "PassRecover",
                'data': $(this).serializeArray()
            };

            console.log(formData);

            $.ajax({
                url: "<?php echo HOME_URL . '/register/passRecover/' . chk_array($parametros, 0) . '/' . chk_array($parametros, 1);?>",
                dataType: "json",
                type: 'POST',
                data: formData,
                beforeSend: function () { // Load the spinner.
                    $('#loader').removeClass('hidden')
                },
                success: function (data) {
                    if (data.statusCode === 200) {
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
                    } else if (data.statusCode === 400) {
                        //Error message
                        Swal.fire({
                            title: 'Erro!',
                            text: 'A palavra-passe não pode ser idêntica à anterior!',
                            icon: 'error',
                            showConfirmButton: false,
                            // timer: 2000,
                            didClose: () => {
                                //location.reload();
                            }
                        });
                    } else {
                        if (data.statusCode == 0) {
                            $('#verifyMatchPass').text(data.body.message);
                            $('#verifyMatchPass').show();
                        }
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
    });
    //function handler spn messages
    $('#updatePass').click(function () {
        $(this).parent().find('#verifyMatchPass').hide();
    });

    <!-- Toggle password visibility -->
    $("#show-password").change(function () {
        $(this).prop("checked") ? $("#pass").prop("type", "text") : $("#pass").prop("type", "password");
    });
    $("#show-password1").change(function () {
        $(this).prop("checked") ? $("#verify").prop("type", "text") : $("#verify").prop("type", "password");
    });

</script>
<!--Script's end section-->
