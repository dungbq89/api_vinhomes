<?php

/**
 * vtpCategory form.
 *
 * @package    vtp
 * @subpackage form
 * @author     LamNQ
 * @version    2
 */
class BookingAdminForm extends BaseBookingForm
{
    public function configure()
    {
        $i18n = sfContext::getInstance()->getI18N();
        unset($this['created_at'], $this['updated_at']);
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

        $this->widgetSchema['from_time'] = new sfWidgetFormVnDatePicker(array(), array('readonly' => false, 'placeholder' => $i18n->__('Từ ngày')));
        $this->validatorSchema['from_time'] = new sfValidatorDateTime(array('required' => true, 'datetime_output' => 'Y-m-d H:i:s'));

        $this->widgetSchema['to_time'] = new sfWidgetFormVnDatePicker(array(), array('readonly' => false, 'placeholder' => $i18n->__('Từ ngày')));
        $this->validatorSchema['to_time'] = new sfValidatorDateTime(array('required' => true, 'datetime_output' => 'Y-m-d H:i:s'));

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

        $this->widgetSchema['is_check'] = new sfWidgetFormChoice(array(
            'choices' => $this->getChoice(),
            'multiple' => false,
            'expanded' => false));
        $this->validatorSchema['is_check'] = new sfValidatorChoice(array(
            'required' => false,
            'choices' => array_keys($this->getChoice()),));

        $this->widgetSchema->setNameFormat('booking[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    }

    public function getCategoryId()
    {
        $i18n = sfContext::getInstance()->getI18N();
        $listCat = VtpProductsCategoryTable::getListCategoryHome();
        $arr = array();
        if ($listCat && count($listCat)) {
            foreach ($listCat as $cat) {
                $arr[$cat['id']] = $cat['name'];
            }
        }
        return $arr;
    }

    public function getProductByCatId()
    {
        $i18n = sfContext::getInstance()->getI18N();
        $listCat = VtpProductsTable::getAllProduct();
        $arr = array();
        if ($listCat && count($listCat)) {
            foreach ($listCat as $cat) {
                $arr[$cat['id']] = $cat['product_name'];
            }
        }
        return $arr;
    }

    public function getNumberPerson()
    {
        $arr = array();
        for ($i = 1; $i <= 20; $i++) {
            $arr[$i] = $i;
        }
        return $arr;
    }

    public function getChoice()
    {
        $arr = array(
            '0' => 'Chưa xử lý',
            '1' => 'Đang xử lý',
            '2' => 'Đã xử lý',
        );

        return $arr;
    }
    private function doBindType(&$values)
    {
        $values['lang'] = sfContext::getInstance()->getUser()->getCulture();
    }

    protected function doBind(array $values)
    {
        $this->doBindType($values);
        parent::doBind($values);
    }
}
