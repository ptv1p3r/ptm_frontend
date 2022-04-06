<?php
/**
 * Created by PhpStorm.
 * User: V1p3r
 * Date: 17/10/2018
 * Time: 20:14
 */
?>
<?php if ( ! defined('ABSPATH')) exit; ?>
<div class="container">

    <div class="row  justify-content-center align-items-center" style="margin-top: 100px">
        <img src="../../Images/logo_black.png" alt="">
        <h1 class="text-light">Project Tree Management</h1>
    </div>

    <div class="row  justify-content-center align-items-center">
        <div class="col-lg-4">
            <div class="jumbotron" style="margin-top: 150px">
                <?php if (isset($_POST['validation']) && $_POST['validation'] == "failed") { ?>
                    <div class="alert alert-danger alert-dismissable" role="alert">
                        <a class="panel-close close" data-dismiss="alert">×</a>
                        <i class="fa fa-times-circle"></i> Invalid Username/Password!
                    </div>
                <?php } ?>

                <form action="<?php echo HOME_URI . '/admin/login/';?>" method="post">
                    <input name="user" type="text" class="form-control" placeholder="Username">
                    <br>
                    <input name="pass" type="password" class="form-control" placeholder="Password">
                    <br>
                    <input type="submit" name="submit" class="btn btn-success form-control" value="Login"/>
                </form>
            </div>
        </div>
    </div>
</div>