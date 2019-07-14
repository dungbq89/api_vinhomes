<?php

/**
 * vtpCategory form.
 *
 * @package    vtp
 * @subpackage form
 * @author     LamNQ
 * @version    2
 */
class ContractAdminForm extends BaseAdFeedBackForm
{
    public function configure()
    {
        $i18n = sfContext::getInstance()->getI18N();
        unset($this['created_at'], $this['updated_at']);
        $this->setWidgets(array(
            'name'        => new sfWidgetFormInputText(),
            'title'    => new sfWidgetFormInputText(),
            'phone' => new sfWidgetFormInputText(),
            'email'        => new sfWidgetFormInputText(),
            'message'  => new sfWidgetFormTextarea(),
            'is_active'     => new sfWidgetFormInputCheckbox(),
        ));

        $this->setValidators(array(
            'title'        => new sfValidatorString(array('max_length' => 255)),
            'name'    => new sfValidatorString(array('max_length' => 255)),
            'phone' => new sfValidatorString(array('max_length' => 25, 'required' => false)),
            'email'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'message'  => new sfValidatorString(array('max_length' => 2000, 'required' => true)),
            'is_active'     => new sfValidatorBoolean(array('required' => false)),
        ));

        $this->widgetSchema->setNameFormat('ad_feedback[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    }
}
