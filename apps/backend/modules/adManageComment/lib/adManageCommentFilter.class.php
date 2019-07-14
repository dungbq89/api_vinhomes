<?php
/**
 * Created by PhpStorm.
 * User: Ta Van Ngoc
 * Date: 5/30/15
 * Time: 11:04 PM
 */
class adManageCommentFilter extends BaseAdCommentFormFilter
{
    public function configure()
    {
        $this->setWidgets(array(
            'title'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
            'phone_number' => new sfWidgetFormFilterInput(array('with_empty' => false)),
            'email'        => new sfWidgetFormFilterInput(array('with_empty' => false)),

        ));

        $this->setValidators(array(
            'title'        => new sfValidatorPass(array('required' => false)),
            'phone_number' => new sfValidatorPass(array('required' => false)),
            'email'        => new sfValidatorPass(array('required' => false)),

        ));

        $this->widgetSchema->setNameFormat('ad_comment_filters[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
    }
}
