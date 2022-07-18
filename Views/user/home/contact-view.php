<?php
/**
 * Created by PhpStorm.
 * User: V1p3r
 * Date: 17/10/2018
 * Time: 20:14
 */
?>
<?php if (!defined('ABSPATH')) exit; ?>

<!-- Image loader -->
<div class="loaderOverlay lds-dual-ring hidden" id="loader">
    <svg class="loader" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
        <circle cx="50" cy="50" r="46"/>
    </svg>
</div>
<!-- Image loader -->

<!--Header End-->
<!--Inner Header Start-->
<section class="wf100 p100 inner-header">
</section>
<!--Inner Header End-->
<!--Contact Start-->
<section class="contact-page wf100 p80">
    <div class="container">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <div class="contact-form mb60">
                    <h3>Contacte</h3>
                    <form id="cform">
                        <ul class="cform">
                            <li class="half pr-15">
                                <input type="text" name="name" class="form-control" placeholder="Nome" required>
                            </li>
                            <li class="half pl-15">
                                <input type="email" name="email" class="form-control" placeholder="Email" required>
                            </li>
                            <li class="half pr-15">
                                <input type="text" name="userContact" class="form-control" placeholder="Contacto" required>
                            </li>
                            <li class="half pl-15">
                                <input type="text" class="form-control" name="subject" placeholder="Assunto" required>
                            </li>
                            <li class="full">
                                <textarea class="textarea-control" name="message" placeholder="Mensagem" required></textarea>
                            </li>
                            <li class="full">
                                <input type="submit" value="Enviar" class="fsubmit">
                            </li>
                        </ul>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Contact End-->

<!--Script's section-->
<script>
    //Main functions from this view
    $(document).ready(function () {
        $('#cform').submit(function (event) {
            event.preventDefault(); //prevent default action
            let formData = {
                'action': "cMessage",
                'data': $(this).serializeArray()
            };
            $.ajax({
                url: "<?php echo HOME_URL . '/home/contact';?>",
                dataType: "json",
                type: 'POST',
                data: formData,
                beforeSend: function () { // Load the spinner.
                    $('#loader').removeClass('hidden')
                },
                success: function (data) {
                    console.log(data);
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