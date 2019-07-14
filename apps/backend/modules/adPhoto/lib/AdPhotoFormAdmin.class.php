<?php

/**
 * AdPhoto form.
 *
 * @package    Vt_Portals
 * @subpackage form
 * @author     ngoctv1
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class AdPhotoFormAdmin extends BaseAdPhotoForm
{
  public function configure()
  {
      $i18n = sfContext::getInstance()->getI18N();
      unset($this['created_at'], $this['created_by'], $this['updated_at'], $this['updated_by']);
      $request = sfContext::getInstance()->getRequest();
      $albumId = $request->getParameter('default_album_id');
      $this->setWidgets(array(
        'id'         => new sfWidgetFormInputHidden(),
        'name'       => new sfWidgetFormInputText(),
        'file_path'   => new sfWidgetFormInputFileEditable(array(
                                'label' => ' ',
                                'file_src' => VtHelper::getUrlImagePathThumb(sfConfig::get('app_album_images'), $this->getObject()->getFilePath()),
                                'is_image' => true,
                                'edit_mode' => !$this->isNew(),
                                'template' => '<div>%file%<br />%input%</div>',
                            )),
        'album_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AdAlbumPhoto'))),
        'extension'  => new sfWidgetFormInputText(),
        'priority'   => new sfWidgetFormInputText(),
        'is_active'  => new sfWidgetFormInputCheckbox(),
        'created_by' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreatedBy'), 'add_empty' => true)),
        'updated_by' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UpdatedBy'), 'add_empty' => true)),
        'created_at' => new sfWidgetFormDateTime(),
        'updated_at' => new sfWidgetFormDateTime(),
      ));
      if ($albumId!=null){
        $this->widgetSchema['album_id']->setDefault($albumId);
      }
      $this->setValidators(array(
        'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
        'name'       => new sfValidatorString(array('max_length' => 255, 'required' => true)),
        'file_path'   => new sfValidatorFileViettel(
                                array(
                                    'validated_file_class' => 'sfResizeMediumThumbnailImage',
                                    'max_size' => sfConfig::get('app_image_maxsize', 99999999),
                                    'mime_types' => array('image/jpeg','image/jpg', 'image/png', 'image/gif'),
                                    'path' => sfConfig::get("sf_upload_dir") . '/' . sfConfig::get('app_album_images'),
                                    'required' => false,
                                ),
                                array(
                                    'mime_types' =>$i18n->__('Dữ liệu không hợp lệ hoặc định dạng không đúng.'),
                                    'max_size' =>$i18n->__('Tập tin tải lên là quá lớn')
                                )
                            ),
        'album_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('AdAlbumPhoto'), 'required' => false)),
        'extension'  => new sfValidatorString(array('max_length' => 200, 'required' => false)),
        'priority'        => new sfValidatorInteger(array('required' => false, "min"=>0),array('min'=>$i18n->__('Giá trị không phải là số âm'),'invalid'=> $i18n->__('Giá trị phải là kiểu số nguyên dương'))),
        'is_active'  => new sfValidatorBoolean(array('required' => false)),
      ));
      $this->setDefault('is_active', 1);
      $this->widgetSchema->setNameFormat('Ad_photo[%s]');
  }
}
