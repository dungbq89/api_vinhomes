<div class="grid grid-pad">
    <div class="c20"></div>
    <div class="crumb hide-on-mobile">
        <a href="/"> <?php echo __('Trang chủ') ?> </a> / <a href="javascript:void(0)"> <?php echo __('Căn hộ') ?></a>
    </div>
    <div class="c20"></div>
    <h1 class="title-first-home">
        <span><?php echo __('Căn hộ') ?></span>
    </h1>

    <div class="c20"></div>
    <?php if (!empty($listChain) && isset($listChain) && count($listChain)) {
        $dem = 1;
        foreach ($listChain as $chain) {
            $path = '/uploads/' . sfConfig::get('app_category_images') . $chain->image_path;
            ?>

            <div class="col-1-4 pad-col-1-3 tab-col-1-2 ">
                <div class="">
                    <div class="image-apart"
                         data-image="<?php echo VtHelper::getThumbUrl($path, 420, 315, 'default') ?>">
                        <a href="<?php echo url_for1('@chain_detail?slug=' . $chain->slug) ?>"><img
                                src="<?php echo VtHelper::getThumbUrl($path, 420, 315, 'default') ?>"
                                alt="<?php echo $chain->name ?>"
                                width="100%"></a>
                    </div>
                    <h2 class="pro-name"><?php echo $chain->name ?></h2>

                    <div class="chain-info">
                        <div><a href="<?php echo url_for1('@chain_detail?slug=' . $chain->slug) ?>"><i
                                    class="fa fa-map-marker"></i> <?php echo $chain->address ?></a></div>
                        <div><a href="<?php echo url_for1('@chain_detail?slug=' . $chain->slug) ?>"><i
                                    class="fa fa-picture-o"></i> Photos</a></div>
                        <div><a href="<?php echo url_for1('@chain_detail?slug=' . $chain->slug) ?>l"><i
                                    class="fa fa-map"></i> Map</a></div>
                    </div>
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
    <div class="c"></div>
    <div class="col-1-1">
        <div class="paging">
            <div class="pages fl">
                <?php
                if ($pager->haveToPaginate()) {
                    include_component("common", "pagging", array('redirectUrl' => $url_paging, 'pager' => $pager, 'vtParams' => array('slug' => sfContext::getInstance()->getRequest()->getParameter('slug'))));
                }
                ?>
            </div>
        </div>
        <div class="c20"></div>
    </div>
</div>