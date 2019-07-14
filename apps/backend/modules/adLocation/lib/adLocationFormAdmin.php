<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ngoctv1
 * Date: 4/30/14
 * Time: 1:47 PM
 * To change this template use File | Settings | File Templates.
 */
class adLocationFormAdmin extends BaseadLocationForm
{
    public function configure()
    {
        parent::configure();
        $i18n = sfContext::getInstance()->getI18N();
        unset($this['created_by'],$this['updated_by'], $this['created_at'], $this['updated_at'],
        $this['level'], $this['parent_id']);



        $this->validatorSchema['lang'] = new sfValidatorPass();


        $this->widgetSchema->setNameFormat('adConfig[%s]');
        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
    }

}
