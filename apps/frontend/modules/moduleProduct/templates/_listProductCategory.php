<div class="main">
    <?php
    foreach ($products_category as $product_category) {
        ?>
        <div>
            <h3 class="h3-header-pro bg-orange"><?php echo VtHelper::truncate($product_category->getName(), 30, '...') ?></h3>

            <div class="box-product">
                <?php
                   $productList=moduleProductComponents::getListProductByCategory($product_category->getId());
                foreach ($productList as $key => $product) {
                    $image = '/uploads/' . sfConfig::get('app_product_images') . $product->getImagePath();
                    if ($key == 8) {
                        ?>
                        <a href="<?php echo url_for('@product_list?slug=' . $product_category->getSlug()); ?>"
                           class="btn-view-all" title="<?php echo __("Xem toàn bộ") ?>"><?php echo __("Xem toàn bộ") ?> &gt;&gt;</a>
                           <?php
                           break;
                       }
                       ?>
                    <div class="product-item">
                        <img class="img-product" src="<?php echo VtHelper::getThumbUrl($image, 230, 230, 'default'); ?>"
                             alt="230 x 230">

                        <h3 class="name-pro"><a href="<?php echo url_for('@product_detail?slug=' . $product->getSlug()); ?>"
                                                title="<?php echo htmlspecialchars($product->getProductName()) ?>"><?php echo VtHelper::truncate($product->getProductName(), 30, "...") ?>
                            </a>
                        </h3>
                        <span
                            class="price-pro"><?php echo number_format($product->getPrice(), 0, ',', ".") . "Đ"; ?></span>

                        <div class="info-pro">
                            <?php echo nl2br($product->getDescription()); ?>
                        </div>

                        <div class="box-btn">
                            <a href="<?php echo url_for('@product_detail?slug=' . $product->getSlug()); ?>"
                               title="<?php echo __("Xem chi tiết"); ?>"><?php echo __("Chi tiết") ?></a>
                            <?php if($product->getLink() != ''): ?>
                            <a target="_blank" title="Xem chi tiết" href="<?php echo htmlspecialchars($product->getLink()); ?>"><?php echo __('Mua hàng'); ?></a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
        <?php
    }
    ?>
</div>

