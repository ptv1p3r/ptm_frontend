
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
                <h1 class="mt-4">Gestão de <b>método de transações</b></h1>
                <div class="row">

                    <div class="col-xl-12 col-md-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <a href="#addTransactionMethodModal" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addTransactionMethodModal">
                                    <i class="fas fa-plus-circle"></i><span> Novo método de transação</span>
                                </a>
                                <div class="float-end">
                                    <label>filtro:</label>
                                    <select id='GetActive'>
                                        <option value=''>Todos</option>
                                        <option value='1'>Ativos</option>
                                        <option value='0'>Inativos</option>
                                    </select>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="transactionMethodTable" class="table table-striped table-hover" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Descrição</th>
                                        <th hidden>active</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if (!empty($this->userdata['transactionMethodList'])) {
                                        foreach ($this->userdata['transactionMethodList'] as $key => $transactionMethod) { ?>
                                            <tr>
                                                <td><?php echo $transactionMethod["name"] ?></td>
                                                <td><?php echo $transactionMethod["description"] ?></td>
                                                <td hidden><?php echo $transactionMethod["active"] ?></td>
                                                <td>
                                                    <div class="float-end">
                                                        <a href="#editTransactionMethodModal" id="<?php echo $transactionMethod['id'] ?>" class="edit m-2"
                                                           data-bs-toggle="modal" data-bs-target="#editTransactionMethodModal"><i class="far fa-edit fa-lg"></i></a>
                                                        <a href="#deleteTransactionMethodModal" id="<?php echo $transactionMethod['id'] ?>" class="delete m-2"
                                                           data-bs-toggle="modal" data-bs-target="#deleteTransactionMethodModal"><i class="fas fa-trash-alt fa-lg"></i></a>
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
        <div id="addTransactionMethodModal" class="modal fade" tabindex="-1" aria-labelledby="addTransactionMethodModal-Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="addTransactionMethod">
                        <div class="modal-header">
                            <h4 class="modal-title">Adicionar método de transação</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Nome</label>
                                <input type="text" class="form-control" name="addTransactionMethodName" required>
                            </div>
                            <div class="form-group">
                                <label>Descrição</label>
                                <input type="text" class="form-control" name="addTransactionMethodDescription" required>
                            </div>
                            <div class="form-group form-check form-switch">
                                <label>Ativo</label>
                                <input type="checkbox" role="switch" class="form-check-input" name="addTransactionMethodActive">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <input type="submit" class="btn btn-success" value="Adicionar">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Edit Modal HTML -->
        <div id="editTransactionMethodModal" class="modal fade" tabindex="-1" aria-labelledby="editTransactionMethodModal-Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="editTransactionMethod">
                        <div class="modal-header">
                            <h4 class="modal-title">Editar método de transação</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <input id="editTransactionMethodId" name="editTransactionMethodId" type="hidden" class="form-control" value="">
                            </div>

                            <div class="form-group">
                                <label>Nome</label>
                                <input type="text" class="form-control" name="editTransactionMethodName" required>
                            </div>
                            <div class="form-group">
                                <label>Descrição</label>
                                <input type="text" class="form-control" name="editTransactionMethodDescription" required>
                            </div>
                            <div class="form-group form-check form-switch">
                                <label>Ativo</label>
                                <input type="checkbox" role="switch" class="form-check-input" name="editTransactionMethodActive">
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <input type="submit" class="btn btn-success" value="Guardar">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Delete Modal HTML -->
        <div id="deleteTransactionMethodModal" class="modal fade" tabindex="-1" aria-labelledby="deleteTransactionMethodModal-Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="deleteTransactionMethod">
                        <div class="modal-header">
                            <h4 class="modal-title">Apagar método de transação</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Tem a certeza que quer apagar este método de transação?</p>
                            <p class="text-warning"><small>A ação não pode ser defeita.</small></p>
                            <input id="deleteTransactionMethodId" name="deleteTransactionMethodId" type="hidden" class="form-control" value="">
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
                    var table = $('#transactionMethodTable').DataTable({
                        rowReorder: false,
                        responsive: false,
                        columnDefs: [ {
                            targets: [2,3],
                            orderable: false,
                        }],
                        oLanguage: {
                            "sUrl": "https://cdn.datatables.net/plug-ins/1.12.1/i18n/pt-PT.json"
                        }
                    });
                    //filtra table se ativo, inativo ou mostra todos
                    $('#GetActive').on('change', function() {
                        let selectedItem = $(this).children("option:selected").val();
                        table.columns(2).search(selectedItem).draw();
                    })
                } catch (error) {
                    console.log(error);
                }



                // ajax to Add TransactionMethod
                $('#addTransactionMethod').submit(function (event) {
                    event.preventDefault(); //prevent default action

                    let formData = {
                        'action': "AddTransactionMethod",
                        'data': $(this).serializeArray()
                    };

                    $.ajax({
                        url: "<?php echo HOME_URL . '/admin/transaction_method';?>",
                        dataType: "json",
                        type: 'POST',
                        data: formData,
                        beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                            $('#loader').removeClass('hidden')
                        },
                        success: function (data) {
                            $("#addTransactionMethodModal").modal('hide');

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

                // ajax to Edit TransactionMethod
                $('#editTransactionMethod').submit(function (event) {
                    event.preventDefault(); //prevent default action

                    //Ve se a data dos inputs mudou para formar so a data necessaria para o PATCH
                    /*let formDataChanged = [];
                    $('#editTransactionMethod input').each(function() { //para cada input vai ver
                        if($(this).attr('name') === "editTransactionMethodId" || ($(this).attr('name') === "editTransactionMethodActive" && $(this).is(":checked")) || $(this).data('lastValue') !== $(this).val()) {//se a data anterior é diferente da current
                            let emptyArray = { name: "", value: "" };

                            emptyArray.name = $(this).attr('name');
                            emptyArray.value = $(this).val();

                            formDataChanged.push(emptyArray);
                        }
                    });

                    let formData = {
                        'action' : "UpdateTransactionMethod",
                        'data'   : formDataChanged
                    };*/

                    let formData = {
                        'action': "UpdateTransactionMethod",
                        'data': $(this).serializeArray()
                    };

                    $.ajax({
                        url : "<?php echo HOME_URL . '/admin/transaction_method';?>",
                        dataType: "json",
                        type: 'POST',
                        data : formData,
                        beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                            $('#loader').removeClass('hidden')
                        },
                        success: function (data) {
                            $("#editTransactionMethodModal").modal('hide');

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

                // ajax to get data to Modal Edit TransactionMethod
                $('.edit').on('click', function(){

                    let formData = {
                        'action' : "GetTransactionMethod",
                        'data'   : $(this).attr('id') //gets transaction method id from id="" attribute on edit button from table
                    };

                    $.ajax({
                        url : "<?php echo HOME_URL . '/admin/transaction_method';?>",
                        dataType: "json",
                        type: 'POST',
                        data : formData,
                        beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                            $('#loader').removeClass('hidden')
                        },
                        success: function (data) {

                            $('[name="editTransactionMethodId"]').val(data[0]['id']);
                            $('[name="editTransactionMethodName"]').val(data[0]['name']);
                            $('[name="editTransactionMethodDescription"]').val(data[0]['description']);

                            if (data[0]['active'] === 1) {
                                $('[name="editTransactionMethodActive"]').attr('checked', true);
                            } else {
                                $('[name="editTransactionMethodActive"]').attr('checked', false);
                            }

                            //atribui atributo .data("lastValue") a cada input do form editTransactionMethod
                            // para se poder comparar entre os dados anteriores e os current
                            /*$('#editTransactionMethod input').each(function() {
                                $(this).data('lastValue', $(this).val());
                            });*/

                            $("#editTransactionMethodModal").modal('show');
                        },
                        error: function (data) {
                            Swal.fire({
                                title: 'Erro!',
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

                // ajax to Delete TransactionMethod
                $('#deleteTransactionMethod').submit(function(event){
                    event.preventDefault(); //prevent default action

                    let formData = {
                        'action' : "DeleteTransactionMethod",
                        'data'   : $(this).serializeArray()
                    };

                    $.ajax({
                        url : "<?php echo HOME_URL . '/admin/transaction_method';?>",
                        dataType: "json",
                        type: 'POST',
                        data : formData,
                        beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                            $('#loader').removeClass('hidden')
                        },
                        success: function (data) {
                            $("#deleteTransactionMethodModal").modal('hide');

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

                // ajax to get data to Modal Delete TransactionMethod
                $('.delete').on('click', function(){
                    let $deleteID = $(this).attr('id');
                    $('[name="deleteTransactionMethodId"]').val($deleteID); //gets transaction method id from id="" attribute on delete button from table
                    $("#deleteTransactionMethodModal").modal('show');

                });

            });
        </script>