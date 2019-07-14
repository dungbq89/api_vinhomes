<?php


class adSignInChangePasswordForm extends BasesfGuardFormSignin {

    public function configure() {
        $i18n = sfContext::getInstance()->getI18N();

        parent::configure();
        unset($this['remember']);

        $this->widgetSchema['new_password'] = new sfWidgetFormInputPassword(array('type' => 'password'));

        $this->validatorSchema['new_password'] = new sfValidatorRegex(
                array('pattern' => '/^.*(?=.{8,28})(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[a-zA-Z]).*$/',
            'required' => 'true'), array('required' => $i18n->__('Không được để trống!'),
            'invalid' => $i18n->__('Mật khẩu tối thiểu 8 ký tự, bao gồm: chữ, số và ký tự đặc biệt.')));


        $this->widgetSchema['confirm_pass'] = new sfWidgetFormInputPassword();
        $this->validatorSchema['confirm_pass'] = clone $this->validatorSchema['new_password'];

        $this->widgetSchema->moveField('confirm_pass', 'after', 'new_password');
        $this->mergePostValidator(new sfValidatorSchemaCompare('new_password', sfValidatorSchemaCompare::EQUAL, 'confirm_pass', array(), array('invalid' =>  $i18n->__('Mật khẩu không khớp.'))));

        $this->mergePostValidator(new sfValidatorSchemaCompare('new_password', sfValidatorSchemaCompare::NOT_EQUAL, 'password', array(), array('invalid' => $i18n->__('Mật khẩu mới không được trùng mật khẩu cũ!'))));

//    $this->mergePostValidator(new sfValidatorSchemaCompare('repeat_password',
//      sfValidatorSchemaCompare::EQUAL, 'new_password', array(), array('invalid' => $i18n->__('Please enter the same password as above.'))));

        $this->widgetSchema['username']->setAttribute('readonly', true);
//    $this->widgetSchema['username'] = new sfWidgetFormPlainText(array("value_data" => $this->getObject()->getUsername()));
//    $this->validatorSchema['username'] = new sfValidatorPass();

        $this->widgetSchema['captcha'] = new sfWidgetCaptchaGD();
        $this->validatorSchema['captcha'] = new sfValidatorCaptchaGD(
                array(
            'required' => $i18n->__('Mã xác nhận không được để trống.')));
        $this->widgetSchema['password']->setLabel($i18n->__("Mật khẩu cũ"));
        $this->widgetSchema['username']->setLabel($i18n->__("Tên đăng nhập"));
        $this->widgetSchema['captcha']->setLabel($i18n->__("Mã xác nhận"));
        $this->useFields(array('username', 'password', 'new_password', 'confirm_pass', 'captcha'));
    }

    public function setUserName($username) {
        $this->setDefault('username', $username);
    }

}