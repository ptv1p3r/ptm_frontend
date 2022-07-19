<?php
/**
 * Created by PhpStorm.
 * User: V1p3r
 * Date: 17/10/2018
 * Time: 20:14
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


<!--Adoption Start-->
<section>
    <div class="wf100 p80">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-2">
                        <h5>Adote uma árvore</h5>
                        <h2>As nossas árvores</h2>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="products-tabs wf100 p80">
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab"
                                         role="tablist">
                                        <a class="nav-item nav-link active" id="nav-one-tab" data-toggle="tab" href="#nav-one" role="tab"
                                           aria-controls="nav-one" aria-selected="true">Sobreiro</a>
                                        <a class="nav-item nav-link" id="nav-two-tab" data-toggle="tab" href="#nav-two" role="tab"
                                           aria-controls="nav-two" aria-selected="true">Medronheiro</a>
                                        <a class="nav-item nav-link" id="nav-three-tab" data-toggle="tab" href="#nav-three" role="tab"
                                           aria-controls="nav-three" aria-selected="false">Castanheiro</a>
                                        <a class="nav-item nav-link" id="nav-three-tab" data-toggle="tab" href="#nav-four" role="tab"
                                           aria-controls="nav-three" aria-selected="false">Carvalho de Monchique</a>
                                    </div>
                                </nav>
                                <!-- Tab One-->
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="nav-one" role="tabpanel"
                                         aria-labelledby="nav-one-tab">
                                        <div class="row">
                                            <div class="col">
                                                <div class="rounded" style="text-align: center;">
                                                    <img src="/Images/trees/sobreiro.png" alt="Sobreiro" class="img-fluid border border-secondary">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <h4>Sobreiro</h4>
                                                <p><b>(Quercus suber)</b></p>
                                                <p> Dominante em sobreirais e montados de sobro, mas também acompanhante
                                                    noutros tipos de bosques e matas. Em locais com alguma influência
                                                    atlântica e com substratos siliciosos, incluindo areias mais ou
                                                    menos consolidadas, raramente em calcários descarbonatados.</p>
                                                <br>
                                                <div>
                                                    <p><b>Mais informações clique no link:</b></p>
                                                    <p><a href="https://flora-on.pt/?q=Quercus+suber" target="_blank">https://flora-on.pt/?q=Quercus+suber</a></p>
                                                </div>
                                                <div>
                                                    <!--Donation form-->
                                                    <form id="newDonation">
                                                        <ul class="radio-boxes">
                                                            <div class="alert alert-warning alert-dismissible fade show" role="alert" hidden>
                                                                <strong>Selecione o valor e faça adoção!</strong>
                                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="col-12">
                                                                <p class="mb-0 mr-4 "><span class="top-highlight">€2.50</span></p>
                                                            </div>
                                                            <!-- Make donation if login-->
                                                            <?php if ($this->logged_in) { ?>
                                                                <li class="form-submit">
                                                                    <button type="submit" id="subBtn" disabled="disabled">
                                                                        Adote-me
                                                                    </button>
                                                                </li>
                                                            <?php } else { ?>
                                                                <!-- Make donation send to login / register-->
                                                                <li class="form-submit">
                                                                    <a type="button" class="btn donationbutton login-reg"
                                                                       data-toggle="modal" data-target="#loginModal">Adote-me</a>
                                                                </li>
                                                            <?php } ?>
                                                        </ul>
                                                    </form>
                                                    <!--Donation form END-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Tab two-->
                                    <div class="tab-pane fade" id="nav-two" role="tabpanel"
                                         aria-labelledby="nav-two-tab">
                                        <div class="row">
                                            <div class="col">
                                                <div class="rounded" style="text-align: center;">
                                                    <img src="/Images/trees/medronheiro.png" alt="Medronheiro" class="img-fluid border border-secondary">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <h4>Medronheiro</h4>
                                                <p><b>(Arbutus unedo)</b></p>
                                                <p> Matagais em vertentes e barrancos, sombrios ou soalheiros, por vezes
                                                    dominante originando medronhais. Também em bosques perenifólios
                                                    (azinhais, sobreirais) e mais raramente pinhais ou eucaliptais.
                                                    Indiferente edáfico, em diversos tipos de solos, incluindo
                                                    rochosos.</p>
                                                <br>
                                                <div>
                                                    <p><b>Mais informações clique no link:</b></p>
                                                    <p><a href="https://flora-on.pt/?q=Arbutus" target="_blank">https://flora-on.pt/?q=Arbutus</a></p>
                                                </div>
                                                <div>
                                                    <!--Donation form-->
                                                    <form id="newDonation">
                                                        <ul class="radio-boxes">
                                                            <div class="alert alert-warning alert-dismissible fade show"
                                                                 role="alert" hidden>
                                                                <strong>Selecione o valor e faça adoção!</strong>
                                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="col-12">
                                                                <p class="mb-0 mr-4 "><span class="top-highlight">€2.50</span>
                                                                </p>
                                                            </div>
                                                            <!-- Make donation if login-->
                                                            <?php if ($this->logged_in) { ?>
                                                                <li class="form-submit">
                                                                    <button type="submit" id="subBtn" disabled="disabled">
                                                                        Adote-me
                                                                    </button>
                                                                </li>
                                                            <?php } else { ?>
                                                                <!-- Make donation send to login / register-->
                                                                <li class="form-submit">
                                                                    <a type="button" class="btn donationbutton login-reg"
                                                                       data-toggle="modal" data-target="#loginModal">Adote-me</a>
                                                                </li>
                                                            <?php } ?>
                                                        </ul>
                                                    </form>
                                                    <!--Donation form END-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Tab three-->
                                    <div class="tab-pane fade" id="nav-three" role="tabpanel"
                                         aria-labelledby="nav-three-tab">
                                        <div class="row">
                                            <div class="col">
                                                <div class="rounded" style="text-align: center;">
                                                    <img src="/Images/trees/castanheiro.png" alt="Sobreiro" class="img-fluid border border-secondary">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <h4>Castanheiro</h4>
                                                <p><b>(Castanea Sativa)</b></p>
                                                <p>Acompanhante em matas e bosques caducifólios, geralmente em regiões
                                                    montanhosas ou frescas, em substratos siliciosos. Cultivado desde a
                                                    antiguidade, em povoamentos abertos para produção de castanha
                                                    (soutos) ou povoamentos com grande densidade de árvores, para
                                                    produção de lenha (castinçais).</p>
                                                <br>
                                                <div>
                                                    <p><b>Mais informações clique no link:</b></p>
                                                    <p><a href="https://flora-on.pt/?q=Castanea" target="_blank">https://flora-on.pt/?q=Castanea</a></p>
                                                </div>
                                                <div>
                                                    <!--Donation form-->
                                                    <form id="newDonation">
                                                        <ul class="radio-boxes">
                                                            <div class="alert alert-warning alert-dismissible fade show"
                                                                 role="alert" hidden>
                                                                <strong>Selecione o valor e faça adoção!</strong>
                                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="col-12">
                                                                <p class="mb-0 mr-4 "><span class="top-highlight">€2.50</span></p>
                                                            </div>
                                                            <!-- Make donation if login-->
                                                            <?php if ($this->logged_in) { ?>
                                                                <li class="form-submit">
                                                                    <button type="submit" id="subBtn" disabled="disabled">
                                                                        Adote-me
                                                                    </button>
                                                                </li>
                                                            <?php } else { ?>
                                                                <!-- Make donation send to login / register-->
                                                                <li class="form-submit">
                                                                    <a type="button" class="btn donationbutton login-reg"
                                                                       data-toggle="modal" data-target="#loginModal">Adote-me</a>
                                                                </li>
                                                            <?php } ?>
                                                        </ul>
                                                    </form>
                                                    <!--Donation form END-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Tab four-->
                                    <div class="tab-pane fade" id="nav-four" role="tabpanel"
                                         aria-labelledby="nav-four-tab">
                                        <div class="row">
                                            <div class="col">
                                                <div class="rounded" style="text-align: center;">
                                                    <img src="/Images/trees/car_monchique.png" alt="Sobreiro" class="img-fluid border border-secondary">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <h4>Carvalho de Monchique </h4>
                                                <p><b>(Quercus canariensis) </b></p>
                                                <p> Ainda sem informação</p>
                                                <br>
                                                <div>
                                                    <p><b>Mais informações clique no link:</b></p>
                                                    <p><a href=" https://flora-on.pt/?q=Quercus+canariensis" target="_blank">https://flora-on.pt/?q=Quercus+canariensis</a></p>
                                                </div>
                                                <div>
                                                    <!--Donation form-->
                                                    <form id="newDonation">
                                                        <ul class="radio-boxes">
                                                            <div class="alert alert-warning alert-dismissible fade show"
                                                                 role="alert" hidden>
                                                                <strong>Selecione o valor e faça adoção!</strong>
                                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="col-12">
                                                                <p class="mb-0 mr-4 "><span class="top-highlight">€2.50</span></p>
                                                            </div>
                                                            <!-- Make donation if login-->
                                                            <?php if ($this->logged_in) { ?>
                                                                <li class="form-submit">
                                                                    <button type="submit" id="subBtn" disabled="disabled">
                                                                        Adote-me
                                                                    </button>
                                                                </li>
                                                            <?php } else { ?>
                                                                <!-- Make donation send to login / register-->
                                                                <li class="form-submit">
                                                                    <a type="button" class="btn donationbutton login-reg"
                                                                       data-toggle="modal" data-target="#loginModal">Adote-me</a>
                                                                </li>
                                                            <?php } ?>
                                                        </ul>
                                                    </form>
                                                    <!--Donation form END-->
                                                </div>
                                            </div>
                                        </div>
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
<!--Adoption END-->
<script>
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
    });
</script>

