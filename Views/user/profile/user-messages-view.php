<?php
/**
 * Created by PhpStorm.
 * User: TFC_ Group
 * Date: 07/07/2022
 * Time: 23.10
 */
?>
<?php if (!defined('ABSPATH')) exit; ?>

<?php if ($this->login_required && !$this->logged_in) return; ?>

<!--TODO ver loader na frente da caixa de envio da mensagem-->
<!-- Image loader -->
<div class="loaderOverlay lds-dual-ring hidden" id="loader">
    <svg class="loader" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
        <circle cx="50" cy="50" r="46"/>
    </svg>
</div>
<!-- Image loader -->

<!--Messages Start-->
<section class="home-about wf100 p80">
    <div class="container">
        <div class="row">
            <div class="grid email">
                <div class="grid-body">
                    <div class="row">
                        <!-- BEGIN INBOX MENU -->
                        <div class="col-md-3">
                            <h3 class="grid-title"><i class="fa fa-inbox"></i> Caixa de mensagens</h3>
                            <button class="btn edit btn-success" id="" data-toggle="modal"
                                    data-target="#addMessageModal" data-bs-toggle="modal"
                                    data-bs-target="#addMessageModal"
                            ><i class="fa fa-pen"></i>&nbsp;&nbsp;Nova Mensagem
                            </button>
                            <hr>
                            <div>
                                <ul class="nav flex-column nav-pills nav-stacked">
                                    <li class="header">Pastas</li>
                                    <li class="nav-item <?php echo ($tabActive === "inbox") ? "active" : "" ?>">
                                        <a class="nav-link" href="<?php echo HOME_URL . '/home/userMessages/inbox' ?>">
                                            <i class="fa fa-inbox"></i> Caixa Entrada
                                        </a>
                                    </li>
                                    <li class="nav-item <?php echo ($tabActive === "sent") ? "active" : "" ?>">
                                        <a class="nav-link" href="<?php echo HOME_URL . '/home/userMessages/sent' ?>">
                                            <i class="fa fa-share"></i> Enviado
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- END INBOX MENU -->

                        <!-- BEGIN INBOX CONTENT -->
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label style="margin-right: 8px;" class="">
                                        <div class="icheckbox_square-blue" style="position: relative;"><input
                                                    type="checkbox" id="check-all" class="icheck"
                                                    style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);">
                                            <ins class="iCheck-helper"
                                                 style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins>
                                        </div>
                                    </label>
                                    <!--Dropdown menu-->
                                    <div class="btn-group">
                                        <button type="button" class="btn edit btn-success dropdown-toggle"
                                                data-toggle="dropdown">
                                            Mais <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a class="dropdown-item message-read bulk" href="javascript:void(0);">Marcar
                                                    lido</a></li>
                                            <li><a class="dropdown-item message-unread bulk" href="javascript:void(0);">Marcar
                                                    não lido</a></li>
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                            <li><a href="#bulkDeleteMessagesModal" class="dropdown-item"
                                                   data-toggle="modal" data-target="#bulkDeleteMessagesModal"
                                                   title="Delete">Delete</a></li>
                                            <li>
                                        </ul>
                                    </div>
                                    <!--Refresh-->
                                    <a class="btn edit btn-success"
                                       href="<?php echo HOME_URL . '/home/usermessages/inbox' ?>" data-toggle="tooltip"
                                       data-placement="bottom" title="Atualizar">
                                        <i class="fa fa-retweet"></i>
                                    </a>
                                </div>
                            </div>
                            <br>
                            <div class="padding"></div>
                            <!-- INBOX/SENT -->
                            <div id="inbox-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered mytable display" id="messagesTable" style="width:97%">
                                        <thead>
                                        <tr>
                                            <th> <input id="all-none" type="checkbox"></th>
                                            <th>De</th>
                                            <th>Assunto</th>
                                            <th>Data</th>
                                            <th></th>
                                            <th hidden></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php if (!empty($this->userdata['userMessageList'])) {
                                            foreach ($this->userdata['userMessageList'] as $key => $message) { ?>
                                                <tr class="nav-item <?php echo ($message["receptionDate"] != null) ? "read" : ""; ?>"
                                                    role="presentation">
                                                    <td class="action short-td">
                                                        <input class="message-check" type="checkbox"
                                                               style="text-align: center; vertical-align: middle; width: 36px; ">
                                                    </td>
                                                    <td class="name long-td ">
                                                        <?php echo $message["fromName"] ?>
                                                    </td>
                                                    <td class="subject long-td">
                                                        <a href="<?php echo HOME_URL . '/home/usermessages/' . $message["id"]; ?>">
                                                            <?php echo $message["subject"] ?>
                                                        </a>
                                                    </td>
                                                    <td class="time long-td"><?php echo $message["notificationDate"] ?></td>
                                                    <td>
                                                        <?php if ($message["receptionDate"] === null) { ?>
                                                            <a href="javascript:void(0);"
                                                               id="<?php echo $message['id'] ?>"
                                                               class="message-read" title="Não lido"><i
                                                                        class="fa fa-envelope"></i></a>
                                                        <?php } else { ?>
                                                            <a href="javascript:void(0);"
                                                               id="<?php echo $message['id'] ?>"
                                                               class="message-unread" title="Lido"><i
                                                                        class="fa fa-envelope-open"></i></a>
                                                        <?php } ?>
                                                        <a href="#deleteMessageModal" id="<?php echo $message['id'] ?>"
                                                           class="delete m-2"
                                                           data-bs-toggle="modal" data-bs-target="#deleteMessageModal"
                                                           title="Delete"><i class="fas fa-trash-alt"></i></a>
                                                    </td>

                                                    <td class="message-id" id="<?php echo $message['id'] ?>"
                                                        hidden></td>
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
                        <!-- Modal -->
                        <div class="modal hide fade in" id="addMessageModal" data-keyboard="false"
                             data-backdrop="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Nova mensagem</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="addMessage">
                                            <div class="modal-body">
                                                <input id="addMessageFromUser" name="addMessageFromUser" type="hidden"
                                                       class="form-control"
                                                       value="<?php echo $_SESSION["userdata"]["id"]; ?>">
                                                <div class="form-group">
                                                    <label>Para:</label>
                                                    <select  name="addMessageToUser" id="addMessageToUser" required>
                                                        <option value="" disabled selected>Selecione o recetor</option>
                                                        <?php if (!empty($this->userdata['usersList'])) {
                                                            foreach ($this->userdata['usersList'] as $key => $user) { ?>
                                                                <option value="<?php echo $user['id'] ?>" ><?php echo $user["email"] ?> </option>
                                                            <?php }
                                                        } ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Assunto</label>
                                                    <input name="addMessageSubject" type="text" class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Mensagem</label>
                                                    <textarea name="addMessageMessage" class="form-control" required
                                                              style="height: 120px;"></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                                                            class="fa fa-times"></i> Voltar
                                                </button>
                                                <button type="submit" class="btn btn-success pull-right"><i
                                                            class="fa fa-envelope"></i> Enviar
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete messages Modal HTML -->
        <div id="deleteMessageModal" class="modal fade center" data-keyboard="false"
             data-backdrop="false" style="background-color: rgba(0, 0, 0, 0.5);" tabindex="-1"
             aria-labelledby="bulkDeleteMessagesModal-Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="deleteMessage">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Apagar mensagem</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            De certeza que pretende apagar a mensagem?
                            <p class="text-warning"><small>Esta ação não pode ser desfeita!</small></p>
                            <input id="deleteMessageId" name="deleteMessageId" type="hidden" class="form-control"
                                   value="">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                                        class="fa fa-times"></i> Cancelar
                            </button>
                            <input type="submit" class="btn btn-danger" value="Apagar">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Delete bulk messages Modal HTML -->
        <div id="bulkDeleteMessagesModal" class="modal fade center" data-keyboard="false"
             data-backdrop="false" style="background-color: rgba(0, 0, 0, 0.5);" tabindex="-1"
             aria-labelledby="bulkDeleteMessagesModal-Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="bulkDeleteMessages">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Apagar mensagem</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            De certeza que pretende apagar a mensagem?
                            <p class="text-warning"><small>Esta ação não pode ser desfeita!</small></p>
                            <input id="deleteMessageId" name="deleteMessageId" type="hidden" class="form-control"
                                   value="">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                                        class="fa fa-times"></i> Cancelar
                            </button>
                            <input type="submit" class="btn btn-danger" value="Apagar">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- END INBOX -->
    </div>
</section>
<!--Messages End-->

<script>

    //get and returns selected messages
    function getMessagesSelected() {
        let idArray = []
        $('table > tbody > tr ').each(function () {
            let messageId = $(this).find("td.message-id").attr("id")

            if ($(this).find("input.message-check").is(":checked")) {
                idArray.push(messageId)
            }
        });
        //console.log(idArray)
        return idArray;
    }

    $(document).ready(function () {

        //DATATABLES
        try {
            var table = $('#messagesTable').DataTable({
                rowReorder: false,
                responsive: true,
                lengthChange: false,
                pageLength: 15,
                colReorder: false,
                columns: [
                    { "width": "5%", orderable: false },
                    { "width": "20%" },
                    { "width": "20%" },
                    { "width": "20%" },
                    { "width": "10%" },
                    { "width": "0%" }
                ],
                "language": {
                    "sProcessing": "A processar...",
                    "sLengthMenu": "Mostrar _MENU_ registos",
                    "sZeroRecords": "Sem resultados",
                    "sInfo": "Mostrando _START_ a _END_ em um total de _TOTAL_ mensagens.",
                    "sInfoEmpty": "Mostrando mensagens de 0 a 0 de um total de 0 mensagens.",
                    "sInfoPostFix": "",
                    "sSearch": "Pesquisar:",
                    "sUrl": "",
                    "sInfoThousands": ",",
                    "sLoadingRecords": "Carregando...",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast": "Último",
                        "sNext": "Seguinte",
                        "sPrevious": "Anterior"
                    }

                }
            });
        } catch (error) {
            console.log(error);
        }

        // show/hide actions on each message selected
        $(".message-check").change(function () {
            let anyChecked, count = 0
            //if any is checked, "anyChecked" equals to true
            $(".message-check").each(function () {
                if ($(this).is(":checked")) {
                    anyChecked = true;
                    count++;
                }
                if ($(this).checked === false) {
                    anyChecked = false;
                    count--;
                }
            });
            //and shows the actions
            if (anyChecked === true) {
                $("#action-button").attr("hidden", false);
            } else { // else hides actions
                if (count === 0) {
                    $('#all-none').prop("checked", false);
                }
                $("#action-button").attr("hidden", true);
            }
        });

        // check/uncheck messages & show/hide actions
        $("#all-none").change(function () {
            if ($(this).is(":checked")) {
                $('.message-check').prop("checked", true);
                $("#action-button").attr("hidden", false);
            } else {
                $('.message-check').prop("checked", false);
                $("#action-button").attr("hidden", true);
            }
        });

        //Function to dynamic search on dropbox
        $('select').selectize({sortField: 'text'});

        //view message
        <?php if( isset($this->userdata["userMessageView"]) && !empty($this->userdata["userMessageView"])) {
        foreach ($this->userdata['userMessageView'] as $key => $message) {?>
        function LoadMessage() {
            $('#inbox-body').html(`
                                <div class="col-lg-12 email-content">
                                    <div class="email-head">
                                        <div class="email-head-subject">
                                            <div class="title d-flex align-items-center justify-content-between">
                                                <div class="d-flex align-items-center">
                                                    <span> <b><?php echo $message["subject"] ?> </b></span>
                                                </div>
                                                <div class="icons">
                                                    <a href="javascript:void();" id="<?php echo $message['fromUser'] ?>" class="icon reply replyIcon"><i class="fa fa-reply fa-lg"></i></a>
                                                    &nbsp;&nbsp;
                                                    <a href="#deleteMessageModal" id="<?php echo $message['id'] ?>" class="icon delete deleteIcon"
                                                       data-bs-toggle="modal" data-bs-target="#deleteMessageModal" title="Delete"><i class="fas fa-trash-alt fa-lg"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="email-head-sender d-flex align-items-center justify-content-between flex-wrap">
                                            <div class="d-flex align-items-center">
                                                <div class="sender d-flex align-items-center">
                                                    <p href="#">De&nbsp;&nbsp;<?php echo $message["fromEmail"] ?></a> <span>&nbsp;&nbsp;para&nbsp;&nbsp;</span><p href="#"><?php echo ($message["toEmail"] === $_SESSION["userdata"]["email"]) ? "mim." : $message["toEmail"]?></p>
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

        // Ajax to Add Message
        $('#addMessage').submit(function (event) {
            event.preventDefault(); //prevent default action
            let formData = {
                'action': "AddMessage",
                'data': $(this).serializeArray()
            };

            $.ajax({
                url: "<?php echo HOME_URL . '/home/userMessages';?>",
                dataType: "json",
                type: 'POST',
                data: formData,
                beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                    $('#loader').removeClass('hidden')
                },
                success: function (data) {
                    $("#addMessageModal").modal('hide');
                    if (data.statusCode === 201) {
                        //mensagem de Success
                        Swal.fire({
                            title: 'Success!',
                            text: data.body.message,
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 2000,
                            didClose: () => {
                                location.href = "<?php echo HOME_URL . '/home/usermessages/inbox';?>";
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

        //Ajax to set message as unread
        $(".message-unread").click(function (e) {
            e.preventDefault();
            let idArray = []
            if ($(this).hasClass("bulk")) { // if its a bulk action
                idArray = getMessagesSelected()//get messages selected, if any
            } else {
                if (idArray.length === 0) {
                    idArray.push($(this).attr("id"))
                } //if not a bulk action, gets the id from the button/anchor's "id" attr of the specific message
            }
            let formData = {
                'action': "MarkUnread",
                'data': idArray
            };

            $.ajax({
                url: "<?php echo HOME_URL . '/home/userMessages';?>",
                dataType: "json",
                type: 'POST',
                data: formData,
                beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                    $('#loader').removeClass('hidden')
                },
                success: function (data) {

                    if (data.statusCode === 200) {
                        //mensagem de Success
                        Swal.fire({
                            title: 'Successo!',
                            text: data.body.message,
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 2000,
                            didClose: () => {
                                location.href = "<?php echo HOME_URL . '/home/usermessages/inbox';?>";
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
                        }
                    });
                },
                complete: function () { // Set our complete callback, adding the .hidden class and hiding the spinner.
                    $('#loader').addClass('hidden')
                }
            });
        });

        //Ajax to set message as read
        $(".message-read").click(function (e) {
            e.preventDefault();
            let idArray = []
            if ($(this).hasClass("bulk")) { // if its a bulk action
                idArray = getMessagesSelected()//get messages selected, if any
            } else {
                if (idArray.length === 0) {
                    idArray.push($(this).attr("id"))
                } //if not a bulk action, gets the id from the button/anchor's "id" attr of the specific message
            }
            let formData = {
                'action': "MarkRead",
                'data': idArray
            };

            $.ajax({
                url: "<?php echo HOME_URL . '/home/userMessages';?>",
                dataType: "json",
                type: 'POST',
                data: formData,
                beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                    $('#loader').removeClass('hidden')
                },
                success: function (data) {

                    if (data.statusCode === 200) {
                        //mensagem de Success
                        Swal.fire({
                            title: 'Success!',
                            text: data.body.message,
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 2000,
                            didClose: () => {
                                location.href = "<?php echo HOME_URL . '/home/usermessages/inbox';?>";
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

        // Ajax to get data to Modal Delete Group
        $('.delete').on('click', function () {
            let $deleteID = $(this).attr('id');
            $('[name="deleteMessageId"]').val($deleteID); //gets group id from id="" attribute on delete button from table
            $("#deleteMessageModal").modal('show');
        });

        // Ajax to Delete Message
        $('#deleteMessage').submit(function (event) {
            event.preventDefault(); //prevent default action
            let idArray = []
            idArray.push($(this).find("[name='deleteMessageId']").val())
            let formData = {
                'action': "DeleteMessage",
                'data': idArray
            };
            $.ajax({
                url: "<?php echo HOME_URL . '/home/userMessages';?>",
                dataType: "json",
                type: 'POST',
                data: formData,
                beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                    $('#loader').removeClass('hidden')
                },
                success: function (data) {
                    $("#deleteMessageModal").modal('hide');

                    if (data.statusCode === 200) {
                        //mensagem de Success
                        Swal.fire({
                            title: 'Success!',
                            text: data.body.message,
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 2000,
                            didClose: () => {
                                location.href = "<?php echo HOME_URL . '/home/usermessages/inbox';?>";
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
        $('#bulkDeleteMessages').submit(function (event) {
            event.preventDefault(); //prevent default action
            let idArray = []
            idArray = getMessagesSelected() //get messages selected, if any
            let formData = {
                'action': "DeleteMessage",
                'data': idArray
            };

            $.ajax({
                url: "<?php echo HOME_URL . '/home/userMessages';?>",
                dataType: "json",
                type: 'POST',
                data: formData,
                beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                    $('#loader').removeClass('hidden')
                },
                success: function (data) {
                    $("#bulkDeleteMessagesModal").modal('hide');

                    if (data.statusCode === 200) {
                        //mensagem de Success
                        Swal.fire({
                            title: 'Success!',
                            text: data.body.message,
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 2000,
                            didClose: () => {
                                location.href = "<?php echo HOME_URL . '/home/usermessages/inbox';?>";
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

        //set modal "message to" as the "message from" that is on message view, when "reply" button click
        $('.reply').on('click', function () {
            let userToReply = $(this).attr("id");
            $("#addMessageModal").modal('show');
            let $select = $("#addMessageModal select").selectize();
            $select[0].selectize.setValue(userToReply);
        });
    });
</script>