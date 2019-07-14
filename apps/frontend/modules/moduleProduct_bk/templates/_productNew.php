<div id="new-products">
    <span class="icon-new"></span>
    <div class="title"><?php echo __('Sản phẩm mới'); ?></div>
    <div class="clear"></div>
    <div class="line"></div>
    <?php 
        if(isset($products)):
    ?>
    <ul>
        <?php foreach($products as $product): 
            $path= '/uploads/' . sfConfig::get('app_product_images').$product['image_path'];
            ?>
        <li>
            <div class="item">
                <div class="photo">
                    <img src="<?php echo VtHelper::getThumbUrl($path, 71, 71, 'product_71_71') ?>" />
                </div>
                <div class="content">
                    <p><a class="product-name-new" href="<?php echo url_for('@product_detail?slug='.$product['slug']); ?>"><?php echo VtHelper::truncate(htmlspecialchars($product['product_name']),35);?></a></p>
                    <p><?php if($product['price']) echo number_format(htmlspecialchars($product['price']),0,",",".").__(' vnđ') ?></p>
                </div>
                <div class="clear"></div>
            </div>
        </li>
        <?php endforeach; ?>
    </ul>
    <?php endif; ?>
</div>
<div class="space-20"></div>