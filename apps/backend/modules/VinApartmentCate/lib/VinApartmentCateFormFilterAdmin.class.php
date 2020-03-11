<?php

/**
 * VinApartmentCate filter form.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class VinApartmentCateFormFilterAdmin extends BaseVinApartmentCateFormFilter
{
    public function configure()
    {
        parent::setup();
        $i18n = sfContext::getInstance()->getI18N();
        $arrVinModel = VinHelper::getVinModel();
        $arrParents = VinHelper::getParentAparmentCat();
        $arrVinModel = array_merge(['0' => 'Chọn danh mục'], $arrVinModel);

        $this->setWidgets(array(
//            'code' => new sfWidgetFormFilterInput(),
//            'name' => new sfWidgetFormFilterInput(),
            'vin_model' => new sfWidgetFormChoice(array(
                'choices' => $arrVinModel,
                'multiple' => false,
                'expanded' => false)),
//            'type' => new sfWidgetFormFilterInput(),
//            'priority' => new sfWidgetFormFilterInput(),
            'parent' => new sfWidgetFormChoice(array(
                'choices' => $arrParents,
                'multiple' => false,
                'expanded' => false)),
        ));

        $this->setValidators(array(
//            'code' => new sfValidatorPass(array('required' => false)),
//            'name' => new sfValidatorPass(array('required' => false)),
            'vin_model' => new sfValidatorPass(array('required' => false)),
//            'type' => new sfValidatorPass(array('required' => false)),
//            'priority' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
            'parent' => new sfValidatorPass(array('required' => false)),
        ));

        $this->widgetSchema->setNameFormat('vin_apartment_cate_filters[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
    }

    public function addVinModelColumnQuery($query, $field, $values)
    {
        if ($values != '')
            return $query->where("vin_model = ?", $values);
    }

    public function addParentColumnQuery($query, $field, $values)
    {
        if ($values != '0')
            return $query->where("parent = ?", $values);
    }
}
