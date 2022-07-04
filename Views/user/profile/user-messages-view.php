<?php
/**
 * Created by PhpStorm.
 * User: V1p3r
 * Date: 17/10/2018
 * Time: 20:14
 */
?>
<?php if (!defined('ABSPATH')) exit; ?>

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
                            <!--                                    <button class="edit btn-success"-->
                            <!--                                       data-bs-toggle="modal" data-bs-target="#addMessageModal">-->
                            <!--                                        <i class="fa fa-pen"></i>&nbsp;&nbsp;NEW MESSAGE-->
                            <!--                                    </button>-->

                            <button class="btn edit btn-success" id="" data-toggle="modal"
                                    data-target="#compose-modal"  data-bs-toggle="modal"
                                    data-bs-target="#addMessageModal"
                            ><i class="fa fa-pen"></i>&nbsp;&nbsp;Nova Mensagem
                            </button>

                            <hr>

                            <div>
                                <ul class="nav flex-column nav-pills nav-stacked">
                                    <li class="header">Pastas</li>
<!--                                    <li class="nav-item --><?php //echo ($tabActive === "inbox") ? "active" : "" ?><!--">-->
                                        <a class="nav-link" href="<?php echo HOME_URL . '/home/userMessages/inbox' ?>">
                                            <i class="fa fa-inbox"></i> Caixa Entrada
                                        </a>
                                    </li>
<!--                                    <li class="nav-item --><?php //echo ($tabActive === "sent") ? "active" : "" ?><!--">-->
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
<!--                                    TODO erro do popper não abre o dropdown menu-->
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
                                    <a class="btn edit btn-success" href="<?php echo HOME_URL . '/home/usermessages/inbox'?>">
                                        <i class="fa fa-rotate-right"></i>
                                    </a>
                                </div>
                                <div class="col-md-6 search-form">
                                    <form action="#" class="text-right">
                                        <div class="input-group">
                                            <input type="text" class="form-control input-sm" placeholder="Search" required>
                                            <span class="input-group-btn">
                                            <button type="submit" name="search"
                                                    class="btn_ search-btn btn-sm search"><i class="fa fa-search"></i></button></span>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <br>

                            <div class="padding"></div>



                            <div class="table-responsive">
                            <table class="table table-bordered clamp">
                                <!--Define space between columns-->
                                <colgroup>
                                    <col span="1" style="width: 5%;">
                                    <col span="1" style="width: 20%;">
                                    <col span="1" style="width: 20%;">
                                    <col span="1" style="width: 20%;">
                                    <col span="1" style="width: 5%;">

                                </colgroup>
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

                                        <tr class="nav-item <?php echo ($message["receptionDate"] != null ) ? "read" : ""; ?>" role="presentation">
                                            <td class="message-id" id="<?php echo $message['id'] ?>" hidden></td>
                                            <td class="action">
                                                <input class="message-check" type="checkbox">
                                            </td>
                                            <td class="name">
                                                <?php echo $message["fromName"] ?>
                                            </td>
                                            <td class="subject">
                                                <a href="<?php echo HOME_URL . '/home/messages/' . $message["id"];?>">
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





<!--                            <div class="table-responsive">-->
<!--                                <table class="table">-->
<!--                                    <tbody>-->
<!--                                    --><?php //if (!empty($this->userdata['userMessageList'])) {
//                                    foreach ($this->userdata['userMessageList'] as $key => $message) { ?>
<!---->
<!--                                        <tr class="nav-item --><?php //echo ($message["receptionDate"] != null ) ? "read" : ""; ?><!--" role="presentation">-->
<!--                                            <td class="message-id" id="--><?php //echo $message['id'] ?><!--" hidden></td>-->
<!--                                            <td class="action">-->
<!--                                                <input class="message-check" type="checkbox">-->
<!--                                            </td>-->
<!--                                            <td class="name ">-->
<!--                                                De: --><?php //echo $message["fromName"] ?>
<!--                                            </td>-->
<!--                                            <td class="subject">-->
<!--                                                <a href="--><?php //echo HOME_URL . '/home/messages/' . $message["id"];?><!--">-->
<!--                                                    --><?php //echo $message["subject"]?>
<!--                                                </a>-->
<!--                                            </td>-->
<!--                                            <td class="time">--><?php //echo $message["notificationDate"] ?><!--</td>-->
<!--                                            <td>-->
<!--                                                --><?php //if ($message["receptionDate"] === null ) {?>
<!--                                                    <a href="javascript:void(0);" id="--><?php //echo $message['id'] ?><!--"-->
<!--                                                       class="message-read m-2" title="Mark as read"><i class="fa-solid fa-envelope-open"></i></a>-->
<!--                                                --><?php //} else {?>
<!--                                                    <a href="javascript:void(0);" id="--><?php //echo $message['id'] ?><!--"-->
<!--                                                       class="message-unread m-2" title="Mark as unread"><i class="fa-solid fa-envelope"></i></a>-->
<!--                                                --><?php //}?>
<!---->
<!--                                                <a href="#deleteMessageModal" id="--><?php //echo $message['id'] ?><!--" class="delete m-2"-->
<!--                                                   data-bs-toggle="modal" data-bs-target="#deleteMessageModal" title="Delete"><i class="fas fa-trash-alt"></i></a>-->
<!--                                            </td>-->
<!--                                        </tr>-->
<!---->
<!--                                    --><?php //}
//                                        } else { ?>
<!--                                        <tr>-->
<!--                                        </tr>-->
<!--                                    --><?php //} ?>
<!---->
<!--                                    </tbody>-->
<!--                                </table>-->
                            </div>

<!--                            <ul class="pagination">-->
<!--                                <li class="disabled"><a href="#">«</a></li>-->
<!--                                <li class="active"><a href="#">1</a></li>-->
<!--                                <li><a href="#">2</a></li>-->
<!--                                <li><a href="#">3</a></li>-->
<!--                                <li><a href="#">4</a></li>-->
<!--                                <li><a href="#">5</a></li>-->
<!--                                <li><a href="#">»</a></li>-->
<!--                            </ul>-->
                        </div>
                        <!-- END INBOX CONTENT -->

                        <!-- BEGIN COMPOSE MESSAGE -->
                        <div class="modal fade" id="compose-modal" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-wrapper">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg-blue">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                ×
                                            </button>
                                            <h4 class="modal-title"><i class="fa fa-envelope"></i> Compose New Message
                                            </h4>
                                        </div>
                                        <form action="#" method="post">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <input name="to" type="email" class="form-control" placeholder="Para">
                                                </div>
                                                <div class="form-group">
                                                    <input name="cc" type="email" class="form-control" placeholder="Cc">
                                                </div>
                                                <div class="form-group">
                                                    <input name="bcc" type="email" class="form-control"
                                                           placeholder="Bcc">
                                                </div>
                                                <div class="form-group">
                                                    <input name="subject" type="email" class="form-control"
                                                           placeholder="Subject">
                                                </div>
                                                <div class="form-group">
                                                    <textarea name="message" id="email_message" class="form-control"
                                                              placeholder="Message" style="height: 120px;"></textarea>
                                                </div>
                                                <div class="form-group"><input type="file" name="attachment">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal"><i
                                                            class="fa fa-times"></i> Discard
                                                </button>
                                                <button type="submit" class="btn btn-primary pull-right"><i
                                                            class="fa fa-envelope"></i> Send Message
                                                </button>
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
</section>
<!--Messages End-->