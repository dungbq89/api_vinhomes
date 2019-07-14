<?php
$url_file = sfConfig::get('app_url_media_file') . '/video/';
?>
<script type="text/javascript">jwplayer.key="5qMQ1qMprX8KZ79H695ZPnH4X4zDHiI0rCXt1g==";</script>
<div class="box-play-video">
    <div class="play-video">
        <?php
        if ($videoDefault) {
            $url_file = sfConfig::get('app_url_media_file') . '/video/'.$videoDefault->getFilePath();
            $path = '/uploads/' . sfConfig::get('app_advertise_images') . $videoDefault->getImagePath();
        }
        ?>
        <div id="box-video-play" width="630" height="350"></div>
    </div>
    <div class="txt-gallery">
        <h3><a href="" title=""><?php echo htmlspecialchars($videoDefault->getName()); ?></a></h3>
                    <span class="txt-gallery-date">
                        <?php echo VtHelper::getFormatDate($videoDefault->getEventDate()); ?>
                    </span>
                    <span class="txt-gallery-news">
                        <?php echo VtHelper::truncate(htmlspecialchars($videoDefault->getDescription()), 300, ''); ?>
                    </span>
    </div>
</div>
<div class="clear"></div>
<script type="text/javascript">
    jwplayer("box-video-play").setup({
        flashplayer: "/js/jwplayer/jwplayer.flash.swf",
        file: "<?php echo $url_file; ?>",
        image: '<?php echo $path; ?>',
        aspectratio: '16:9',
        height: 350,
        width: 630
    });
</script>

