<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ngoctv1
 * Date: 12/12/13
 * Time: 11:13 AM
 * To change this template use File | Settings | File Templates.
 */
class adManageAdvertiseImageFormAdmin extends BaseAdAdvertiseImageForm
{
    public function configure()
    {
        unset($this['created_by'], $this['updated_by'], $this['created_at'], $this['updated_at']);
        $adId= sfContext::getInstance()->getUser()->getAttribute('adManageAdvertiseImage.adid', -1, 'admin_module');
        $advertise=AdAdvertiseTable::getAdvertiseById($adId);
        $i18n = sfContext::getInstance()->getI18N();
        $this->widgetSchema['priority'] = new sfWidgetFormInputText(array('default' => 0));

        $this->widgetSchema['file_path'] = new sfWidgetFormInputFileEditable(array(
            'label' => ' ',
            'file_src' => VtHelper::getUrlImagePathThumb(sfConfig::get('app_advertise_images'), $this->getObject()->getFilePath()),
            'is_image' => true,
            'edit_mode' => !$this->isNew(),
            'template' => '<div>%file%<br />%input%</div>',
        ));
        if($advertise->view_type=='2'){//Nếu banner hiển thị kiểu flash thì chỉ validate file swf
            $this->validatorSchema['file_path'] = new sfValidatorFileViettel(
                array(
                    'max_size' => sfConfig::get('app_image_upload_max_size', 999999),
                    'mime_types' => array('application/x-shockwave-flash'),
                    'path' => sfConfig::get("sf_upload_dir") . '/' . sfConfig::get('app_advertise_images'),
                    'required' => $this->isNew()
                ),
                array(
                    'mime_types' =>$i18n->__('Bạn phải tải lên file flash.'),
                    'max_size' =>$i18n->__( 'Tối đa 5MB')
                ));
        }else{//nếu banner hiển thị ảnh tĩnh hoặc slide thì validate file ảnh
            $this->validatorSchema['file_path'] = new sfValidatorFileViettel(
                array(
                    'max_size' => sfConfig::get('app_image_maxsize', 999999),
                    'mime_types' => array('image/jpeg','image/jpg', 'image/png', 'image/gif'),
                    'path' => sfConfig::get("sf_upload_dir") . '/' . sfConfig::get('app_advertise_images'),
                    'required' => $this->isNew()
                ),
                array(
                    'mime_types' => $i18n->__('Bạn phải tải lên file hình ảnh.'),
                    'max_size' => $i18n->__('Tối đa 5MB')
                ));
        }

        $this->widgetSchema['is_active'] =new sfWidgetFormInputCheckbox();
        $this->validatorSchema['is_active'] =new sfValidatorBoolean(array('required' => false));
        $this->validatorSchema['priority'] =new sfValidatorInteger(
                array(
                    'min' => 0,
                    'max' => 99999,
                    'required' => false
                    ),
                array(
                    'min' => $i18n->__('Phải là số nguyên dương'),
                    'max' => $i18n->__('Không được nhập quá 5 ký tự')
                ));
        $this->validatorSchema['link'] = new sfValidatorString(array('trim' => true,'max_length' => 255, 'required' => false));
        $this->widgetSchema->setNameFormat('ad_advertise_image[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
    }
}
