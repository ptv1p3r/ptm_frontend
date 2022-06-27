
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

                        all messages

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