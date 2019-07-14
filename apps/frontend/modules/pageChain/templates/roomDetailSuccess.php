<div class="grid grid-pad">
    <div class="c20"></div>
    <div class="crumb hide-on-mobile">
        <a href="/"> <?php echo __('Trang chủ') ?> </a> / <a href="javascript:void(0)"> <?php echo __('Phòng') ?></a>
    </div>
    <div class="c20"></div>

    <?php include_partial('pageChain/roomDetail', array('listImage' => $listImage, 'chain' => $chain, 'room' => $room)) ?>
    <?php include_partial('pageChain/otherRoom', array('listOtherRoom' => $listOtherRoom, 'chain' => $chain)) ?>

</div>