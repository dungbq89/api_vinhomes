<div class="col-1-1">
    <div class="title-first-home"><span><?php echo __('Danh sách phòng') ?></span></div>
    <div class="c20 hide-on-mobile"></div>
</div>
<?php if ($listRoom) {
    $count = 0;
    foreach ($listRoom as $room) {
        $count++;
        $path = '/uploads/' . sfConfig::get('app_product_images') . $room['image_path'];
        ?>
        <div class="col-1-4 pad-col-1-3 tab-col-1-2 ">
            <div class="">
                <div class="image-apart">
                    <div class=""></div>
                    <a href="<?php echo url_for1('@room_detail?slug='.$room['slug']) ?>"><img
                            src="<?php echo VtHelper::getThumbUrl($path, 420, 315, 'default') ?>" alt="<?php echo $room['product_name'] ?>"
                            width="100%"></a>
                </div>
                <h2 class="pro-name"><a href="<?php echo url_for1('@room_detail?slug='.$room['slug']) ?>"><?php echo $room['product_name'] ?></a></h2>

                <div class="info-apart">
                    <?php echo $chain['address'] ?>
                    <div class="c10"></div>
                </div>
                <div class="c10"></div>
                <div class="price-book">
            	<span class="col-2-3">
                    <div class="price"><?php echo number_format($room['price_promotion'], 0, '', '.') ?>&nbsp;<?php echo __('vnđ') ?></span>/<?php echo __('ngày') ?></div>
                	<div class="price"><span><?php echo number_format($room['price'], 0, '', '.') ?>&nbsp;<?php echo __('vnđ') ?></span>/<?php echo __('tháng') ?></div>

                </span>
                <span class="col-1-3" style="padding:0px;">
                	<a href="<?php echo url_for1('@booking?id=' . $room['id']) ?>" class="quick-book"><?php echo __('Book') ?> <i class="fa fa-chevron-right"
                                                                              aria-hidden="true"></i></a>
                </span>

                    <div class="c"></div>
                </div>
            </div>

        </div>
        <div class="c20 mobile-break"></div>
        <?php if($count%4==0) echo '<div class="c20" style="clear: both;"></div>' ?>
        <?php
    }
} ?>
