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
        <li class="nav-item "><a class="nav-link" href="<?php echo HOME_URL . '/admin/user/1';?>"><span>Gestão de users</span></a></li>
        <li class="nav-item active"><a class="nav-link" href="<?php echo HOME_URL . '/admin/comment/1';?>"><span>Comentários</span></a></li>
        <li class="nav-item"><a class="nav-link" href="<?php echo HOME_URL . '/admin/category/1';?>"><span>Categorias</span></a></li>

    </ul>

    <div id="content-wrapper">

        <!-- DataTables -->
        <div class="container">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2>Manage <b>user Comments</b></h2>
                        </div>
                    </div>
                </div>

                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Comment</th>
                        <th>Description</th>
                        <th></th>
                    </tr>
                    <?php /*foreach ($commentsTable as $comment) { ?>
                    <tbody>
                    <tr>
                        <td><?php echo $comment["comid"]?></td>
                        <td><?php echo $comment["user"]?></td>
                        <td><?php echo $comment["description"]?></td>
                        <td>
                            <a href="#editCommentModal" class="edit" data-toggle="modal"
                               data-comid="<?php echo $comment["comid"]?>" data-user="<?php echo $comment["user"]?>"
                               data-description="<?php echo $comment["description"]?>"><i class="far fa-edit"></i></a>
                            <a href="#deleteCommentModal" class="delete" data-toggle="modal"><i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                    </tbody>
                    <?php }*/?>
                </table>

                <div class="clearfix">
                    <div class="hint-text">Showing <b>
                            <?php /*
                            if (10*$parametros[0] >= count($comments)) {
                                echo count($comments);
                            } else {
                                if ($parametros[0] == null || $parametros[0] == "1") {
                                    if (10 >= count($comments)) {
                                        echo count($comments);
                                    } else {
                                        echo 10;
                                    }
                                } else {
                                    echo 10*$parametros[0];
                                }
                            }*/
                            ?></b> out of <b><?php //echo count($comments)?></b> entries</div>
                    <ul class="pagination">
                        <?php /*
                        if ($parametros[0] == null) { ?>
                            <li class="page-item active"><a href="<?php echo HOME_URL . '/admin/comment/' . 1;?>" class="page-link">1</a></li>
                        <?php } else {
                            for ($i = 1 ; $i <= ceil(count($comments)/10) ; $i++) { ?>
                                <li class="page-item <?php if ($parametros[0] == $i) {
                                    echo "active";
                                }?>"><a href="<?php echo HOME_URL . '/admin/comment/' . $i;?>" class="page-link"><?php echo $i?></a></li>
                            <?php }
                        }*/
                        ?>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Edit Modal HTML -->
        <div id="editCommentModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form>
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Employee</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Id</label>
                                <input id="comid" type="text" class="form-control" disabled>
                            </div>
                            <div class="form-group">
                                <label>Name</label>
                                <input id="user" type="text" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea id="description" class="form-control" required></textarea>
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
        <div id="deleteCommentModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form>
                        <div class="modal-header">
                            <h4 class="modal-title">Delete Employee</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete these Records?</p>
                            <p class="text-warning"><small>This action cannot be undone.</small></p>
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

