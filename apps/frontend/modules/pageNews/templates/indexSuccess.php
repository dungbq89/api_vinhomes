<div class="grid grid-pad">
    <div class="c20"></div>
    <div class="crumb hide-on-mobile">
        <a href="/"> <?php echo __('Trang chủ') ?> </a> / <a href="javascript:void(0)"> <?php echo __('Tin tức') ?></a>
    </div>
    <div class="c20"></div>
    <h1 class="title-first-home">
        <span><?php echo __('Tin tức') ?></span>
    </h1>

    <div class="c20"></div>
    <?php if (!empty($categorys)) {
        $dem = 1;
        foreach ($categorys as $category) {
            ?>

            <div class="col-1-4 pad-col-1-3 tab-col-1-2 ">
                <div class="">
                    <div class="image-apart" data-image="<?php echo sfConfig::get('app_category_images', 'category_images').$category['image_path'] ?>">
                        <a href="<?php echo url_for1('@category_new?slug='.$category['slug']) ?>"><img
                                src="<?php echo VtHelper::getPathImage($category['image_path'], sfConfig::get('app_category_images', 'category_images')) ?>"
                                alt="<?php echo $category['name'] ?>"
                                width="100%"></a>
                    </div>
                    <h2 class="pro-name"><?php echo $category['name'] ?></h2>

                    <!--                    <div class="chain-info">-->
                    <!--                        <div><a href="/chain/newland-1.html">-->
                    <!--                                --><?php //echo $category['name'] ?>
                    <!--                            </a></div>-->
                    <!---->
                    <!--                    </div>-->
                </div>
                <div class="c20 mobile-break"></div>

            </div>
            <?php if ($dem % 4 == 0) { ?>
                <div class="c20 pc-break"></div>
                <?php
            }
            $dem++;
        }
    } ?>

</div>