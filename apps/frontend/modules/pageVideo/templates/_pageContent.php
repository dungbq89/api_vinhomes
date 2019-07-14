<?php
/**
 * Created by JetBrains PhpStorm.
 * User: huync2
 * Date: 12/10/14
 * Time: 9:28 PM
 * To change this template use File | Settings | File Templates.
 */
$listVideo = $pager->getResults();
?>

<div class="box-gallary">
    <h3 class="title-item">Video liên quan</h3>
    <?php
    if ($listVideo) {
        foreach ($listVideo as $item) {
            $path = '/uploads/' . sfConfig::get('app_advertise_images') . $item->getImagePath();
            ?>
            <div class="gallary-item">
                <a href="<?php echo url_for('@videopage?slug=' . $item->getSlug()) ?>" title="">
                    <img class="img-gallary-item" src="<?php echo VtHelper::getThumbUrl($path, 321, 184, 'video_default'); ?>" alt="">
                </a>
               <span class="txt-date">
                    <?php echo VtHelper::getFormatDate($item->getEventDate()); ?>
               </span>

                <h3><a href="<?php echo url_for('@videopage?slug=' . $item->getSlug()) ?>"
                                     title=""><?php echo VtHelper::truncate(htmlspecialchars($item->getName()), 100, '...'); ?></a>
                </h3>
                <p class="txt-news">
                    <?php echo VtHelper::truncate(htmlspecialchars($item->getDescription()), 300, ''); ?>
                </p>
                <a href="<?php echo url_for('@videopage?slug=' . $item->getSlug()) ?>" title=""> <span class="icon-video"></span></a>
            </div>
        <?php
        }

    }
    ?>

    <div class="box-pagging pag-gallary">
        <?php
        if ($pager->haveToPaginate()) {
            include_component("common", "pagging", array('redirectUrl'=>'videopage','pager'=>$pager,'vtParams'=>array('slug'=>sfContext::getInstance()->getRequest()->getParameter('slug'))));
        }
        ?>
    </div>


</div>



