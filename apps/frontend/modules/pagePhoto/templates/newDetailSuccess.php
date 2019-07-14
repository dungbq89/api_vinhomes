<div class="grid grid-pad" style="background:#FFF">
    <div class="c20"></div>
    <div class="crumb hide-on-mobile">
        <a href="/"> <?php echo __('Trang chủ') ?> </a> / <a
            href="<?php echo url_for1('news') ?>"><?php echo __('Tin tức') ?></a> / <a
            href="javascript:void(0)"><?php echo $article['title'] ?></a>
    </div>

    <div class="c20"></div>

    <div class="col-1-1">

        <h2 class="title-first-home">
            <span><?php echo $article['title'] ?></span>
        </h2>

        <div class="c10"></div>
        <div>
            <div style="padding-bottom:20px">
                <?php echo $article['body'] ?>
            </div>
        </div>
    </div>
    <div class="c20"></div>
    <div class="c10"></div>
    <div class="paging"></div>
    <div class="c10"></div>

</div>