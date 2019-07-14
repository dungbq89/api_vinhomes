<?php use_helper('I18N', 'Date') ?>
<?php include_partial('adPhoto/assets') ?>
<?php include_partial('adPhoto/header') ?>

<div class="container-fluid">
    <div class="row-fluid">
        <?php if ($sidebar_status): ?>
            <?php include_partial('adPhoto/edit_sidebar', array('configuration' => $configuration, 'ad_photo' => $ad_photo)) ?>
        <?php endif; ?>

        <div class="span<?php echo $sidebar_status ? '10' : '12'; ?>">
            <h1><?php echo __('Sửa thông tin ảnh', array(), 'messages') ?></h1>

            <?php include_partial('adPhoto/flashes') ?>

            <div id="sf_admin_header">
                <?php include_partial('adPhoto/form_header', array('ad_photo' => $ad_photo, 'form' => $form, 'configuration' => $configuration)) ?>
            </div>

            <div id="sf_admin_content">
                <?php include_partial('adPhoto/form', array('ad_photo' => $ad_photo, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>

                <?php if (in_array('version', $fields->getRawValue())): ?>
                    <?php include_partial('versions', array('ad_photo' => $ad_photo->getRawValue(), 'fields' => $fields)); ?>
                <?php endif; ?>
            </div>

            <div id="sf_admin_footer">
                <?php include_partial('adPhoto/form_footer', array('ad_photo' => $ad_photo, 'form' => $form, 'configuration' => $configuration)) ?>
            </div>
        </div>
    </div>
</div>

<?php include_partial('adPhoto/footer') ?>