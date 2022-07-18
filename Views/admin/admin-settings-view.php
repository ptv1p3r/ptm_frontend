
<?php if ( !defined('ABSPATH') ) exit; ?>

<?php if ( $this->login_required && !$this->logged_in ) return; ?>

<!-- AJAX loader -->
<div id="loader" class="lds-dual-ring hidden overlay"></div>

<div id="layoutSidenav">
    <!-- import sidebar -->
    <?php require ABSPATH . '/views/_includes/admin-sidebar.php' ?>

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Meus dados</h1>
                <div class="row">

                    <div class="col-xl-6 col-md-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                Editar dados
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <form id="updateAdmin">
                                        <div class="form-group">
                                            <input id="editAdminId" name="editAdminId" type="hidden" class="form-control" value="<?php echo $_SESSION["userdata"]["id"] ?>" required>
                                        </div>

                                        <div class="form-group">
                                            <label>Nome:</label>
                                            <input type="text" class="form-control" name="editAdminName" value="<?php echo $_SESSION["userdata"]["name"] ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Entidade:</label>
                                            <input type="text" class="form-control" name="editAdminEntity" value="<?php echo $_SESSION["userdata"]["entity"] ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Morada:</label>
                                            <input type="text" class="form-control" name="editAdminAddress" value="<?php echo $_SESSION["userdata"]["address"] ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Código-postal:</label>
                                            <input type="text" class="form-control" name="editAdminCodPost" value="<?php echo $_SESSION["userdata"]["codPost"] ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Localidade:</label>
                                            <input type="text" class="form-control" name="editAdminLocality" value="<?php echo $_SESSION["userdata"]["locality"] ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>País:</label>
                                            <select class="form-select" id="editAdminCountry" name="editAdminCountry" required>
                                                <?php foreach ($this->userdata['countryList'] as $key => $val) { ?>
                                                    <option value="<?php echo $val['id']; ?>" <?php echo ($val['id'] == $_SESSION["userdata"]["countryId"]) ? 'selected="selected"' : '' ?> > <?php echo $val['name']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>NIF:</label>
                                            <input type="text" class="form-control" name="editAdminNif" value="<?php echo $_SESSION["userdata"]["nif"] ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Telefone:</label>
                                            <input type="text" class="form-control" name="editAdminMobile" value="<?php echo $_SESSION["userdata"]["mobile"] ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Género:</label>
                                            <select class="form-select" id="editAdminGender" name="editAdminGender" required>
                                                <?php foreach ($this->userdata['genderList'] as $key => $val) { ?>
                                                    <option value="<?php echo $val['id']; ?>" <?php echo ($val['id'] == $_SESSION["userdata"]["genderId"]) ? 'selected="selected"' : '' ?> > <?php echo $val['name']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Data de nascimento:</label>
                                            <input type="date" class="form-control" name="editAdminDateBirth" value="<?php echo $_SESSION["userdata"]["dateBirth"] ?>" required>
                                        </div>
                                        <br>
                                        <!--<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">-->
                                        <input id="save-button" type="submit" class="btn btn-success" value="Guardar">
                                    </form>

                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-xl-6 col-md-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                Palavra-passe
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <form id="updatePass">
                                        <div class="form-group">
                                            <input id="passAdminId" name="passAdminId" type="hidden" class="form-control" value="<?php echo $_SESSION["userdata"]["id"] ?>">
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label"><b>Palavra-passe atual:</b></label>
                                            <input type="password" id="oldPass" name="oldPass" class="form-control" required>
                                            <span id="verifyOldPass" class="badge bg-warning hidden"></span>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label col-md-6"><b>Nova palavra-passe:</b></label>
                                            <input type="password" id="pass" name="newPass" class="form-control" required>
                                            <span id="verifyEqualPass" class="badge bg-warning hidden"></span>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label col-md-6"><b>Repita a palavra-passe:</b></label>
                                            <input type="password" id="verify" name="confPass" class="form-control" required>
                                            <span id="verifyMatchPass" class="badge bg-warning hidden"></span>
                                        </div>
                                        <br>
                                        <!--<input type="button" class="btn edit btn-danger" data-dismiss="modal" value="Cancel">-->
                                        <input type="submit" class="btn btn-success" value="Guardar">
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </main>



<script>
    $(document).ready(function () {

        // ajax to update modal data  Edit Admin
        $('#updateAdmin').submit(function (event) {
            event.preventDefault(); //prevent default action

            /*let formDataChanged = [];
            $('#updateAdmin input').each(function () { //para cada input vai ver
                if ($(this).attr('name') === "editAdminId" || $(this).attr('id') !== "save-button" || $(this).data('lastValue') !== $(this).val()) {//se a data anterior é diferente da current
                    let emptyArray = {name: "", value: ""};
                    emptyArray.name = $(this).attr('name');
                    emptyArray.value = $(this).val();
                    formDataChanged.push(emptyArray);
                }
            });

            let formData = {
                'action': "UpdateAdmin",
                'data': formDataChanged
            };*/

            let formData = {
                'action': "UpdateAdmin",
                'data': $(this).serializeArray()
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
                            title: 'Sucesso!',
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
                            title: 'Erro!',
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
                        title: 'Erro!',
                        text: "Erro de conexão, por favor tente denovo.",
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
                            title: 'Sucesso!',
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
                            title: 'Erro!',
                            text: data.body.message,
                            icon: 'error',
                            showConfirmButton: false,
                            timer: 2000,
                            didClose: () => {
                                //location.reload();
                            }
                        });
                    } else {
                        if (data.statusCode === 0) {
                            $('#verifyOldPass').text(data.body.message).show();
                        }
                        if (data.statusCode === 1) {
                            $('#verifyEqualPass').text(data.body.message).show();
                        }
                        if (data.statusCode === 2) {
                            $('#verifyMatchPass').text(data.body.message).show();
                        }
                    }
                },
                error: function (data) {
                    //mensagem de Error
                    Swal.fire({
                        title: 'Erro!',
                        text: "Erro de conexão, por favor tente denovo.",
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
        $('#updatePass input').on("click", function (){
            if($(this).attr("name") === "oldPass"){ $(this).parent().find("#verifyOldPass").hide(); }
            if($(this).attr("name") === "newPass"){ $(this).parent().find("#verifyEqualPass").hide(); }
            if($(this).attr("name") === "confPass"){ $(this).parent().find("#verifyMatchPass").hide(); }
        });

    });
</script>