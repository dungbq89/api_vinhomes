<?php

/**
 * Created by JetBrains PhpStorm.
 * User: ngoctv1
 * Date: 4/24/14
 * Time: 12:02 PM
 * To change this template use File | Settings | File Templates.
 */
class adDocumentAdminForm extends BaseAdDocumentForm {

    public function configure() {
        $i18n = sfContext::getInstance()->getI18N();
        unset($this['created_at'], $this['updated_at']);
        $this->widgetSchema['name'] = new sfWidgetFormInputText(array());
        $this->validatorSchema['name'] = new sfValidatorString(array('required' => true, 'trim' => true, 'max_length' => 255));

        $this->widgetSchema['priority'] = new sfWidgetFormInputText(array());
        $this->validatorSchema['priority'] = new sfValidatorInteger(
                array('required' => false, "min" => 0, 'max' => 99999, 'trim' => true), array('min' => $i18n->__('Thứ tự phải là số nguyên dương'), 'max' => $i18n->__('Tối đa 5 ký tự'), 'invalid' => $i18n->__('Thứ tự phải là số nguyên dương'))
        );

        //ngoctv sua image_path
        $this->widgetSchema['file_path'] = new sfWidgetFormInputFileEditable(array(
            'label' => ' ',
            'file_src' => VtHelper::getUrlImagePathThumb(sfConfig::get('app_document'), $this->getObject()->getFilePath()),
//            'file_src' =>sfConfig::get("app_url_media_file") . '/' . sfConfig::get('app_document').'/'. $this->getObject()->getFilePath(),
            'is_image' => false,
            'edit_mode' => !$this->isNew(),
            'template' => '<div><br />%input%</div>',
        ));
        $this->validatorSchema['file_path'] = new sfValidatorFileViettel(
                array('required' => false,
            'max_size' => sfConfig::get('app_image_maxsize', 999999),
//            'upload_path' => sfConfig::get('app_document'),
            'path' => sfConfig::get("sf_upload_dir") . '/' . sfConfig::get('app_document'),
            'mime_types' => array(
                'application/pdf',
                'application/octet-stream',
                'application/msword',
                'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                'application/vnd.ms-word',
                'application/vnd.ms-excel',
                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'application/vnd.ms-powerpoint',
                'application/vnd.openxmlformats-officedocument.presentationml.presentation',
                'application/x-rar',
                'application/zip',
                'application/x-msword',
                'application/msword'))
        );

        $this->widgetSchema['document_date'] = new sfWidgetFormVnDatePicker(array(),array('readonly'=>true));
        $this->validatorSchema['document_date'] = new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d H:i:s'));

        $this->widgetSchema['category_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AdDocCategory')));
        $this->validatorSchema['category_id'] = new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('AdDocCategory'), 'required' => false));

        $this->widgetSchema->setNameFormat('vt_document[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
    }

}
