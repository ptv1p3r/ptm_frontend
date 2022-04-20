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
        <li class="nav-item active"><a class="nav-link" href="<?php echo HOME_URL . '/admin/groups/1';?>"><span>Gestão de grupos</span></a></li>
        <li class="nav-item"><a class="nav-link" href="<?php echo HOME_URL . '/admin/users/1';?>"><span>Gestão de utilizadoress</span></a></li>
        <li class="nav-item"><a class="nav-link" href="<?php echo HOME_URL . '/admin/category/1';?>"><span>Gestão de securitys</span></a></li>
    </ul>

    <div id="content-wrapper">
        <!-- DataTables -->
        <div class="container">
            <div class="table-wrapper">
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
                        <th>Name</th>
                        <th>Description</th>
                        <th>SecurityId</th>
                        <th>active</th>
                        <th>dateCreated</th>
                        <th>dateModified</th>
                        <th></th>
                    </tr>
                    </thead>

                    <?php /*if (!empty($this->userdata['usersList']['data'])) {
                                foreach ($this->userdata['usersList']['data'] as $key => $user) {*/ ?>
                    <tbody>
                    <tr>
                        <td><?php //echo $user["id"]?></td>
                        <td><?php //echo $user["Description"]?></td>
                        <td><?php //echo $user["SecurityId"]?></td>
                        <td><?php //echo $user["active"]?></td>
                        <td><?php //echo $user["dateModified"]?></td>
                        <td>
                            <a href="#editUserModal" id="<?php //$user['id']?>" class="edit" data-toggle="modal"><i class="far fa-edit"></i></a>
                            <a href="#deleteUserModal" class="delete" data-toggle="modal"><i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                    </tbody>
                    <?php /*    }
                            }*/?>

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
                    <form>
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
                                <label>Description</label>
                                <input type="text" class="form-control" name="addUserDescription" required>
                            </div>
                            <div class="form-group">
                                <label>SecurityId</label>
                                <input type="number" class="form-control" name="addUserSecurityId" required>
                            </div>
                            <div class="form-group">
                                <label>Active</label>
                                <input type="checkbox" class="form-control" name="addUserActive" required>
                            </div>

                            <!-- <label>Categories</label>
                            <div class="form-group" style="padding-left: 40px" >
                                    <?php /*foreach ( $categories as $category) {?>

                                        <div class="form-check form-check-inline col-md-3">
                                            <input class="form-check-input" type="checkbox" id="<?php echo $category["catid"]?>">
                                            <label class="form-check-label" for="<?php echo $category["catid"]?>"><?php echo $category["name"]?></label>
                                        </div>

                                        <?php if($category["catid"] % 3 == 0) { ?>
                                            </div>
                                            <div class="form-group" style="padding-left: 40px">
                                        <?php } ?>
                                    <?php }*/?>

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
                    <form action="/admin/users/1" method="post">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit User</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <input id="userid" type="hidden" class="form-control" value="<?php //$movieById[0]["movid"]?>">
                            </div>

                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="editUserName" required>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <input type="text" class="form-control" name="editUserDescription" required>
                            </div>
                            <div class="form-group">
                                <label>SecurityId</label>
                                <input type="number" class="form-control" name="editUserSecurityId" required>
                            </div>
                            <div class="form-group">
                                <label>Active</label>
                                <input type="checkbox" class="form-control" name="editUserActive" required>
                            </div>

                            <!--<label>Categories</label>   fill categories
                            <div class="form-group" style="padding-left: 40px" >
                                <?php
                            /*$i=1;
                            foreach ( $categories as $category) {?>

                                <div class="form-check form-check-inline col-md-3">
                                    <input class="form-check-input" type="checkbox" id="<?php echo $category["catid"]?>"
                                    <label class="form-check-label" for="<?php echo $category["catid"]?>"><?php echo $category["name"]?></label>
                                </div>

                                <?php if($i % 3 == 0) { ?>
                                    </div>
                                    <div class="form-group" style="padding-left: 40px">
                                <?php } ?>
                            <?php $i++;
                            }*/?>

                            </div>-->

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
                    <form action="/admin/users/1" method="post">
                        <div class="modal-header">
                            <h4 class="modal-title">Delete User</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete this User?</p>
                            <p class="text-warning"><small>This action cannot be undone.</small></p>
                            <input id="userid" name="userid" type="hidden" class="form-control">
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
        $('#addUserModal').submit(function (event) {
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

                    //mensagem de Success
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
                    //mensagem de Error
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

        // ajax to Edit User
        $('#editUserModal').submit(function (event) {
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

                    /*Swal.fire({
                        title: 'Success!',
                        text: data['message'],
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 2000,
                        didClose: () => {
                            location.reload();
                        }
                    });*/
                },
                error: function (data) {
                    /*Swal.fire({
                        title: 'Error!',
                        text: data['message'],
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 2000,
                        didClose: () => {
                            location.reload();
                        }
                    });*/
                }
            });
        });

        // ajax to get data to Modal Edit User
        $('.edit').on('click', function(){

            let formData = {
                'action' : "GetUser",
                'data'   : $(this).attr('Id') //gets user id from edit button on table
            };

            $.ajax({
                url : "<?php echo HOME_URL . '/admin/users';?>",
                dataType: "json",
                type: 'POST',
                data : formData,
                success: function (data) {

                    $("#editUserId").val(data['data'][0]['Id']);
                    $("#editUserName").val(data['data'][0]['Name']);
                    $("#editUserDescription").val(data['data'][0]['Description']);
                    $("#editUserSecurityId").val(data['data'][0]['SecurityId']);

                    if (data['data'][0]['Active'] === 1) {
                        $("#editUserActive").attr('checked', true);
                    } else {
                        $("#editUserActive").attr('checked', false);
                    }

                    $("#editUserModal").modal('show');

                },
                error: function (data) {
                    /*Swal.fire({
                        title: 'Error!',
                        text: data['message'],
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 2000,
                        didClose: () => {
                            location.reload();
                        }
                    });*/
                }
            });

        });

        // ajax to Delete User
        $('#deleteUserModal').submit(function(event){
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

                    /*Swal.fire({
                        title: 'Success!',
                        text: data['message'],
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 2000,
                        didClose: () => {
                            location.reload();
                        }
                    });*/
                },
                error: function (data) {
                    /* Swal.fire({
                         title: 'Error!',
                         text: data['message'],
                         icon: 'error',
                         showConfirmButton: false,
                         timer: 2000,
                         didClose: () => {
                             location.reload();
                         }
                     });*/
                }
            });
        });

        // ajax to get data to Modal Delete User
        $('.delete').on('click', function(){

            $("#deleteUserId").val($(this).attr('Id')); //gets user id from delete button on table
            $("#deleteUserModal").modal('show');

        });

    });
</script>