<?php

/**
 * VtpPhoto form.
 *
 * @package    Vt_Portals
 * @subpackage form
 * @author     ngoctv1
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class VtpManageProductImageFormAdmin extends BaseVtpProductImageForm
{
    public function configure()
    {
        $i18n = sfContext::getInstance()->getI18N();
        unset($this['created_at'], $this['created_by'], $this['updated_at'], $this['updated_by']);
        $request = sfContext::getInstance()->getRequest();
        $productId = $request->getParameter('default_product_id');
        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'file_path' => new sfWidgetFormInputFileEditable(array(
                'label' => ' ',
                'file_src' => VtHelper::getUrlImagePathThumb(sfConfig::get('app_product_images'), $this->getObject()->getFilePath()),
                'is_image' => true,
                'edit_mode' => !$this->isNew(),
                'template' => '<div>%file%<br />%input%</div>',
            )),
            'product_id' => new sfWidgetFormDoctrineChoice(array(
                'model' => $this->getRelatedModelName('VtpProductImage'),
                'method' => 'getProductName',
                'add_empty' => false,
                'order_by' => array('priority', 'asc'))),
            'extension' => new sfWidgetFormInputText(),
            'priority' => new sfWidgetFormInputText(array('default' => 0), array('size' => 5, 'maxlength' => 5)),

        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'file_path' => new sfValidatorFileViettel(
                array(
                    'validated_file_class' => 'sfResizeMediumThumbnailImage',
                    'max_size' => sfConfig::get('app_image_maxsize', 999999),
                    'mime_types' => array('image/jpeg', 'image/jpg', 'image/png', 'image/gif'),
                    'path' => sfConfig::get("sf_upload_dir") . '/' . sfConfig::get('app_product_images'),
                    'required' => $this->isNew()
                ),
                array(
                    'mime_types' => $i18n->__('Dữ liệu không hợp lệ hoặc định dạng không đúng.'),
                    'max_size' => $i18n->__('Tối đa 5MB')
                )),
            'product_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('VtpProductImage'), 'required' => true)),
            'extension' => new sfValidatorString(array('max_length' => 200, 'required' => false)),
            'lang' => new sfValidatorPass(),
            'priority' => new sfValidatorInteger(array('required' => false,
                'min' => 0,
                'max' => 99999,
                'trim' => true),
                array(
                    'min' => $i18n->__('Không phải là số nguyên dương'),
                    'max' => $i18n->__('Không được nhập quá 5 ký tự')
                )),

        ));
        if ($productId != null) {
            $this->widgetSchema['product_id']->setDefault($productId);
        }
        $this->widgetSchema->setNameFormat('vtp_product_image[%s]');
    }

    public function listProduct()
    {
        $arrPro = VtpProductsTable::getAllProduct();
        $arrProduct = array();
        if ($arrPro) {
            foreach ($arrPro as $value) {
                $arrProduct[$value['id']] = $value['product_name'];
            }
        }
        return $arrProduct;
    }
}
