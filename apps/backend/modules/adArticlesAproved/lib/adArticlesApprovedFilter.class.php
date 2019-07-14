<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of vtManageArticleApprovedFilter
 *
 * @author ngoctv1
 */
class adArticlesApprovedFilter extends BaseAdArticleFormFilter
{
  public function configure()
  {
      $this->setWidgets(array(
      'title'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
//      'is_active'       => new sfWidgetFormChoice(array(
//                                    'choices' => $this->getStatus(),
//                                    'multiple' => false,
//                                    'expanded' => false)),

    ));

    $this->setValidators(array(
      'title'           => new sfValidatorPass(array('required' => false)),
//      'is_active'       => new sfValidatorChoice(array(
//                                'required' => false,
//                                'choices' => array_keys($this->getStatus()),)),

    ));
//    if(sfContext::getInstance()->getUser()->isSuperAdmin()) {
        $this->widgetSchema['category_id'] = new sfWidgetFormChoice(array(
                                'choices' => $this->getParentByType(),
                                'multiple' => false,
                                'expanded' => false));
        $this->validatorSchema['category_id'] = new sfValidatorChoice(array(
                                'required' => false,
                                'choices' => array_keys($this->getParentByType()),));
//    }
      
    $this->widgetSchema->setNameFormat('ad_article_filters[%s]');
  }
  
  protected function getStatus()
  {
      $i18n = sfContext::getInstance()->getI18N();
      $arrStatus=array();
      $arrStatus['']=$i18n->__('---Tất cả trạng thái---');
      if(sfContext::getInstance()->getUser()->hasCredential('admin'))
      {
          $arrStatus['0']=$i18n->__('Chờ duyệt');
          $arrStatus['1']=$i18n->__('Phê duyệt');
          $arrStatus['2']=$i18n->__('Đăng bài');
      }else{
          if(sfContext::getInstance()->getUser()->hasCredential('news_editor')){
              $arrStatus['0']=$i18n->__('Chờ duyệt');
          }
          if(sfContext::getInstance()->getUser()->hasCredential('news_approved')){
              $arrStatus['1']=$i18n->__('Phê duyệt');
          }
          if(sfContext::getInstance()->getUser()->hasCredential('news_public')){
              $arrStatus['2']=$i18n->__('Đăng bài');
          }
      }
      return $arrStatus;
  }
  protected function getParentByType(){
    if(sfContext::getInstance()->getUser()->isSuperAdmin() || sfContext::getInstance()->getUser()->hasCredential('admin')){
          $result=AdCategoryTable::getCategoryByType('',true);
          return $result;
      }else{
          $result=AdCategoryTable::getCategoryByPermission(sfContext::getInstance()->getUser()->getUserPermission());
          return $result;
      }
 }
 
 public function addTitleColumnQuery($query, $field, $values){
    if(isset($values['text'])){
         return $query->where("title LIKE ?", "%" . $values['text'] . "%");
     }
  }

    public function addCategoryIdColumnQuery($query, $field, $values){
        if ($values != ''){
            $alias = $query->getRootAlias();
            $query->andWhere("$alias.category_id = ?", $values);
        }
    }
}
