<?php use_helper('I18N', 'Date') ?>
<?php include_partial('adManageAdvertiseImage/assets') ?>
<?php include_partial('adManageAdvertiseImage/header') ?>

<div class="container-fluid">
    <div class="row-fluid">
        <?php if ($sidebar_status): ?>
            <?php include_partial('adManageAdvertiseImage/new_sidebar', array('configuration' => $configuration)) ?>
        <?php endif; ?>

        <div class="span<?php echo $sidebar_status ? '10' : '12'; ?>">
            <h1><?php echo __('Thêm mới hình ảnh', array(), 'messages') ?></h1>

            <?php include_partial('adManageAdvertiseImage/flashes') ?>

            <div id="sf_admin_header">
                <?php include_partial('adManageAdvertiseImage/form_header', array('ad_advertise_image' => $ad_advertise_image, 'form' => $form, 'configuration' => $configuration)) ?>
            </div>

            <div id="sf_admin_content">
                <?php include_partial('adManageAdvertiseImage/form', array('ad_advertise_image' => $ad_advertise_image, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper,'advertise' =>$advertise)) ?>
            </div>

            <div id="sf_admin_footer">
                <?php include_partial('adManageAdvertiseImage/form_footer', array('ad_advertise_image' => $ad_advertise_image, 'form' => $form, 'configuration' => $configuration)) ?>
            </div>
        </div>
    </div>
</div>

<?php include_partial('adManageAdvertiseImage/footer') ?>