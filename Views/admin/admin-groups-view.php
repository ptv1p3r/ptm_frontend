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
        <li class="nav-item active"><a class="nav-link" href="<?php echo HOME_URI . '/admin/groups/1';?>"><span>Gestão de grupos</span></a></li>
        <li class="nav-item"><a class="nav-link" href="<?php echo HOME_URI . '/admin/comment/1';?>"><span>Comentários</span></a></li>
        <li class="nav-item"><a class="nav-link" href="<?php echo HOME_URI . '/admin/category/1';?>"><span>Categorias</span></a></li>
    </ul>

    <div id="content-wrapper">
        <!-- DataTables -->
        <div class="container">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2>Manage <b>Groups</b></h2>
                        </div>
                        <div class="col-sm-6">
                            <a href="#addGroupsModal" class="btn btn-success" data-toggle="modal"><i class="fas fa-plus-circle"></i><span>Add New Group</span></a>
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

                    <?php /*foreach ($groupsTable as $group) { */?>
                        <tbody>
                        <tr>
                            <td><?php //echo $group["id"]?></td>
                            <td><?php //echo $group["Description"]?></td>
                            <td><?php //echo $group["SecurityId"]?></td>
                            <td><?php //echo $group["active"]?></td>
                            <td><?php //echo $group["dateModified"]?></td>
                            <td>
                                <a href="#editGroupsModal" data-groupid="<?php //echo $group["id"]?>" data-title="<?php //echo $movie["title"]?>" data-year="<?php //echo $movie["year"]?>" class="edit" data-toggle="modal"><i class="far fa-edit"></i></a>
                                <a href="#deleteGroupsModal" class="delete" data-toggle="modal"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                        </tbody>
                    <?php /* }*/?>

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
                                <li class="page-item active"><a href="<?php echo HOME_URI . '/admin/movie/' . 1;?>" class="page-link">1</a></li>
                            <?php } else {
                                for ($i = 1 ; $i <= ceil(count($movies)/10) ; $i++) { ?>
                                <li class="page-item <?php if ($parametros[0] == $i) {
                                    echo "active";
                                }?>"><a href="<?php echo HOME_URI . '/admin/movie/' . $i;?>" class="page-link"><?php echo $i?></a></li>
                                <?php }
                            }*/
                            ?>
                        </ul>
                    </div>
                </div>
            </div>

        <!-- Add Modal HTML -->
        <div id="addGroupsModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form>
                        <div class="modal-header">
                            <h4 class="modal-title">Add Group</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <input type="text" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>SecurityId</label>
                                <input type="number" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>active</label>
                                <input type="number" class="form-control" required>
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
        <div id="editGroupsModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="/admin/group/1" method="post">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Group</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <input id="groupid" type="hidden" class="form-control" value="<?php //$movieById[0]["movid"]?>">
                            </div>

                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <input type="text" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>SecurityId</label>
                                <input type="number" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>active</label>
                                <input type="number" class="form-control" required>
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
        <div id="deleteGroupsModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="/admin/group/1" method="post">
                        <div class="modal-header">
                            <h4 class="modal-title">Delete Group</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete this Group?</p>
                            <p class="text-warning"><small>This action cannot be undone.</small></p>
                            <input id="movid" name="movid" type="hidden" class="form-control">
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
                    <div class="modal-footer"><a href="<?php echo HOME_URI . '/admin/logout';?>" class="btn btn-danger btn-block">Logout</a></div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        // Add new Group
        $('#addGroupsModal').submit(function (event) {
            event.preventDefault(); //prevent default action

            let formData = {
                'action': "AddGroup",
                'data': $(this).serializeArray()
            };

            $.ajax({
                url: "<?php echo HOME_URI . '/admin/groups';?>",
                dataType: "json",
                type: 'POST',
                data: formData,
                success: function (data) {
                    //$('#addPoiCategory')[0].reset();
                    //$("#addGroupsModal").modal('hide');

                    //mensagem de Success
                    /*Swal.fire({
                        title: 'Success!',
                        text: data['message'],
                        type: 'success',
                        showConfirmButton: false,
                        timer: 2000,
                        onClose: () => {
                            location.reload();
                        }
                    });*/
                },
                error: function (data) {
                    //mensagem de Error
                    /*Swal.fire({
                        title: 'Error!',
                        text: data['message'],
                        type: 'error',
                        showConfirmButton: false,
                        timer: 2000,
                        onClose: () => {
                            location.reload();
                        }
                    });*/
                }
            });
        });
    });
</script>