<?php
/**
 * Created by PhpStorm.
 * User: conghuyvn8x
 * Date: 6/27/2018
 * Time: 9:54 PM
 */
if ($listItem) {
    foreach ($listItem as $item) {
        ?>
        <div class="col-sm-3 grid-item" style="padding: 10px;min-width: 190px; margin: 0px auto">
            <div class="product-card ">
                <a class="product-thumb" title="<?php echo htmlentities($item['name']) ?>"
                   href="<?php echo url_for('@detail_item?slug=' . $item['slug']) ?>"><img
                        src="<?php echo VtHelper::getUrlImagePathThumb(sfConfig::get('app_article_images'), $item['image'], 100, 100) ?>"
                        class="avatar-store" alt="<?php echo htmlentities($item['name']) ?>"></a>

                <h3 class="product-title" style="height: 30px;" title="<?php echo htmlentities($item['name']) ?>"><a
                        href="<?php echo url_for('@detail_item?slug=' . $item['slug']) ?>"><abbr
                            class="click-pointer" title="<?php echo htmlentities($item['address']) ?>">
                            <?php echo VtHelper::truncate($item['name'], 30) ?>
                        </abbr></a></h3><h4 class="product-price"
                                            style="height: 40px;">
                    <abbr
                        class="click-pointer" title="<?php echo htmlentities($item['address']) ?>">
                        <?php echo VtHelper::truncate($item['address'], 50) ?>
                    </abbr></h4>

<!--                <div class="store-desc">-->
<!--                    <div class="ui padded two column grid">-->
<!--                        <div class="column col-func">-->
<!--                            <div class="func-liked" style="display: inline-flex;"><i-->
<!--                                    aria-hidden="true" class="thumbs up large icon"></i>-->
<!---->
<!--                                <p style="font-size: 20px;">1</p></div>-->
<!--                        </div>-->
<!--                        <div class="column col-func">-->
<!--                            <div class="func-disliked" style="display: inline-flex;"><i-->
<!--                                    aria-hidden="true" class="thumbs down large icon"></i>-->
<!---->
<!--                                <p style="font-size: 20px;">0</p></div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
                <div class="product-buttons">
                    <a href="<?php echo url_for('@detail_item?slug=' . $item['slug']) ?>"
                       title="<?php echo htmlentities($item['name']) ?>"
                       class="btn btn-outline-primary btn-sm">Check hàng</a>
                </div>
            </div>
        </div>
        <?php
    }
} else {
    if ($page == '1') {
        echo "<h1>Không có dữ liệu</h1>";
    }
}
?>