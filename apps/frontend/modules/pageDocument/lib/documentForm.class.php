<?php
/**
 * Created by PhpStorm.
 * User: Ta Van Ngoc
 * Date: 6/14/15
 * Time: 2:02 PM
 */
class documentForm extends BaseAdDocumentForm
{
    public function configure()
    {
        unset($this['created_at'], $this['updated_at'], $this['name'], $this['priority'], $this['file_path'], $this['document_date']);
        $this->setWidgets(array(
            'category'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AdDocCategory'))),
            'keyword' => new sfWidgetFormInputText(),
        ));

        $this->setValidators(array(
            'category'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('AdDocCategory'), 'required' => false)),
            'keyword' => new sfValidatorString(array('max_length' => 25, 'required' => false)),
        ));

        $this->widgetSchema->setNameFormat('ad_document[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    }
}