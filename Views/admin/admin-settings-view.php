<?php if (!defined('ABSPATH')) exit; ?>

<?php if ($this->login_required && !$this->logged_in) return; ?>

<!-- AJAX loader -->
<div id="loader" class="lds-dual-ring hidden overlay"></div>

<div id="layoutSidenav">
    <!-- import sidebar -->
    <?php require ABSPATH . '/views/_includes/admin-sidebar.php' ?>

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Gestão de <b>utilizadores</b></h1>
                <div class="row">
                    <div class="col-xl-12 col-md-12">
                        <div class="card mb-4">
                            <div class="card-header"></div>
                            <div class="card-body">
                                <div class="container light-style flex-grow-1 container-p-y">
                                    <div class="content-wrapper">

                                        <!-- Content -->
                                        <div class="container light-style flex-grow-1 container-p-y">
                                            <div class="card overflow-hidden">
                                                <div class="row no-gutters row-bordered row-border-light">
                                                    <div class="col-md-3 pt-0">
                                                        <div class="list-group list-group-flush account-settings-links">
                                                            <a class="list-group-item list-group-item-action active"
                                                               data-toggle="list" href="#account-general">Conta</a>
                                                            <a class="list-group-item list-group-item-action"
                                                               data-toggle="list" href="#account-change-password">Mudar
                                                                palavra-passe</a>
                                                            <a class="list-group-item list-group-item-action"
                                                               data-toggle="list" href="#account-info">Eliminar
                                                                conta</a>
                                                            <!--                                                            <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-social-links">Social links</a>-->
                                                            <!--                                                            <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-connections">Connections</a>-->
                                                            <!--                                                            <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-notifications">Notifications</a>-->
                                                        </div>
                                                    </div>

                                                    <!--Account General-->
                                                    <!-- Profile tab section-->
                                                    <?php if (!empty($this->userdata['adminList'])) {
                                                    foreach ($this->userdata['adminList'] as $key => $admin) { ?>
                                                    <div class="col-md-9">
                                                        <div class="tab-content">
                                                            <div class="tab-pane fade active show"
                                                                 id="account-general">
                                                                <hr class="border-light m-0">
                                                                <div class="card-body">
                                                                    <div class="form-group">
                                                                        <label><b>Nome:</b></label>
                                                                        <p> <?php echo $admin["name"] ?></p>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label>Entidade</label>
                                                                            <p><?php echo $admin["entity"] ?></p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label>Morada</label>
                                                                            <p><?php echo $admin["address"] ?></p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Código-postal</label>
                                                                            <p><?php echo $admin["codPost"] ?></p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Localidade</label>
                                                                            <p><?php echo $admin["locality"] ?></p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>País</label>
                                                                            <?php foreach ($this->userdata['countryList'] as $key => $val) { ?>
                                                                                <?php echo ($val['id'] == $admin["countryId"]) ? "<p>" . $val['name'] . "</p>" : ''; ?>
                                                                            <?php } ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Data de
                                                                                nascimento</label>
                                                                            <p><?php echo $admin["dateBirth"] ?></p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Gênero</label>
                                                                            <?php foreach ($this->userdata['genderList'] as $key => $val) { ?>
                                                                                <?php echo ($val['id'] == $admin["genderId"]) ? "<p>" . $val['name'] . "</p>" : ''; ?>
                                                                            <?php } ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>NIF</label>
                                                                            <p><?php echo $admin["nif"] ?></p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Telefone</label>
                                                                            <p><?php echo $admin["mobile"] ?></p>
                                                                        </div>
                                                                    </div>
                                                                    <!--                                                                </div>-->
                                                                    <div>
                                                                        <button class="btn edit btn-success"
                                                                                id="<?php echo $admin["email"]; ?>"
                                                                                data-toggle="modal"
                                                                                data-target="#editAdminModal">
                                                                            Editar
                                                                        </button>
                                                                        <!--                            <button class="btn btn-light">Cancel</button>-->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!--End Account General-->

                                                            <!--Change password-->
                                                            <div class="tab-pane fade" id="account-change-password">
                                                                <div class="card-body pb-2">
                                                                    <form id="updatePass">
                                                                        <div class="form-group">
                                                                            <input id="passEditUserId"
                                                                                   name="passEditUserId" type="hidden"
                                                                                   class="form-control"
                                                                                   value="<?php echo $admin["id"] ?>">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="form-label">Palavra-passe
                                                                                atual:</label>
                                                                            <input type="password" id="oldPass" name="oldPass" class="form-control"
                                                                                   required>
                                                                            <span id="verifyOldPass" class="badge-warning hidden"></span>
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label class="form-label">Nova
                                                                                palavra-passe:</label>
                                                                            <input type="password" id="pass" name="newPass" class="form-control"
                                                                                   required>
                                                                            <span id="verifyEqualPass" class="badge-warning hidden"></span>
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label class="form-label">Repita a
                                                                                palavra-passe:</label>
                                                                            <input type="password" id="verify" name="confPass" class="form-control"
                                                                                   required>
                                                                            <span id="verifyMatchPass" class="badge-warning hidden"></span>
                                                                        </div>

                                                                        <div>
                                                                            <div class="modal-footer">
                                                                                <input type="button"
                                                                                       class="btn edit btn-danger"
                                                                                       data-dismiss="modal"
                                                                                       value="Cancel">
                                                                                <input type="submit"
                                                                                       class="btn edit btn-success"
                                                                                       value="Save">
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                            <!--End Change password-->

                                                            <!--End Delete Account-->
                                                            <div class="tab-pane fade" id="account-info">
                                                                <div class="card-body pb-2">

                                                                    <div class="form-group">
                                                                        <label class="form-label">Bio</label>
                                                                        <textarea class="form-control" rows="5">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris nunc arcu, dignissim sit amet sollicitudin iaculis, vehicula id urna. Sed luctus urna nunc. Donec fermentum, magna sit amet rutrum pretium, turpis dolor molestie diam, ut lacinia diam risus eleifend sapien. Curabitur ac nibh nulla. Maecenas nec augue placerat, viverra tellus non, pulvinar risus.</textarea>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="form-label">Birthday</label>
                                                                        <input type="text" class="form-control"
                                                                               value="May 3, 1995">
                                                                    </div>
                                                                </div>
                                                            </div>


                                                            <div class="tab-pane fade" id="account-connections">
                                                                <div class="card-body">
                                                                    <button type="button" class="btn btn-twitter">
                                                                        Connect to <strong>Twitter</strong></button>
                                                                </div>
                                                                <hr class="border-light m-0">
                                                                <div class="card-body">
                                                                    <h5 class="mb-2">
                                                                        <a href="javascript:void(0)"
                                                                           class="float-right text-muted text-tiny"><i
                                                                                    class="ion ion-md-close"></i>
                                                                            Remove</a>
                                                                        <i class="ion ion-logo-google text-google"></i>
                                                                        You are connected to Google:
                                                                    </h5>
                                                                    nmaxwell@mail.com
                                                                </div>
                                                                <hr class="border-light m-0">
                                                                <div class="card-body">
                                                                    <button type="button" class="btn btn-facebook">
                                                                        Connect to <strong>Facebook</strong>
                                                                    </button>
                                                                </div>
                                                                <hr class="border-light m-0">
                                                                <div class="card-body">
                                                                    <button type="button" class="btn btn-instagram">
                                                                        Connect to <strong>Instagram</strong>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>


    <!-- Edit Profile Modal HTML -->
    <div id="editAdminModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edite os seus dados</h4>

                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="updateAdmin">
                        <div class="form-group">
                            <input id="editAdminId" name="editAdminId" type="hidden" class="form-control"
                                   value="<?php echo $admin["id"] ?>">
                        </div>

                        <div class="form-group">
                            <label>Nome:</label>
                            <input type="text" class="form-control" name="editAdminName"
                                   value="">
                        </div>

                        <div class="form-group">
                            <label>Entidade:</label>
                            <input type="text" class="form-control" name="editAdminEntity" value="">

                        </div>

                        <div class="form-group">
                            <label>Morada:</label>
                            <input type="text" class="form-control" name="editAdminAddress" value="">
                        </div>

                        <div class="form-group">
                            <label>Código-postal:</label>
                            <input type="text" class="form-control" name="editAdminCodPost" value="">
                        </div>

                        <div class="form-group">
                            <label>Localidade:</label>
                            <input type="text" class="form-control" name="editAdminLocality" value="">
                        </div>
                        <div class="form-group">
                            <label>País:</label>
                            <select class="form-control" id="editAdminCountry" name="editAdminCountry">
                                <?php foreach ($this->userdata['countryList'] as $key => $val) { ?>
                                    <option value="<?php echo $val['id']; ?>" <?php echo ($val['id'] == $admin["countryId"]) ? 'selected="selected"' : '' ?> > <?php echo $val['name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Nif:</label>
                            <input type="text" class="form-control" name="editAdminNif" value="">
                        </div>
                        <div class="form-group">
                            <label>Telefone:</label>
                            <input type="text" class="form-control" name="editAdminMobile">
                        </div>
                        <div class="form-group">
                            <label>País:</label>
                            <select class="form-control" id="editAdminGender" name="editAdminGender">
                                <?php foreach ($this->userdata['genderList'] as $key => $val) { ?>
                                    <option value="<?php echo $val['id']; ?>" <?php echo ($val['id'] == $admin["genderId"]) ? 'selected="selected"' : '' ?> > <?php echo $val['name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Password:</label>
                            <input type="password" class="form-control" name="editAdminPasswordAA">
                        </div>
                        <div class="form-group">
                            <label>Data de aniversário:</label>
                            <input type="date" class="form-control" name="editAdminDateBirth">
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
}
?>


<script>
    $(document).ready(function () {
        // ajax to get data to Modal Edit Admin
        $('.edit').on('click', function () {
            let formData = {
                'action': "GetAdmin",
                'data': $(this).attr('id') //gets group id from id="" attribute on edit button from table
            };
            $.ajax({
                url: "<?php echo HOME_URL . '/admin/settings';?>",
                dataType: "json",
                type: 'POST',
                data: formData,

                success: function (data) {

                    //TODO Os dados chegam aqui, mas não aparecem


                    $('[name="editAdminId"]').val(data[0]['id']);
                    $('[name="editAdminName"]').val(data[0]['name']);
                    $('[name="editAdminEntity"]').val(data[0]['entity']);
                    $('[name="editAdminDateBirth"]').val(data[0]['dateBirth']);
                    $('[name="editAdminAddress"]').val(data[0]['address']);
                    $('[name="editAdminCodPost"]').val(data[0]['codPost']);
                    $('[name="editAdminLocality"]').val(data[0]['locality']);
                    $('[name="editAdminMobile"]').val(data[0]['mobile']);
                    $('[name="editAdminNif"]').val(data[0]['nif']);
                    $('[name="editAdminPass"]').val(data[0]['password']);

                    $('#updateAdmin input').each(function () {
                        $(this).data('lastValue', $(this).val());
                    });


                    // $("#editAdminModal").modal('show');
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
        // ajax to update modal data  Edit Admin
        $('#updateAdmin').submit(function (event) {
            event.preventDefault(); //prevent default action

            let formDataChanged = [];
            $('#updateAdmin input').each(function () { //para cada input vai ver
                if ($(this).attr('name') === "editAdminId" || $(this).data('lastValue') !== $(this).val()) {//se a data anterior é diferente da current
                    let emptyArray = {name: "", value: ""};
                    emptyArray.name = $(this).attr('name');
                    emptyArray.value = $(this).val();
                    formDataChanged.push(emptyArray);
                }
            });
            let formData = {
                'action': "UpdateAdmin",
                'data': formDataChanged
            };

            $.ajax({
                url: "<?php echo HOME_URL . '/admin/settings';?>",
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
        });

        // ajax to update modal data  Edit User
        $('#updatePass').submit(function (event) {
            event.preventDefault(); //prevent default action
            let formData = {
                'action': "UpdateAdminPass",
                'data': $(this).serializeArray()
            };
            $.ajax({
                url: "<?php echo HOME_URL . '/admin/settings';?>",
                dataType: "json",
                type: 'POST',
                data: formData,
                success: function (data) {
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
                        didClose: () => {
                            //location.reload();
                        }
                    });
                }
            });
        });
        //function handler spn messages
        $('#updatePass').click(function () {
            $(this).parent().find('#verifyOldPass').hide();
            $(this).parent().find('#verifyEqualPass').hide();
            $(this).parent().find('#verifyMatchPass').hide();
        });


    });
</script>