<h3 class="h3-header-pro bg-orange"><?php if(isset($catName)) echo htmlspecialchars($catName) ?></h3>
<div class="box-product">


    <div class="box-full box-left">
        <div class="standard-form">
            <?php if (isset($listProduct)): ?>
                <ul id="product-items" class="group-3">
                    <?php foreach ($listProduct as $product):
                        $path = '/uploads/' . sfConfig::get('app_product_images') . $product['image_path'];
                        ?>
                        <div class="product-item">
                            <img class="img-product"
                                 src="<?php echo VtHelper::getThumbUrl($path, 210, 210, 'default') ?>"
                                 alt="">

                            <h3 class="name-pro"><a
                                    href="<?php echo url_for('@product_detail?slug=' . $product['slug']); ?>"
                                    title=""><?php echo VtHelper::truncate($product->getProductName(), 50, '...') ?></a>
                            </h3>
                            <span class="price-pro"><?php echo number_format($product->getPrice(), 0, '', '.') ?>
                                Đ</span>

                            <div class="info-pro">
                                <?php
                                echo nl2br($product->getDescription());
                                ?>

                            </div>
							<div class="box-btn">
								<a href="<?php echo url_for('@product_detail?slug=' . $product->getSlug()); ?>"
                               class="btn-detail-pro"
                               title="<?php echo __("Xem chi tiết"); ?>"><?php echo __("Chi tiết"); ?></a>
							    <?php if($product->getLink() != ''): ?>
									<a target="_blank" title="Xem chi tiết" href="<?php echo htmlspecialchars($product->getLink()); ?>"><?php echo __('Mua hàng'); ?></a>
								<?php endif; ?>
							</div>
                        </div>

                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
    </div>
    <div class="space-30"></div>
    <div class="clear"></div>
    <div class="box-right-paging">
    <?php
    if ($pager->haveToPaginate()) {
        include_component("common", "pagging", array('redirectUrl' => $url_paging, 'pager' => $pager, 'vtParams' => array('slug' => sfContext::getInstance()->getRequest()->getParameter('slug'))));
    }
    ?>
    </div>
    <div class="clear"></div>

</div>