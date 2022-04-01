<?php
/**
 * Created by PhpStorm.
 * User: V1p3r
 * Date: 17/10/2018
 * Time: 20:10
 */
?>
<?php if ( ! defined('ABSPATH')) exit; ?>

<div class="container-fluid">
    <div class="text-light">
        <h1>Download RealMovie: HD smallest size</h1>
    </div>
</div>
<!-- Top Rated -->
<div class="container-fluid">
    <p class="text-light text-center" style="font-size:160%;"><span class="fas fa-heart" style="color: green;"></span> TOP RATED</p>
    <div class="row " style="margin-bottom: 10%;">
        <?php foreach ($moviesTopRated as $movie) { ?>
            <div class="card" style="margin:10px auto;width: 200px;height: 300px">
                <a class="card-link" href="<?php echo HOME_URI . '/detail/view/' . $movie["movid"];?>">
                    <img class="card-img-top" src="<?php echo $movie["poster"]; ?>" alt="<?php echo $movie["title"]; ?>">
                </a>
                <div class="card-body">
                    <h5 class="card-title text-white"><?php echo $movie["title"]; ?></h5>
                    <p class="card-text text-muted"><?php echo $movie["year"]; ?></p>
                    <a href="<?php echo HOME_URI . '/detail/view/' . $movie["movid"];?>" class="btn btn-success">Details</a>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<!-- Top Downloaded -->
<div class="container-fluid">
    <p class="text-light text-center" style="font-size:160%;"><span class="fas fa-star" style="color: orange;"></span> TOP DOWNLOADED</p>
    <div class="row" style="margin-bottom: 10%;">
        <?php foreach ($moviesTopDownloaded as $movie) { ?>
            <div class="card" style="margin:10px auto;width: 200px;height: 300px">
                <a href="<?php echo HOME_URI . '/detail/view/' . $movie["movid"];?>">
                    <img class="card-img-top" src="<?php echo $movie["poster"]; ?>" alt="<?php echo $movie["title"]; ?>">
                </a>
                <div class="card-body" >
                    <h5 class="card-title text-white"><?php echo $movie["title"]; ?></h5>
                    <p class="card-text text-muted"><?php echo $movie["year"]; ?></p>
                    <a href="<?php echo HOME_URI . '/detail/view/' . $movie["movid"];?>" class="btn btn-success">Details</a>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<!-- Last Added -->
<div class="container-fluid">
    <p class="text-light text-center" style="font-size:160%;"><span class="fas fa-clock" ></span> LAST ADDED</p>
    <div class="row" style="margin-bottom: 10%;">
        <?php foreach ($moviesLastAdded as $movie) { ?>
            <div class="card" style="margin:10px auto;width: 200px;height: 300px">
                <a href="<?php echo HOME_URI . '/detail/view/' . $movie["movid"];?>">
                    <img class="card-img-top" src="<?php echo $movie["poster"]; ?>" alt="<?php echo $movie["title"]; ?>">
                </a>
                <div class="card-body">
                    <h5 class="card-title text-white"><?php echo $movie["title"]; ?></h5>
                    <p class="card-text text-muted"><?php echo $movie["year"]; ?></p>
                    <a href="<?php echo HOME_URI . '/detail/view/' . $movie["movid"];?>" class="btn btn-success">Details</a>
                </div>
            </div>
        <?php } ?>
    </div>
</div>