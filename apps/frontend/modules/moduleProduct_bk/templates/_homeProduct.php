<?php
/**
 * Created by PhpStorm.
 * User: dung
 * Date: 12/1/2015
 * Time: 11:16 PM
 */ ?>
<?php if (isset($products)): ?>
    <div class="features_items"><!--features_items-->
        <h2 class="title text-center">Sản phẩm nổi bật</h2>
        <?php
        for ($i = 0; $i < count($products); $i++) {
            $link = '';
            if ($products[$i]['link'] != '') {
                $link = $products[$i]['link'];
            } else {
                $link = url_for('@product_detail?slug=' . $products[$i]['slug']);
            }
            $path = '/uploads/' . sfConfig::get('app_product_images') . $products[$i]['image_path'];
            ?>
            <div class="col-sm-4">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <img src="<?php echo VtHelper::getThumbUrl($path, 268, 249, 'product_268_249') ?>" alt="<?php echo VtHelper::truncate($products[$i]['product_name'], 200, '...'); ?>"/>

                            <h2 class="price-product">
                                <?php
                                if($products[$i]['price']){
                                    echo number_format($products[$i]['price'],0,",",".").' vnđ';
                                }
                                else{
                                    echo 'Liên hệ';
                                }
                                ?>
                            </h2>

                            <h3 class="h3-title-product">
                                <a class="title-product" href="<?php echo htmlspecialchars($link); ?>" title="<?php echo htmlspecialchars($products[$i]['product_name']); ?>"><?php echo VtHelper::truncate($products[$i]['product_name'], 50, '...'); ?></a>
                            </h3>
                        </div>

                    </div>

                </div>
            </div>
        <?php
        }
        ?>

    </div><!--features_items-->
<?php endif; ?>