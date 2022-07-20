
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
                <h1 class="mt-4">Gestão de <b>imagens</b></h1>
                <div class="row">

                    <div class="col-xl-12 col-md-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <a href="#addTreeImageModal" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addTreeImageModal">
                                    <i class="fas fa-plus-circle"></i><span> Nova imagem</span>
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
                                <div class="table-responsive">
                                    <table id="treeImagesTable" class="table table-striped table-hover" style="width: 100%">
                                        <thead>
                                        <tr>
                                            <!--<th>id</th>-->
                                            <th>Árvore</th>
                                            <!--<th>name</th>-->
                                            <th>Imagem</th>
                                            <th>Descrição</th>
                                            <th>Tamanho</th>
                                            <th>Posição</th>
                                            <th>Data Criação</th>
                                            <th>Data Modificação</th>
                                            <!--<th>active</th>-->
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php if (!empty($this->userdata['treeImageList'])) {
                                            foreach ($this->userdata['treeImageList'] as $key => $treeImage) {?>
                                                <tr>
                                                    <!--<td><?php //echo $treeImage["id"] ?></td>-->
                                                    <td id="jvth8gy9u7-<?php echo $treeImage["id"] ?>"
                                                        onclick="copy('<?php echo $treeImage["treeId"] ?>','jvth8gy9u7-<?php echo $treeImage["id"] ?>')"
                                                        title="<?php echo $treeImage["treeId"] ?>"
                                                        class="table-text-truncate"
                                                        style="cursor: pointer">
                                                        <?php echo $treeImage["treeId"] ?>
                                                    </td>
                                                    <!--<td><?php //echo $treeImage["name"] ?></td>-->
                                                    <td>
                                                        <img class="img-thumbnail" src="<?php echo API_URL . 'api/v1/trees/image/' . $treeImage["path"] ?>" width="90" height="90" style="cursor: zoom-in" title="Abrir imagem completa numa nova pagina" onclick="window.open(this.src, '_blank');">
                                                    </td>
                                                    <td id="hdxii4fd16-<?php echo $treeImage["id"] ?>"
                                                        onclick="copy('<?php echo $treeImage["description"] ?>','hdxii4fd16-<?php echo $treeImage["id"] ?>')"
                                                        title="<?php echo $treeImage["description"] ?>"
                                                        class="table-text-truncate"
                                                        style="cursor: pointer">
                                                        <?php echo $treeImage["description"] ?>
                                                    </td>
                                                    <?php $SizeFormated = formatBytes($treeImage["size"]) ?>
                                                    <td id="7denshrki4-<?php echo $treeImage["id"] ?>"
                                                        onclick="copy('<?php echo $SizeFormated ?>','7denshrki4-<?php echo $treeImage["id"] ?>')"
                                                        title="<?php echo $SizeFormated ?>"
                                                        class="table-text-truncate"
                                                        style="cursor: pointer">
                                                        <?php echo $SizeFormated ?>
                                                    </td>
                                                    <td id="kgx7tiz1hd-<?php echo $treeImage["id"] ?>"
                                                        onclick="copy('<?php echo $treeImage["position"] ?>','kgx7tiz1hd-<?php echo $treeImage["id"] ?>')"
                                                        title="<?php echo $treeImage["position"] ?>"
                                                        class="table-text-truncate"
                                                        style="cursor: pointer">
                                                        <?php echo $treeImage["position"] ?>
                                                    </td>
                                                    <!--<td hidden><?php //echo $treeImage["active"] ?></td>-->
                                                    <td id="jnt4s4e5dc-<?php echo $treeImage["id"] ?>"
                                                        onclick="copy('<?php echo $treeImage["dateCreated"] ?>','jnt4s4e5dc-<?php echo $treeImage["id"] ?>')"
                                                        title="<?php echo $treeImage["dateCreated"] ?>"
                                                        class="table-text-truncate"
                                                        style="cursor: pointer">
                                                        <?php echo $treeImage["dateCreated"] ?>
                                                    </td>
                                                    <td id="jnt4s4e5dc-<?php echo $treeImage["id"] ?>"
                                                        onclick="copy('<?php echo $treeImage["dateModified"] ?>','jnt4s4e5dc-<?php echo $treeImage["id"] ?>')"
                                                        title="<?php echo $treeImage["dateModified"] ?>"
                                                        class="table-text-truncate"
                                                        style="cursor: pointer">
                                                        <?php echo $treeImage["dateModified"] ?>
                                                    </td>
                                                    <td>
                                                        <div class="float-end">
                                                            <!--<a href="#editTreeImageModal" id="<?php //echo $treeImage['id'] ?>" data-ImagePath="<?php //echo $treeImage['path'] ?>" class="edit" data-bs-toggle="modal" data-bs-target="#editTreeModal"><i class="far fa-edit"></i></a>-->
                                                            <a href="#deleteTreeImageModal" id="<?php echo $treeImage['id'] ?>" data-ImagePath="<?php echo $treeImage['path'] ?>" class="delete m-2"
                                                               data-bs-toggle="modal" data-bs-target="#deleteTreeModal"><i class="fas fa-trash-alt fa-lg"></i></a>
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


        <!-- MODALS -->
        <!-- Add Modal HTML -->
        <div id="addTreeImageModal" class="modal fade" tabindex="-1" aria-labelledby="addTreeImageModal-Label" aria-hidden="true">
            <div class="modal-dialog"> <!--modal-xl-->
                <div class="modal-content">
                    <form id="addTreeImage" enctype="multipart/form-data" method="post">
                        <div class="modal-header">
                            <h4 class="modal-title">Adicionar imagem</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <div class="form-group">
                                <label>Árvore</label>
                                <input type="text" class="form-control" name="addTreeImageTreeId" required>
                            </div>
                            <div class="form-group">
                                <label>Ordem de imagem</label>
                                <input type="text" class="form-control" name="addTreeImageOrder" required>
                            </div>
                            <div class="form-group">
                                <label>Descrição</label>
                                <input type="text" class="form-control" name="addTreeImageDescription" required>
                            </div>
                            <div class="form-group">
                                <label>Imagem</label>
                                <input id="file" type="file" class="form-control" name="file">
                                <!--<img id='img-upload' class="img-thumbnail"/>-->
                            </div>
                            <!-- <div class="form-group">
                                 <label>Active</label>
                                 <input type="checkbox" class="form-control form-check-input" name="addTreeImageActive">
                             </div>-->

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
        <!--<div id="editTreeImageModal" class="modal fade" tabindex="-1" aria-labelledby="editTreeImageModal-Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="editTreeImage">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Tree</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <input id="editTreeImageId" name="editTreeImageId" type="hidden" class="form-control" value="">
                            </div>

                            <div class="form-group">
                                <label>treeId</label>
                                <input type="text" class="form-control" name="editTreeImageTreeId" required>
                            </div>
                            <div class="form-group">
                                <label>order</label>
                                <input type="text" class="form-control" name="editTreeImageOrder" required>
                            </div>
                            <div class="form-group">
                                <label>description</label>
                                <input type="text" class="form-control" name="editTreeImageDescription" required>
                            </div>
                            <div class="form-group">
                                <label>Image</label>
                                <input id="file" type="file" class="form-control" name="file">
                                <img id='img-upload' class="img-thumbnail"/>
                            </div>
                            <div class="form-group">
                                <label>Active</label>
                                <input type="checkbox" class="form-control form-check-input" name="editTreeImageActive">
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <input type="submit" class="btn btn-success" value="Save">
                        </div>
                    </form>
                </div>
            </div>
        </div>-->

        <!-- Delete Modal HTML -->
        <div id="deleteTreeImageModal" class="modal fade" tabindex="-1" aria-labelledby="deleteTreeImageModal-Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="deleteTreeImage">
                        <div class="modal-header">
                            <h4 class="modal-title">Apagar imagem</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Tem a certeza que quer apagar esta imagem?</p>
                            <p class="text-warning"><small>A ação não pode ser defeita.</small></p>
                            <input id="deleteTreeImageId" name="deleteTreeImageId" type="hidden" class="form-control" value="">
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
                    var table = $('#treeImagesTable').DataTable({
                        rowReorder: false,
                        responsive: false,
                        columnDefs: [ {
                            targets: [7],
                            orderable: false,
                        }],
                        oLanguage: {
                            "sUrl": "https://cdn.datatables.net/plug-ins/1.12.1/i18n/pt-PT.json"
                        }
                    });
                    //filtra table se ativo, inativo ou mostra todos
                    /*$('#GetActive').on('change', function() {
                        let selectedItem = $(this).children("option:selected").val();
                        table.columns(7).search(selectedItem).draw();
                    })*/
                } catch (error){
                    console.log(error);
                }



                //CRUD
                // ajax to Add
                $('#addTreeImage').submit(function (event) {
                    event.preventDefault(); //prevent default action

                    let formData = new FormData();
                    let file_data = $("#file").prop('files'); //get all files

                    // append file
                    for(let i = 0; i < file_data.length; i++) {
                        formData.append(i, file_data[i]);
                    }

                    // append form inputs
                    let other_data = $(this).serializeArray();
                    $.each(other_data,function(key,input) {
                        formData.append('data[' + input.name + ']', input.value);
                    });

                    // append form action
                    formData.append("action", "AddTreeImage");


                    $.ajax({
                        url: "<?php echo HOME_URL . '/admin/tree_images';?>",
                        dataType: "json",
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                            $('#loader').removeClass('hidden')
                        },
                        success: function (data) {
                            $("#addTreeImageModal").modal('hide');

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


                // ajax to Delete Tree
                $('#deleteTreeImage').submit(function(event){
                    event.preventDefault(); //prevent default action

                    let formData = {
                        'action' : "DeleteTreeImage",
                        'data'   : $(this).serializeArray()
                    };

                    $.ajax({
                        url : "<?php echo HOME_URL . '/admin/tree_images';?>",
                        dataType: "json",
                        type: 'POST',
                        data : formData,
                        beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                            $('#loader').removeClass('hidden')
                        },
                        success: function (data) {
                            $("#deleteTreeModal").modal('hide');

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

                // ajax to get data to Modal Delete Tree
                $('.delete').on('click', function(){
                    let $deleteID = $(this).attr('id');
                    $('[name="deleteTreeImageId"]').val($deleteID); //gets tree id from id="" attribute on delete button from table
                    $("#deleteTreeImageModal").modal('show');

                });

            });
        </script>