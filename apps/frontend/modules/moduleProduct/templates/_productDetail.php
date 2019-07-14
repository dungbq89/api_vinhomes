<?php
if (isset($product)):
    ?>
    <div class="detail-pro">
        <span class="bg-top-detail"></span>
        <?php
        if (isset($productImages) && count($productImages) > 0):
            $path = '/uploads/' . sfConfig::get('app_product_images') . $productImages[0]['file_path'];
            ?>
            <img src="<?php echo $path; ?>" class="img-detail-pro">
        <?php endif; ?>
        <div class="detail-pro-info">
            <h3 class="detail-name-pro" title="<?php echo htmlspecialchars($product->getProductName()) ?>"><?php echo VtHelper::truncate($product->getProductName(), 20, '...') ?></h3>
            <span class="detail-price"><?php echo number_format(htmlspecialchars($product->getPrice()), 0, ",", "."); ?><span class="vnd">đ</span> </span>
            <div class="info-pro">
                <?php
                echo nl2br(htmlspecialchars($product->getDescription()));
                ?>
            </div>
            <?php if($product->getLink() != ''): ?>
            <a class="btn-buy" href="<?php echo htmlspecialchars($product->getLink()); ?>" target="_blank">
                <?php echo __('Mua hàng'); ?>
                <span class="bg-buy"></span>
            </a>
            <?php endif; ?>
        </div>
    </div>
    <div class="box-specifications">
        <h3 class="h3-header-detail-pro"><?php echo __("Thông số kỹ thuật"); ?></h3>
        <div class="specifications-info">
            <?php echo $product->getContent(); ?>
        </div>
        <?php if (isset($productImages) && count($productImages) > 0): ?>
        <div class="slide-detail-pro">
            <ul class="bxsliderpro">
                <?php foreach ($productImages as $key=>$img):
					if($key>0){
                    $pathImg = '/uploads/' . sfConfig::get('app_product_images') . $img['file_path'];
                ?>
                <li><img src="<?php echo VtHelper::getThumbUrl($pathImg, 388, 496); ?>"></li>
                <?php }endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    </div>

<?php endif; ?>

<script type="text/javascript">
    $(document).ready(function() {
        $('.bxsliderpro').bxSlider({
            minSlides: 1,
            maxSlides: 1,
            slideWidth: 388,
            slideHeight: 496,
            pager: false,
            moveSlides: 1
        });

    });
</script>
