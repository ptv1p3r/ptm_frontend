
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
                                                    <!-- MAIL READ -->
                                                    <div class="col-lg-9 email-content">
                                                        <div class="email-head">
                                                            <div class="email-head-subject">
                                                                <div class="title d-flex align-items-center justify-content-between">
                                                                    <div class="d-flex align-items-center">
                                                                        <a class="active" href="#"><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star text-primary-muted"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg></span></a>
                                                                        <span>New Project</span>
                                                                    </div>
                                                                    <div class="icons">
                                                                        <a href="#" class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-share text-muted hover-primary-muted" data-toggle="tooltip" title="" data-original-title="Forward"><path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8"></path><polyline points="16 6 12 2 8 6"></polyline><line x1="12" y1="2" x2="12" y2="15"></line></svg></a>
                                                                        <a href="#" class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer text-muted" data-toggle="tooltip" title="" data-original-title="Print"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg></a>
                                                                        <a href="#" class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash text-muted" data-toggle="tooltip" title="" data-original-title="Delete"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="email-head-sender d-flex align-items-center justify-content-between flex-wrap">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="avatar">
                                                                        <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="Avatar" class="rounded-circle user-avatar-md">
                                                                    </div>
                                                                    <div class="sender d-flex align-items-center">
                                                                        <a href="#">John Doe</a> <span>to</span><a href="#">me</a>
                                                                        <div class="actions dropdown">
                                                                            <a class="icon" href="#" data-toggle="dropdown"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg></a>
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
                                                                <div class="date">Nov 20, 11:20</div>
                                                            </div>
                                                        </div>
                                                        <div class="email-body">
                                                            <p>Hello,</p>
                                                            <br>
                                                            <p>Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna.</p>
                                                            <br>
                                                            <p><strong>Regards</strong>,<br> John Doe</p>
                                                        </div>
                                                        <div class="email-attachments">
                                                            <!--<div class="title">Attachments <span>(3 files, 12,44 KB)</span></div>
                                                            <ul>
                                                                <li><a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg> Reference.zip <span class="text-muted tx-11">(5.10 MB)</span></a></li>
                                                                <li><a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg> Instructions.zip <span class="text-muted tx-11">(3.15 MB)</span></a></li>
                                                                <li><a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg> Team-list.pdf <span class="text-muted tx-11">(4.5 MB)</span></a></li>
                                                            </ul>-->
                                                        </div>
                                                    </div> <!-- END MAIL READ -->

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

            });
        </script>