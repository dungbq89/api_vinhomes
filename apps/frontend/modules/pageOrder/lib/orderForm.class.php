<?php
/**
 * Created by PhpStorm.
 * User: Ta Van Ngoc
 * Date: 7/28/15
 * Time: 11:36 PM
 */

class orderForm extends BaseAdOrderForm
{
    public function configure()
    {
        $i18n = sfContext::getInstance()->getI18N();
        unset($this['created_at'], $this['updated_at'], $this['status']);

//        $this->widgetSchema['captcha'] = new sfFrontWidgetCaptchaGD(array(), array(
//        ));
//        $this->validatorSchema['captcha'] = new sfCaptchaGDValidator(array('required'=>true), array(
//            'invalid' => $i18n->__('Mã bảo mật không chính xác.'),
//            'required' => $i18n->__( 'Yêu cầu mã bảo mật.'),
//        ));

        $this->widgetSchema->setNameFormat('order[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
    }


}
