<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ngoctv1
 * Date: 5/6/14
 * Time: 5:46 PM
 * To change this template use File | Settings | File Templates.
 */


if (count($advertise) > 0) {
    $type = $advertise[0]['view_type'];
    $advertiseImage = $advertise[0]['AdvertiseImage'];
    $count = count($advertiseImage);
}

?>

<?php if (isset($count) && $count > 0) : ?>
    <?php if ($type == 1): ?>
        <div class="slider" style="margin-top: -23px;">
            <div style="width: 100%;"
                 class="ml-slider-3-10-0 metaslider metaslider-nivo metaslider-42 ml-slider">

                <div id="metaslider_container_42">
                    <div class='slider-wrapper theme-default'>
                        <div class='ribbon'></div>
                        <div id='metaslider_42' class='nivoSlider'>
                            <?php for ($i = 0; $i < count($advertiseImage); $i++):
                                $path = '/uploads/' . sfConfig::get('app_advertise_images') . $advertiseImage[$i]['file_path'];
                                ?>
                                <li><a href="<?php echo htmlspecialchars($advertiseImage[$i]['link']) ?>" target="_blank">
<!--                                        <img height="378" width="1920" class="slider-42 slide-494" src="--><?php //echo sfConfig::get('app_url_media_file') . '/' . sfConfig::get('app_advertise_images') . $advertiseImage[$i]['file_path']; ?><!--"/>-->
                                        <img height="378" width="1920" class="slider-42 slide-494" src="<?php echo VtHelper::getThumbUrl($path, 1024, 378, 'default') ?>"/>
                                    </a></li>
                            <?php endfor; ?>



                    </div>

                </div>
            </div>
        </div>

    <?php endif; ?>
<?php endif; ?>


