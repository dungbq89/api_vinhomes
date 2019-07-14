<div class="grid grid-pad">
    <div class="c20"></div>
    <div class="crumb hide-on-mobile">
        <a href="/"> <?php echo __('Trang chủ') ?> </a> / <a href="javascript:void(0)"> <?php echo __('Tất cả phòng') ?></a>
    </div>
    <div class="c20"></div>
    <h1 class="title-first-home">
        <span><?php echo __('Tất cả phòng') ?></span>
    </h1>

    <div class="c20"></div>

    <div class="c"></div>
    <div class="col-1-1">
        <div class="paging">
            <div class="pages fl">
                <?php
                if ($pager->haveToPaginate()) {
                    include_component("common", "pagging", array('redirectUrl' => $url_paging, 'pager' => $pager, 'vtParams' => array('slug' => sfContext::getInstance()->getRequest()->getParameter('slug'))));
                }
                ?>
            </div>
        </div>
        <div class="c20"></div>
    </div>
</div>