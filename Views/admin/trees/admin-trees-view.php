
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
                <h1 class="mt-4">Gestão de <b>árvores</b></h1>
                <div class="row">

                    <div class="col-xl-12 col-md-12 mb-4">
                        <!--Map area div-->
                        <div id="map"></div>
                    </div>

                    <div class="col-xl-12 col-md-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <a href="#addTreeModal" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addTreeModal">
                                    <i class="fas fa-plus-circle"></i><span> Nova árvore</span>
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
                                    <table id="treesTable" class="table table-striped table-sm" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th>Identificador</th>
                                            <th>Nome</th>
                                            <th>Nome comum</th>
                                            <th>Descrição</th>
                                            <th>Observações</th>
                                            <th>Tipo</th>
                                            <th>lat</th>
                                            <th>lng</th>
                                            <th>Data Criação</th>
                                            <th>Data Modificação</th>
                                            <th hidden>active</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php if (!empty($this->userdata['treesList'])) {
                                            foreach ($this->userdata['treesList'] as $key => $tree) { ?>
                                                <tr>
                                                    <td id="d210j1x8i9-<?php echo $tree["id"] ?>"
                                                        onclick="copy('<?php echo $tree["id"] ?>','d210j1x8i9-<?php echo $tree["id"] ?>')"
                                                        title="<?php echo $tree["id"] ?>"
                                                        class="table-text-truncate"
                                                        style="cursor: pointer">
                                                        <?php echo $tree["id"] ?>
                                                    </td>
                                                    <td id="fau9fv44vf-<?php echo $tree["id"] ?>"
                                                        onclick="copy('<?php echo $tree["name"] ?>','fau9fv44vf-<?php echo $tree["id"] ?>')"
                                                        title="<?php echo $tree["name"] ?>"
                                                        class="table-text-truncate"
                                                        style="cursor: pointer">
                                                        <?php echo $tree["name"] ?>
                                                    </td>
                                                    <td id="my2kda7utd-<?php echo $tree["id"] ?>"
                                                        onclick="copy('<?php echo $tree["nameCommon"] ?>','my2kda7utd-<?php echo $tree["id"] ?>')"
                                                        title="<?php echo $tree["nameCommon"] ?>"
                                                        class="table-text-truncate"
                                                        style="cursor: pointer">
                                                        <?php echo $tree["nameCommon"] ?>
                                                    </td>
                                                    <td id="19hogucdo8-<?php echo $tree["id"] ?>"
                                                        onclick="copy('<?php echo $tree["description"] ?>','19hogucdo8-<?php echo $tree["id"] ?>')"
                                                        title="<?php echo $tree["description"] ?>"
                                                        class="table-text-truncate"
                                                        style="cursor: pointer">
                                                        <?php echo $tree["description"] ?>
                                                    </td>
                                                    <td id="x3hfoezx8q-<?php echo $tree["id"] ?>"
                                                        onclick="copy('<?php echo $tree["observations"] ?>','x3hfoezx8q-<?php echo $tree["id"] ?>')"
                                                        title="<?php echo $tree["observations"] ?>"
                                                        class="table-text-truncate"
                                                        style="cursor: pointer">
                                                        <?php echo $tree["observations"] ?>
                                                    </td>
                                                    <?php if (!empty($this->userdata['treeTypesList'])) { foreach ($this->userdata['treeTypesList'] as $key => $type) { if ( $type["id"] == $tree["typeId"]){ $typeName = $type["name"]; } } }?>
                                                    <td id="lfca8ctid7-<?php echo $tree["id"] ?>"
                                                        onclick="copy('<?php echo $typeName ?>','lfca8ctid7-<?php echo $tree["id"] ?>')"
                                                        title="<?php echo $typeName ?>"
                                                        class="table-text-truncate"
                                                        style="cursor: pointer">
                                                        <?php echo $typeName ?>
                                                    </td>
                                                    <td id="m8f8qy9bsk-<?php echo $tree["id"] ?>"
                                                        onclick="copy('<?php echo $tree["lat"] ?>','m8f8qy9bsk-<?php echo $tree["id"] ?>')"
                                                        title="<?php echo $tree["lat"] ?>"
                                                        class="table-text-truncate"
                                                        style="cursor: pointer">
                                                        <?php echo $tree["lat"] ?>
                                                    </td>
                                                    <td id="0piqt9r7gu-<?php echo $tree["id"] ?>"
                                                        onclick="copy('<?php echo $tree["lng"] ?>','0piqt9r7gu-<?php echo $tree["id"] ?>')"
                                                        title="<?php echo $tree["lng"] ?>"
                                                        class="table-text-truncate"
                                                        style="cursor: pointer">
                                                        <?php echo $tree["lng"] ?>
                                                    </td>
                                                    <td id="cd5tntewxm-<?php echo $tree["id"] ?>"
                                                        onclick="copy('<?php echo $tree["dateCreated"] ?>','cd5tntewxm-<?php echo $tree["id"] ?>')"
                                                        title="<?php echo $tree["dateCreated"] ?>"
                                                        class="table-text-truncate"
                                                        style="cursor: pointer">
                                                        <?php echo $tree["dateCreated"] ?>
                                                    </td>
                                                    <td id="12n35nxebd-<?php echo $tree["id"] ?>"
                                                        onclick="copy('<?php echo $tree["dateModified"] ?>','12n35nxebd-<?php echo $tree["id"] ?>')"
                                                        title="<?php echo $tree["dateModified"] ?>"
                                                        class="table-text-truncate"
                                                        style="cursor: pointer">
                                                        <?php echo $tree["dateModified"] ?>
                                                    </td>
                                                    <td hidden><?php echo $tree["active"] ?></td>
                                                    <td>
                                                        <div class="float-end">
                                                            <a href="#editTreeModal" id="<?php echo $tree['id'] ?>" class="edit m-2"
                                                               data-bs-toggle="modal" data-bs-target="#editTreeModal"><i class="far fa-edit fa-lg"></i></a>
                                                            <a href="#deleteTreeModal" id="<?php echo $tree['id'] ?>" class="delete m-2"
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
    <div id="addTreeModal" class="modal fade" tabindex="-1" aria-labelledby="addTreeModal-Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="addTree">
                    <div class="modal-header">
                        <h4 class="modal-title">Adicionar árvore</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nome</label>
                            <input type="text" class="form-control" name="addTreeName" required>
                        </div>
                        <div class="form-group">
                            <label>Nome comum</label>
                            <input type="text" class="form-control" name="addTreeNameCommon" required>
                        </div>
                        <div class="form-group">
                            <label>Descrição</label>
                            <input type="text" class="form-control" name="addTreeDescription" required>
                        </div>
                        <div class="form-group">
                            <label>Observações</label>
                            <input type="text" class="form-control" name="addTreeObservations" required>
                        </div>
                        <div class="form-group">
                            <label>Tipo</label>
                            <!--<input type="text" class="form-control" name="addTreeTypeId" required>-->
                            <select class="form-select" name="addTreeTypeId" id="addTreeTypeId" required>
                                <option value="" disabled selected>Selecione o tipo</option>
                                <?php if (!empty($this->userdata['treeTypesList'])) {
                                    foreach ($this->userdata['treeTypesList'] as $key => $type) { ?>
                                        <option value="<?php echo $type['id'] ?>"><?php echo $type["name"] ?></option>
                                    <?php }
                                } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Latitude</label>
                            <input type="number" step="any" class="form-control" name="addTreeLat" required>
                        </div>
                        <div class="form-group">
                            <label>Longitude</label>
                            <input type="number" step="any" class="form-control" name="addTreeLng" required>
                        </div>
                        <div class="form-group form-check form-switch">
                            <label>Ativo</label>
                            <input type="checkbox" role="switch" class="form-check-input" name="addTreeActive">
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
    <div id="editTreeModal" class="modal fade" tabindex="-1" aria-labelledby="editTreeModal-Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editTree">
                    <div class="modal-header">
                        <h4 class="modal-title">Editar árvore</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input id="editTreeId" name="editTreeId" type="hidden" class="form-control" value="">
                        </div>

                        <div class="form-group">
                            <label>Nome</label>
                            <input type="text" class="form-control" name="editTreeName" required>
                        </div>
                        <div class="form-group">
                            <label>Nome comum</label>
                            <input type="text" class="form-control" name="editTreeNameCommon" required>
                        </div>
                        <div class="form-group">
                            <label>Descrição</label>
                            <input type="text" class="form-control" name="editTreeDescription" required>
                        </div>
                        <div class="form-group">
                            <label>Observações</label>
                            <input type="text" class="form-control" name="editTreeObservations" required>
                        </div>
                        <div class="form-group">
                            <label>Tipo</label>
                            <!--<input type="text" class="form-control" name="editTreeTypeId" required>-->
                            <select class="form-select" name="editTreeTypeId" id="editTreeTypeId" required>
                                <option value="" disabled selected>Selecione o tipo</option>
                                <?php if (!empty($this->userdata['treeTypesList'])) {
                                    foreach ($this->userdata['treeTypesList'] as $key => $type) { ?>
                                        <option value="<?php echo $type['id'] ?>"><?php echo $type["name"] ?></option>
                                    <?php }
                                } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Latitude</label>
                            <input type="number" step="any" class="form-control" name="editTreeLat" required>
                        </div>
                        <div class="form-group">
                            <label>Longitude</label>
                            <input type="number" step="any" class="form-control" name="editTreeLng" required>
                        </div>
                        <div class="form-group form-check form-switch">
                            <label>Ativo</label>
                            <input type="checkbox" role="switch" class="form-check-input" name="editTreeActive">
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
    <div id="deleteTreeModal" class="modal fade" tabindex="-1" aria-labelledby="deleteTreeModal-Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="deleteTree">
                    <div class="modal-header">
                        <h4 class="modal-title">Apagar árvore</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Tem a certeza que quer apagar esta árvore?</p>
                        <p class="text-warning"><small>A ação não pode ser defeita.</small></p>
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
    // get tree first image
    function getImg(tree_id){
        let treeImagePath = "";

        let formData = {
            'action' : "GetTreeImage",
            'data'   : tree_id
        };

        $.ajax({
            url : "<?php echo HOME_URL . '/admin/trees';?>",
            dataType: "json",
            type: 'POST',
            async: false,
            data : formData,
            beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                $('#loader').removeClass('hidden')
            },
            success: function (data) {
                if (data.statusCode === 404){
                    treeImagePath = "<?php echo HOME_URL . '/Images/admin/noimage.png' ?>";
                } else {
                    treeImagePath = "<?php echo API_URL . 'api/v1/trees/image/' ?>" + data[0]["path"];
                }

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

        return treeImagePath;
    }

    $(document).ready(function() {
        //DATATABLES
        //Configura a dataTable
        try{
            var table = $('#treesTable').DataTable({
                rowReorder: false,
                responsive: false,
                columnDefs: [
                    {
                        targets:[10,11],
                        orderable: false,
                    }
                ],
                oLanguage: {
                    "sUrl": "https://cdn.datatables.net/plug-ins/1.12.1/i18n/pt-PT.json"
                }
            });
            //filtra table se ativo, inativo ou mostra todos
            $('#GetActive').on('change', function() {
                let selectedItem = $(this).children("option:selected").val();
                table.columns(10).search(selectedItem).draw();
            })
        } catch (error){
            console.log(error);
        }


        //Leaflet map icons
        var greenIcon = L.icon({
            iconUrl: '<?php echo HOME_URL . '/Images/mapMarkers/mapMarker.png'?>',
            shadowUrl: '<?php echo HOME_URL . '/Images/mapMarkers/shadow.png'?>',

            iconSize: [38, 95], // size of the icon
            shadowSize: [50, 64], // size of the shadow
            iconAnchor: [22, 94], // point of the icon which will correspond to marker's location
            shadowAnchor: [4, 62],  // the same for the shadow
            popupAnchor: [-3, -76] // point from which the popup should open relative to the iconAnchor
        });

        var blueIcon = L.icon({
            iconUrl: '<?php echo HOME_URL . '/Images/mapMarkers/blue-mapMarker.png'?>',
            shadowUrl: '<?php echo HOME_URL . '/Images/mapMarkers/shadow.png'?>',

            iconSize: [38, 95], // size of the icon
            shadowSize: [50, 64], // size of the shadow
            iconAnchor: [22, 94], // point of the icon which will correspond to marker's location
            shadowAnchor: [4, 62],  // the same for the shadow
            popupAnchor: [-3, -76] // point from which the popup should open relative to the iconAnchor
        });

        //Leaflet map
        let map = L.map('map').setView([37.319518557906285, -8.556156285649438], 12.5);
        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
            maxZoom: 18,
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1,
            accessToken: 'pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw'
        }).addTo(map);

        //function create a blue marker / arvore adotada
        function createBlueMarker(lat, lng, params){
            params["icon"] = blueIcon;
            params["adopted"] = 'sim';
            return new L.marker([lat, lng],params);
        }

        //function create a green marker / arvore nao adotada
        function createGreenMarker(lat, lng, params){
            params["icon"] = greenIcon;
            params["adopted"] = 'não';
            return new L.marker([lat, lng],params);
        }

        //Load trees to respective Layers
        let ActiveTrees = L.layerGroup(), InactiveTrees= L.layerGroup();
        function mapLoadTrees(){
            <?php
            if (!empty($this->userdata['treesList']) && !empty($this->userdata['adoptedTreesList'])) {
                $adopted = array_column($this->userdata['adoptedTreesList'], 'treeId');
                foreach ($this->userdata['treesList'] as $key => $tree) {
                    //checks if tree is already adopted or not
                    if (in_array($tree["id"], $adopted)) { ?>
                        marker = createBlueMarker(<?php echo $tree["lat"]?>, <?php echo $tree["lng"]?>,
                            { name: '<?php echo $tree["name"]?>', tree_id: '<?php echo $tree["id"]?>'}
                        );
                    <?php } else {?>
                        marker = createGreenMarker(<?php echo $tree["lat"]?>, <?php echo $tree["lng"]?>,
                            { name: '<?php echo $tree["name"]?>', tree_id: '<?php echo $tree["id"]?>'}
                        );
                    <?php }?>

                    //checks if tree is active or inactive
                    <?php if ($tree["active"] === 1) { ?>
                        marker.addTo(ActiveTrees).on("click", markerOnClick);
                    <?php } else {?>
                        marker.addTo(InactiveTrees).on("click", markerOnClick);
                    <?php }?>

                <?php }?>
            <?php }?>
        }
        mapLoadTrees();

        //show all trees by default
        map.addLayer(ActiveTrees);
        map.addLayer(InactiveTrees);

        //filter trees on map. all, active or inactive
        $('#GetActive').on('change', function() {
            function removeAlltrees(){map.removeLayer(ActiveTrees); map.removeLayer(InactiveTrees);}
            let selectedItem = $(this).children("option:selected").val();

            //all
            if(selectedItem === ""){
                removeAlltrees()// remove all trees
                map.addLayer(ActiveTrees);// adds active
                map.addLayer(InactiveTrees);// adds inactive
            }

            //active
            if(selectedItem === "1"){
                removeAlltrees()// remove all trees
                map.addLayer(ActiveTrees);// adds active
            }

            //inactive
            if(selectedItem === "0"){
                removeAlltrees()// remove all trees
                map.addLayer(InactiveTrees);// adds inactive
            }

        })

        //popup on marker click
        var popupMarker = L.popup();
        function markerOnClick(e) {
            popupMarker
                .setLatLng(e.latlng)
                .setContent(
                    `<div class="card" style="width: 15rem; border: unset">
                    <img id="tree-card-image" src="` + getImg(this.options.tree_id) + `" class="card-img-top" alt="" height="160">
                      <div class="card-body">
                        <h5 class="card-title">` + this.options.name + `</h5>
                        <p class="card-text">id: ` + this.options.tree_id + `</p>
                        <p class="card-text">adotada: ` + this.options.adopted + `</p>
                        <p class="card-text">Latitude: ` + e.latlng.lat + `</p>
                        <p class="card-text">Longitude: ` + e.latlng.lng + `</p>
                      </div>
                    </div>`
                )
                .openOn(map);
        }


        //CRUD
        // ajax to Add Group
        $('#addTree').submit(function (event) {
            event.preventDefault(); //prevent default action

            let formData = {
                'action': "AddTree",
                'data': $(this).serializeArray()
            };

            $.ajax({
                url: "<?php echo HOME_URL . '/admin/trees';?>",
                dataType: "json",
                type: 'POST',
                data: formData,
                beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                    $('#loader').removeClass('hidden')
                },
                success: function (data) {
                    $("#addTreeModal").modal('hide');

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
        $('#editTree').submit(function (event) {
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
                'action' : "UpdateTree",
                'data'   : formDataChanged
            };*/

            let formData = {
                'action': "UpdateTree",
                'data': $(this).serializeArray()
            };

            $.ajax({
                url : "<?php echo HOME_URL . '/admin/trees';?>",
                dataType: "json",
                type: 'POST',
                data : formData,
                beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                    $('#loader').removeClass('hidden')
                },
                success: function (data) {
                    $("#editTreeModal").modal('hide');

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

            let formData = {
                'action' : "GetTree",
                'data'   : $(this).attr('id') //gets tree id from id="" attribute on edit button from table
            };

            $.ajax({
                url : "<?php echo HOME_URL . '/admin/trees';?>",
                dataType: "json",
                type: 'POST',
                data : formData,
                beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                    $('#loader').removeClass('hidden')
                },
                success: function (data) {

                    $('[name="editTreeId"]').val(data[0]['id']);
                    $('[name="editTreeName"]').val(data[0]['name']);
                    $('[name="editTreeNameCommon"]').val(data[0]['nameCommon']);
                    $('[name="editTreeDescription"]').val(data[0]['description']);
                    $('[name="editTreeObservations"]').val(data[0]['observations']);
                    $('[name="editTreeTypeId"]').val(data[0]['typeId']);
                    $('[name="editTreeLat"]').val(data[0]['lat']);
                    $('[name="editTreeLng"]').val(data[0]['lng']);

                    if (data[0]['active'] === 1) {
                        $('[name="editTreeActive"]').attr('checked', true);
                    } else {
                        $('[name="editTreeActive"]').attr('checked', false);
                    }

                    //atribui atributo .data("lastValue") a cada input do form editTree
                    // para se poder comparar entre os dados anteriores e os current
                    /*$('#editTree input').each(function() {
                        $(this).data('lastValue', $(this).val());
                    });*/

                    $("#editTreeModal").modal('show');
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
        $('#deleteTree').submit(function(event){
            event.preventDefault(); //prevent default action

            let formData = {
                'action' : "DeleteTree",
                'data'   : $(this).serializeArray()
            };

            $.ajax({
                url : "<?php echo HOME_URL . '/admin/trees';?>",
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
            $('[name="deleteTreeId"]').val($deleteID); //gets tree id from id="" attribute on delete button from table
            $("#deleteTreeModal").modal('show');

        });

    });
</script>