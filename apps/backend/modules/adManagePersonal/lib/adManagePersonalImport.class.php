<?php
/**
 * Created by JetBrains PhpStorm.
 * User: diepth2
 * Date: 5/19/14
 * Time: 1:50 PM
 * To change this template use File | Settings | File Templates.
 */
class adManagePersonalImport extends BaseForm{
    //put your code here

    public function configure()
    {
        $i18n = sfContext::getInstance()->getI18N();
        unset($this['created_by'],$this['updated_by'],$this['created_at'], $this['updated_at']);
        $this->widgetSchema['file_excel'] = new sfWidgetFormInputFile(array(), array(
            'label' => 'File excel *',
            'readonly' => true
        ));
//        $this->widgetSchema['name'] = new sfWidgetFormInputText();
//        $this->validatorSchema['name'] =  new sfValidatorString(array('required'=>false));
        $this->validatorSchema['file_excel'] = new sfValidatorFileViettel(
            array(
                'required' => true,
                'max_size' => sfConfig::get('app_import_max_size', 1 * 1024 * 1024),
                'path' => sfConfig::get("sf_upload_dir") . '/' . sfConfig::get('app_article_images'),
                'mime_types' => array(
                    'application/vnd.ms-excel',
                    'application/msexcel',
                    'application/x-msexcel',
                    'application/x-ms-excel',
                    'application/x-excel',
                    'application/x-dos_ms_excel',
                    'application/xls',
                    'application/x-xls',
                    'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                    'application/octetstream'
                ),), array(
            'mime_types' => $i18n->__('Định dạng file không hợp lệ'),
            'max_size' => $i18n->__('Tập tin tải lên không được vượt quá 2MB')
        ));
        $this->widgetSchema->setNameFormat('ad_personal_import[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
    }
}