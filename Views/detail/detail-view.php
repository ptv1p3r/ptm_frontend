<?php
/**
 * Created by PhpStorm.
 * User: V1p3r
 * Date: 19/01/2019
 * Time: 12:47
 */
?>
<?php if ( ! defined('ABSPATH')) exit; ?>

<div class="container-fluid" style="margin-top:30px">
    <div class="row">
        <div class="col-sm-1"></div>
        <!-- Movie Picture -->
        <div class="card" style="margin:10px auto;width: 200px;height: 300px">
                <img class="card-img-top" src="<?php echo $movieData[0]["poster"]; ?>" alt="<?php echo $movieData[0]["title"]; ?>">
            <div class="card-body">
                <input type="hidden" id="movieId" name="movieId" value="<?php echo $movieData[0]["movid"]; ?>" />
                <button type="button"  id="btnDownload" class="btn btn-success" style="width: 160px">Download</button>
            </div>
        </div>

        <!-- Movie Info -->
        <div class="col-sm-2">
            <br>
            <div class="text-light">In: <i>720p.BlueRay, 1080p.Web</i></div>
            <br style="line-height: 120px">
            <p class="text-muted" id="imdb"><img src="../../Images/logo-imdb.svg"  alt="" width="24" height="24"> <?php echo $movieData[0]["rating_1"];?> <span style="color: green;"><i class="fas fa-star"></i></span></p>
            <p class="fas fa-heart" style="color: green;"><span class="text-muted" id="voteCount"><i> Voted <?php echo $movieData[0]["vote_ok"] + $movieData[0]["vote_notok"];?> times</i></span></p>
            <p class="text-muted" id="DownloadCount"><i>Downloaded <?php echo $movieData[0]["download_count"];?> times</i></p>
            <p class="text-muted"><i><?php echo $movieData[0]["update_timestamp"];?></i></p>
        </div>

        <!-- Synopsis-->
        <div class="col-sm-4">
            <div class="text-light"><h1><?php echo $movieData[0]["title"];?></h1></div>
            <div class="text-light"><h2><?php echo $movieData[0]["year"];?></h2></div>
            <div class="text-light"><h3><?php echo $categories;?></h3></div>
            <br>
            <div class="text-light"><h5>Synopsis</h5></div>
            <div><p class="text-justify text-muted"><?php echo $movieData[0]["description"];?></p></div>
        </div>
        <div class="col-sm-3"></div>
    </div>
</div>

<br>

<div class="container-fluid" style="margin-top:100px">
    <div class="row mx-auto" style="height: 400px">

        <div class="col-sm-1"></div>

        <!-- Trailer -->
        <div class="col-sm-3 embed-responsive">
            <iframe class="embed-responsive-item"
                    src="<?php echo $movieData[0]["media"];?>"
                    frameborder="0"
                    style="width: 400px; height: 250px"
                    allow="accelerometer; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
                  <!--allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"-->
            </iframe>
        </div>


        <!-- Picture 1 -->
        <div class="col-sm-3 screenshot">
            <a class="thumbnail" href="<?php echo $movieData[0]["image_1"];?>">
                <img class="img-responsive" src="<?php echo $movieData[0]["image_1"];?>" alt=""  height="250" width="400">
            </a>

        </div>
        <!-- Picture 2 -->
        <div class="col-sm-3 screenshot">
            <a class="thumbnail" href="<?php echo $movieData[0]["image_2"];?>">
                <img class="img-responsive" src="<?php echo $movieData[0]["image_2"];?>" alt=""  height="250" width="400">
            </a>
        </div>

    </div>
</div>

<div class="container-fluid" >
    <div class="row">
        <div class="col-md-1"></div>
        <!-- Comment Section -->
        <div class="col-md-4">
            <?php echo $comments;?>
        </div>

        <div class="col-md-1"></div>

        <div class="row">
            <div class="col-sm-9 text-light">
                <img src="../../Images/vote.png"  alt="" width="24" height="24">Cast your vote!
            </div>
            <div class="row mx-auto">
                <!-- Upvote -->
                <div class="col-8 col-sm-6">
                    <img src="../../Images/up.png" style="cursor: pointer" class="voteOk" id="vtOK" alt="" width="100" height="100">
                </div>
                <!-- Downvote -->
                <div class="col-4 col-sm-6">
                    <img src="../../Images/down.png" style="transform:rotate(180deg);cursor: pointer" class="voteNotOk" id="vtNOTOK" alt="" width="100" height="100">
                </div>
            </div>
        </div>
    </div>
</div>
