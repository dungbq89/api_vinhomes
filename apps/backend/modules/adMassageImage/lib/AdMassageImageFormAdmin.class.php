<?php

/**
 * VtpPhoto form.
 *
 * @package    Vt_Portals
 * @subpackage form
 * @author     ngoctv1
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class AdMassageImageFormAdmin extends BaseadMassageImageForm
{
    public function configure()
    {
        parent::configure();
        $i18n = sfContext::getInstance()->getI18N();
        unset($this['created_at'], $this['created_by'], $this['updated_at'], $this['updated_by']);
        $request = sfContext::getInstance()->getRequest();
        $massageId = sfContext::getInstance()->getUser()->getAttribute('default_massage_id',null);

        $this->widgetSchema['file_path'] = new sfWidgetFormInputFileEditable(array(
            'label' => ' ',
            'file_src' => VtHelper::getUrlImagePathThumb(sfConfig::get('app_article_images'), $this->getObject()->getFilePath()),
            'is_image' => true,
            'edit_mode' => !$this->isNew(),
            'template' => '<div>%file%<br />%input%</div>',
        ));
        $this->validatorSchema['file_path'] = new sfValidatorFileViettel(
            array(
                'max_size' => sfConfig::get('app_image_maxsize', 999999),
                'mime_types' => array('image/jpeg', 'image/jpg', 'image/png', 'image/gif'),
                'path' => sfConfig::get("sf_upload_dir") . '/' . sfConfig::get('app_article_images'),
                'required' => false
            ),
            array(
                'mime_types' => $i18n->__('Bạn phải tải lên file hình ảnh.'),
                'max_size' => $i18n->__('Tối đa 5MB')
            ));

        $this->widgetSchema['massage_id'] = new sfWidgetFormChoice(array(
            'choices' => $this->getAllMassage(),
            'multiple' => false,
            'expanded' => false));
        $this->validatorSchema['massage_id'] = new sfValidatorChoice(array(
            'required' => false,
            'choices' => array_keys($this->getAllMassage()),));

        if ($massageId != null) {
            $this->widgetSchema['massage_id']->setDefault($massageId);
        }
        $this->widgetSchema->setNameFormat('ad_massage_image[%s]');
        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
    }

    public function getAllMassage()
    {
        $arrMass = adMassageTable::getAllMassage();
        $arrProduct = array();
        if ($arrMass) {
            foreach ($arrMass as $value) {
                $arrProduct[$value['id']] = $value['name'];
            }
        }
        return $arrProduct;
    }
}
