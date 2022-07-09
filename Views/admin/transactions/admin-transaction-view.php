
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
                <h1 class="mt-4">Gestão de <b>transações</b></h1>
                <div class="row">

                    <div class="col-xl-12 col-md-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <a href="#addTransactionModal" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addTransactionModal">
                                    <i class="fas fa-plus-circle"></i><span>Add New Transaction</span>
                                </a>
                            </div>
                            <div class="card-body">
                                <table id="transactionsTable" class="table table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>typeId</th>
                                        <th>methodId</th>
                                        <th>userId</th>
                                        <th>treeId</th>
                                        <th>value</th>
                                        <th>active
                                            <select id='GetActive'>
                                                <option value=''>All</option>
                                                <option value='1'>Active</option>
                                                <option value='0'>Inactive</option>
                                            </select>
                                        </th>
                                        <th>dateCreated</th>
                                        <th>dateModified</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if (!empty($this->userdata['transactionList'])) {
                                        foreach ($this->userdata['transactionList'] as $key => $transaction) { ?>
                                            <tr>
                                                <td><?php echo $transaction["id"] ?></td>
                                                <td><?php echo $transaction["typeId"] ?></td>
                                                <td><?php echo $transaction["methodId"] ?></td>
                                                <td><?php echo $transaction["userId"] ?></td>
                                                <td><?php echo $transaction["treeId"] ?></td>
                                                <td><?php echo $transaction["value"] ?></td>
                                                <td><?php echo $transaction["active"] ?></td>
                                                <td><?php echo $transaction["dateCreated"] ?></td>
                                                <td><?php echo $transaction["dateModified"] ?></td>
                                                <td>
                                                    <a href="#editTransactionModal" id="<?php echo $transaction['id'] ?>" class="edit"
                                                       data-bs-toggle="modal" data-bs-target="#editTransactionModal"><i class="far fa-edit"></i></a>
                                                    <a href="#deleteTransactionModal" id="<?php echo $transaction['id'] ?>" class="delete"
                                                       data-bs-toggle="modal" data-bs-target="#deleteTransactionModal"><i class="fas fa-trash-alt"></i></a>
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

                </div>
            </div>
        </main>




        <!-- Add Modal HTML -->
        <div id="addTransactionModal" class="modal fade" tabindex="-1" aria-labelledby="addTransactionModal-Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="addTransaction">
                        <div class="modal-header">
                            <h4 class="modal-title">Add Transaction</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>typeId</label>
                                <!--<input type="text" class="form-control" name="addTransactionTypeId" required>-->
                                <select class="form-select" name="addTransactionTypeId" id="addTransactionTypeId" required>
                                    <option value="" disabled selected >Tipo transação</option>
                                    <?php if (!empty($this->userdata['transactionTypeList'])) {
                                        foreach ($this->userdata['transactionTypeList'] as $key => $type) { ?>
                                            <option value="<?php echo $type['id'] ?>"><?php echo $type["name"] ?></option>
                                        <?php }
                                    } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>methodId</label>
                                <!--<input type="text" class="form-control" name="addTransactionMethodId" required>-->
                                <select class="form-select" name="addTransactionMethodId" id="addTransactionMethodId" required>
                                    <option value="" disabled selected>Método transação</option>
                                    <?php if (!empty($this->userdata['transactionMethodList'])) {
                                        foreach ($this->userdata['transactionMethodList'] as $key => $method) { ?>
                                            <option value="<?php echo $method['id'] ?>"><?php echo $method["name"] ?></option>
                                        <?php }
                                    } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>userId</label>
                                <!--<input type="text" class="form-control" name="addTransactionUserId" required> -->
                                <select class="form-select" name="addTransactionUserId" id="addTransactionUserId" required>
                                    <option value="" disabled selected>Utilizador</option>
                                    <?php if (!empty($this->userdata['usersList'])) {
                                        foreach ($this->userdata['usersList'] as $key => $user) { ?>
                                            <option value="<?php echo $user['id'] ?>"><?php echo $user["name"] ?></option>
                                        <?php }
                                    } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>treeId</label>
                                <input type="text" class="form-control" name="addTransactionTreeId" required>
                                <!--<select class="form-select" name="addTransactionTreeId" id="addTransactionTreeId" required>
                                    <option value="" disabled selected>Utilizador</option>
                                    <?php /*if (!empty($this->userdata['usersList'])) {
                                        foreach ($this->userdata['usersList'] as $key => $user) { ?>
                                            <option value="<?php echo $user['id'] ?>"><?php echo $user["name"] ?></option>
                                        <?php }
                                    } */?>
                                </select>-->
                            </div>
                            <div class="form-group">
                                <label>value</label>
                                <input type="number" class="form-control" name="addTransactionValue" required>
                            </div>
                            <!--<div class="form-group">
                                <label>Active</label>
                                <input type="checkbox" class="form-control form-check-input" name="addTransactionActive">
                            </div>-->
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
        <div id="editTransactionModal" class="modal fade" tabindex="-1" aria-labelledby="editTransactionModal-Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="editTransaction">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Transaction</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <input id="editTransactionId" name="editTransactionId" type="hidden" class="form-control" value="">
                            </div>

                            <div class="form-group">
                                <label>typeId</label>
                                <input type="text" class="form-control" name="editTransactionTypeId" required>
                            </div>
                            <div class="form-group">
                                <label>methodId</label>
                                <input type="text" class="form-control" name="editTransactionMethodId" required>
                            </div>
                            <div class="form-group">
                                <label>userId</label>
                                <input type="text" class="form-control" name="editTransactionUserId" required>
                            </div>
                            <div class="form-group">
                                <label>treeId</label>
                                <input type="text" class="form-control" name="editTransactionTreeId" required>
                            </div>
                            <div class="form-group">
                                <label>value</label>
                                <input type="number" class="form-control" name="editTransactionValue" required>
                            </div>
                            <!--<div class="form-group">
                                <label>Active</label>
                                <input type="checkbox" class="form-control form-check-input" name="editTransactionActive">
                            </div>-->

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
        <div id="deleteTransactionModal" class="modal fade" tabindex="-1" aria-labelledby="deleteTransactionModal-Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="deleteTransaction">
                        <div class="modal-header">
                            <h4 class="modal-title">Delete Transaction</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete this Transaction?</p>
                            <p class="text-warning"><small>This action cannot be undone.</small></p>
                            <input id="deleteTransactionId" name="deleteTransactionId" type="hidden" class="form-control" value="">
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
                try{
                    var table = $('#transactionsTable').DataTable({
                        rowReorder: false,
                        responsive: true,
                        columnDefs: [ {
                            targets: [6],
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
                }



                // ajax to Add Transaction
                $('#addTransaction').submit(function (event) {
                    event.preventDefault(); //prevent default action

                    let formData = {
                        'action': "AddTransaction",
                        'data': $(this).serializeArray()
                    };

                    $.ajax({
                        url: "<?php echo HOME_URL . '/admin/transaction';?>",
                        dataType: "json",
                        type: 'POST',
                        data: formData,
                        beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                            $('#loader').removeClass('hidden')
                        },
                        success: function (data) {
                            $("#addTransactionModal").modal('hide');

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

                // ajax to Edit Transaction
                $('#editTransaction').submit(function (event) {
                    event.preventDefault(); //prevent default action

                    //Ve se a data dos inputs mudou para formar so a data necessaria para o PATCH
                    /*let formDataChanged = [];
                    $('#editTransaction input').each(function() { //para cada input vai ver
                        if($(this).attr('name') === "editTransactionId" || ($(this).attr('name') === "editTransactionActive" && $(this).is(":checked")) || $(this).data('lastValue') !== $(this).val()) {//se a data anterior é diferente da current
                            let emptyArray = { name: "", value: "" };

                            emptyArray.name = $(this).attr('name');
                            emptyArray.value = $(this).val();

                            formDataChanged.push(emptyArray);
                        }
                    });

                    let formData = {
                        'action' : "UpdateTransaction",
                        'data'   : formDataChanged
                    };*/

                    let formData = {
                        'action': "UpdateTransaction",
                        'data': $(this).serializeArray()
                    };

                    $.ajax({
                        url : "<?php echo HOME_URL . '/admin/transaction';?>",
                        dataType: "json",
                        type: 'POST',
                        data : formData,
                        beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                            $('#loader').removeClass('hidden')
                        },
                        success: function (data) {
                            $("#editTransactionModal").modal('hide');

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

                // ajax to get data to Modal Edit Transaction
                $('.edit').on('click', function(){

                    let formData = {
                        'action' : "GetTransaction",
                        'data'   : $(this).attr('id') //gets transaction id from id="" attribute on edit button from table
                    };

                    $.ajax({
                        url : "<?php echo HOME_URL . '/admin/transaction';?>",
                        dataType: "json",
                        type: 'POST',
                        data : formData,
                        beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                            $('#loader').removeClass('hidden')
                        },
                        success: function (data) {

                            $('[name="editTransactionId"]').val(data[0]['id']);
                            $('[name="editTransactionName"]').val(data[0]['name']);
                            $('[name="editTransactionDescription"]').val(data[0]['description']);
                            $('[name="editTransactionSecurityId"]').val(data[0]['securityId']);

                            if (data[0]['active'] === 1) {
                                $('[name="editTransactionActive"]').attr('checked', true);
                            } else {
                                $('[name="editTransactionActive"]').attr('checked', false);
                            }

                            //atribui atributo .data("lastValue") a cada input do form editTransaction
                            // para se poder comparar entre os dados anteriores e os current
                            /*$('#editTransaction input').each(function() {
                                $(this).data('lastValue', $(this).val());
                            });*/

                            $("#editTransactionModal").modal('show');
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

                // ajax to Delete Transaction
                $('#deleteTransaction').submit(function(event){
                    event.preventDefault(); //prevent default action

                    let formData = {
                        'action' : "DeleteTransaction",
                        'data'   : $(this).serializeArray()
                    };

                    $.ajax({
                        url : "<?php echo HOME_URL . '/admin/transaction';?>",
                        dataType: "json",
                        type: 'POST',
                        data : formData,
                        beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                            $('#loader').removeClass('hidden')
                        },
                        success: function (data) {
                            $("#deleteTransactionModal").modal('hide');

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

                // ajax to get data to Modal Delete Transaction
                $('.delete').on('click', function(){
                    let $deleteID = $(this).attr('id');
                    $('[name="deleteTransactionId"]').val($deleteID); //gets transaction id from id="" attribute on delete button from table
                    $("#deleteTransactionModal").modal('show');

                });

            });
        </script>