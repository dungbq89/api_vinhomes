<?php


?>
<?php use_helper('I18N', 'Date') ?>
<?php include_partial('adManagePersonal/assets') ?>
<?php include_partial('adManagePersonal/header') ?>
<?php include_partial('adManagePersonal/flashes') ?>

<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <h1><?php echo __("Import Danh sách Hội viên")?></h1>
            <div id="sf_admin_header"></div>
            <div id="sf_admin_content">
                <div class="sf_admin_form">
                    <form class="form-horizontal form-inline" method="post" action="<?php echo url_for('ad_personal_import') ?>" enctype="multipart/form-data">
                        <?php echo $form->renderHiddenFields(); ?>
                        <div class="control-group">
                            <fieldset id="sf_fieldset_none">
                                <div class="control-group sf_admin_form_row sf_admin_text sf_admin_form_field_file_excel">
                                    <?php echo $form['file_excel']->renderLabel(__('File Excel *'), array('class' => 'control-label')) ?>
                                    <div class="controls">
                                        <div class="field-content">
                                            <?php echo $form['file_excel']->render() ?>
                                        </div>
                                        <?php
                                        if ( $form['file_excel']->hasError())
                                        {
                                            echo '<span class="help-inline">'.$form['file_excel']->renderError().'</span>';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="actions">
                            <div class="btn-toolbar">
                                <div class="btn-group">
                                    <a class="btn" href="<?php echo url_for('@ad_personal') ?>"><i class="icon-arrow-left icon-black"></i>Quay lại danh sách</a>
                                </div>
                                <?php $form = new BaseForm(); if ($form->isCSRFProtected()): ?>
                                    <input type="hidden" name="<?php echo $form->getCSRFFieldName() ?>" value="<?php echo $form->getCSRFToken() ?>" />
                                <?php endif; ?>
                                <div class="btn-group">
                                    <input class="btn btn-primary" type="submit" name="_import" value="<?php echo __('Imports') ?>" />
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div id="sf_admin_footer"></div>
        </div>
    </div>
</div>