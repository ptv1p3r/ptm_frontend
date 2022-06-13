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
<section class="contact-page wf100 p80">
    <div class="container contact-info">
        <div class="row">
            <div class="col-md-12">
                <h3> Adote uma árvore</h3>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="contact-form">
                    <!--                    <h3>Feel Free to Contact us</h3>-->
                    <ul class="cform">

                        <h4>Escolha a árvore</h4>
                        <!--                                <p>Please Select the Cause or Project for Contribution</p>-->
                        <form id="updatePass">
                            <div class="form-group">
                                <input id="adoptionVal" name="adoptionVal" type="hidden" class="form-control"
                                       value="<?php echo $_SESSION['userdata']['treeDonation'][0]['value'] ?>">
                            </div>
                            <div>
                                <li class="half pr15">
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
                                </li>
                            </div>
                            <div>
                                <li class="full">
                                    <h4>Características</h4>

                                    <div class="treeContainer">
                                        Nome:
                                        <div class="test12" id="treeName"></div>
                                    </div>
                                </li>
                            </div>
                            <div class="row">


                            </div>


                            <div>
                                <li class="full">
                                    <input type="submit" data-toggle="modal" data-target=".bd-example-modal-lg"
                                           value="Efetue o pedido" class="fsubmit">
                                </li>
                            </div>

                        </form>
                    </ul>
                </div>
            </div>


            <!--            FOTO             -->


            <div class="col-md-6">
                <div id="treePhoto">
                    <!--Foto-->
                    <img src="/Images/home/current-pro1.jpg" height="100%" width="100%" alt="">

                </div>
            </div>

            <!--          END  FOTO             -->


        </div>
    </div>
</section>
<!--Contact End-->


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
                                <div class="sidebar-heading pt-5 pb-4"><strong>PAY WITH</strong></div>
                                <div class="list-group list-group-flush"><a data-toggle="tab" href="#menu1" id="tab1"
                                                                            class="tabs list-group-item bg-light">
                                        <div class="list-div my-2">
                                            <div class="fa fa-home"></div> &nbsp;&nbsp; Bank
                                        </div>
                                    </a> <a data-toggle="tab" href="#menu2" id="tab2"
                                            class="tabs list-group-item active1">
                                        <div class="list-div my-2">
                                            <div class="fa fa-credit-card"></div> &nbsp;&nbsp; Card
                                        </div>
                                    </a> <a data-toggle="tab" href="#menu3" id="tab3"
                                            class="tabs list-group-item bg-light">
                                        <div class="list-div my-2">
                                            <div class="fa fa-qrcode"></div> &nbsp;&nbsp;&nbsp; Visa QR <span
                                                    id="new-label">NEW</span>
                                        </div>
                                    </a></div>
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

                                                <!--                                                Precisar ser revisto para dar o número correto que for selecionado anteriormente-->

                                                <p <?php if (!empty($this->userdata['adoptionList'])) {
                                                foreach ($this->userdata['adoptionList'] as $key => $tree) { ?>
                                                <option value="<?php echo $tree['id'] ?>">
                                                    <?php echo $tree["id"] ?></option>
                                                <?php }
                                                } ?></p>
                                            </div>

                                            <!--                                            da árvore-->


                                        </div>
                                        <div class="row justify-content-right">
                                            <div class="col-12">
                                                <p class="mb-0 mr-4 text-right">Pay <span
                                                            class="top-highlight">$ 100</span></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="text-center" id="test">Pay</div>
                                </div>
                                <div class="tab-content">
                                    <div id="menu1" class="tab-pane">
                                        <div class="row justify-content-center">
                                            <div class="col-11">
                                                <div class="form-card">
                                                    <h3 class="mt-0 mb-4 text-center">Enter bank details to pay</h3>
                                                    <form onsubmit="event.preventDefault()">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="input-group"><input type="text" id="bk_nm"
                                                                                                placeholder="BBB Bank">
                                                                    <label>BANK NAME</label></div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="input-group"><input type="text"
                                                                                                name="ben_nm"
                                                                                                id="ben-nm"
                                                                                                placeholder="John Smith">
                                                                    <label>BENEFICIARY NAME</label></div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="input-group"><input type="text" name="scode"
                                                                                                placeholder="ABCDAB1S"
                                                                                                class="placeicon"
                                                                                                minlength="8"
                                                                                                maxlength="11"> <label>SWIFT
                                                                        CODE</label></div>
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


        //function to handler the tree view
        //Assign php generated json to JavaScript variable
        var tempArray = <?php echo json_encode($this->userdata['adoptionList']); ?>;
        $("#adoptList").on("change", function () {
            //Getting Value

            tempArray.forEach(element => {
                console.log(element);
                if ($(this).val() != null) {
                    if ($(this).val() == element.id) {
                        console.log($(this).val());
                        console.log(element.id);
                        $(".treeContainer #treeName").text(element.nameScientific);
                    }
                }
            });
        }).change();


        //AJAX call


        //Menu Toggle Script
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
    })


</script>


<!--Script End-->





