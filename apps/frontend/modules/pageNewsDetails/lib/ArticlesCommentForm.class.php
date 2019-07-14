<?php
/**
 * Created by PhpStorm.
 * User: Ta Van Ngoc
 * Date: 8/2/15
 * Time: 5:33 PM
 */
class ArticlesCommentForm extends BaseAdArticlesCommentForm
{
    public function configure()
    {
        unset($this['created_at'],$this['updated_at'],$this['article_id']);
        $this->setWidgets(array(
            'id'         => new sfWidgetFormInputHidden(),
            'fullname'   => new sfWidgetFormInputText(),
            'email'      => new sfWidgetFormInputText(),
            'content'    => new sfWidgetFormTextarea(),

        ));

        $this->setValidators(array(
            'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'fullname'   => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'email'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'content'    => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
        ));

        $this->widgetSchema->setNameFormat('ad_articles_comment[%s]');
        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
    }
}
