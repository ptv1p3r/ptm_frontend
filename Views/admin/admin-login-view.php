
<?php if ( ! defined('ABSPATH')) exit; ?>

<div id="layoutAuthentication">

    <div id="layoutAuthentication_content">
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-header">
                                <img class="mx-auto d-block" src="<?php echo HOME_URL . '/Images/logo/adoteUma.png' ?>" alt="Adote uma árvore.">
                                <h3 class="text-center font-weight-light my-4">Project Tree Management</h3>
                            </div>
                            <div class="card-body">
                                <div id="liveAlert">

                                </div>

                                <form id="doLogin">
                                    <div class="form-floating mb-3">
                                        <input id="emailInput" class="form-control" name="email" type="email" placeholder="name@example.com" required />
                                        <label for="emailInput">Email</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input id="passInput" class="form-control" name="pass" type="password" placeholder="Password" required />
                                        <label for="passInput">Password</label>
                                    </div>
                                    <!--<div class="form-check mb-3">
                                        <input class="form-check-input" id="inputRememberPassword" type="checkbox" value="" />
                                        <label class="form-check-label" for="inputRememberPassword">Remember Password</label>
                                    </div>-->
                                    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                        <input type="submit" name="submit" class="btn btn-primary form-control" value="Login">
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
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
                        alert("A iniciar!", "success");
                        location.reload();
                    } else {
                        alert("Email/Password invalida!", "danger");
                    }

                },
                error: function (data) {
                    alert("Erro de conexão, por favor tente denovo.", "danger");
                }
            });
        });

        //mensagem alerta para CRUD
        let alertPlaceholder = document.getElementById('liveAlert')
        function alert(message, type) {
            let wrapper = document.createElement('div')
            wrapper.innerHTML = '<div class="alert alert-' + type + ' alert-dismissible" role="alert">' + message + '</div>'

            $('#liveAlert').html(wrapper)
            //alertPlaceholder.innerHTML(wrapper)

            // timeout alert message
            setTimeout(function () {
                $(".alert").remove()
            }, 3000);
        }

    });
</script>