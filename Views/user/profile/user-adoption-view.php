<?php
/**
 * Created by PhpStorm.
 * User: V1p3r
 * Date: 17/10/2018
 * Time: 20:14
 */
?>
<?php if (!defined('ABSPATH')) exit; ?>


<h2 hidden>  <?php echo $_SESSION['userdata']['treeDonation'][0]['value'] ?> </h2>


<!--Adoption Start-->
<section>
    <div class="choose-ecova wf100 p80">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="section-title-2">
                        <h5>Adote uma árvore</h5>
                        <h2>Escolha a árvore</h2>
                    </div>
                    <div class="cform">
                        <form id="getTree">
                            <div class="form-group">
                                <input id="adoptionVal" name="adoptionVal" type="hidden" class="form-control"
                                       value="<?php echo $_SESSION['userdata']['treeDonation'][0]['value'] ?>">
                            </div>
                            <div>
                                <div class="half pr15">
                                    <select class="form-control" name="adoptList" id="adoptList"
                                            class="form-control customDropdown">
                                        <option value="" disabled selected>Árvore</option>
                                        <?php if (!empty($this->userdata['adoptionList'])) {
                                            foreach ($this->userdata['adoptionList'] as $key => $tree) { ?>
                                                <option value="<?php echo $tree['id'] ?>">
                                                    <?php echo $tree["id"] ?></option>
                                            <?php }
                                        } ?>

                                    </select>
                                </div>
                            </div>

                            <br>
                            <div class="descriptionTree">
                                <div class="col-6">
                                    <div class="eco-box">
                                        <span class="econ-icon"><i class="fa fa-address-card"></i></span>
                                        <h5> Nome:</h5>
                                        <div class="treeName"> O nome da árvore.</div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="eco-box">
                                        <span class="econ-icon"><i class="fa fa-tree"></i> </span>
                                        <h5> Nome comum:</h5>
                                        <div class="treeComName"> O nome comum da árvore.</div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="eco-box">
                                        <span class="econ-icon"><i class="fa fa-book"></i></i></span>
                                        <h5> Descrição:</h5>
                                        <div class="treeDescr"> Descrição geral da árvore.</div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="eco-box">
                                        <span class="econ-icon"><i class="fa fa-newspaper"></i></span>
                                        <h5> Observações: </h5>
                                        <div class="treeObs"> Dados de interesse.</div>
                                    </div>
                                </div>
                                <div class="col-6 subBtna">
                                    <div class="full">
                                        <button type="submit" id="subBtn"


                                                value="Efetue o pedido" disabled="disabled" class="btn btn-success">
                                            Efetue o seu
                                            pedido
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="volunteer-form">
                        <div id="treePhoto">

                            <!--                            TODO falta ver fotos !!! -->
                            <!--Foto falta ver fotos !!!!-->

                            <img src="<?php echo HOME_URL . '/Images/logo/adoteUmaBig.png'; ?>" height="100%"
                                 width="100%"
                                 alt="">

                        </div>
                    </div>
                    <br>
                    <!--Map area div-->
                    <div id="map"></div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Adoption END-->

<!--Modal payment -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!--            <div class="modal-body">-->

            <div class="container-fluid" id="bg-div">
                <div class="justify-content-center">
                    <!--                        <div class="col-lg-9 col-12">-->
                    <div class="card card0">
                        <div class="d-flex" id="wrapper">
                            <!-- Sidebar -->
                            <div class="bg-light border-right" id="sidebar-wrapper">
                                <div class="sidebar-heading pt-5 pb-4"><strong>Metodo de pagamento</strong></div>
                                <?php if (!empty($this->userdata['transactionList'])) {
                                    foreach ($this->userdata['transactionList'] as $key => $trans) { ?>


                                <div class="list-group list-group-flush">
                                    <a data-toggle="tab" href="#<?php echo $trans["name"] ?>" id="<?php echo $trans["name"] ?>"
                                                                            class="tabs list-group-item bg-light">
                                        <div class="list-div my-2">
                                            <div class="fa fa-home"></div>  <?php echo $trans["name"] ?>
                                        </div>
                                    </a>


                                    <a data-toggle="tab" href="#menu2" id="tab2"
                                            class="tabs list-group-item active1">
                                        <div class="list-div my-2">
                                            <div class="fa fa-credit-card"></div> &nbsp;&nbsp; Card
                                        </div>
                                    </a>

                                </div>


                                <?php }
                                } ?>
                            </div> <!-- Page Content -->
                            <div id="page-content-wrapper">
                                <div class="row pt-3" id="border-btm">
                                    <div class="col-4">
                                        <button class="btn btn-success mt-4 ml-3 mb-3" id="menu-toggle">
                                            <div class="bar4"></div>
                                            <div class="bar4"></div>
                                            <div class="bar4"></div>
                                        </button>
                                    </div>
                                    <div class="col-8">
                                        <div class="row justify-content-right">
                                            <div class="col-12">
                                                <p>Id da árvore:</p>

                                                <!--                                                TODO ver o reload da página com o Id correto -->

                                                <p>  <?php echo $_SESSION['userdata']['treeDonation'][1]['value']; ?> </p>

                                            </div>
                                        </div>
                                        <div class="row justify-content-right">
                                            <div class="col-12">
                                                <p class="mb-0 mr-4 text-right">Valor a pagar <span
                                                            class="top-highlight">€<?php echo $_SESSION['userdata']['treeDonation'][0]['value'] ?></span>
                                                </p>
                                            </div>
                                        </div>





                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="text-center" id="test">Pay</div>
                                </div>


                                <div class="tab-content">



                                    <div id="MBWay" class="tab-pane">
                                        <div class="row justify-content-center">
                                            <div class="col-11">
                                                <div class="form-card">
                                                    <h3 class="mt-0 mb-4 text-center">Enter bank details to pay</h3>
                                                    <form >

                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div id="menu2" class="tab-pane in active">
                                        <div class="row justify-content-center">
                                            <div class="col-11">
                                                <div class="form-card">
                                                    <h3 class="mt-0 mb-4 text-center">Enter your card details to
                                                        pay</h3>
                                                    <form onsubmit="event.preventDefault()">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="input-group"><input type="text" id="cr_no"
                                                                                                placeholder="0000 0000 0000 0000"
                                                                                                minlength="19"
                                                                                                maxlength="19"> <label>CARD
                                                                        NUMBER</label></div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <div class="input-group"><input type="text" name="exp"
                                                                                                id="exp"
                                                                                                placeholder="MM/YY"
                                                                                                minlength="5"
                                                                                                maxlength="5"> <label>CARD
                                                                        EXPIRY</label></div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="input-group"><input type="password"
                                                                                                name="cvcpwd"
                                                                                                placeholder="&#9679;&#9679;&#9679;"
                                                                                                class="placeicon"
                                                                                                minlength="3"
                                                                                                maxlength="3"> <label>CVV</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12"><input type="submit"
                                                                                          value="Pay $ 100"
                                                                                          class="btn btn-success placeicon">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <p class="text-center mb-5" id="below-btn"><a href="#">Use
                                                                        a test card</a></p>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="menu3" class="tab-pane">
                                        <div class="row justify-content-center">
                                            <div class="col-11">
                                                <h3 class="mt-0 mb-4 text-center">Scan the QR code to pay</h3>
                                                <div class="row justify-content-center">
                                                    <div id="qr"><img src="https://i.imgur.com/DD4Npfw.jpg"
                                                                      width="200px" height="200px"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--                            </div>-->
                        <!--                        </div>-->
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!--Modal payment End-->


<!--Script-->
<script>
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

        // Map first view
        let map = L.map('map').setView([37.319518557906285, -8.556156285649438], 12.5);

        //Tile Layer Leaflet map
        let satellite = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
            maxZoom: 18,
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1,
            accessToken: 'pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw'
        }).addTo(map);

        //function to handler the tree view
        var tempArray = <?php echo json_encode($this->userdata['adoptionList']); ?>;
        $("#adoptList").on("change", function () {
            //Getting Value
            tempArray.forEach(element => {
                if ($(this).val() != null) {
                    if ($(this).val() == element.id) {
                        $(".treeName").text(element.nameScientific);
                        $(".treeComName").text(element.nameCommon);
                        $(".treeDescr").text(element.description);
                        $(".treeObs").text(element.observations);
                        $("#subBtn").removeAttr('disabled');

                        //TODO ver a foto
                        $(".treePhoto").text(element.mainImageName);


                        //marker tree
                        allMarker = new L.marker([element.lat, element.lng], {
                            icon: greenIcon,
                            user: 'none'
                        }).addTo(map);
                        //fly to tree specific point on map
                        const lat = element.lat;
                        const lng = element.lng;
                        console.log(lat);
                        map.flyTo([lat, lng]);
                    }
                }
            });
        }).change();

        //Modal menu Toggle Script
        $("#menu-toggle").click(function (e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });

        // For highlighting activated tabs
        $("#tab1").click(function () {
            $(".tabs").removeClass("active1");
            $(".tabs").addClass("bg-light");
            $("#tab1").addClass("active1");
            $("#tab1").removeClass("bg-light");
        });
        $("#tab2").click(function () {
            $(".tabs").removeClass("active1");
            $(".tabs").addClass("bg-light");
            $("#tab2").addClass("active1");
            $("#tab2").removeClass("bg-light");
        });
        $("#tab3").click(function () {
            $(".tabs").removeClass("active1");
            $(".tabs").addClass("bg-light");
            $("#tab3").addClass("active1");
            $("#tab3").removeClass("bg-light");
        });

        //AJAX call to get select tree
        $('#getTree').submit(function (event) {
            event.preventDefault(); //prevent default action
            let formData = {
                'action': "makeDonation",
                'data': $(this).serializeArray()
            };
            $.ajax({
                url: "<?php echo HOME_URL . '/home/adoption';?>",
                dataType: "json",
                type: 'POST',
                data: formData,
                success: function (data) {
                    // location.reload();


                    //TODO ver o reload do modal para carregar o ID correto da árvore escolhida

                    console.log(data);
                    $(".bd-example-modal-lg").modal('show');

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


        // Ajax call to make transiction
        $('#makeTransaction').submit(function (event) {
            event.preventDefault(); //prevent default action
            let formData = {
                'action': "makeTransaction",
                'data': $(this).serializeArray()
            };
            $.ajax({
                url: "<?php echo HOME_URL . '/home/donation';?>",
                dataType: "json",
                type: 'POST',
                data: formData,
                beforeSend: function () { // Load the spinner.
                    $('#loader').removeClass('hidden')
                },
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
                                window.location.href = "<?php echo HOME_URL . '/home';?>";
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
                }, complete: function () { // Set our complete callback, adding the .hidden class and hiding the spinner.
                    $('#loader').addClass('hidden')
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

    });

</script>
<!--Script End-->




