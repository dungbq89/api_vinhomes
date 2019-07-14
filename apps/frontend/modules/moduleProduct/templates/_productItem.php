<div class="product-grid">
    <div class="prod-image">
        <div class="image-wrapper">
            <a href="<?php echo url_for('detail_item', array('slug' => $product->getSlug())); ?>">
                <img alt="<?php echo $product->getProductName(); ?>" class="img-responsive"
                     src="<?php echo VtHelper::getThumbUrl($image, 237, 240, 'default'); ?>">
            </a>
            <?php
            if ($percent) {
                ?>
                <span class="flag sale">-<?php echo $percent; ?>%</span>
                <?php
            }
            ?>

        </div>
    </div>

    <div class="prod-detail">
        <h3>
            <a href="<?php echo url_for('detail_item', array('slug' => $product->getSlug())); ?>"><?php echo $product->getProductName(); ?></a>
        </h3>
        <div class="grid-review">
            <div class="inline-b">
                <div class="bizweb-product-reviews-badge" data-id="32602"></div>
            </div>
        </div>
        <div class="prod-price">
            <?php
            if ($product->price_promotion && $product->price) {
                ?>
                <span class="price"><?php echo number_format($product->price_promotion, 0, ",", ".") . 'đ'; ?></span>
                <span class="compare-price"><?php echo number_format($product->price, 0, ",", ".") . 'đ'; ?></span>
                <?php
            } elseif ($product->price) {
                ?>
                <span class="price"><?php echo number_format($product->price, 0, ",", ".") . 'đ'; ?></span>
                <?php
            }
            ?>

        </div>
    </div>
</div>