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
                    <div class="userSettings">


                        <div class="bs-example">
                            <div class="container">
                                <div class="row"><h3>Definições gerais de conta</h3>
                                    <div class="col-md-12 bg-light text-right">
                                        <button type="button" class="btn btn-primary">Editar</button>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- User list -->
                        <?php if (!empty($this->userdata['userList'])) {
                            foreach ($this->userdata['userList'] as $key => $user) { ?>
                                <tbody>
                                <ul class="row">
                                    <li class="col-md-12">
                                        Nome: <?php echo $user["name"] ?>
                                    </li>
                                </tbody>
                            <?php } }?>



                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--New User Register End-->
</div>


<!--Script's section-->
<script>

    ////Main functions from this view
    //$(document).ready(function () {
    //    $('#addNewUser').submit(function (event) {
    //        event.preventDefault(); //prevent default action
    //        let chk_status = $("#checkBtn").prop('checked');
    //        if (chk_status) {
    //            let formData = {
    //                'action': "AddNewUser",
    //                'data': $(this).serializeArray()
    //            };
    //            $.ajax({
    //                url: "<?php //echo HOME_URL . '/register/newUser';?>//",
    //                dataType: "json",
    //                type: 'POST',
    //                data: formData,
    //                success: function (data) {
    //                    if (data.statusCode === 201) {
    //                        //mensagem de Success
    //                        Swal.fire({
    //                            title: 'Success!',
    //                            text: data.body.message,
    //                            icon: 'success',
    //                            showConfirmButton: false,
    //                            timer: 2000,
    //                            didClose: () => {
    //                                //location.reload();
    //                            }
    //                        });
    //                    } else {
    //                        //mensagem de Error
    //                        Swal.fire({
    //                            title: 'Error!',
    //                            text: data.body.message,
    //                            icon: 'error',
    //                            showConfirmButton: false,
    //                            timer: 2000,
    //                            didClose: () => {
    //                                //location.reload();
    //                            }
    //                        });
    //                    }
    //                },
    //                error: function (data) {
    //                    //mensagem de Error
    //                    Swal.fire({
    //                        title: 'Error!',
    //                        text: "Connection error, please try again.",
    //                        icon: 'error',
    //                        showConfirmButton: false,
    //                        timer: 2000,
    //                        didClose: () => {
    //                            //location.reload();
    //                        }
    //                    });
    //                }
    //
    //            });
    //        } else {
    //            alert('batatas');
    //        }
    //    });
    //});

</script>
<!--Script's end section-->