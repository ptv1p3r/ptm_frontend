

<!-- Edit Profile Modal HTML -->
<div id="editUserModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edite os seus dados</h4>

                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <form class="updateUser">
                    <div class="form-group">
                        <input id="editUserId" name="editUserId" type="hidden" class="form-control"
                               value="<?php echo $user["id"] ?>">
                    </div>

                    <div class="form-group">
                        <label>Nome:</label>
                        <input type="text" class="form-control" name="editUserName"
                               value="">
                    </div>

                    <div class="form-group">
                        <label>Entidade:</label>
                        <input type="text" class="form-control" name="editUserEntity" value="">

                    </div>

                    <div class="form-group">
                        <label>Morada:</label>
                        <input type="text" class="form-control" name="editUserAddress" value="">
                    </div>

                    <div class="form-group">
                        <label>Código-postal:</label>
                        <input type="text" class="form-control" name="editUserCodPost" value="">
                    </div>

                    <div class="form-group">
                        <label>Localidade:</label>
                        <input type="text" class="form-control" name="editUserLocality" value="">
                    </div>
                    <div class="form-group">
                        <label>País:</label>
                        <select class="form-control" id="editUserCountry" name="editUserCountry">
                            <?php foreach ($this->userdata['countryList'] as $key => $val) { ?>
                                <option value="<?php echo $val['id']; ?>" <?php echo ($val['id'] == $user["countryId"]) ? 'selected="selected"' : '' ?> > <?php echo $val['name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nif:</label>
                        <input type="text" class="form-control" name="editUserNif" value="">
                    </div>
                    <div class="form-group">
                        <label>Telefone:</label>
                        <input type="text" class="form-control" name="editUserMobile">
                    </div>
                    <div class="form-group">
                        <label>País:</label>
                        <select class="form-control" id="editUserGender" name="editUserGender">
                            <?php foreach ($this->userdata['genderList'] as $key => $val) { ?>
                                <option value="<?php echo $val['id']; ?>" <?php echo ($val['id'] == $user["genderId"]) ? 'selected="selected"' : '' ?> > <?php echo $val['name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Password:</label>
                        <input type="password" class="form-control" name="editUserPasswordAA">
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