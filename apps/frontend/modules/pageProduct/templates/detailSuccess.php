<style>
    .add-to-cart {
        background: #d42d2d !important;
        color: #fff !important;
    }
</style>

<section class="breadc">

    <div class="container breadpos">

        <div class="pull-left">
            <ol class="breadcrumb breadcrumbs" itemscope="">
                <li class="home">
                    <a itemprop="url" href="<?php echo url_for('homepage'); ?>"><span itemprop="title">Trang chủ</span></a>
                    <span><i class="fa fa-angle-right"></i></span>
                </li>
                <li>
                    <span itemprop="title">Chi tiết sản phẩm</span>
                    <span><i class="fa fa-angle-right"></i></span>
                </li>
                <li><strong itemprop="title"><?php echo htmlspecialchars($product->getProductName()) ?></strong></li>

            </ol>
        </div>
    </div>
</section>

<section class="p20">
    <div class="container">
        <div class="row p20">
            <div itemscope class="product">
                <div class="col-md-6 product-image-block ">
                    <?php
                    $image = '/uploads/' . sfConfig::get('app_product_images') . $product->getImagePath();
                    ?>
                    <div class="featured-image">
                        <img id="product-featured-image" class="img-responsive"
                             src="<?php echo VtHelper::getThumbUrl($image, 474, 480, 'default'); ?>"
                             alt="Sopha văng"/>
                    </div>


                    <!--                    <div class="swiper-container more-views" data-margin="10" data-items="5" data-direction="vertical">-->
                    <!--                        <div class="swiper-wrapper">-->
                    <!--                            --><?php
                    //                            if (isset($productImages) && count($productImages)) {
                    //                                foreach ($productImages as $proImage) {
                    //                                    $imageThumb = '/uploads/' . sfConfig::get('app_product_images') . $proImage['file_path'];
                    //                                    ?>
                    <!--                                    <div class="swiper-slide">-->
                    <!--                                        <a href="-->
                    <?php //echo VtHelper::getThumbUrl($imageThumb, 474, 480, 'default'); ?><!--"-->
                    <!--                                           class="thumb-link" title=""-->
                    <!--                                           rel="-->
                    <?php //echo VtHelper::getThumbUrl($imageThumb, 474, 480, 'default'); ?><!--">-->
                    <!--                                            <img src="-->
                    <?php //echo VtHelper::getThumbUrl($imageThumb, 90, 90, 'default'); ?><!--"-->
                    <!--                                                 alt="">-->
                    <!--                                        </a>-->
                    <!--                                    </div>-->
                    <!--                                    --><?php
                    //                                }
                    //                            }
                    //                            ?>
                    <!--                        </div>-->
                    <!--                    </div>-->

                </div>
                <div class="col-md-6 detail">
                    <div class="prod-detail">
                        <h1 itemprop="name"
                            class="product-title"><?php echo htmlspecialchars($product->getProductName()); ?></h1>

                        <div class="prod-price">
                            <span class="price" itemprop="price">2.000.000₫</span>
                            <span class="compare-price" itemprop="price">2.500.000₫</span>
                        </div>

                        <div class="product-summary rte">
							<span>
                                <?php echo nl2br($product->getDescription()); ?>
							</span>
                        </div>

                        <div class="check-contact prod-btn clearfix ">
                            <a class="add-to-cart" href="<?php echo url_for('order',array('id'=>$product->getId())); ?>">
                                <i class="fa fa-shopping-cart"></i><span>Đặt hàng</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row p20">
            <div class="col-md-8">
                <div class="detail_tab">
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#tab_1" aria-controls="home" role="tab"
                                                                  data-toggle="tab">Mô tả</a></li>
                    </ul>
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="tab_1">
                            <p style="color: rgb(0, 0, 0); font-family: Arial, Verdana, sans-serif; font-size: 14px; line-height: normal;">
                                <?php echo $product->getContent(); ?>
                            </p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>