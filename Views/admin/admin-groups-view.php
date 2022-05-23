
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
                <h1 class="mt-4">Gestão de <b>grupos</b></h1>
                <div class="row">

                    <div class="col-xl-12 col-md-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <a href="#addGroupModal" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addGroupModal">
                                    <i class="fas fa-plus-circle"></i><span>Add New Group</span>
                                </a>
                            </div>
                            <div class="card-body">
                                <table id="groupsTable" class="table table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>SecurityId</th>
                                        <th>active
                                            <select id='GetActive'>
                                                <option value=''>All</option>
                                                <option value='1'>Active</option>
                                                <option value='0'>Inactive</option>
                                            </select>
                                        </th>
                                        <th>dateCreated</th>
                                        <th>dateModified</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if (!empty($this->userdata['groupsList'])) {
                                        foreach ($this->userdata['groupsList'] as $key => $group) { ?>
                                            <tr>
                                                <td><?php echo $group["name"] ?></td>
                                                <td><?php echo $group["description"] ?></td>
                                                <td><?php echo $group["securityId"] ?></td>
                                                <td><?php echo $group["active"] ?></td>
                                                <td><?php echo $group["dateCreated"] ?></td>
                                                <td><?php echo $group["dateModified"] ?></td>
                                                <td>
                                                    <a href="#editGroupModal" id="<?php echo $group['id'] ?>" class="edit"
                                                       data-bs-toggle="modal" data-bs-target="#editGroupModal"><i class="far fa-edit"></i></a>
                                                    <a href="#deleteGroupModal" id="<?php echo $group['id'] ?>" class="delete"
                                                       data-bs-toggle="modal" data-bs-target="#deleteGroupModal"><i class="fas fa-trash-alt"></i></a>
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




        <!-- Add Modal HTML -->
        <div id="addGroupModal" class="modal fade" tabindex="-1" aria-labelledby="addGroupModal-Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="addGroup">
                        <div class="modal-header">
                            <h4 class="modal-title">Add Group</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="addGroupName" required>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <input type="text" class="form-control" name="addGroupDescription" required>
                            </div>
                            <div class="form-group">
                                <label>SecurityId</label>
                                <input type="number" class="form-control" name="addGroupSecurityId" required>
                            </div>
                            <div class="form-group">
                                <label>Active</label>
                                <input type="checkbox" class="form-control form-check-input" name="addGroupActive">
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
        <div id="editGroupModal" class="modal fade" tabindex="-1" aria-labelledby="editGroupModal-Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="editGroup">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Group</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <input id="editGroupId" name="editGroupId" type="hidden" class="form-control" value="">
                            </div>

                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="editGroupName" required>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <input type="text" class="form-control" name="editGroupDescription" required>
                            </div>
                            <div class="form-group">
                                <label>SecurityId</label>
                                <input type="number" class="form-control" name="editGroupSecurityId" required>
                            </div>
                            <div class="form-group form-check form-switch">
                                <label>Active</label>
                                <input type="checkbox" role="switch" class="form-check-input" name="editGroupActive">
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
        <div id="deleteGroupModal" class="modal fade" tabindex="-1" aria-labelledby="deleteGroupModal-Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="deleteGroup">
                        <div class="modal-header">
                            <h4 class="modal-title">Delete Group</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete this Group?</p>
                            <p class="text-warning"><small>This action cannot be undone.</small></p>
                            <input id="deleteGroupId" name="deleteGroupId" type="hidden" class="form-control" value="">
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
        var table = $('#groupsTable').DataTable({
            rowReorder: true,
            responsive: true,
            columnDefs: [ {
                targets: [6,3],
                orderable: false,
            }]
        });
        //filtra table se ativo, inativo ou mostra todos
        $('#GetActive').on('change', function() {
            let selectedItem = $(this).children("option:selected").val();
            table.columns(3).search(selectedItem).draw();
        })


        // ajax to Add Group
        $('#addGroup').submit(function (event) {
            event.preventDefault(); //prevent default action

            let formData = {
                'action': "AddGroup",
                'data': $(this).serializeArray()
            };

            $.ajax({
                url: "<?php echo HOME_URL . '/admin/groups';?>",
                dataType: "json",
                type: 'POST',
                data: formData,
                beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                    $('#loader').removeClass('hidden')
                },
                success: function (data) {
                    $("#addGroupModal").modal('hide');

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
        $('#editGroup').submit(function (event) {
            event.preventDefault(); //prevent default action

            //Ve se a data dos inputs mudou para formar so a data necessaria para o PATCH
            /*let formDataChanged = [];
            $('#editGroup input').each(function() { //para cada input vai ver
                if($(this).attr('name') === "editGroupId" || ($(this).attr('name') === "editGroupActive" && $(this).is(":checked")) || $(this).data('lastValue') !== $(this).val()) {//se a data anterior é diferente da current
                    let emptyArray = { name: "", value: "" };

                    emptyArray.name = $(this).attr('name');
                    emptyArray.value = $(this).val();

                    formDataChanged.push(emptyArray);
                }
            });

            let formData = {
                'action' : "UpdateGroup",
                'data'   : formDataChanged
            };*/

            let formData = {
                'action': "UpdateGroup",
                'data': $(this).serializeArray()
            };

            $.ajax({
                url : "<?php echo HOME_URL . '/admin/groups';?>",
                dataType: "json",
                type: 'POST',
                data : formData,
                beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                    $('#loader').removeClass('hidden')
                },
                success: function (data) {
                    $("#editGroupModal").modal('hide');

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

        // ajax to get data to Modal Edit Group
        $('.edit').on('click', function(){

            let formData = {
                'action' : "GetGroup",
                'data'   : $(this).attr('id') //gets group id from id="" attribute on edit button from table
            };

            $.ajax({
                url : "<?php echo HOME_URL . '/admin/groups';?>",
                dataType: "json",
                type: 'POST',
                data : formData,
                beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                    $('#loader').removeClass('hidden')
                },
                success: function (data) {

                    $('[name="editGroupId"]').val(data[0]['id']);
                    $('[name="editGroupName"]').val(data[0]['name']);
                    $('[name="editGroupDescription"]').val(data[0]['description']);
                    $('[name="editGroupSecurityId"]').val(data[0]['securityId']);

                    if (data[0]['active'] === 1) {
                        $('[name="editGroupActive"]').attr('checked', true);
                    } else {
                        $('[name="editGroupActive"]').attr('checked', false);
                    }

                    //atribui atributo .data("lastValue") a cada input do form editGroup
                    // para se poder comparar entre os dados anteriores e os current
                    /*$('#editGroup input').each(function() {
                        $(this).data('lastValue', $(this).val());
                    });*/

                    $("#editGroupModal").modal('show');
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

        // ajax to Delete Group
        $('#deleteGroup').submit(function(event){
            event.preventDefault(); //prevent default action

            let formData = {
                'action' : "DeleteGroup",
                'data'   : $(this).serializeArray()
            };

            $.ajax({
                url : "<?php echo HOME_URL . '/admin/groups';?>",
                dataType: "json",
                type: 'POST',
                data : formData,
                beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                    $('#loader').removeClass('hidden')
                },
                success: function (data) {
                    $("#deleteGroupModal").modal('hide');

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

        // ajax to get data to Modal Delete Group
        $('.delete').on('click', function(){
            let $deleteID = $(this).attr('id');
            $('[name="deleteGroupId"]').val($deleteID); //gets group id from id="" attribute on delete button from table
            $("#deleteGroupModal").modal('show');

        });

    });
</script>