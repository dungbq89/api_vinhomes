<script type="text/javascript">jwplayer.key = "5qMQ1qMprX8KZ79H695ZPnH4X4zDHiI0rCXt1g==";</script>
<?php if (isset($listVideo) && count($listVideo) > 0): ?>
    <?php
    $url_file = sfConfig::get('app_url_media_file') . '/video/';
    $path = '/uploads/' . sfConfig::get('app_advertise_images') . $listVideo[0]->getImagePath();
    ?>
    <h3 class="h3-tinh-nang"><?php echo __("Video Clip"); ?></h3>
    <div class="video-clip">
        <div class="item item-video">

            <div id="box-video-play" class="video-play" width=300" height="250"></div>

            <div class="more-video">
                <?php
                foreach ($listVideo as $key => $video):
                    ?>
                    <h3>
                        <a id="tit-video<?php echo $video->getId(); ?>" <?php if ($key == 0) echo 'class="title-video-active"'; ?>
                           href="javascript:void(0)"
                           onclick="ajaxLoadVideo('<?php echo url_for1('ajax_load_video'); ?>',<?php echo $video->getId(); ?>)"
                           title="<?php echo htmlspecialchars($video->getName()); ?>"><?php echo VtHelper::truncate($video->getName(), 35, '...') ?></a>
                    </h3>
                <?php
                endforeach;
                ?>
            </div>
        </div>
    </div>
<?php endif; ?>
<div id="script-video">
    <script type="text/javascript">
        jwplayer("box-video-play").setup({
            flashplayer: "/js/jwplayer/jwplayer.flash.swf",
            file: "<?php echo $url_file . $listVideo[0]->getFilePath(); ?>",
            image: "<?php echo $path; ?>",
            aspectratio: '16:9',
            height: 250,
            width: <?php echo $width ?>
        });
    </script>

</div>

<script type="text/javascript">
    function ajaxLoadVideo(url, id) {

        $.ajax({
            type: "GET",
            url: url,
            cache: true,
            data: {
                id: id
            },
            success: function (data) {
                $('a').removeClass('title-video-active');
                obj = $.parseJSON(data);
                $('#script-video').html(obj);
                $('#tit-video' + id).addClass('title-video-active');
            },
            error: function () {
            }
        });
    }

</script>
