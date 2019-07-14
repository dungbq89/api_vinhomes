<?php
/**
 * Created by PhpStorm.
 * User: conghuyvn8x
 * Date: 7/13/2017
 * Time: 8:01 PM
 */
?>
<div>
    <div class="col-3-5 tab-100" style="padding-right:0px;">
        <div style="margin-right:20px">
            <?php if ($images) { ?>
                <section class="slider">
                    <div id="slider" class="flexslider">
                        <ul class="slides">
                            <?php foreach ($images as $img) { ?>
                                <li>
                                    <img
                                        src="<?php echo VtHelper::getPathImage($img['file_path'], sfConfig::get('app_ManageAdChainImage_prefix', 'chain')) ?>"
                                        alt="<?php echo $chain['name'] ?>"
                                        width="100%">
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <div id="carousel" class="flexslider">
                        <ul class="slides thumb-slides">
                            <?php foreach ($images as $img) { ?>
                                <li>
                                    <div style="margin:0px 5px 0px 0px"><img
                                            src="<?php echo VtHelper::getPathImage($img['file_path'], sfConfig::get('app_ManageAdChainImage_prefix', 'chain')) ?>"
                                            alt="<?php echo $chain['name'] ?>"
                                            width="100%"></div>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </section>
            <?php } ?>

        </div>

        <!--            <script defer src="js/jquery.flexslider.js"></script>-->

        <script type="text/javascript">

            $(window).load(function () {
                $('#carousel').flexslider({
                    animation: "slide",
                    controlNav: false,
                    animationLoop: false,
                    slideshow: false,
                    itemWidth: 110,
                    itemMargin: 0,
                    asNavFor: '#slider',
                    keyboard: true,
                    multipleKeyboard: true
                });

                $('#slider').flexslider({
                    animation: "slide",
                    controlNav: false,
                    animationLoop: false,
                    slideshow: false,
                    sync: "#carousel",
                    keyboard: true,
                    multipleKeyboard: true

                });
            });
        </script>
        <!--            <script src="js/jquery.easing.js"></script>-->
        <!--            <script src="js/jquery.mousewheel.js"></script>-->
    </div>
    <div class="col-2-5 tab-100">
        <div><i class="fa fa-map-marker"></i> <?php echo $chain['address'] ?> </div>
        <div class="c20"></div>
        <div>
            <?php echo nl2br($chain['description']) ?>
        </div>
        <div class="c20"></div>

        <div class="c20"></div>
        <!-- AddThis Button BEGIN -->
        <div class="addthis_toolbox addthis_default_style ">
            <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
            <a class="addthis_button_tweet"></a>
            <a class="addthis_button_pinterest"></a>
            <a class="addthis_button_linkedin"></a>
            <a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
            <a class="addthis_counter addthis_pill_style"></a>
        </div>
        <!-- AddThis Button END -->
        <div class="c5"></div>
    </div>
    <div class="c"></div>
</div>
