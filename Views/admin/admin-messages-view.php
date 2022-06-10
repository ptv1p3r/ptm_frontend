
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
                <h1 class="mt-4">Blank <b>page</b></h1>
                <div class="row">

                    <div class="col-xl-12 col-md-12">

                        <div class="container">
                            <div class="row">
                                <!-- BEGIN INBOX -->
                                <div class="col-md-12">
                                    <div class="grid email">
                                        <div class="grid-body">
                                            <div class="row">
                                                <!-- BEGIN INBOX MENU -->
                                                <div class="col-md-3">
                                                    <h2 class="grid-title"><i class="fa fa-inbox"></i> Inbox</h2>
                                                    <a class="btn btn-block btn-primary" data-bs-toggle="modal" data-bs-target="#composeModal"><i class="fa fa-pencil"></i>&nbsp;&nbsp;NEW MESSAGE</a>

                                                    <hr>

                                                    <div>
                                                        <ul class="nav flex-column nav-pills nav-stacked">
                                                            <li class="nav-item header">Folders</li>
                                                            <li class="nav-item active"><a class="nav-link" href="#"><i class="fa fa-inbox"></i> Inbox (14)</a></li>
                                                            <li class="nav-item"><a class="nav-link" href="#"><i class="fa fa-star"></i> Starred</a></li>
                                                            <li class="nav-item"><a class="nav-link" href="#"><i class="fa fa-bookmark"></i> Important</a></li>
                                                            <li class="nav-item"><a class="nav-link" href="#"><i class="fa fa-mail-forward"></i> Sent</a></li>
                                                            <li class="nav-item"><a class="nav-link" href="#"><i class="fa fa-edit"></i> Drafts</a></li>
                                                            <li class="nav-item"><a class="nav-link" href="#"><i class="fa fa-folder"></i> Spam</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <!-- END INBOX MENU -->

                                                <!-- BEGIN INBOX CONTENT -->
                                                <div class="col-md-9">
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <label style="margin-right: 8px;" class="">
                                                                <div class="icheckbox_square-blue" style="position: relative;"><input type="checkbox" id="check-all" class="icheck" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"><ins class="iCheck-helper" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div>
                                                            </label>
                                                            <div class="btn-group">
                                                                <button type="button" class="btn btn-default dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                                    Action <span class="caret"></span>
                                                                </button>
                                                                <ul class="dropdown-menu" role="menu">
                                                                    <li><a class="dropdown-item" href="#">Mark as read</a></li>
                                                                    <li><a class="dropdown-item" href="#">Mark as unread</a></li>
                                                                    <li><a class="dropdown-item" href="#">Mark as important</a></li>
                                                                    <li><hr class="dropdown-divider"></li>
                                                                    <li><a class="dropdown-item" href="#">Report spam</a></li>
                                                                    <li><a class="dropdown-item" href="#">Delete</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6 search-form">
                                                            <form action="#" class="text-right">
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control input-sm" placeholder="Search">
                                                                    <span class="input-group-btn">
                                                                        <button type="submit" name="search" class="btn_ btn-primary btn-sm search"><i class="fa fa-search"></i></button>
                                                                    </span>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>

                                                    <div class="padding"></div>

                                                    <div class="table-responsive">
                                                        <table class="table">
                                                            <tbody>
                                                                <tr class="read">
                                                                    <td class="action"><input type="checkbox" /></td>
                                                                    <td class="action"><i class="fa fa-star-o"></i></td>
                                                                    <td class="action"><i class="fa fa-bookmark-o"></i></td>
                                                                    <td class="name"><a href="#">Larry Gardner</a></td>
                                                                    <td class="subject"><a href="#">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed </a></td>
                                                                    <td class="time">08:30 PM</td>
                                                                </tr>
                                                                <tr class="read">
                                                                    <td class="action"><div class="icheckbox_square-blue" st<td class="action"><input type="checkbox" /></td>
                                                                    <td class="action"><i class="fa fa-star"></i></td>
                                                                    <td class="action"><i class="fa fa-bookmark"></i></td>
                                                                    <td class="name"><a href="#">Larry Gardner</a></td>
                                                                    <td class="subject"><a href="#">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed </a></td>
                                                                    <td class="time">08:30 PM</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="action"><input type="checkbox" /></td>
                                                                    <td class="action"><i class="fa fa-star-o"></i></td>
                                                                    <td class="action"><i class="fa fa-bookmark-o"></i></td>
                                                                    <td class="name"><a href="#">Larry Gardner</a></td>
                                                                    <td class="subject"><a href="#">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed </a></td>
                                                                    <td class="time">08:30 PM</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                    <!--<ul class="pagination">
                                                        <li class="disabled"><a href="#">«</a></li>
                                                        <li class="active"><a href="#">1</a></li>
                                                        <li><a href="#">2</a></li>
                                                        <li><a href="#">3</a></li>
                                                        <li><a href="#">4</a></li>
                                                        <li><a href="#">5</a></li>
                                                        <li><a href="#">»</a></li>
                                                    </ul>-->
                                                </div>
                                                <!-- END INBOX CONTENT -->

                                                <!-- BEGIN COMPOSE MESSAGE -->
                                                <div id="composeModal" class="modal fade" tabindex="-1" aria-labelledby="composeModal-Label" aria-hidden="true">
                                                    <div class="modal-wrapper">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header bg-blue">
                                                                    <h4 class="modal-title"><i class="fa fa-envelope"></i> Compose New Message</h4>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <form method="post">
                                                                    <div class="modal-body">
                                                                        <div class="form-group">
                                                                            <label>Mail to</label>
                                                                            <input name="to" type="email" class="form-control">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>CC</label>
                                                                            <input name="cc" type="email" class="form-control">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>BCC</label>
                                                                            <input name="bcc" type="email" class="form-control">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Subject</label>
                                                                            <input name="subject" type="email" class="form-control">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Message</label>
                                                                            <textarea name="message" id="email_message" class="form-control" style="height: 120px;"></textarea>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Attachment</label>
                                                                            <input type="file" name="attachment">
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-default" data-bs-dismiss="modal"><i class="fa fa-times"></i> Discard</button>
                                                                        <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-envelope"></i> Send Message</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- END COMPOSE MESSAGE -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END INBOX -->
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
                /*try{
                    var table = $('#groupsTable').DataTable({
                        rowReorder: false,
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
                } catch (error) {
                    console.log(error);
                }*/



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