<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of vtpManagePortalContactFormAdmin
 *
 * @author dungbv7
 */
class adManageContactFormAdmin extends AdContactForm {

    public function configure() {
        $i18n = sfContext::getInstance()->getI18N();
        unset($this['created_at'], $this['created_by'], $this['updated_at'], $this['updated_by']);

        $this->widgetSchema['content'] = new sfWidgetFormTextarea();
        $this->validatorSchema['content'] = new sfValidatorString(array(
            'required' => true,
            'max_length' => 2000,
            'trim' => true,
            
        ));

        $this->widgetSchema['maptypeid'] = new sfWidgetFormInputHidden();
        $this->validatorSchema['maptypeid'] = new sfValidatorChoice(array(
            "choices" => array("google.maps.MapTypeId.ROADMAP"),
            "empty_value" => "google.maps.MapTypeId.ROADMAP",
            "required" => FALSE,
        ));
        $this->widgetSchema['portal_id'] = new sfWidgetFormInputHidden();
        $this->validatorSchema['portal_id'] = new sfValidatorChoice(array(
            "choices" => array(sfContext::getInstance()->getUser()->getAttribute("portal")),
            "empty_value" => sfContext::getInstance()->getUser()->getAttribute("portal"),
            "required" => FALSE,
        ));
        $this->widgetSchema['zoom'] = new sfWidgetFormInputText(array(
            'default' => 6,
        ));

        $this->validatorSchema['zoom'] = new sfValidatorInteger(array(
            'required' => true,
            'min' => 0,
            'max' => 20,
                ), array(
            'min' => $i18n->__('Giá trị nhỏ nhất là 0'),
            'max' => $i18n->__('Giá trị lớn nhất là 20'),
        ));
        parent::configure();
    }

    //put your code here
}

?>
