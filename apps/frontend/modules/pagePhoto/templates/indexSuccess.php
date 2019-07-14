<div class="grid grid-pad">
    <div class="c20"></div>
    <div class="crumb hide-on-mobile">
        <a href="/"> <?php echo __('Trang chủ') ?> </a> / <a href="javascript:void(0)"> <?php echo __('Hình ảnh') ?></a>
    </div>
    <div class="c20"></div>
    <h1 class="title-first-home">
        <span><?php echo __('Hình ảnh') ?></span>
    </h1>

    <div class="c20"></div>
    <?php if (!empty($albumPhoto)) {
        $dem = 1;
        foreach ($albumPhoto as $photo) {
            $path = '/uploads/' . sfConfig::get('app_album_images') . $photo['image_path'];
            ?>

            <div class="col-1-4 pad-col-1-3 tab-col-1-2 ">
                <div class="">
                    <div class="image-apart">
                        <a href="<?php echo url_for1('@category_photo?slug='.$photo['slug']) ?>"><img
                                src="<?php echo VtHelper::getThumbUrl($path, 240, 156, 'default') ?>"
                                alt="<?php echo $photo['name'] ?>"
                                width="100%"></a>
                    </div>
                    <h2 class="pro-name"><?php echo $photo['name'] ?></h2>
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