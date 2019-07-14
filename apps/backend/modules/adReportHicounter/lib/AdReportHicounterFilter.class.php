<?php
/**
 * Created by PhpStorm.
 * User: Ta Van Ngoc
 * Date: 8/31/15
 * Time: 9:34 PM
 */
class AdReportHicounterFilter extends BaseAdReportHicounterFormFilter
{
    public function configure()
    {
        $this->setWidgets(array(
            'category_id'  => new sfWidgetFormChoice(array(
                    'choices' => $this->getParentByType(),
                    'multiple' => false,
                    'expanded' => false))
        ));

        $this->setValidators(array(
            'category_id'  => new sfValidatorChoice(array(
                    'required' => false,
                    'choices' => array_keys($this->getParentByType()),))
        ));
        $this->widgetSchema->setNameFormat('ad_report_hicounter_filters[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
    }

    protected function getParentByType(){
        $result=AdCategoryTable::getCategoryReportFilter();
        return $result;
    }
}
