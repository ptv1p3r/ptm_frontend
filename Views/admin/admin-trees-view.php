
<?php if ( ! defined('ABSPATH')) exit; ?>

<?php if ( $this->login_required && ! $this->logged_in ) return; ?>

<!-- AJAX loader -->
<div id="loader" class="lds-dual-ring hidden overlay"></div>

<div id="layoutSidenav">
    <!-- import sidebar -->
    <?php require ABSPATH . '/views/_includes/admin-sidebar.php'?>

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Gestão de <b>Árvores</b></h1>
                <div class="row">

                    <div class="col-xl-12 col-md-12 mb-4">
                        <!--Map area div-->
                        <div id="map"></div>
                    </div>

                    <div class="col-xl-12 col-md-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <a href="#addTreeModal" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addTreeModal">
                                    <i class="fas fa-plus-circle"></i><span>Add New Tree</span>
                                </a>
                            </div>
                            <div class="card-body">
                                <table id="treesTable" class="table table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th>name</th>
                                        <th>nameCommon</th>
                                        <th>description</th>
                                        <th>observations</th>
                                        <th>typeId</th>
                                        <th>lat</th>
                                        <th>lng</th>
                                        <th>active
                                            <select id='GetActive'>
                                                <option value=''>All</option>
                                                <option value='1'>Active</option>
                                                <option value='0'>Inactive</option>
                                            </select>
                                        </th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if (!empty($this->userdata['treesList'])) {
                                        foreach ($this->userdata['treesList'] as $key => $tree) { ?>
                                            <tr>
                                                <td><?php echo $tree["name"] ?></td>
                                                <td><?php echo $tree["nameCommon"] ?></td>
                                                <td><?php echo $tree["description"] ?></td>
                                                <td><?php echo $tree["observations"] ?></td>
                                                <td><?php echo $tree["typeId"] ?></td>
                                                <td><?php echo $tree["lat"] ?></td>
                                                <td><?php echo $tree["lng"] ?></td>
                                                <td><?php echo $tree["active"] ?></td>
                                                <td>
                                                    <a href="#editTreeModal" id="<?php echo $tree['id'] ?>" class="edit" data-bs-toggle="modal" data-bs-target="#editTreeModal"><i class="far fa-edit"></i></a>
                                                    <a href="#deleteTreeModal" id="<?php echo $tree['id'] ?>" class="delete" data-bs-toggle="modal" data-bs-target="#deleteTreeModal"><i class="fas fa-trash-alt"></i></a>
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


    <!-- MODALS -->
    <!-- Add Modal HTML -->
    <div id="addTreeModal" class="modal fade" tabindex="-1" aria-labelledby="addTreeModal-Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="addTree">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Tree</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="addTreeName" required>
                        </div>
                        <div class="form-group">
                            <label>NameCommon</label>
                            <input type="text" class="form-control" name="addTreeNameCommon" required>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <input type="text" class="form-control" name="addTreeDescription" required>
                        </div>
                        <div class="form-group">
                            <label>Observations</label>
                            <input type="text" class="form-control" name="addTreeObservations" required>
                        </div>
                        <div class="form-group">
                            <label>TypeId</label>
                            <input type="text" class="form-control" name="addTreeTypeId" required>
                        </div>
                        <div class="form-group">
                            <label>Latitude</label>
                            <input type="number" step="any" class="form-control" name="addTreeLat" required>
                        </div>
                        <div class="form-group">
                            <label>Longitude</label>
                            <input type="number" step="any" class="form-control" name="addTreeLng" required>
                        </div>
                        <div class="form-group">
                            <label>Active</label>
                            <input type="checkbox" class="form-control form-check-input" name="addTreeActive">
                        </div>
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
    <div id="editTreeModal" class="modal fade" tabindex="-1" aria-labelledby="editTreeModal-Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editTree">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Tree</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input id="editTreeId" name="editTreeId" type="hidden" class="form-control" value="">
                        </div>

                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="editTreeName" required>
                        </div>
                        <div class="form-group">
                            <label>NameCommon</label>
                            <input type="text" class="form-control" name="editTreeNameCommon" required>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <input type="text" class="form-control" name="editTreeDescription" required>
                        </div>
                        <div class="form-group">
                            <label>Observations</label>
                            <input type="text" class="form-control" name="editTreeObservations" required>
                        </div>
                        <div class="form-group">
                            <label>TypeId</label>
                            <input type="text" class="form-control" name="editTreeTypeId" required>
                        </div>
                        <div class="form-group">
                            <label>Latitude</label>
                            <input type="number" step="any" class="form-control" name="editTreeLat" required>
                        </div>
                        <div class="form-group">
                            <label>Longitude</label>
                            <input type="number" step="any" class="form-control" name="editTreeLng" required>
                        </div>
                        <div class="form-group">
                            <label>Active</label>
                            <input type="checkbox" class="form-control form-check-input" name="editTreeActive">
                        </div>

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
    <div id="deleteTreeModal" class="modal fade" tabindex="-1" aria-labelledby="deleteTreeModal-Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="deleteTree">
                    <div class="modal-header">
                        <h4 class="modal-title">Delete Tree</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete this Tree?</p>
                        <p class="text-warning"><small>This action cannot be undone.</small></p>
                        <input id="deleteTreeId" name="deleteTreeId" type="hidden" class="form-control" value="">
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
            var table = $('#treesTable').DataTable({
                rowReorder: false,
                responsive: true,
                columnDefs: [ {
                    targets: [7,8],
                    orderable: false,
                }]
            });
            //filtra table se ativo, inativo ou mostra todos
            $('#GetActive').on('change', function() {
                let selectedItem = $(this).children("option:selected").val();
                table.columns(7).search(selectedItem).draw();
            })
        } catch (error){
            console.log(error);
        }



        // TreesMap
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

        let map = L.map('map').setView([37.319518557906285, -8.556156285649438], 12.5);
        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
            maxZoom: 18,
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1,
            accessToken: 'pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw'
        }).addTo(map);

        //function to load all trees from API
        function mapLoadTrees(){
            <?php if (!empty($this->userdata['treesList'])) {
                foreach ($this->userdata['treesList'] as $key => $tree) {?>
                    marker = new L.marker([<?php echo $tree["lat"]?>, <?php echo $tree["lng"]?>], {icon: greenIcon, user: 'none'}).addTo(map).on("click", markerOnClick);
                <?php }
            }?>
        }
        mapLoadTrees();

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
        var popupMarker = L.popup();
        function markerOnClick(e)
        {
            popupMarker
                .setLatLng(e.latlng)
                .setContent(
                    `
                    <div class="card" style="width: 10rem; border: unset">
                      <img src="<?php echo HOME_URL . '/Images/logo/adoteUma.png'?>" class="card-img-top" alt="">
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

        // ajax to get data to Modal Delete Tree
        $('.delete').on('click', function(){
            let $deleteID = $(this).attr('id');
            $('[name="deleteTreeId"]').val($deleteID); //gets tree id from id="" attribute on delete button from table
            $("#deleteTreeModal").modal('show');

        });

    });
</script>