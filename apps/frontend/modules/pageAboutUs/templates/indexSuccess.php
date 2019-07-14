<div class="grid grid-pad" style="background:#FFF">
    <div class="c20"></div>

    <div class="crumb hide-on-mobile">
        <a href="/"> <?php echo __('Trang chủ') ?> </a> / <a
            href="<?php echo url_for1('about_us') ?>"><?php echo __('Về chúng tôi') ?></a>
    </div>

    <div class="c20"></div>

    <div class="col-1-1">

        <h2 class="title-first-home">
            <span><?php echo $html->name ?></span>
        </h2>

        <div class="c10"></div>
        <div>
            <div style="padding-bottom:20px">
                <?php echo $html->content ?>
            </div>
        </div>
    </div>
    <div class="c20"></div>
    <div class="c10"></div>
    <div class="paging"></div>
    <div class="c10"></div>

</div>