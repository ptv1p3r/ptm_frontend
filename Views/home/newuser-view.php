
<!--Causes Start-->
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
                    <!--Form init-->
                    <form id="addNewUser">
                        <ul class="row">
                            <li class="col-md-12">
                                <div class="form-group">
                                    <input type="text" id="name" placeholder="Nome completo"  class="form-control" required>
                                </div>
                            </li>

<!--                            <li class="col-md-12">-->
<!--                                    <div class="input-group">-->
<!--                                    <input type="text" class="form-control" id="entity" placeholder="Entidade" required>-->
<!--                                    </div>-->
<!--                                </li>-->
                            <!--                            <li class="col-md-12">-->
                            <!--                                <div class="input-group">-->
                            <!--                                    <input type="text" class="form-control" id="address" placeholder="Morada" required>-->
                            <!--                                </div>-->
                            <!--                            </li>-->
                            <!--                            <li class="col-md-2">-->
                            <!--                                <div class="input-group">-->
                            <!--                                    <input type="text" class="form-control" id="codPost" placeholder="Código-postal" required>-->
                            <!--                                </div>-->
                            <!--                            </li>-->
                            <!--                            <li class="col-md-6">-->
                            <!--                                <div class="input-group">-->
                            <!--                                    <input type="text" class="form-control" id="locality" placeholder="Localidade" required>-->
                            <!--                                </div>-->
                            <!--                            </li>-->
                            <!---->
                            <!--                              País pode ser em drop down???-->-->
                            <!--                            <li class="col-md-4">-->
                            <!---->
                            <!--                                <select class="custom-select custom-select-lg" id="country">-->
                            <!--                                    <option selected>Escolha o país</option>-->
                            <!--                                    <option value="1">Portugal</option>-->
                            <!--                                    <option value="2">China</option>-->
                            <!--                                </select>-->
                            <!---->
                            <!--                                <!-                               <div class="input-group">-->
                            -->
                            <!--                                <!-                                  <input type="text" class="form-control" id="country" placeholder="País" required>-->
                            -->
                            <!--                                <!-                               </div>-->-->
                            <!--                            </li>-->
                            <!--                            <li class="col-md-6">-->
                            <!--                                <div class="input-group">-->
                            <!--                                    <input type="text" class="form-control" id="nif" placeholder="NIF" required>-->
                            <!--                                </div>-->
                            <!--                            </li>-->
                            <!--                            <!-Menu dropdown com países-->-->
                            <!--                            <li class="col-md-6">-->
                            <!--                                <div class="input-group">-->
                            <!--                                    <input type="text" class="form-control" id="mobile" placeholder="Telefone" required>-->
                            <!--                                </div>-->
                            <!--                            </li>-->
                            <!--                            <li class="col-md-6">-->
                            <!--                                <div class="input-group">-->
                            <!--                                    <input type="text" class="form-control" id="email" placeholder="Email" required>-->
                            <!--                                </div>-->
                            <!--                            </li>-->
                            <!--                            <li class="col-md-6">-->
                            <!--                                <div class="input-group">-->
                            <!--                                    <input type="text" class="form-control" placeholder="User Name">-->
                            <!--                                </div>-->
                            <!--                            </li>-->
                            <!--                            <li class="col-md-6">-->
                            <!--                                <div class="input-group">-->
                            <!--                                    <input type="text" class="form-control" id="password" placeholder="Password">-->
                            <!--                                </div>-->
                            <!--                            </li>-->
                            <!--                            <!-Para rever a password o campo é o mesmo / criar scrip que compare os dois campos-->
                            -->
                            <!--                            <li class="col-md-6">-->
                            <!--                                <div class="input-group">-->
                            <!--                                    <input type="text" class="form-control" id="password" placeholder="Re-enter Password">-->
                            <!--                                </div>-->
                            <!--                            </li>-->
                            <li class="col-md-12">
                                <div class="input-group form-check">
                                    <input type="checkbox" class="form-check-input" id="active">
                                    <!--secção dos termos temos de analisar isto com o grupo de direito-->
                                    <label class="form-check-label" for="exampleCheck1">Eu concordo com os termos <a
                                                href="#">Services & Privacy Policy</a></label>
                                </div>
                            </li>
                            <li class="col-md-12">
<!--                                <button type="submit" class="register" id="addNewUser">Regista</button>-->
                                <input type="submit" class="btn btn-success" value="test">
                            </li>
                        </ul>
                    </form>
                </div>
            </div>
        </div>
    </div>
            <!--   <div class="col-lg-4">
                   <div class="login-box">
                       <h3>Login Account</h3>
                       <form>
                           <div class="input-group">
                               <input type="text" class="form-control" placeholder="Username/Email" required>
                           </div>
                           <div class="input-group">
                               <input type="password" class="form-control" placeholder="Password" required>
                           </div>
                           <div class="input-group form-check">
                               <input type="checkbox" class="form-check-input" id="exampleCheck2">
                               <label class="form-check-label" for="exampleCheck2">Remember Me</label>
                               <a href="#" class="fp">Forgot Password</a>
                           </div>
                           <div class="input-group">
                               <button class="login-btn">Login Account</button>
                           </div>
                       </form>
                   </div>
               </div>
           </div>
       </div>-->
</section>
<!--Causes End type="text.javascript"-->

<script>

$(document).ready(function() {

    // New User
    $('#addNewUser').submit(function (event) {
        event.preventDefault(); //prevent default action
        //alert('ola');
        let formData = {
            'action': "AddNewUser",
            'data': $(this).serializeArray()
        };
        $.ajax({
            url: "<?php echo HOME_URL . '/user/newuser';?>",
            dataType: "json",
            type: 'POST',
            data: formData,
            success: function (data) {
                console.log(data);

                Swal.fire({
                    title: 'Success!',
                    text: data['message'],
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 2000,
                    didClose: () => {
                        location.reload();
                    }
                });
            },
            error: function (data) {
                Swal.fire({
                    title: 'Error!',
                    text: data['message'],
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 2000,
                    didClose: () => {
                        location.reload();
                    }
                });
            }
        });
    });
});
</script>
