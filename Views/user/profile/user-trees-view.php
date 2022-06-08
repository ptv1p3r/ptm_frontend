<?php
/**
 * Created by PhpStorm.
 * User: V1p3r
 * Date: 17/10/2018
 * Time: 20:14
 */
?>
<?php if (!defined('ABSPATH')) exit; ?>

<!--New user register Start-->
<section class="home-about wf100 p80">
    <div class="container">
        <div class="imageUserTree">
            <div class="col-md-6">
                <div id="fpro-slider" class="owl-carousel owl-theme">
                    <!--Tree Images Start-->
                    <div class="item">
                        <div class="f-product">
                            <img src="/Images/home/fpro1.jpg" alt="">
                            <!--                            <div class="fp-text">-->
                            <!--                                <h6><a href="#">Amendoeira</a></h6>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--New user register End teste-->

<!--Section tree details Start-->
<section>
    <div class="wf100 p80">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-2">
                        <h5>A minha árvore:</h5>
                        <h2>  <?php echo $_SESSION['userdata']['userTreeToShow']['name'] ?> </h2>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-6">
                            <div class="eco-box">
                                <span class="econ-icon"><i class="fa fa-fingerprint"></i></span>
                                <h5> Id da árvore: </h5>
                                <p> <?php echo $_SESSION['userdata']['userTreeToShow']['id'] ?> </p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="eco-box">
                                <span class="econ-icon"><i class="fa fa-tree"></i> </span>
                                <h5> Nome comum:</h5>
                                <p><?php echo $_SESSION['userdata']['userTreeToShow']['nameCommon'] ?></p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="eco-box">
                                <span class="econ-icon"><i class="fa fa-map-pin"></i></span>
                                <h5> Latitude: </h5>
                                <p><?php echo $_SESSION['userdata']['userTreeToShow']['lat'] ?></p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="eco-box">
                                <span class="econ-icon"><i class="fa fa-map-pin"></i></span>
                                <h5> Longitude: </h5>
                                <p><?php echo $_SESSION['userdata']['userTreeToShow']['lng'] ?></p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="eco-box">
                                <span class="econ-icon"><i class="fa fa-book"></i></i></span>
                                <h5> Descrição: </h5>
                                <p><?php echo $_SESSION['userdata']['userTreeToShow']['description'] ?></p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="eco-box">
                                <span class="econ-icon"><i class="fa fa-newspaper"></i></span>
                                <h5> Observações: </h5>
                                <p><?php echo $_SESSION['userdata']['userTreeToShow']['observations'] ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Section tree details END-->

<!--Section tree Intrevation Sart-->

<section class="home-about wf100 p80">
    <div class="container">
        <h5>Intervenções:</h5>
        <table class="table">
            <thead>
            <tr>
                <th>Id</th>
                <th>Assunto</th>
                <th>Descrição</th>
                <th>Observações</th>
                <th>Data intrevenção</th>
            </tr>
            </thead>
            <?php if (!empty($this->securitydata['securitysList']['data'])) {
            foreach ($this->securitydata['securitysList']['data'] as $key => $security) { ?>
            <tbody>
            <tr>
                <td><?php echo $security["homeLogin"] ?></td>
                <td><?php echo $security["admLogin"] ?></td>
                <td><?php echo $security["usersCreate"] ?></td>
                <td><?php echo $security["usersRead"] ?></td>
                <td><?php echo $security["usersUpdate"] ?></td>
            </tr>
            </tbody>
            <?php }
            } else { ?>
                <tbody>
                <tr>
                </tr>
                </tbody>
            <?php } ?>
        </table>

    </div>
</section>










