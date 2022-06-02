<?php
/**
 * Created by PhpStorm.
 * User: V1p3r
 * Date: 17/10/2018
 * Time: 20:14
 */
?>
<?php if (!defined('ABSPATH')) exit; ?>


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
                        <li class="half pr15">
                            <h4>Escolha a árvore</h4>
                            <!--                                <p>Please Select the Cause or Project for Contribution</p>-->
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
                        <h4 <?php echo $data2['donation']['value'] ?>">
                        <li class="full">
                            <h4>Características</h4>

                            <textarea class="textarea-control"
                                      placeholder="Terá um echo em forma de lista com as caracteristicas da árvore"></textarea>
                        </li>
                        <li class="full">
                            <input type="submit" data-toggle="modal" data-target=".bd-example-modal-lg"
                                   value="Efetue o pedido" class="fsubmit">
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <div>
                    <!--Foto-->
                    <img src="/Images/home/current-pro1.jpg" height="100%" width="100%" alt="">
                    <!--                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d11418.310112375979!2d-74.00986187433132!3d40.710981182716246!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew+York%2C+NY!5e0!3m2!1sen!2s!4v1540972202179"></iframe>-->
                    <?php if (!empty($this->userdata['adoptionList'])) {
                        foreach ($this->userdata['adoptionList'] as $key => $tree) { ?>
                            <option value="<?php echo $tree['id'] ?>">
                                <?php echo $tree["id"] ?></option>
                        <?php }
                    } ?>
                </div>
            </div>
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





