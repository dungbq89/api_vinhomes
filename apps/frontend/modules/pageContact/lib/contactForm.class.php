<?php
/**
 * Created by PhpStorm.
 * User: Ta Van Ngoc
 * Date: 6/13/15
 * Time: 11:18 PM
 */
class contactForm extends BaseAdFeedBackForm
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
        ));

        $this->setValidators(array(
            'title'        => new sfValidatorString(array('max_length' => 255)),
            'name'    => new sfValidatorString(array('max_length' => 255)),
            'phone' => new sfValidatorString(array('max_length' => 25, 'required' => false)),
            'email'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'message'  => new sfValidatorString(array('max_length' => 2000, 'required' => true)),
        ));
        $this->widgetSchema['captcha'] = new sfFrontWidgetCaptchaGD(array(), array());
        $this->validatorSchema['captcha'] = new sfCaptchaGDValidator(array('required' => true), array(
            'invalid' => $i18n->__('Mã bảo mật không chính xác.'),
            'required' => $i18n->__('Yêu cầu mã bảo mật.'),
        ));
        $this->widgetSchema->setNameFormat('ad_comment[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    }

    private function doBindType(&$values)
    {
        $values['lang'] = sfContext::getInstance()->getUser()->getCulture();
    }

    protected function doBind(array $values)
    {
        $this->doBindType($values);
        parent::doBind($values);
    }
}
