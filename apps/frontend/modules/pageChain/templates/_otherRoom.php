<?php
/**
 * Created by PhpStorm.
 * User: conghuyvn8x
 * Date: 7/14/2017
 * Time: 11:52 PM
 */
?>
<div class="c30"></div>
<div class="col-1-1">
    <div class="title-first-home" style="font-size:16px;">
        <span><?php echo __('Phòng khác') ?></span>
    </div>
</div>

<div class="c20"></div>

<?php
if ($listOtherRoom) {
    $count = 0;
    foreach ($listOtherRoom as $room) {
        $path = '/uploads/' . sfConfig::get('app_product_images') . $room['image_path'];
        $count++;
        ?>
        <div class="col-1-4 pad-col-1-3 tab-col-1-2 ">
            <div class="">
                <div class="image-apart">

                    <a href="<?php echo url_for1('@room_detail?slug=' . $room['slug']) ?>"><img
                                src="<?php echo VtHelper::getThumbUrl($path, 420, 315, 'default') ?>"
                                alt="<?php echo $room['product_name'] ?>"
                                width="100%"></a>
                </div>
                <h2 class="pro-name"><a
                            href="<?php echo url_for1('@room_detail?slug=' . $room['slug']) ?>"><?php echo $room['product_name'] ?></a>
                </h2>

                <div class="info-apart"><?php echo $chain['address'] ?>
                    <div class="c10"></div>
                </div>
                <div class="c10"></div>
                <div class="price-book">
            	<span class="col-2-3">

                    <div class="price"><span><?php echo number_format($room['price_promotion'], 0, '', '.') ?>
                            &nbsp;<?php echo __('vnđ') ?></span>/<?php echo __('ngày') ?></div>
                    <div class="price"><span><?php echo number_format($room['price'], 0, '', '.') ?>
                            &nbsp;<?php echo __('vnđ') ?></span>/<?php echo __('tháng') ?></div>
                    <!--                	<div class="price"><span>380 USD $</span>/Month</div>-->
                    <!--                    <div class="price"><span>21 USD $</span>/Day</div>-->
                </span>
                    <span class="col-1-3" style="padding:0px;">
                	<a href="<?php echo url_for1('@booking?id=' . $room['id']) ?>"
                       class="quick-book"><?php echo __('Book') ?> <i class="fa fa-chevron-right"
                                                                      aria-hidden="true"></i></a>
                </span>

                    <div class="c"></div>
                </div>
            </div>

        </div>
        <div class="c20 mobile-break"></div>
        <div class="c20 tab-break"></div>
        <?php
        if ($count % 4 == 0) {
            ?>
            <div class="c20 pc-break"></div>
            <div class="c30"></div>
            <?php
        }
    }
} ?>

<div class="c20 mobile-break"></div>
<div class="c20 tab-break"></div>

<div class="c20 pc-break"></div>
<div class="c30"></div>
