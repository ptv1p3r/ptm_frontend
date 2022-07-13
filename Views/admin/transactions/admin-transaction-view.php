
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
                                    <i class="fas fa-plus-circle"></i><span> Nova transação</span>
                                </a>
                                <!--<div class="float-end">
                                    <label>filtro:</label>
                                    <select id='GetActive'>
                                        <option value=''>Todos</option>
                                        <option value='1'>Ativos</option>
                                        <option value='0'>Inativos</option>
                                    </select>
                                </div>-->
                            </div>
                            <div class="card-body">
                                <table id="transactionsTable" class="table table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th>Identificador</th>
                                        <th>Tipo</th>
                                        <th>Método</th>
                                        <th>Utilizador</th>
                                        <th>Árvore</th>
                                        <th>Valor</th>
                                        <!--<th>active</th>-->
                                        <th>Data criado</th>
                                        <th>Data atualizado</th>
                                        <th>Data validado</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if (!empty($this->userdata['transactionList'])) {
                                        foreach ($this->userdata['transactionList'] as $key => $transaction) { ?>
                                            <tr>
                                                <td><?php echo $transaction["id"] ?></td>
                                                <td><?php
                                                    if (!empty($this->userdata['transactionTypeList'])) {
                                                        foreach ($this->userdata['transactionTypeList'] as $key => $type) {
                                                            if ( $type["id"] == $transaction["transactionTypeId"]){
                                                                echo $type["name"];
                                                            }
                                                        }
                                                    }?>
                                                </td>
                                                <td><?php
                                                    if (!empty($this->userdata['transactionMethodList'])) {
                                                        foreach ($this->userdata['transactionMethodList'] as $key => $method) {
                                                            if ( $method["id"] == $transaction["transactionMethodId"]){
                                                                echo $method["name"];
                                                            }
                                                        }
                                                    }?>
                                                </td>
                                                <td><?php echo $transaction["userId"] ?></td>
                                                <td><?php echo $transaction["treeId"] ?></td>
                                                <td><?php echo $transaction["value"] ?></td>
                                                <!--<td><?php //echo $transaction["active"] ?></td>-->
                                                <td><?php echo $transaction["dateCreated"] ?></td>
                                                <td><?php echo $transaction["dateModified"] ?></td>
                                                <td><?php echo $transaction["dateValidated"] ?></td>
                                                <td>
                                                    <div class="float-end">
                                                        <a href="#deleteTransactionModal" id="<?php echo $transaction['id'] ?>" class="delete m-2"
                                                           data-bs-toggle="modal" data-bs-target="#deleteTransactionModal"><i class="fas fa-trash-alt fa-lg"></i></a>
                                                    </div>
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
                            <h4 class="modal-title">Realizar transação</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Tipo</label>
                                <!--<input type="text" class="form-control" name="addTransactionTypeId" required>-->
                                <select name="addTransactionTypeId" id="addTransactionTypeId" required>
                                    <option value="" disabled selected >Tipo transação</option>
                                    <?php if (!empty($this->userdata['transactionTypeList'])) {
                                        foreach ($this->userdata['transactionTypeList'] as $key => $type) { ?>
                                            <option value="<?php echo $type['id'] ?>"><?php echo $type["name"] ?></option>
                                        <?php }
                                    } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Método</label>
                                <!--<input type="text" class="form-control" name="addTransactionMethodId" required>-->
                                <select name="addTransactionMethodId" id="addTransactionMethodId" required>
                                    <option value="" disabled selected>Método transação</option>
                                    <?php if (!empty($this->userdata['transactionMethodList'])) {
                                        foreach ($this->userdata['transactionMethodList'] as $key => $method) { ?>
                                            <option value="<?php echo $method['id'] ?>"><?php echo $method["name"] ?></option>
                                        <?php }
                                    } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Utilizador</label>
                                <!--<input type="text" class="form-control" name="addTransactionUserId" required> -->
                                <select name="addTransactionUserId" id="addTransactionUserId" required>
                                    <option value="" disabled selected>Utilizador</option>
                                    <?php if (!empty($this->userdata['usersList'])) {
                                        foreach ($this->userdata['usersList'] as $key => $user) { ?>
                                            <option value="<?php echo $user['id'] ?>"><?php echo $user["name"] ?></option>
                                        <?php }
                                    } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Árvore</label>
                                <!--<input type="text" class="form-control" name="addTransactionTreeId" required>-->
                                <select name="addTransactionTreeId" id="addTransactionTreeId" required>
                                    <option value="" disabled selected>Árvore a adotar</option>
                                    <?php if (!empty($this->userdata['treesList'])) {
                                        foreach ($this->userdata['treesList'] as $key => $tree) { ?>
                                            <option value="<?php echo $tree['id'] ?>"><?php echo $tree["id"] ?></option>
                                        <?php }
                                    } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Valor</label>
                                <input type="number" min="2.50" step="0.05" class="form-control" name="addTransactionValue" required>
                            </div>
                            <!--<div class="form-group">
                                <label>Active</label>
                                <input type="checkbox" class="form-control form-check-input" name="addTransactionActive">
                            </div>-->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <input type="submit" class="btn btn-success" value="Concluir">
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
                            <h4 class="modal-title">Apagar transação</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Tem a certeza que quer apagar esta transação?</p>
                            <p class="text-warning"><small>A ação não pode ser defeita.</small></p>
                            <input id="deleteTransactionId" name="deleteTransactionId" type="hidden" class="form-control" value="">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <input type="submit" class="btn btn-danger" value="Apagar">
                        </div>
                    </form>
                </div>
            </div>
        </div>



        <script>
            $(document).ready(function() {
                //DATATABLES
                //Configura a dataTable
                try{
                    var table = $('#transactionsTable').DataTable({
                        rowReorder: false,
                        responsive: true,
                        columnDefs: [ {
                            targets: [9],
                            orderable: false,
                        }],
                        oLanguage: {
                            "sUrl": "https://cdn.datatables.net/plug-ins/1.12.1/i18n/pt-PT.json"
                        }
                    });
                    //filtra table se ativo, inativo ou mostra todos
                    $('#GetActive').on('change', function() {
                        let selectedItem = $(this).children("option:selected").val();
                        table.columns(3).search(selectedItem).draw();
                    })
                } catch (error) {
                    console.log(error);
                }

                // make select have input to seach for option
                $('#addTransactionModal select').selectize({ sortField: 'text' });

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
                                    title: 'Sucesso!',
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
                                text: "Erro de conexão, por favor tente denovo.",
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
                                    title: 'Sucesso!',
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
                                text: "Erro de conexão, por favor tente denovo.",
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