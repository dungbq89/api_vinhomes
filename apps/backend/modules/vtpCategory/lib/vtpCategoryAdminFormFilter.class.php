<?php

/**
 * vtpCategory filter.
 *
 * @package    vtp
 * @subpackage filter
 * @author     LamNQ
 * @version    2
 */
class vtpCategoryAdminFormFilter extends BaseVtpCategoryFormFilter
{
  public function configure()
  {
    $this->validatorSchema['name'] = new sfValidatorSchemaFilter('text', 
            new sfValidatorString(array(
                'required' => false,
                'max_length' => 255
            )));
    
  }
}
