<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ngoctv1
 * Date: 4/30/14
 * Time: 1:47 PM
 * To change this template use File | Settings | File Templates.
 */
class adOrderFormAdmin extends BaseAdOrderForm
{
    public function configure()
    {
        parent::configure();
        $i18n = sfContext::getInstance()->getI18N();
        unset($this['created_at'], $this['updated_at']);

        $this->widgetSchema['body'] =   new sfWidgetFormTextarea();
        $this->validatorSchema['body'] = new sfValidatorString(array('required' => true, 'trim'=>true, 'max_length' => 2000));

        $this->widgetSchema['status'] = new sfWidgetFormChoice(array(
            'choices' => $this->getAllStatus(),
            'multiple' => false,
            'expanded' => false));
        $this->validatorSchema['status'] = new sfValidatorChoice(array(
            'required' => false,
            'choices' => array_keys($this->getAllStatus()),));

        $this->validatorSchema['lang'] = new sfValidatorPass();


        $this->widgetSchema->setNameFormat('adConfig[%s]');
        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
    }


    public function getAllStatus(){
        return array(
            '0' => 'Chưa xử lý',
            '1' => 'Đang xử lý',
            '2' => 'Đã xử lý',
        );
    }
}
