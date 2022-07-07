
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
                                    <i class="fas fa-plus-circle"></i><span>Editar Utilizador</span>
                                </a>

                            </div>
                            <div class="card-body">

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

                                            <!--                        Teste premissões-->
<!--                                            --><?php //$this->permission_required = array('treeRead');
//                                            if (!$this->check_permissions($this->permission_required, $_SESSION["userdata"]['user_permissions'])) { ?>
<!--                                                <a class="nav-link" id="application-tab" data-toggle="pill" href="#application" role="tab"-->
<!--                                                   aria-controls="application" aria-selected="false">-->
<!--                                                    <i class="fa fa-tv text-center mr-1"></i>-->
<!--                                                    Test Permissões-->
<!--                                                </a>-->
<!--                                                --><?php
//                                            }
//                                            ?>
                                            <!--                        <a class="nav-link" id="notification-tab" data-toggle="pill" href="#notification" role="tab" aria-controls="notification" aria-selected="false">-->
                                            <!--                            <i class="fa fa-bell text-center mr-1"></i>-->
                                            <!--                            Notification-->
                                            <!--                        </a>-->
                                        </div>
                                    </div>

                                    <!-- Profile tab section-->
<!--                                    --><?php //if (!empty($this->userdata['userList'])) {
//                                    foreach ($this->userdata['userList'] as $key => $user) { ?>
                                    <div class="tab-content p-4 p-md-5 profile-tab" id="v-pills-tabContent">
                                        <div class="tab-pane fade show active" id="account" role="tabpanel" aria-labelledby="account-tab">
                                            <h3 class="mb-4">Dados da conta</h3>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Nome</label>
<!--                                                        <p> --><?php //echo $user["name"] ?><!--</p>-->
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Entidade</label>
<!--                                                        <p>--><?php //echo $user["entity"] ?><!--</p>-->
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Morada</label>
<!--                                                        <p>--><?php //echo $user["address"] ?><!--</p>-->
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Código-postal</label>
<!--                                                        <p>--><?php //echo $user["codPost"] ?><!--</p>-->
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Localidade</label>
<!--                                                        <p>--><?php //echo $user["locality"] ?><!--</p>-->
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>País</label>
<!--                                                        --><?php //foreach ($this->userdata['countryList'] as $key => $val) { ?>
<!--                                                            --><?php //echo ($val['id'] == $user["countryId"]) ? "<p>" . $val['name'] . "</p>" : ''; ?>
<!--                                                        --><?php //} ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Data de nascimento</label>
<!--                                                        <p>--><?php //echo $user["dateBirth"] ?><!--</p>-->
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Gênero</label>
<!--                                                        --><?php //foreach ($this->userdata['genderList'] as $key => $val) { ?>
<!--                                                            --><?php //echo ($val['id'] == $user["genderId"]) ? "<p>" . $val['name'] . "</p>" : ''; ?>
<!--                                                        --><?php //} ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>NIF</label>
<!--                                                        <p>--><?php //echo $user["nif"] ?><!--</p>-->
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Telefone</label>
<!--                                                        <p>--><?php //echo $user["mobile"] ?><!--</p>-->
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
<!--                                                <button class="btn edit btn-success" id="--><?php //echo $user["email"]; ?><!--" data-toggle="modal"-->
<!--                                                        data-target="#editUserModal">Editar-->
<!--                                                </button>-->
                                                <!--                            <button class="btn btn-light">Cancel</button>-->
                                            </div>
                                        </div>
                                        <!--End profile tab section-->



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
                            <h4 class="modal-title">Add User</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="addUserName" required>
                            </div>
                            <div class="form-group">
                                <label>Entity</label>
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
                                <label>GroupId</label>
                                <input type="text" class="form-control" name="addUserGroupId" required>

                                <!--<select id="addUserGroupId" class="form-select" name="addUserGroupId" >
                                    <option value="" disabled selected>Grupo</option>
                                    <?php /*if (!empty($this->userdata['groupList'])) {
                                        foreach ($this->userdata['groupList'] as $key => $group) { */?>
                                            <option value="<?php //echo $group['id'] ?>"><?php //echo $group["name"] ?></option>
                                        <?php /*}
                                    }*/ ?>
                                </select>-->
                            </div>
                            <div class="form-group">
                                <label>DateBirth</label>
                                <input type="text" class="form-control" name="addUserDateBirth" placeholder="yyyy-mm-dd" required>
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" class="form-control" name="addUserAddress" required>
                            </div>
                            <div class="form-group">
                                <label>CodPost</label>
                                <input type="text" class="form-control" name="addUserCodPost" required>
                            </div>
                            <div class="form-group">
                                <label>GenderId</label>
                                <input type="text" class="form-control" name="addUserGenderId" required>

                                <!--<select id="addUserGenderId" class="form-select" name="addUserGenderId" >
                                    <option value="" disabled selected>Género</option>
                                    <?php /*if (!empty($this->userdata['genderList'])) {
                                        foreach ($this->userdata['genderList'] as $key => $gender) { */?>
                                            <option value="<?php //echo $gender['id'] ?>"><?php //echo $gender["name"] ?></option>
                                        <?php /*}
                                    }*/ ?>
                                </select>-->
                            </div>
                            <div class="form-group">
                                <label>Locality</label>
                                <input type="text" class="form-control" name="addUserLocality" required>
                            </div>
                            <div class="form-group">
                                <label>Mobile</label>
                                <input type="text" class="form-control" name="addUserMobile" required>
                            </div>
                            <div class="form-group">
                                <label>Nif</label>
                                <input type="text" class="form-control" name="addUserNif" required>
                            </div>
                            <div class="form-group">
                                <label>Country</label>
                                <select class="form-select" name="addUserCountryId" id="addUserCountryId">
                                    <option value="" disabled selected>Selecione o País</option>
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
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <input type="submit" class="btn btn-success" value="Add">
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
                            <h4 class="modal-title">Edit User</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <input id="editUserId" name="editUserId" type="hidden" class="form-control" value="">
                            </div>

                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="editUserName" required>
                            </div>
                            <div class="form-group">
                                <label>Entity</label>
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
                                <label>GroupId</label>
                                <input type="text" class="form-control" name="editUserGroupId" required>

                                <!--<select id="editUserGroupId" class="form-select" name="editUserGroupId" >
                                    <option value="" disabled selected>Grupo</option>
                                    <?php /*if (!empty($this->userdata['groupList'])) {
                                        foreach ($this->userdata['groupList'] as $key => $group) { */?>
                                            <option value="<?php //echo $group['id'] ?>"><?php //echo $group["name"] ?></option>
                                        <?php /*}
                                    }*/ ?>
                                </select>-->
                            </div>
                            <div class="form-group">
                                <label>DateBirth</label>
                                <input type="text" class="form-control" name="editUserDateBirth" placeholder="yyyy-mm-dd" required>
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" class="form-control" name="editUserAddress" required>
                            </div>
                            <div class="form-group">
                                <label>CodPost</label>
                                <input type="text" class="form-control" name="editUserCodPost" required>
                            </div>
                            <div class="form-group">
                                <label>GenderId</label>
                                <input type="text" class="form-control" name="editUserGenderId" required>

                                <!--<select id="editUserGenderId" class="form-select" name="editUserGenderId" >
                                    <option value="" disabled selected>Género</option>
                                    <?php /*if (!empty($this->userdata['genderList'])) {
                                        foreach ($this->userdata['genderList'] as $key => $gender) { */?>
                                            <option value="<?php //echo $gender['id'] ?>"><?php //echo $gender["name"] ?></option>
                                        <?php /*}
                                    }*/ ?>
                                </select>-->
                            </div>
                            <div class="form-group">
                                <label>Locality</label>
                                <input type="text" class="form-control" name="editUserLocality" required>
                            </div>
                            <div class="form-group">
                                <label>Mobile</label>
                                <input type="text" class="form-control" name="editUserMobile" required>
                            </div>
                            <div class="form-group">
                                <label>Nif</label>
                                <input type="text" class="form-control" name="editUserNif" required>
                            </div>
                            <div class="form-group">
                                <label>Country</label>
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
                                <label>Active</label>
                                <input type="checkbox" role="switch" class="form-check-input" name="editUserActive">
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <input type="submit" class="btn btn-success" value="Save">
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
                            <h4 class="modal-title">Delete User</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete this User?</p>
                            <p class="text-warning"><small>This action cannot be undone.</small></p>
                            <input id="deleteUserId" name="deleteUserId" type="hidden" class="form-control">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <input type="submit" class="btn btn-danger" value="Delete">
                        </div>
                    </form>
                </div>
            </div>
        </div>



        <script>
            $(document).ready(function() {
                // //DATATABLES
                // //Configura a dataTable
                // try{
                //     var table = $('#usersTable').DataTable({
                //         rowReorder: false,
                //         responsive: true,
                //         columnDefs: [{
                //             targets: [6,7],
                //             orderable: false,
                //         }]
                //     });
                //     //filtra table se ativo, inativo ou mostra todos
                //     $('#GetActive').on('change', function() {
                //         let selectedItem = $(this).children("option:selected").val();
                //         table.columns(6).search(selectedItem).draw();
                //     })
                // } catch (error) {
                //     console.log(error)
                // }


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
                        },
                        complete: function () { // Set our complete callback, adding the .hidden class and hiding the spinner.
                            $('#loader').addClass('hidden')
                        }
                    });
                });

                // ajax to Edit User
                $('#editUser').submit(function (event) {
                    event.preventDefault(); //prevent default action

                    <!--TODO: inst getting option value when country it changed-->
                    //Ve se a data dos inputs mudou para formar so a data necessaria para o PATCH
                    let formDataChanged = [];
                    $('#editUser input').each(function() { //para cada input vai ver
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

                    /* let formData = {
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

                            //atribui atributo .data("lastValue") a cada input do form editGroup
                            // para se poder comparar entre os dados anteriores e os current
                            $('#editUser input').each(function() {
                                $(this).data('lastValue', $(this).val());
                            });

                            $("#editUserModal").modal('show');

                        },
                        error: function (data) {
                            Swal.fire({
                                title: 'Error!',
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