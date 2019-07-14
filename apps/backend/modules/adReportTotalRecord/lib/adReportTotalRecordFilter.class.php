<?php
/**
 * Created by PhpStorm.
 * User: Ta Van Ngoc
 * Date: 8/30/15
 * Time: 9:30 PM
 */
class AdReportTotalRecordFilter extends BaseAdReportTotalRecordFormFilter
{
    public function configure()
    {
        $i18n = sfContext::getInstance()->getI18N();
        $this->setWidgets(array(
            'category_id'  => new sfWidgetFormChoice(array(
                    'choices' => $this->getParentByType(),
                    'multiple' => false,
                    'expanded' => false)),
            'date_time'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormVnDatePicker(array(), array('readonly' => 'readonly')), 'to_date' => new sfWidgetFormVnDatePicker(array(), array('readonly' => 'readonly')),
                    'with_empty' => false, 'template'=>'Từ ngày %from_date%<br />Đến ngày %to_date%')),
        ));

        $this->setValidators(array(
            'category_id'  => new sfValidatorChoice(array(
                    'required' => false,
                    'choices' => array_keys($this->getParentByType()),)),
            'date_time'    => new sfValidatorDateRange(array('required' => true,
                        'from_date' => new sfValidatorDateTime(array('required' => true,'datetime_output' => 'Y-m-d 00:00:00'), array('required'=>$i18n->__('(*)Bạn phải nhập vào ngày bắt đầu (dd-mm-yyyy).'))),
                        'to_date' => new sfValidatorDateTime(array('required' => true, 'datetime_output' => 'Y-m-d 23:59:59'), array('required'=>$i18n->__('(*)Bạn phải nhập vào ngày kết thúc (dd-mm-yyyy).')))),
                    array('invalid'=>$i18n->__('Ngày bắt đầu phải nhỏ hơn ngày kết thúc.'))),
        ));

        $this->widgetSchema->setNameFormat('ad_report_total_record_filters[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
    }

    public function addDateTimeColumnQuery($query, $field, $values)
    {
        $alias = $query->getRootAlias();
        return $query->andWhere("$alias.date_time >= ?", $values['from'])
            ->andWhere("$alias.date_time <= ? ", $values['to']);
    }
    public function addCategoryIdColumnQuery($query, $field, $values){
        if ($values != ''){
            $alias = $query->getRootAlias();
            $query->andWhere("$alias.category_id = ?", $values);
        }
    }

    protected function getParentByType(){
        $result=AdCategoryTable::getCategoryReportFilter();
        return $result;
    }
}

