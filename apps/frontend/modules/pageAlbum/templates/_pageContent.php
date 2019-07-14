<div class="box-gallary">
    <h3 class="title-item">Tư liệu ảnh</h3>
    <?php
    if (isset($listAlbum) && $listAlbum):
        foreach ($listAlbum as $item):
            $path = '/uploads/' . sfConfig::get('app_album_images') . $item->getImagePath();
            ?>
            <div class="gallary-item">
                <a href="<?php echo url_for('@page_album?slug='.$item->getSlug()); ?>" title=""> <img class="img-gallary-item" src="<?php echo $path; ?>" alt=""></a>
               <span class="txt-date">
                    <?php if($item->getEventDate()) echo VtHelper::getFormatDate($item->getEventDate()); ?>
               </span>

                <h3><a href="<?php echo url_for('@page_album?slug='.$item->getSlug()); ?>" title=""><?php echo htmlspecialchars($item->getName()); ?></a></h3>

                <p class="txt-news">
                    <?php echo VtHelper::truncate($item->getDescription(),120,'...'); ?>
                </p>
            </div>
        <?php
        endforeach;
    endif;
    ?>
    <?php
    if ($pager->haveToPaginate()) {
        include_component("common", "pagging", array('redirectUrl' => $url_paging, 'pager' => $pager, 'vtParams' => array('slug' => sfContext::getInstance()->getRequest()->getParameter('slug'))));
    }
    ?>


</div>