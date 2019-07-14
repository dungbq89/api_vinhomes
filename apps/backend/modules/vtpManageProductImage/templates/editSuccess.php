<?php use_helper('I18N', 'Date') ?>
<?php include_partial('vtpManageProductImage/assets') ?>
<?php include_partial('vtpManageProductImage/header') ?>

<div class="container-fluid">
    <div class="row-fluid">
        <?php if ($sidebar_status): ?>
            <?php include_partial('vtpManageProductImage/edit_sidebar', array('configuration' => $configuration, 'vtp_product_image' => $vtp_product_image)) ?>
        <?php endif; ?>

        <div class="span<?php echo $sidebar_status ? '10' : '12'; ?>">
            <h1><?php echo __('Chỉnh sửa ảnh sản phẩm', array(), 'messages') ?></h1>

            <?php include_partial('vtpManageProductImage/flashes') ?>

            <div id="sf_admin_header">
                <?php include_partial('vtpManageProductImage/form_header', array('vtp_product_image' => $vtp_product_image, 'form' => $form, 'configuration' => $configuration)) ?>
            </div>

            <div id="sf_admin_content">
                <?php include_partial('vtpManageProductImage/form', array('vtp_product_image' => $vtp_product_image, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>

                <?php if (in_array('version', $fields->getRawValue())): ?>
                    <?php include_partial('versions', array('vtp_product_image' => $vtp_product_image->getRawValue(), 'fields' => $fields)); ?>
                <?php endif; ?>
            </div>

            <div id="sf_admin_footer">
                <?php include_partial('vtpManageProductImage/form_footer', array('vtp_product_image' => $vtp_product_image, 'form' => $form, 'configuration' => $configuration)) ?>
            </div>
        </div>
    </div>
</div>

<?php include_partial('vtpManageProductImage/footer') ?>