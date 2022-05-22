
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
                <h1 class="mt-4">Gestão de <b>Tipos de árvores</b></h1>
                <div class="row">

                    <!-- <div class="col-xl-12 col-md-12 mb-4">
                        -Map area div
                         <div id="map"></div>
                     </div>-->

                    <div class="col-xl-12 col-md-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <a href="#addTreeTypesModal" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addTreeTypesModal">
                                    <i class="fas fa-plus-circle"></i><span>Add New Tree</span>
                                </a>
                            </div>
                            <div class="card-body">
                                <table id="treesTable" class="table table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <!--<th>id</th>-->
                                        <th>name</th>
                                        <th>description</th>
                                        <th>active
                                            <select id='GetActive'>
                                                <option value=''>All</option>
                                                <option value='1'>Active</option>
                                                <option value='0'>Inactive</option>
                                            </select>
                                        </th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if (!empty($this->userdata['treeTypesList'])) {
                                        foreach ($this->userdata['treeTypesList'] as $key => $treeTypes) { ?>
                                            <tr>
                                                <!--<td><?php //echo $treeTypes["id"] ?></td>-->
                                                <td><?php echo $treeTypes["name"] ?></td>
                                                <td><?php echo $treeTypes["description"] ?></td>
                                                <td><?php echo $treeTypes["active"] ?></td>
                                                <td>
                                                    <a href="#editTreeTypesModal" id="<?php echo $treeTypes['id'] ?>" class="edit" data-bs-toggle="modal" data-bs-target="#editTreeTypesModal"><i class="far fa-edit"></i></a>
                                                    <a href="#deleteTreeTypesModal" id="<?php echo $treeTypes['id'] ?>" class="delete" data-bs-toggle="modal" data-bs-target="#deleteTreeTypesModal"><i class="fas fa-trash-alt"></i></a>
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
        </main>


        <!-- MODALS -->
        <!-- Add Modal HTML -->
        <div id="addTreeTypesModal" class="modal fade" tabindex="-1" aria-labelledby="addTreeTypesModal-Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="addTreeTypes">
                        <div class="modal-header">
                            <h4 class="modal-title">Add Tree</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>name</label>
                                <input type="text" class="form-control" name="addTreeTypeName" required>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <input type="text" class="form-control" name="addTreeTypeDescription" required>
                            </div>
                            <div class="form-group">
                                <label>Active</label>
                                <input type="checkbox" class="form-control form-check-input" name="addTreeTypeActive">
                            </div>
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
        <div id="editTreeTypesModal" class="modal fade" tabindex="-1" aria-labelledby="editTreeTypesModal-Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="editTreeTypes">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Tree</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <input id="editTreeTypeId" name="editTreeTypeId" type="hidden" class="form-control" value="">
                            </div>
                            <div class="form-group">
                                <label>name</label>
                                <input type="text" class="form-control" name="editTreeTypeName" required>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <input type="text" class="form-control" name="editTreeTypeDescription" required>
                            </div>
                            <div class="form-group">
                                <label>Active</label>
                                <input type="checkbox" class="form-control form-check-input" name="editTreeTypeActive">
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
        <div id="deleteTreeTypesModal" class="modal fade" tabindex="-1" aria-labelledby="deleteTreeTypesModal-Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="deleteTreeTypes">
                        <div class="modal-header">
                            <h4 class="modal-title">Delete Tree</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete this Tree?</p>
                            <p class="text-warning"><small>This action cannot be undone.</small></p>
                            <input id="deleteTreeTypeId" name="deleteTreeTypeId" type="hidden" class="form-control" value="">
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


<script>
    $(document).ready(function() {
        //DATATABLES
        //Configura a dataTable
        var table = $('#treesTable').DataTable({
            rowReorder: true,
            responsive: true,
            columnDefs: [ {
                targets: [3],
                orderable: false,
            }]
        });
        //filtra table se ativo, inativo ou mostra todos
        $('#GetActive').on('change', function() {
            let selectedItem = $(this).children("option:selected").val();
            table.columns(3).search(selectedItem).draw();
        })


        //CRUD
        // ajax to Add Group
        $('#addTreeTypes').submit(function (event) {
            event.preventDefault(); //prevent default action

            let formData = {
                'action': "AddTreeType",
                'data': $(this).serializeArray()
            };

            $.ajax({
                url: "<?php echo HOME_URL . '/admin/tree_types';?>",
                dataType: "json",
                type: 'POST',
                data: formData,
                beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                    $('#loader').removeClass('hidden')
                },
                success: function (data) {
                    $("#addTreeTypesModal").modal('hide');

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

        // ajax to Edit Group
        $('#editTreeTypes').submit(function (event) {
            event.preventDefault(); //prevent default action

            //Ve se a data dos inputs mudou para formar so a data necessaria para o PATCH
            /*let formDataChanged = [];
            $('#editTree input').each(function() { //para cada input vai ver
                if($(this).attr('name') === "editTreeId" || $(this).data('lastValue') !== $(this).val()) {//se a data anterior é diferente da current
                    let emptyArray = { name: "", value: "" };

                    emptyArray.name = $(this).attr('name');
                    emptyArray.value = $(this).val();

                    formDataChanged.push(emptyArray);
                }
            });

            let formData = {
                'action' : "UpdateTree",
                'data'   : formDataChanged
            };*/

            let formData = {
                'action': "UpdateTreeType",
                'data': $(this).serializeArray()
            };

            $.ajax({
                url : "<?php echo HOME_URL . '/admin/tree_types';?>",
                dataType: "json",
                type: 'POST',
                data : formData,
                beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                    $('#loader').removeClass('hidden')
                },
                success: function (data) {
                    $("#editTreeTypesModal").modal('hide');

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

        // ajax to get data to Modal Edit Tree
        $('.edit').on('click', function(){

            let formData = {
                'action' : "GetTreeType",
                'data'   : $(this).attr('id') //gets tree id from id="" attribute on edit button from table
            };

            $.ajax({
                url : "<?php echo HOME_URL . '/admin/tree_types';?>",
                dataType: "json",
                type: 'POST',
                data : formData,
                beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                    $('#loader').removeClass('hidden')
                },
                success: function (data) {

                    $('[name="editTreeTypeId"]').val(data[0]['id']);
                    $('[name="editTreeTypeName"]').val(data[0]['name']);
                    $('[name="editTreeTypeDescription"]').val(data[0]['description']);

                    if (data[0]['active'] === 1) {
                        $('[name="editTreeTypeActive"]').attr('checked', true);
                    } else {
                        $('[name="editTreeTypeActive"]').attr('checked', false);
                    }

                    //atribui atributo .data("lastValue") a cada input do form editTree
                    // para se poder comparar entre os dados anteriores e os current
                    /*$('#editTree input').each(function() {
                        $(this).data('lastValue', $(this).val());
                    });*/

                    $("#editTreeTypesModal").modal('show');
                },
                error: function (data) {
                    Swal.fire({
                        title: 'Error!',
                        text: data.body.message,
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 2000,
                        didClose: () => {
                            location.reload();
                        }
                    });
                },
                complete: function () { // Set our complete callback, adding the .hidden class and hiding the spinner.
                    $('#loader').addClass('hidden')
                }
            });

        });

        // ajax to Delete Tree
        $('#deleteTreeTypes').submit(function(event){
            event.preventDefault(); //prevent default action

            let formData = {
                'action' : "DeleteTreeType",
                'data'   : $(this).serializeArray()
            };

            $.ajax({
                url : "<?php echo HOME_URL . '/admin/tree_types';?>",
                dataType: "json",
                type: 'POST',
                data : formData,
                beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                    $('#loader').removeClass('hidden')
                },
                success: function (data) {
                    $("#deleteTreeTypesModal").modal('hide');

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

        // ajax to get data to Modal Delete Tree
        $('.delete').on('click', function(){
            let $deleteID = $(this).attr('id');
            $('[name="deleteTreeTypeId"]').val($deleteID); //gets tree id from id="" attribute on delete button from table
            $("#deleteTreeTypesModal").modal('show');

        });

    });
</script>