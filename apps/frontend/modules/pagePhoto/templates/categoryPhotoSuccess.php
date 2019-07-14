<div class="grid grid-pad">
    <div class="c20"></div>
    <!--    <div class="crumb hide-on-mobile">-->
    <!--        <a href="/"> --><?php //echo __('Trang chủ') ?><!-- </a> / <a href="javascript:void(0)"> -->
    <?php //echo __('Hình ảnh') ?><!--</a>-->
    <!--    </div>-->
    <!--    <div class="c20"></div>-->
    <!--    <h1 class="title-first-home">-->
    <!--        <span>--><?php //echo __('Hình ảnh') ?><!--</span>-->
    <!--    </h1>-->
    <!---->
    <!--    <div class="c20"></div>-->

    <script type="text/javascript" src="highslide/highslide-with-gallery.js"></script>
    <link rel="stylesheet" type="text/css" href="highslide/highslide.css"/>
    <script type="text/javascript">
        hs.graphicsDir = '/highslide/graphics/';
        hs.align = 'center';
        hs.transitions = ['expand', 'crossfade'];
        hs.outlineType = 'rounded-white';
        hs.fadeInOut = true;
//        hs.dimmingOpacity = 0.75;

        hs.addSlideshow({
            interval: 5000,
            repeat: false,
            useControls: true,
            fixedControls: 'fit',
            overlayOptions: {
//                opacity: 0.75,
                position: 'bottom center',
                hideOnMouseOut: true
            }
        });
    </script>
    <div class="grid grid-pad" style="background:#FFF">
        <div class="c20"></div>
        <div class="col-1-1">
            <div class="crumb hide-on-mobile">
                <a href="/"> <?php echo __('Trang chủ') ?> </a> / <a
                    href='<?php echo url_for1('@photo') ?>'><?php echo __('Hình ảnh') ?></a>&nbsp;<i
                    class='fa fa-angle-right'></i>&nbsp;<a
                    href='javascript:void(0)'><?php echo $albumPhoto['name'] ?> </a>
            </div>
            <div class="c20"></div>
            <h2 class="title-first-home">
                <span><?php echo $albumPhoto['name'] ?></span>
            </h2>
        </div>
        <div class="c20"></div>
        <div class="intro-cat"></div>
        <div class="">
            <div class="c20"></div>
            <div>
                <?php
                if (!empty($listPhoto)) {
                    ?>
                    <div style="padding-right:0px;">
                        <section class="slider">
                            <div id="slider" class="flexslider view-photo">
                                <ul class="slides">
                                    <?php
                                    foreach ($listPhoto as $photo) {
                                        $path = '/uploads/' . sfConfig::get('app_album_images') . $photo['file_path'];
                                        ?>
                                        <li><img
                                                src="<?php echo VtHelper::getThumbUrl($path, 900, 570, 'default') ?>"
                                                alt="<?php echo $photo['name'] ?>"
                                                title="<?php echo $photo['name'] ?>" width="100%"/></li>
                                    <?php } ?>

                                </ul>
                            </div>
                            <div id="carousel" class="flexslider">
                                <ul class="slides thumb-photo">
                                    <!--                                    <li>-->
                                    <!--                                        <div style="margin:0px 5px 0px 0px"></div>-->
                                    <!--                                    </li>-->

                                    <?php
                                    foreach ($listPhoto as $photo) {
                                        $path = '/uploads/' . sfConfig::get('app_album_images') . $photo['file_path'];
                                        ?>
                                        <li><img
                                                src="<?php echo VtHelper::getThumbUrl($path, 240, 156, 'default') ?>"
                                                alt="<?php echo $photo['name'] ?>"
                                                title="<?php echo $photo['name'] ?>" width="100%"/></li>
                                    <?php } ?>

                                </ul>
                            </div>
                        </section>
                        <link rel="stylesheet" href="/css/flexslider.css" type="text/css" media="screen"/>
                        <script src="/js/modernizr.js"></script>
                        <script defer src="/js/jquery.flexslider.js"></script>
                        <script type="text/javascript">

                            $(window).load(function () {
                                $('#carousel').flexslider({
                                    animation: "slide",
                                    controlNav: false,
                                    animationLoop: false,
                                    slideshow: false,
                                    itemWidth: 270,
                                    itemMargin: 10,
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
                        <script src="/js/jquery.easing.js"></script>
                        <script src="/js/jquery.mousewheel.js"></script>
                    </div>
                    <?php
                }
                ?>

                <div class="c10"></div>
                <div style="border-bottom:solid 1px #EEE"></div>
                <div class="c5"></div>
                <div class="paging"></div>
            </div>
        </div>

    </div>