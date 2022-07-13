
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
                <h1 class="mt-4">Gestão de <b>tipos de transações</b></h1>
                <div class="row">

                    <div class="col-xl-12 col-md-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <a href="#addTransactionTypeModal" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addTransactionTypeModal">
                                    <i class="fas fa-plus-circle"></i><span> Novo tipo de transação</span>
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
                                <div class="table-responsive">
                                    <table id="transactionTypeTable" class="table table-striped table-hover" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Descrição</th>
                                            <th hidden>active</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php if (!empty($this->userdata['transactionTypeList'])) {
                                            foreach ($this->userdata['transactionTypeList'] as $key => $transactionType) { ?>
                                                <tr>
                                                    <td><?php echo $transactionType["name"] ?></td>
                                                    <td><?php echo $transactionType["description"] ?></td>
                                                    <td hidden><?php echo $transactionType["active"] ?></td>
                                                    <td>
                                                        <div class="float-end">
                                                            <a href="#editTransactionTypeModal" id="<?php echo $transactionType['id'] ?>" class="edit m-2"
                                                               data-bs-toggle="modal" data-bs-target="#editTransactionTypeModal"><i class="far fa-edit fa-lg"></i></a>
                                                            <a href="#deleteTransactionTypeModal" id="<?php echo $transactionType['id'] ?>" class="delete m-2"
                                                               data-bs-toggle="modal" data-bs-target="#deleteTransactionTypeModal"><i class="fas fa-trash-alt fa-lg"></i></a>
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
            </div>
        </main>




        <!-- Add Modal HTML -->
        <div id="addTransactionTypeModal" class="modal fade" tabindex="-1" aria-labelledby="addTransactionTypeModal-Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="addTransactionType">
                        <div class="modal-header">
                            <h4 class="modal-title">Adicionar tipo de transação</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Nome</label>
                                <input type="text" class="form-control" name="addTransactionTypeName" required>
                            </div>
                            <div class="form-group">
                                <label>Descrição</label>
                                <input type="text" class="form-control" name="addTransactionTypeDescription" required>
                            </div>
                            <div class="form-group form-check form-switch">
                                <label>Ativo</label>
                                <input type="checkbox" role="switch" class="form-check-input" name="addTransactionTypeActive">
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
        <div id="editTransactionTypeModal" class="modal fade" tabindex="-1" aria-labelledby="editTransactionTypeModal-Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="editTransactionType">
                        <div class="modal-header">
                            <h4 class="modal-title">Editar tipo de transação</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <input id="editTransactionTypeId" name="editTransactionTypeId" type="hidden" class="form-control" value="">
                            </div>

                            <div class="form-group">
                                <label>Nome</label>
                                <input type="text" class="form-control" name="editTransactionTypeName" required>
                            </div>
                            <div class="form-group">
                                <label>Descrição</label>
                                <input type="text" class="form-control" name="editTransactionTypeDescription" required>
                            </div>
                            <div class="form-group form-check form-switch">
                                <label>Ativo</label>
                                <input type="checkbox" role="switch" class="form-check-input" name="editTransactionTypeActive">
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
        <div id="deleteTransactionTypeModal" class="modal fade" tabindex="-1" aria-labelledby="deleteTransactionTypeModal-Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="deleteTransactionType">
                        <div class="modal-header">
                            <h4 class="modal-title">Apagar tipo de transação</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Tem a certeza que quer apagar este tipo de transação?</p>
                            <p class="text-warning"><small>A ação não pode ser defeita.</small></p>
                            <input id="deleteTransactionTypeId" name="deleteTransactionTypeId" type="hidden" class="form-control" value="">
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
                    var table = $('#transactionTypeTable').DataTable({
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



                // ajax to Add TransactionType
                $('#addTransactionType').submit(function (event) {
                    event.preventDefault(); //prevent default action

                    let formData = {
                        'action': "AddTransactionType",
                        'data': $(this).serializeArray()
                    };

                    $.ajax({
                        url: "<?php echo HOME_URL . '/admin/transaction_type';?>",
                        dataType: "json",
                        type: 'POST',
                        data: formData,
                        beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                            $('#loader').removeClass('hidden')
                        },
                        success: function (data) {
                            $("#addTransactionTypeModal").modal('hide');

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

                // ajax to Edit TransactionType
                $('#editTransactionType').submit(function (event) {
                    event.preventDefault(); //prevent default action

                    //Ve se a data dos inputs mudou para formar so a data necessaria para o PATCH
                    /*let formDataChanged = [];
                    $('#editTransactionType input').each(function() { //para cada input vai ver
                        if($(this).attr('name') === "editTransactionTypeId" || ($(this).attr('name') === "editTransactionTypeActive" && $(this).is(":checked")) || $(this).data('lastValue') !== $(this).val()) {//se a data anterior é diferente da current
                            let emptyArray = { name: "", value: "" };

                            emptyArray.name = $(this).attr('name');
                            emptyArray.value = $(this).val();

                            formDataChanged.push(emptyArray);
                        }
                    });

                    let formData = {
                        'action' : "UpdateTransactionType",
                        'data'   : formDataChanged
                    };*/

                    let formData = {
                        'action': "UpdateTransactionType",
                        'data': $(this).serializeArray()
                    };

                    $.ajax({
                        url : "<?php echo HOME_URL . '/admin/transaction_type';?>",
                        dataType: "json",
                        type: 'POST',
                        data : formData,
                        beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                            $('#loader').removeClass('hidden')
                        },
                        success: function (data) {
                            $("#editTransactionTypeModal").modal('hide');

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

                // ajax to get data to Modal Edit TransactionType
                $('.edit').on('click', function(){

                    let formData = {
                        'action' : "GetTransactionType",
                        'data'   : $(this).attr('id') //gets transactiontype id from id="" attribute on edit button from table
                    };

                    $.ajax({
                        url : "<?php echo HOME_URL . '/admin/transaction_type';?>",
                        dataType: "json",
                        type: 'POST',
                        data : formData,
                        beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                            $('#loader').removeClass('hidden')
                        },
                        success: function (data) {

                            $('[name="editTransactionTypeId"]').val(data[0]['id']);
                            $('[name="editTransactionTypeName"]').val(data[0]['name']);
                            $('[name="editTransactionTypeDescription"]').val(data[0]['description']);

                            if (data[0]['active'] === 1) {
                                $('[name="editTransactionTypeActive"]').attr('checked', true);
                            } else {
                                $('[name="editTransactionTypeActive"]').attr('checked', false);
                            }

                            //atribui atributo .data("lastValue") a cada input do form editTransactionType
                            // para se poder comparar entre os dados anteriores e os current
                            /*$('#editTransactionType input').each(function() {
                                $(this).data('lastValue', $(this).val());
                            });*/

                            $("#editTransactionTypeModal").modal('show');
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

                // ajax to Delete TransactionType
                $('#deleteTransactionType').submit(function(event){
                    event.preventDefault(); //prevent default action

                    let formData = {
                        'action' : "DeleteTransactionType",
                        'data'   : $(this).serializeArray()
                    };

                    $.ajax({
                        url : "<?php echo HOME_URL . '/admin/transaction_type';?>",
                        dataType: "json",
                        type: 'POST',
                        data : formData,
                        beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                            $('#loader').removeClass('hidden')
                        },
                        success: function (data) {
                            $("#deleteTransactionTypeModal").modal('hide');

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

                // ajax to get data to Modal Delete TransactionType
                $('.delete').on('click', function(){
                    let $deleteID = $(this).attr('id');
                    $('[name="deleteTransactionTypeId"]').val($deleteID); //gets transactiontype id from id="" attribute on delete button from table
                    $("#deleteTransactionTypeModal").modal('show');

                });

            });
        </script>