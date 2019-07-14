<script type="text/javascript">
    $(document).ready(function() {
        $("body").removeClass("home-index");
        $("body").addClass("catalog-category");
    });
</script>
<div class="master-two-column">
    <div class="main-top desk">
        <img src="http://www.cattuongled.com.vn/Themes/CatTuongLed/Content/images/banner-main-top.jpg">
    </div>
    <div class="breadcrumb br-category">
        <h2 style="color: #2b5c83; font-weight: bold;"><?php echo htmlspecialchars($product->getProductName()) ?></h2>
    </div>
    <div class="side-2">

        <?php include_component('moduleProduct','boxSupport'); ?>

    </div>
    <div class="center-2">


        <!--product breadcrumb-->


        <div class="page product-details-page">
            <div class="page-body">

                <form action="/cps-dp-e27-12par30" id="product-details-form" method="post">
                    <div itemscope itemtype="http://schema.org/Product" data-productid="123">
                        <div class="product-essential">

                            <!--product pictures-->
                            <?php
                            $path = '/uploads/' . sfConfig::get('app_product_images') . $product->getImagePath();
                            ?>
                            <div class="gallery">
                                <div class="picture">
                                    <img alt="<?php echo htmlspecialchars($product->getProductName()) ?>" src="<?php echo VtHelper::getThumbUrl($path, 687, 465) ?>" alt="<?php echo htmlspecialchars($product->getProductName()) ?>"
                                         width="400" title="<?php echo htmlspecialchars($product->getProductName()) ?>" itemprop="image" id="main-product-img-123" />
                                </div>

                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $('.thumb-popup-link').magnificPopup(
                                            {
                                                type: 'image',
                                                removalDelay: 300,
                                                gallery: {
                                                    enabled: true
                                                }
                                            });
                                    });
                                </script>
                            </div>

                            <div class="overview">
                                <div class="product-name">
                                    <h2 style="font-size: 16px; font-weight: bold;">Mô tả:</h2>
                                    <p><?php echo htmlspecialchars($product->getDescription()); ?></p>
                                </div>

                                <div class="prices">
                                    <div class="product-price">
                                        <span itemprop="price" class="price-value-123">
                                            <?php if($product->getPrice()) echo number_format(htmlspecialchars($product->getPrice()), 0, ",", ".").' đ'; else echo 'Liên hệ';?>
                                        </span>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="product-collateral">
                            <ul class="tab">
                                <li class="active"><a href="javascript:;">Chi tiết</a></li>
                            </ul>
                            <div class="tabcontainer">
                                <div class="tabitem active">
                                    <div class="full-description" itemprop="description" style="font-size: 14px; line-height: 22px; margin-left: 3px;">
                                        <?php echo $product->getContent(); ?>
                                    </div>



                                </div>
                                <div class="tabitem">

                                </div>
                            </div>
                        </div>
                        <div class="relatedproducts">


                        </div><!-- end relatedproducts -->
                    </div>
                </form>
            </div>
        </div>


    </div>

</div>

