<?php
/**
 * Created by PhpStorm.
 * User: V1p3r
 * Date: 17/10/2018
 * Time: 20:10
 */
?>
<?php if (!defined('ABSPATH')) exit; ?>


<!-- Top Rated
<div class="container-fluid">
    <div class="text-light">
        <h1>Download Realptm: HD smallest size</h1>
    </div>
</div>

<div class="container-fluid">
    <p class="text-light text-center" style="font-size:160%;"><span class="fas fa-heart" style="color: green;"></span> TOP RATED</p>
    <div class="row " style="margin-bottom: 10%;">
        <?php //foreach ($ptmsTopRated as $ptm) { ?>
            <div class="card" style="margin:10px auto;width: 200px;height: 300px">
                <a class="card-link" href="<?php //echo HOME_URI . '/detail/view/' . $ptm["movid"];?>">
                    <img class="card-img-top" src="<?php //echo $ptm["poster"]; ?>" alt="<?php //echo $ptm["title"]; ?>">
                </a>
                <div class="card-body">
                    <h5 class="card-title text-white"><?php //echo $ptm["title"]; ?></h5>
                    <p class="card-text text-muted"><?php //echo $ptm["year"]; ?></p>
                    <a href="<?php // echo HOME_URI . '/detail/view/' . $ptm["movid"];?>" class="btn btn-success">Details</a>
                </div>
            </div>
         <?php //} ?>
    </div>
</div>
 Top Downloaded
<div class="container-fluid">
    <p class="text-light text-center" style="font-size:160%;"><span class="fas fa-star" style="color: orange;"></span> TOP DOWNLOADED</p>
    <div class="row" style="margin-bottom: 10%;">
        <?php //foreach ($ptmsTopDownloaded as $ptm) { ?>
            <div class="card" style="margin:10px auto;width: 200px;height: 300px">
                <a href="<?php //echo HOME_URI . '/detail/view/' . $ptm["movid"];?>">
                    <img class="card-img-top" src="<?php //echo $ptm["poster"]; ?>" alt="<?php //echo $ptm["title"]; ?>">
                </a>
                <div class="card-body" >
                    <h5 class="card-title text-white"><?php //echo $ptm["title"]; ?></h5>
                    <p class="card-text text-muted"><?php //echo $ptm["year"]; ?></p>
                    <a href="<?php //echo HOME_URI . '/detail/view/' . $ptm["movid"];?>" class="btn btn-success">Details</a>
                </div>
            </div>
        <?php // } ?>
    </div>
</div>
 Last Added
<div class="container-fluid">
    <p class="text-light text-center" style="font-size:160%;"><span class="fas fa-clock" ></span> LAST ADDED</p>
    <div class="row" style="margin-bottom: 10%;">
        <?php //foreach ($ptmsLastAdded as $ptm) { ?>
            <div class="card" style="margin:10px auto;width: 200px;height: 300px">
                <a href="<?php // echo HOME_URI . '/detail/view/' . $ptm["movid"];?>">
                    <img class="card-img-top" src="<?php //echo $ptm["poster"]; ?>" alt="<?php //echo $ptm["title"]; ?>">
                </a>
                <div class="card-body">
                    <h5 class="card-title text-white"><?php //echo $ptm["title"]; ?></h5>
                    <p class="card-text text-muted"><?php // echo $ptm["year"]; ?></p>
                    <a href="<?php //echo HOME_URI . '/detail/view/' . $ptm["movid"];?>" class="btn btn-success">Details</a>
                </div>
            </div>
        <?php // } ?>
    </div>
</div>
-->

<!--Slider Start-->
<section id="home-slider" class="owl-carousel owl-theme wf100">
    <div class="item">
        <div class="slider-caption h2slider">
            <div class="container">
                <strong>Ajude a natureza<span> & </span></strong>
                <p></p>
                <h1>Adote uma árvore</h1>
                <p>A ajuda de todos é <strong>importante</strong></p>
                <a href="#" class="active">Descubra mais</a> <a href="#">Junte-se já</a>
            </div>
        </div>
        <img src="/Images/home/h2-slide1.jpg" alt="">
    </div>

    <div class="item">
        <div class="slider-caption h2slider">
            <div class="container">
                <strong>Junte-se a nós <span> </span> </strong>
                <h1>Seja patrocionador</h1>
                <p></p>
                <!--                <p>A ajuda de todos é <strong>importante</strong> for us...</p>-->
                <a href="#" class="active">Descubra mais</a> <a href="#">Junte-se já</a>
            </div>
        </div>
        <img src="/Images/home/h2-slide2.jpg" alt="">
    </div>
    <div class="item">
        <div class="slider-caption h2slider">
            <div class="container">
                <strong>Ajude a floresta <span> </span> </strong>
                <h1>Seja patrocionador</h1>
                <p></p>
                <p>A ajuda de todos é <strong>importante</strong></p>
                <a href="#" class="active">Descubra mais</a> <a href="#">Junte-se já</a>
            </div>
        </div>
        <img src="/Images/home/h2-slide3.jpg" alt="">
    </div>

    <div class="item">
        <div class="slider-caption h2slider">
            <div class="container">
                <strong>Salve a nossa serra <span> & seja nosso</span> patrocinador</strong>
                <h1>Plante uma árvore</h1>
                <p>Ajudar é importante <strong></strong></p>
                <a href="#" class="active">Descubra mais</a> <a href="#">Junte-se já</a>
            </div>
        </div>
        <img src="/Images/home/h2-slide4.jpg" alt="">
    </div>
</section>
<!--Slider End-->
<!--Service Area Start-->
<section class="services-area wf100">
    <div class="container">
        <ul>
            <!--box  start-->
            <li>
                <div class="sinfo">
                    <img src="/Images/home/sericon1.png" alt="">
                    <h6>Sustentabilidade</h6>
                    <p>Waste Management</p>
                </div>
            </li>
            <!--box  end-->
            <!--box  start-->
            <li>
                <div class="sinfo">
                    <img src="/Images/home/sericon2.png" alt="">
                    <h6>Valorização dos aglomerados rurais</h6>
                    <p>Polar, Prevailing, Tropical</p>
                </div>
            </li>
            <!--box  end-->
            <!--box  start-->
            <li>
                <div class="sinfo">
                    <img src="/Images/home/sericon3.png" alt="">
                    <h6>Proteção dos eco-sistemas</h6>
                    <p>Save Water Resources</p>
                </div>
            </li>
            <!--box  end-->
            <!--box  start-->
            <li class="active">
                <div class="sinfo">
                    <img src="/Images/home/sericon4.png" alt="">
                    <h6>Reflosteração</h6>
                    <p>Save Natural Engery</p>
                </div>
            </li>
            <!--box  end-->
            <!--box  start-->
            <li>
                <div class="sinfo">
                    <img src="/Images/home/sericon5.png" alt="">
                    <h6>Alterações climáticas</h6>
                    <p>Make Plants Alive for Life</p>
                </div>
            </li>
            <!--box  end-->
        </ul>
    </div>
</section>
<!--Service Area End-->
<!--About Section Start-->
<section class="home2-about wf100 p100 gallery">
    <div class="container">
        <div class="row">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Monchique</li>
                </ol>
            </nav>

            <div class="col-md-12">

                <!--Map area div-->
                <div id="map"></div>

            </div>


        </div>
        <div class="col-md-12">
            <div class="h2-about-txt">
                <h3>Sobre o iniciativa</h3>
                <p></p>
                <!--                    <h2>Eco-friendly products can be made from scratch.</h2>-->
                <p> Para a melhoria da qualidade de vida dos habitantes da nossa serra, ao mesmo tempo que se contribui
                    para o aumento da floresta e com isso, aumentar a resiliência dos ecossistemas, espécies e habitats
                    aos efeitos das alterações climáticas. </p>
                <!--                    <a class="aboutus" href="#">More About us</a>-->
            </div>
        </div>


    </div>
    <div class="home-facts counter pt80">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-sm-6 col-md-3">
                    <div class="counter-box">
                        <p class="counter-count">89000</p>
                        <p class="ctxt">Árvores plantadas</p>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-md-3">
                    <div class="counter-box">
                        <p class="counter-count">79000</p>
                        <p class="ctxt">Solar Panels in 2017</p>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-md-3">
                    <div class="counter-box">
                        <p class="counter-count">69000</p>
                        <p class="ctxt">Wildlife Saved</p>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-md-3">
                    <div class="counter-box">
                        <p class="counter-count">59000</p>
                        <p class="ctxt">Served Water Gallons</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--About Section End-->
<!--Urgent Causes Start-->
<section class="urgent-causes wf100 p80">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="section-title-2 white">
                    <h5>Uma causa nobre</h5>
                    <h2>Ajude a reflorestar a nossa serra</h2>
                </div>
                <!--                <p> We need your support and help to Stop Globar Warning. Few generations ago it to seemed like the-->
                <!--                    world’s resources were infinite, and the people needed only. </p>-->
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="55" aria-valuemin="0"
                         aria-valuemax="100"></div>
                </div>
                <ul class="funds">
                    <li class="text-left"><strong>73%</strong> Funded</li>
                    <li class="text-center"><strong>$948.00</strong> Raised</li>
                    <li class="text-right"><strong>$1750.00</strong> Required</li>
                </ul>
            </div>


            <div class="col-md-6">
                <div class="donation-amount">
                    <h5>Doação</h5>
                    <form>
                        <ul class="radio-boxes">
                            <li>
                                <div class="radio custom">
                                    <input name="donation" id="d1" type="radio" class="css-radio">
                                    <label for="d1" class="css-label">€ 2.5</label>

                                </div>
                            </li>

<!--                            <li>-->
<!--                                <div class="radio custom">-->
<!--                                    <input name="donation" id="d2" type="radio" class="css-radio">-->
<!--                                    <label for="d2" class="css-label">€20</label>-->
<!--                                </div>-->
<!--                            </li>-->

                            <?php
                            //                            $_SESSION["donationVal"] = $("input[type='radio'][name='rate']:checked").val();;
                            $_SESSION["donationVal"] = '2.5';
                            ?>

                            <?php if ($this->logged_in) { ?>

                            <li class="form-submit">
                                <button  type="submit" disabled="disabled">
                                    Faça a sua adoção
                                </button>
                            <li><a href="<?php echo HOME_URL . '/home/adoption'; ?>">Home</a></li>
                            </li>

                    <?php }
                    else { ?>

                        <!--                                Forçar a fazer o registo e login dispara um modal a pedir para registar-->
                        <li class="form-submit">
                            <button class="login-reg"><a href="" data-toggle="modal" data-target="#loginModal"
                                                         type="submit">Faça a sua adoção</button>
                        </li>

                    <?php } ?>
                        </ul>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Urgent Causes End-->
<!--Current Projects Start-->
<section class="wf100 p80 current-projects">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="section-title-2">
                    <h5>Faça uma escolha sensata</h5>
                    <h2>Adote uma árvore</h2>
                </div>
            </div>
            <!--            <div class="col-lg-6">-->
            <!--                <ul class="nav" id="myTab" role="tablist">-->
            <!--                    <li class="nav-item"><a class="nav-link active" id="wildlife-tab" data-toggle="tab" href="#wildlife"-->
            <!--                                            role="tab" aria-controls="wildlife-tab" aria-selected="true">Wildlife</a>-->
            <!--                    </li>-->
            <!--                    <li class="nav-item"><a class="nav-link" id="water-tab" data-toggle="tab" href="#water" role="tab"-->
            <!--                                            aria-controls="water-tab" aria-selected="false">Water Resources</a></li>-->
            <!--                    <li class="nav-item"><a class="nav-link" id="solar-tab" data-toggle="tab" href="#solar" role="tab"-->
            <!--                                            aria-controls="solar-tab" aria-selected="false">Solar Energy</a></li>-->
            <!--                    <li class="nav-item"><a class="nav-link" id="recycling-tab" data-toggle="tab" href="#recycling"-->
            <!--                                            role="tab" aria-controls="recycling-tab" aria-selected="false">Recycling</a>-->
            <!--                    </li>-->
            <!--                </ul>-->
            <!--            </div>-->
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tab-content" id="myTabContent">
                    <!--WildLife Slider Start-->
                    <div class="tab-pane fade show active" id="wildlife" role="tabpanel" aria-labelledby="wildlife-tab">
                        <div class="cpro-slider owl-carousel owl-theme">
                            <!--Pro Box-->
                            <div class="item">
                                <div class="pro-box">
                                    <img src="/Images/home/current-pro1.jpg" alt="">
                                    <h5>Sobreiro</h5>
                                    <div class="pro-hover">
                                        <h6>Sobreiro</h6>
                                        <p>Descubra mais sobre esta árvore!</p>
                                        <a href="#">Clique aqui</a>
                                    </div>
                                </div>
                            </div>
                            <!--Pro Box End-->
                            <!--Pro Box-->
                            <div class="item">
                                <div class="pro-box">
                                    <img src="/Images/home/current-pro2.jpg" alt="">
                                    <h5>Recycling & Waste Management</h5>
                                    <div class="pro-hover">
                                        <h6>Recycling & Waste Management</h6>
                                        <p>We are working over 20 years on Waste Management & Material Recycling
                                            Projects.</p>
                                        <a href="#">Read More</a>
                                    </div>
                                </div>
                            </div>
                            <!--Pro Box End-->
                            <!--Pro Box-->
                            <div class="item">
                                <div class="pro-box">
                                    <img src="/Images/home/current-pro3.jpg" alt="">
                                    <h5>Solar & Wind
                                        Energy
                                    </h5>
                                    <div class="pro-hover">
                                        <h6>Solar & Wind
                                            Energy
                                        </h6>
                                        <p>We are working over 20 years on Waste Management & Material Recycling
                                            Projects.</p>
                                        <a href="#">Read More</a>
                                    </div>
                                </div>
                            </div>
                            <!--                            Pro Box End-->
                            <!--                            Pro Box-->
                            <div class="item">
                                <div class="pro-box">
                                    <img src="/Images/home/current-pro4.jpg" alt="">
                                    <h5>Saving Wildlife
                                        & their Cubs
                                    </h5>
                                    <div class="pro-hover">
                                        <h6>Saving Wildlife
                                            & their Cubs
                                        </h6>
                                        <p>We are working over 20 years on Waste Management & Material Recycling
                                            Projects.</p>
                                        <a href="#">Read More</a>
                                    </div>
                                </div>
                            </div>
                            <!--Pro Box End-->
                            <!--Pro Box-->
                            <div class="item">
                                <div class="pro-box">
                                    <img src="/Images/home/current-pro5.jpg" alt="">
                                    <h5>Forest & Tree Planting</h5>
                                    <div class="pro-hover">
                                        <h6>Forest & Tree Planting</h6>
                                        <p>We are working over 20 years on Waste Management & Material Recycling
                                            Projects.</p>
                                        <a href="#">Read More</a>
                                    </div>
                                </div>
                            </div>
                            <!--Pro Box End-->
                            <!--Pro Box-->
                            <div class="item">
                                <div class="pro-box">
                                    <img src="/Images/home/current-pro6.jpg" alt="">
                                    <h5>Recycling & Waste Management</h5>
                                    <div class="pro-hover">
                                        <h6>Recycling & Waste Management</h6>
                                        <p>We are working over 20 years on Waste Management & Material Recycling
                                            Projects.</p>
                                        <a href="#">Read More</a>
                                    </div>
                                </div>
                            </div>
                            <!--Pro Box End-->
                            <!--Pro Box-->
                            <div class="item">
                                <div class="pro-box">
                                    <img src="/Images/home/current-pro7.jpg" alt="">
                                    <h5>Solar & Wind
                                        Energy
                                    </h5>
                                    <div class="pro-hover">
                                        <h6>Solar & Wind
                                            Energy
                                        </h6>
                                        <p>We are working over 20 years on Waste Management & Material Recycling
                                            Projects.</p>
                                        <a href="#">Read More</a>
                                    </div>
                                </div>
                            </div>
                            <!--Pro Box End-->
                            <!--Pro Box-->
                            <div class="item">
                                <div class="pro-box">
                                    <img src="/Images/home/current-pro8.jpg" alt="">
                                    <h5>Saving Wildlife
                                        & their Cubs
                                    </h5>
                                    <div class="pro-hover">
                                        <h6>Saving Wildlife
                                            & their Cubs
                                        </h6>
                                        <p>We are working over 20 years on Waste Management & Material Recycling
                                            Projects.</p>
                                        <a href="#">Read More</a>
                                    </div>
                                </div>
                            </div>
                            <!--Pro Box End-->
                        </div>
                    </div>
                    <!--WildLife Slider End-->
                    <!--Water Resources Slider Start-->
                    <div class="tab-pane fade" id="water" role="tabpanel" aria-labelledby="water-tab">
                        <div class="cpro-slider owl-carousel owl-theme">
                            <!--Pro Box-->
                            <div class="item">
                                <div class="pro-box">
                                    <img src="/Images/home/current-pro5.jpg" alt="">
                                    <h5>Forest & Tree Planting</h5>
                                    <div class="pro-hover">
                                        <h6>Forest & Tree Planting</h6>
                                        <p>We are working over 20 years on Waste Management & Material Recycling
                                            Projects.</p>
                                        <a href="#">Read More</a>
                                    </div>
                                </div>
                            </div>
                            <!--Pro Box End-->
                            <!--Pro Box-->
                            <div class="item">
                                <div class="pro-box">
                                    <img src="/Images/home/current-pro6.jpg" alt="">
                                    <h5>Recycling & Waste Management</h5>
                                    <div class="pro-hover">
                                        <h6>Recycling & Waste Management</h6>
                                        <p>We are working over 20 years on Waste Management & Material Recycling
                                            Projects.</p>
                                        <a href="#">Read More</a>
                                    </div>
                                </div>
                            </div>
                            <!--Pro Box End-->
                            <!--Pro Box-->
                            <div class="item">
                                <div class="pro-box">
                                    <img src="/Images/home/current-pro7.jpg" alt="">
                                    <h5>Solar & Wind
                                        Energy
                                    </h5>
                                    <div class="pro-hover">
                                        <h6>Solar & Wind
                                            Energy
                                        </h6>
                                        <p>We are working over 20 years on Waste Management & Material Recycling
                                            Projects.</p>
                                        <a href="#">Read More</a>
                                    </div>
                                </div>
                            </div>
                            <!--Pro Box End-->
                            <!--Pro Box-->
                            <div class="item">
                                <div class="pro-box">
                                    <img src="/Images/home/current-pro8.jpg" alt="">
                                    <h5>Saving Wildlife
                                        & their Cubs
                                    </h5>
                                    <div class="pro-hover">
                                        <h6>Saving Wildlife
                                            & their Cubs
                                        </h6>
                                        <p>We are working over 20 years on Waste Management & Material Recycling
                                            Projects.</p>
                                        <a href="#">Read More</a>
                                    </div>
                                </div>
                            </div>
                            <!--Pro Box End-->
                            <!--Pro Box-->
                            <div class="item">
                                <div class="pro-box">
                                    <img src="/Images/home/current-pro1.jpg" alt="">
                                    <h5>Forest & Tree Planting</h5>
                                    <div class="pro-hover">
                                        <h6>Forest & Tree Planting</h6>
                                        <p>We are working over 20 years on Waste Management & Material Recycling
                                            Projects.</p>
                                        <a href="#">Read More</a>
                                    </div>
                                </div>
                            </div>
                            <!--Pro Box End-->
                            <!--Pro Box-->
                            <div class="item">
                                <div class="pro-box">
                                    <img src="/Images/home/current-pro2.jpg" alt="">
                                    <h5>Recycling & Waste Management</h5>
                                    <div class="pro-hover">
                                        <h6>Recycling & Waste Management</h6>
                                        <p>We are working over 20 years on Waste Management & Material Recycling
                                            Projects.</p>
                                        <a href="#">Read More</a>
                                    </div>
                                </div>
                            </div>
                            <!--Pro Box End-->
                            <!--Pro Box-->
                            <div class="item">
                                <div class="pro-box">
                                    <img src="/Images/home/current-pro3.jpg" alt="">
                                    <h5>Solar & Wind
                                        Energy
                                    </h5>
                                    <div class="pro-hover">
                                        <h6>Solar & Wind
                                            Energy
                                        </h6>
                                        <p>We are working over 20 years on Waste Management & Material Recycling
                                            Projects.</p>
                                        <a href="#">Read More</a>
                                    </div>
                                </div>
                            </div>
                            <!--Pro Box End-->
                            <!--Pro Box-->
                            <div class="item">
                                <div class="pro-box">
                                    <img src="/Images/home/current-pro4.jpg" alt="">
                                    <h5>Saving Wildlife
                                        & their Cubs
                                    </h5>
                                    <div class="pro-hover">
                                        <h6>Saving Wildlife
                                            & their Cubs
                                        </h6>
                                        <p>We are working over 20 years on Waste Management & Material Recycling
                                            Projects.</p>
                                        <a href="#">Read More</a>
                                    </div>
                                </div>
                            </div>
                            <!--Pro Box End-->
                        </div>
                    </div>
                    <!--Water Resources Slider End-->
                    <!--Solar Energy Slider Start-->
                    <div class="tab-pane fade" id="solar" role="tabpanel" aria-labelledby="solar-tab">
                        <div class="cpro-slider owl-carousel owl-theme">
                            <!--Pro Box-->
                            <div class="item">
                                <div class="pro-box">
                                    <img src="/Images/home/current-pro7.jpg" alt="">
                                    <h5>Solar & Wind
                                        Energy
                                    </h5>
                                    <div class="pro-hover">
                                        <h6>Solar & Wind
                                            Energy
                                        </h6>
                                        <p>We are working over 20 years on Waste Management & Material Recycling
                                            Projects.</p>
                                        <a href="#">Read More</a>
                                    </div>
                                </div>
                            </div>
                            <!--Pro Box End-->
                            <!--Pro Box-->
                            <div class="item">
                                <div class="pro-box">
                                    <img src="/Images/home/current-pro8.jpg" alt="">
                                    <h5>Saving Wildlife
                                        & their Cubs
                                    </h5>
                                    <div class="pro-hover">
                                        <h6>Saving Wildlife
                                            & their Cubs
                                        </h6>
                                        <p>We are working over 20 years on Waste Management & Material Recycling
                                            Projects.</p>
                                        <a href="#">Read More</a>
                                    </div>
                                </div>
                            </div>
                            <!--Pro Box End-->
                            <!--Pro Box-->
                            <div class="item">
                                <div class="pro-box">
                                    <img src="/Images/home/current-pro5.jpg" alt="">
                                    <h5>Forest & Tree Planting</h5>
                                    <div class="pro-hover">
                                        <h6>Forest & Tree Planting</h6>
                                        <p>We are working over 20 years on Waste Management & Material Recycling
                                            Projects.</p>
                                        <a href="#">Read More</a>
                                    </div>
                                </div>
                            </div>
                            <!--Pro Box End-->
                            <!--Pro Box-->
                            <div class="item">
                                <div class="pro-box">
                                    <img src="/Images/home/current-pro6.jpg" alt="">
                                    <h5>Recycling & Waste Management</h5>
                                    <div class="pro-hover">
                                        <h6>Recycling & Waste Management</h6>
                                        <p>We are working over 20 years on Waste Management & Material Recycling
                                            Projects.</p>
                                        <a href="#">Read More</a>
                                    </div>
                                </div>
                            </div>
                            <!--Pro Box End-->
                            <!--Pro Box-->
                            <div class="item">
                                <div class="pro-box">
                                    <img src="/Images/home/current-pro3.jpg" alt="">
                                    <h5>Solar & Wind
                                        Energy
                                    </h5>
                                    <div class="pro-hover">
                                        <h6>Solar & Wind
                                            Energy
                                        </h6>
                                        <p>We are working over 20 years on Waste Management & Material Recycling
                                            Projects.</p>
                                        <a href="#">Read More</a>
                                    </div>
                                </div>
                            </div>
                            <!--Pro Box End-->
                            <!--Pro Box-->
                            <div class="item">
                                <div class="pro-box">
                                    <img src="/Images/home/current-pro4.jpg" alt="">
                                    <h5>Saving Wildlife
                                        & their Cubs
                                    </h5>
                                    <div class="pro-hover">
                                        <h6>Saving Wildlife
                                            & their Cubs
                                        </h6>
                                        <p>We are working over 20 years on Waste Management & Material Recycling
                                            Projects.</p>
                                        <a href="#">Read More</a>
                                    </div>
                                </div>
                            </div>
                            <!--Pro Box End-->
                            <!--Pro Box-->
                            <div class="item">
                                <div class="pro-box">
                                    <img src="/Images/home/current-pro1.jpg" alt="">
                                    <h5>Forest & Tree Planting</h5>
                                    <div class="pro-hover">
                                        <h6>Forest & Tree Planting</h6>
                                        <p>We are working over 20 years on Waste Management & Material Recycling
                                            Projects.</p>
                                        <a href="#">Read More</a>
                                    </div>
                                </div>
                            </div>
                            <!--Pro Box End-->
                            <!--Pro Box-->
                            <div class="item">
                                <div class="pro-box">
                                    <img src="/Images/home/current-pro2.jpg" alt="">
                                    <h5>Recycling & Waste Management</h5>
                                    <div class="pro-hover">
                                        <h6>Recycling & Waste Management</h6>
                                        <p>We are working over 20 years on Waste Management & Material Recycling
                                            Projects.</p>
                                        <a href="#">Read More</a>
                                    </div>
                                </div>
                            </div>
                            <!--Pro Box End-->
                        </div>
                    </div>
                    <!--Solar Energy Slider End-->
                    <!--Recycling Slider Start-->
                    <div class="tab-pane fade" id="recycling" role="tabpanel" aria-labelledby="recycling-tab">
                        <div class="cpro-slider owl-carousel owl-theme">
                            <!--Pro Box-->
                            <div class="item">
                                <div class="pro-box">
                                    <img src="/Images/home/current-pro7.jpg" alt="">
                                    <h5>Solar & Wind
                                        Energy
                                    </h5>
                                    <div class="pro-hover">
                                        <h6>Solar & Wind
                                            Energy
                                        </h6>
                                        <p>We are working over 20 years on Waste Management & Material Recycling
                                            Projects.</p>
                                        <a href="#">Read More</a>
                                    </div>
                                </div>
                            </div>
                            <!--Pro Box End-->
                            <!--Pro Box-->
                            <div class="item">
                                <div class="pro-box">
                                    <img src="/Images/home/current-pro8.jpg" alt="">
                                    <h5>Saving Wildlife
                                        & their Cubs
                                    </h5>
                                    <div class="pro-hover">
                                        <h6>Saving Wildlife
                                            & their Cubs
                                        </h6>
                                        <p>We are working over 20 years on Waste Management & Material Recycling
                                            Projects.</p>
                                        <a href="#">Read More</a>
                                    </div>
                                </div>
                            </div>
                            <!--Pro Box End-->
                            <!--Pro Box-->
                            <div class="item">
                                <div class="pro-box">
                                    <img src="/Images/home/current-pro3.jpg" alt="">
                                    <h5>Solar & Wind
                                        Energy
                                    </h5>
                                    <div class="pro-hover">
                                        <h6>Solar & Wind
                                            Energy
                                        </h6>
                                        <p>We are working over 20 years on Waste Management & Material Recycling
                                            Projects.</p>
                                        <a href="#">Read More</a>
                                    </div>
                                </div>
                            </div>
                            <!--Pro Box End-->
                            <!--Pro Box-->
                            <div class="item">
                                <div class="pro-box">
                                    <img src="/Images/home/current-pro4.jpg" alt="">
                                    <h5>Saving Wildlife
                                        & their Cubs
                                    </h5>
                                    <div class="pro-hover">
                                        <h6>Saving Wildlife
                                            & their Cubs
                                        </h6>
                                        <p>We are working over 20 years on Waste Management & Material Recycling
                                            Projects.</p>
                                        <a href="#">Read More</a>
                                    </div>
                                </div>
                            </div>
                            <!--Pro Box End-->
                            <!--Pro Box-->
                            <div class="item">
                                <div class="pro-box">
                                    <img src="/Images/home/current-pro1.jpg" alt="">
                                    <h5>Forest & Tree Planting</h5>
                                    <div class="pro-hover">
                                        <h6>Forest & Tree Planting</h6>
                                        <p>We are working over 20 years on Waste Management & Material Recycling
                                            Projects.</p>
                                        <a href="#">Read More</a>
                                    </div>
                                </div>
                            </div>
                            <!--Pro Box End-->
                            <!--Pro Box-->
                            <div class="item">
                                <div class="pro-box">
                                    <img src="/Images/home/current-pro2.jpg" alt="">
                                    <h5>Recycling & Waste Management</h5>
                                    <div class="pro-hover">
                                        <h6>Recycling & Waste Management</h6>
                                        <p>We are working over 20 years on Waste Management & Material Recycling
                                            Projects.</p>
                                        <a href="#">Read More</a>
                                    </div>
                                </div>
                            </div>
                            <!--Pro Box End-->
                        </div>
                    </div>
                    <!--Recycling Slider End-->
                </div>
            </div>
        </div>
    </div>
</section>
<!--Current Projects End-->

<!--Why Ecova + Facts Start-->
<section class="why-ecova wf100">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1> Porquê juntar-se</h1>
                <p>Apoiar uma causa nobre que visa dar o exemplo na defesa e promoção da floresta autóctone e do seu
                    valor na
                    mitigação das alterações climáticas, resiliência contra incêndios, regulação e melhoria do clima e
                    conservação da biodiversidade.
                </p>
                <a href="#" class="cus">Junte-se já</a>
            </div>
        </div>
    </div>
</section>

<!--Maybe the local for the carrossel sponsor logo !!! -->
<div class="instagram">
    <h2 class="section-title-2">Os nossos patrocionadores!!</h2>
    <ul>
        <li><img src="/Images/home/insta1.jpg" alt=""></li>
        <li><img src="/Images/home/insta2.jpg" alt=""></li>
        <li><img src="/Images/home/insta3.jpg" alt=""></li>
        <!--   <li><a href="#"> <i class="fas fa-search"></i> </a> <img src="/Images/home/insta4.jpg" alt=""></li>
           <li><a href="#"> <i class="fas fa-search"></i> </a> <img src="/Images/home/insta5.jpg" alt=""></li>
           <li><a href="#"> <i class="fas fa-search"></i> </a> <img src="/Images/home/insta6.jpg" alt=""></li>
           <li><a href="#"> <i class="fas fa-search"></i> </a> <img src="/Images/home/insta7.jpg" alt=""></li>-->
    </ul>
</div>
<!--InstaGram End-->

<script>
    var greenIcon = L.icon({
        iconUrl: 'https://leafletjs.com/examples/custom-icons/leaf-green.png',
        shadowUrl: 'https://leafletjs.com/examples/custom-icons/leaf-shadow.png',

        iconSize: [38, 95], // size of the icon
        shadowSize: [50, 64], // size of the shadow
        iconAnchor: [22, 94], // point of the icon which will correspond to marker's location
        shadowAnchor: [4, 62],  // the same for the shadow
        popupAnchor: [-3, -76] // point from which the popup should open relative to the iconAnchor
    });

    var blueIcon = L.icon({
        iconUrl: 'https://leafletjs.com/examples/custom-icons/leaf-red.png',
        shadowUrl: 'https://leafletjs.com/examples/custom-icons/leaf-shadow.png',

        iconSize: [38, 95], // size of the icon
        shadowSize: [50, 64], // size of the shadow
        iconAnchor: [22, 94], // point of the icon which will correspond to marker's location
        shadowAnchor: [4, 62],  // the same for the shadow
        popupAnchor: [-3, -76] // point from which the popup should open relative to the iconAnchor
    });

    let map = L.map('map').setView([37.319518557906285, -8.556156285649438], 12.5);

    var marker = L.marker([37.3174025204363, -8.566799289969723], {icon: greenIcon}).addTo(map);
    var marker = L.marker([37.280008400415554, -8.554293570462498], {icon: blueIcon}).addTo(map);


    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
        // attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1,
        accessToken: 'pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw'
    }).addTo(map);




    //Donation script

    //Function to lock the button
    $(function() {
        $('#checkBtn').click(function() {
            if ($(this).is(':checked')) {
                $('#subBtn').removeAttr('disabled');
            } else {

                $('#subBtn').attr('disabled', 'disabled');

            }
        });
    });

    if($("input:radio[name='donation']").is(":checked")) {
        alert('check')
    }

</script>