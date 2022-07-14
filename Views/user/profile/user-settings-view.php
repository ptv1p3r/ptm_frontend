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

<div id="wrapper">
    <!--Profile user edit account Start-->
    <section class="py-5 my-5">
        <div class="container" style="max-width: 1500px;!important;">
            <h1 class="mb-5">Definições gerais</h1>
            <div class="bg-white rounded-lg d-block d-sm-flex">
                <div class="profile-tab-nav border-right">
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
                        <!--Permissions Test-->
                        <?php $this->permission_required = array('treeRead');
                        if (!$this->check_permissions($this->permission_required, $_SESSION["userdata"]['user_permissions'])) { ?>
                            <a class="nav-link" id="application-tab" data-toggle="pill" href="#transaction" role="tab"
                               aria-controls="application" aria-selected="false">
                                <i class="fas fa-wallet text-center mr-1"></i>
                                Transações
                            </a>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="tab-content p-4 p-md-5 profile-tab" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="account" role="tabpanel" aria-labelledby="account-tab">
                        <h3 class="mb-4">Dados da conta</h3>


                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-6 ">
                                    <div class="form-group">
                                    <i class="fas fa-user" style="color: #1c7430" text-center mr-1></i>
                                        <label>Nome</label>

                                        <p> <?php echo $_SESSION["userdata"]["name"] ?></p>
                                    </div>
                                </div>
                                <div class="col-md-6 ml-auto">
                                   <div class="form-group">
                                   <i class="fas fa-briefcase" style="color: #1c7430" text-center mr-2></i>
                                    <label>Entidade</label>
                                    <p><?php echo $_SESSION["userdata"]["entity"] ?></p>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-6 ">
                                    <div class="form-group">
                                     <i class="fas fa-home" style="color: #1c7430" text-center mr-1></i>
                                        <label>Morada</label>
                                       <p><?php echo $_SESSION["userdata"]["address"] ?></p>
                                    </div>
                                </div>
                                <div class="col-md-6 ml-auto">
                                   <div class="form-group">
                                   <i class="fas fa-map-marker" style="color: #1c7430" text-center mr-1></i>
                                    <label>Código-postal</label>
                                   <p><?php echo $_SESSION["userdata"]["codPost"] ?></p>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-6 ">
                                    <div class="form-group">
                                     <i class="fas fa-city" style="color: #1c7430" text-center mr-1></i>
                                        <label>Morada</label>
                                       <p><?php echo $_SESSION["userdata"]["locality"] ?></p>
                                    </div>
                                </div>
                                <div class="col-md-6 ml-auto">
                                   <div class="form-group">
                                   <i class="fas fa-flag" style="color: #1c7430" text-center mr-1></i>
                                    <label>País</label>
                                   <?php foreach ($this->userdata['countryList'] as $key => $val) { ?>
                                        <?php echo ($val['id'] == $_SESSION["userdata"]["countryId"]) ? "<p>" . $val['name'] . "</p>" : ''; ?>
                                    <?php } ?>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-6 ">
                                    <div class="form-group">
                                    <i class="fas fa-fingerprint" style="color: #1c7430" text-center mr-1></i>
                                     <label>NIF</label>
                                    <p><?php echo $_SESSION["userdata"]["nif"] ?></p>
                                    </div>
                                </div>
                                <div class="col-md-6 ml-auto">
                                   <div class="form-group">
                                   <i class="fas fa-mobile-alt" style="color: #1c7430" text-center mr-1></i>
                                     <label>Telefone</label>
                                    <p><?php echo $_SESSION["userdata"]["mobile"] ?></p>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-6 ">
                                    <div class="form-group">
                                    <i class="fas fa-baby" style="color: #1c7430" text-center mr-1></i>
                                      <label>Data de nascimento</label>
                                    <p><?php echo $_SESSION["userdata"]["dateBirth"] ?></p>
                                    </div>
                                </div>
                                <div class="col-md-6 ml-auto">
                                   <div class="form-group">
                                       <i class="fas fa-genderless" style="color: #1c7430" text-center mr-1></i>
                                         <label>Gênero</label>
                                         <?php foreach ($this->userdata['genderList'] as $key => $val) { ?>
                                            <?php echo ($val['id'] == $_SESSION["userdata"]["genderId"]) ? "<p>" . $val['name'] . "</p>" : ''; ?>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <button class="btn edit btn-success" id="<?php echo $_SESSION["userdata"]["email"]; ?>" data-toggle="modal"
                                    data-target="#editUserModal">Editar
                            </button>
                        </div>
                    </div>
                    <!--End profile tab section-->
                    <!--Edit password tab section-->
                    <div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
                        <h3 class="mb-4">Alterar palavra-passe</h3>
                        <form id="updatePass">
                            <div class="form-group">
                                <input id="passEditUserId" name="passEditUserId" type="hidden" class="form-control"
                                       value="<?php echo $_SESSION["userdata"]["id"] ?>">
                            </div>
                            <div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Palavra-passe antiga</label>
                                        <input type="password" id="oldPass" name="oldPass" class="form-control"
                                               required>
                                        <span id="verifyOldPass" class="badge-warning hidden"></span>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nova palavra-passe</label>
                                        <input type="password" id="pass" name="newPass" class="form-control"
                                               required>
                                        <span id="verifyEqualPass" class="badge-warning hidden"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Confirme a nova palavra-passe</label>
                                        <input type="password" id="verify" name="confPass" class="form-control"
                                               required>
                                        <span id="verifyMatchPass" class="badge-warning hidden"></span>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="col-md-6">
                                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
                                    <input type="submit" class="btn btn-success" value="Salvar">
                                </div>
                            </div>
                        </form>
                    </div>
                    <!--End Edit password tab section-->
                    <!--Remove account tab section-->
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
                    <!--Remove account tab section-->
                    <!--Test premissions account tab section-->
                    <div class="tab-pane fade" id="transaction" role="tabpanel" aria-labelledby="security-tab">
                        <h3 class="mb-4">Transações</h3>
                        <div>
                            <!--Section tree Intrevation Sart-->
                            <section class="wf100 p30">
                                <div class="container">
                                    <div>
                                        <table class="table table-bordered mytable display" id="transTable"
                                               style="width: 100%">
                                            <thead>
                                            <tr>
                                                <th style="text-align: left;">Transação</th>
                                                <th>Tipo</th>
                                                <th>Método</th>
                                                <th>NIF</th>
                                                <th>Árvore</th>
                                                <th>Valor</th>
                                                <th>Estado</th>
                                                <th style="font-size: small;">Data/criação</th>
                                                <th style="font-size: small;">Data/alteração</th>
                                                <th style="font-size: small;">Data/validação</th>
                                            </tr>
                                            </thead>
                                            <?php if (!empty($this->userdata['userTransList'])) {
                                                foreach ($this->userdata['userTransList'] as $key => $trans) { ?>
                                                    <tbody>
                                                    <tr>
                                                        <td class="long-td" data-toggle="popover" data-trigger="hover"
                                                            data-content="<?php echo $trans["id"] ?>"><?php echo $trans["id"] ?></td>
                                                        <td class="long-td" data-toggle="popover" data-trigger="hover"
                                                            data-content="<?php echo $trans["typeName"] ?>"><?php echo $trans["typeName"] ?></td>
                                                        <td class="long-td" data-toggle="popover" data-trigger="hover"
                                                            data-content="<?php echo $trans["methodName"] ?>"><?php echo $trans["methodName"] ?></td>
                                                        <td class="long-td" data-toggle="popover" data-trigger="hover"
                                                            data-content="<?php echo $trans["userNif"] ?>"><?php echo $trans["userNif"] ?></td>
                                                        <td class="long-td" data-toggle="popover" data-trigger="hover"
                                                            data-content="<?php echo $trans["treeId"] ?>"><?php echo $trans["treeId"] ?></td>
                                                        <td class="long-td" data-toggle="popover" data-trigger="hover"
                                                            data-content="<?php echo $trans["value"] ?>"><?php echo $trans["value"] ?></td>
                                                        <td class="long-td" data-toggle="popover" data-trigger="hover"
                                                            data-content="<?php echo $trans["state"] ?>"><?php echo $trans["state"] ?></td>
                                                        <td class="long-td" data-toggle="popover" data-trigger="hover"
                                                            data-content="<?php echo $trans["dateCreated"] ?>"><?php echo $trans["dateCreated"] ?></td>
                                                        <td class="long-td" data-toggle="popover" data-trigger="hover"
                                                            data-content="<?php echo $trans["dateModified"] ?>"><?php echo $trans["dateModified"] ?></td>
                                                        <td class="long-td" data-toggle="popover" data-trigger="hover"
                                                            data-content="<?php echo $trans["dateValidated"] ?>"><?php echo $trans["dateValidated"] ?></td>
                                                    </tr>
                                                    </tbody>
                                                <?php }
                                            } else { ?>
                                                <tbody>
                                                <tr>
                                                </tr>
                                                </tbody>
                                            <?php } ?>
                                        </table>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Edit Profile Modal HTML -->
    <div id="editUserModal" class="modal fade center" data-keyboard="false"
         data-backdrop="false" style="background-color: rgba(0, 0, 0, 0.5);" tabindex="-1"
         aria-labelledby="bulkDeleteMessagesModal-Label" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edite os seus dados</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="updateUser">
                        <div class="modal-body">
                            <div class="form-group">
                                <input id="editUserId" name="editUserId" type="hidden" class="form-control"
                                       value="<?php echo $_SESSION["userdata"]["id"] ?>">
                            </div>
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-6 ">
                                        <label style="color: #66bb6a"><b>Nome:</b></label>
                                        <input type="text" class="form-control" name="editUserName"
                                               value="<?php echo $_SESSION["userdata"]["name"] ?>">
                                    </div>
                                    <div class="col-md-6 ml-auto">
                                        <label style="color: #66bb6a"><b>Entidade:</b></label>
                                        <input type="text" class="form-control" name="editUserEntity" value="<?php echo $_SESSION["userdata"]["entity"] ?>">
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6 ">
                                        <label style="color: #66bb6a"><b>Morada:</b></label>
                                        <input type="text" class="form-control" name="editUserAddress" value="<?php echo $_SESSION["userdata"]["address"] ?>">
                                    </div>
                                    <div class="col-md-6 ml-auto">
                                        <label style="color: #66bb6a"><b>Localidade:</b></label>
                                        <input type="text" class="form-control" name="editUserLocality" value="<?php echo $_SESSION["userdata"]["locality"] ?>">
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6 ml-auto">
                                        <label style="color: #66bb6a"><b>Código-postal:</b></label>
                                        <input type="text" class="form-control" name="editUserCodPost" value="<?php echo $_SESSION["userdata"]["codPost"] ?>">
                                    </div>
                                    <div class="col-md-6 ml-auto">
                                        <label style="color: #66bb6a"><b>País:</b></label>
                                        <select class="form-control" id="editUserCountry" name="editUserCountry">
                                            <?php foreach ($this->userdata['countryList'] as $key => $val) { ?>
                                                <option value="<?php echo $val['id']; ?>" <?php echo ($val['id'] == $_SESSION["userdata"]["countryId"]) ? 'selected="selected"' : '' ?> > <?php echo $val['name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6 ml-auto">
                                        <label style="color: #66bb6a"><b>NIF:</b></label>
                                        <input type="text" class="form-control" name="editUserNif" value="<?php echo $_SESSION["userdata"]["nif"] ?>">
                                    </div>
                                    <div class="col-md-6 ml-auto">
                                        <label style="color: #66bb6a"><b>Telefone:</b></label>
                                        <input type="text" class="form-control" name="editUserMobile" value="<?php echo $_SESSION["userdata"]["mobile"] ?>">
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6 ml-auto">
                                        <label style="color: #66bb6a"><b>Gênero:</b></label>
                                        <select class="form-control" id="editUserGender" name="editUserGender">
                                            <?php foreach ($this->userdata['genderList'] as $key => $val) { ?>
                                                <option value="<?php echo $val['id']; ?>" <?php echo ($val['id'] == $_SESSION["userdata"]["genderId"]) ? 'selected="selected"' : '' ?> > <?php echo $val['name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6 ml-auto">
                                        <label style="color: #66bb6a"><b>Data de aniversário:</b></label>
                                        <input type="date" class="form-control" name="editUserDateBirth" value="<?php echo $_SESSION["userdata"]["dateBirth"] ?>">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <input type="button" class="btn btn-secondary" data-dismiss="modal" value="Voltar">
                            <input type="submit" class="btn btn-success" value="Salvar">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
<!-- End Edit Profile Modal HTML -->

<!-- Delete Modal HTML -->
<div id="deleteUserModal" class="modal fade center" data-keyboard="false"
             data-backdrop="false" style="background-color: rgba(0, 0, 0, 0.5);" tabindex="-1"
             aria-labelledby="bulkDeleteMessagesModal-Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="deleteUser">
                <div class="modal-header">
                    <h4 class="modal-title">Apagar conta</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <p>De certeza que deseja remover a sua conta?</p>
                    <p class="text-warning"><small>Esta ação não pode ser desfeita.</small></p>
                    <input id="deleteUserId" name="deleteUserId" type="hidden" class="form-control">
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-secundary" data-dismiss="modal" value="Voltar">
                    <input type="submit" class="btn btn-danger" value="Apagar">
                </div>
            </form>
        </div>
    </div>
</div>

<!--Script's section-->
<script>
    $(document).ready(function () {


        //DATATABLES
        try {
            var table = $('#transTable').DataTable({
                rowReorder: false,
                responsive: true,
                lengthChange: false,
                pageLength: 15,
                // colReorder: false,
                columns: [
                    {"width": "9%", orderable: false},
                    {"width": "9%", orderable: false},
                    {"width": "10%", orderable: false},
                    {"width": "10%", orderable: false},
                    {"width": "10%", orderable: false},
                    {"width": "5%", orderable: false},
                    {"width": "10%", orderable: false},
                    {"width": "15%", orderable: false},
                    {"width": "16%", orderable: false},
                    {"width": "16%", orderable: false}
                ],
                oLanguage: {
                    "sUrl": "https://cdn.datatables.net/plug-ins/1.12.1/i18n/pt-PT.json"
                }
            });
        } catch (error) {
            console.log(error);
        }

        // ajax to update modal data  Edit User
        $('#updateUser').submit(function (event) {
            event.preventDefault(); //prevent default action

            let formData = {
                'action': "UpdateUser",
                'data': $(this).serializeArray()
            };
            //Ajax function call
            $.ajax({
                url: "<?php echo HOME_URL . '/home/userSettings';?>",
                dataType: "json",
                type: 'POST',
                data: formData,
                beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                    $('#loader').removeClass('hidden')
                },
                success: function (data) {
                    $("#editUserModal").modal('hide');
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
                    });
                },
                complete: function () { // Set our complete callback, adding the .hidden class and hiding the spinner.
                    $('#loader').addClass('hidden')
                }
            });
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
                beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                    $('#loader').removeClass('hidden')
                },
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
                    });
                },
                complete: function () { // Set our complete callback, adding the .hidden class and hiding the spinner.
                    $('#loader').addClass('hidden')
                }
            });
        });
        // ajax to update modal data  Edit User
        $('#updatePass').submit(function (event) {
            event.preventDefault(); //prevent default action
            let formData = {
                'action': "UpdateUserPass",
                'data': $(this).serializeArray()
            };
            $.ajax({
                url: "<?php echo HOME_URL . '/home/userSettings';?>",
                dataType: "json",
                type: 'POST',
                data: formData,
                beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                    $('#loader').removeClass('hidden')
                },
                success: function (data) {
                    //Status response error messages
                    //Success response
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
                    } else if (data.statusCode === 400) {
                        //Error message
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
                    } else {
                        if (data.statusCode == 0) {
                            $('#verifyOldPass').text(data.body.message);
                            $('#verifyOldPass').show();
                        }
                        if (data.statusCode == 1) {
                            $('#verifyEqualPass').text(data.body.message);
                            $('#verifyEqualPass').show();
                        }
                        if (data.statusCode == 2) {
                            $('#verifyMatchPass').text(data.body.message);
                            $('#verifyMatchPass').show();
                        }
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
                    });
                },
                complete: function () { // Set our complete callback, adding the .hidden class and hiding the spinner.
                    $('#loader').addClass('hidden')
                }
            });
        });
        //function handler spn messages
        $('#updatePass').click(function () {
            $(this).parent().find('#verifyOldPass').hide();
            $(this).parent().find('#verifyEqualPass').hide();
            $(this).parent().find('#verifyMatchPass').hide();
        });

        $(document).ready(function () {
            $('[data-toggle="popover"]').popover({})
        });
    });
</script>
<!--Script's end section-->