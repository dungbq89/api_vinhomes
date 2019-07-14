<div class="slide">

    <ul id="image-gallery" class="gallery list-unstyled cS-hidden">
        <?php
        if (isset($listImage) && $listImage) {
            foreach ($listImage as $image) {
                $path = '/uploads/' . sfConfig::get('app_album_images') . $image['file_path'];
                ?>
                <li data-thumb="<?php echo VtHelper::getThumbUrl($path, 630, 378) ?>">
                    <img class="img-gallery" src="<?php echo VtHelper::getThumbUrl($path, 630, 378) ?>"/>

                    <div class="txt-gallery">
                        <h3><a href="" title=""><?php echo htmlspecialchars($album->getName()) ?></a></h3>
                        <span class="txt-gallery-date">
                            <?php if($album->getEventDate()) echo VtHelper::getFormatDate($album->getEventDate()); ?>
                        </span>
                        <span class="txt-gallery-news">
                            <?php echo htmlspecialchars($album->getDescription()) ?>
                        </span>
                    </div>
                </li>
            <?php
            }
        }
        ?>


    </ul>


</div>

<script>
    $(document).ready(function() {
        $("#content-slider").lightSlider({
            loop:true,
            keyPress:true
        });
        $('#image-gallery').lightSlider({
            gallery:true,
            item:1,
            thumbItem:7,
            slideMargin: 0,
            speed:700,
            auto:true,
            loop:true,
            rtl:false,
            adaptiveHeight:false,

            vertical:false,
            verticalHeight:2000,
            vThumbWidth:100,

            pager: true,
            galleryMargin: 12,
            thumbMargin: 15,
            currentPagerPosition: 'middle',

            enableTouch:true,
            enableDrag:true,
            freeMove:true,
            swipeThreshold: 40,

            responsive : [],
            onSliderLoad: function() {
                $('#image-gallery').removeClass('cS-hidden');
            }
        });
    });
</script>

