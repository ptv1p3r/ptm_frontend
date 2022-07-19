<?php
/**
 * Created by PhpStorm.
 * User: V1p3r
 * Date: 17/10/2018
 * Time: 20:10
 */
?>
<?php if (!defined('ABSPATH')) exit; ?>

<!-- Image loader -->
<div class="loaderOverlay lds-dual-ring hidden" id="loader">
    <svg class="loader" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
        <circle cx="50" cy="50" r="46"/>
    </svg>
</div>
<!-- Image loader -->

<!--Slider Start-->
<section id="home-slider" class="owl-carousel owl-theme wf100">
    <div class="item">
        <div class="slider-caption h2slider">
            <div class="container">
                <strong>Ajude a natureza<span> & </span></strong>
                <p></p>
                <h1>Adote uma árvore</h1>
                <p>A ajuda de todos é <strong>importante</strong></p>
                <a href="<?php echo HOME_URL . '/home/presentation'; ?>" class="active">Descubra mais</a> <a
                        href="<?php echo HOME_URL . '/register'; ?>">Junte-se já</a>
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
                <a href="<?php echo HOME_URL . '/home/presentation'; ?>" class="active">Descubra mais</a> <a
                        href="<?php echo HOME_URL . '/register'; ?>">Junte-se já</a>
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
                <a href="<?php echo HOME_URL . '/home/presentation'; ?>" class="active">Descubra mais</a> <a
                        href="<?php echo HOME_URL . '/register'; ?>">Junte-se já</a>
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
                <a href="<?php echo HOME_URL . '/home/presentation'; ?>" class="active">Descubra mais</a> <a
                        href="<?php echo HOME_URL . '/register'; ?>">Junte-se já</a>
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
                    <i class="fas fa-hand-holding-heart fa-3x"></i>
                    <h6>Sustentabilidade</h6>
                </div>
            </li>
            <!--box  end-->
            <!--box  start-->
            <li>
                <div class="sinfo">
                    <i class="fas fa-city fa-3x"></i>
                    <h6>Valorização dos aglomerados rurais</h6>
                </div>
            </li>
            <!--box  end-->
            <!--box  start-->
            <li>
                <div class="sinfo">
                    <i class="fas fa-leaf fa-3x"></i>
                    <h6>Proteção dos eco-sistemas</h6>
                </div>
            </li>
            <!--box  end-->
            <!--box  start-->
            <li class="active">
                <div class="sinfo">
                    <!--                    <i class="fas fa-tree "></i>-->
                    <i class="fab fa-pagelines fa-3x"></i>
                    <h6>Reflosteração</h6>
                </div>
            </li>
            <!--box  end-->
            <!--box  start-->
            <li>
                <div class="sinfo">
                    <i class="fas fa-cloud-moon fa-3x"></i>
                    <h6>Alterações climáticas</h6>
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
        <!--Map Section Start-->
        <div class="mapGo">
            <div class="row">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mapDirect">
                        <li class="breadcrumb">
                            <button class="btn btn-outline-success" id="monTarget">Monchique</button>
                        </li>
                        <li class="breadcrumb">
                            <button class="btn btn-outline-success" id="marTarget">Marmelete</button>
                        </li>
                        <li class="breadcrumb">
                            <button class="btn btn-outline-success" id="marTarget">Casais</button>
                        </li>
                        <li class="breadcrumb">
                            <button class="btn btn-outline-success" id="marTarget">Alferce</button>
                        </li>
                        <li class="breadcrumb">
                            <button class="btn btn-outline-success" id="marTarget">Fóia</button>
                        </li>
                    </ol>
                </nav>
                <!-- Leafletmap -->
                <div class="col-md-12">
                    <!--Map area start-->
                    <div id="map" class="shadow-lg p-3 mb-5 bg-white rounded mapBorder"></div>
                    <!--Map area end-->
                </div>
                <!-- END Leafletmap -->
                <!-- Toogle controler tress view-->
                <?php if ($this->logged_in) { ?>
                    <div class="toggleBtn">
                        <br>
                        <input type="checkbox" data-toggle="toggle" data-off="Ver minhas árvores"
                               data-on="Ver todas árvores" data-onstyle="success" data-offstyle="secondary">
                    </div>
                    <?php
                }
                ?>
                <!-- End Toogle controler tress view-->
            </div>
        </div>
    </div>
    <div class="home-facts counter pt80">
        <div class="container">
            <div class="row">
                <?php if (!empty($this->userdata['treesInfo'])) { ?>
                    <div class="col-lg-3 col-sm-6 col-md-3">
                        <div class="counter-box">
                            <p class="counter-count"><?php echo $this->userdata['treesInfo']['treesTotal'] ?></p>
                            <p class="ctxt">Árvores plantadas</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-md-3">
                        <div class="counter-box">
                            <p class="counter-count"><?php echo $this->userdata['treesInfo']['O2Kg'] ?></p>
                            <p class="ctxt">Oxigénio(Kg)</p>
                            <p class="ctxt1" >O2 libertado na atmosfera</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-md-3">
                        <div class="counter-box">
                            <p class="counter-count"><?php echo $this->userdata['treesInfo']['co2Kg'] ?></p>
                            <p class="ctxt">Dióxido Carbono(Kg)</p>
                            <p class="ctxt1" >CO2 sequestrado da atmosfera</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-md-3">
                        <div class="counter-box"><p
                                    class="counter-count"><?php echo $this->userdata['treesInfo']['H2oLt'] ?></p>
                            <p class="ctxt">Água(Ltr)</p>
                            <p class="ctxt1" >H2O produzida</p>
                        </div>
                    </div>
                    <?php
                } ?>
            </div>
            <div>
                <br>
                <p class="font-weight-light">*Dados médios calculados durante o periodo inicial de 20 anos de vida de
                    uma árvore.</p>
            </div>
        </div>

    </div>
</section>
<!--About Section End-->
<!--Adoption Start-->
<section class="urgent-causes wf100 p80">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="section-title-2 white">
                    <h5>Uma causa nobre</h5>
                    <h2>Ajude a reflorestar a nossa serra</h2>
                </div>
            </div>
            <div class="col-md-6">
                <div class="donation-amount">
                    <h5>Doação</h5>
                    <!--Donation form-->
                    <form id="newDonation">
                        <ul class="radio-boxes">
                            <li>
                                <div class="radio custom">
                                    <input name="donation" id="d1" type="radio" value="2.50" class="css-radio">
                                    <label for="d1" class="css-label">€ 2.50</label>
                                </div>
                            </li>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert" hidden>
                                <strong>Selecione o valor e faça adoção!</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <!-- Make donation if login-->
                            <?php if ($this->logged_in) { ?>
                                <li class="form-submit">
                                    <button type="submit" id="subBtn" disabled="disabled">
                                        Faça a sua adoção
                                    </button>
                                </li>
                            <?php } else { ?>
                                <!-- Make donation send to login / register-->
                                <li class="form-submit">
                                    <a type="button" class="btn donationbutton login-reg" data-toggle="modal"
                                       data-target="#loginModal">
                                        Faça a sua adoção</a>
                                </li>
                            <?php } ?>
                        </ul>
                    </form>
                    <!--Donation form END-->
                </div>
            </div>
        </div>
    </div>
</section>
<!--Adoption End-->
<!--Current Projects Start-->
<section class="wf100 p80">
    <div class="container why-ecova-center" id="myTabContentTrees">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title-2">
                    <h5>Faça uma escolha sensata</h5>
                    <h2>Adote uma árvore</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tab-content" id="myTabContent">
                    <!--Trees Slider Start-->
                    <div class="tab-pane fade show active" id="wildlife" role="tabpanel" aria-labelledby="wildlife-tab">
                        <div class="cpro-slider owl-carousel owl-theme">
                            <!--Pro Box-->
                            <div class="item">
                                <div class="pro-box picBorder">
                                    <img src="/Images/trees/sobreiro.png" alt="Sobreiro" class="rounded">
                                    <h5>Sobreiro</h5>
                                    <div class="pro-hover">
                                        <h6>Sobreiro</h6>
                                        <p>Descubra mais sobre esta árvore!</p>
                                        <a href="<?php echo HOME_URL . '/home/thetrees'; ?>">Clique aqui</a>
                                    </div>
                                </div>
                            </div>
                            <!--Pro Box End-->
                            <!--Pro Box-->
                            <div class="item">
                                <div class="pro-box picBorder">
                                    <img src="/Images/trees/medronheiro.png" alt="Medronheiro" class="rounded">
                                    <h5>Medronheiro</h5>
                                    <div class="pro-hover">
                                        <h6>Medronheiro</h6>
                                        <p>Descubra mais sobre esta árvore!</p>
                                        <a href="<?php echo HOME_URL . '/home/thetrees'; ?>">Clique aqui</a>
                                    </div>
                                </div>
                            </div>
                            <!--Pro Box End-->
                            <!--Pro Box-->
                            <div class="item">
                                <div class="pro-box picBorder">
                                    <img src="/Images/trees/castanheiro.png" alt="Castenheiro" class="rounded" >
                                    <h5>Castanheiro
                                    </h5>
                                    <div class="pro-hover">
                                        <h6>Castanheiro
                                        </h6>
                                        <p>Descubra mais sobre esta árvore!</p>
                                        <a href="<?php echo HOME_URL . '/home/thetrees'; ?>">Clique aqui</a>
                                    </div>
                                </div>
                            </div>
                            <!--                            Pro Box End-->
                            <!--                            Pro Box-->
                            <div class="item">
                                <div class="pro-box picBorder">
                                    <img src="/Images/trees/car_monchique.png" alt="CarvalhoMonchique" class="rounded">
                                    <h5> Carvalho de Monchique</h5>
                                    <div class="pro-hover">
                                        <h6>Carvalho de Monchique</h6>
                                        <p>Descubra mais sobre esta árvore!</p>
                                        <a href="<?php echo HOME_URL . '/home/thetrees'; ?>">Clique aqui</a>
                                    </div>
                                </div>
                            </div>
                            <!--Pro Box End-->
                        </div>
                    </div>
                    <!--Trees Slider End-->
                </div>
            </div>
        </div>
    </div>
</section>
<!--Current Projects End-->

<!--Why Adopt trees Start-->
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

<!--Events Start-->
<section class="wf100 p50 about" id="events">
    <!--Our Success Story Start-->
    <div class="our-success-story wf100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-2 text-center">
                        <h5>Os próximos eventos</h5>
                    </div>
                    <!--eco History Start-->
                    <div class="eco-history">
                        <div class="timeline-slider">
                            <!--Timeline Text Start-->
                            <div>
                                <div class="row">
                                    <div class=" col-12">
                                        <div class="timeline-box">
                                            <h6>Em breve..</h6>
                                            <p>Próximo evento será divulgado em breve.</p>
                                        </div>
                                    </div>
                                    <!--                                        <div class=" col-4">-->
                                    <!--                                            <div class="timeline-box">-->
                                    <!--                                                <h6></h6>-->
                                    <!--                                                <p>A preparar</p>                                            </div>-->
                                    <!--                                        </div>-->
                                    <!--                                        <div class=" col-4">-->
                                    <!--                                            <div class="timeline-box">-->
                                    <!--                                                <h6></h6>-->
                                    <!--                                                <p>A preparar</p>                                            </div>-->
                                    <!--                                        </div>-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>

<!--Sponsor logo -->
<section class="online-shop wf100 p80">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title-2 text-center">
                    <h5>Os promotores do projeto</h5>
                    <h2>'Adote uma Árvore'</h2>
                </div>
            </div>
        </div>
        <div class="row sponsor">
            <!--Pro Box Start-->
            <div class="col-md-3 col-sm-6">
                <div class="product-box">
                    <div class="pro-thumb"> <a href="https://www.ismat.pt/" target="_blank">Visite-nos</a> <img src="/Images/entities/ismat.png" alt=""></div>
                </div>
            </div>
            <!--Pro Box End-->
            <!--Pro Box Start-->
            <div class="col-md-3 col-sm-6">
                <div class="product-box">
                    <div class="pro-thumb"> <a href="https://www.cm-monchique.pt/pt/Default.aspx" target="_blank">Visite-nos</a> <img src="/Images/entities/LOGO-MONCHIQUE-300.png"  alt=""></div>
                </div>
            </div>
            <!--Pro Box End-->
        </div>
    </div>
</section>


<script>
    // get tree first image
    function getImg(tree_id){
        let treeImagePath = "";

        let formData = {
            'action' : "GetTreeImage",
            'data'   : tree_id
        };

        $.ajax({
            url : "<?php echo HOME_URL . '/home';?>",
            dataType: "json",
            type: 'POST',
            async: false,
            data : formData,
            beforeSend: function () { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
                $('#loader').removeClass('hidden')
            },
            success: function (data) {
                if (data.statusCode === 404){
                    treeImagePath = "<?php echo HOME_URL . '/Images/logo/adoteUmaBig.png' ?>";
                } else {
                    treeImagePath = "<?php echo API_URL . 'api/v1/trees/image/' ?>" + data["images"][0]["path"];
                }

            },
            error: function (data) {
                Swal.fire({
                    title: 'Erro!',
                    text: data.body.message,
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 2000,
                    didClose: () => {
                        location.reload();
                    }
                });
            },
            complete: function () { // Set our complete callback, adding the .hidden class and hiding the spinner.
                $('#loader').addClass('hidden')
            }
        });

        return treeImagePath;
    }

    $(document).ready(function () {
        // TreesMap
        let greenIcon = L.icon({
            iconUrl: '<?php echo HOME_URL . '/Images/mapMarkers/mapMarker.png'?>',
            shadowUrl: '<?php echo HOME_URL . '/Images/mapMarkers/shadow.png'?>',

            iconSize: [38, 95], // size of the icon
            shadowSize: [50, 64], // size of the shadow
            iconAnchor: [22, 94], // point of the icon which will correspond to marker's location
            shadowAnchor: [4, 62],  // the same for the shadow
            popupAnchor: [-3, -76] // point from which the popup should open relative to the iconAnchor
        });

        let blueIcon = L.icon({
            iconUrl: '<?php echo HOME_URL . '/Images/mapMarkers/blue-mapMarker.png'?>',
            shadowUrl: '<?php echo HOME_URL . '/Images/mapMarkers/shadow.png'?>',

            iconSize: [38, 95], // size of the icon
            shadowSize: [50, 64], // size of the shadow
            iconAnchor: [22, 94], // point of the icon which will correspond to marker's location
            shadowAnchor: [4, 62],  // the same for the shadow
            popupAnchor: [-3, -76] // point from which the popup should open relative to the iconAnchor
        });

        let map = L.map('map').setView([37.319518557906285, -8.556156285649438], 12.5);

        // Fly to a specific point in the map (Monchique)
        $("#monTarget").click(function () {
            map.flyTo([37.319518557906285, -8.556156285649438], 13, {
                animate: true,
                duration: 2 // in seconds
            });
        });

        // Fly to a specific point in the map (Marmelete)
        $("#marTarget").click(function () {
            map.flyTo([37.3119, -8.6671], 13, {
                animate: true,
                duration: 2 // in seconds
            });
        });

        let satellite = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
            maxZoom: 18,
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1,
            accessToken: 'pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw'
        }).addTo(map);

        let allTrees = L.layerGroup();
        //function to load all trees from API
        function mapLoadTrees() {
            <?php if (!empty($this->userdata['allTreesList'])) {
                foreach ($this->userdata['allTreesList'] as $key => $tree) {?>
                    allMarker = new L.marker([<?php echo $tree["lat"]?>, <?php echo $tree["lng"]?>], {
                        icon: greenIcon,
                        user: 'none'
                    }).addTo(allTrees);
                <?php }
            }?>
        }mapLoadTrees();

        let userTrees = L.layerGroup();
        //function to load user trees from API
        <?php if ($this->logged_in) { ?>
            //Ajax call to user trees
            //function to load user private trees from API
            function mapUserLoadTrees() {
                <?php if (!empty($this->userdata['userTreesList'])) {
                    foreach ($this->userdata['userTreesList'] as $key => $tree) {?>
                        userMarker = new L.marker([<?php echo $tree["lat"]?>, <?php echo $tree["lng"]?>], {
                            icon: blueIcon,
                            user: '<?php echo $tree["treeName"] ?>',
                            id: '<?php echo $tree["treeId"] ?>',
                        }).addTo(userTrees).on("click", markerOnClick);
                    <?php }
                }?>
            }mapUserLoadTrees();
        <?php
        }?>

        map.addLayer(allTrees);

        $('.toggleBtn :checkbox').change(function () {
            // this will contain a reference to the checkbox
            if (this.checked) {
                // the checkbox is now checked
                map.removeLayer(allTrees);
                map.addLayer(userTrees);
            } else {
                // the checkbox is now no longer checked
                map.removeLayer(userTrees);
                map.addLayer(allTrees);
            }
        });

        //Tree popup on marker click
        var popupMarker = L.popup({
            className: 'cardPopUp'
        });

        function markerOnClick(e, layer) {
            popupMarker
                .setLatLng(e.latlng)
                .setContent(
                   `<div class="card" style="width: 10rem; border: unset">
                      <img src="`+ getImg(this.options.id)+`" class="card-img-top" alt="">
                      <div class="card-body">
                        <h6 class="card-title">` + this.options.user + `</h6>
                        <p class="card-text">Lat: ` + e.latlng.lat + `</p>
                        <p class="card-text">Long: ` + e.latlng.lng + `</p>
                        <button class="popBtn btn-success"  name="treeId" value='` + this.options.id + `' id="buttpop">Ver mais</button>
                      </div>
                    </div>`
                ).openOn(map);
        }// .className('cardPopUp');

        //function to handler the button popup view
        let eventHandlerAssigned = false;
        map.on('popupopen', function () {
            if (!eventHandlerAssigned && document.querySelector('.popBtn')) {
                const link = document.querySelector('.popBtn')
                link.addEventListener('click', function (e) {
                    popBtn(e.target.value);
                })
                eventHandlerAssigned = true
            }
        })
        map.on('popupclose', function () {
            document.querySelector('.popBtn').removeEventListener('click', popBtn)
            eventHandlerAssigned = false
        })


        // ajax to call user tree id
        function popBtn(value) {
            // event.preventDefault(); //prevent default action

            let formData = {
                'action': "userTreeView",
                'data': value,
            };
            console.log(formData);

            $.ajax({
                url: "<?php echo HOME_URL . '/home/userTrees';?>",
                dataType: "json",
                type: 'POST',
                data: formData,
                success: function (data) {
                    // $("#deleteUserModal").modal('hide');

                    if (data.statusCode === 200) {
                        //Falta ver esta parte para mostrar os dados
                        window.location.href = "<?php echo HOME_URL . '/home/userTrees';?>";
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
        }

    });

    //Donation script
    $(document).ready(function () {

        $('#newDonation').submit(function (event) {
            event.preventDefault(); //prevent default action
            let formData = {
                'action': "getDonation",
                'data': $(this).serializeArray()
            };
            $.ajax({
                url: "<?php echo HOME_URL . '/home/adoption';?>",
                dataType: "json",
                type: 'POST',
                data: formData,
                success: function (data) {
                    window.location.href = "<?php echo HOME_URL . '/home/adoption';?>";
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
            });
        });


        //TODO rever o disable do botão de adoção
        // //Function to lock the button
        $(function () {
            $('#d1').click(function () {
                if ($(this).is(':checked')) {
                    $('#subBtn').removeAttr('disabled');
                } else {
                    $('#alert').show();
                    $('#subBtn').attr('disabled', 'disabled');
                }
            });
        });

    });


</script>