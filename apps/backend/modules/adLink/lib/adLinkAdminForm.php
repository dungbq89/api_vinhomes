<?php

/**
 * Created by JetBrains PhpStorm.
 * User: ngoctv1
 * Date: 4/24/14
 * Time: 12:02 PM
 * To change this template use File | Settings | File Templates.
 */
class adLinkAdminForm extends BaseAdLinkForm {

    public function configure() {
        $i18n = sfContext::getInstance()->getI18N();
        unset($this['created_at'], $this['updated_at'], $this['created_at'], $this['updated_at']);
        $this->widgetSchema['name'] = new sfWidgetFormInputText(array());
        $this->validatorSchema['name'] = new sfValidatorString(array('required' => true, 'trim' => true, 'max_length' => 255));

        $this->widgetSchema['link'] = new sfWidgetFormInputText(array());
        $this->validatorSchema['link'] = new sfValidatorString(array('required' => true, 'trim' => true, 'max_length' => 255));

//        $this->widgetSchema['type'] = new  sfWidgetFormChoice(array(
//            'choices' => $this->getLinkType(),
//            'multiple' => false,
//            'expanded' => false
//        ));
//        $this->validatorSchema['type'] = new sfValidatorChoice(array(
//            'required' => true,
//            'choices' => array_keys($this->getLinkType()),
//        ));

        $this->widgetSchema['priority'] = new sfWidgetFormInputText(array('default' => 0), array('size' => 5, 'maxlength' => 5));
        $this->validatorSchema['priority'] = new sfValidatorInteger(array('required' => false, "min"=>0, 'max'=>99999, 'trim' => true),array('min'=>$i18n->__('Thứ tự phải là số nguyên dương'),'max'=>$i18n->__('Tối đa 5 ký tự'),'invalid'=> $i18n->__('Thứ tự phải là số nguyên dương')));

        $this->widgetSchema->setNameFormat('ad_link[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
    }

    protected function getLinkType(){
        return array(
            "1" => "Liên kết chân trang"
        );
    }

}
