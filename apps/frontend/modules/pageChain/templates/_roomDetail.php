<?php
/**
 * Created by PhpStorm.
 * User: conghuyvn8x
 * Date: 7/14/2017
 * Time: 11:51 PM
 */
?>
<div>
    <div class="c20"></div>
    <div class="col-3-5" style="min-height:10px;">
        <div id="bigimage"><img
                src="<?php echo VtHelper::getThumbUrl('/uploads/' . sfConfig::get('app_product_images') . $room['image_path'], 700, 450, 'default') ?>"
                width="100%"/></div>
        <div class="c10"></div>
        <div>
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <div class="swiper-slide roomthumb"><img
                            src="<?php echo VtHelper::getThumbUrl('/uploads/' . sfConfig::get('app_product_images') . $room['image_path'], 700, 450, 'default') ?>"
                            width="100%"/></div>

                    <?php if ($listImage) {
                        foreach ($listImage as $img) {
                            $path = '/uploads/' . sfConfig::get('app_product_images') . $img['file_path'];
                            ?>
                            <div class="swiper-slide roomthumb"><img
                                    src="<?php echo VtHelper::getThumbUrl($path, 700, 450, 'default') ?>"
                                    width="100%"/></div>
                            <?php
                        }
                    } ?>

                </div>
            </div>
            <script>
                var swiper = new Swiper('.swiper-container', {
                    pagination: '',
                    slidesPerView: 5,
                    paginationClickable: true,
                    spaceBetween: 20
                });

                $('.roomthumb img').click(function () {
                    $('#bigimage').hide();
                    $('#bigimage').html('<img src="' + $(this).attr('src') + '" width="100%">').stop().fadeIn();
                });

            </script>

        </div>
    </div>
    <div class="col-2-5">
        <h1 class="news-name-detail"><?php echo $room['product_name'] ?></h1>

        <div class="c10"></div>
        <div style="line-height:25px">
            <div><strong><?php echo __('Loại phòng') ?>:</strong></div>
            <div class="price-detail">
                <div>
                    <span><?php echo number_format($room['price_promotion'], 0, '', '.') ?>&nbsp;<?php echo __('vnđ') ?></span>/<?php echo __('ngày') ?>
                </div>
                <div><span><?php echo number_format($room['price'], 0, '', '.') ?>&nbsp;<?php echo __('vnđ') ?></span>/<?php echo __('tháng') ?></div>
            </div>
        </div>
        <div class="c10"></div>
        <div style="border-bottom:solid 1px #DDD"></div>
        <div class="c20"></div>
        <div><span style="font-size:12px;"><em><?php echo $chain['address'] ?></em></span></div>
        <div class="c20"></div>
        <a href="<?php echo url_for1('@booking?id=' . $room['id']) ?>" class="quick-book"><?php echo __('Book') ?> <i class="fa fa-chevron-right"
                                                                                      aria-hidden="true"></i></a>
        <div class="c20"></div>
        <div><?php echo $room['description'] ?></div>

        <div class="c20"></div>
        <!-- AddThis Button BEGIN -->
        <div class="addthis_toolbox addthis_default_style ">
            <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
            <a class="addthis_button_tweet"></a>
            <a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
            <a class="addthis_counter addthis_pill_style"></a>

        </div>

        <!-- AddThis Button END -->

    </div>

    <div class="c20"></div>
    <div><?php echo $room['content'] ?></div>
</div>
