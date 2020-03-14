<?php

/**
 * VinProductImage filter form.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class VinProductImageFormFilterAdmin extends BaseVinProductImageFormFilter
{
    public function configure()
    {
        parent::setup();
        $i18n = sfContext::getInstance()->getI18N();
        $apartmentType = VinHelper::getParentAparmentType();
        $apartmentType[0] = $i18n->__('Chọn loại phòng');

        $this->setWidgets(array(
            'product_id' => new sfWidgetFormChoice(array(
                'choices' => $apartmentType,
                'multiple' => false,
                'expanded' => false)),
        ));

        $this->setValidators(array(
            'product_id' => new sfValidatorChoice(
                array('choices' => array_keys($apartmentType), 'required' => false),
                array('invalid' => $i18n->__('Category required.'))),
        ));

        $this->widgetSchema->setNameFormat('vin_product_image_filters[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    }

    public function addProductIdColumnQuery($query, $field, $values)
    {
        if ($values != '0')
            return $query->where("product_id = ?", $values);
    }
}
