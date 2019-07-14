<?php use_helper('I18N', 'Date') ?>
<?php include_partial('adManageAdvertiseImage/assets') ?>
<?php include_partial('adManageAdvertiseImage/header') ?>

<div class="container-fluid">
    <div class="row-fluid">
        <?php if ($sidebar_status): ?>
            <?php include_partial('adManageAdvertiseImage/edit_sidebar', array('configuration' => $configuration, 'ad_advertise_image' => $ad_advertise_image)) ?>
        <?php endif; ?>

        <div class="span<?php echo $sidebar_status ? '10' : '12'; ?>">
            <h1><?php echo __('Chỉnh sửa hình ảnh', array(), 'messages') ?></h1>

            <?php include_partial('adManageAdvertiseImage/flashes') ?>

            <div id="sf_admin_header">
                <?php include_partial('adManageAdvertiseImage/form_header', array('ad_advertise_image' => $ad_advertise_image, 'form' => $form, 'configuration' => $configuration)) ?>
            </div>

            <div id="sf_admin_content">
                <?php include_partial('adManageAdvertiseImage/form', array('ad_advertise_image' => $ad_advertise_image, 'advertise'=>$advertise, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>

                <?php if (in_array('version', $fields->getRawValue())): ?>
                    <?php include_partial('versions', array('ad_advertise_image' => $ad_advertise_image->getRawValue(), 'fields' => $fields)); ?>
                <?php endif; ?>
            </div>

            <div id="sf_admin_footer">
                <?php include_partial('adManageAdvertiseImage/form_footer', array('ad_advertise_image' => $ad_advertise_image, 'form' => $form, 'configuration' => $configuration)) ?>
            </div>
        </div>
    </div>
</div>

<?php include_partial('adManageAdvertiseImage/footer') ?>