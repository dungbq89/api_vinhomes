<?php

/**
 * VinApartmentType form.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class VinApartmentTypeFormAdmin extends BaseVinApartmentTypeForm
{
    public function configure()
    {
        parent::setup();
        $i18n = sfContext::getInstance()->getI18N();
        $arrCat = VinHelper::getParentAparmentCat(false, 'ApartmentCategory');
        $this->setWidgets(array(
            'vin_key' => new sfWidgetFormInputText(),
            'name_type' => new sfWidgetFormInputText(),
            'featured_image' => new sfWidgetFormInputFileEditable(array(
                'label' => ' ',
                'file_src' => $this->getObject()->getFeaturedImage(),
                'is_image' => true,
                'edit_mode' => !$this->isNew(),
                'template' => '<div>%file%<br/>%input%</div>',
            ), array('width' => 100, 'height' => 100)),
            'standard_transfer_file' => new sfWidgetFormInputFileEditable(array(
                'label' => ' ',
                'file_src' => $this->getObject()->getStandardTransferFile(),
                'is_image' => false,
                'edit_mode' => !$this->isNew(),
                'template' => '<div>%file%<br/>%input%</div>',
            )),
//            'ground_apartment_file' => new sfWidgetFormInputText(),
            'bad_room' => new sfWidgetFormInputText(),
            'bath_room' => new sfWidgetFormInputText(),
            'kitchen_room' => new sfWidgetFormInputText(),
            'balcony' => new sfWidgetFormInputText(),
            'description' => new sfWidgetFormInputText(),
            'heart_wall' => new sfWidgetFormInputText(),
            'clear_span' => new sfWidgetFormInputText(),
            'vin_model' => new sfWidgetFormInputHidden(array(), array('value' => 'ApartmentType')),
//            'parent_type' => new sfWidgetFormInputText(),
            'apartment_cat' => new sfWidgetFormChoice(array(
                'choices' => $arrCat,
                'multiple' => false,
                'expanded' => false)),
            'priority' => new sfWidgetFormInputText(),
        ));

        $this->setValidators(array(
            'vin_key' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'name_type' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'featured_image' => new sfValidatorFile(
                array(
                    'validated_file_class' => 'sfResizeMediumThumbnailImage',
                    'max_size' => sfConfig::get('app_image_maxsize', 999999),
                    'mime_types' => array('image/jpeg', 'image/jpg', 'image/png', 'image/gif'),
                    'path' => sfConfig::get("sf_upload_dir") . '/building_image',
                    'required' => false
                )),
            'standard_transfer_file' => new sfValidatorFile(
                array(
//                    'validated_file_class' => 'sfResizeMediumThumbnailImage',
                    'max_size' => sfConfig::get('app_image_maxsize', 999999),
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
                        'application/msword'),
                    'path' => sfConfig::get("sf_upload_dir") . '/building_file',
                    'required' => false
                )),
//            'ground_apartment_file' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'bad_room' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'bath_room' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'kitchen_room' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'balcony' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'description' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'heart_wall' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'clear_span' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'vin_model' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
//            'parent_type' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'apartment_cat' => new sfValidatorChoice(
                array('choices' => array_keys($arrCat), 'required' => false),
                array('invalid' => $i18n->__('Category required.'))),
            'priority' => new sfValidatorInteger(array('required' => false)),
        ));

        $this->widgetSchema->setNameFormat('vin_apartment_type[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);


    }
}
