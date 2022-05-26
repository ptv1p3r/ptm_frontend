
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
                <h1 class="mt-4">Gestão de <b>Imagens</b></h1>
                <div class="row">

                    <div class="col-xl-12 col-md-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <a href="#addTreeImageModal" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addTreeImageModal">
                                    <i class="fas fa-plus-circle"></i><span>Add New Image</span>
                                </a>
                            </div>
                            <div class="card-body">
                                <table id="treeImagesTable" class="table table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>treeId</th>
                                        <th>name</th>
                                        <th>path</th>
                                        <th>description</th>
                                        <th>size</th>
                                        <th>position</th>
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
                                    <?php if (!empty($this->userdata['treeImageList'])) {
                                        foreach ($this->userdata['treeImageList'] as $key => $treeImage) { ?>
                                            <tr>
                                                <td><?php echo $treeImage["id"] ?></td>
                                                <td><?php echo $treeImage["treeId"] ?></td>
                                                <td><?php echo $treeImage["name"] ?></td>
                                                <td><?php echo $treeImage["path"] ?></td>
                                                <td><?php echo $treeImage["description"] ?></td>
                                                <td><?php echo $treeImage["size"] ?></td>
                                                <td><?php echo $treeImage["position"] ?></td>
                                                <td><?php echo $treeImage["active"] ?></td>
                                                <td>
                                                    <a href="#editTreeImageModal" id="<?php echo $treeImage['id'] ?>" class="edit" data-bs-toggle="modal" data-bs-target="#editTreeModal"><i class="far fa-edit"></i></a>
                                                    <a href="#deleteTreeImageModal" id="<?php echo $treeImage['id'] ?>" class="delete" data-bs-toggle="modal" data-bs-target="#deleteTreeModal"><i class="fas fa-trash-alt"></i></a>
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
        <div id="addTreeImageModal" class="modal fade" tabindex="-1" aria-labelledby="addTreeImageModal-Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="addTreeImage">
                        <div class="modal-header">
                            <h4 class="modal-title">Add Tree Image</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>treeId</label>
                                <input type="text" class="form-control" name="addTreeImageTreeId" required>
                            </div>
                            <div class="form-group">
                                <label>order</label>
                                <input type="text" class="form-control" name="addTreeImageOrder" required>
                            </div>
                            <div class="form-group">
                                <label>description</label>
                                <input type="text" class="form-control" name="addTreeImageDescription" required>
                            </div>
                            <div class="form-group">
                                <label>Image</label>
                                <input type="file" class="form-control" name="addTreeImageFile">
                            </div>
                            <div class="form-group">
                                <label>Active</label>
                                <input type="checkbox" class="form-control form-check-input" name="addTreeImageActive">
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
        <div id="editTreeImageModal" class="modal fade" tabindex="-1" aria-labelledby="editTreeImageModal-Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="editTreeImage">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Tree</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <input id="editTreeId" name="editTreeId" type="hidden" class="form-control" value="">
                            </div>

                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="editTreeName" required>
                            </div>
                            <div class="form-group">
                                <label>NameCommon</label>
                                <input type="text" class="form-control" name="editTreeNameCommon" required>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <input type="text" class="form-control" name="editTreeDescription" required>
                            </div>
                            <div class="form-group">
                                <label>Observations</label>
                                <input type="text" class="form-control" name="editTreeObservations" required>
                            </div>
                            <div class="form-group">
                                <label>TypeId</label>
                                <input type="text" class="form-control" name="editTreeTypeId" required>
                            </div>
                            <div class="form-group">
                                <label>Latitude</label>
                                <input type="number" step="any" class="form-control" name="editTreeLat" required>
                            </div>
                            <div class="form-group">
                                <label>Longitude</label>
                                <input type="number" step="any" class="form-control" name="editTreeLng" required>
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
        <div id="deleteTreeImageModal" class="modal fade" tabindex="-1" aria-labelledby="deleteTreeImageModal-Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="deleteTreeImage">
                        <div class="modal-header">
                            <h4 class="modal-title">Delete Tree</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete this Tree?</p>
                            <p class="text-warning"><small>This action cannot be undone.</small></p>
                            <input id="deleteTreeId" name="deleteTreeId" type="hidden" class="form-control" value="">
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
                try{
                    var table = $('#treeImagesTable').DataTable({
                        rowReorder: false,
                        responsive: true,
                        columnDefs: [ {
                            targets: [7,8],
                            orderable: false,
                        }]
                    });
                    //filtra table se ativo, inativo ou mostra todos
                    $('#GetActive').on('change', function() {
                        let selectedItem = $(this).children("option:selected").val();
                        table.columns(7).search(selectedItem).draw();
                    })
                } catch (error){
                    console.log(error);
                }



                //CRUD
                // ajax to Add Group
                $('#addTreeImage').submit(function (event) {
                    event.preventDefault(); //prevent default action

                    let formData = {
                        'action': "AddTreeImage",
                        'data': $(this).serializeArray()
                    };

                    $.ajax({
                        url: "<?php echo HOME_URL . '/admin/tree_images';?>",
                        dataType: "json",
                        type: 'POST',
                        data: formData,
                        beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                            $('#loader').removeClass('hidden')
                        },
                        success: function (data) {
                            $("#addTreeImageModal").modal('hide');

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
                $('#editTreeImage').submit(function (event) {
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
                        'action' : "UpdateTreeImage",
                        'data'   : formDataChanged
                    };*/

                    let formData = {
                        'action': "UpdateTreeImage",
                        'data': $(this).serializeArray()
                    };

                    $.ajax({
                        url : "<?php echo HOME_URL . '/admin/tree_images';?>",
                        dataType: "json",
                        type: 'POST',
                        data : formData,
                        beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                            $('#loader').removeClass('hidden')
                        },
                        success: function (data) {
                            $("#editTreeImageModal").modal('hide');

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
                        'action' : "GetTreeImage",
                        'data'   : $(this).attr('id') //gets tree id from id="" attribute on edit button from table
                    };

                    $.ajax({
                        url : "<?php echo HOME_URL . '/admin/tree_images';?>",
                        dataType: "json",
                        type: 'POST',
                        data : formData,
                        beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                            $('#loader').removeClass('hidden')
                        },
                        success: function (data) {

                            $('[name="editTreeId"]').val(data[0]['id']);
                            $('[name="editTreeName"]').val(data[0]['name']);
                            $('[name="editTreeNameCommon"]').val(data[0]['nameCommon']);
                            $('[name="editTreeDescription"]').val(data[0]['description']);
                            $('[name="editTreeObservations"]').val(data[0]['observations']);
                            $('[name="editTreeTypeId"]').val(data[0]['typeId']);
                            $('[name="editTreeLat"]').val(data[0]['lat']);
                            $('[name="editTreeLng"]').val(data[0]['lng']);

                            if (data[0]['active'] === 1) {
                                $('[name="editTreeActive"]').attr('checked', true);
                            } else {
                                $('[name="editTreeActive"]').attr('checked', false);
                            }

                            //atribui atributo .data("lastValue") a cada input do form editTree
                            // para se poder comparar entre os dados anteriores e os current
                            /*$('#editTree input').each(function() {
                                $(this).data('lastValue', $(this).val());
                            });*/

                            $("#editTreeModal").modal('show');
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
                $('#deleteImageTree').submit(function(event){
                    event.preventDefault(); //prevent default action

                    let formData = {
                        'action' : "DeleteTreeImage",
                        'data'   : $(this).serializeArray()
                    };

                    $.ajax({
                        url : "<?php echo HOME_URL . '/admin/tree_images';?>",
                        dataType: "json",
                        type: 'POST',
                        data : formData,
                        beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                            $('#loader').removeClass('hidden')
                        },
                        success: function (data) {
                            $("#deleteTreeModal").modal('hide');

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
                    $('[name="deleteTreeId"]').val($deleteID); //gets tree id from id="" attribute on delete button from table
                    $("#deleteTreeImageModal").modal('show');

                });

            });
        </script>