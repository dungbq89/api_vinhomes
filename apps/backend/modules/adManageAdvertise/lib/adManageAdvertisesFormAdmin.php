<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ngoctv1
 * Date: 12/11/13
 * Time: 12:40 AM
 * To change this template use File | Settings | File Templates.
 */
class adManageAdvertisesFormAdmin extends BaseAdAdvertiseForm
{
    public function configure()
    {
        unset($this['created_by'], $this['updated_by'], $this['created_at'], $this['updated_at'], $this['location']);
        $i18n = sfContext::getInstance()->getI18N();
        $this->setWidgets(array(
            'id'            => new sfWidgetFormInputHidden(),
            'name'          => new sfWidgetFormInputText(array(),array('maxlength' =>255)),
            'description'   => new sfWidgetFormTextarea(array(),array('maxlength' =>1000)),
            'view_type'     => new sfWidgetFormChoice(array(
                                'choices' => $this->getViewType(),
                                'multiple' => false,
                                'expanded' => false)),
            'amount'        => new sfWidgetFormInputText(array(), array('size' => 5, 'maxlength' => 5)),
            'width'         => new sfWidgetFormInputText(array(), array('size' => 5, 'maxlength' => 5)),
            'height'        => new sfWidgetFormInputText(array(), array('size' => 5, 'maxlength' => 5)),
            'is_active'     => new sfWidgetFormInputCheckbox(),
        ));
            $this->widgetSchema['view_type'] = new sfWidgetFormChoice(array(
                'choices' => $this->getViewType(),
                'multiple' => false,
                'expanded' => false));
        $this->setValidators(array(
            'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'name'          => new sfValidatorString(array('max_length' => 255, 'trim' => true),
                            array(
                                'max_length' => $i18n->__('Không được nhập quá 255 ký tự')
                            )),
            'description'   => new sfValidatorString(array(
                                'max_length' => 1000, 
                                'required' => false,'trim' => true),
                            array(
                                'max_length' => $i18n->__('Không được nhập quá 1000 ký tự')
                            )),
            'view_type'     => new sfValidatorChoice(array(
                                'required' => false,
                                'choices' => array_keys($this->getViewType()),)),
            'amount'        => new sfValidatorInteger(array('required' => false,
                                'min' => 0,
                                'max' => 99999,
                                'trim' => true), 
                                array(
                                'min' => $i18n->__('Phải là số nguyên dương'),
                                'max' => $i18n->__('Không được nhập quá 5 ký tự')
                                )),
            'width'         =>  new sfValidatorInteger(array('required' => false,
                                'min' => 0,
                                'max' => 99999,
                                'trim' => true), 
                                array(
                                'min' => $i18n->__('Chiều rộng phải là số nguyên dương'),
                                'max' => $i18n->__('Không được nhập quá 5 ký tự')
                                )),
            'height'        =>  new sfValidatorInteger(array('required' => false,
                                'min' => 0,
                                'max' => 99999,
                                'trim' => true), 
                                array(
                                'min' => $i18n->__('Chiều cao phải là số nguyên dương'),
                                'max' => $i18n->__('Không được nhập quá 5 ký tự')
                                )),
            'is_active'     => new sfValidatorBoolean(array('required' => false)),
        ));
        $adsQuery = AdAdvertiseLocationTable::getInstance()->getAllForSelectionBoxQuery(sfContext::getInstance()->getUser()->getAttribute('portal',0));
        $this->widgetSchema['location_list'] =new sfWidgetFormDoctrineChoice(array(
            'multiple' => true,
            'model' => 'AdAdvertiseLocation',
            'table_method'=>'getAllForSelectionBoxQuery',
            'choices' => $adsQuery,),
             array('style'=>'height: 150px;'));

        $this->widgetSchema['location_list']->setDefault($this->getAdvertiseLocationByID());


        $this->validatorSchema['location_list'] = new sfValidatorDoctrineChoice(array(
            'multiple' => true,
            'model' => 'AdAdvertiseLocation',
            'required' => false,
            'query' => $adsQuery));

        $this->setDefault('amount', 1);

        $this->validatorSchema->setPostValidator(new sfValidatorDoctrineUnique(array('model' => 'AdAdvertise', 'column' => array('name'))));
        $this->widgetSchema->setNameFormat('ad_advertise[%s]');
    }

    protected function getViewType()
    {
        $i18n = sfContext::getInstance()->getI18N();
        $view_type = $this->getObject()->view_type;
        $arrStatus=array();
        $arrStatus['0']=$i18n->__('Ảnh tĩnh');
        $arrStatus['1']=$i18n->__('Slide show');
        $arrStatus['2']=$i18n->__('Flash');
        if ($view_type === null)
            return $arrStatus;
        else
            return array($view_type => $arrStatus[$view_type]);
    }

    protected function  getLocationByPortal(){
//        $arrLocation=array();
        $arrLocation=AdAdvertiseLocationTable::getLocationByPortal();
        return $arrLocation;
    }

    protected function getAdvertiseLocationByID() 
    {
         $arrLocation=array();
         $list=AdAdvertiseLocationTable::getAdvertiseLocationByID($this->getObject()->id);
         for($i=0; $i<count($list); $i++){
             array_push($arrLocation, $list[$i]->id);
        }
        return $arrLocation;
    }

    private function doBindType(&$values) {
        $values['name']=trim($values['name']);
        $values['description']=trim($values['description']);
    }

    protected function doBind(array $values) {
        $this->doBindType($values);
        parent::doBind($values);
    }
}