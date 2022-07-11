
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

                        <!--<div class="container">
                            <div class="row">
                                 BEGIN INBOX -->
                                <div class="col-md-12">

                                    <div class="grid email">
                                        <div class="grid-body">
                                            <div class="row">
                                                <!-- BEGIN INBOX MENU -->
                                                <div class="col-md-3">
                                                    <h2 class="grid-title"><i class="fa fa-inbox"></i> Inbox (All)</h2>
                                                    <a class="btn btn-block btn-primary" style="display: block"
                                                       data-bs-toggle="modal" data-bs-target="#addMessageModal">
                                                        <i class="fa fa-pencil"></i>&nbsp;&nbsp;NEW MESSAGE
                                                    </a>

                                                    <hr>

                                                    <div>
                                                        <ul class="nav flex-column nav-pills nav-stacked">
                                                            <li class="header">Folders</li>
                                                            <li class="nav-item <?php echo ($tabActive === "inbox") ? "active" : ""?>">
                                                                <a class="nav-link" href="<?php echo HOME_URL . '/admin/all_messages/inbox'?>">
                                                                    <i class="fa fa-inbox"></i> Inbox
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
                                                            <div class="btn-group">
                                                                <input id="all-none" type="checkbox">
                                                                <button hidden id="action-button" type="button" class="btn btn-default dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                                    Action <span class="caret"></span>
                                                                </button>
                                                                <ul class="dropdown-menu" role="menu">
                                                                    <li><a href="#bulkDeleteMessagesModal" class="dropdown-item"
                                                                           data-bs-toggle="modal" data-bs-target="#bulkDeleteMessagesModal" title="Delete">Delete</a></li>
                                                                </ul>
                                                            </div>
                                                            <!-- refresh -->
                                                            <a class="btn" href="<?php echo HOME_URL . '/admin/all_messages/inbox'?>">
                                                                <i class="fa-solid fa-rotate"></i>
                                                            </a>
                                                        </div>
                                                    </div>

                                                    <div class="padding"></div>

                                                    <!-- INBOX/SENT -->
                                                    <div id="inbox-body">
                                                        <div class="table-responsive">
                                                            <table class="table" id="messagesTable">
                                                                <thead hidden>
                                                                <tr>
                                                                    <th>col1</th>
                                                                    <th>col2</th>
                                                                    <th>col3</th>
                                                                    <th>col4</th>
                                                                    <th>col5</th>
                                                                    <th>col6</th>
                                                                    <th>col7</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                <?php if (!empty($this->userdata['allMessageList'])) {
                                                                    foreach ($this->userdata['allMessageList'] as $key => $message) { ?>

                                                                        <tr class="nav-item <?php echo ($message["receptionDate"] != null ) ? "read" : ""; ?>" role="presentation">
                                                                            <td class="message-id" id="<?php echo $message['id'] ?>" hidden></td>
                                                                            <td class="action">
                                                                                <input class="message-check" type="checkbox">
                                                                            </td>
                                                                            <td class="name">
                                                                                From: <?php echo $message["fromName"] ?>
                                                                            </td>
                                                                            <td class="name">
                                                                                To: <?php echo $message["toName"] ?>
                                                                            </td>
                                                                            <td class="subject">
                                                                                <div class="text-truncate" style="max-width: 200px">
                                                                                    <a href="<?php echo HOME_URL . '/admin/all_messages/' . $message["id"];?>">
                                                                                        <?php echo $message["subject"]?>
                                                                                    </a>
                                                                                </div>
                                                                            </td>
                                                                            <td class="time"><?php echo $message["notificationDate"] ?></td>
                                                                            <td>
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
                                                                            <select name="addMessageToUser" id="addMessageToUser" required>
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
                                                                            <input name="addMessageSubject" type="text" class="form-control" maxlength="30" required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Message</label>
                                                                            <textarea name="addMessageMessage" class="form-control" style="height: 120px;" maxlength="350" required></textarea>
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

                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <!-- END INBOX
                            </div>
                        </div>-->

                    </div>

                </div>
            </div>


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

            <!-- Bulk Delete messages Modal HTML -->
            <div id="bulkDeleteMessagesModal" class="modal fade" tabindex="-1" aria-labelledby="bulkDeleteMessagesModal-Label" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form id="bulkDeleteMessages">
                            <div class="modal-header">
                                <h4 class="modal-title">Delete Messages</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to delete <strong>ALL</strong> selected messages?</p>
                                <p class="text-warning"><small>This action cannot be undone.</small></p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <input type="submit" class="btn btn-danger" value="Delete all">
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </main>





        <script>
            //get and returns selected messages
            function getMessagesSelected() {
                let idArray = []
                $('table > tbody > tr ').each(function () {
                    let messageId = $(this).find("td.message-id").attr("id")

                    if ($(this).find("input.message-check").is(":checked")){
                        idArray.push(messageId)
                    }
                });
                //console.log(idArray)
                return idArray;
            }

            $(document).ready(function() {
                //DATATABLES
                //Configura a dataTable
                try{
                    var table = $('#messagesTable').DataTable({
                        rowReorder: false,
                        responsive: true,
                        lengthChange: false,
                        pageLength: 15,
                        //order: [[4, 'desc']]
                    });

                } catch (error) {
                    console.log(error);
                }

                //view message
                <?php if( isset($this->userdata["allMessageView"]) && !empty($this->userdata["allMessageView"])) {
                    foreach ($this->userdata['allMessageView'] as $key => $message) {?>
                        function LoadMessage() {
                            $("#all-none").attr("hidden", true);//hide actions
                            $('#inbox-body').html(`
                                        <div class=" email-content"> <!--col-lg-9-->
                                            <div class="email-head">
                                                <div class="email-head-subject">
                                                    <div class="title d-flex align-items-center justify-content-between">
                                                        <div class="d-flex align-items-center">
                                                            <h5><strong><?php echo $message["subject"] ?></strong></h5>
                                                        </div>
                                                        <div class="icons">
                                                            <a href="#deleteMessageModal" id="<?php echo $message['id'] ?>" class="icon delete"
                                                               data-bs-toggle="modal" data-bs-target="#deleteMessageModal" title="Delete"><i class="fas fa-trash-alt"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="email-head-sender d-flex align-items-center justify-content-between flex-wrap">
                                                    <div class="d-flex align-items-center">
                                                        <div class="sender d-flex align-items-center">
                                                            <span><strong><?php echo $message["fromEmail"] ?></strong> to <strong><?php echo ($message["toEmail"] === $_SESSION["userdata"]["email"]) ? "me" : $message["toEmail"]?></strong></span>
                                                        </div>
                                                    </div>
                                                    <div class="date"><?php echo $message["notificationDate"] ?></div>
                                                </div>
                                            </div>
                                            <div class="email-body">
                                                <p><?php $array = preg_split("/\r\n|\n|\r/", $message["message"]);  foreach ($array as $line){ echo $line; echo "<br>";} ?></p>
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
                        url: "<?php echo HOME_URL . '/admin/all_messages';?>",
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
                                        location.href = "<?php echo HOME_URL . '/admin/all_messages/inbox';?>";
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

                    let idArray = []
                    idArray.push($(this).find("[name='deleteMessageId']").val())

                    let formData = {
                        'action' : "DeleteMessage",
                        'data'   : idArray
                    };

                    $.ajax({
                        url : "<?php echo HOME_URL . '/admin/all_messages';?>",
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
                                        location.href = "<?php echo HOME_URL . '/admin/all_messages/inbox';?>";
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

                // ajax to BULK Delete Messages
                $('#bulkDeleteMessages').submit(function(event){
                    event.preventDefault(); //prevent default action

                    let idArray = []
                    idArray = getMessagesSelected() //get messages selected, if any
                    //if(idArray.length === 0) { idArray.push($(this).find("[name='deleteMessageId']").val()) }

                    let formData = {
                        'action' : "DeleteMessage",
                        'data'   : idArray
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
                            $("#bulkDeleteMessagesModal").modal('hide');

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

            });

            //select actions
            $(document).ready(function() {
                // make select have input to seach for option
                $('select').selectize({ sortField: 'text' });

                // show/hide actions on each message selected
                $(".message-check").change(function() {
                    let anyChecked, count=0

                    //if any is checked, "anyChecked" equals to true
                    $(".message-check").each(function() {
                        if ($(this).is(":checked")) { anyChecked = true; count++; }
                        if ($(this).checked === false) { anyChecked = false; count--; }
                    });

                    //and shows the actions
                    if (anyChecked === true) {
                        $("#action-button").attr("hidden", false);
                    } else { // else hides actions
                        if(count === 0){ $('#all-none').prop("checked", false); }
                        $("#action-button").attr("hidden", true);
                    }
                });

                // check/uncheck messages & show/hide actions
                $("#all-none").change(function() {
                    if ($(this).is(":checked")) {
                        $('.message-check').prop("checked", true);
                        $("#action-button").attr("hidden", false);
                    } else {
                        $('.message-check').prop("checked", false);
                        $("#action-button").attr("hidden", true);
                    }
                });

            });
        </script>