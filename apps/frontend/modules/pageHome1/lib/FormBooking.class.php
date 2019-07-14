<?php
/**
 * Created by PhpStorm.
 * User: Ta Van Ngoc
 * Date: 6/13/15
 * Time: 11:18 PM
 */
class FormBooking extends BaseBookingForm
{
    public function configure()
    {
        unset($this['created_at'], $this['created_by'], $this['updated_at'], $this['updated_by']);
        $years = range(date('Y'), date('Y') - 75);
        $this->widgetSchema['full_name'] = new sfWidgetFormInputText(array());
        $this->validatorSchema['full_name'] = new sfValidatorString(array('required' => true, 'trim' => true, 'max_length' => 255));

        $this->widgetSchema['phone'] = new sfWidgetFormInputText(array());
        $this->validatorSchema['phone'] = new sfValidatorString(array('required' => true, 'trim' => true, 'max_length' => 25));

        $this->widgetSchema['email'] = new sfWidgetFormInputText(array());
        $this->validatorSchema['email'] = new sfValidatorString(array('required' => false, 'trim' => true, 'max_length' => 50));

        $this->widgetSchema['category_id'] = new sfWidgetFormChoice(array(
            'choices' => $this->getCategoryId(),
            'multiple' => false,
            'expanded' => false));
        $this->validatorSchema['category_id'] = new sfValidatorChoice(array(
            'required' => false,
            'choices' => array_keys($this->getCategoryId()),));

        $this->widgetSchema['product_id'] = new sfWidgetFormChoice(array(
            'choices' => $this->getProductByCatId(),
            'multiple' => false,
            'expanded' => false));
        $this->validatorSchema['product_id'] = new sfValidatorChoice(array(
            'required' => false,
            'choices' => array_keys($this->getProductByCatId()),));

        $this->widgetSchema['from_time'] = new sfWidgetFormVnDatePicker(array(), array('readonly' => false,'placeholder'=> __('Từ ngày')));
        $this->validatorSchema['from_time'] =  new sfValidatorDateTime(array('required' => true));

        $this->widgetSchema['to_time'] = new sfWidgetFormVnDatePicker(array(), array('readonly' => false,'placeholder'=> __('Từ ngày')));
        $this->validatorSchema['to_time'] =  new sfValidatorDateTime(array('required' => true));

        $this->widgetSchema['number_person'] = new sfWidgetFormChoice(array(
            'choices' => $this->getNumberPerson(),
            'multiple' => false,
            'expanded' => false));
        $this->validatorSchema['number_person'] = new sfValidatorChoice(array(
            'required' => false,
            'choices' => array_keys($this->getNumberPerson()),));

        $this->widgetSchema['number_room'] = new sfWidgetFormChoice(array(
            'choices' => $this->getNumberPerson(),
            'multiple' => false,
            'expanded' => false));
        $this->validatorSchema['number_room'] = new sfValidatorChoice(array(
            'required' => false,
            'choices' => array_keys($this->getNumberPerson()),));

        $this->widgetSchema->setNameFormat('booking[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    }

    public function getCategoryId(){
        $listCat = VtpProductsCategoryTable::getListCategoryHome();
        $arr = array(''=>__('Chọn tòa nhà'));
        if($listCat && count($listCat)){
            foreach ($listCat as $cat){
                $arr[$cat['id']] = $cat['name'];
            }
        }
        return $arr;
    }

    public function getProductByCatId(){
        $arr = array(''=>__('Chọn loại phòng'));
        return $arr;
    }

    public function getNumberPerson(){
        $arr = array();
        for($i = 1; $i<=20; $i++){
            $arr[$i] = $i;
        }
        return $arr;
    }
}
