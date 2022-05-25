
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
                                    <i class="fas fa-plus-circle"></i><span>Add New Security</span>
                                </a>
                            </div>
                            <div class="card-body">
                                <table id="securitiesTable" class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>homeLogin</th>
                                            <th>admLogin</th>
                                            <th>usersCreate</th>
                                            <th>usersRead</th>
                                            <th>usersUpdate</th>
                                            <th>usersDelete</th>
                                            <th>usersGroupsCreate</th>
                                            <th>usersGroupsRead</th>
                                            <th>usersGroupsUpdate</th>
                                            <th>usersGroupsDelete</th>
                                            <th>treesCreate</th>
                                            <th>treesRead</th>
                                            <th>treesUpdate</th>
                                            <th>treesDelete</th>
                                            <th>treesTypeCreate</th>
                                            <th>treesTypeRead</th>
                                            <th>treesTypeUpdate</th>
                                            <th>treesTypeDelete</th>
                                            <th>treesImagesCreate</th>
                                            <th>treesImagesRead</th>
                                            <th>treesImagesUpdate</th>
                                            <th>treesImagesDelete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php if (!empty($this->securitydata['securitysList']['data'])) {
                                        foreach ($this->securitydata['securitysList']['data'] as $key => $security) { ?>
                                            <tr>
                                                <td><?php echo $security["homeLogin"] ?></td>
                                                <td><?php echo $security["admLogin"] ?></td>
                                                <td><?php echo $security["usersCreate"] ?></td>
                                                <td><?php echo $security["usersRead"] ?></td>
                                                <td><?php echo $security["usersUpdate"] ?></td>
                                                <td><?php echo $security["usersDelete"] ?></td>
                                                <td><?php echo $security["usersGroupsCreate"] ?></td>
                                                <td><?php echo $security["usersGroupsRead"] ?></td>
                                                <td><?php echo $security["usersGroupsUpdate"] ?></td>
                                                <td><?php echo $security["usersGroupsDelete"] ?></td>
                                                <td><?php echo $security["treesCreate"] ?></td>
                                                <td><?php echo $security["treesRead"] ?></td>
                                                <td><?php echo $security["treesUpdate"] ?></td>
                                                <td><?php echo $security["treesDelete"] ?></td>
                                                <td><?php echo $security["treesTypeCreate"] ?></td>
                                                <td><?php echo $security["treesTypeRead"] ?></td>
                                                <td><?php echo $security["treesTypeUpdate"] ?></td>
                                                <td><?php echo $security["treesTypeDelete"] ?></td>
                                                <td><?php echo $security["treesImagesCreate"] ?></td>
                                                <td><?php echo $security["treesImagesRead"] ?></td>
                                                <td><?php echo $security["treesImagesUpdate"] ?></td>
                                                <td><?php echo $security["treesImagesDelete"] ?></td>

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
        <div id="addSecurityModal" class="modal fade" tabindex="-1" aria-labelledby="addTreeModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="addSecurity">
                        <div class="modal-header">
                            <h4 class="modal-title">Add Security</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>homeLogin</label>
                                <input type="checkbox" class="form-control form-check-input" name="addSecurityHomeLogin">
                            </div>
                            <div class="form-group">
                                <label>admLogin</label>
                                <input type="checkbox" class="form-control form-check-input" name="addSecurityAdmLogin">
                            </div>
                            <div class="form-group">
                                <label>usersCreate</label>
                                <input type="checkbox" class="form-control form-check-input" name="addSecurityUsersCreate">
                            </div>
                            <div class="form-group">
                                <label>usersRead</label>
                                <input type="checkbox" class="form-control form-check-input" name="addSecurityUsersRead">
                            </div>
                            <div class="form-group">
                                <label>usersUpdate</label>
                                <input type="checkbox" class="form-control form-check-input" name="addSecurityUsersUpdate">
                            </div>
                            <div class="form-group">
                                <label>usersDelete</label>
                                <input type="checkbox" class="form-control form-check-input" name="addSecurityUsersDelete">
                            </div>
                            <div class="form-group">
                                <label>usersGroupsCreate</label>
                                <input type="checkbox" class="form-control form-check-input" name="addSecurityUsersGroupsCreate">
                            </div>
                            <div class="form-group">
                                <label>usersGroupsRead</label>
                                <input type="checkbox" class="form-control form-check-input" name="addSecurityUsersGroupsRead">
                            </div>
                            <div class="form-group">
                                <label>usersGroupsUpdate</label>
                                <input type="checkbox" class="form-control form-check-input" name="addSecurityUsersGroupsUpdate">
                            </div>
                            <div class="form-group">
                                <label>usersGroupsDelete</label>
                                <input type="checkbox" class="form-control form-check-input" name="addSecurityUsersGroupsDelete">
                            </div>
                            <div class="form-group">
                                <label>treesCreate</label>
                                <input type="checkbox" class="form-control form-check-input" name="addSecurityTreesCreate">
                            </div>
                            <div class="form-group">
                                <label>treesRead</label>
                                <input type="checkbox" class="form-control form-check-input" name="addSecurityTreesRead">
                            </div>
                            <div class="form-group">
                                <label>treesUpdate</label>
                                <input type="checkbox" class="form-control form-check-input" name="addSecurityTreesUpdate">
                            </div>
                            <div class="form-group">
                                <label>treesDelete</label>
                                <input type="checkbox" class="form-control form-check-input" name="addSecurityTreesDelete">
                            </div>
                            <div class="form-group">
                                <label>treesTypeCreate</label>
                                <input type="checkbox" class="form-control form-check-input" name="addSecurityTreesTypeCreate">
                            </div>
                            <div class="form-group">
                                <label>treesTypeRead</label>
                                <input type="checkbox" class="form-control form-check-input" name="addSecurityTreesTypeRead">
                            </div>
                            <div class="form-group">
                                <label>treesTypeUpdate</label>
                                <input type="checkbox" class="form-control form-check-input" name="addSecurityTreesTypeUpdate">
                            </div>
                            <div class="form-group">
                                <label>treesTypeDelete</label>
                                <input type="checkbox" class="form-control form-check-input" name="addSecurityTreesTypeDelete">
                            </div>
                            <div class="form-group">
                                <label>treesImagesCreate</label>
                                <input type="checkbox" class="form-control form-check-input" name="addSecurityTreesImagesCreate">
                            </div>
                            <div class="form-group">
                                <label>treesImagesRead</label>
                                <input type="checkbox" class="form-control form-check-input" name="addSecurityTreesImagesRead">
                            </div>
                            <div class="form-group">
                                <label>treesImagesUpdate</label>
                                <input type="checkbox" class="form-control form-check-input" name="addSecurityTreesImagesUpdate">
                            </div>
                            <div class="form-group">
                                <label>treesImagesDelete</label>
                                <input type="checkbox" class="form-control form-check-input" name="addSecurityTreesImagesDelete">
                            </div>
                            <div class="form-group">
                                <label>SecurityCreate</label>
                                <input type="checkbox" class="form-control form-check-input" name="addSecurityCreate">
                            </div>
                            <div class="form-group">
                                <label>SecurityRead</label>
                                <input type="checkbox" class="form-control form-check-input" name="addSecurityRead">
                            </div>
                            <div class="form-group">
                                <label>SecurityUpdate</label>
                                <input type="checkbox" class="form-control form-check-input" name="addSecurityUpdate">
                            </div>
                            <div class="form-group">
                                <label>SecurityDelete</label>
                                <input type="checkbox" class="form-control form-check-input" name="addSecurityDelete">
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
        <div id="editSecurityModal" class="modal fade" tabindex="-1" aria-labelledby="addTreeModalLabel" aria-hidden="true">
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
                            <div class="form-group">
                                <label>homeLogin</label>
                                <input type="checkbox" class="form-control form-check-input" name="editSecurityHomeLogin">
                            </div>
                            <div class="form-group">
                                <label>admLogin</label>
                                <input type="checkbox" class="form-control form-check-input" name="editSecurityAdmLogin">
                            </div>
                            <div class="form-group">
                                <label>usersCreate</label>
                                <input type="checkbox" class="form-control form-check-input" name="editSecurityUsersCreate">
                            </div>
                            <div class="form-group">
                                <label>usersRead</label>
                                <input type="checkbox" class="form-control form-check-input" name="editSecurityUsersRead">
                            </div>
                            <div class="form-group">
                                <label>usersUpdate</label>
                                <input type="checkbox" class="form-control form-check-input" name="editSecurityUsersUpdate">
                            </div>
                            <div class="form-group">
                                <label>usersDelete</label>
                                <input type="checkbox" class="form-control form-check-input" name="editSecurityUsersDelete">
                            </div>
                            <div class="form-group">
                                <label>usersGroupsCreate</label>
                                <input type="checkbox" class="form-control form-check-input" name="editSecurityUsersGroupsCreate">
                            </div>
                            <div class="form-group">
                                <label>usersGroupsRead</label>
                                <input type="checkbox" class="form-control form-check-input" name="editSecurityUsersGroupsRead">
                            </div>
                            <div class="form-group">
                                <label>usersGroupsUpdate</label>
                                <input type="checkbox" class="form-control form-check-input" name="editSecurityUsersGroupsUpdate">
                            </div>
                            <div class="form-group">
                                <label>usersGroupsDelete</label>
                                <input type="checkbox" class="form-control form-check-input" name="editSecurityUsersGroupsDelete">
                            </div>
                            <div class="form-group">
                                <label>treesCreate</label>
                                <input type="checkbox" class="form-control form-check-input" name="editSecurityTreesCreate">
                            </div>
                            <div class="form-group">
                                <label>treesRead</label>
                                <input type="checkbox" class="form-control form-check-input" name="editSecurityTreesRead">
                            </div>
                            <div class="form-group">
                                <label>treesUpdate</label>
                                <input type="checkbox" class="form-control form-check-input" name="editSecurityTreesUpdate">
                            </div>
                            <div class="form-group">
                                <label>treesDelete</label>
                                <input type="checkbox" class="form-control form-check-input" name="editSecurityTreesDelete">
                            </div>
                            <div class="form-group">
                                <label>treesTypeCreate</label>
                                <input type="checkbox" class="form-control form-check-input" name="editSecurityTreesTypeCreate">
                            </div>
                            <div class="form-group">
                                <label>treesTypeRead</label>
                                <input type="checkbox" class="form-control form-check-input" name="editSecurityTreesTypeRead">
                            </div>
                            <div class="form-group">
                                <label>treesTypeUpdate</label>
                                <input type="checkbox" class="form-control form-check-input" name="editSecurityTreesTypeUpdate">
                            </div>
                            <div class="form-group">
                                <label>treesTypeDelete</label>
                                <input type="checkbox" class="form-control form-check-input" name="editSecurityTreesTypeDelete">
                            </div>
                            <div class="form-group">
                                <label>treesImagesCreate</label>
                                <input type="checkbox" class="form-control form-check-input" name="editSecurityTreesImagesCreate">
                            </div>
                            <div class="form-group">
                                <label>treesImagesRead</label>
                                <input type="checkbox" class="form-control form-check-input" name="editSecurityTreesImagesRead">
                            </div>
                            <div class="form-group">
                                <label>treesImagesUpdate</label>
                                <input type="checkbox" class="form-control form-check-input" name="editSecurityTreesImagesUpdate">
                            </div>
                            <div class="form-group">
                                <label>treesImagesDelete</label>
                                <input type="checkbox" class="form-control form-check-input" name="editSecurityTreesImagesDelete">
                            </div>
                            <div class="form-group">
                                <label>SecurityCreate</label>
                                <input type="checkbox" class="form-control form-check-input" name="addSecurityCreate">
                            </div>
                            <div class="form-group">
                                <label>SecurityRead</label>
                                <input type="checkbox" class="form-control form-check-input" name="addSecurityRead">
                            </div>
                            <div class="form-group">
                                <label>SecurityUpdate</label>
                                <input type="checkbox" class="form-control form-check-input" name="addSecurityUpdate">
                            </div>
                            <div class="form-group">
                                <label>SecurityDelete</label>
                                <input type="checkbox" class="form-control form-check-input" name="addSecurityDelete">
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
        <div id="deleteSecurityModal" class="modal fade" tabindex="-1" aria-labelledby="addTreeModalLabel" aria-hidden="true">
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
        try {
            $('#securitiesTable').DataTable({
                rowReorder: false,
                responsive: true
            });
        } catch (error) {
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

            let formData = {
                'action' : "UpdateSecurity",
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
                    if (data[0]['usersGroupsCreate'] === 1) {
                        $('[name="editSecurityUsersGroupsCreate"]').attr('checked', true); } else { $('[name="editSecurityUsersGroupsCreate"]').attr('checked', false); }
                    if (data[0]['usersGroupsRead'] === 1) {
                        $('[name="editSecurityUsersGroupsRead"]').attr('checked', true); } else { $('[name="editSecurityUsersGroupsRead"]').attr('checked', false); }
                    if (data[0]['usersGroupsUpdate'] === 1) {
                        $('[name="editSecurityUsersGroupsUpdate"]').attr('checked', true); } else { $('[name="editSecurityUsersGroupsUpdate"]').attr('checked', false);}
                    if (data[0]['usersGroupsDelete'] === 1) {
                        $('[name="editSecurityUsersGroupsDelete"]').attr('checked', true); } else { $('[name="editSecurityUsersGroupsDelete"]').attr('checked', false);}
                    if (data[0]['treesCreate'] === 1) {
                        $('[name="editSecurityTreesCreate"]').attr('checked', true); } else { $('[name="editSecurityTreesCreate"]').attr('checked', false);}
                    if (data[0]['treesRead'] === 1) {
                        $('[name="editSecurityTreesRead"]').attr('checked', true); } else { $('[name="editSecurityTreesRead"]').attr('checked', false); }
                    if (data[0]['treesUpdate'] === 1) {
                        $('[name="editSecurityTreesUpdate"]').attr('checked', true); } else { $('[name="editSecurityTreesUpdate"]').attr('checked', false);}
                    if (data[0]['treesDelete'] === 1) {
                        $('[name="editSecurityTreesDelete"]').attr('checked', true); } else { $('[name="editSecurityTreesDelete"]').attr('checked', false); }
                    if (data[0]['treesTypeCreate'] === 1) {
                        $('[name="editSecurityTreesTypeCreate"]').attr('checked', true); } else { $('[name="editSecurityTreesTypeCreate"]').attr('checked', false); }
                    if (data[0]['treesTypeRead'] === 1) {
                        $('[name="editSecurityTreesTypeRead"]').attr('checked', true); } else { $('[name="editSecurityTreesTypeRead"]').attr('checked', false); }
                    if (data[0]['treesTypeUpdate'] === 1) {
                        $('[name="editSecurityTreesTypeUpdate"]').attr('checked', true); } else { $('[name="editSecurityTreesTypeUpdate"]').attr('checked', false); }
                    if (data[0]['treesTypeDelete'] === 1) {
                        $('[name="editSecurityTreesTypeDelete"]').attr('checked', true); } else { $('[name="editSecurityTreesTypeDelete"]').attr('checked', false);}
                    if (data[0]['treesImagesCreate'] === 1) {
                        $('[name="editSecurityTreesImagesCreate"]').attr('checked', true); } else { $('[name="editSecurityTreesImagesCreate"]').attr('checked', false); }
                    if (data[0]['treesImagesRead'] === 1) {
                        $('[name="editSecurityTreesImagesRead"]').attr('checked', true); } else { $('[name="editSecurityTreesImagesRead"]').attr('checked', false);}
                    if (data[0]['treesImagesUpdate'] === 1) {
                        $('[name="editSecurityTreesImagesUpdate"]').attr('checked', true); } else { $('[name="editSecurityTreesImagesUpdate"]').attr('checked', false);}
                    if (data[0]['treesImagesDelete'] === 1) {
                        $('[name="editSecurityTreesImagesDelete"]').attr('checked', true); } else { $('[name="editSecurityTreesImagesDelete"]').attr('checked', false);}


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