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
    <!--Recover password Start-->
    <section class="wf100 p80">
        <div class="container">
            <div class="recover">
                <div class="row">
                    <div class="col-lg-18">
                        <div class="myrecover-form">
                            <div>
                                <h3>Recupere a sua conta</h3>
                                <h5>Insira o seu email para recuperar a sua conta.</h5>
                                <br>
                            </div>
                            <!--Email form request-->
                            <form id="recover">
                                <div>
                                    <div class="col-md-12">
                                        <div class="form-group">
<!--                                            <label>Email</label>-->
                                            <input type="email" name="userEmail" placeholder="Email"
                                                   class="form-control"
                                                   required>
                                        </div>
                                    </div>
                                </div>
                                <!-- Image loader -->
                                <div class="loaderOverlay lds-dual-ring hidden" id="loader">
                                    <svg class="loader" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="50" cy="50" r="46"/>
                                    </svg>
                                </div>
                                <!-- End Image loader -->
                                <div>
                                    <div class=" form-submit">
                                        <!--                                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">-->
                                        <!--                                        <input type="submit" class="recover" value="Recuperar">-->
                                        <button type="submit" class="btn btn-success recover">Recuperar</button>
                                    </div>
                                </div>
                            </form>
                            <!--End email form request-->
                        </div>
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
        $('#recover').submit(function (event) {
            event.preventDefault(); //prevent default action
            let formData = {
                'action': "recover",
                'data': $(this).serializeArray()
            };
            $.ajax({
                url: "<?php echo HOME_URL . '/register/recover';?>",
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
                            showConfirmButton: true,
                            confirmButtonColor: '#66bb6a',
                            // timer: 3000,
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
