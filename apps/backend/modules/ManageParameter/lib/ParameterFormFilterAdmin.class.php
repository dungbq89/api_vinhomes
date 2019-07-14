<?php

/**
 * Parameter filter form.
 *
 * @package    Web_Portals
 * @subpackage filter
 * @author     ngoctv1
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ParameterFormFilterAdmin extends BaseParameterFormFilter
{
    public function configure()
    {
        $cat = ParameterCategoryTable::getInstance()->getListParamCat();
        $this->setWidgets(array(
            'name' => new sfWidgetFormFilterInput(array('with_empty' => false)),
            'cat_id' => new sfWidgetFormChoice(array(
                'choices' => $cat,
                'multiple' => false,
                'expanded' => false,
            ), array()),
            'is_active' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
        ));

        $this->setValidators(array(
            'name' => new sfValidatorPass(array('required' => false)),
            'priority' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
            'cat_id' => new sfValidatorChoice(array(
                'choices' => array_keys($cat),
                'required' => false,
            ), array()),
            'is_active' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
        ));
        $this->widgetSchema->setNameFormat('ParameterFormFilterAdmin[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    }
}
