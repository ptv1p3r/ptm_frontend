<?php
/**
 * Created by PhpStorm.
 * User: lmore
 * Date: 26/01/2019
 * Time: 15:28
 */
?>
<?php if ( ! defined('ABSPATH')) exit; ?>

<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <!-- Sidebar -->
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Core</div>
                    <a class="nav-link" href="<?php echo HOME_URL . '/admin/dashboard';?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                    <a class="nav-link" href="<?php echo HOME_URL . '/admin/groups';?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                        Grupos
                    </a>
                    <a class="nav-link active" href="<?php echo HOME_URL . '/admin/users';?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                        Utilizadores
                    </a>
                    <a class="nav-link" href="<?php echo HOME_URL . '/admin/security';?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-lock"></i></div>
                        Tabela de segurança
                    </a>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-tree"></i></div>
                        Árvores/Utilizadores
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="<?php echo HOME_URL . '/admin/trees';?>">Dashboard</a>
                            <a class="nav-link" href="<?php echo HOME_URL . '/admin/trees';?>">Árvores</a>
                        </nav>
                    </div>

                    <a class="nav-link" href="<?php echo HOME_URL . '/admin/settings';?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-gear"></i></div>
                        Definições
                    </a>
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as:</div>
                <?php echo $_SESSION["userdata"]["name"] ?>
            </div>
        </nav>
    </div>

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">

                <div class="row">
                    <div class="col-sm-6">
                        <h2>Manage <b>User</b></h2>
                    </div>
                    <div class="col-sm-6">
                        <a href="#addUserModal" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addUserModal"><i class="fas fa-plus-circle"></i><span>Add New User</span></a>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        DataTable Example
                    </div>
                    <div class="card-body">
                        <table id="usersTable" class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th>name</th>
                                <th>entity</th>
                                <th>email</th>
                                <th>groupId</th>
                                <th>dateBirth</th>
                                <th>address</th>
                                <th>codPost</th>
                                <th>genderId</th>
                                <th>locality</th>
                                <th>mobile</th>
                                <th>nif</th>
                                <th>countryId</th>
                                <th>active</th>
                                <th>activationDate</th>
                                <th>dateCreated</th>
                                <th>dateModified</th>
                                <th>lastLogin</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (!empty($this->userdata['usersList'])) {
                                foreach ($this->userdata['usersList'] as $key => $user) { ?>
                                    <tr>
                                        <td><?php echo $user["name"] ?></td>
                                        <td><?php echo $user["entity"] ?></td>
                                        <td><?php echo $user["email"] ?></td>
                                        <td><?php echo /*getGroupById(*/$user["groupId"] ?></td>
                                        <td><?php echo $user["dateBirth"] ?></td>
                                        <td><?php echo $user["address"] ?></td>
                                        <td><?php echo $user["codPost"] ?></td>
                                        <td><?php echo $user["genderId"] ?></td>
                                        <td><?php echo $user["locality"] ?></td>
                                        <td><?php echo $user["mobile"] ?></td>
                                        <td><?php echo $user["nif"] ?></td>
                                        <td><?php
                                            if (!empty($this->userdata['countryList'])) {
                                                foreach ($this->userdata['countryList'] as $key => $country) {
                                                    if ( $country["id"] == $user["countryId"]){
                                                        echo $country["name"];
                                                    }
                                                }
                                            }
                                            ?></td>
                                        <td><?php echo $user["active"] ?></td>
                                        <td><?php echo $user["activationDate"] ?></td>
                                        <td><?php echo $user["dateCreated"] ?></td>
                                        <td><?php echo $user["dateModified"] ?></td>
                                        <td><?php echo $user["lastLogin"] ?></td>
                                        <td>
                                            <a href="#editUserModal" id="<?php echo $user['email'] ?>" class="edit"
                                               data-bs-toggle="modal" data-bs-target="#editUserModal"><i class="far fa-edit"></i></a>
                                            <a href="#deleteUserModal" id="<?php echo $user['id'] ?>" class="delete"
                                               data-bs-toggle="modal" data-bs-target="#deleteUserModal"><i class="fas fa-trash-alt"></i></a>
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
        </main>


        <!-- Add Modal HTML -->
        <div id="addUserModal" class="modal fade" tabindex="-1" aria-labelledby="addTreeModalLabel" aria-hidden="true">
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
        <div id="editUserModal" class="modal fade" tabindex="-1" aria-labelledby="addTreeModalLabel" aria-hidden="true">
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
                            <div class="form-group">
                                <label>Active</label>
                                <input type="checkbox" class="form-control form-check-input" name="editTreeActive">
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
        <div id="deleteUserModal" class="modal fade" tabindex="-1" aria-labelledby="addTreeModalLabel" aria-hidden="true">
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

        <!-- Logout Modal HTML
        <div id="logoutModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Logout <i class="fa fa-lock"></i></h4>
                    </div>
                    <div class="modal-body"><i class="fa fa-question-circle"></i> Are you sure you want to log-off?</div>
                    <div class="modal-footer"><a href="<?php //echo HOME_URL . '/admin/logout';?>" class="btn btn-danger btn-block">Logout</a></div>
                </div>
            </div>
        </div>-->
    </div>
</div>


<script>
    $(document).ready(function() {
        //DATATABLES
        /*$('#usersTable').DataTable({
            rowReorder: true,
            responsive: true
            //dom: 'Qfrtip'
        });*/

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
                }
            });
        });

        // ajax to Edit User
        $('#editUser').submit(function (event) {
            event.preventDefault(); //prevent default action

            //Ve se a data dos inputs mudou para formar so a data necessaria para o PATCH
            let formDataChanged = [];
            $('#editUser input').each(function() { //para cada input vai ver
                if($(this).attr('name') === "editUserId" || $(this).data('lastValue') !== $(this).val()) {//se a data anterior é diferente da current
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