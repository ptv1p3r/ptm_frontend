
<?php if ( ! defined('ABSPATH')) exit; ?>

<?php if ( $this->login_required && ! $this->logged_in ) return; ?>

<!-- AJAX loader -->
<div id="loader" class="lds-dual-ring hidden overlay"></div>

<div id="layoutSidenav">
    <!-- import sidebar -->
    <?php require ABSPATH . '/views/_includes/admin-sidebar.php'?>

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Gestão de <b>utilizadores</b></h1>
                <div class="row">

                    <div class="col-xl-12 col-md-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <a href="#addUserModal" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addUserModal">
                                    <i class="fas fa-plus-circle"></i><span>&nbsp;Novo utilizador</span>
                                </a>
                                <div class="float-end">
                                    <label>filtro:</label>
                                    <select id='GetActive'>
                                        <option value=''>Todos</option>
                                        <option value='1'>Ativos</option>
                                        <option value='0'>Inativos</option>
                                    </select>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="usersTable" class="table table-striped table-hover" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th>Identificador</th>
                                            <th>Nome</th>
                                            <th>Entidade</th>
                                            <th>Email</th>
                                            <th>Grupo</th>
                                            <th>País</th>
                                            <th>Data Criação</th>
                                            <th>Data Modificação</th>
                                            <th hidden>active</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php if (!empty($this->userdata['usersList'])) {
                                            foreach ($this->userdata['usersList'] as $key => $user) { ?>
                                                <tr>
                                                    <td id="mybyoau225-<?php echo $user["id"] ?>"
                                                        onclick="copy('<?php echo $user["id"] ?>','mybyoau225-<?php echo $user["id"] ?>')"
                                                        title="<?php echo $user["id"] ?>"
                                                        class="table-text-truncate"
                                                        style="cursor: pointer">
                                                        <?php echo $user["id"] ?>
                                                    </td>
                                                    <td id="h6xsvpd7tw-<?php echo $user["id"] ?>"
                                                        onclick="copy('<?php echo $user["name"] ?>','h6xsvpd7tw-<?php echo $user["id"] ?>')"
                                                        title="<?php echo $user["name"] ?>"
                                                        class="table-text-truncate"
                                                        style="cursor: pointer">
                                                        <?php echo $user["name"] ?>
                                                    </td>
                                                    <?php $userEntity = (empty($user["entity"])) ? "Vazio" : $user["entity"] ?>
                                                    <td id="grm5lifkpl-<?php echo $user["id"] ?>"
                                                        onclick="copy('<?php echo $userEntity ?>','grm5lifkpl-<?php echo $user["id"] ?>')"
                                                        title="<?php echo $userEntity ?>"
                                                        class="table-text-truncate"
                                                        style="cursor: pointer">
                                                        <?php echo $userEntity ?>
                                                    </td>
                                                    <td id="h5or6lbi27-<?php echo $user["id"] ?>"
                                                        onclick="copy('<?php echo $user["email"] ?>','h5or6lbi27-<?php echo $user["id"] ?>')"
                                                        title="<?php echo $user["email"] ?>"
                                                        class="table-text-truncate"
                                                        style="cursor: pointer">
                                                        <?php echo $user["email"] ?>
                                                    </td>
                                                    <?php if (!empty($this->userdata['groupsList'])) { foreach ($this->userdata['groupsList'] as $key => $group) { if ( $group["id"] == $user["groupId"]){ $groupName = $group["name"]; } } }?>
                                                    <td id="xtz9d92jhc-<?php echo $user["id"] ?>"
                                                        onclick="copy('<?php echo $groupName ?>','xtz9d92jhc-<?php echo $user["id"] ?>')"
                                                        title="<?php echo $groupName ?>"
                                                        class="table-text-truncate"
                                                        style="cursor: pointer">
                                                        <?php echo $groupName ?>
                                                    </td>
                                                    <?php if (!empty($this->userdata['countryList'])) { foreach ($this->userdata['countryList'] as $key => $country) { if ( $country["id"] == $user["countryId"]){ $countryName = $country["name"]; } } } ?>
                                                    <td id="1idt83yteh-<?php echo $user["id"] ?>"
                                                        onclick="copy('<?php echo $countryName ?>','1idt83yteh-<?php echo $user["id"] ?>')"
                                                        title="<?php echo $countryName ?>"
                                                        class="table-text-truncate"
                                                        style="cursor: pointer">
                                                        <?php echo $countryName ?>
                                                    </td>
                                                    <td id="h3nsen32jn-<?php echo $user["id"] ?>"
                                                        onclick="copy('<?php echo $user["dateCreated"] ?>','h3nsen32jn-<?php echo $user["id"] ?>')"
                                                        title="<?php echo $user["dateCreated"] ?>"
                                                        class="table-text-truncate"
                                                        style="cursor: pointer">
                                                        <?php echo $user["dateCreated"] ?>
                                                    </td>
                                                    <td id="kern3tvns3-<?php echo $user["id"] ?>"
                                                        onclick="copy('<?php echo $user["dateModified"] ?>','kern3tvns3-<?php echo $user["id"] ?>')"
                                                        title="<?php echo $user["dateModified"] ?>"
                                                        class="table-text-truncate"
                                                        style="cursor: pointer">
                                                        <?php echo $user["dateModified"] ?>
                                                    </td>
                                                    <td hidden><?php echo $user["active"] ?></td>
                                                    <td>
                                                        <div class="float-end">
                                                        <?php if($user["id"] !== $_SESSION["userdata"]["id"]) { //if list user id is equal to whats in the $_SESSION, dont show the edit button?>
                                                            <a href="#editUserModal" id="<?php echo $user['email'] ?>" class="edit m-2" title="Editar"
                                                               data-bs-toggle="modal" data-bs-target="#editUserModal"><i class="far fa-edit fa-lg"></i></a>

                                                            <a href="#deleteUserModal" id="<?php echo $user['id'] ?>" class="delete m-2" title="Apagar"
                                                               data-bs-toggle="modal" data-bs-target="#deleteUserModal"><i class="fas fa-trash-alt fa-lg"></i></a>
                                                        <?php }?>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php }
                                        } else { ?>
                                            <tr>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </main>


        <!-- Add Modal HTML -->
        <div id="addUserModal" class="modal fade" tabindex="-1" aria-labelledby="addUserModal-Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="addUser">
                        <div class="modal-header">
                            <h4 class="modal-title">Novo utilizador</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Nome</label>
                                <input type="text" class="form-control" name="addUserName" required>
                            </div>
                            <div class="form-group">
                                <label>Entidade</label>
                                <input type="text" class="form-control" name="addUserEntity" >
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="addUserEmail" required>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="addUserPassword" required>
                            </div>
                            <div class="form-group">
                                <label>Grupo</label>
                                <!--<input type="text" class="form-control" name="addUserGroupId" required>-->
                                <select id="addUserGroupId" class="form-select" name="addUserGroupId" required>
                                    <option value="" disabled selected>Selecione o grupo</option>
                                    <?php if (!empty($this->userdata['groupsList'])) {
                                        foreach ($this->userdata['groupsList'] as $key => $group) { ?>
                                            <option value="<?php echo $group['id'] ?>"><?php echo $group["name"] ?></option>
                                        <?php }
                                    } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Data de nascimento</label>
                                <!--<input type="text" class="form-control" name="addUserDateBirth" placeholder="yyyy-mm-dd" required>-->
                                <div class='input-group' id='datetimepicker1' data-td-target-input='nearest' data-td-target-toggle='nearest'>
                                    <input id='datetimepicker1Input' name="addUserDateBirth" type='text' class='form-control' data-td-target='#datetimepicker1' required/>
                                    <span class='input-group-text' data-td-target='#datetimepicker1' data-td-toggle='datetimepicker'>
                                        <span class='fa-solid fa-calendar'></span>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Morada</label>
                                <input type="text" class="form-control" name="addUserAddress" required>
                            </div>
                            <div class="form-group">
                                <label>Código postal</label>
                                <input type="text" class="form-control" name="addUserCodPost" required>
                            </div>
                            <div class="form-group">
                                <label>Género</label>
                                <!--<input type="text" class="form-control" name="addUserGenderId" required>-->
                                <select id="addUserGenderId" class="form-select" name="addUserGenderId" required>
                                    <option value="" disabled selected>Selecione o género</option>
                                    <?php if (!empty($this->userdata['gendersList'])) {
                                        foreach ($this->userdata['gendersList'] as $key => $gender) { ?>
                                            <option value="<?php echo $gender['id'] ?>"><?php echo $gender["name"] ?></option>
                                        <?php }
                                    } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Localidade</label>
                                <input type="text" class="form-control" name="addUserLocality" required>
                            </div>
                            <div class="form-group">
                                <label>Telefone</label>
                                <input type="text" class="form-control" name="addUserMobile" maxlength="9" required>
                            </div>
                            <div class="form-group">
                                <label>NIF</label>
                                <input type="text" class="form-control" name="addUserNif" maxlength="9" required>
                            </div>
                            <div class="form-group">
                                <label>País</label>
                                <select class="form-select" name="addUserCountryId" id="addUserCountryId">
                                    <option value="" disabled selected>Selecione o país</option>
                                    <?php if (!empty($this->userdata['countryList'])) {
                                        foreach ($this->userdata['countryList'] as $key => $country) { ?>
                                            <option value="<?php echo $country['id'] ?>"><?php echo $country["name"] ?></option>
                                        <?php }
                                    } ?>
                                </select>
                            </div>
                            <!--<div class="form-group">
                                <label>Active</label>
                                <input type="checkbox" class="form-control form-check-input" name="addTreeActive">
                            </div>-->

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <input type="submit" class="btn btn-success" value="Adicionar">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Edit Modal HTML -->
        <div id="editUserModal" class="modal fade" tabindex="-1" aria-labelledby="editUserModal-Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="editUser">
                        <div class="modal-header">
                            <h4 class="modal-title">Editar utilizador</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <input id="editUserId" name="editUserId" type="hidden" class="form-control" value="">
                            </div>

                            <div class="form-group">
                                <label>Nome</label>
                                <input type="text" class="form-control" name="editUserName" required>
                            </div>
                            <div class="form-group">
                                <label>Entidade</label>
                                <input type="text" class="form-control" name="editUserEntity" >
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="editUserEmail" required>
                            </div>
                            <!--<div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="editUserPassword" required>
                            </div>-->
                            <div class="form-group">
                                <label>Grupo</label>
                                <!--<input type="text" class="form-control" name="editUserGroupId" required>-->
                                <select id="addUserGroupId" class="form-select" name="editUserGroupId" required>
                                    <option value="" disabled selected>Selecione o grupo</option>
                                    <?php if (!empty($this->userdata['groupsList'])) {
                                        foreach ($this->userdata['groupsList'] as $key => $group) { ?>
                                            <option value="<?php echo $group['id'] ?>"><?php echo $group["name"] ?></option>
                                        <?php }
                                    } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Data de nascimento</label>
                                <!--<input type="text" class="form-control" name="editUserDateBirth" placeholder="yyyy-mm-dd" required>-->
                                <div class='input-group' id='datetimepicker2' data-td-target-input='nearest' data-td-target-toggle='nearest'>
                                    <input id='datetimepicker2Input' name="editUserDateBirth" type='text' class='form-control' data-td-target='#datetimepicker2' required/>
                                    <span class='input-group-text' data-td-target='#datetimepicker2' data-td-toggle='datetimepicker'>
                                        <span class='fa-solid fa-calendar'></span>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Morada</label>
                                <input type="text" class="form-control" name="editUserAddress" required>
                            </div>
                            <div class="form-group">
                                <label>Código postal</label>
                                <input type="text" class="form-control" name="editUserCodPost" required>
                            </div>
                            <div class="form-group">
                                <label>Género</label>
                                <!--<input type="text" class="form-control" name="editUserGenderId" required>-->
                                <select id="editUserGenderId" class="form-select" name="editUserGenderId" required>
                                    <option value="" disabled selected>Selecione o género</option>
                                    <?php if (!empty($this->userdata['gendersList'])) {
                                        foreach ($this->userdata['gendersList'] as $key => $gender) { ?>
                                            <option value="<?php echo $gender['id'] ?>"><?php echo $gender["name"] ?></option>
                                        <?php }
                                    } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Localidade</label>
                                <input type="text" class="form-control" name="editUserLocality" required>
                            </div>
                            <div class="form-group">
                                <label>Telefone</label>
                                <input type="text" class="form-control" name="editUserMobile" required>
                            </div>
                            <div class="form-group">
                                <label>NIF</label>
                                <input type="text" class="form-control" name="editUserNif" required>
                            </div>
                            <div class="form-group">
                                <label>País</label>
                                <select class="form-select" name="editUserCountryId" id="editUserCountryId">
                                    <option value="" disabled selected>Selecione o País</option>
                                    <?php if (!empty($this->userdata['countryList'])) {
                                        foreach ($this->userdata['countryList'] as $key => $country) { ?>
                                            <option value="<?php echo $country['id'] ?>"><?php echo $country["name"] ?></option>
                                        <?php }
                                    } ?>
                                </select>
                            </div>
                            <div class="form-group form-check form-switch">
                                <label>Ativo</label>
                                <input type="checkbox" role="switch" class="form-check-input" name="editUserActive">
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <input type="submit" class="btn btn-success" value="Guardar">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Delete Modal HTML -->
        <div id="deleteUserModal" class="modal fade" tabindex="-1" aria-labelledby="deleteUserModal-Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="deleteUser">
                        <div class="modal-header">
                            <h4 class="modal-title">Apagar utilizador</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Tem a certeza que quer apagar este utilizador?</p>
                            <p class="text-warning"><small>A ação não pode ser defeita.</small></p>
                            <input id="deleteUserId" name="deleteUserId" type="hidden" class="form-control">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <input type="submit" class="btn btn-danger" value="Apagar">
                        </div>
                    </form>
                </div>
            </div>
        </div>


<script>
    $(document).ready(function() {
        //DATATABLES
        //Configura a dataTable
        try{
            var table = $('#usersTable').DataTable({
                rowReorder: false,
                responsive: false,
                columnDefs: [{
                    targets: [8,9],
                    orderable: false,
                }],
                oLanguage: {
                    "sUrl": "https://cdn.datatables.net/plug-ins/1.12.1/i18n/pt-PT.json"
                }
            });
            //filtra table se ativo, inativo ou mostra todos
            $('#GetActive').on('change', function() {
                let selectedItem = $(this).children("option:selected").val();
                table.columns(8).search(selectedItem).draw();
            })
        } catch (error) {
            console.log(error)
        }

        //datetimepicker with momentjs plugin
        tempusDominus.extend(tempusDominus.plugins.moment_parse, 'YYYY-MM-DD');

        //datepicker form add
        new tempusDominus.TempusDominus(document.getElementById('datetimepicker1'), {
            display: {
                components: {
                    decades: true,
                    year: true,
                    month: true,
                    date: true,
                    hours: false,
                    minutes: false,
                    seconds: false,
                }
            },
            useCurrent:true
        });

        //datepicker form edit
        new tempusDominus.TempusDominus(document.getElementById('datetimepicker2'), {
            display: {
                components: {
                    decades: true,
                    year: true,
                    month: true,
                    date: true,
                    hours: false,
                    minutes: false,
                    seconds: false,
                }
            },
            useCurrent:false
        });


        // ajax to Add User
        $('#addUser').submit(function (event) {
            event.preventDefault(); //prevent default action

            let formData = {
                'action': "AddUser",
                'data': $(this).serializeArray()
            };

            $.ajax({
                url: "<?php echo HOME_URL . '/admin/users';?>",
                dataType: "json",
                type: 'POST',
                data: formData,
                beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                    $('#loader').removeClass('hidden')
                },
                success: function (data) {
                    $("#addUserModal").modal('hide');

                    if (data.statusCode === 201){
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
                },
                complete: function () { // Set our complete callback, adding the .hidden class and hiding the spinner.
                    $('#loader').addClass('hidden')
                }
            });
        });

        // ajax to Edit User
        $('#editUser').submit(function (event) {
            event.preventDefault(); //prevent default action

            //Ve se a data dos inputs mudou para formar so a data necessaria para o PATCH
            let formDataChanged = [];
            $('input, select', $('#editUser')).each(function() { //para cada input vai ver
                console.log($(this).attr('name'), $(this).val())
                if($(this).attr('name') === "editUserId" || ($(this).attr('name') === "editUserActive" && $(this).is(":checked")) || $(this).data('lastValue') !== $(this).val()) {//se a data anterior é diferente da current
                    let emptyArray = { name: "", value: "" };

                    emptyArray.name = $(this).attr('name');
                    emptyArray.value = $(this).val();

                    formDataChanged.push(emptyArray);
                }
            });


            let formData = {
                'action' : "UpdateUser",
                'data'   : formDataChanged
            };

            /*let formData = {
                'action' : "UpdateUser",
                'data'   : $(this).serializeArray()
            };*/

            $.ajax({
                url : "<?php echo HOME_URL . '/admin/users';?>",
                dataType: "json",
                type: 'POST',
                data : formData,
                beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                    $('#loader').removeClass('hidden')
                },
                success: function (data) {
                    $("#editUserModal").modal('hide');

                    if (data.statusCode === 200){
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
                },
                complete: function () { // Set our complete callback, adding the .hidden class and hiding the spinner.
                    $('#loader').addClass('hidden')
                }
            });
        });

        // ajax to get data to Modal Edit User
        $('.edit').on('click', function(){

            let formData = {
                'action' : "GetUser",
                'data'   : $(this).attr('id') //gets user id from edit button on table
            };

            $.ajax({
                url : "<?php echo HOME_URL . '/admin/users';?>",
                dataType: "json",
                type: 'POST',
                data : formData,
                beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                    $('#loader').removeClass('hidden')
                },
                success: function (data) {

                    $('[name="editUserId"]').val(data[0]['id']);
                    $('[name="editUserName"]').val(data[0]['name']);
                    $('[name="editUserEntity"]').val(data[0]['entity']);
                    $('[name="editUserEmail"]').val(data[0]['email']);
                    //$('[name="editUserPassword"]').val(data[0]['password']);
                    $('[name="editUserGroupId"]').val(data[0]['groupId']);
                    $('[name="editUserDateBirth"]').val(data[0]['dateBirth']);
                    $('[name="editUserAddress"]').val(data[0]['address']);
                    $('[name="editUserCodPost"]').val(data[0]['codPost']);
                    $('[name="editUserGenderId"]').val(data[0]['genderId']);
                    $('[name="editUserLocality"]').val(data[0]['locality']);
                    $('[name="editUserMobile"]').val(data[0]['mobile']);
                    $('[name="editUserNif"]').val(data[0]['nif']);
                    $('[name="editUserCountryId"]').val(data[0]['countryId']);

                    if (data[0]['active'] === 1) {
                        $('[name="editUserActive"]').attr('checked', true);
                    } else {
                        $('[name="editUserActive"]').attr('checked', false);
                    }

                    //atribui atributo .data("lastValue") a cada input/select do form editGroup
                    // para se poder comparar entre os dados anteriores e os current
                    $('input, select', $('#editUser')).each(function() {
                        $(this).data('lastValue', $(this).val());
                    });

                    $("#editUserModal").modal('show');

                },
                error: function (data) {
                    Swal.fire({
                        title: 'Erro!',
                        text: data['message'],
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 2000,
                        didClose: () => {
                            //location.reload();
                        }
                    });
                },
                complete: function () { // Set our complete callback, adding the .hidden class and hiding the spinner.
                    $('#loader').addClass('hidden')
                }
            });

        });

        // ajax to Delete User
        $('#deleteUser').submit(function(event){
            event.preventDefault(); //prevent default action

            let formData = {
                'action' : "DeleteUser",
                'data'   : $(this).serializeArray()
            };

            $.ajax({
                url : "<?php echo HOME_URL . '/admin/users';?>",
                dataType: "json",
                type: 'POST',
                data : formData,
                beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                    $('#loader').removeClass('hidden')
                },
                success: function (data) {
                    $("#deleteUserModal").modal('hide');

                    if (data.statusCode === 200){
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
                },
                complete: function () { // Set our complete callback, adding the .hidden class and hiding the spinner.
                    $('#loader').addClass('hidden')
                }
            });
        });

        // ajax to get data to Modal Delete User
        $('.delete').on('click', function(){
            let $deleteID = $(this).attr('id');
            $('[name="deleteUserId"]').val($deleteID); //gets group id from id="" attribute on delete button from table
            $("#deleteUserModal").modal('show');

        });

    });
</script>