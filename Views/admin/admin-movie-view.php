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
        <li class="nav-item active"><a class="nav-link" href="<?php echo HOME_URI . '/admin/movie/1';?>"><span>Gestão de Filmes</span></a></li>
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
                            <h2>Manage <b>Movies</b></h2>
                        </div>
                        <div class="col-sm-6">
                            <a href="#addMovieModal" class="btn btn-success" data-toggle="modal"><i class="fas fa-plus-circle"></i><span>Add New Movie</span></a>
                        </div>
                    </div>
                </div>

                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Year</th>
                        <th>Creation Date</th>
                        <th>Last Updated</th>
                        <th></th>
                    </tr>
                    </thead>

                    <?php /*foreach ($moviesTable as $movie) { ?>
                        <tbody>
                        <tr>
                            <td><?php echo $movie["movid"]?></td>
                            <td><?php echo $movie["title"]?></td>
                            <td><?php echo $movie["year"]?></td>
                            <td><?php echo $movie["creation_timestamp"]?></td>
                            <td><?php echo $movie["update_timestamp"]?></td>
                            <td>
                                <a href="#editMovieModal" data-movid="<?php echo $movie["movid"]?>" data-title="<?php echo $movie["title"]?>"
                                   data-year="<?php echo $movie["year"]?>"
                                   class="edit" data-toggle="modal"><i class="far fa-edit"></i></a>
                                <a href="#deleteMovieModal" class="delete" data-toggle="modal"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                        </tbody>
                    <?php }*/?>

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
        </div>

        <!-- Add Modal HTML -->
        <div id="addMovieModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form>
                        <div class="modal-header">
                            <h4 class="modal-title">Add Movie</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Year</label>
                                <input type="number" class="form-control" required>
                            </div>

                            <label>Categories</label>
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

                            </div>

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
        <div id="editMovieModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="/admin/movie/1" method="post">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Movie</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <input id="movid" type="hidden" class="form-control" value="<?php //$movieById[0]["movid"]?>">
                            </div>
                            <div class="form-group">
                                <label>Title</label>
                                <input id="title" name="title" type="text" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Year</label>
                                <input id="year" name="year" type="number" class="form-control" required>
                            </div>
                            <label>Categories</label>   <!-- fill categories -->
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
        <div id="deleteMovieModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="/admin/movie/1" method="post">
                        <div class="modal-header">
                            <h4 class="modal-title">Delete Movie</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete this Movie?</p>
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
