
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
                                                    <a class="btn btn-block btn-primary"
                                                       data-bs-toggle="modal" data-bs-target="#addMessageModal">
                                                        <i class="fa fa-pencil"></i>&nbsp;&nbsp;NEW MESSAGE
                                                    </a>

                                                    <hr>

                                                    <div>
                                                        <ul class="nav flex-column nav-pills nav-stacked">
                                                            <li class="header">Folders</li>
                                                            <li class="nav-item <?php echo ($tabActive === "inbox") ? "active" : ""?>">
                                                                <a class="nav-link" href="<?php echo HOME_URL . '/admin/messages/inbox'?>">
                                                                    <i class="fa fa-inbox"></i> Inbox
                                                                </a>
                                                            </li>
                                                            <li class="nav-item <?php echo ($tabActive === "sent") ? "active" : ""?>">
                                                                <a class="nav-link" href="<?php echo HOME_URL . '/admin/messages/sent'?>">
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
                                                            <!-- action -->
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
                                                            <!-- refresh -->
                                                            <a class="btn" href="<?php echo HOME_URL . '/admin/messages/inbox'?>">
                                                                <i class="fa-solid fa-rotate"></i>
                                                            </a>
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

                                                    <!-- INBOX/SENT -->
                                                    <div id="inbox-body">
                                                        <div class="table-responsive">
                                                            <table class="table" id="messagesTable">
                                                                <tbody>
                                                                <?php if (!empty($this->userdata['userMessageList'])) {
                                                                    foreach ($this->userdata['userMessageList'] as $key => $message) { ?>

                                                                        <tr class="nav-item <?php echo ($message["receptionDate"] != null ) ? "read" : ""; ?>" role="presentation">
                                                                            <td class="action"><div class="icheckbox_square-blue" st<td class="action"><input type="checkbox" /></td>
                                                                            <td class="name">
                                                                                From: <?php echo $message["fromName"] ?>
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
                                                                                       class="message-read m-2" title="Mark as read"><i class="fa-solid fa-envelope-open"></i></a>
                                                                                <?php } else {?>
                                                                                    <a href="javascript:void(0);" id="<?php echo $message['id'] ?>"
                                                                                       class="message-unread m-2" title="Mark as unread"><i class="fa-solid fa-envelope"></i></a>
                                                                                <?php }?>

                                                                                <a href="#deleteMessageModal" id="<?php echo $message['id'] ?>" class="delete m-2"
                                                                                   data-bs-toggle="modal" data-bs-target="#deleteMessageModal" title="Delete"><i class="fas fa-trash-alt"></i></a>
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
                                                                            <select name="addMessageToUser" id="addMessageToUser">
                                                                                <option value="" disabled selected>Selecione o recetor:</option>
                                                                                <?php if (!empty($this->userdata['usersList'])) {
                                                                                    foreach ($this->userdata['usersList'] as $key => $user) { ?>
                                                                                        <option value="<?php echo $user['id'] ?>"><?php echo $user["email"] ?></option>
                                                                                    <?php }
                                                                                } ?>
                                                                            </select>
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

                // make select have input to seach for option
                $(document).ready(function () {
                    $('select').selectize({ sortField: 'text' });
                });

                //view message
                <?php if( isset($this->userdata["userMessageView"]) && !empty($this->userdata["userMessageView"])) {
                    foreach ($this->userdata['userMessageView'] as $key => $message) {?>
                        function LoadMessage() {
                            $('#inbox-body').html(`
                                <div class="col-lg-9 email-content">
                                    <div class="email-head">
                                        <div class="email-head-subject">
                                            <div class="title d-flex align-items-center justify-content-between">
                                                <div class="d-flex align-items-center">
                                                    <span><?php echo $message["subject"] ?></span>
                                                </div>
                                                <div class="icons">
                                                    <a href="javascript:void();" id="<?php echo $message['fromUser'] ?>" class="icon reply"><i class="fa-solid fa-reply"></i></a>
                                                    <a href="#deleteMessageModal" id="<?php echo $message['id'] ?>" class="icon delete"
                                                       data-bs-toggle="modal" data-bs-target="#deleteMessageModal" title="Delete"><i class="fas fa-trash-alt"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="email-head-sender d-flex align-items-center justify-content-between flex-wrap">
                                            <div class="d-flex align-items-center">
                                                <div class="sender d-flex align-items-center">
                                                    <a href="#"><?php echo $message["fromEmail"] ?></a> <span>to</span><a href="#"><?php echo ($message["toEmail"] === $_SESSION["userdata"]["email"]) ? "me" : $message["toEmail"]?></a>
                                                    <div class="actions dropdown">

                                                        <div class="dropdown-menu" role="menu">
                                                            <a class="dropdown-item" href="#">Mark as read</a>
                                                            <a class="dropdown-item" href="#">Mark as unread</a>
                                                            <a class="dropdown-item" href="#">Spam</a>
                                                            <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item text-danger" href="#">Delete</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="date"><?php echo $message["notificationDate"] ?></div>
                                        </div>
                                    </div>
                                    <div class="email-body">
                                        <?php echo $message["message"] ?>
                                    </div>
                                </div>`
                            );
                        }
                        LoadMessage()
                    <?php }
                }?>

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
                                        location.href = "<?php echo HOME_URL . '/admin/messages/inbox';?>";
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
                                        location.href = "<?php echo HOME_URL . '/admin/messages/inbox';?>";
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
                                            location.href = "<?php echo HOME_URL . '/admin/messages/inbox';?>";
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
                                            location.href = "<?php echo HOME_URL . '/admin/messages/inbox';?>";
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

                //set modal "message to" as the "message from" that is on message view, when "reply" button click
                $('.reply').on('click', function(){
                    let userToReply = $(this).attr("id");
                    $("#addMessageModal").modal('show');
                    let $select = $("#addMessageModal select").selectize();
                    $select[0].selectize.setValue(userToReply);
                });

            });
        </script>