<?php

/**
 * AdPhoto form.
 *
 * @package    Vt_Portals
 * @subpackage form
 * @author     ngoctv1
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class AdDocumentCategoryAdminForm extends BaseAdDocumentCategoryForm
{
    public function configure()
    {
        $i18n = sfContext::getInstance()->getI18N();
        unset($this['created_at'], $this['created_by'], $this['updated_at'], $this['updated_by']);
        $request = sfContext::getInstance()->getRequest();
        $albumId = $request->getParameter('default_album_id');
        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'name' => new sfWidgetFormInputText(),
            'description' => new sfWidgetFormTextarea(),
            'keywords' => new sfWidgetFormTextarea(),
            'image_path' => new sfWidgetFormInputFileEditable(array(
                'label' => ' ',
                'file_src' => VtHelper::getUrlImagePathThumb(sfConfig::get('app_album_images'), $this->getObject()->getImagePath()),
                'is_image' => true,
                'edit_mode' => !$this->isNew(),
                'template' => '<div>%file%<br />%input%</div>',
            )),
            'priority' => new sfWidgetFormInputText(),
            'is_active'  => new sfWidgetFormInputCheckbox(),
            'is_home'  => new sfWidgetFormInputCheckbox(),
        ));
        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'name' => new sfValidatorString(array('max_length' => 255, 'required' => true, 'trim' => true)),
            'description' => new sfValidatorString(array('max_length' => 500, 'required' => false, 'trim' => true)),
            'keywords' => new sfValidatorString(array('max_length' => 500, 'required' => false, 'trim' => true)),

            'image_path' => new sfValidatorFileViettel(
                array(
                    'validated_file_class' => 'sfResizeMediumThumbnailImage',
                    'max_size' => sfConfig::get('app_image_maxsize', 999999),
                    'mime_types' => array('image/jpeg', 'image/jpg', 'image/png', 'image/gif'),
                    'path' => sfConfig::get("sf_upload_dir") . '/' . sfConfig::get('app_album_images'),
                    'required' => false,
                ),
                array(
                    'mime_types' => $i18n->__('Dữ liệu không hợp lệ hoặc định dạng không đúng.'),
                    'max_size' => $i18n->__('Tập tin tải lên là quá lớn')
                )
            ),
            'priority' => new sfValidatorInteger(array('required' => false, "min" => 0), array('min' => $i18n->__('Giá trị không phải là số âm'), 'invalid' => $i18n->__('Giá trị phải là kiểu số nguyên dương'))),
            'is_active'  => new sfValidatorBoolean(array('required' => false)),
            'is_home'  => new sfValidatorBoolean(array('required' => false)),
        ));
        $this->widgetSchema->setNameFormat('ad_document_category[%s]');
    }
}
