<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of vtManageArticlesFiltersAdmin
 *
 * @author ngoctv1
 */
class adLinkFiltersAdmin extends BaseAdLinkFormFilter
{
    public function configure()
    {
        $this->setWidgets(array(
            'name' => new sfWidgetFormFilterInput(array('with_empty' => false)),
        ));

        $this->setValidators(array(
            'name' => new sfValidatorPass(array('required' => false)),

        ));

//    if(sfContext::getInstance()->getUser()->isSuperAdmin()) {
//        $this->widgetSchema['type'] = new sfWidgetFormChoice(array(
//            'choices' => $this->getLinkType(),
//            'multiple' => false,
//            'expanded' => false));
//        $this->validatorSchema['type'] = new sfValidatorChoice(array(
//            'required' => false,
//            'choices' => array_keys($this->getLinkType()),));
//    }

        $this->widgetSchema->setNameFormat('ad_article_filters[%s]');
    }


    protected function getLinkType()
    {
        return array(
            "" => "Chọn kiểu liên kết",
            "1" => "Liên kết cột phải",
            "2" => "Liên kết chân trang"
        );
    }

    public function addNameColumnQuery($query, $field, $values)
    {
        if (isset($values['text']) && $values['text']) {
            return $query->where("name LIKE ?", "%" . $values['text'] . "%");
        }
    }

    public function addTypeColumnQuery($query, $field, $values)
    {
        if ($values != '') {
            $alias = $query->getRootAlias();
            $query->andWhere("$alias.type = ?", $values);
        }
    }
}
