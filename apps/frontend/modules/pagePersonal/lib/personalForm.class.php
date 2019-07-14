<?php
/**
 * Created by PhpStorm.
 * User: Ta Van Ngoc
 * Date: 6/11/15
 * Time: 11:29 PM
 */
class personalForm extends BaseForm
{
    public function configure()
    {

        $this->setWidgets(array(
            'full_name'    => new sfWidgetFormInputText(),
            'phone_number' => new sfWidgetFormInputText(),
            'email'        => new sfWidgetFormInputText(),
        ));

        $this->setValidators(array(
            'full_name'    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'phone_number' => new sfValidatorString(array('max_length' => 25, 'required' => false)),
            'email'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
        ));

        $this->widgetSchema->setNameFormat('ad_personal[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    }
}
