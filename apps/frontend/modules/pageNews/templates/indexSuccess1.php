<div class="col-main">
    <div class="box">
        <h3 class="title-main"><span class="label"><?php echo htmlspecialchars($catName); ?> »</span></h3>
        <?php
        if (isset($listArticle) && count($listArticle)):
            foreach ($listArticle as $item):
                $path = '/uploads/' . sfConfig::get('app_article_images') . $item->getImagePath();
                ?>
                <div class="list-news">
                    <a href="<?php echo url_for('@article_detail?slug='. $item->getSlug()) ?>" title="" class="news-img"><img src="<?php echo VtHelper::getThumbUrl($path, 180, 108) ?>" alt=""></a>

                    <div class="news-info">
                        <a href="<?php echo url_for('@article_detail?slug='. $item->getSlug()) ?>" title="" class="news-title">
                            <?php echo htmlspecialchars($item->getTitle()); ?>
                        </a>

                        <p class="news-txt"><?php echo VtHelper::truncate($item->getHeader(),180,'...'); ?></p>

                        <p class="news-date"><?php if($item->getPublishedTime()) echo VtHelper::getFormatDate($item->getPublishedTime()); ?></p>
                        <a href="<?php echo url_for('@article_detail?slug='. $item->getSlug()) ?>" class="readmore" title="Xem tiếp">Xem tiếp</a>
                    </div>
                    <div class="clear"></div>
                </div>
            <?php
            endforeach;
        endif;
        ?>

        <?php
        if ($pager->haveToPaginate()){
            include_component("common", "pagging", array('redirectUrl'=>$url_paging,'pager'=>$pager,'vtParams'=>array('slug'=>sfContext::getInstance()->getRequest()->getParameter('slug'))));
        }
        ?>
    </div>
</div>
