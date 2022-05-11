<?php
/**
 * Created by PhpStorm.
 * User: lmore
 * Date: 26/01/2019
 * Time: 15:28
 */
?>
<?php if ( ! defined('ABSPATH')) exit; ?>

<div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
        <li class="nav-item"><a class="nav-link" href="<?php echo HOME_URL . '/admin/dashboard';?>"><span>Dashboard</span></a></li>
        <li class="nav-item"><a class="nav-link" href="<?php echo HOME_URL . '/admin/groups';?>"><span>Gestão de grupos</span></a></li>
        <li class="nav-item active"><a class="nav-link" href="<?php echo HOME_URL . '/admin/users';?>"><span>Gestão de utilizadores</span></a></li>
        <li class="nav-item"><a class="nav-link" href="<?php echo HOME_URL . '/admin/security';?>"><span>Gestão de securitys</span></a></li>
        <li class="nav-item "><a class="nav-link" href="<?php echo HOME_URL . '/admin/trees';?>"><span>Gestão de trees</span></a></li>
        <li class="nav-item"><a class="nav-link" href="<?php echo HOME_URL . '/admin/settings';?>"><span>Settings</span></a></li>
    </ul>

    <div id="content-wrapper">
        <!-- DataTables -->
        <div class="container">
            <div class="table-wrapper" style="overflow: auto">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2>Manage <b>User</b></h2>
                        </div>
                        <div class="col-sm-6">
                            <a href="#addUserModal" class="btn btn-success" data-toggle="modal"><i class="fas fa-plus-circle"></i><span>Add New User</span></a>
                        </div>
                    </div>
                </div>

                <table class="table table-striped table-hover">
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

                    <?php if (!empty($this->userdata['usersList'])) {
                        foreach ($this->userdata['usersList'] as $key => $user) { ?>
                            <tbody>
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
                                <td><?php echo /*getCountryById(*/$user["countryId"] ?></td>
                                <td><?php echo $user["active"] ?></td>
                                <td><?php echo $user["activationDate"] ?></td>
                                <td><?php echo $user["dateCreated"] ?></td>
                                <td><?php echo $user["dateModified"] ?></td>
                                <td><?php echo $user["lastLogin"] ?></td>
                                <td>
                                    <a href="#editUserModal" id="<?php echo $user['email'] ?>" class="edit"
                                       data-toggle="modal"><i class="far fa-edit"></i></a>
                                    <a href="#deleteUserModal" id="<?php echo $user['id'] ?>" class="delete"
                                       data-toggle="modal"><i class="fas fa-trash-alt"></i></a>
                                </td>
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

                <!-- Pagination -->
                <div class="clearfix">
                    <div class="hint-text">Showing <b>
                            <?php
                            /*if (10*$parametros[0] >= count($movies)) {
                                echo count($movies);
                            } else {
                                if ($parametros[0] == null || $parametros[0] == "1") {
                                    if (10 >= count($movies)) {
                                        echo count($movies);
                                    } else {
                                        echo 10;
                                    }
                                } else {
                                    echo 10*$parametros[0];
                                }
                            }*/
                            ?>
                        </b> out of <b><?php //echo count($movies)?></b> entries</div>
                    <ul class="pagination">
                        <?php /*if ($parametros[0] == null) { ?>
                                <li class="page-item active"><a href="<?php echo HOME_URL . '/admin/movie/' . 1;?>" class="page-link">1</a></li>
                            <?php } else {
                                for ($i = 1 ; $i <= ceil(count($movies)/10) ; $i++) { ?>
                                <li class="page-item <?php if ($parametros[0] == $i) {
                                    echo "active";
                                }?>"><a href="<?php echo HOME_URL . '/admin/movie/' . $i;?>" class="page-link"><?php echo $i?></a></li>
                                <?php }
                            }*/
                        ?>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Add Modal HTML -->
        <div id="addUserModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="addUser">
                        <div class="modal-header">
                            <h4 class="modal-title">Add User</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
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
                                <input type="checkbox" class="form-control" name="addUserActive">
                            </div>-->

                        </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                            <input type="submit" class="btn btn-success" value="Add">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Edit Modal HTML -->
        <div id="editUserModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="editUser">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit User</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
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
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="editUserPassword" required>
                            </div>
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
                                <input type="checkbox" class="form-control" name="editUserActive">
                            </div>

                        </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                            <input type="submit" class="btn btn-info" value="Save">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Delete Modal HTML -->
        <div id="deleteUserModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="deleteUser">
                        <div class="modal-header">
                            <h4 class="modal-title">Delete User</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete this User?</p>
                            <p class="text-warning"><small>This action cannot be undone.</small></p>
                            <input id="deleteUserId" name="deleteUserId" type="hidden" class="form-control">
                        </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                            <input type="submit" class="btn btn-danger" value="Delete">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Logout Modal HTML -->
        <div id="logoutModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Logout <i class="fa fa-lock"></i></h4>
                    </div>
                    <div class="modal-body"><i class="fa fa-question-circle"></i> Are you sure you want to log-off?</div>
                    <div class="modal-footer"><a href="<?php echo HOME_URL . '/admin/logout';?>" class="btn btn-danger btn-block">Logout</a></div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {

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

            let formData = {
                'action' : "UpdateUser",
                'data'   : $(this).serializeArray()
            };

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
                    $('[name="editUserPassword"]').val(data[0]['password']);
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