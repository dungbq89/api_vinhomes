<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ngoctv1
 * Date: 4/30/14
 * Time: 1:47 PM
 * To change this template use File | Settings | File Templates.
 */
class adMassageFormAdmin extends BaseadMassageForm
{
    public function configure()
    {
        parent::configure();
        $i18n = sfContext::getInstance()->getI18N();
        unset($this['created_at'], $this['updated_at'],
        $this['lang'],$this['slug']);

        $this->widgetSchema['description'] =   new sfWidgetFormTextarea();
        $this->validatorSchema['description'] = new sfValidatorString(array('required' => true, 'trim'=>true, 'max_length' => 2000));

        $this->widgetSchema['keywords'] =   new sfWidgetFormTextarea();
        $this->validatorSchema['keywords'] = new sfValidatorString(array('required' => true, 'trim'=>true, 'max_length' => 255));

        $this->widgetSchema['content'] = new sfWidgetFormCKEditor(
            array(
                'jsoptions' => array('toolbar' => 'Full',
                    'width' => '700',
                    'height' => '200'),
            ));
        $this->validatorSchema['content'] = new sfValidatorString(
            array(
                'required' => false,
                'trim' => true,
            ));

        $this->widgetSchema['image'] = new sfWidgetFormInputFileEditable(array(
            'label' => ' ',
            'file_src' => VtHelper::getUrlImagePathThumb(sfConfig::get('app_article_images'), $this->getObject()->getImage()),
            'is_image' => true,
            'edit_mode' => !$this->isNew(),
            'template' => '<div>%file%<br />%input%</div>',
        ));
        $this->validatorSchema['image'] = new sfValidatorFileViettel(
            array(
                'max_size' => sfConfig::get('app_image_maxsize', 999999),
                'mime_types' => array('image/jpeg','image/jpg', 'image/png', 'image/gif'),
                'path' => sfConfig::get("sf_upload_dir") . '/' . sfConfig::get('app_article_images'),
                'required' => false
            ),
            array(
                'mime_types' => $i18n->__('Bạn phải tải lên file hình ảnh.'),
                'max_size' => $i18n->__('Tối đa 5MB')
            ));

        $this->widgetSchema['location_id'] = new sfWidgetFormChoice(array(
            'choices' => $this->getAllLocation(),
            'multiple' => false,
            'expanded' => false));
        $this->validatorSchema['location_id'] = new sfValidatorChoice(array(
            'required' => false,
            'choices' => array_keys($this->getAllLocation()),));

        $this->validatorSchema['lang'] = new sfValidatorPass();


        $this->widgetSchema->setNameFormat('adConfig[%s]');
        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
    }


    public function getAllLocation(){
        $listLocation = adLocationTable::getAllLocation();
        $arrLocation = array(''=>'-- Chọn quận huyện --');
        if($listLocation){
            foreach ($listLocation as $value){
                $arrLocation[$value['id']] = $value['name'];
            }

        }
        return $arrLocation;
    }
}
