<?php

/**
 * sfGuardUser form.
 *
 * @package    radio_ivr
 * @subpackage form
 * @author     loilv4
 * @version    SVN: $Id: sfDoctrinePluginFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class sfGuardPermissionAdminForm extends PluginsfGuardPermissionForm
{
  public function configure()
  {

    //Unset cac truong
    unset($this['created_at'], $this['updated_at'], $this['last_login'], $this['salt'], $this['algorithm'], $this['is_super_admin']);

      $this->setWidgets(array(
          'id'          => new sfWidgetFormInputHidden(),
          'name'        => new sfWidgetFormInputText(),
          'description' => new sfWidgetFormTextarea(),
          'types'       => new sfWidgetFormInputCheckbox(),

          'users_list'  => new sfWidgetFormDoctrineChoice(array(
              'multiple' => true,
              'model' => 'sfGuardUser',
              'query' => sfGuardUserTable::getInstance()->createQuery('a')->where('a.is_active = 1'))
          )));

      $this->setValidators(array(
          'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
          'name'        => new sfValidatorString(array('max_length' => 255, 'required' => true, 'trim'=>true)),
          'description' => new sfValidatorString(array('max_length' => 1000, 'required' => false, 'trim'=>true)),
          'types'       => new sfValidatorBoolean(array('required' => false)),

//          'users_list'  => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardUser', 'required' => false)),
      ));
      
      $this->widgetSchema['users_list'] =new sfWidgetFormDoctrineChoice(array(
            'multiple' => true, 
            'model' => 'sfGuardUser',
            'table_method' => 'queryListUserActive',
            ),
             array('style'=>'height: 150px;'));
        
        $adsQuery = sfGuardUserTable::getInstance()->queryListUserActive();
        $this->validatorSchema['users_list'] = new sfValidatorDoctrineChoice(array(
            'multiple' => true, 
            'model' => 'sfGuardUser',
            'required' => false,
            'query' => $adsQuery));
        $this->setDefault('users_list', $this->getUserByPermissionId());
      
      $this->setDefault('types',false);
      $this->validatorSchema->setPostValidator(
          new sfValidatorDoctrineUnique(array('model' => 'sfGuardPermission', 'column' => array('name')))
      );
      $this->widgetSchema->setNameFormat('sf_guard_permission[%s]');

      $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
  }
  
  protected function getUserByPermissionId() 
    {
         $arrLocation=array();
         $list= sfGuardUserPermissionTable::getUserByPermissionId($this->getObject()->id);
         for($i=0; $i<count($list); $i++){
             array_push($arrLocation, $list[$i]['user_id']);
        }
        return $arrLocation;
    }
  
    protected function doBind(array $values) {
        $values['name']=trim($values['name']);
        parent::doBind($values);
    }
}
