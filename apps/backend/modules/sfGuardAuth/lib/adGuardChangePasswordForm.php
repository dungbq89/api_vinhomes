<?php

class adGuardChangePasswordForm extends BaseForm
{

  public function setup()
  {
    $i18n = sfContext::getInstance()->getI18N();

    $this->setWidgets(array(
      'username' => new sfWidgetFormInputText(array(), array('style' => 'width: 200px')),
      'password' => new sfWidgetFormInputPassword(array('type' => 'password'),array('max_length' => 250)),
    ));

    $this->setValidators(array(
      'username' => new sfValidatorString(),
      'password' => new sfValidatorString(array('trim' => true, 'required' => true),array()),
    ));
    $this->setDefault('username', sfContext::getInstance()->getUser()->getGuardUser()->getUsername());
    $this->widgetSchema['username']->setAttribute('readonly', true);

    $this->widgetSchema['new_password'] = new sfWidgetFormInputPassword(array('type' => 'password'),array('max_length' => 250));

    $this->validatorSchema['new_password'] = new sfValidatorRegex(
                array('pattern' => '/^.*(?=.{8,28})(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[a-zA-Z]).*$/',
            'required' => 'true'), array('required' => $i18n->__('Không được để trống!'),
            'invalid' => $i18n->__('Mật khẩu tối thiểu 8 ký tự, bao gồm: chữ, số và ký tự đặc biệt.')));

    $this->widgetSchema['repeat_password'] = clone $this->widgetSchema['new_password'];

    $this->validatorSchema['repeat_password'] = clone $this->validatorSchema['new_password'];

    $this->widgetSchema->moveField('repeat_password', 'after', 'new_password');

    $this->widgetSchema->setLabels(array(
      'password' => $i18n->__('Mật khẩu cũ '),
      'new_password' => $i18n->__('Mật khẩu mới '),
      'repeat_password' => $i18n->__('Nhắc lại mật khẩu '),
    ));

    $this->validatorSchema->setPostValidator(new validatorChangePassUser());
          $this->mergePostValidator(new sfValidatorSchemaCompare('new_password', sfValidatorSchemaCompare::EQUAL, 'repeat_password', array(), array('invalid' => 'Mật khẩu không khớp.')));

        $this->mergePostValidator(new sfValidatorSchemaCompare('new_password', sfValidatorSchemaCompare::NOT_EQUAL, 'password', array(), array('invalid' => $i18n->__('Mật khẩu mới không được trùng mật khẩu cũ!'))));

    $this->widgetSchema->setNameFormat('password[%s]');
  }
}
