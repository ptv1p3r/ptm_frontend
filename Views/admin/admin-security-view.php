
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
                <h1 class="mt-4">Gestão de tabelas de <b>segurança</b></h1>
                <div class="row">

                    <div class="col-xl-12 col-md-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <a href="#addSecurityModal" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addSecurityModal">
                                    <i class="fas fa-plus-circle"></i><span>&nbsp;Add New Security</span>
                                </a>
                            </div>
                            <div class="card-body">
                                <table id="securitiesTable" class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>id</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php if (!empty($this->userdata['securityList'])) {
                                        foreach ($this->userdata['securityList'] as $key => $security) { ?>
                                            <tr>
                                                <td>Security Table <?php echo $security["id"] ?></td>
                                                <td>
                                                    <a href="#editSecurityModal" id="<?php echo $security['id'] ?>" class="edit"
                                                       data-bs-toggle="modal" data-bs-target="#editSecurityModal"><i class="far fa-edit"></i></a>
                                                    <a href="#deleteSecurityModal" id="<?php echo $security['id'] ?>" class="delete"
                                                       data-bs-toggle="modal" data-bs-target="#deleteSecurityModal"><i class="fas fa-trash-alt"></i></a>
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
        <div id="addSecurityModal" class="modal fade" tabindex="-1" aria-labelledby="addSecurityModal-Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="addSecurity">
                        <div class="modal-header">
                            <h4 class="modal-title">Add Security</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group form-check form-switch">
                                <label>homeLogin</label>
                                <input type="checkbox" role="switch" class="form-check-input" name="addSecurityHomeLogin">
                            </div>
                            <div class="form-group form-check form-switch">
                                <label>admLogin</label>
                                <input type="checkbox" role="switch" class="form-check-input" name="addSecurityAdmLogin">
                            </div>
                            <div class="form-group form-check form-switch">
                                <label>usersCreate</label>
                                <input type="checkbox" role="switch" class="form-check-input" name="addSecurityUsersCreate">
                            </div>
                            <div class="form-group form-check form-switch">
                                <label>usersRead</label>
                                <input type="checkbox" role="switch" class="form-check-input" name="addSecurityUsersRead">
                            </div>
                            <div class="form-group form-check form-switch">
                                <label>usersUpdate</label>
                                <input type="checkbox" role="switch" class="form-check-input" name="addSecurityUsersUpdate">
                            </div>
                            <div class="form-group form-check form-switch">
                                <label>usersDelete</label>
                                <input type="checkbox" role="switch" class="form-check-input" name="addSecurityUsersDelete">
                            </div>
                            <div class="form-group form-check form-switch">
                                <label>userGroupsCreate</label>
                                <input type="checkbox" role="switch" class="form-check-input" name="addSecurityUserGroupsCreate">
                            </div>
                            <div class="form-group form-check form-switch">
                                <label>userGroupsRead</label>
                                <input type="checkbox" role="switch" class="form-check-input" name="addSecurityUserGroupsRead">
                            </div>
                            <div class="form-group form-check form-switch">
                                <label>userGroupsUpdate</label>
                                <input type="checkbox" role="switch" class="form-check-input" name="addSecurityUserGroupsUpdate">
                            </div>
                            <div class="form-group form-check form-switch">
                                <label>userGroupsDelete</label>
                                <input type="checkbox" role="switch" class="form-check-input" name="addSecurityUserGroupsDelete">
                            </div>
                            <div class="form-group form-check form-switch">
                                <label>UsersTreesCreate</label>
                                <input type="checkbox" role="switch" class="form-check-input" name="addSecurityUsersTreesCreate">
                            </div>
                            <div class="form-group form-check form-switch">
                                <label>UsersTreesRead</label>
                                <input type="checkbox" role="switch" class="form-check-input" name="addSecurityUsersTreesRead">
                            </div>
                            <div class="form-group form-check form-switch">
                                <label>UsersTreesUpdate</label>
                                <input type="checkbox" role="switch" class="form-check-input" name="addSecurityUsersTreesUpdate">
                            </div>
                            <div class="form-group form-check form-switch">
                                <label>UsersTreesDelete</label>
                                <input type="checkbox" role="switch" class="form-check-input" name="addSecurityUsersTreesDelete">
                            </div>
                            <div class="form-group form-check form-switch">
                                <label>treeCreate</label>
                                <input type="checkbox" role="switch" class="form-check-input" name="addSecurityTreeCreate">
                            </div>
                            <div class="form-group form-check form-switch">
                                <label>treeRead</label>
                                <input type="checkbox" role="switch" class="form-check-input" name="addSecurityTreeRead">
                            </div>
                            <div class="form-group form-check form-switch">
                                <label>treeUpdate</label>
                                <input type="checkbox" role="switch" class="form-check-input" name="addSecurityTreeUpdate">
                            </div>
                            <div class="form-group form-check form-switch">
                                <label>treeDelete</label>
                                <input type="checkbox" role="switch" class="form-check-input" name="addSecurityTreeDelete">
                            </div>
                            <div class="form-group form-check form-switch">
                                <label>treeTypeCreate</label>
                                <input type="checkbox" role="switch" class="form-check-input" name="addSecurityTreeTypeCreate">
                            </div>
                            <div class="form-group form-check form-switch">
                                <label>treeTypeRead</label>
                                <input type="checkbox" role="switch" class="form-check-input" name="addSecurityTreeTypeRead">
                            </div>
                            <div class="form-group form-check form-switch">
                                <label>treeTypeUpdate</label>
                                <input type="checkbox" role="switch" class="form-check-input" name="addSecurityTreeTypeUpdate">
                            </div>
                            <div class="form-group form-check form-switch">
                                <label>treeTypeDelete</label>
                                <input type="checkbox" role="switch" class="form-check-input" name="addSecurityTreeTypeDelete">
                            </div>
                            <div class="form-group form-check form-switch">
                                <label>treeImagesCreate</label>
                                <input type="checkbox" role="switch" class="form-check-input" name="addSecurityTreeImagesCreate">
                            </div>
                            <div class="form-group form-check form-switch">
                                <label>treeImagesRead</label>
                                <input type="checkbox" role="switch" class="form-check-input" name="addSecurityTreeImagesRead">
                            </div>
                            <div class="form-group form-check form-switch">
                                <label>treeImagesUpdate</label>
                                <input type="checkbox" role="switch" class="form-check-input" name="addSecurityTreeImagesUpdate">
                            </div>
                            <div class="form-group form-check form-switch">
                                <label>treeImagesDelete</label>
                                <input type="checkbox" role="switch" class="form-check-input" name="addSecurityTreeImagesDelete">
                            </div>
                            <!--
                            <div class="form-group form-check form-switch">
                                <label>SecurityCreate</label>
                                <input type="checkbox" role="switch" class="form-check-input" name="addSecurityCreate">
                            </div>
                            <div class="form-group form-check form-switch">
                                <label>SecurityRead</label>
                                <input type="checkbox" role="switch" class="form-check-input" name="addSecurityRead">
                            </div>
                            <div class="form-group form-check form-switch">
                                <label>SecurityUpdate</label>
                                <input type="checkbox" role="switch" class="form-check-input" name="addSecurityUpdate">
                            </div>
                            <div class="form-group form-check form-switch">
                                <label>SecurityDelete</label>
                                <input type="checkbox" role="switch" class="form-check-input" name="addSecurityDelete">
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
        <div id="editSecurityModal" class="modal fade" tabindex="-1" aria-labelledby="editSecurityModal-Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="editSecurity">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Security</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <input id="editSecurityId" name="editSecurityId" type="hidden" class="form-control">
                            </div>

                            <div class="form-group form-check form-switch">
                                <label>homeLogin</label>
                                <input type="checkbox" role="switch" class="form-check-input" name="editSecurityHomeLogin">
                            </div>
                            <div class="form-group form-check form-switch">
                                <label>admLogin</label>
                                <input type="checkbox" role="switch" class="form-check-input" name="editSecurityAdmLogin">
                            </div>
                            <div class="form-group form-check form-switch">
                                <label>usersCreate</label>
                                <input type="checkbox" role="switch" class="form-check-input" name="editSecurityUsersCreate">
                            </div>
                            <div class="form-group form-check form-switch">
                                <label>usersRead</label>
                                <input type="checkbox" role="switch" class="form-check-input" name="editSecurityUsersRead">
                            </div>
                            <div class="form-group form-check form-switch">
                                <label>usersUpdate</label>
                                <input type="checkbox" role="switch" class="form-check-input" name="editSecurityUsersUpdate">
                            </div>
                            <div class="form-group form-check form-switch">
                                <label>usersDelete</label>
                                <input type="checkbox" role="switch" class="form-check-input" name="editSecurityUsersDelete">
                            </div>
                            <div class="form-group form-check form-switch">
                                <label>userGroupsCreate</label>
                                <input type="checkbox" role="switch" class="form-check-input" name="editSecurityUserGroupsCreate">
                            </div>
                            <div class="form-group form-check form-switch">
                                <label>userGroupsRead</label>
                                <input type="checkbox" role="switch" class="form-check-input" name="editSecurityUserGroupsRead">
                            </div>
                            <div class="form-group form-check form-switch">
                                <label>userGroupsUpdate</label>
                                <input type="checkbox" role="switch" class="form-check-input" name="editSecurityUserGroupsUpdate">
                            </div>
                            <div class="form-group form-check form-switch">
                                <label>userGroupsDelete</label>
                                <input type="checkbox" role="switch" class="form-check-input" name="editSecurityUserGroupsDelete">
                            </div>
                            <div class="form-group form-check form-switch">
                                <label>UsersTreesCreate</label>
                                <input type="checkbox" role="switch" class="form-check-input" name="editSecurityUsersTreesCreate">
                            </div>
                            <div class="form-group form-check form-switch">
                                <label>UsersTreesRead</label>
                                <input type="checkbox" role="switch" class="form-check-input" name="editSecurityUsersTreesRead">
                            </div>
                            <div class="form-group form-check form-switch">
                                <label>UsersTreesUpdate</label>
                                <input type="checkbox" role="switch" class="form-check-input" name="editSecurityUsersTreesUpdate">
                            </div>
                            <div class="form-group form-check form-switch">
                                <label>UsersTreesDelete</label>
                                <input type="checkbox" role="switch" class="form-check-input" name="editSecurityUsersTreesDelete">
                            </div>
                            <div class="form-group form-check form-switch">
                                <label>treesCreate</label>
                                <input type="checkbox" role="switch" class="form-check-input" name="editSecurityTreesCreate">
                            </div>
                            <div class="form-group form-check form-switch">
                                <label>treesRead</label>
                                <input type="checkbox" role="switch" class="form-check-input" name="editSecurityTreesRead">
                            </div>
                            <div class="form-group form-check form-switch">
                                <label>treesUpdate</label>
                                <input type="checkbox" role="switch" class="form-check-input" name="editSecurityTreesUpdate">
                            </div>
                            <div class="form-group form-check form-switch">
                                <label>treesDelete</label>
                                <input type="checkbox" role="switch" class="form-check-input" name="editSecurityTreesDelete">
                            </div>
                            <div class="form-group form-check form-switch">
                                <label>treeTypeCreate</label>
                                <input type="checkbox" role="switch" class="form-check-input" name="editSecurityTreeTypeCreate">
                            </div>
                            <div class="form-group form-check form-switch">
                                <label>treeTypeRead</label>
                                <input type="checkbox" role="switch" class="form-check-input" name="editSecurityTreeTypeRead">
                            </div>
                            <div class="form-group form-check form-switch">
                                <label>treeTypeUpdate</label>
                                <input type="checkbox" role="switch" class="form-check-input" name="editSecurityTreeTypeUpdate">
                            </div>
                            <div class="form-group form-check form-switch">
                                <label>treeTypeDelete</label>
                                <input type="checkbox" role="switch" class="form-check-input" name="editSecurityTreeTypeDelete">
                            </div>
                            <div class="form-group form-check form-switch">
                                <label>treeImagesCreate</label>
                                <input type="checkbox" role="switch" class="form-check-input" name="editSecurityTreeImagesCreate">
                            </div>
                            <div class="form-group form-check form-switch">
                                <label>treeImagesRead</label>
                                <input type="checkbox" role="switch" class="form-check-input" name="editSecurityTreeImagesRead">
                            </div>
                            <div class="form-group form-check form-switch">
                                <label>treeImagesUpdate</label>
                                <input type="checkbox" role="switch" class="form-check-input" name="editSecurityTreeImagesUpdate">
                            </div>
                            <div class="form-group form-check form-switch">
                                <label>treeImagesDelete</label>
                                <input type="checkbox" role="switch" class="form-check-input" name="editSecurityTreeImagesDelete">
                            </div>

                            <!--
                            <div class="form-group form-check form-switch">
                                <label>SecurityCreate</label>
                                <input type="checkbox" role="switch" class="form-check-input" name="addSecurityCreate">
                            </div>
                            <div class="form-group form-check form-switch">
                                <label>SecurityRead</label>
                                <input type="checkbox" role="switch" class="form-check-input" name="addSecurityRead">
                            </div>
                            <div class="form-group form-check form-switch">
                                <label>SecurityUpdate</label>
                                <input type="checkbox" role="switch" class="form-check-input" name="addSecurityUpdate">
                            </div>
                            <div class="form-group form-check form-switch">
                                <label>SecurityDelete</label>
                                <input type="checkbox" role="switch" class="form-check-input" name="addSecurityDelete">
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
        <div id="deleteSecurityModal" class="modal fade" tabindex="-1" aria-labelledby="deleteSecurityModal-Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="deleteSecurity">
                        <div class="modal-header">
                            <h4 class="modal-title">Delete Security</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete this Security?</p>
                            <p class="text-warning"><small>This action cannot be undone.</small></p>
                            <input id="deleteSecurityId" name="deleteSecurityId" type="hidden" class="form-control">
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
        try{
            var table = $('#securitiesTable').DataTable({
                rowReorder: false,
                responsive: true,
                columnDefs: [ {
                    targets: [1],
                    orderable: false,
                }]
            });
        } catch (error){
            console.log(error);
        }


        // ajax to Add Security
        $('#addSecurity').submit(function (event) {
            event.preventDefault(); //prevent default action

            let formData = {
                'action': "AddSecurity",
                'data': $(this).serializeArray()
            };

            $.ajax({
                url: "<?php echo HOME_URL . '/admin/security';?>",
                dataType: "json",
                type: 'POST',
                data: formData,
                beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                    $('#loader').removeClass('hidden')
                },
                success: function (data) {
                    $("#addSecurityModal").modal('hide');

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

        // ajax to Edit Security
        $('#editSecurity').submit(function (event) {
            event.preventDefault(); //prevent default action

            //Ve se a data dos inputs mudou para formar so a data necessaria para o PATCH
            let formDataChanged = [];
            $('#editSecurity input').each(function() { //para cada input vai ver

                if($(this).is(":checked")){
                    let emptyArray = { name: "", value: "" };

                    emptyArray.name = $(this).attr('name');
                    emptyArray.value = $(this).val();

                    //console.log("checked " + emptyArray.name + " -> " + emptyArray.value)
                    formDataChanged.push(emptyArray);
                }

                if(!$(this).is(":checked") && $(this).attr('name') !== "editSecurityId" && $(this).val() !== "Save" ){
                    let emptyArray = { name: "", value: "" };

                    emptyArray.name = $(this).attr('name');
                    emptyArray.value = "off";

                    //console.log("unchecked " + emptyArray.name + " -> " + emptyArray.value)
                    formDataChanged.push(emptyArray);
                }

                if($(this).attr('name') === "editSecurityId" ) {
                    let emptyArray = { name: "", value: "" };

                    emptyArray.name = $(this).attr('name');
                    emptyArray.value = $(this).val();

                    //console.log(emptyArray.name + " -> " + emptyArray.value)
                    formDataChanged.push(emptyArray);
                }

            });

            let formData = {
                'action' : "UpdateSecurity",
                'data'   : formDataChanged
            };

            /*let formData = {
                'action' : "UpdateSecurity",
                'data'   : $(this).serializeArray()
            };*/

            $.ajax({
                url : "<?php echo HOME_URL . '/admin/security';?>",
                dataType: "json",
                type: 'POST',
                data : formData,
                beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                    $('#loader').removeClass('hidden')
                },
                success: function (data) {
                    $("#editSecurityModal").modal('hide');

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

        // ajax to get data to Modal Edit Security
        $('.edit').on('click', function(){

            let formData = {
                'action' : "GetSecurity",
                'data'   : $(this).attr('Id') //gets security id from edit button on table
            };

            $.ajax({
                url : "<?php echo HOME_URL . '/admin/security';?>",
                dataType: "json",
                type: 'POST',
                data : formData,
                beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                    $('#loader').removeClass('hidden')
                },
                success: function (data) {

                    $('[name="editSecurityId"]').val(data[0]['id']);

                    if (data[0]['homeLogin'] === 1) {
                        $('[name="editSecurityHomeLogin"]').attr('checked', true); } else { $('[name="editSecurityHomeLogin"]').attr('checked', false); }
                    if (data[0]['admLogin'] === 1) {
                        $('[name="editSecurityAdmLogin"]').attr('checked', true); } else { $('[name="editSecurityAdmLogin"]').attr('checked', false);}

                    if (data[0]['usersCreate'] === 1) {
                        $('[name="editSecurityUsersCreate"]').attr('checked', true); } else { $('[name="editSecurityUsersCreate"]').attr('checked', false);}
                    if (data[0]['usersRead'] === 1) {
                        $('[name="editSecurityUsersRead"]').attr('checked', true); } else { $('[name="editSecurityUsersRead"]').attr('checked', false);}
                    if (data[0]['usersUpdate'] === 1) {
                        $('[name="editSecurityUsersUpdate"]').attr('checked', true); } else { $('[name="editSecurityUsersUpdate"]').attr('checked', false);}
                    if (data[0]['usersDelete'] === 1) {
                        $('[name="editSecurityUsersDelete"]').attr('checked', true); } else { $('[name="editSecurityUsersDelete"]').attr('checked', false);}

                    if (data[0]['userGroupsCreate'] === 1) {
                        $('[name="editSecurityUserGroupsCreate"]').attr('checked', true); } else { $('[name="editSecurityUserGroupsCreate"]').attr('checked', false); }
                    if (data[0]['userGroupsRead'] === 1) {
                        $('[name="editSecurityUserGroupsRead"]').attr('checked', true); } else { $('[name="editSecurityUserGroupsRead"]').attr('checked', false); }
                    if (data[0]['userGroupsUpdate'] === 1) {
                        $('[name="editSecurityUserGroupsUpdate"]').attr('checked', true); } else { $('[name="editSecurityUserGroupsUpdate"]').attr('checked', false);}
                    if (data[0]['userGroupsDelete'] === 1) {
                        $('[name="editSecurityUserGroupsDelete"]').attr('checked', true); } else { $('[name="editSecurityUserGroupsDelete"]').attr('checked', false);}

                    if (data[0]['usersTreesCreate'] === 1) {
                        $('[name="editSecurityUsersTreesCreate"]').attr('checked', true); } else { $('[name="editSecurityUsersTreesCreate"]').attr('checked', false); }
                    if (data[0]['usersTreesRead'] === 1) {
                        $('[name="editSecurityUsersTreesRead"]').attr('checked', true); } else { $('[name="editSecurityUsersTreesRead"]').attr('checked', false); }
                    if (data[0]['usersTreesUpdate'] === 1) {
                        $('[name="editSecurityUsersTreesUpdate"]').attr('checked', true); } else { $('[name="editSecurityUsersTreesUpdate"]').attr('checked', false);}
                    if (data[0]['usersTreesDelete'] === 1) {
                        $('[name="editSecurityUsersTreesDelete"]').attr('checked', true); } else { $('[name="editSecurityUsersTreesDelete"]').attr('checked', false);}

                    if (data[0]['treesCreate'] === 1) {
                        $('[name="editSecurityTreesCreate"]').attr('checked', true); } else { $('[name="editSecurityTreesCreate"]').attr('checked', false);}
                    if (data[0]['treesRead'] === 1) {
                        $('[name="editSecurityTreesRead"]').attr('checked', true); } else { $('[name="editSecurityTreesRead"]').attr('checked', false); }
                    if (data[0]['treesUpdate'] === 1) {
                        $('[name="editSecurityTreesUpdate"]').attr('checked', true); } else { $('[name="editSecurityTreesUpdate"]').attr('checked', false);}
                    if (data[0]['treesDelete'] === 1) {
                        $('[name="editSecurityTreesDelete"]').attr('checked', true); } else { $('[name="editSecurityTreesDelete"]').attr('checked', false); }

                    if (data[0]['treeTypeCreate'] === 1) {
                        $('[name="editSecurityTreeTypeCreate"]').attr('checked', true); } else { $('[name="editSecurityTreeTypeCreate"]').attr('checked', false); }
                    if (data[0]['treeTypeRead'] === 1) {
                        $('[name="editSecurityTreeTypeRead"]').attr('checked', true); } else { $('[name="editSecurityTreeTypeRead"]').attr('checked', false); }
                    if (data[0]['treeTypeUpdate'] === 1) {
                        $('[name="editSecurityTreeTypeUpdate"]').attr('checked', true); } else { $('[name="editSecurityTreeTypeUpdate"]').attr('checked', false); }
                    if (data[0]['treeTypeDelete'] === 1) {
                        $('[name="editSecurityTreeTypeDelete"]').attr('checked', true); } else { $('[name="editSecurityTreeTypeDelete"]').attr('checked', false);}

                    if (data[0]['treeImagesCreate'] === 1) {
                        $('[name="editSecurityTreeImagesCreate"]').attr('checked', true); } else { $('[name="editSecurityTreeImagesCreate"]').attr('checked', false); }
                    if (data[0]['treeImagesRead'] === 1) {
                        $('[name="editSecurityTreeImagesRead"]').attr('checked', true); } else { $('[name="editSecurityTreeImagesRead"]').attr('checked', false);}
                    if (data[0]['treeImagesUpdate'] === 1) {
                        $('[name="editSecurityTreeImagesUpdate"]').attr('checked', true); } else { $('[name="editSecurityTreeImagesUpdate"]').attr('checked', false);}
                    if (data[0]['treeImagesDelete'] === 1) {
                        $('[name="editSecurityTreeImagesDelete"]').attr('checked', true); } else { $('[name="editSecurityTreeImagesDelete"]').attr('checked', false);}


                    //atribui atributo .data("lastValue") a cada input do form editTree
                    // para se poder comparar entre os dados anteriores e os current
                    /*$('#editSecurity input').each(function() {
                        $(this).data('lastValue', $(this).val());
                        //console.log($(this).attr("name") + " -> " + $(this).val())
                    });*/

                    $("#editSecurityModal").modal('show');

                },
                error: function (data) {
                    Swal.fire({
                        title: 'Error!',
                        text: data['message'],
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

        // ajax to Delete Security
        $('#deleteSecurity').submit(function(event){
            event.preventDefault(); //prevent default action

            let formData = {
                'action' : "DeleteSecurity",
                'data'   : $(this).serializeArray()
            };

            $.ajax({
                url : "<?php echo HOME_URL . '/admin/security';?>",
                dataType: "json",
                type: 'POST',
                data : formData,
                beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                    $('#loader').removeClass('hidden')
                },
                success: function (data) {
                    $("#deleteSecurityModal").modal('hide');

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

        // ajax to get data to Modal Delete Security
        $('.delete').on('click', function(){
            let $deleteID = $(this).attr('id');
            $('[name="deleteSecurityId"]').val($deleteID); //gets group id from id="" attribute on delete button from table
            $("#deleteSecurityModal").modal('show');

        });

    });
</script>