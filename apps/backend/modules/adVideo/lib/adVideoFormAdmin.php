<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ngoctv1
 * Date: 4/30/14
 * Time: 1:47 PM
 * To change this template use File | Settings | File Templates.
 */
class adVideoFormAdmin extends BaseAdVideoForm
{
    public function configure()
    {
        $showFile = "";
        $filePath=$this->getObject()->getFilePath();
        if ($filePath == "" || is_null($filePath)) {
            $showFile = "style='display:none'";
        }
        $i18n = sfContext::getInstance()->getI18N();
        unset($this['created_by'],$this['updated_by'], $this['created_at'], $this['updated_at'],
        $this['lang'],$this['extension'],$this['slug']);
        $this->setWidgets(array(
            'name'        => new sfWidgetFormInputText(),
            'description' => new sfWidgetFormTextarea(),
            'priority'    => new sfWidgetFormInputText(),
            'is_active'   => new sfWidgetFormInputCheckbox(),
            'is_default'  => new sfWidgetFormInputCheckbox(),
        ));

        $this->setValidators(array(
            'name'        => new sfValidatorString(array('max_length' => 255, 'required' => true, 'trim'=>true)),
            'description' => new sfValidatorString(array('max_length' => 1000,'required' => true, 'trim'=>true)),
            'priority'    => new sfValidatorInteger(),
            'is_active'   => new sfValidatorBoolean(array('required' => false)),
            'is_default'  => new sfValidatorBoolean(array('required' => false)),
        ));
        $this->setWidget('file_path', new sfWidgetFormInputFileEditable(
            array('edit_mode' => !$this->isNew(),
                'with_delete' => true,
                'file_src' =>sfConfig::get('app_upload_media_file') . '/video' . $this->getObject()->getFilePath(),
                'template' => '<div class="player"><br />%input% <br /><span ' . $showFile . ">" . $this->getObject()->getFilePath() ." </span></div>"
            )
        ));
        $this->validatorSchema['file_path'] = new sfValidatorFileViettel(
            array('required' => $this->isNew(),
                'max_size' => sfConfig::get('app_upload_video_max_size',99999999),
                'upload_path'=>sfConfig::get('app_upload_media_file') . '/video',
                'path' => sfConfig::get('app_upload_media_file') .  '/video',
                'mime_types' => array( 'flv' => 'video/x-flv','mp4' =>'video/mp4')),
            array('max_size' => $i18n->__('File upload dung lượng không quá 50MB.'),
                'mime_types' => $i18n->__('File video phải là MP4.'),
                'required' => $i18n->__('Phải chọn file video để tải lên'))
        );

        if (!$this->isNew()) {
            $url_file =  sfConfig::get('app_url_media_file') . '/video/';
            $imageUrl = '/uploads/' . sfConfig::get('app_advertise_images')  . $this->getObject()->getImagePath();
            $this->widgetSchema['jwplayer']= new sfWidgetFormPlainText(
                array("value_data" => VtHelper::generateEmbedJwplayer($url_file . $this->getObject()->getFilePath(), 400, 300,$imageUrl),
                    'label'=>$i18n->__('Xem thử'),
                    "encode" => false
                ),array('required' => false));
            $this->validatorSchema['jwplayer'] = new sfValidatorPass();
        }

        $this->widgetSchema['image_path'] = new sfWidgetFormInputFileEditable(array(
            'label' => ' ',
            'file_src' => VtHelper::getUrlImagePathThumb(sfConfig::get('app_advertise_images'), $this->getObject()->getImagePath()),
            'is_image' => true,
            'edit_mode' => !$this->isNew(),
            'template' => '<div>%file%<br />%input%</div>',
        ));

        $this->validatorSchema['image_path'] = new sfValidatorFileViettel(
            array(
                'max_size' => sfConfig::get('app_image_maxsize', 999999),
                'mime_types' => array('image/jpeg','image/jpg', 'image/png', 'image/gif'),
                'path' => sfConfig::get("sf_upload_dir") . '/' . sfConfig::get('app_advertise_images'),
                'required' => false
            ),
            array(
                'mime_types' => $i18n->__('Bạn phải tải lên file hình ảnh.'),
                'max_size' => $i18n->__('Tối đa 5MB')
            ));



        $this->widgetSchema['event_date'] = new sfWidgetFormVnDatePicker(array(),array('readonly'=>true));
        $this->validatorSchema['event_date'] = new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d H:i:s'));
        $this->widgetSchema->setNameFormat('vtp_video[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
    }

}
