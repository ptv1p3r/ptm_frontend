<?php
/**
 * Created by PhpStorm.
 * User: V1p3r
 * Date: 17/10/2018
 * Time: 20:14
 */
?>
<?php if (!defined('ABSPATH')) exit; ?>

<?php
// Echo session variables that were set on previous page
echo "Donation ==>" . $_SESSION["donationVal"] . "<br>";
?>


<!--New user register Start-->
<section class="wf10 p80">
    <div class="container">
        <div class="row">
            <div class="col-lg-18">
                <div>
                    <h1>Adoção</h1>
                </div>
                <div>
                    <h4>Faça parte desta causa, adotar uma árvore é bastante simples</h4>
                </div>
            </div>
        </div>
    </div>
</section>
<!--New user register End teste-->

<!--Causes Start-->
<section class="wf100 p80">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="donations">
                    <h4>Donation Amount</h4>
                    <ul class="radio-boxes">
                        <li>
                            <div class="radio custom">
                                <input name="donation" id="d1" type="radio" class="css-radio">
                                <label for="d1" class="css-label">€2.5</label>
                            </div>
                        </li>

                        <!--                        <li>-->
                        <!--                            <div class="radio custom">-->
                        <!--                                <input name="donation" id="d1" type="radio" class="css-radio">-->
                        <!--                                <label for="d1" class="css-label">$5</label>-->
                        <!--                            </div>-->
                        <!--                        </li>-->


                    </ul>
                    <div class="payment-method wf100">
                        <ul>
<!--                            <li class="half pr15">-->
<!--                                <h4>Métodos de pagamento <span>Selecione por favor</span></h4>-->
<!---->
<!--                                <select class="form-control">-->
<!---->
<!---->
<!--                                </select>-->
<!--                            </li>-->
                            <li class="half pr15">
                                <h4>Escolha a árvore</h4>
                                <!--                                <p>Please Select the Cause or Project for Contribution</p>-->
                                <select class="form-control" name="adoptList" id="adoptList"
                                        class="form-control customDropdown">

                                    <option value="" disabled selected >Árvore</option>
                                    <?php if (!empty($this->userdata['adoptionList'])) {
                                        foreach ($this->userdata['adoptionList'] as $key => $tree) { ?>
                                            <option value="<?php echo ['id'] ?>">
                                                <?php echo $tree["id"] ?></option>
                                        <?php }
                                    } ?>

                                </select>
                            </li>
                        </ul>
                    </div>


                    <!--                    <div class="your-comments wf100">-->
                    <!--                        <h4>Your Comments</h4>-->
                    <!--                        <textarea class="form-control" placeholder="Write your Comments or Message"></textarea>-->
                    <!--                        <div class="form-check form-check-inline">-->
                    <!--                            <input class="form-check-input" type="checkbox" id="inlineCheckbox4" value="option2">-->
                    <!---->
                    <!--                        </div>-->
                    <!--                    </div>-->


                    <div class="wf100 donator-details">
                        <ul>
                            <li class="half pl15">
                                <input value="Finalize o pedido" type="submit">
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<!--Causes End-->

<!--Script-->






<!--Script End-->





