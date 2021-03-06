
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

                                    <!--<div class="card">
                                        <div class="card-body">-->
                                            <div class="grid email" style="word-wrap: break-word;">
                                                <div class="grid-body">
                                                    <div class="row">
                                                        <!-- BEGIN INBOX MENU -->
                                                        <div class="col-md-3">
                                                            <h2 class="grid-title"><i class="fa fa-inbox"></i>&nbsp;Minhas mensagens</h2>
                                                            <a class="btn btn-primary" style="display: block"
                                                               data-bs-toggle="modal" data-bs-target="#addMessageModal">
                                                                <i class="fa fa-pencil"></i>&nbsp;&nbsp;Nova mensagem
                                                            </a>

                                                            <hr>

                                                            <div>
                                                                <ul class="nav flex-column nav-pills nav-stacked">
                                                                    <li class="header">Core</li>
                                                                    <li class="nav-item <?php echo ($tabActive === "inbox") ? "active" : ""?>">
                                                                        <a class="nav-link" href="<?php echo HOME_URL . '/admin/messages/inbox'?>">
                                                                            <i class="fa fa-inbox"></i>&nbsp;Caixa de entrada
                                                                        </a>
                                                                    </li>
                                                                    <li class="nav-item <?php echo ($tabActive === "sent") ? "active" : ""?>">
                                                                        <a class="nav-link" href="<?php echo HOME_URL . '/admin/messages/sent'?>">
                                                                            <i class="fa fa-mail-forward"></i>&nbsp;Enviado
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
                                                                            A????o <span class="caret"></span>
                                                                        </button>
                                                                        <ul class="dropdown-menu" role="menu">
                                                                            <li><a class="dropdown-item message-read bulk" href="javascript:void(0);">Marcar como lida</a></li>
                                                                            <li><a class="dropdown-item message-unread bulk" href="javascript:void(0);">Marcar como n??o lida</a></li>
                                                                            <li><hr class="dropdown-divider"></li>
                                                                            <li><a href="#bulkDeleteMessagesModal" class="dropdown-item"
                                                                                   data-bs-toggle="modal" data-bs-target="#bulkDeleteMessagesModal">Apagar</a></li>
                                                                        </ul>
                                                                    </div>
                                                                    <!-- refresh -->
                                                                    <a class="btn" href="<?php echo HOME_URL . '/admin/messages/inbox'?>" title="Atualizar">
                                                                        <i class="fa-solid fa-rotate"></i>
                                                                    </a>
                                                                </div>

                                                            </div>

                                                            <div class="padding"></div>

                                                            <!-- INBOX/SENT -->
                                                            <div id="inbox-body">
                                                                <div class="table-responsive">
                                                                    <table class="table" id="messagesTable" style="width:100%">
                                                                        <thead hidden>
                                                                            <tr>
                                                                                <th>col1</th>
                                                                                <th>col2</th>
                                                                                <th>col3</th>
                                                                                <th>col4</th>
                                                                                <th>col5</th>
                                                                                <th>col6</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                        <?php if (!empty($this->userdata['inboxSentUserMessageList'])) {
                                                                            foreach ($this->userdata['inboxSentUserMessageList'] as $key => $message) { ?>

                                                                                <tr class="nav-item <?php echo ($message["receptionDate"] != null ) ? "read" : ""; ?>" role="presentation">
                                                                                    <td class="message-id" id="<?php echo $message['id'] ?>" hidden></td>
                                                                                    <td class="action">
                                                                                        <input class="message-check" type="checkbox">
                                                                                    </td>
                                                                                    <td class="name">
                                                                                        <div class="text-truncate" style="max-width: 150px">
                                                                                            De: <?php echo $message["fromName"] ?>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td class="subject">
                                                                                        <div class="text-truncate" style="max-width: 200px">
                                                                                            <a href="<?php echo HOME_URL . '/admin/messages/' . $message["id"];?>" title="<?php echo $message["subject"]?>">
                                                                                                <?php echo $message["subject"]?>
                                                                                            </a>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td class="time"><?php echo $message["notificationDate"] ?></td>
                                                                                    <td>
                                                                                        <?php if ($message["receptionDate"] === null ) {?>
                                                                                            <a href="javascript:void(0);" id="<?php echo $message['id'] ?>"
                                                                                               class="message-read m-2" title="Marcar como lida"><i class="fa-solid fa-envelope fa-lg"></i></a>
                                                                                        <?php } else {?>
                                                                                            <a href="javascript:void(0);" id="<?php echo $message['id'] ?>"
                                                                                               class="message-unread m-2" title="Marcar como n??o lida"><i class="fa-solid fa-envelope-open fa-lg"></i></a>
                                                                                        <?php }?>

                                                                                        <a href="#deleteMessageModal" id="<?php echo $message['id'] ?>" class="delete m-2"
                                                                                           data-bs-toggle="modal" data-bs-target="#deleteMessageModal" title="Apagar"><i class="fas fa-trash-alt fa-lg"></i></a>
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
                                                                            <h4 class="modal-title"><i class="fa fa-envelope"></i> Nova mensagem</h4>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <form id="addMessage">
                                                                            <div class="modal-body">
                                                                                <input id="addMessageFromUser" name="addMessageFromUser" type="hidden" class="form-control" value="<?php echo $_SESSION["userdata"]["id"];?>">
                                                                                <div class="form-group">
                                                                                    <label>Para</label>
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
                                                                                    <label>Assunto</label>
                                                                                    <input name="addMessageSubject" type="text" class="form-control" maxlength="30" required>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label>Mensagem</label>
                                                                                    <textarea name="addMessageMessage" class="form-control" style="height: 120px;" maxlength="350" required></textarea>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-default" data-bs-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
                                                                                <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-envelope"></i> Enviar</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div><!-- END COMPOSE MESSAGE -->

                                                    </div>
                                                </div>
                                            </div>

                                            <!--</div>
                                        </div>-->

                                </div> <!--END INBOX-->

                        <!--</div>
                    </div>-->

                </div>

            </div>
        </div>

        <!-- Delete Message Modal HTML -->
            <div id="deleteMessageModal" class="modal fade" tabindex="-1" aria-labelledby="deleteMessageModal-Label" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form id="deleteMessage">
                            <div class="modal-header">
                                <h4 class="modal-title">Apagar mensagem</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Tem a certeza que quer apagar esta mensagen?</p>
                                <p class="text-warning"><small>A a????o n??o pode ser defeita.</small></p>
                                <input id="deleteMessageId" name="deleteMessageId" type="hidden" class="form-control" value="">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <input type="submit" class="btn btn-danger" value="Apagar">
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
                                <h4 class="modal-title">Apagar mensagens</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Tem a certeza que quer apagar <strong>TODAS</strong> as mensagens selecionadas?</p>
                                <p class="text-warning"><small>A a????o n??o pode ser defeita.</small></p>
                                <!--<input id="deleteMessageId" name="deleteMessageId" type="hidden" class="form-control" value="">-->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <input type="submit" class="btn btn-danger" value="Apagar todas">
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
                        oLanguage: {
                            "sUrl": "https://cdn.datatables.net/plug-ins/1.12.1/i18n/pt-PT.json"
                        }
                    });

                } catch (error) {
                    console.log(error);
                }

                //view message
                <?php if( isset($this->userdata["userMessageView"]) && !empty($this->userdata["userMessageView"])) {
                    foreach ($this->userdata['userMessageView'] as $key => $message) {?>
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
                                                    <?php if ($message["receptionDate"] === null ) {?>
                                                        <a href="javascript:void(0);" id="<?php echo $message['id'] ?>"
                                                           class="icon message-read" title="Marcar como lida"><i class="fa-solid fa-envelope fa-lg"></i></a>
                                                    <?php } else {?>
                                                        <a href="javascript:void(0);" id="<?php echo $message['id'] ?>"
                                                           class="icon message-unread" title="Marcar como n??o lida"><i class="fa-solid fa-envelope-open fa-lg"></i></a>
                                                    <?php }?>

                                                    <a href="javascript:void();" id="<?php echo $message['fromUser'] ?>" class="icon reply" title="Responder"><i class="fa-solid fa-reply fa-lg"></i></a>
                                                    <a href="#deleteMessageModal" id="<?php echo $message['id'] ?>" class="icon delete"
                                                       data-bs-toggle="modal" data-bs-target="#deleteMessageModal" title="Apagar"><i class="fas fa-trash-alt fa-lg"></i></a>
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

                    let idArray = []
                    idArray.push($(this).find("[name='deleteMessageId']").val())

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
                            $("#deleteMessageModal").modal('hide');

                            if (data.statusCode === 200){
                                //mensagem de Success
                                Swal.fire({
                                    title: 'Sucesso!',
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
                                    title: 'Erro!',
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
                                title: 'Erro!',
                                text: "Erro de conex??o, por favor tente denovo.",
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
                                    title: 'Sucesso!',
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
                                    title: 'Erro!',
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
                                title: 'Erro!',
                                text: "Erro de conex??o, por favor tente denovo.",
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
                $(".message-unread").click(function(e) {
                    e.preventDefault();

                    let idArray = []
                    if($(this).hasClass("bulk")){ // if its a bulk action
                        idArray = getMessagesSelected()//get messages selected, if any
                    } else {
                        if(idArray.length === 0) { idArray.push($(this).attr("id")) } //if not a bulk action, gets the id from the button/anchor's "id" attr of the specific message
                    }

                    let formData = {
                        'action': "MarkUnread",
                        'data': idArray
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

                            if (data.statusCode === 200) {
                                //mensagem de Success
                                Swal.fire({
                                    title: 'Sucesso!',
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
                                    title: 'Erro!',
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
                                title: 'Erro!',
                                text: "Erro de conex??o, por favor tente denovo.",
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

                //ajax to set message as read
                $(".message-read").click(function(e) {
                    e.preventDefault();

                    let idArray = []
                    if($(this).hasClass("bulk")){ // if its a bulk action
                        idArray = getMessagesSelected()//get messages selected, if any
                    } else {
                        if(idArray.length === 0) { idArray.push($(this).attr("id")) } //if not a bulk action, gets the id from the button/anchor's "id" attr of the specific message
                    }

                    let formData = {
                        'action': "MarkRead",
                        'data': idArray
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

                            if (data.statusCode === 200) {
                                //mensagem de Success
                                Swal.fire({
                                    title: 'Sucesso!',
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
                                    title: 'Erro!',
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
                                title: 'Erro!',
                                text: "Erro de conex??o, por favor tente denovo.",
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
                $('.reply').on('click', function(){
                    let userToReply = $(this).attr("id");
                    $("#addMessageModal").modal('show');
                    let $select = $("#addMessageModal select").selectize();
                    $select[0].selectize.setValue(userToReply);
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