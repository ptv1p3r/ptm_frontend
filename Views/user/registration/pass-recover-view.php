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
                            <h3>Reponha a sua palavra passe:</h3>
                            <!--                            <h4>É rápido e fácil.</h4>-->
                            <br>
                        </div>

                        <!--  Change password form-->

                        <form id="recPass">
                            <div class="form-group">
<!--                                <input id="passEditUserId" name="passEditUserId" type="hidden" class="form-control"-->
<!--                                       value="--><?php //echo $user["id"] ?><!--">-->
                            </div>
                            <div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Nova password</label>
                                        <input type="password" id="pass" name="newPass" class="form-control"
                                               required>
                                        <span id="verifyEqualPass" class="badge-warning hidden"></span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Confirma a nova password</label>
                                        <input type="password" id="verify" name="confPass" class="form-control"
                                               required>
                                        <span id="verifyMatchPass" class="badge-warning hidden"></span>
                                    </div>
                                </div>
                            </div>

                            <!-- Image loader -->
                            <div class="loaderOverlay lds-dual-ring hidden" id="loader" >
                                <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="50" cy="50" r="46"/>
                                </svg>
                            </div>
                            <!-- Image loader -->


                            <div>
                                <div class="modal-footer">
<!--                                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">-->
                                    <input type="submit" class="btn btn-info" value="Alterar">
                                </div>
                            </div>
                        </form>


                    </div>

                    <!-- End Change password form-->

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
        $('#recPass').submit(function (event) {
            event.preventDefault(); //prevent default action
            let formData = {
                'action': "passRecover",
                'data': $(this).serializeArray()
            };



            console.log(formData);

            $.ajax({
                url: "<?php echo HOME_URL . '/register/passRecover';?>",
                //url: "<?php //echo API_URL . 'register/passrecover';?>//",
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
    });


</script>
<!--Script's end section-->
