<?php
/**
 * Created by PhpStorm.
 * User: Ta Van Ngoc
 * Date: 5/30/15
 * Time: 11:34 PM
 */
class AdManagePersonalForm extends BaseAdPersonalForm
{
    public function configure()
    {
        unset($this['created_by'],$this['updated_by'], $this['created_at'], $this['updated_at']);

        $this->widgetSchema['birthday'] = new sfWidgetFormVnDatePicker(array(),array('readonly'=>true));
        $this->validatorSchema['birthday'] = new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d H:i:s'));

        $arrSex=array("Nữ"=>"Nữ","Nam"=>"Nam");
        $this->widgetSchema['sex'] =new sfWidgetFormChoice(array(
            'choices' => $arrSex,
            'multiple' => false,
            'expanded' => false
        ));
        $this->validatorSchema['sex'] = new sfValidatorChoice(array(
            'required' => true,
            'choices' => array_keys($arrSex)));

        $this->widgetSchema->setNameFormat('ad_personal[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
    }

}