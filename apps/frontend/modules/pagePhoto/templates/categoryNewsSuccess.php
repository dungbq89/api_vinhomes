<div class="grid grid-pad">
    <div class="c20"></div>
    <div class="crumb hide-on-mobile">
        <a href="/"> <?php echo __('Trang chủ') ?> </a>/ <a
            href="<?php url_for1('@news') ?>"> <?php echo __('Tin tức') ?></a> / <a
            href="<?php echo 'javascript:void(0)' ?>"> <?php echo $catName ?></a>
    </div>
    <div class="c20"></div>
    <h1 class="title-first-home">
        <span> <?php echo $catName ?></span>
    </h1>

    <div class="c20"></div>
    <?php if (!empty($listArticle) && isset($listArticle) && count($listArticle)) {
        $dem = 1;
        foreach ($listArticle as $article) {
            ?>

            <div class="col-1-4 pad-col-1-3 tab-col-1-2 ">
                <div class="">
                    <div class="image-apart">
                        <a href="<?php echo url_for1('@news_detail?slug=' . $article->slug) ?>"><img
                                src="<?php echo VtHelper::getPathImage($article->image_path, sfConfig::get('app_article_images', 'article')) ?>"
                                alt="<?php echo $article->title ?>"
                                width="100%"></a>
                    </div>
                    <h2 class="pro-name"><a
                            href="<?php echo url_for1('@news_detail?slug=' . $article->slug) ?>"> <?php echo $article->title ?></a>
                    </h2>

                    <div class="chain-info">
                        <div><a href="<?php echo url_for1('@news_detail?slug=' . $article->slug) ?>">
                                <?php echo $article->header ?>
                            </a></div>

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