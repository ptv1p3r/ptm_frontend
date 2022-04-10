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
        <h1>Download RealMovie: HD smallest size</h1>
    </div>
</div>

<div class="container-fluid">
    <p class="text-light text-center" style="font-size:160%;"><span class="fas fa-heart" style="color: green;"></span> TOP RATED</p>
    <div class="row " style="margin-bottom: 10%;">
        <?php //foreach ($moviesTopRated as $movie) { ?>
            <div class="card" style="margin:10px auto;width: 200px;height: 300px">
                <a class="card-link" href="<?php //echo HOME_URI . '/detail/view/' . $movie["movid"];?>">
                    <img class="card-img-top" src="<?php //echo $movie["poster"]; ?>" alt="<?php //echo $movie["title"]; ?>">
                </a>
                <div class="card-body">
                    <h5 class="card-title text-white"><?php //echo $movie["title"]; ?></h5>
                    <p class="card-text text-muted"><?php //echo $movie["year"]; ?></p>
                    <a href="<?php // echo HOME_URI . '/detail/view/' . $movie["movid"];?>" class="btn btn-success">Details</a>
                </div>
            </div>
         <?php //} ?>
    </div>
</div>
 Top Downloaded
<div class="container-fluid">
    <p class="text-light text-center" style="font-size:160%;"><span class="fas fa-star" style="color: orange;"></span> TOP DOWNLOADED</p>
    <div class="row" style="margin-bottom: 10%;">
        <?php //foreach ($moviesTopDownloaded as $movie) { ?>
            <div class="card" style="margin:10px auto;width: 200px;height: 300px">
                <a href="<?php //echo HOME_URI . '/detail/view/' . $movie["movid"];?>">
                    <img class="card-img-top" src="<?php //echo $movie["poster"]; ?>" alt="<?php //echo $movie["title"]; ?>">
                </a>
                <div class="card-body" >
                    <h5 class="card-title text-white"><?php //echo $movie["title"]; ?></h5>
                    <p class="card-text text-muted"><?php //echo $movie["year"]; ?></p>
                    <a href="<?php //echo HOME_URI . '/detail/view/' . $movie["movid"];?>" class="btn btn-success">Details</a>
                </div>
            </div>
        <?php // } ?>
    </div>
</div>
 Last Added
<div class="container-fluid">
    <p class="text-light text-center" style="font-size:160%;"><span class="fas fa-clock" ></span> LAST ADDED</p>
    <div class="row" style="margin-bottom: 10%;">
        <?php //foreach ($moviesLastAdded as $movie) { ?>
            <div class="card" style="margin:10px auto;width: 200px;height: 300px">
                <a href="<?php // echo HOME_URI . '/detail/view/' . $movie["movid"];?>">
                    <img class="card-img-top" src="<?php //echo $movie["poster"]; ?>" alt="<?php //echo $movie["title"]; ?>">
                </a>
                <div class="card-body">
                    <h5 class="card-title text-white"><?php //echo $movie["title"]; ?></h5>
                    <p class="card-text text-muted"><?php // echo $movie["year"]; ?></p>
                    <a href="<?php //echo HOME_URI . '/detail/view/' . $movie["movid"];?>" class="btn btn-success">Details</a>
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
                <p>A ajuda de todos é <strong>importante</strong> </p>
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
                <p>Ajudar é importante <strong></strong> </p>
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
            <div class="col-md-5">
                <div class="video-img"><a href="https://vimeo.com/103994901&width=700" data-rel="prettyPhoto"
                                          title="Vimeo video"><i class="fas fa-play"></i></a> <img
                            src="/Images/home/h2about.jpg" alt=""></div>
            </div>
            <div class="col-md-7">
                <div class="h2-about-txt">
                    <h3>Sobre o iniciativa</h3>
                    <p></p>
                    <!--                    <h2>Eco-friendly products can be made from scratch.</h2>-->
                    <p> Para a melhoria da qualidade de vida dos habitantes da nossa serra, ao mesmo tempo que se contribui para o aumento da floresta e com isso, aumentar a resiliência dos ecossistemas, espécies e habitats aos efeitos das alterações climáticas. </p>
                    <!--                    <a class="aboutus" href="#">More About us</a>-->
                </div>
            </div>
        </div>
    </div>
    <div class="home-facts counter pt80">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-sm-6 col-md-3">
                    <div class="counter-box">
                        <p class="counter-count">89000</p>
                        <p class="ctxt">Trees Planted</p>
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
                    <h5>Urgent Cause</h5>
                    <h2>Stop Global Warming</h2>
                </div>
                <p> We need your support and help to Stop Globar Warning. Few generations ago it to seemed like the
                    world’s resources were infinite, and the people needed only. </p>
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
                    <h5>Donation Amount</h5>
                    <form>
                        <ul class="radio-boxes">
                            <li>
                                <div class="radio custom">
                                    <input name="donation" id="d1" type="radio" class="css-radio">
                                    <label for="d1" class="css-label">$5</label>
                                </div>
                            </li>
                            <li>
                                <div class="radio custom">
                                    <input name="donation" id="d2" type="radio" class="css-radio">
                                    <label for="d2" class="css-label">$20</label>
                                </div>
                            </li>
                            <li>
                                <div class="radio custom">
                                    <input name="donation" id="d3" type="radio" class="css-radio">
                                    <label for="d3" class="css-label">$50</label>
                                </div>
                            </li>
                            <li>
                                <div class="radio custom">
                                    <input name="donation" id="d4" type="radio" class="css-radio">
                                    <label for="d4" class="css-label">$100</label>
                                </div>
                            </li>
                            <li>
                                <div class="radio custom">
                                    <input name="donation" id="d5" type="radio" class="css-radio">
                                    <label for="d5" class="css-label">$250</label>
                                </div>
                            </li>
                            <li>
                                <div class="radio custom">
                                    <input name="donation" id="d6" type="radio" class="css-radio">
                                    <label for="d6" class="css-label">$500</label>
                                </div>
                            </li>
                            <li>
                                <div class="radio custom">
                                    <input name="donation" id="d7" type="radio" class="css-radio">
                                    <label for="d7" class="css-label">$1000</label>
                                </div>
                            </li>
                            <li>
                                <div class="inputs">
                                    <input class="enter" type="text" placeholder="$ Other">
                                </div>
                            </li>
                            <li class="form-submit">
                                <button type="submit">Continue to Donate</button>
                            </li>
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
                    <h5>We are working these</h5>
                    <h2>Current Projects</h2>
                </div>
            </div>
            <div class="col-lg-6">
                <ul class="nav" id="myTab" role="tablist">
                    <li class="nav-item"><a class="nav-link active" id="wildlife-tab" data-toggle="tab" href="#wildlife"
                                            role="tab" aria-controls="wildlife-tab" aria-selected="true">Wildlife</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" id="water-tab" data-toggle="tab" href="#water" role="tab"
                                            aria-controls="water-tab" aria-selected="false">Water Resources</a></li>
                    <li class="nav-item"><a class="nav-link" id="solar-tab" data-toggle="tab" href="#solar" role="tab"
                                            aria-controls="solar-tab" aria-selected="false">Solar Energy</a></li>
                    <li class="nav-item"><a class="nav-link" id="recycling-tab" data-toggle="tab" href="#recycling"
                                            role="tab" aria-controls="recycling-tab" aria-selected="false">Recycling</a>
                    </li>
                </ul>
            </div>
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


<!--News & Articles Star
<section class="h2-news wf100 p80">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="section-title-2">
                    <h5>Read Our Latest</h5>
                    <h2>News & Articles</h2>
                </div>
            </div>
            <div class="col-md-6"><a href="#" class="view-more">View More News</a></div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="blog-post-large">
                    <div class="post-thumb"><a href="#"><i class="fas fa-link"></i></a> <img
                                src="/Images/home/h2news1.jpg" alt=""></div>
                    <div class="post-txt">
                        <ul class="post-meta">
                            <li><i class="fas fa-calendar-alt"></i> 29 September, 2018</li>
                            <li><i class="fas fa-comments"></i> 134 Comments</li>
                        </ul>
                        <h5><a href="#">Planting Trees for Better Future</a></h5>
                    </div>
                </div>
            </div>
            <div class="col-md-6">

                <div class="blog-small-post">
                    <div class="post-thumb"><a href="#"><i class="fas fa-link"></i></a> <img
                                src="/Images/home//h2news2.jpg" alt=""></div>
                    <div class="post-txt">
                        <span class="pdate"> <i class="fas fa-calendar-alt"></i> 29 September, 2018</span>
                        <h5><a href="#">How you can keep alive wildlife long.</a></h5>
                        <p>According to a survey the perceived higher cost of environmentally.</p>
                        <a href="#" class="rm">Read More</a>
                    </div>
                </div>


                <div class="blog-small-post">
                    <div class="post-thumb"><a href="#"><i class="fas fa-link"></i></a> <img
                                src="/Images/home/h2news3.jpg" alt=""></div>
                    <div class="post-txt">
                        <span class="pdate"> <i class="fas fa-calendar-alt"></i> 29 September, 2018</span>
                        <h5><a href="#">The effort GoGreen has been felt across</a></h5>
                        <p>Majority have suffered alteration in some form by injected humour.</p>
                        <a href="#" class="rm">Read More</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
News & Articles End-->

<!--Why Ecova + Facts Start-->
<section class="why-ecova wf100">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1> Why Ecova!</h1>
                <p>Let’s Join us to do something awesome to Save Water, Energey, Control Pollution &
                    Environment, Wildlife, Forest Planting Implant for Solar System.
                </p>
                <a href="#" class="cus">Signup to Join us</a>
            </div>
        </div>
    </div>
</section>



<!--Why Ecova + Facts End-->
<!--Online Products Start
<section class="online-shop wf100 p80">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title-2 text-center">
                    <h5>Read Our Latest</h5>
                    <h2>News &amp; Articles</h2>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-md-3 col-sm-6">
                <div class="product-box">
                    <div class="pro-thumb"><a href="#">Add To Cart</a> <img src="/Images/home//pro1.jpg" alt=""></div>
                    <div class="pro-txt">
                        <h6><a href="#">Happy Ninja Shirt</a></h6>
                        <p class="pro-price">
                            <del>$25.00</del>
                            $19.00
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="product-box">
                    <div class="pro-thumb"><a href="#">Add To Cart</a> <img src="/Images/home//pro2.jpg" alt=""></div>
                    <div class="pro-txt">
                        <h6><a href="#">Woo corlor shirt</a></h6>
                        <p class="pro-price">
                            <del>$25.00</del>
                            $19.00
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="product-box">
                    <div class="pro-thumb"><a href="#">Add To Cart</a> <img src="/Images/home//pro3.jpg" alt=""></div>
                    <div class="pro-txt">
                        <h6><a href="#">Premium Quality</a></h6>
                        <p class="pro-price">
                            <del>$25.00</del>
                            $19.00
                        </p>
                    </div>
                </div>
            </div>


            <div class="col-md-3 col-sm-6">
                <div class="product-box">
                    <div class="pro-thumb"><a href="#">Add To Cart</a> <img src="/Images/home//pro4.jpg" alt=""></div>
                    <div class="pro-txt">
                        <h6><a href="#">Ninja Silhouette</a></h6>
                        <p class="pro-price">
                            <del>$25.00</del>
                            $19.00
                        </p>
                    </div>
                </div>
            </div>
            <!-
        </div>
    </div>
</section>
Online Products End-->
<!--InstaGram Start-->



<div class="instagram">
    <ul>
        <li><a href="#"> <i class="fas fa-search"></i> </a> <img src="/Images/home/insta1.jpg" alt=""></li>
        <li><a href="#"> <i class="fas fa-search"></i> </a> <img src="/Images/home/insta2.jpg" alt=""></li>
        <li><a href="#"> <i class="fas fa-search"></i> </a> <img src="/Images/home/insta3.jpg" alt=""></li>
        <li><a href="#"> <i class="fas fa-search"></i> </a> <img src="/Images/home/insta4.jpg" alt=""></li>
        <li><a href="#"> <i class="fas fa-search"></i> </a> <img src="/Images/home/insta5.jpg" alt=""></li>
        <li><a href="#"> <i class="fas fa-search"></i> </a> <img src="/Images/home/insta6.jpg" alt=""></li>
        <li><a href="#"> <i class="fas fa-search"></i> </a> <img src="/Images/home/insta7.jpg" alt=""></li>
    </ul>
</div>
<!--InstaGram End-->
