<?php

/**
 * VinBuildingType filter form.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class VinBuildingTypeFormFilterAdmin extends BaseVinBuildingTypeFormFilter
{
    public function configure()
    {
        parent::setup();
        $i18n = sfContext::getInstance()->getI18N();
        $apartmentType = VinHelper::getParentAparmentType();
        $apartmentCat = VinHelper::getParentAparmentCat(false, 'floorsCategory');
        $apartmentCat[0] = $i18n->__('Chọn tòa nhà');
        $apartmentType[0] = $i18n->__('Chọn loại phòng');
        $isHot = [
            '-1' => 'Trạng thái',
            '0' => 'Bình thường',
            '1' => 'Hot',
        ];

        $this->setWidgets(array(
            'name' => new sfWidgetFormFilterInput(),
            'apartment_type_id' => new sfWidgetFormChoice(array(
                'choices' => $apartmentType,
                'multiple' => false,
                'expanded' => false)),
            'apartment_cat' => new sfWidgetFormChoice(array(
                'choices' => $apartmentCat,
                'multiple' => false,
                'expanded' => false)),
            'is_hot' => new sfWidgetFormChoice(array(
                'choices' => $isHot,
                'multiple' => false,
                'expanded' => false)),
        ));

        $this->setValidators(array(
            'name' => new sfValidatorPass(array('required' => false)),
            'apartment_type_id' => new sfValidatorChoice(
                array('choices' => array_keys($apartmentType), 'required' => false),
                array('invalid' => $i18n->__('Category required.'))),
            'apartment_cat' => new sfValidatorChoice(
                array('choices' => array_keys($apartmentCat), 'required' => false),
                array('invalid' => $i18n->__('Category required.'))),
            'is_hot' => new sfValidatorChoice(
                array('choices' => array_keys($isHot), 'required' => false),
                array('invalid' => $i18n->__('Category required.'))),
        ));

        $this->widgetSchema->setNameFormat('vin_building_type_filters[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
    }

    public function addApartmentTypeIdColumnQuery($query, $field, $values)
    {
        if ($values != '0')
            return $query->where("apartment_type_id = ?", $values);
    }
    public function addApartmentCatColumnQuery($query, $field, $values)
    {
        if ($values != '0')
            return $query->where("apartment_cat = ?", $values);
    }
    public function addIsHotColumnQuery($query, $field, $values)
    {
        if ($values != '-1')
            return $query->where("is_hot = ?", $values);
    }
}
