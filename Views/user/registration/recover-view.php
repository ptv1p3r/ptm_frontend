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
                            <h3>Recupere a sua conta</h3>
<!--                            <h4>É rápido e fácil.</h4>-->
                            <br>
                        </div>
                        <!--Form Init-->
                        <form id="recover">
                            <ul class="row">

                                <li class="col-md-12">
                                    <div class="form-group input-group">
                                        <input type="email" name="userEmail" placeholder="Email" class="form-control"
                                               required>
                                    </div>
                                </li>


                                <!-- Image loader -->
                                <div class="loaderOverlay lds-dual-ring hidden" id="loader" >
                                    <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="50" cy="50" r="46"/>
                                    </svg>
                                </div>
                                <!-- Image loader -->

                                <li class="col-md-12">
                                    <button type="submit" class="register">Recuperar</button>
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
