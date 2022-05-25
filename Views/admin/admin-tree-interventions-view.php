
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
                <h1 class="mt-4">Gestão de <b>Intervenções</b></h1>
                <div class="row">

                    <div class="col-xl-12 col-md-12 mb-4">
                        <!--Map area div-->
                        <div id="map"></div>
                    </div>

                    <div class="col-xl-12 col-md-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <a href="#addTreeInterventionsModal" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addTreeInterventionsModal">
                                    <i class="fas fa-plus-circle"></i><span>Add New Tree Intervention</span>
                                </a>
                            </div>
                            <div class="card-body">
                                <table id="treeInterventionsTable" class="table table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th>treeId</th>
                                        <th>date</th>
                                        <th>subject</th>
                                        <th>description</th>
                                        <th>observations</th>
                                        <th>public</th>
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
                                    <?php if (!empty($this->userdata['treeInterventionList'])) {
                                        foreach ($this->userdata['treeInterventionList'] as $key => $treeIntervention) { ?>
                                            <tr>
                                                <td><?php echo $treeIntervention["treeId"] ?></td>
                                                <td><?php echo $treeIntervention["interventionDate"] ?></td>
                                                <td><?php echo $treeIntervention["subject"] ?></td>
                                                <td><?php echo $treeIntervention["description"] ?></td>
                                                <td><?php echo $treeIntervention["observations"] ?></td>
                                                <td><?php echo $treeIntervention["public"] ?></td>
                                                <td><?php echo $treeIntervention["active"] ?></td>
                                                <td>
                                                    <a href="#editTreeInterventionsModal" id="<?php echo $treeIntervention['id'] ?>" class="edit" data-bs-toggle="modal" data-bs-target="#editTreeInterventionsModal"><i class="far fa-edit"></i></a>
                                                    <a href="#deleteTreeInterventionsModal" id="<?php echo $treeIntervention['id'] ?>" class="delete" data-bs-toggle="modal" data-bs-target="#deleteTreeInterventionsModal"><i class="fas fa-trash-alt"></i></a>
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
        <div id="addTreeInterventionsModal" class="modal fade" tabindex="-1" aria-labelledby="addTreeInterventionsModal-Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="addTreeInterventions">
                        <div class="modal-header">
                            <h4 class="modal-title">Add Tree Intervention</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>treeId</label>
                                <input type="text" class="form-control" name="addTreeInterventionTreeId" required>
                            </div>
                            <div class="form-group">
                                <label>Date</label>
                                <input type="text" class="form-control" name="addTreeInterventionDate" required>
                            </div>
                            <div class="form-group">
                                <label>subject</label>
                                <input type="text" class="form-control" name="addTreeInterventionSubject" required>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <input type="text" class="form-control" name="addTreeInterventionDescription" required>
                            </div>
                            <div class="form-group">
                                <label>Observations</label>
                                <input type="text" class="form-control" name="addTreeInterventionObservations" required>
                            </div>
                            <div class="form-group form-check form-switch">
                                <label>public</label>
                                <input type="checkbox" role="switch" class="form-check-input" name="addTreeInterventionPublic">
                            </div>
                            <div class="form-group form-check form-switch">
                                <label>Active</label>
                                <input type="checkbox" role="switch" class="form-check-input" name="addTreeInterventionActive">
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
        <div id="editTreeInterventionsModal" class="modal fade" tabindex="-1" aria-labelledby="editTreeInterventionsModal-Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="editTreeInterventions">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Tree Intervention</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <input id="editTreeInterventionId" name="editTreeInterventionId" type="hidden" class="form-control" value="">
                            </div>

                            <div class="form-group">
                                <label>treeId</label>
                                <input type="text" class="form-control" name="editTreeInterventionTreeId" required>
                            </div>
                            <div class="form-group">
                                <label>Date</label>
                                <div class='input-group' id='datetimepicker1' data-td-target-input='nearest' data-td-target-toggle='nearest'>
                                    <input id='datetimepicker1Input' name="editTreeInterventionDate" type='text' class='form-control' data-td-target='#datetimepicker1' required/>
                                    <span class='input-group-text' data-td-target='#datetimepicker1' data-td-toggle='datetimepicker'>
                                        <span class='fa-solid fa-calendar'></span>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>subject</label>
                                <input type="text" class="form-control" name="editTreeInterventionSubject" required>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <input type="text" class="form-control" name="editTreeInterventionDescription" required>
                            </div>
                            <div class="form-group">
                                <label>Observations</label>
                                <input type="text" class="form-control" name="editTreeInterventionObservations" required>
                            </div>
                            <div class="form-group form-check form-switch">
                                <label>public</label>
                                <input type="checkbox" role="switch" class="form-check-input" name="editTreeInterventionPublic">
                            </div>
                            <div class="form-group form-check form-switch">
                                <label>Active</label>
                                <input type="checkbox" role="switch" class="form-check-input" name="editTreeInterventionActive">
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
        <div id="deleteTreeInterventionsModal" class="modal fade" tabindex="-1" aria-labelledby="deleteTreeInterventionsModal-Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="deleteTreeInterventions">
                        <div class="modal-header">
                            <h4 class="modal-title">Delete Tree Intervention</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete this Tree?</p>
                            <p class="text-warning"><small>This action cannot be undone.</small></p>
                            <input id="deleteTreeInterventionId" name="deleteTreeInterventionId" type="hidden" class="form-control" value="">
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
                try {
                    var table = $('#treeInterventionsTable').DataTable({
                        rowReorder: false,
                        responsive: true,
                        columnDefs: [{
                            targets: [6, 7],
                            orderable: false,
                        }]
                    });
                    //filtra table se ativo, inativo ou mostra todos
                    $('#GetActive').on('change', function () {
                        let selectedItem = $(this).children("option:selected").val();
                        table.columns(6).search(selectedItem).draw();
                    })
                } catch (error){
                    console.log(error);
                }


                //datetimepicker with momentjs plugin
                tempusDominus.extend(tempusDominus.plugins.moment_parse, 'YYYY/MM/DD HH:mm:ss');
                new tempusDominus.TempusDominus(document.getElementById('datetimepicker1'));



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
                $('#addTreeInterventions').submit(function (event) {
                    event.preventDefault(); //prevent default action

                    let formData = {
                        'action': "AddTreeIntervention",
                        'data': $(this).serializeArray()
                    };

                    $.ajax({
                        url: "<?php echo HOME_URL . '/admin/tree_interventions';?>",
                        dataType: "json",
                        type: 'POST',
                        data: formData,
                        beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                            $('#loader').removeClass('hidden')
                        },
                        success: function (data) {
                            $("#addTreeInterventionsModal").modal('hide');

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
                $('#editTreeInterventions').submit(function (event) {
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
                        'action' : "UpdateTreeInterventions",
                        'data'   : formDataChanged
                    };*/

                    let formData = {
                        'action': "UpdateTreeIntervention",
                        'data': $(this).serializeArray()
                    };

                    $.ajax({
                        url : "<?php echo HOME_URL . '/admin/tree_interventions';?>",
                        dataType: "json",
                        type: 'POST',
                        data : formData,
                        beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                            $('#loader').removeClass('hidden')
                        },
                        success: function (data) {
                            $("#editTreeInterventionsModal").modal('hide');

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
                        'action' : "GetTreeIntervention",
                        'data'   : $(this).attr('id') //gets tree id from id="" attribute on edit button from table
                    };

                    $.ajax({
                        url : "<?php echo HOME_URL . '/admin/tree_interventions';?>",
                        dataType: "json",
                        type: 'POST',
                        data : formData,
                        beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                            $('#loader').removeClass('hidden')
                        },
                        success: function (data) {

                            $('[name="editTreeInterventionId"]').val(data[0]['id']);
                            $('[name="editTreeInterventionTreeId"]').val(data[0]['treeId']);
                            $('[name="editTreeInterventionDate"]').val(data[0]['interventionDate']);
                            $('[name="editTreeInterventionSubject"]').val(data[0]['subject']);
                            $('[name="editTreeInterventionDescription"]').val(data[0]['description']);
                            $('[name="editTreeInterventionObservations"]').val(data[0]['observations']);

                            if (data[0]['public'] === 1) {
                                $('[name="editTreeInterventionPublic"]').attr('checked', true);
                            } else {
                                $('[name="editTreeInterventionPublic"]').attr('checked', false);
                            }

                            if (data[0]['active'] === 1) {
                                $('[name="editTreeInterventionActive"]').attr('checked', true);
                            } else {
                                $('[name="editTreeInterventionActive"]').attr('checked', false);
                            }

                            //atribui atributo .data("lastValue") a cada input do form editTree
                            // para se poder comparar entre os dados anteriores e os current
                            /*$('#editTree input').each(function() {
                                $(this).data('lastValue', $(this).val());
                            });*/

                            $("#editTreeInterventionsModal").modal('show');
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
                $('#deleteTreeInterventions').submit(function(event){
                    event.preventDefault(); //prevent default action

                    let formData = {
                        'action' : "DeleteTreeIntervention",
                        'data'   : $(this).serializeArray()
                    };

                    $.ajax({
                        url : "<?php echo HOME_URL . '/admin/tree_interventions';?>",
                        dataType: "json",
                        type: 'POST',
                        data : formData,
                        beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                            $('#loader').removeClass('hidden')
                        },
                        success: function (data) {
                            $("#deleteTreeInterventionsModal").modal('hide');

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
                    $('[name="deleteTreeInterventionsId"]').val($deleteID); //gets tree id from id="" attribute on delete button from table
                    $("#deleteTreeInterventionsModal").modal('show');

                });

            });
        </script>