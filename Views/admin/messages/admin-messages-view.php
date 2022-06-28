
<?php if ( ! defined('ABSPATH')) exit; ?>

<?php if ( $this->login_required && ! $this->logged_in ) return; ?>

<!-- AJAX loader -->
<div id="loader" class="lds-dual-ring hidden overlay"></div>

<div id="layoutSidenav">
    <!-- import sidebar -->
    <?php require ABSPATH . '/views/_includes/admin-sidebar.php' ?>

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <!--<h1 class="mt-4">Blank <b>page</b></h1>-->
                <div class="row mt-4">

                    <div class="col-xl-12 col-md-12">

                        <div class="container">
                            <div class="row">
                                <!-- BEGIN INBOX -->
                                <div class="col-md-12">

                                    <!-- ALERT ?
                                    <div id="liveAlert">

                                    </div>-->

                                    <div class="grid email">
                                        <div class="grid-body">
                                            <div class="row">
                                                <!-- BEGIN INBOX MENU -->
                                                <div class="col-md-3">
                                                    <h2 class="grid-title"><i class="fa fa-inbox"></i> Inbox</h2>
                                                    <a class="btn btn-block btn-primary" data-bs-toggle="modal" data-bs-target="#addMessageModal"><i class="fa fa-pencil"></i>&nbsp;&nbsp;NEW MESSAGE</a>

                                                    <hr>

                                                    <div>
                                                        <ul class="nav flex-column nav-pills nav-stacked">
                                                            <li class="nav-item header">Folders</li>
                                                            <li class="nav-item" role="presentation">
                                                                <a class="nav-link active" id="pills-inbox-tab" data-bs-toggle="pill" data-bs-target="#pills-inbox"
                                                                   type="button" role="tab" aria-controls="pills-inbox" aria-selected="true">
                                                                    <i class="fa fa-inbox"></i> Inbox
                                                                </a>
                                                            </li>
                                                            <li class="nav-item" role="presentation">
                                                                <a class="nav-link" id="pills-sent-tab" data-bs-toggle="pill" data-bs-target="#pills-sent"
                                                                   type="button" role="tab" aria-controls="pills-sent" aria-selected="true">
                                                                    <i class="fa fa-mail-forward"></i> Sent
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <!-- END INBOX MENU -->

                                                <!-- BEGIN INBOX CONTENT -->
                                                <div class="col-md-9">

                                                    <!-- MAIL TABLE -->
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
                                                                    <li><hr class="dropdown-divider"></li>
                                                                    <li><a class="dropdown-item" href="#">Delete</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>

                                                        <!--<div class="col-md-6 search-form">
                                                            <form action="#" class="text-right">
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control input-sm" placeholder="Search">
                                                                    <span class="input-group-btn">
                                                                        <button type="submit" name="search" class="btn_ btn-primary btn-sm search"><i class="fa fa-search"></i></button>
                                                                    </span>
                                                                </div>
                                                            </form>
                                                        </div>-->
                                                    </div>

                                                    <div class="padding"></div>

                                                    <!-- INBOX -->
                                                    <div class="tab-content" id="pills-tabContent">

                                                        <div class="tab-pane fade show active" id="pills-inbox" role="tabpanel" aria-labelledby="pills-inbox-tab">
                                                            <div class="table-responsive">
                                                                <table class="table" id="messagesTable">
                                                                    <tbody>
                                                                    <?php if (!empty($this->userdata['userMessageList'])) {
                                                                        foreach ($this->userdata['userMessageList'] as $key => $message) { ?>

                                                                            <tr class="nav-item <?php echo ($message["receptionDate"] != null ) ? "read" : ""; ?>" role="presentation">
                                                                                <td class="action"><div class="icheckbox_square-blue" st<td class="action"><input type="checkbox" /></td>
                                                                                <td class="name">
                                                                                    <a href="#">
                                                                                        <?php echo $message["fromName"] ?>
                                                                                    </a>
                                                                                </td>
                                                                                <td class="subject">
                                                                                    <a href="<?php echo HOME_URL . '/admin/messages/' . $message["id"];?>">
                                                                                        <?php echo $message["subject"]?>
                                                                                    </a>
                                                                                </td>
                                                                                <td class="time"><?php echo $message["notificationDate"] ?></td>
                                                                                <td>
                                                                                    <?php if ($message["receptionDate"] === null ) {?>
                                                                                        <a href="javascript:void(0);" id="<?php echo $message['id'] ?>"
                                                                                           class="message-read" title="Mark as read"><i class="fa-solid fa-envelope-open"></i></a>
                                                                                    <?php } else {?>
                                                                                        <a href="javascript:void(0);" id="<?php echo $message['id'] ?>"
                                                                                           class="message-unread" title="Mark as unread"><i class="fa-solid fa-envelope"></i></a>
                                                                                    <?php }?>

                                                                                    <a href="#deleteMessageModal" id="<?php echo $message['id'] ?>" class="delete"
                                                                                       data-bs-toggle="modal" data-bs-target="#deleteMessageModal"><i class="fas fa-trash-alt"></i></a>
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

                                                        <div class="tab-pane fade" id="pills-sent" role="tabpanel" aria-labelledby="pills-sent-tab">
                                                            sent
                                                        </div>

                                                        <!--TODO: do message read, parametros tabs?-->
                                                        <div class="tab-pane fade" id="pills-messageRead" role="tabpanel" aria-labelledby="pills-messageRead-tab">
                                                            message read
                                                        </div>
                                                    </div>

                                                </div>
                                                <!-- END INBOX CONTENT -->

                                                <!-- BEGIN COMPOSE MESSAGE -->
                                                <div id="addMessageModal" class="modal fade" tabindex="-1" aria-labelledby="addMessageModal-Label" aria-hidden="true">
                                                    <div class="modal-wrapper">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header bg-blue">
                                                                    <h4 class="modal-title"><i class="fa fa-envelope"></i> Compose New Message</h4>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <form id="addMessage">
                                                                    <div class="modal-body">
                                                                        <input id="addMessageFromUser" name="addMessageFromUser" type="hidden" class="form-control" value="<?php echo $_SESSION["userdata"]["id"];?>">
                                                                        <div class="form-group">
                                                                            <label>Message to</label>
                                                                            <input name="addMessageToUser" type="text" class="form-control">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Subject</label>
                                                                            <input name="addMessageSubject" type="text" class="form-control">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Message</label>
                                                                            <textarea name="addMessageMessage" class="form-control" style="height: 120px;"></textarea>
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
                                                </div><!-- END COMPOSE MESSAGE -->

                                                <!-- Delete Modal HTML -->
                                                <div id="deleteMessageModal" class="modal fade" tabindex="-1" aria-labelledby="deleteMessageModal-Label" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <form id="deleteMessage">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Delete Message</h4>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Are you sure you want to delete this Message?</p>
                                                                    <p class="text-warning"><small>This action cannot be undone.</small></p>
                                                                    <input id="deleteMessageId" name="deleteMessageId" type="hidden" class="form-control" value="">
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                    <input type="submit" class="btn btn-danger" value="Delete">
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

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





        <script>
            $(document).ready(function() {
                //DATATABLES
                //Configura a dataTable
                /*try{
                    var table = $('#messagesTable').DataTable({
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

                var someTabTriggerEl = document.querySelector('#pills-messageRead')
                var tab = new bootstrap.Tab(someTabTriggerEl)

                $('#pills-messageRead').html("MESSAGE READ")

                // ajax to Add Message
                $('#addMessage').submit(function (event) {
                    event.preventDefault(); //prevent default action

                    let formData = {
                        'action': "AddMessage",
                        'data': $(this).serializeArray()
                    };

                    $.ajax({
                        url: "<?php echo HOME_URL . '/admin/messages';?>",
                        dataType: "json",
                        type: 'POST',
                        data: formData,
                        beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                            $('#loader').removeClass('hidden')
                        },
                        success: function (data) {
                            $("#addMessageModal").modal('hide');

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

                // ajax to Delete Message
                $('#deleteMessage').submit(function(event){
                    event.preventDefault(); //prevent default action

                    let formData = {
                        'action' : "DeleteMessage",
                        'data'   : $(this).serializeArray()
                    };

                    $.ajax({
                        url : "<?php echo HOME_URL . '/admin/messages';?>",
                        dataType: "json",
                        type: 'POST',
                        data : formData,
                        beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                            $('#loader').removeClass('hidden')
                        },
                        success: function (data) {
                            $("#deleteMessageModal").modal('hide');

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
                    $('[name="deleteMessageId"]').val($deleteID); //gets group id from id="" attribute on delete button from table
                    $("#deleteMessageModal").modal('show');

                });

                //ajax to set message as unread
                $(function() {
                    $(".message-unread").click(function(e) {
                        e.preventDefault();

                        let formData = {
                            'action': "MarkUnread",
                            'data': $(this).attr("id")
                        };

                        $.ajax({
                            url: "<?php echo HOME_URL . '/admin/messages';?>",
                            dataType: "json",
                            type: 'POST',
                            data: formData,
                            beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                                $('#loader').removeClass('hidden')
                            },
                            success: function (data) {
                                //$("#deleteMessageModal").modal('hide');

                                if (data.statusCode === 200) {
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
                });

                //ajax to set message as read
                $(function() {
                    $(".message-read").click(function(e) {
                        e.preventDefault();

                        let formData = {
                            'action': "MarkRead",
                            'data': $(this).attr("id")
                        };

                        $.ajax({
                            url: "<?php echo HOME_URL . '/admin/messages';?>",
                            dataType: "json",
                            type: 'POST',
                            data: formData,
                            beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                                $('#loader').removeClass('hidden')
                            },
                            success: function (data) {
                                //$("#deleteMessageModal").modal('hide');

                                if (data.statusCode === 200) {
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
                });

            });
        </script>