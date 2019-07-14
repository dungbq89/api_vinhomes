<?php
/**
 * Created by PhpStorm.
 * User: Ta Van Ngoc
 * Date: 5/30/15
 * Time: 11:28 PM
 */
class adManagePersonalFilter extends BaseAdPersonalFormFilter
{
    public function configure()
    {
        $this->setWidgets(array(
            'full_name'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
            'phone_number' => new sfWidgetFormFilterInput(array('with_empty' => false)),
            'email'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
        ));

        $this->setValidators(array(
            'full_name'    => new sfValidatorPass(array('required' => false)),
            'phone_number' => new sfValidatorPass(array('required' => false)),
            'email'        => new sfValidatorPass(array('required' => false)),
        ));

        $this->widgetSchema->setNameFormat('ad_personal_filters[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
    }
}