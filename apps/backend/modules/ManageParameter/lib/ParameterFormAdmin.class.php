<?php

/**
 * Parameter form.
 *
 * @package    Web_Portals
 * @subpackage form
 * @author     ngoctv1
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ParameterFormAdmin extends BaseParameterForm
{
    public function configure()
    {
        unset( $this['created_at'],$this['updated_at']);
        $cat = ParameterCategoryTable::getInstance()->getListParamCat();
        $this->setWidgets(array(
            'name' => new sfWidgetFormInputText(),
            'priority' => new sfWidgetFormInputText(),
            'cat_id' => new sfWidgetFormChoice(array(
                'choices' => $cat,
                'multiple' => false,
                'expanded' => false,
            ), array()),
            'is_active' => new sfWidgetFormInputCheckbox(),
        ));

        $this->setValidators(array(
            'name' => new sfValidatorString(array('max_length' => 255)),
            'priority' => new sfValidatorInteger(array('required' => false)),
            'cat_id' => new sfValidatorChoice(array(
                'choices' => array_keys($cat),
                'required' => false,
            ), array()),
            'is_active' => new sfValidatorBoolean(array('required' => false)),
            'lang' => new sfValidatorPass(),
        ));

        $this->widgetSchema->setNameFormat('ParameterFormAdmin[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
    }
}
