<?php
/**
 * Created by PhpStorm.
 * User: V1p3r
 * Date: 17/10/2018
 * Time: 20:14
 */
?>
<?php if (!defined('ABSPATH')) exit; ?>

<?php if ($this->login_required && !$this->logged_in) return; ?>

<!-- AJAX loader -->
<div id="loader" class="lds-dual-ring hidden overlay"></div>

<!--Messages Start-->
<section class="home-about wf100 p80">
    <div class="container">
        <div class="row">


            <!-- BEGIN INBOX -->
            <!--                <div class="col-md-18">-->

            <!-- ALERT ?
            <div id="liveAlert">
            </div>-->

            <div class="grid email">
                <div class="grid-body">
                    <div class="row">
                        <!-- BEGIN INBOX MENU -->
                        <div class="col-md-3">
                            <h2 class="grid-title"><i class="fa fa-inbox"></i> Caixa de mensagens</h2>
                            <!--                            <button class="edit btn-success"-->
                            <!--                                    data-bs-toggle="modal" data-bs-target="#addMessageModal">-->
                            <!--                                <i class="fa fa-pen"></i>&nbsp;&nbsp;NEW MESSAGE-->
                            <!--                            </button>-->

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
                                    <div class="btn-group">
                                        <button type="button" class="btn edit btn-success dropdown-toggle"
                                                data-toggle="dropdown">
                                            Action <span class="caret"></span>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div>

                                    <a class="btn edit btn-success"
                                       href="<?php echo HOME_URL . '/home/usermessages/inbox' ?>" data-toggle="tooltip" data-placement="bottom" title="Atualizar">
                                        <i class="fa fa-retweet" ></i>

                                    </a>
                                </div>
                                <div class="col-md-6 search-form">
                                    <form action="#" class="text-right">
                                        <div class="input-group">
                                            <input type="text" class="form-control input-sm" placeholder="Search"
                                                   required>
                                            <span class="input-group-btn">
                                            <button type="submit" name="search"
                                                    class="btn_ search-btn btn-sm search"><i
                                                        class="fa fa-search"></i></button></span>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <br>

                            <div class="padding"></div>

                            <div id="inbox-body">
                                <div class="table-responsive ">
                                    <table class="table table-bordered">
                                        <!--Define space between columns-->
<!--                                        <colgroup>-->
<!--                                            <col span="1" style="width: 5%;">-->
<!--                                            <col span="1" style="width: 30%;">-->
<!--                                            <col span="1" style="width: 20%;">-->
<!--                                            <col span="1" style="width: 20%;">-->
<!--                                            <col span="1" style="width: 5%;">-->
<!---->
<!--                                        </colgroup>-->
                                        <thead>
                                        <tr>
                                            <th></th>
                                            <th>De</th>
                                            <th>Assunto</th>
                                            <th>Data</th>
                                            <th></th>

                                        </tr>
                                        </thead>

                                        <?php if (!empty($this->userdata['userMessageList'])) {
                                            foreach ($this->userdata['userMessageList'] as $key => $message) { ?>

                                                <tr class="nav-item <?php echo ($message["receptionDate"] != null) ? "read" : ""; ?>"
                                                    role="presentation">
                                                    <td class="message-id" id="<?php echo $message['id'] ?>"
                                                        hidden></td>
                                                    <td class="action">
                                                        <input class="message-check" type="checkbox">
                                                    </td>
                                                    <td class="name ">
<!--                                                        <div class="text-truncate" style="max-width: 20%">-->
                                                        <?php echo $message["fromName"] ?>
<!--                                                        </div>-->
                                                    </td>
                                                    <td class="subject">
<!--                                                        <div class="text-truncate" style="max-width: 50%">-->
                                                            <a href="<?php echo HOME_URL . '/home/usermessages/' . $message["id"]; ?>">
                                                                <?php echo $message["subject"] ?>
                                                            </a>

<!--                                                        </div>-->

                                                    </td>
                                                    <td class="time"><?php echo $message["notificationDate"] ?></td>
                                                    <td>
                                                        <?php if ($message["receptionDate"] === null) { ?>
                                                            <a href="javascript:void(0);"
                                                               id="<?php echo $message['id'] ?>"
                                                               class="message-read m-2" title="Mark as read"><i
                                                                        class="fa-solid fa-envelope-open"></i></a>
                                                        <?php } else { ?>
                                                            <a href="javascript:void(0);"
                                                               id="<?php echo $message['id'] ?>"
                                                               class="message-unread m-2" title="Mark as unread"><i
                                                                        class="fa-solid fa-envelope"></i></a>
                                                        <?php } ?>

                                                        <a href="#deleteMessageModal" id="<?php echo $message['id'] ?>"
                                                           class="delete m-2"
                                                           data-bs-toggle="modal" data-bs-target="#deleteMessageModal"
                                                           title="Delete"><i class="fas fa-trash-alt"></i></a>
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
                        <!-- Modal -->
                        <div class="modal hide fade in" id="addMessageModal" data-keyboard="false"
                             data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                                                    <select name="addMessageToUser" id="addMessageToUser">
                                                        <option value="" disabled selected>Selecione o recetor</option>
                                                        <?php if (!empty($this->userdata['usersList'])) {
                                                            foreach ($this->userdata['usersList'] as $key => $user) { ?>
                                                                <option value="<?php echo $user['id'] ?>"><?php echo $user["email"] ?></option>
                                                            <?php }
                                                        } ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Assunto</label>
                                                    <input name="addMessageSubject" type="text" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>Mensagem</label>
                                                    <textarea name="addMessageMessage" class="form-control"
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
                                    <!--                                    <div class="modal-footer">-->
                                    <!--                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
                                    <!--                                        <button type="button" class="btn btn-primary">Save changes</button>-->
                                    <!--                                    </div>-->
                                </div>
                            </div>
                        </div>


                        <!--                        <div id="addMessageModal" class="modal fade" tabindex="-1"-->
                        <!--                             aria-labelledby="addMessageModal-Label" aria-hidden="true">-->
                        <!--                            <div class="modal-wrapper">-->
                        <!--                                <div class="modal-dialog">-->
                        <!--                                    <div class="modal-content">-->
                        <!--                                        <div class="modal-header bg-blue">-->
                        <!--                                            <h4 class="modal-title"><i class="fa fa-envelope"></i> Compose New Message-->
                        <!--                                            </h4>-->
                        <!--                                            <button type="button" class="btn-close" data-bs-dismiss="modal"-->
                        <!--                                                    aria-label="Close"></button>-->
                        <!--                                        </div>-->
                        <!---->
                        <!--                                    </div>-->
                        <!--                                </div>-->
                        <!--                            </div>-->
                        <!--                        </div>-->

                        <!-- END COMPOSE MESSAGE -->

                    </div>
                </div>
            </div>
        </div>
        <!-- END INBOX -->
    </div>
    <!--    </div>-->
    <!--    </div>-->
    <!--    </div>-->
    <!--    </div>-->
</section>
<!--Messages End-->

<script>
    $(document).ready(function () {


        //     // show/hide actions on each message selected
        //     $(".message-check").change(function() {
        //         let anyChecked, count=0
        //
        //         //if any is checked, "anyChecked" equals to true
        //         $(".message-check").each(function() {
        //             if ($(this).is(":checked")) { anyChecked = true; count++; }
        //             if ($(this).checked === false) { anyChecked = false; count--; }
        //         });
        //
        //         //and shows the actions
        //         if (anyChecked === true) {
        //             $("#action-button").attr("hidden", false);
        //         } else { // else hides actions
        //             if(count === 0){ $('#all-none').prop("checked", false); }
        //             $("#action-button").attr("hidden", true);
        //         }
        //     });
        //
        //     // check/uncheck messages & show/hide actions
        //     $("#all-none").change(function() {
        //         if ($(this).is(":checked")) {
        //             $('.message-check').prop("checked", true);
        //             $("#action-button").attr("hidden", false);
        //         } else {
        //             $('.message-check').prop("checked", false);
        //             $("#action-button").attr("hidden", true);
        //         }
        //     });
        //

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
                                                    <a href="javascript:void();" id="<?php echo $message['fromUser'] ?>" class="icon reply"><i class="fa-solid fa-reply"></i></a>
                                                    <a href="#deleteMessageModal" id="<?php echo $message['id'] ?>" class="icon delete"
                                                       data-bs-toggle="modal" data-bs-target="#deleteMessageModal" title="Delete"><i class="fas fa-trash-alt"></i></a>
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

        // ajax to Add Message
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


    });
</script>