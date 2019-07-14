<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div class="sf_admin_form">
    <?php echo form_tag_for($form, '@ad_advertise_image', array('class' => 'form-horizontal form-inline')) ?>
        <?php echo $form->renderHiddenFields(false) ?>

        <?php if ($form->hasGlobalErrors()): ?>
            <?php echo $form->renderGlobalErrors() ?>
        <?php endif; ?>

        <?php foreach ($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit') as $fieldset => $fields): ?>
            <div class="control-group">
                <?php include_partial('adManageAdvertiseImage/form_fieldset', array('ad_advertise_image' => $ad_advertise_image, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldset,'advertise' =>$advertise)) ?>
            </div>
        <?php endforeach; ?>

        <div class="actions">
            <?php include_partial('adManageAdvertiseImage/form_actions', array('ad_advertise_image' => $ad_advertise_image, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper,'advertise' =>$advertise)) ?>
        </div>
    </form>
</div>