<?php
/**
 * Created by PhpStorm.
 * User: V1p3r
 * Date: 17/10/2018
 * Time: 20:14
 */
?>
<?php if ( ! defined('ABSPATH')) exit; ?>

<div class="container">

    <div class="row  justify-content-center align-items-center" style="margin-top: 100px">
        <img src="../../Images/logo.png" alt="">
        <h1 class="text-light">Project Tree Management</h1>
    </div>

    <div class="row  justify-content-center align-items-center">
        <div class="col-lg-4">
            <div class="jumbotron" style="margin-top: 150px">
                <?php //if (isset($_POST['validation']) && $_POST['validation'] == "failed") { ?>
                <!--<div class="alert alert-danger alert-dismissable" role="alert">
                        <a class="panel-close close" data-dismiss="alert">×</a>
                        <i class="fa fa-times-circle"></i> Invalid Email/Password!
                    </div>-->
                <?php //} ?>

                <div id="liveAlert">

                </div>

                <form id="doLogin">
                    <input name="email" type="email" class="form-control" placeholder="Email">
                    <br>
                    <input name="pass" type="password" class="form-control" placeholder="Password">
                    <br>
                    <button type="submit" name="submit" class="btn btn-success form-control">Login</button>
                </form>
            </div>
        </div>
    </div>

</div>

<script>
    $(document).ready(function() {
        // ajax to login
        $('#doLogin').submit(function (event) {
            event.preventDefault(); //prevent default action

            let formData = {
                'action': "Login",
                'data': $(this).serializeArray()
            };

            $.ajax({
                url: "<?php echo HOME_URL . '/admin/login';?>",
                dataType: "json",
                type: 'POST',
                data: formData,
                success: function (data) {

                    if(data === 200){
                        alert("Logging in!", "success");
                        location.reload();
                    } else {
                        alert("Invalid Email/Password!", "danger");
                    }

                },
                error: function (data) {
                    alert("Connection error, please try again.", "danger");
                }
            });
        });

        //mensagem alerta para CRUD
        let alertPlaceholder = document.getElementById('liveAlert')
        function alert(message, type) {
            let wrapper = document.createElement('div')
            wrapper.innerHTML = '<div class="alert alert-' + type + ' alert-dismissible" role="alert">' + message + '</div>'

            alertPlaceholder.append(wrapper)

            // timeout alert message
            setTimeout(function () {
                $(".alert").remove()
            }, 3000);
        }

    });
</script>