<?php
/**
 * Created by PhpStorm.
 * User: V1p3r
 * Date: 17/10/2018
 * Time: 20:14
 */
?>
<?php if (!defined('ABSPATH')) exit; ?>


<div id="wrapper">
    <!--New User Register Start-->
    <section class="wf100 p80">
        <div class="container">
            <div>
                <div class="col-lg-20">
                    <div>
                        <h3>Definições gerais de conta</h3>
                        <br>
                    </div>
                    <div>
                        <input data-toggle="modal" data-target="#editUserModal" type="submit"
                               class="edit profile-edit-btn"
                               name="btnAddMore" value="Editar perfil"/>
                    </div>
                    <div>
                        <!--Form Init-->
                        <br>
                        <div>
                        </div>
                        <ul>
                            <div class="col-md-18">
                                <?php if (!empty($this->userdata['userList'])) {
                                foreach ($this->userdata['userList'] as $key => $user) { ?>
                                <div class="tab-content profile-tab" id="myTabContent">
                                    <div class="tab-pane fade show active" id="home" role="tabpanel"
                                         aria-labelledby="home-tab">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Nome:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <p> <?php echo $user["name"] ?></p>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Entidade:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <p><?php echo $user["entity"] ?></p>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Morada:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <p><?php echo $user["address"] ?></p>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Código postal:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <p><?php echo $user["codPost"] ?></p>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Localidade:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <p><?php echo $user["locality"] ?></p>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>País:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <p><?php echo $user["countryId"] ?></p>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>NIF:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <p><?php echo $user["nif"] ?></p>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Telefone:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <p><?php echo $user["mobile"] ?></p>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Sexo:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <p><?php echo $user["genderId"] ?></p>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Data de nascimento:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <p><?php echo $user["dateBirth"] ?></p>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Email:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <p><?php echo $user["email"] ?></p>
                                            </div>
                                        </div>

                                        <!--                                            <div class="row">-->
                                        <!--                                                <div class="col-md-4">-->
                                        <!--                                                    <label>Password:</label>-->
                                        <!--                                                </div>-->
                                        <!--                                                <div class="col-md-8">-->
                                        <!--                                                    <p>-->
                                        <?php //echo $user["password"] ?><!--</p>-->
                                        <!--                                                </div>-->
                                        <!--                                            </div>-->

                                    </div>
                                    <?php }
                                    } ?>
                                </div>
                            </div>
                        </ul>
                        <!--Form End-->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--New User Register End-->
</div>


<!-- Edit Profile Modal HTML -->
<div id="editUserModal" class="modal fade" role="dialog">

    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edite os seus dados</h4>

                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>





            <div class="modal-body">
                <form id="updateUser">


                    <div class="form-group" >
                        <label>Email:</label>

                    </div>

                    <div class="form-group">
                        <label>Nome:</label>
                        <input type="text" class="form-control" name="editUserName">
                    </div>

                    <div class="form-group">
                        <label>Entidade:</label>
                        <input type="text" class="form-control" name="editUserEntity">
                    </div>

                    <div class="form-group">
                        <label>Morada:</label>
                        <input type="text" class="form-control" name="editUserAddress">
                    </div>

                    <div class="form-group">
                        <label>Código-postal:</label>
                        <input type="text" class="form-control" name="editUserCodPost">
                    </div>

                    <div class="form-group">
                        <label>Localidade:</label>
                        <input type="text" class="form-control" name="editUserLocality">
                    </div>
                    <div class="form-group">
                        <label>País:</label>
                        <select name="editUserCountry" id="editUserCountry"
                                class="form-control customDropdown">
                            <option value="" disabled selected>Selecione o País</option>
                            <?php if (!empty($this->userdata['countryList'])) {
                                foreach ($this->userdata['countryList'] as $key => $country) { ?>
                                    <option value="<?php echo $country['id'] ?>">
                                        <?php echo $country["name"] ?></option>
                                <?php }
                            } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nif:</label>
                        <input type="text" class="form-control" name="editUserNif">
                    </div>
                    <div class="form-group">
                        <label>Telefone:</label>
                        <input type="text" class="form-control" name="editUserMobile">
                    </div>
                    <div class="form-group">
                        <label>Sexo:</label>
                        <select name="editUserGender" id="addUserGender"
                                class="form-control customDropdown">
                            <option value="" disabled selected>Sexo</option>
                            <?php if (!empty($this->userdata['genderList'])) {
                                foreach ($this->userdata['genderList'] as $key => $gender) { ?>
                                    <option value="<?php echo $gender['id'] ?>">
                                        <?php echo $gender["name"] ?></option>
                                <?php }
                            } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Data de aniversário:</label>
                        <input type="date" class="form-control" name="editUserDateBirth">
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="submit" class="btn btn-info" value="Save">
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
</div>
<!-- End Edit Profile Modal HTML -->


<!--Script's section-->
<script>

    //// ajax to get data to Modal Edit User
    $('.edit').on('click', function () {
        let formData = {
            'action': "GetUser",
            'data': $(this).attr('email') //gets group id from id="" attribute on edit button from table
        };
        $.ajax({
            url: "<?php echo HOME_URL . '/home/userSettings';?>",
            dataType: "json",
            type: 'POST',
            data: formData,

            success: function (data) {

                //TODO Os dados chegam aqui, mas não aparecem

                $('[name="editUserName"]').val(data['userdata']['name']);
                $('[name="editUserEntity"]').val(data['userdata']['entity']);
                $('[name="editUserDateBirth"]').val(data['userdata']['dateBirth']);
                $('[name="editUserAddress"]').val(data['userdata']['address']);
                $('[name="editUserCodPost"]').val(data['userdata']['codPost']);

                //TODO ver como aparece os países
                $('[name="editUserGender"]').val(data['userdata']['genderId']);
                $('[name="editUserLocality"]').val(data['userdata']['locality']);
                $('[name="editUserMobile"]').val(data['userdata']['mobile']);
                $('[name="editUserNif"]').val(data['userdata']['nif']);

                //TODO ver como aparece os países
                $('[name="editUserCountry"]').val(data['userdata']['countryId']);


                // $('[name="editGroupDescription"]').val(data[0]['description']);
                // $('[name="editGroupSecurityId"]').val(data[0]['securityId']);

                // if (data[0]['active'] === 1) {
                //     $('[name="editGroupActive"]').attr('checked', true);
                // } else {
                //     $('[name="editGroupActive"]').attr('checked', false);
                // }

                // $("#editUserModal").modal('show');
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
            }
        });
    });

    // ajax to update modal data  Edit User
    $('#updateUser').submit(function (event) {
        event.preventDefault(); //prevent default action
        // let chk_status = $("#checkBtn").prop('checked');
        // if (chk_status) {
        let formData = {
            'action': "UpdateUser",
            'data': $(this).serializeArray()
        };
        $.ajax({
            url: "<?php echo HOME_URL . '/home/userSettings';?>",
            dataType: "json",
            type: 'POST',
            data: formData,
            success: function (data) {
                if (data.statusCode === 201) {
                    //mensagem de Success
                    Swal.fire({
                        title: 'Success!',
                        text: data.body.message,
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 2000,
                        didClose: () => {
                            //location.reload();
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
            }

        });
        // } else {
        //     alert('batatas');
        // }
    });


</script>
<!--Script's end section-->