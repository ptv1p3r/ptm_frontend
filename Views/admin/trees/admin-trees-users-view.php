
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
                <h1 class="mt-4">Gestão de <b>adoções</b></h1>
                <div class="row">

                    <!--<div class="col-xl-12 col-md-12 mb-4">
                        Map area div
                        <div id="map"></div>
                    </div>-->

                    <div class="col-xl-12 col-md-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <a href="#addTreeUserModal" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addTreeUserModal">
                                    <i class="fas fa-plus-circle"></i><span> Nova adoção</span>
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
                                    <table id="treesUsersTable" class="table table-striped table-hover" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th>Utilizador</th>
                                            <th>Árvore</th>
                                            <th>Data Criação</th>
                                            <th hidden>active</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php if (!empty($this->userdata['treesUserList'])) {
                                            foreach ($this->userdata['treesUserList'] as $key => $treeUser) { ?>
                                                <tr>
                                                    <td id="sl5zgkcdb9-<?php echo $treeUser["userId"] ?>"
                                                        onclick="copy('<?php echo $treeUser["userId"] ?>','sl5zgkcdb9-<?php echo $treeUser["userId"] ?>')"
                                                        title="<?php echo $treeUser["userId"] ?>"
                                                        class="table-text-truncate"
                                                        style="cursor: pointer">
                                                        <?php echo $treeUser["userId"] ?>
                                                    </td>
                                                    <td id="l0r17qzb1u-<?php echo $treeUser["treeId"] ?>"
                                                        onclick="copy('<?php echo $treeUser["treeId"] ?>','l0r17qzb1u-<?php echo $treeUser["treeId"] ?>')"
                                                        title="<?php echo $treeUser["treeId"] ?>"
                                                        class="table-text-truncate"
                                                        style="cursor: pointer">
                                                        <?php echo $treeUser["treeId"] ?>
                                                    </td>
                                                    <td id="fsdwr45nss-<?php echo $treeUser["treeId"] ?>"
                                                        onclick="copy('<?php echo $treeUser["dateCreated"] ?>','fsdwr45nss-<?php echo $treeUser["treeId"] ?>')"
                                                        title="<?php echo $treeUser["dateCreated"] ?>"
                                                        class="table-text-truncate"
                                                        style="cursor: pointer">
                                                        <?php echo $treeUser["dateCreated"] ?>
                                                    </td>
                                                    <td hidden><?php echo $treeUser["active"] ?></td>
                                                    <td>
                                                        <div class="float-end">
                                                            <a href="#editTreeUserModal" id="" class="edit m-2" data-treeUser-treeId="<?php echo $treeUser['treeId'] ?>" data-treeUser-userId="<?php echo $treeUser['userId'] ?>"
                                                               data-bs-toggle="modal" data-bs-target="#editTreeUserModal"><i class="far fa-edit fa-lg"></i></a>
                                                            <a href="#deleteTreeUserModal" id="" class="delete m-2" data-treeUser-treeId="<?php echo $treeUser['treeId'] ?>" data-treeUser-userId="<?php echo $treeUser['userId'] ?>"
                                                               data-bs-toggle="modal" data-bs-target="#deleteTreeUserModal"><i class="fas fa-trash-alt fa-lg"></i></a>
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
        <div id="addTreeUserModal" class="modal fade" tabindex="-1" aria-labelledby="addTreeUserModal-Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="addTreeUser">
                        <div class="modal-header">
                            <h4 class="modal-title">Adicionar adoção</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Utilizador</label>
                                <input type="text" class="form-control" name="addTreeUserUserId" required>
                            </div>
                            <div class="form-group">
                                <label>Árvore</label>
                                <input type="text" class="form-control" name="addTreeUserTreeId" required>
                            </div>
                            <div class="form-group form-check form-switch">
                                <label>Ativo</label>
                                <input type="checkbox" role="switch" class="form-check-input" name="addTreeUserActive">
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
        <div id="editTreeUserModal" class="modal fade" tabindex="-1" aria-labelledby="editTreeUserModal-Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="editTreeUser">
                        <div class="modal-header">
                            <h4 class="modal-title">Editar Apagar</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <input id="editUserId" name="editUserId" type="hidden" class="form-control" value="">
                                <input id="editTreeId" name="editTreeId" type="hidden" class="form-control" value="">
                            </div>

                            <div class="form-group">
                                <label>Utilizador</label>
                                <input type="text" class="form-control" name="editTreeUserUserId" required>
                            </div>
                            <div class="form-group">
                                <label>Árvore</label>
                                <input type="text" class="form-control" name="editTreeUserTreeId" required>
                            </div>
                            <div class="form-group form-check form-switch">
                                <label>Ativo</label>
                                <input type="checkbox" role="switch" class="form-check-input" name="editTreeUserActive">
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
        <div id="deleteTreeUserModal" class="modal fade" tabindex="-1" aria-labelledby="deleteTreeUserModal-Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="deleteTreeUser">
                        <div class="modal-header">
                            <h4 class="modal-title">Apagar adoção</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Tem a certeza que quer apagar esta adoção?</p>
                            <p class="text-warning"><small>A ação não pode ser defeita.</small></p>
                            <input id="deleteUserId" name="deleteUserId" type="hidden" class="form-control" value="">
                            <input id="deleteTreeId" name="deleteTreeId" type="hidden" class="form-control" value="">
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
        try {
            var table = $('#treesUsersTable').DataTable({
                rowReorder: false,
                responsive: false,
                columnDefs: [ {
                    targets: [3,4],
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
        } catch (error){
            console.log(error)
        }


        // TreesMap
        /*var greenIcon = L.icon({
            iconUrl: '<?php //echo HOME_URL . '/Images/mapMarkers/mapMarker.png'?>',
            shadowUrl: '<?php //echo HOME_URL . '/Images/mapMarkers/shadow.png'?>',

            iconSize: [38, 95], // size of the icon
            shadowSize: [50, 64], // size of the shadow
            iconAnchor: [22, 94], // point of the icon which will correspond to marker's location
            shadowAnchor: [4, 62],  // the same for the shadow
            popupAnchor: [-3, -76] // point from which the popup should open relative to the iconAnchor
        });*/

        /*var blueIcon = L.icon({
            iconUrl: '<?php //echo HOME_URL . '/Images/mapMarkers/blue-mapMarker.png'?>',
            shadowUrl: '<?php //echo HOME_URL . '/Images/mapMarkers/shadow.png'?>',

            iconSize: [38, 95], // size of the icon
            shadowSize: [50, 64], // size of the shadow
            iconAnchor: [22, 94], // point of the icon which will correspond to marker's location
            shadowAnchor: [4, 62],  // the same for the shadow
            popupAnchor: [-3, -76] // point from which the popup should open relative to the iconAnchor
        });*/

        /*let map = L.map('map').setView([37.319518557906285, -8.556156285649438], 12.5);
        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
            maxZoom: 18,
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1,
            accessToken: 'pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw'
        }).addTo(map);*/

        //function to load all trees from API
        /*function mapLoadTrees(){
            <?php /*if (!empty($this->userdata['treesList'])) {
            foreach ($this->userdata['treesList'] as $key => $tree) {?>
                marker = new L.marker([<?php echo $tree["lat"]?>, <?php echo $tree["lng"]?>], {icon: greenIcon, user: 'none'}).addTo(map).on("click", markerOnClick);
            <?php }
            }*/?>
        }
        mapLoadTrees();*/

        //popup on map click
        /*var popupMap = L.popup();
        function onMapClick(e) {
            popupMap
                .setLatLng(e.latlng)
                .setContent("LAT: " + e.latlng.lat + " LNG: " + e.latlng.lng)
                .openOn(map);
        }
        map.on('click', onMapClick);*/

        //popup on marker click
        /*var popupMarker = L.popup();
        function markerOnClick(e)
        {
            popupMarker
                .setLatLng(e.latlng)
                .setContent(
                    `
                    <div class="card" style="width: 10rem; border: unset">
                      <img src="<?php //echo HOME_URL . '/Images/logo/adoteUma.png'?>" class="card-img-top" alt="">
                      <div class="card-body">
                        <h5 class="card-title">Arvore exemplo</h5>
                        <p class="card-text">Algo sobre a arvore.</p>
                        <p class="card-text">Padrinho: ` + this.options.user + `</p>
                        <p class="card-text">Latitude: ` + e.latlng.lat + `</p>
                        <p class="card-text">Longitude: ` + e.latlng.lng + `</p>
                        <!--<a href="#" class="btn btn-primary">Go somewhere</a>-->
                      </div>
                    </div>
                    `
                )
                .openOn(map);
            //map.flyTo([e.latlng.lat, e.latlng.lng], 15);
        }*/


        //CRUD
        // ajax to Add Group
        $('#addTreeUser').submit(function (event) {
            event.preventDefault(); //prevent default action

            let formData = {
                'action': "AddTreeUser",
                'data': $(this).serializeArray()
            };

            $.ajax({
                url: "<?php echo HOME_URL . '/admin/trees_users';?>",
                dataType: "json",
                type: 'POST',
                data: formData,
                beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                    $('#loader').removeClass('hidden')
                },
                success: function (data) {
                    $("#addTreeUserModal").modal('hide');

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

        // ajax to Edit Group
        $('#editTreeUser').submit(function (event) {
            event.preventDefault(); //prevent default action

            //Ve se a data dos inputs mudou para formar so a data necessaria para o PATCH
            /*let formDataChanged = [];
            $('#editTree input').each(function() { //para cada input vai ver
                if($(this).attr('name') === "editTreeId" || $(this).data('lastValue') !== $(this).val()) {//se a data anterior é diferente da current
                    let emptyArray = { name: "", value: "" };

                    emptyArray.name = $(this).attr('name');
                    emptyArray.value = $(this).val();

                    formDataChanged.push(emptyArray);
                }
            });

            let formData = {
                'action' : "UpdateTreeUser",
                'data'   : formDataChanged
            };*/

            let formData = {
                'action': "UpdateTreeUser",
                'data': $(this).serializeArray()
            };

            $.ajax({
                url : "<?php echo HOME_URL . '/admin/trees_users';?>",
                dataType: "json",
                type: 'POST',
                data : formData,
                beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                    $('#loader').removeClass('hidden')
                },
                success: function (data) {
                    $("#editTreeUserModal").modal('hide');

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

        // ajax to get data to Modal Edit Tree
        $('.edit').on('click', function(){

            let arrayAdoption = [];
            let emptyArray;

            //get user id
            emptyArray = { name: "", value: "" }
            emptyArray.name = "userId";
            emptyArray.value = $(this).attr('data-treeUser-userId');
            arrayAdoption.push(emptyArray)


            //get tree id
            emptyArray = { name: "", value: "" }
            emptyArray.name = "treeId";
            emptyArray.value = $(this).attr('data-treeUser-treeId');
            arrayAdoption.push(emptyArray)

            let formData = {
                'action' : "GetTreeUser",
                'data'   : arrayAdoption
            };

            $.ajax({
                url : "<?php echo HOME_URL . '/admin/trees_users';?>",
                dataType: "json",
                type: 'POST',
                data : formData,
                beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                    $('#loader').removeClass('hidden')
                },
                success: function (data) {

                    $('[name="editUserId"]').val(data[0]['userId']);
                    $('[name="editTreeId"]').val(data[0]['treeId']);
                    $('[name="editTreeUserUserId"]').val(data[0]['userId']);
                    $('[name="editTreeUserTreeId"]').val(data[0]['treeId']);

                    if (data[0]['active'] === 1) {
                        $('[name="editTreeUserActive"]').attr('checked', true);
                    } else {
                        $('[name="editTreeUserActive"]').attr('checked', false);
                    }

                    //atribui atributo .data("lastValue") a cada input do form editTree
                    // para se poder comparar entre os dados anteriores e os current
                    /*$('#editTree input').each(function() {
                        $(this).data('lastValue', $(this).val());
                    });*/

                    $("#editTreeUserModal").modal('show');
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

        // ajax to Delete Tree
        $('#deleteTreeUser').submit(function(event){
            event.preventDefault(); //prevent default action

            let formData = {
                'action' : "DeleteTreeUser",
                'data'   : $(this).serializeArray()
            };

            $.ajax({
                url : "<?php echo HOME_URL . '/admin/trees_users';?>",
                dataType: "json",
                type: 'POST',
                data : formData,
                beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                    $('#loader').removeClass('hidden')
                },
                success: function (data) {
                    $("#deleteTreeUserModal").modal('hide');

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
            let deleteUserId = $(this).attr('data-treeUser-userId');
            let deleteTreeId = $(this).attr('data-treeUser-treeId');

            $('[name="deleteUserId"]').val(deleteUserId);
            $('[name="deleteTreeId"]').val(deleteTreeId);

            $("#deleteTreeUserModal").modal('show');

        });

    });
</script>