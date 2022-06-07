<?php
/**
 * Created by PhpStorm.
 * User: V1p3r
 * Date: 17/10/2018
 * Time: 20:14
 */
?>
<?php if ( ! defined('ABSPATH')) exit; ?>

<!--New user register Start-->
<section class="home-about wf100 p80">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="about-txt">
                    <h2> <span>A minha árvore </span>  php com echo a chamar o id da árvore
                    </h2>
                    <ul>

                        <?php if (!empty($_SESSION['userdata']['userTreeToShow'])) {
//                            foreach ($_SESSION['userdata']['userTreeToShow'] as $key => $tree) {?>
                        <div class="form-group">
                            <label>Nome:</label>
                            <input type="text" class="form-control" name="test"
                                   value=" <?php echo $_SESSION['userdata']['userTreeToShow']['name'] ?>">
                        </div>



                        <li><i class="fas fa-check"></i> Nome: <?php echo $_SESSION['userdata']['userTreeToShow']['name'] ?></li>
                        <li><i class="fas fa-check"></i> Waste Management </li>
                        <li><i class="fas fa-check"></i> Eco Ideas </li>
                        <li><i class="fas fa-check"></i> Recycling Materials</li>
                        <li><i class="fas fa-check"></i> Plant Ecology</li>
                        <li><i class="fas fa-check"></i> Saving Wildlife </li>
                    </ul>
<!--                    <a class="lm" href="#">Learn More</a>-->
                    <?php }?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="about-pic">

                    <div class="pic1">

                        <div id="pic-slider" class="owl-carousel owl-theme">
                            <div class="item"><img src="Images/logo/adoteUma dark background.jpg" alt=""></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--New user register End teste-->




