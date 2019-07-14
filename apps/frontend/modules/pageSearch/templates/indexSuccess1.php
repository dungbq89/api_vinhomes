<div class="col-main">
    <div class="box">
        <h3 class="title-main"><span class="label"><?php echo __('Tìm kiếm'); ?> »</span></h3>
        <?php
        if (isset($listArticle) && count($listArticle)) {
            foreach ($listArticle as $item):
                $path = '/uploads/' . sfConfig::get('app_article_images') . $item->getImagePath();
                ?>
                <div class="list-news">
                    <a href="<?php echo url_for('@article_detail?slug=' . $item->getSlug()) ?>" title=""
                       class="news-img"><img src="<?php echo VtHelper::getThumbUrl($path, 180, 108) ?>" alt=""></a>

                    <div class="news-info">
                        <a href="<?php echo url_for('@article_detail?slug=' . $item->getSlug()) ?>" title=""
                           class="news-title">
                            <?php echo htmlspecialchars($item->getTitle()); ?>
                        </a>

                        <p class="news-txt"><?php echo VtHelper::truncate($item->getHeader(), 180, '...'); ?></p>

                        <p class="news-date"><?php if ($item->getPublishedTime()) echo VtHelper::getFormatDate($item->getPublishedTime()); ?></p>
                        <a href="<?php echo url_for('@article_detail?slug=' . $item->getSlug()) ?>" class="readmore"
                           title="Xem tiếp">Xem tiếp</a>
                    </div>
                    <div class="clear"></div>
                </div>
            <?php
            endforeach;
            if (isset($pager) && $pager->haveToPaginate()) {
                include_component("common", "pagging", array('redirectUrl' => $url_paging, 'pager' => $pager, 'vtParams' => array('slug' => sfContext::getInstance()->getRequest()->getParameter('slug'))));
            }
        }
        else{
            ?>
                <div style="padding: 20px;">
                    <h4>Không tìm thấy dữ liệu với từ khóa: <span style="font-style: italic;"><?php echo htmlspecialchars($queryName) ?></span></h4>
                </div>
            <?php
        }
        ?>

    </div>
</div>
<div class="col-right">
    <?php include_component('moduleDocument', 'hotDocument', array('limit' => 3)) ?>
    <?php include_component('moduleArticle', 'categoryHot', array('limit' => 3)) ?>
    <?php include_component('moduleAdvertise', 'advertise', array('location' => 'right')); ?>

</div>