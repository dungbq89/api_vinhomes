<div class="grid grid-pad">
    <div class="c20"></div>

    <div class="crumb hide-on-mobile">
        <a href="/"> <?php echo __('Trang chủ') ?> </a> / <a href='/chain/'> <?php echo __('Căn hộ') ?></a>
    </div>

    <!--    <script type="text/javascript" src="highslide/highslide-with-gallery.js"></script>-->
    <!--    <link rel="stylesheet" type="text/css" href="highslide/highslide.css"/>-->

    <!--    <link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen"/>-->

    <script type="text/javascript">
        hs.graphicsDir = '/highslide/graphics/';
        hs.align = 'center';
        hs.transitions = ['expand', 'crossfade'];
        hs.wrapperClassName = 'dark borderless floating-caption';
        hs.fadeInOut = true;
        hs.dimmingOpacity = .75;
        if (hs.addSlideshow) hs.addSlideshow({
            interval: 5000,
            repeat: false,
            useControls: true,
            fixedControls: 'fit',
            overlayOptions: {
                opacity: .6,
                position: 'bottom center',
                hideOnMouseOut: true
            }
        });
    </script>


    <div class="c20"></div>
    <script src="js/modernizr.js"></script>
    <div class="col-1-1">
        <h1 class="news-name-detail"><?php echo $chain['name'] ?></h1>

    </div>
    <div class="c10"></div>
    <div></div>
    <?php include_partial('pageChain/chain', array('chain' => $chain, 'images' => $images)) ?>

    <div class="c10"></div>

    <?php include_partial('pageChain/mapChain', array('chain' => $chain, 'listParam' => $listParam)) ?>

    <div class="c20"></div>

    <?php include_partial('pageChain/roomList', array('chain' => $chain, 'listRoom' => $listRoom)) ?>

    <div class="c20 mobile-break"></div>
    <div class="c20 pad-break"></div>
    <div class="c20"></div>

</div>