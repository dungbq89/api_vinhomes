<section class="dq-stt-4">
    <section class="prod-tab p20 custom-carousel">
        <div class="container">
            <div class="product-tabs-title">
                <ul class="tab-head" role="tablist">

                    <li class="active"><a href="#tab1" role="tab" data-toggle="tab">Mới nhất</a>
                    </li>


                    <li><a href="#tab2" role="tab" data-toggle="tab">Nổi bật</a>
                    </li>


                </ul>
            </div>
            <div class="tab-content clearb">


                <div role="tabpanel" class="tab-pane active" id="tab1">
                    <div class="row">
                        <div id="owl-prod-t1" class="owl-carousel">
                            <?php
                            if (isset($productsNew) && count($productsNew)) {
                                foreach ($productsNew as $product) {
                                    ?>
                                    <div class="col-xs-12">
                                        <?php include_component('moduleProduct', 'productItem', array('product' => $product)); ?>
                                    </div>
                                    <?php
                                }
                            }
                            ?>

                        </div>
                    </div>
                </div>


                <div role="tabpanel" class="tab-pane" id="tab2">
                    <div class="row">
                        <div id="owl-prod-t2" class="owl-carousel">
                            <?php
                            if (isset($productsHot) && count($productsHot)) {
                                foreach ($productsHot as $hot) {
                                    ?>
                                    <div class="col-xs-12">
                                        <?php include_component('moduleProduct', 'productItem', array('product' => $hot)); ?>
                                    </div>
                                    <?php
                                }
                            }
                            ?>

                        </div>
                    </div>
                </div>


            </div>
            <div class="ov"></div>
            <div class="ov2"></div>
        </div>

    </section>
</section>