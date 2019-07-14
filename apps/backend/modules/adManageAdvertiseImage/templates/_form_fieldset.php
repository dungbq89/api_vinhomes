<?php if ('NONE' != $fieldset): ?>
    <h2><?php echo __($fieldset, array(), 'messages') ?></h2>
<?php endif; ?>
<fieldset id="sf_fieldset_<?php echo preg_replace('/[^a-z0-9_]/', '_', strtolower($fieldset)) ?>">
    <div class="control-group sf_admin_form_row sf_admin_foreignkey sf_admin_form_field_advertise_id">
        <label class="control-label" for="vtp_advertise_image_advertise_id">
            <?php echo __('Banner - Quảng cáo') ?>
        </label>
        <div class="controls">
            <div class="field-content">
                <label><?php echo $advertise != null ? $advertise->name : '' ?></label>
            </div>
        </div>
    </div>

    <?php foreach ($fields as $name => $field): ?>
        <?php if ((isset($form[$name]) && $form[$name]->isHidden()) || (!isset($form[$name]) && $field->isReal())) continue ?>
        <?php include_partial('adManageAdvertiseImage/form_field', array(
            'name'       => $name,
            'attributes' => $field->getConfig('attributes', array()),
            'label'      => $field->getConfig('label'),
            'help'       => $field->getConfig('help'),
            'form'       => $form,
            'field'      => $field,
            'class'      => 'sf_admin_form_row sf_admin_'.strtolower($field->getType()).' sf_admin_form_field_'.$name,
            'ad_advertise_image' => $ad_advertise_image        )) ?>
    <?php endforeach; ?>
</fieldset>