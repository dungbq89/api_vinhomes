<?php

/**
 * PHP Captcha Form Validator
 *
 * @package    sfPHPCaptchaPlugin
 * @subpackage form
 * @author     Sven Wappler <info@wapplersystems.de>
 */
class sfCaptchaGDValidator extends sfValidatorBase {


  protected function configure($options = array(), $messages = array()) {
    parent::configure($options, $messages);
  }

    public function execute (&$value, &$error)
    {
        $captcha = $value;

        $session_captcha = $this->getParameter('captcha_ref');

        if($captcha != $session_captcha)
        {
            sfContext::getInstance()->getUser()->setAttribute('captcha', NULL);
            $error = $this->getParameter('captcha_error');
            return false;
        }
        return true;
    }

    public function initialize ($context, $parameters = null)
    {
        // Initialize parent
        parent::initialize($context);

        // Set default parameters value
        $this->setParameter('captcha_ref', $context->getUser()->getAttribute('captcha'));

        // Set parameters
        $this->getParameterHolder()->add($parameters);


        return true;
    }

  protected function doClean($value) {

    $value = (string) $value;

    $img = new Securimage();

    $valid = $img->check($value);

    if($valid == false){
      throw new sfValidatorError($this, 'invalid', array('value' => $value));
    }else{
      return true;
    }

  }


}

