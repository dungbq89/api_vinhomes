<?php

/**
 * VinProductImage form.
 *
 * @package    symfony
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class VinProductImageFormAdmin extends BaseVinProductImageForm
{
    public function configure()
    {
        parent::setup();
        $i18n = sfContext::getInstance()->getI18N();
        $apartmentType = VinHelper::getParentAparmentType();
        $apartmentType[0] = $i18n->__('Chọn loại phòng');
        $groups = VinHelper::getImageGroup();

        $this->setWidgets(array(
            'file_path' => new sfWidgetFormInputFileEditable(array(
                'label' => ' ',
                'file_src' => $this->getObject()->getFilePath(),
                'is_image' => true,
                'edit_mode' => !$this->isNew(),
                'template' => '<div>%file%<br/>%input%</div>',
            ), array('width' => 300, 'height'=>300)),
            'product_id' => new sfWidgetFormChoice(array(
                'choices' => $apartmentType,
                'multiple' => false,
                'expanded' => false)),
            'priority' => new sfWidgetFormInputText(),
            'extension' => new sfWidgetFormInputText(),
            'groups' => new sfWidgetFormChoice(array(
                'choices' => $groups,
                'multiple' => false,
                'expanded' => false)),
        ));

        $this->setValidators(array(
            'file_path' => new sfValidatorFile(
                array(
                    'validated_file_class' => 'sfResizeMediumThumbnailImage',
                    'max_size' => sfConfig::get('app_image_maxsize', 999999),
                    'mime_types' => array('image/jpeg', 'image/jpg', 'image/png', 'image/gif'),
                    'path' => sfConfig::get("sf_upload_dir") . '/building_image',
                    'required' => false
                )),
            'product_id' => new sfValidatorChoice(
                array('choices' => array_keys($apartmentType), 'required' => false),
                array('invalid' => $i18n->__('Category required.'))),
            'priority' => new sfValidatorInteger(array('required' => false)),
            'extension' => new sfValidatorString(array('max_length' => 200, 'required' => false)),
            'groups' => new sfValidatorChoice(
                array('choices' => array_keys($groups), 'required' => false),
                array('invalid' => $i18n->__('Category required.'))),
        ));

        $this->widgetSchema->setNameFormat('vin_product_image[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);


    }
}
