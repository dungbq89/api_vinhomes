<?php
/**
 * Created by PhpStorm.
 * User: Ta Van Ngoc
 * Date: 5/30/15
 * Time: 11:57 PM
 */
class adManageLocationForm extends BaseAdAdvertiseLocationForm{

    public function configure()
    {
        $i18n = sfContext::getInstance()->getI18N();
        $this->setWidgets(array(
            'id'                      => new sfWidgetFormInputHidden(),
            'name'                    => new sfWidgetFormInputText(array(),array('maxlength' =>200)),
            'page'                    => new sfWidgetFormChoice(array(
                    'choices' => $this->getPage(),
                    'multiple' => false,
                    'expanded' => false
                )),
            'template'                => new sfWidgetFormChoice(array(
                    'choices' => $this->getTemplate(),
                    'multiple' => false,
                    'expanded' => false
                )),
            'priority'                => new sfWidgetFormInputText(array('default' => 0), array('size' => 5, 'maxlength' => 5)),
            'advertise_id' => new sfWidgetFormChoice(array(
                    'choices' => $this->getBanner(),
                    'multiple' => false,
                    'expanded' => false)),
        ));

        $this->setValidators(array(
            'id'                      => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'name'                    => new sfValidatorString(array(
                    'max_length' => 200,
                    'required' => true,
                    'trim' => true)),
            'page'                    =>  new sfValidatorChoice(array(
                    'required' => true,
                    'choices' => array_keys($this->getPage()),)),
            'template'                =>  new sfValidatorChoice(array(
                    'required' => true,
                    'choices' => array_keys($this->getTemplate()),)),
            'priority'                => new sfValidatorInteger(array(
                        'required' => false,
                        'trim' => true,
                        'min' => 0,
                        'max' => 99999),
                    array(
                        'min' => $i18n->__('Phải là số nguyên dương'),
                        'max' => $i18n->__('Không được nhập quá 5 ký tự')
                    )),
            'advertise_id' => new sfValidatorChoice(array(
                    'required' => false,
                    'choices' => array_keys($this->getBanner()),)),
        ));

        $this->validatorSchema->setPostValidator(new sfValidatorDoctrineUnique(array('model' => 'AdAdvertiseLocation', 'column' => array('name'))));
        $this->widgetSchema->setNameFormat('ad_advertise_location[%s]');
    }

    public function getPage() {
        $pageAttr = Attributes::getAttributesList('view_page');

        return $pageAttr;
    }

    public function getTemplate() {
        $templateAttr = Attributes::getAttributesList('advertise_template');

        return $templateAttr;
    }

    public function getBanner(){
        $i18n = sfContext::getInstance()->getI18N();
        $arrAdvertise= array();
        $arrAdvertise[-1]=$i18n->__('-- Chọn banner --');
        $list=AdAdvertiseTable::getListAdvertist();
        foreach ($list as $item){
            $arrAdvertise[$item->id]=$item->name;
        }
        return $arrAdvertise;
    }

    protected function doBind(array $values) {
        parent::doBind($values);
    }
}