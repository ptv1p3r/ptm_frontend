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

    <!--Profile user edit account Start-->
    <section class="py-5 my-5">
        <div class="container">
            <h1 class="mb-5">Definições gerais</h1>
            <div class="bg-white rounded-lg d-block d-sm-flex">
                <div class="profile-tab-nav border-right">


                    <!--                    Podemos utilizar para colocar uma imagem de utilizador-->
                    <!--                    <div class="p-4">-->
                    <!--                        <div class="fa-xing-square text-center mb-3">-->
                    <!--                            <img src="Images/user2.png" alt="Image">-->
                    <!--                        </div>-->
                    <!--                    </div>-->

                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link active" id="account-tab" data-toggle="pill" href="#account" role="tab"
                           aria-controls="account" aria-selected="true">
                            <i class="fa fa-home text-center mr-1"></i>
                            Conta
                        </a>
                        <a class="nav-link" id="password-tab" data-toggle="pill" href="#password" role="tab"
                           aria-controls="password" aria-selected="false">
                            <i class="fa fa-key text-center mr-1"></i>
                            Password
                        </a>
                        <a class="nav-link" id="security-tab" data-toggle="pill" href="#security" role="tab"
                           aria-controls="security" aria-selected="false">
                            <i class="fa fa-user text-center mr-1"></i>
                            Opções
                        </a>
                        <!--                        <a class="nav-link" id="application-tab" data-toggle="pill" href="#application" role="tab" aria-controls="application" aria-selected="false">-->
                        <!--                            <i class="fa fa-tv text-center mr-1"></i>-->
                        <!--                            Application-->
                        <!--                        </a>-->
                        <!--                        <a class="nav-link" id="notification-tab" data-toggle="pill" href="#notification" role="tab" aria-controls="notification" aria-selected="false">-->
                        <!--                            <i class="fa fa-bell text-center mr-1"></i>-->
                        <!--                            Notification-->
                        <!--                        </a>-->
                    </div>
                </div>

                <!-- Profile tab section-->
                <?php if (!empty($this->userdata['userList'])) {
                foreach ($this->userdata['userList'] as $key => $user) { ?>
                <div class="tab-content p-4 p-md-5 profile-tab" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="account" role="tabpanel" aria-labelledby="account-tab">
                        <h3 class="mb-4">Dados da conta</h3>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Nome</label>
                                    <p> <?php echo $user["name"] ?></p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Entidade</label>
                                    <p><?php echo $user["entity"] ?></p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Morada</label>
                                    <p><?php echo $user["address"] ?></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Código-postal</label>
                                    <p><?php echo $user["codPost"] ?></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Localidade</label>
                                    <p><?php echo $user["locality"] ?></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>País</label>
                                    <?php foreach($this->userdata['countryList'] as $key=>$val) { ?>
                                       <?php echo ($val['id'] == $user["countryId"])?"<p>".$val['name']."</p>":'';?>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Data de nascimento</label>
                                    <p><?php echo $user["dateBirth"] ?></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Gênero</label>
                                    <?php foreach($this->userdata['genderList'] as $key=>$val) { ?>
                                        <?php echo ($val['id'] == $user["genderId"])?"<p>".$val['name']."</p>":'';?>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>NIF</label>
                                    <p><?php echo $user["nif"] ?></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Telefone</label>
                                    <p><?php echo $user["mobile"] ?></p>
                                </div>
                            </div>
                        </div>
                        <div>
                            <button class="btn edit btn-success" id="<?php echo $user["email"]; ?>" data-toggle="modal"
                                    data-target="#editUserModal">Editar
                            </button>
                            <!--                            <button class="btn btn-light">Cancel</button>-->
                        </div>
                    </div>
                    <!--End profile tab section-->

                    <!--Edit password tab section-->
                    <div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
                        <h3 class="mb-4">Password Settings</h3>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Password antiga</label>
                                    <input type="password" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nova password</label>
                                    <input type="password" id="txtNewPassword" class="form-control">
                                    <p class="registrationFormAlert" style="color:green;" id="CheckPasswordMatch">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Confirma a nova password</label>
                                    <input type="password" id="txtConfirmPassword" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div>
                            <button class="btn btn-success">Salvar</button>
                            <!--                            <button class="btn btn-light">Cancel</button>-->
                        </div>
                    </div>
                    <!--End Edit password tab section-->

                    <div class="tab-pane fade" id="security" role="tabpanel" aria-labelledby="security-tab">
                        <h3 class="mb-4">Remover conta</h3>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Nesta opção o utilizador poderá remover a conta e todos os seus
                                        dados.</label>
                                </div>
                            </div>
                        </div>
                        <div>
                            <button class="btn btn-danger" data-toggle="modal" data-target="#deleteUserModal">Remover
                            </button>
                            <button class="btn btn-light">Cancelar</button>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </section>
    <!--Profile user edit account End-->

    <!-- Edit Profile Modal HTML -->
    <div id="editUserModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edite os seus dados</h4>

                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <form class="updateUser">
                        <div class="form-group">
                            <input id="editUserId" name="editUserId" type="hidden" class="form-control"
                                   value="<?php echo $user["id"] ?>">
                        </div>

                        <div class="form-group">
                            <label>Nome:</label>
                            <input type="text" class="form-control" name="editUserName"
                                   value="">
                        </div>

                        <div class="form-group">
                            <label>Entidade:</label>
                            <input type="text" class="form-control" name="editUserEntity" value="">

                        </div>

                        <div class="form-group">
                            <label>Morada:</label>
                            <input type="text" class="form-control" name="editUserAddress" value="">
                        </div>

                        <div class="form-group">
                            <label>Código-postal:</label>
                            <input type="text" class="form-control" name="editUserCodPost" value="">
                        </div>

                        <div class="form-group">
                            <label>Localidade:</label>
                            <input type="text" class="form-control" name="editUserLocality" value="">
                        </div>
                        <div class="form-group">
                            <label>País:</label>
                            <select class="form-control" id="editUserCountry" name="editUserCountry">
                                <?php foreach($this->userdata['countryList'] as $key=>$val) { ?>
                                    <option value="<?php echo $val['id']; ?>" <?php echo ($val['id'] == $user["countryId"])?'selected="selected"':''?> > <?php echo $val['name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Nif:</label>
                            <input type="text" class="form-control" name="editUserNif" value="">
                        </div>
                        <div class="form-group">
                            <label>Telefone:</label>
                            <input type="text" class="form-control" name="editUserMobile">
                        </div>
                        <div class="form-group">
                            <label>País:</label>
                            <select class="form-control" id="editUserGender" name="editUserGender">
                                <?php foreach($this->userdata['genderList'] as $key=>$val) { ?>
                                    <option value="<?php echo $val['id']; ?>" <?php echo ($val['id'] == $user["genderId"])?'selected="selected"':''?> > <?php echo $val['name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Password:</label>
                            <input type="password"  class="form-control" name="editUserPassword">
                        </div>
                        <div class="form-group">
                            <label>Data de aniversário:</label>
                            <input type="date" class="form-control" name="editUserDateBirth">
                        </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                            <input type="submit" class="btn btn-info" value="Save">
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<?php }
} ?>
<!-- End Edit Profile Modal HTML -->


<!-- Delete Modal HTML -->
<div id="deleteUserModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="deleteUser">
                <div class="modal-header">
                    <h4 class="modal-title">Delete Group</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <p>De certeza que deseja remover a sua conta?</p>
                    <p class="text-warning"><small>Esta ação não pode ser desfeita.</small></p>
                    <input id="deleteUserId" name="deleteUserId" type="hidden" class="form-control">
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Voltar">
                    <input type="submit" class="btn btn-danger" value="Apagar">
                </div>
            </form>
        </div>
    </div>
</div>


<!--Script's section-->
<script>

    $(document).ready(function () {

         // $("#userCountry").val(data[$user["name"]);

        // Adds Localities to dropdown
        //$('#editCountry').on('change', function() {
        //
        //    // Reset dropdown values
        //    // $('#editLocality').empty().append('<option></option>');
        //    $('#editPoiCity').empty().append('<option></option>');
        //
        //    let formData = {
        //        'action': "GetLocalities",
        //        'data': $('#editPoiCountry').val()
        //    };
        //
        //    // Adds Localities to dropdown
        //    $.ajax({
        //        url: "<?php //echo HOME_URL . '/PoiAdm';?>//",
        //        dataType: "json",
        //        type: 'POST',
        //        data : formData,
        //        success: function (json) {
        //            $.each(json['data'], function(i, obj){
        //                $('#userCountry').append($('<option>').text(obj['Name']).attr('value', obj['Id']));
        //            });
        //        }
        //    });
        //});

        //////// ajax to get data to Modal Edit User
        $('.edit').on('click', function () {
            let formData = {
                'action': "GetUser",
                'data': $(this).attr('id') //gets group id from id="" attribute on edit button from table
            };
            $.ajax({
                url: "<?php echo HOME_URL . '/home/userSettings';?>",
                dataType: "json",
                type: 'POST',
                data: formData,

                success: function (data) {

                    //TODO Os dados chegam aqui, mas não aparecem



                    $('[name="editUserId"]').val(data[0]['id']);
                    $('[name="editUserName"]').val(data[0]['name']);
                    $('[name="editUserEntity"]').val(data[0]['entity']);
                    $('[name="editUserDateBirth"]').val(data[0]['dateBirth']);
                    $('[name="editUserAddress"]').val(data[0]['address']);
                    $('[name="editUserCodPost"]').val(data[0]['codPost']);

                    //TODO ver como aparece os países

                    $('[name="editUserLocality"]').val(data[0]['locality']);
                    $('[name="editUserMobile"]').val(data[0]['mobile']);
                    $('[name="editUserNif"]').val(data[0]['nif']);
                    $('[name="editUserPass"]').val(data[0]['password']);

                    // //TODO ver como aparece os países
                    // $('[name="editUserCountry"]').val(data[0]['countryId']);
                    // $('[name="editUserGender"]').val(data[0]['genderId']);

                    // $('[name="editGroupDescription"]').val(data[0]['description']);
                    // $('[name="editGroupSecurityId"]').val(data[0]['securityId']);

                    // if (data[0]['active'] === 1) {
                    //     $('[name="editGroupActive"]').attr('checked', true);
                    // } else {
                    //     $('[name="editGroupActive"]').attr('checked', false);
                    // }

                    // $("#editUserModal").modal('show');
                },
                error: function (data) {
                    Swal.fire({
                        title: 'Error!',
                        text: data.body,
                        icon: 'error',
                        showConfirmButton: false,
                        // timer: 2000,
                        // didClose: () => {
                        //     location.reload();
                        // }
                    });
                }
            });
        });

        // ajax to update modal data  Edit User
        $('.updateUser').submit(function (event) {
            event.preventDefault(); //prevent default action
            // let chk_status = $("#checkBtn").prop('checked');
            // if (chk_status) {
            let formData = {
                'action': "UpdateUser",
                'data': $(this).serializeArray(),
            };
            $.ajax({
                url: "<?php echo HOME_URL . '/home/userSettings';?>",
                dataType: "json",
                type: 'POST',
                data: formData,
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
                                location.reload();
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
                }

            });
            // } else {
            //     alert('batatas');
            // }
        });

        // ajax to Delete User
        $('#deleteUser').submit(function (event) {
            event.preventDefault(); //prevent default action

            let formData = {
                'action': "DeleteUser",
                'data': $(this).serializeArray()
            };

            $.ajax({
                url: "<?php echo HOME_URL . '/home/userSettings';?>",
                dataType: "json",
                type: 'POST',
                data: formData,
                success: function (data) {
                    $("#deleteUserModal").modal('hide');

                    if (data.statusCode === 200) {
                        //mensagem de Success
                        Swal.fire({
                            title: 'Success!',
                            text: data.body.message,
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 2000,
                            didClose: () => {
                                location.reload();
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
                }
            });
        });

        function checkPasswordMatch() {
            let password = $("#txtNewPassword").val();
            let confirmPassword = $("#txtConfirmPassword").val();
            if (password != confirmPassword)
                $("#CheckPasswordMatch").html("Passwords does not match!");
            else
                $("#CheckPasswordMatch").html("Passwords match.");
        }

        $(document).ready(function () {
            $("#txtConfirmPassword").keyup(checkPasswordMatch);
        });
    });

</script>
<!--Script's end section-->